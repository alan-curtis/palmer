<?php

namespace Wpo\Tests;

use \Wpo\Core\Extensions_Helpers;
use \Wpo\Core\Plugin_Helpers;
use \Wpo\Services\Access_Token_Service;
use \Wpo\Services\Graph_Service;
use Wpo\Services\Log_Service;
use \Wpo\Services\Options_Service;
use \Wpo\Services\Request_Service;
use \Wpo\Services\User_Service;

// Prevent public access to this script
defined('ABSPATH') or die();

if (!class_exists('\Wpo\Tests\Test_Rest_Protection')) {

    class Test_Rest_Protection
    {

        private $access_token = null;
        private $claims = null;
        private $static_permissions = array();
        private $wp_rest_aad_application_id = null;
        private $wp_rest_aad_application_id_uri = null;
        private $wp_rest_aad_protected_endpoints = array();
        private $wp_rest_configuration_errors = false;

        private $extensions = [];
        private $request = null;
        private $wpo_usr = null;
        private $hostname = null;

        public function __construct()
        {
            $extensions = Extensions_Helpers::get_extensions();

            foreach ($extensions as $slug => $extension) {

                if ($extension['activated']) {
                    $this->extensions[$slug] = $extension;
                }
            }
        }

        /**
         * CONFIGURATION
         */
        public function test_configuration()
        {
            $test_result = new Test_Result('Configuration of Azure AD based protection of the WordPress REST API appears valid.', Test_Result::CAPABILITY_REST, Test_Result::SEVERITY_BLOCKING);
            $test_result->passed = true;

            // APPLICATION ID?
            $this->wp_rest_aad_application_id = Options_Service::get_global_string_var('wp_rest_aad_application_id');

            if (empty($this->wp_rest_aad_application_id)) {
                $this->wp_rest_configuration_errors = true;
                $test_result->passed = false;
                $test_result->message = 'No Azure AD Application (Client) ID has been configured. Therefore Azure AD based protection of the WordPress REST API cannot be enabled.';
                $test_result->more_info = 'https://docs.wpo365.com/article/147-azure-ad-based-protection-for-the-wordpress-rest-api';
                return $test_result;
            }

            // APP SECRET

            $use_app_only = false;

            $application_id = Options_Service::get_global_string_var('application_id');
            $application_secret = Options_Service::get_global_string_var('application_secret');

            $app_only_application_id = Options_Service::get_global_string_var('app_only_application_id');
            $app_only_application_secret = Options_Service::get_global_string_var('app_only_application_secret');

            if (stripos($application_id, $this->wp_rest_aad_application_id) === 0 && !empty($application_secret)) {
                $use_app_only = false;
            } elseif (stripos($app_only_application_id, $this->wp_rest_aad_application_id) === 0 && !empty($app_only_application_secret)) {
                $use_app_only = true;
            } else {
                $this->wp_rest_configuration_errors = true;
                $test_result->passed = false;
                $test_result->message = 'Cannot continue because no Application (Client) Secret has been configured for the Azure AD application with ID ' . $this->wp_rest_aad_application_id . '.';
                $test_result->more_info = 'https://docs.wpo365.com/article/147-azure-ad-based-protection-for-the-wordpress-rest-api';
                return $test_result;
            }

            $this->wp_rest_aad_application_id_uri = Options_Service::get_global_string_var('wp_rest_aad_application_id_uri');

            if (empty($this->wp_rest_aad_application_id_uri)) {
                $this->wp_rest_configuration_errors = true;
                $test_result->passed = false;
                $test_result->message = 'Cannot continue because no Azure AD Application ID URI has been configured for the Azure AD application with ID ' . $this->wp_rest_aad_application_id . '.';
                $test_result->more_info = 'https://docs.wpo365.com/article/147-azure-ad-based-protection-for-the-wordpress-rest-api';
                return $test_result;
            }

            $this->wp_rest_aad_protected_endpoints = Options_Service::get_global_list_var('wp_rest_aad_protected_endpoints');

            if (empty($this->wp_rest_aad_protected_endpoints)) {
                $this->wp_rest_configuration_errors = true;
                $test_result->passed = false;
                $test_result->message = 'No WordPress REST API endpoints have been added to the list so no Azure AD based protection will be applied to any endpoint.';
                $test_result->more_info = 'https://docs.wpo365.com/article/147-azure-ad-based-protection-for-the-wordpress-rest-api';
                return $test_result;
            }

            $wp_endpoint_errors = false;

            foreach ($this->wp_rest_aad_protected_endpoints as $wp_rest_aad_protected_endpoint) {
                if (empty($wp_rest_aad_protected_endpoint['strA'])) {
                    $wp_endpoint_errors = true;
                    break;
                }

                if (empty($wp_rest_aad_protected_endpoint['strB'])) {
                    $wp_endpoint_errors = true;
                    break;
                }

                if (empty($wp_rest_aad_protected_endpoint['strC'])) {
                    $wp_endpoint_errors = true;
                    break;
                }
            }

            if ($wp_endpoint_errors) {
                $this->wp_rest_configuration_errors = true;
                $test_result->passed = false;
                $test_result->message = 'At least one of the WordPress REST API protected endpoints is not correctly configured.';
                $test_result->more_info = 'https://docs.wpo365.com/article/147-azure-ad-based-protection-for-the-wordpress-rest-api';
                return $test_result;
            }

            $wp_rest_aad_protected_endpoint = $this->wp_rest_aad_protected_endpoints[0];

            $this->access_token = Access_Token_Service::get_access_token($wp_rest_aad_protected_endpoint['strC']);

            if (is_wp_error($this->access_token)) {
                $this->wp_rest_configuration_errors = true;
                $test_result->passed = false;
                $test_result->message = 'Could not retrieve an access token for scope ' . $wp_rest_aad_protected_endpoint['strC'] . ' [' . $this->access_token->get_error_message() . ']';
                $test_result->more_info = 'https://docs.wpo365.com/article/147-azure-ad-based-protection-for-the-wordpress-rest-api';
                return $test_result;
            }

            $this->claims = \Wpo\Services\Jwt_Token_Service::validate_signature($this->access_token->access_token);

            if (is_wp_error($this->claims)) {
                $this->wp_rest_configuration_errors = true;
                $test_result->passed = false;
                $test_result->message = 'Validation of the signature of the access token failed [' . $this->claims->get_error_message() . ']';
                $test_result->more_info = 'https://docs.wpo365.com/article/147-azure-ad-based-protection-for-the-wordpress-rest-api';
                return $test_result;
            }

            if (!property_exists($this->claims, 'aud') || strcasecmp($this->claims->aud, $this->wp_rest_aad_application_id_uri) !== 0) {
                $this->wp_rest_configuration_errors = true;
                $test_result->passed = false;
                $test_result->message = 'The access token is for audience ' . $this->claims->aud . ' which differs from the configured Azure AD Application ID URI ' . $this->wp_rest_aad_application_id_uri;
                $test_result->more_info = 'https://docs.wpo365.com/article/147-azure-ad-based-protection-for-the-wordpress-rest-api';
                return $test_result;
            }

            if (!property_exists($this->claims, 'scp') || stripos($wp_rest_aad_protected_endpoint['strC'], $this->claims->scp) <= 0) {
                $this->wp_rest_configuration_errors = true;
                $test_result->passed = false;
                $test_result->message = 'The access token is for scope ' . $this->claims->scp . ' which differs from the requested scope ' . $wp_rest_aad_protected_endpoint['strC'];
                $test_result->more_info = 'https://docs.wpo365.com/article/147-azure-ad-based-protection-for-the-wordpress-rest-api';
                return $test_result;
            }

            $test_result->data = array('access_token' => $this->access_token->access_token);

            return $test_result;
        }

        private function check_static_permission($access_token, $permission, $permission_type, $static_permissions, $severity, $category = Test_Result::CAPABILITY_CONFIG, $additional_message = '', $more_info = 'https://docs.wpo365.com/article/23-integration')
        {

            if (stripos($permission_type, 'delegated') === 0 && Options_Service::get_global_boolean_var('use_saml')) {
                return;
            }

            $test_result = new Test_Result("Static $permission_type permission (scope) '$permission' has been configured", $category, $severity);
            $test_result->passed = true;

            if (empty($access_token)) {
                $test_result->passed = false;
                $test_result->message = "Could not fetch $permission_type access token -> test skipped";
                $test_result->more_info = '';
                return $test_result;
            }

            if (empty($static_permissions)) {
                $test_result->passed = false;
                $test_result->message = "Could not determine static permissions of the current $permission_type access token -> test skipped";
                $test_result->more_info = '';
                return $test_result;
            }

            if (!in_array($permission, $static_permissions)) {
                $test_result->passed = false;
                $test_result->message = "Static permission '$permission' is not configured for current $permission_type access token $additional_message";
                $test_result->more_info = $more_info;
            }

            return $test_result;
        }
    }
}
