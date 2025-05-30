<?php

namespace Wpo\Services;

// Prevent public access to this script
defined('ABSPATH') or die();

use \Wpo\Core\User;
use \Wpo\Services\Log_Service;
use \Wpo\Services\Options_Service;
use \Wpo\Services\Graph_Service;
use \Wpo\Services\User_Service;

if (!class_exists('\Wpo\Services\User_Details_Service')) {

    class User_Details_Service
    {

        /**
         * @since 11.0
         */
        public static function try_improve_core_fields(&$wpo_usr)
        {
            Log_Service::write_log('DEBUG', '##### -> ' . __METHOD__);

            if (empty($wpo_usr->graph_resource)) {
                Log_Service::write_log('DEBUG', __METHOD__ . ' -> Cannot improve user fields because the graph resource has not been retrieved');
                return;
            }

            if (isset($wpo_usr->graph_resource['userPrincipalName'])) {
                $wpo_usr->upn = $wpo_usr->graph_resource['userPrincipalName'];
            }

            if (isset($wpo_usr->graph_resource['mail'])) {
                $wpo_usr->email = $wpo_usr->graph_resource['mail'];
            }

            if (isset($wpo_usr->graph_resource['givenName'])) {
                $wpo_usr->first_name = $wpo_usr->graph_resource['givenName'];
            }

            if (isset($wpo_usr->graph_resource['surname'])) {
                $wpo_usr->last_name = $wpo_usr->graph_resource['surname'];
            }

            $graph_display_name_format = Options_Service::get_global_string_var('graph_display_name_format');

            if (!empty($wpo_usr->first_name) && !empty($wpo_usr->last_name)) {

                if ($graph_display_name_format == 'givenNameSurname') {
                    $wpo_usr->full_name = sprintf('%s %s', $wpo_usr->first_name, $wpo_usr->last_name);
                } elseif ($graph_display_name_format == 'surnameGivenName') {
                    $wpo_usr->full_name = sprintf('%s, %s', $wpo_usr->last_name, $wpo_usr->first_name);
                }
            }

            if ((empty($graph_display_name_format) || $graph_display_name_format == 'displayName') && isset($wpo_usr->graph_resource['displayName'])) {
                $wpo_usr->full_name = $wpo_usr->graph_resource['displayName'];
            }
        }

        /**
         * Retrieves the user's AAD group memberships and adds them to the internally used User.
         * 
         * @since 11.0
         * 
         * @param   string      $resource_identifier    Object ID or user principal name
         * @param   bool        $use_me                 Deprecated, the method will decide for itself
         * @param   bool        $use_delegated          If the true the plugin will use a token with delegated permissions
         * @param   bool        $return_error           Whether the method should return the error if one occurs
         * 
         * @return  object      The graph resource if request or else null
         */
        public static function get_graph_user($resource_identifier = null, $use_me = false, $use_delegated = false, $return_error = false)
        {
            Log_Service::write_log('DEBUG', '##### -> ' . __METHOD__);

            $query = empty($resource_identifier)
                ? '/me'
                : '/users/' . \rawurlencode($resource_identifier);

            $select_properties = Options_Service::get_global_list_var('graph_select_properties');

            if (!empty($select_properties)) {
                $default_properties = array('businessPhones', 'displayName', 'givenName', 'jobTitle', 'mail', 'mobilePhone', 'officeLocation', 'preferredLanguage', 'surname', 'userPrincipalName', 'id', 'city', 'companyName', 'country', 'department', 'employeeId', 'streetAddress', 'state', 'postalCode');
                $select_properties  = array_merge($select_properties, $default_properties);
                $select_properties = array_map(function ($item) {
                    return \trim($item);
                }, $select_properties);
                $query = sprintf(
                    '%s?$select=%s',
                    $query,
                    \implode(',', $select_properties)
                );
            }

            $headers = array(
                'Accept: application/json;odata.metadata=minimal',
                'Content-Type: application/json',
            );

            $graph_resource = Graph_Service::fetch($query, 'GET', false, $headers, $use_delegated);

            if (Graph_Service::is_fetch_result_ok($graph_resource, 'Could not retrieve user details')) {
                return $graph_resource['payload'];
            }

            return $return_error ? $graph_resource : null;
        }

        /**
         * This helper will create a new member graph_resource on the wpo_usr parameter, 
         *  populates it with fields from the ID token instead and eventually returns the 
         * wpo_usr.
         * 
         * @since   18.0
         * 
         * @param object    &$wpo_usr By reference
         * @param object    $id_token 
         * @return void
         */
        public static function get_wpo_usr_from_id_token(&$wpo_usr, $id_token)
        {
            $extra_user_fields = Options_Service::get_global_list_var('extra_user_fields');
            $wpo_usr->graph_resource = array();

            // Just copy these "core" fields for User_Details_Service::try_improve_core_fields
            if (!empty($wpo_usr->email)) {
                $wpo_usr->graph_resource['mail'] = $wpo_usr->email;
            }

            if (!empty($wpo_usr->first_name)) {
                $wpo_usr->graph_resource['givenName'] = $wpo_usr->first_name;
            }

            if (!empty($wpo_usr->last_name)) {
                $wpo_usr->graph_resource['surname'] = $wpo_usr->last_name;
            }

            // Now try to add custom user fields to the mocked graph_resource
            if (!empty($extra_user_fields)) {
                $id_token_props = get_object_vars($id_token);

                foreach ($extra_user_fields as $index => $keyValuePair) {

                    if (empty($keyValuePair) || !is_array($keyValuePair) || empty($keyValuePair['key'])) {
                        continue;
                    }

                    $value = array_key_exists($keyValuePair['key'], $id_token_props)
                        ? $id_token_props[$keyValuePair['key']]
                        : false;

                    if (empty($value)) {
                        continue;
                    }

                    $wpo_usr->graph_resource[$keyValuePair['key']] = $value;
                }
            }
        }

        /**
         * Administrators can prevent WordPress from sending emails when their email changed.
         * This is especially useful since WordPress doesn't compare new and old email addresses
         * case insensitive.
         * 
         * @since 11.9
         * 
         * @return  boolean     Whether or not to send the email changed notification.
         */
        public static function prevent_send_email_change_email()
        {
            Log_Service::write_log('DEBUG', '##### -> ' . __METHOD__);

            if (Options_Service::get_global_boolean_var('prevent_send_email_change_email')) {
                return false;
            }

            return true;
        }
    }
}
