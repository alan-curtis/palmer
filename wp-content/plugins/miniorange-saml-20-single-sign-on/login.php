<?php
/*
Plugin Name: miniOrange SSO using SAML 2.0
Plugin URI: http://miniorange.com/
Description: (Premium Single-Site)miniOrange SAML 2.0 SSO enables user to perform Single Sign On with any SAML 2.0 enabled Identity Provider.
Version: 12.0.7
Author: miniOrange
Author URI: http://miniorange.com/
*/


include_once dirname(__FILE__) . "\57\155\x6f\137\x6c\x6f\x67\x69\x6e\137\x73\x61\x6d\x6c\x5f\163\163\157\x5f\167\x69\x64\x67\x65\164\x2e\x70\150\x70";
include_once "\170\155\154\163\x65\x63\154\151\x62\x73\x2e\x70\x68\160";
use RobRichards\XMLSecLibs\XMLSecurityKey;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecEnc;
require "\155\x6f\55\x73\141\155\154\55\143\x6c\141\x73\163\x2d\x63\165\163\164\x6f\x6d\x65\x72\56\x70\150\x70";
require "\155\157\137\x73\x61\155\154\x5f\x73\145\x74\x74\151\156\147\163\x5f\x70\141\x67\145\x2e\160\150\160";
require "\x4d\x65\x74\141\x64\141\x74\141\122\x65\141\x64\x65\x72\56\x70\x68\x70";
require "\x63\145\162\x74\x69\146\151\143\x61\164\145\x5f\165\x74\151\x6c\151\164\x79\x2e\160\150\x70";
require "\x6c\x69\x63\x65\156\x73\x65\x75\x74\151\x6c\163\x2e\160\x68\x70";
require "\x4c\151\x63\145\156\163\x65\x55\164\151\x6c\163\57\114\151\143\145\156\x73\145\x44\x61\x6f\56\x70\150\x70";
require_once "\155\157\x2d\x73\141\155\154\55\160\154\165\147\151\156\x2d\x76\x65\x72\163\x69\x6f\156\x2d\x75\160\144\141\x74\x65\x2e\160\150\160";
class saml_mo_login
{
    private $widgetObj;
    function __construct()
    {
        add_action("\x61\144\x6d\x69\x6e\137\155\x65\156\165", array($this, "\x6d\151\156\x69\x6f\x72\x61\x6e\147\145\x5f\163\163\x6f\137\155\145\156\165"));
        add_action("\141\144\155\x69\156\137\151\x6e\151\164", array($this, "\155\x69\156\x69\157\162\x61\x6e\x67\145\x5f\154\157\147\x69\x6e\137\x77\151\x64\x67\x65\x74\x5f\x73\141\x6d\x6c\x5f\x73\141\166\145\137\x73\145\164\164\x69\156\147\163"));
        add_action("\141\x64\155\x69\156\x5f\x65\x6e\x71\165\145\165\145\137\x73\x63\x72\x69\160\x74\x73", array($this, "\x70\x6c\x75\x67\x69\156\137\163\145\x74\x74\151\x6e\147\163\137\x73\164\171\x6c\x65"), 999);
        register_deactivation_hook(__FILE__, array($this, "\155\x6f\x5f\163\163\157\x5f\x73\141\x6d\x6c\x5f\144\145\x61\x63\164\x69\x76\x61\x74\x65"));
        add_action("\x61\x64\155\151\156\x5f\145\x6e\x71\165\x65\165\145\137\x73\143\x72\151\x70\x74\x73", array($this, "\x70\x6c\165\147\151\x6e\137\x73\x65\x74\x74\151\156\x67\x73\x5f\163\x63\x72\x69\160\x74"), 999);
        remove_action("\141\144\x6d\151\156\137\x6e\x6f\164\x69\x63\x65\163", array($this, "\x6d\157\137\x73\x61\155\154\x5f\x73\x75\x63\x63\145\x73\x73\x5f\155\x65\163\163\141\x67\145"));
        remove_action("\x61\144\x6d\151\x6e\137\156\157\x74\151\143\145\x73", array($this, "\x6d\x6f\137\x73\x61\155\154\x5f\145\x72\x72\157\162\137\x6d\x65\x73\x73\x61\x67\145"));
        add_action("\x77\160\137\141\165\x74\x68\x65\x6e\164\x69\x63\141\164\145", array($this, "\155\x6f\x5f\163\141\x6d\x6c\137\x61\x75\x74\150\x65\x6e\x74\x69\143\x61\164\145"));
        add_action("\167\160", array($this, "\155\157\137\163\x61\x6d\x6c\137\141\x75\164\157\x5f\162\x65\144\151\x72\x65\143\x74"));
        $this->widgetObj = new mo_login_wid();
        add_action("\151\156\151\x74", array($this->widgetObj, "\155\x6f\x5f\x73\141\155\154\137\167\x69\x64\147\145\x74\x5f\151\x6e\151\164"));
        add_action("\141\144\155\x69\156\137\x69\x6e\151\x74", "\155\157\137\163\x61\x6d\154\x5f\x64\x6f\x77\x6e\x6c\157\141\x64");
        add_action("\x6c\x6f\x67\x69\x6e\x5f\x65\x6e\x71\x75\x65\165\x65\137\163\143\x72\151\160\x74\163", array($this, "\155\157\137\163\x61\155\154\137\154\157\x67\x69\156\x5f\145\x6e\161\x75\x65\x75\x65\x5f\163\143\x72\151\160\164\163"));
        add_action("\x6c\157\147\151\156\x5f\146\157\162\x6d", array($this, "\x6d\x6f\x5f\x73\141\x6d\x6c\x5f\x6d\x6f\x64\x69\x66\x79\x5f\x6c\x6f\x67\x69\156\x5f\146\x6f\162\x6d"));
        add_shortcode("\115\x4f\x5f\123\101\115\114\137\x46\x4f\122\x4d", array($this, "\155\x6f\x5f\x67\145\164\137\x73\x61\155\x6c\137\163\150\157\162\x74\143\157\144\x65"));
        add_filter("\143\162\157\x6e\137\x73\x63\x68\x65\x64\165\x6c\x65\x73", array($this, "\155\171\x70\162\x65\x66\x69\x78\x5f\141\x64\144\137\143\x72\157\x6e\137\163\143\150\x65\144\165\154\x65"));
        add_action("\155\145\164\x61\x64\x61\164\141\137\163\x79\x6e\x63\137\143\x72\x6f\x6e\137\141\x63\x74\151\x6f\156", array($this, "\x6d\145\164\x61\x64\141\164\x61\x5f\163\x79\156\x63\137\143\162\157\156\x5f\x61\143\x74\x69\x6f\156"));
        register_activation_hook(__FILE__, array($this, "\155\x6f\x5f\163\x61\x6d\154\x5f\143\x68\145\x63\153\x5f\x6f\160\145\156\163\163\x6c"));
        add_action("\160\x6c\x75\147\x69\156\x5f\141\x63\164\x69\157\x6e\137\154\x69\156\153\163\137" . plugin_basename(__FILE__), array($this, "\155\x6f\137\163\141\x6d\x6c\x5f\x70\x6c\x75\x67\x69\x6e\137\x61\x63\x74\x69\x6f\156\x5f\154\x69\156\x6b\x73"));
        add_action("\x61\x64\155\151\x6e\137\x69\x6e\x69\x74", array($this, "\x64\x65\146\x61\x75\154\x74\137\x63\x65\x72\x74\x69\x66\151\143\141\x74\145"));
        add_option("\x6c\143\144\152\x6b\141\x73\x6a\144\x6b\163\x61\143\x6c", "\x64\145\146\141\165\154\164\55\x63\x65\162\x74\x69\x66\x69\143\141\164\x65");
        add_filter("\x6d\x61\x6e\x61\147\145\x5f\165\x73\x65\162\x73\x5f\x63\157\x6c\165\155\x6e\x73", array($this, "\x6d\157\137\163\x61\155\x6c\x5f\x63\165\x73\x74\157\155\137\141\164\x74\162\137\143\x6f\x6c\165\x6d\156"));
        add_filter("\155\141\x6e\x61\147\x65\x5f\165\x73\x65\x72\x73\137\x63\x75\x73\164\157\155\137\143\157\x6c\165\x6d\156", array($this, "\x6d\x6f\137\x73\141\155\154\x5f\x61\164\164\x72\x5f\143\x6f\154\165\155\156\137\143\157\x6e\x74\x65\156\164"), 10, 3);
        add_action("\x77\160\x5f\x6c\x6f\147\x6f\x75\x74", array($this->widgetObj, "\x6d\157\137\x73\x61\x6d\x6c\137\154\x6f\147\157\165\x74"), 1, 1);
        global $qL;
        if ((float) $qL < 5.5 && (float) $qL > 5.2) {
            goto E9;
        }
        add_action("\167\x70\x5f\154\x6f\147\x6f\x75\x74", array($this->widgetObj, "\x6d\x6f\x5f\163\141\x6d\154\137\154\x6f\147\157\165\x74"), 1, 1);
        goto TJ;
        E9:
        add_filter("\154\157\x67\157\165\x74\137\162\x65\144\x69\162\x65\x63\x74", array($this, "\x6d\157\137\163\x61\x6d\x6c\137\x6c\x6f\x67\x6f\165\x74\137\x62\162\157\x6b\x65\162\137\167\x69\x74\150\137\x66\x69\154\x74\145\x72"), 10, 3);
        TJ:
    }
    function mo_saml_logout_broker_with_filter($Nj, $z3, $user)
    {
        $this->widgetObj->mo_saml_logout($user->ID);
    }
    function default_certificate()
    {
        $EK = file_get_contents(plugin_dir_path(__FILE__) . "\x72\x65\163\157\x75\x72\x63\x65\163" . DIRECTORY_SEPARATOR . "\x6d\x69\156\x69\x6f\x72\141\x6e\147\x65\137\x73\160\x5f\62\x30\62\x30\x2e\x63\162\x74");
        $H2 = file_get_contents(plugin_dir_path(__FILE__) . "\x72\x65\x73\157\165\162\x63\145\x73" . DIRECTORY_SEPARATOR . "\155\x69\156\151\157\162\x61\x6e\x67\x65\137\x73\160\137\62\60\62\60\137\160\162\x69\x76\56\x6b\x65\171");
        if (!(!get_option("\155\157\x5f\x73\141\x6d\x6c\x5f\x63\165\162\x72\x65\156\164\137\x63\145\x72\164") && !get_option("\x6d\x6f\137\x73\x61\155\154\x5f\143\165\162\x72\145\156\164\137\x63\145\162\164\137\160\162\x69\166\141\x74\145\x5f\x6b\145\171"))) {
            goto OI;
        }
        update_option("\155\x6f\137\163\x61\155\x6c\x5f\x63\165\162\162\x65\156\164\137\143\145\162\164", $EK);
        update_option("\155\157\137\x73\x61\x6d\154\x5f\x63\165\162\x72\145\x6e\x74\x5f\143\x65\x72\x74\x5f\160\162\x69\x76\x61\164\x65\x5f\153\x65\x79", $H2);
        OI:
    }
    function mo_saml_check_openssl()
    {
        if (mo_saml_is_extension_installed("\157\x70\145\x6e\163\163\x6c")) {
            goto YL;
        }
        wp_die("\120\x48\x50\40\157\x70\x65\x6e\163\163\x6c\40\145\170\x74\145\156\163\x69\x6f\x6e\x20\151\x73\40\x6e\157\x74\40\x69\x6e\163\x74\141\x6c\154\x65\x64\x20\x6f\162\40\144\x69\163\x61\142\154\145\x64\x2c\x70\x6c\x65\141\x73\x65\40\145\x6e\x61\x62\x6c\x65\40\151\x74\40\164\157\40\x61\143\x74\151\x76\141\164\x65\40\164\150\x65\x20\160\154\165\x67\x69\x6e\x2e");
        YL:
        add_option("\x41\143\x74\x69\x76\x61\164\x65\x64\137\x50\154\165\x67\151\156", "\x50\x6c\165\147\151\x6e\55\x53\x6c\x75\147");
    }
    function myprefix_add_cron_schedule($ee)
    {
        $ee["\167\145\145\x6b\x6c\171"] = array("\151\x6e\x74\145\162\166\141\154" => 604800, "\144\151\x73\160\154\141\x79" => __("\x4f\x6e\143\x65\x20\127\x65\145\x6b\x6c\171"));
        $ee["\155\x6f\x6e\x74\x68\154\x79"] = array("\x69\156\164\x65\x72\x76\141\x6c" => 2635200, "\x64\151\163\x70\x6c\141\x79" => __("\117\x6e\143\x65\40\x4d\157\x6e\x74\150\154\171"));
        return $ee;
    }
    function metadata_sync_cron_action()
    {
        error_log("\155\x69\156\x69\157\x72\141\x6e\147\x65\40\x3a\x20\122\x41\x4e\x20\x53\x59\116\103\x20\x2d\x20" . time());
        $gY = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Identity_name);
        $this->upload_metadata(@file_get_contents(get_option("\163\x61\x6d\154\137\x6d\x65\x74\141\x64\x61\x74\x61\137\165\x72\x6c\137\146\157\x72\137\x73\171\156\x63")));
        update_option("\163\141\x6d\x6c\137\x69\144\x65\156\x74\151\164\x79\137\156\141\x6d\x65", $gY);
    }
    function mo_login_widget_saml_options()
    {
        global $wpdb;
        update_option("\155\x6f\x5f\x73\x61\x6d\154\x5f\150\x6f\163\x74\x5f\x6e\x61\x6d\145", "\150\164\164\x70\163\x3a\x2f\57\154\157\x67\x69\x6e\56\x78\x65\x63\x75\162\x69\146\171\56\143\x6f\x6d");
        $sf = get_option("\155\157\137\163\141\x6d\154\x5f\150\157\163\x74\x5f\156\x61\155\145");
        mo_register_saml_sso();
    }
    function mo_saml_success_message()
    {
        $b2 = "\x65\162\x72\x6f\x72";
        $AP = get_option("\155\x6f\x5f\163\x61\155\154\x5f\155\x65\x73\163\x61\147\x65");
        echo "\74\x64\x69\x76\x20\143\x6c\141\x73\163\x3d\47" . $b2 . "\47\76\x20\x3c\x70\x3e" . $AP . "\x3c\57\x70\x3e\x3c\x2f\144\151\x76\76";
    }
    function mo_saml_error_message()
    {
        $b2 = "\165\160\x64\x61\164\x65\x64";
        $AP = get_option("\x6d\157\x5f\x73\x61\155\x6c\137\155\145\163\x73\141\x67\145");
        echo "\x3c\144\151\166\x20\143\x6c\141\x73\163\75\47" . $b2 . "\x27\x3e\x20\x3c\160\x3e" . $AP . "\x3c\57\x70\x3e\74\x2f\x64\151\x76\x3e";
    }
    public function mo_sso_saml_deactivate()
    {
        if (!is_multisite()) {
            goto KU;
        }
        global $wpdb;
        $Gm = $wpdb->get_col("\123\105\114\x45\x43\x54\x20\142\x6c\x6f\x67\137\151\144\40\x46\122\x4f\x4d\x20{$wpdb->blogs}");
        $Yx = get_current_blog_id();
        do_action("\x6d\x6f\x5f\x73\x61\155\x6c\137\146\154\165\x73\150\137\x63\x61\143\150\x65");
        foreach ($Gm as $blog_id) {
            switch_to_blog($blog_id);
            delete_option("\x6d\157\137\x73\141\155\x6c\137\x68\x6f\163\x74\x5f\156\x61\155\145");
            delete_option("\155\x6f\137\x73\x61\155\x6c\137\156\145\167\137\x72\145\147\x69\163\x74\162\x61\164\151\x6f\x6e");
            delete_option("\x6d\x6f\x5f\x73\x61\x6d\154\137\141\144\x6d\151\156\x5f\160\x68\157\x6e\x65");
            delete_option("\x6d\157\x5f\163\141\x6d\x6c\x5f\x61\x64\155\x69\x6e\x5f\160\141\x73\163\x77\x6f\162\144");
            delete_option("\155\x6f\x5f\163\x61\155\154\x5f\x76\x65\162\x69\x66\x79\x5f\143\x75\163\x74\x6f\155\145\162");
            delete_option("\155\x6f\x5f\163\x61\x6d\x6c\137\141\144\x6d\151\x6e\x5f\143\165\163\164\x6f\x6d\x65\x72\x5f\153\145\x79");
            delete_option("\155\x6f\x5f\x73\141\x6d\154\137\141\144\155\151\156\137\141\160\151\137\153\145\171");
            delete_option("\x6d\157\x5f\x73\x61\155\x6c\137\x63\165\163\x74\157\x6d\x65\162\x5f\x74\x6f\153\x65\156");
            delete_option("\155\157\x5f\163\x61\155\154\137\x6d\x65\163\163\141\147\145");
            delete_option("\x6d\157\x5f\163\141\155\x6c\137\162\145\147\x69\163\164\162\141\x74\x69\x6f\x6e\x5f\x73\164\141\x74\165\x73");
            delete_option("\x6d\x6f\137\163\x61\x6d\x6c\x5f\x69\144\160\x5f\143\157\156\x66\x69\x67\137\x63\157\155\x70\154\x65\164\145");
            delete_option("\x6d\157\x5f\x73\x61\155\x6c\x5f\x74\x72\x61\156\163\141\143\164\x69\x6f\x6e\111\x64");
            delete_option("\x76\154\x5f\143\150\x65\143\153\x5f\x74");
            delete_option("\166\154\137\143\x68\145\143\x6b\x5f\x73");
            delete_option("\x6d\x6f\137\163\x61\155\x6c\x5f\x73\x68\157\x77\137\x61\144\144\157\156\x73\137\x6e\x6f\x74\x69\x63\x65");
            tS:
        }
        np:
        switch_to_blog($Yx);
        goto DM;
        KU:
        do_action("\155\x6f\x5f\x73\x61\155\x6c\x5f\x66\154\x75\163\150\x5f\143\141\x63\150\145");
        delete_option("\155\x6f\137\163\141\155\x6c\137\x68\x6f\163\164\137\156\x61\x6d\x65");
        delete_option("\x6d\x6f\137\163\x61\155\154\137\156\145\167\137\162\x65\x67\151\x73\x74\x72\141\x74\151\x6f\x6e");
        delete_option("\155\157\137\163\141\x6d\154\137\x61\144\x6d\x69\156\x5f\160\150\157\156\x65");
        delete_option("\x6d\x6f\x5f\x73\x61\x6d\154\137\x61\x64\155\x69\156\137\160\141\163\163\167\x6f\x72\x64");
        delete_option("\x6d\x6f\137\x73\141\x6d\x6c\x5f\x76\x65\x72\151\x66\171\x5f\x63\165\x73\164\x6f\155\x65\162");
        delete_option("\155\157\137\x73\x61\155\154\x5f\x61\x64\155\151\156\137\143\165\x73\x74\157\155\145\x72\137\x6b\145\x79");
        delete_option("\155\157\x5f\163\141\155\x6c\137\141\144\155\x69\x6e\x5f\141\160\151\x5f\x6b\x65\171");
        delete_option("\155\x6f\x5f\163\x61\x6d\x6c\137\x63\x75\163\x74\157\x6d\145\162\137\x74\157\x6b\x65\x6e");
        delete_option("\x6d\x6f\137\x73\x61\x6d\154\137\155\145\163\163\x61\147\x65");
        delete_option("\155\157\137\163\141\155\x6c\x5f\x72\145\147\151\x73\x74\162\x61\x74\151\x6f\x6e\x5f\x73\164\141\x74\165\x73");
        delete_option("\155\157\137\163\x61\155\x6c\137\151\x64\160\x5f\x63\157\x6e\146\x69\x67\137\143\157\x6d\x70\154\145\164\145");
        delete_option("\x6d\157\137\163\141\155\x6c\x5f\164\x72\x61\x6e\163\141\143\164\151\x6f\x6e\x49\144");
        delete_option("\155\x6f\x5f\163\x61\x6d\x6c\x5f\145\x6e\x61\142\154\145\137\x63\154\157\165\144\137\142\162\x6f\x6b\145\162");
        delete_option("\166\154\137\143\150\145\x63\x6b\137\164");
        delete_option("\166\x6c\137\143\x68\145\x63\153\137\163");
        delete_option("\155\157\137\163\141\155\154\137\x73\150\157\x77\137\x61\144\144\x6f\156\163\137\156\157\164\151\143\x65");
        DM:
    }
    function djkasjdksaduwaj($ew, $dI, $he = "\146\141\x6c\x73\145")
    {
        $fY = $dI->check_customer_ln();
        if ($fY) {
            goto Br;
        }
        if (!($he == "\164\162\165\145")) {
            goto mk;
        }
        WP_CLI::error(mo_saml_cli_error::Poor_Internet);
        mk:
        return;
        Br:
        $fY = json_decode($fY, true);
        if (strcasecmp($fY["\163\x74\x61\x74\x75\x73"], "\x53\125\x43\103\x45\x53\123") == 0) {
            goto UH;
        }
        $y9 = get_option("\x6d\157\x5f\163\x61\155\x6c\137\143\165\x73\x74\157\155\145\162\137\x74\157\x6b\x65\156");
        update_option("\163\x69\164\145\137\143\x6b\x5f\x6c", AESEncryption::encrypt_data("\146\141\154\x73\145", $y9));
        if (!($he == "\164\162\165\x65")) {
            goto Lt;
        }
        WP_CLI::error(mo_saml_cli_error::Not_Upgraded);
        Lt:
        $H4 = add_query_arg(array("\164\x61\142" => "\154\x69\143\x65\156\163\151\156\147"), $_SERVER["\122\105\x51\x55\105\123\124\x5f\x55\x52\111"]);
        update_option("\x6d\x6f\x5f\163\x61\155\154\x5f\x6d\145\163\x73\141\147\145", "\131\x6f\x75\x20\x68\x61\x76\145\40\156\157\164\x20\x75\x70\147\x72\141\x64\145\144\x20\171\145\x74\56\x20" . addLink("\x43\154\x69\143\153\x20\x68\x65\162\145", $H4) . "\40\x74\x6f\40\x75\160\x67\162\141\144\145\x20\164\x6f\x20\160\x72\145\155\151\x75\x6d\x20\166\145\x72\163\x69\x6f\156\x2e");
        $this->mo_saml_show_error_message();
        goto jY;
        UH:
        $fY = json_decode($dI->mo_saml_vl($ew, false), true);
        update_option("\166\x6c\137\x63\x68\145\x63\x6b\137\164", time());
        if (is_array($fY) and strcasecmp($fY["\163\x74\141\164\x75\163"], "\x53\125\x43\x43\105\x53\x53") == 0) {
            goto Jg;
        }
        if (is_array($fY) and strcasecmp($fY["\x73\x74\x61\164\x75\163"], "\106\x41\111\x4c\x45\104") == 0) {
            goto w3;
        }
        if (!($he == "\x74\x72\165\x65")) {
            goto sR;
        }
        WP_CLI::error(mo_saml_cli_error::Poor_Internet);
        sR:
        update_option("\155\157\137\163\141\x6d\x6c\x5f\x6d\145\x73\x73\x61\147\145", "\x41\156\40\x65\x72\162\157\162\40\x6f\143\143\x75\162\145\144\x20\x77\x68\x69\x6c\145\x20\160\162\157\143\x65\163\x73\151\156\x67\40\171\x6f\x75\x72\x20\162\x65\161\165\x65\163\164\x2e\40\x50\x6c\145\x61\163\145\40\124\x72\x79\40\x61\147\141\x69\x6e\x2e");
        $this->mo_saml_show_error_message();
        goto ZZ;
        w3:
        if (strcasecmp($fY["\x6d\145\163\163\141\147\x65"], "\x43\157\x64\x65\40\x68\141\x73\40\105\170\x70\x69\x72\145\144") == 0) {
            goto i0;
        }
        if (!($he == "\164\x72\x75\145")) {
            goto Kr;
        }
        WP_CLI::error(mo_saml_cli_error::Invalid_License);
        Kr:
        update_option("\155\x6f\137\163\141\x6d\154\137\155\x65\163\x73\141\x67\145", "\x59\157\x75\x20\150\x61\166\x65\40\145\x6e\164\x65\x72\145\144\40\x61\x6e\40\x69\x6e\x76\x61\154\151\x64\x20\x6c\151\x63\x65\x6e\x73\145\40\x6b\x65\171\x2e\40\x50\x6c\x65\141\x73\x65\40\145\x6e\x74\145\x72\40\141\40\x76\141\154\x69\x64\x20\154\151\143\x65\156\x73\x65\40\153\145\x79\x2e");
        goto qh;
        i0:
        if (!($he == "\164\x72\x75\x65")) {
            goto iI;
        }
        WP_CLI::error(mo_saml_cli_error::Code_Expired);
        iI:
        $H4 = add_query_arg(array("\164\x61\142" => "\x6c\x69\x63\x65\156\x73\x69\156\147"), $_SERVER["\x52\105\121\x55\x45\123\124\137\125\x52\111"]);
        update_option("\x6d\x6f\137\x73\141\x6d\154\137\155\145\163\163\x61\x67\x65", "\x4c\151\x63\145\x6e\163\145\40\153\145\171\x20\171\157\x75\40\x68\x61\166\145\x20\145\156\x74\x65\162\x65\144\40\150\x61\163\40\141\x6c\162\145\141\144\x79\40\x62\x65\145\156\40\165\x73\x65\144\56\x20\x50\x6c\145\x61\x73\145\40\x65\156\164\145\162\x20\141\40\153\145\x79\40\167\150\x69\143\150\40\x68\x61\x73\40\156\x6f\x74\x20\142\145\x65\156\40\165\x73\x65\144\x20\x62\x65\x66\x6f\x72\x65\x20\157\156\40\141\156\171\40\x6f\164\150\145\162\40\151\156\163\x74\x61\156\143\145\40\157\x72\x20\151\x66\40\x79\x6f\x75\x20\150\141\166\x65\x20\x65\x78\141\165\x73\x74\x65\144\40\x61\154\x6c\40\x79\157\165\x72\x20\153\145\171\163\40\164\150\145\156\x20" . addLink("\103\x6c\151\x63\153\40\150\145\x72\145", $H4) . "\40\164\x6f\40\142\165\171\x20\155\x6f\x72\x65\56");
        qh:
        $this->mo_saml_show_error_message();
        ZZ:
        goto VK;
        Jg:
        $y9 = get_option("\155\157\x5f\x73\x61\x6d\x6c\137\143\165\163\164\x6f\x6d\145\x72\137\x74\x6f\x6b\145\156");
        update_option("\163\x6d\154\x5f\x6c\x6b", AESEncryption::encrypt_data($ew, $y9));
        $AP = "\x59\157\x75\x72\x20\154\x69\143\145\156\163\145\x20\151\163\40\x76\145\162\151\146\x69\x65\144\56\x20\x59\157\x75\x20\143\141\x6e\40\156\157\x77\40\x73\145\164\x75\x70\x20\x74\x68\x65\x20\160\154\165\x67\151\156\56";
        update_option("\x6d\x6f\x5f\x73\141\x6d\154\137\x6d\x65\163\163\141\147\x65", $AP);
        $y9 = get_option("\x6d\157\x5f\163\x61\x6d\x6c\137\x63\x75\163\164\157\155\x65\x72\x5f\164\157\x6b\x65\x6e");
        update_option("\x73\x69\164\x65\137\x63\153\x5f\x6c", AESEncryption::encrypt_data("\164\162\165\x65", $y9));
        update_option("\164\x5f\x73\x69\x74\x65\137\163\164\x61\164\x75\163", AESEncryption::encrypt_data("\x66\141\x6c\x73\x65", $y9));
        $s5 = plugin_dir_path(__FILE__);
        $GW = home_url();
        $GW = trim($GW, "\x2f");
        if (preg_match("\43\136\150\x74\x74\160\x28\163\51\77\x3a\57\57\43", $GW)) {
            goto Y7;
        }
        $GW = "\x68\164\x74\x70\x3a\57\x2f" . $GW;
        Y7:
        $X5 = parse_url($GW);
        $aY = preg_replace("\57\x5e\167\167\167\134\56\57", '', $X5["\x68\157\x73\164"]);
        $bX = wp_upload_dir();
        $Ka = $aY . "\55" . $bX["\142\x61\163\145\144\151\162"];
        $RQ = hash_hmac("\x73\x68\141\x32\x35\66", $Ka, "\64\x44\110\x66\x6a\x67\x66\x6a\141\163\x6e\x64\x66\x73\141\x6a\146\x48\x47\x4a");
        $Ve = $this->djkasjdksa();
        $Fv = round(strlen($Ve) / rand(2, 20));
        $Ve = substr_replace($Ve, $RQ, $Fv, 0);
        $U5 = base64_decode($Ve);
        if (is_writable($s5 . "\154\x69\x63\145\x6e\163\145")) {
            goto XO;
        }
        $Ve = str_rot13($Ve);
        $Bf = base64_decode("\142\107\116\153\141\155\164\x68\143\x32\160\153\141\63\x4e\150\131\62\167\x3d");
        update_option($Bf, $Ve);
        goto b_;
        XO:
        file_put_contents($s5 . "\x6c\151\143\145\x6e\x73\145", $U5);
        b_:
        update_option("\154\143\x77\x72\164\x6c\146\163\141\155\x6c", true);
        if (!($he == "\164\162\165\145")) {
            goto p2;
        }
        WP_CLI::success("\114\151\x63\x65\x6e\163\x65\x20\x61\160\160\154\151\x65\x64\x20\x73\165\143\143\x65\163\x73\146\x75\x6c\x6c\171\x2e");
        p2:
        $H4 = add_query_arg(array("\x74\141\x62" => "\x67\145\x6e\x65\x72\141\x6c"), $_SERVER["\122\105\x51\x55\x45\123\124\137\125\x52\x49"]);
        $this->mo_saml_show_success_message();
        VK:
        jY:
    }
    function mo_cli_save_details($Vi, $co, $NA, $Kd, $Jx)
    {
        if (mo_saml_is_extension_installed("\x63\165\162\154")) {
            goto kF;
        }
        WP_CLI::error(mo_saml_cli_error::Curl_Error);
        kF:
        update_option("\155\157\137\x73\x61\155\x6c\137\162\x65\147\x69\x73\164\162\141\x74\151\x6f\156\x5f\x73\x74\141\x74\x75\163", '');
        update_option("\x6d\x6f\x5f\163\x61\x6d\154\x5f\166\145\162\151\x66\x79\137\143\165\163\x74\157\155\x65\x72", '');
        delete_option("\155\157\137\163\141\155\x6c\x5f\x6e\145\x77\137\162\145\x67\x69\163\x74\162\x61\164\151\157\x6e");
        delete_option("\x6d\157\137\x73\x61\x6d\154\x5f\141\x64\155\151\156\137\x65\x6d\141\151\154");
        delete_option("\x6d\157\x5f\163\141\155\154\137\x61\144\x6d\x69\156\x5f\160\x68\x6f\x6e\x65");
        delete_option("\163\x6d\154\137\154\x6b");
        delete_option("\164\x5f\x73\151\x74\x65\137\163\x74\141\x74\165\x73");
        delete_option("\x73\151\x74\145\137\x63\x6b\137\154");
        $Dm = sanitize_email($Kd);
        update_option("\x6d\157\137\163\x61\x6d\x6c\x5f\141\144\155\x69\x6e\137\x65\x6d\141\x69\x6c", $Dm);
        $dI = new CustomerSaml();
        $fY = $dI->check_customer();
        if ($fY) {
            goto yB;
        }
        WP_CLI::error(mo_saml_cli_error::Poor_Internet);
        yB:
        $fY = json_decode($fY, true);
        if (!(strcasecmp($fY["\163\164\141\164\165\x73"], "\x43\125\x53\x54\117\115\x45\122\137\x4e\x4f\124\x5f\x46\x4f\x55\116\x44") == 0)) {
            goto K7;
        }
        WP_CLI::error(mo_saml_cli_error::Customer_Not_Found);
        K7:
        update_option("\155\157\x5f\163\141\155\154\137\141\144\155\151\156\137\143\x75\163\164\157\x6d\x65\x72\x5f\153\145\171", $Vi);
        update_option("\x6d\x6f\x5f\x73\141\x6d\x6c\x5f\x61\x64\x6d\x69\156\x5f\x61\x70\151\137\153\x65\x79", $co);
        update_option("\x6d\x6f\137\x73\x61\155\154\x5f\x63\165\x73\x74\x6f\155\x65\x72\x5f\x74\x6f\x6b\x65\156", $NA);
        update_option("\x6d\157\137\163\141\155\x6c\137\x72\145\147\151\163\164\162\141\x74\151\x6f\x6e\137\x73\164\141\164\165\163", "\x45\x78\x69\x73\x74\151\x6e\x67\40\x55\163\x65\x72");
        delete_option("\x6d\157\137\163\x61\x6d\154\137\166\145\162\x69\x66\171\137\143\165\x73\164\157\x6d\x65\162");
        $ew = htmlspecialchars(trim($Jx));
        $this->djkasjdksaduwaj($ew, $dI, "\164\x72\165\x65");
    }
    function mo_saml_show_success_message()
    {
        remove_action("\141\144\x6d\151\x6e\x5f\156\x6f\164\x69\x63\x65\163", array($this, "\155\157\x5f\x73\x61\x6d\x6c\137\x73\x75\x63\x63\x65\163\x73\x5f\x6d\x65\163\x73\x61\x67\x65"));
        add_action("\x61\144\155\151\156\x5f\x6e\x6f\x74\151\x63\145\x73", array($this, "\155\157\137\163\x61\x6d\154\x5f\145\x72\162\157\162\x5f\155\145\x73\x73\141\147\x65"));
    }
    function mo_saml_show_error_message()
    {
        remove_action("\141\x64\155\151\x6e\137\x6e\x6f\164\151\x63\x65\163", array($this, "\x6d\157\x5f\x73\x61\155\x6c\137\x65\x72\x72\x6f\x72\137\x6d\x65\163\163\141\147\x65"));
        add_action("\x61\x64\x6d\x69\x6e\x5f\x6e\x6f\x74\151\x63\x65\x73", array($this, "\x6d\x6f\137\x73\x61\155\x6c\137\x73\165\143\x63\145\163\x73\137\x6d\x65\x73\x73\x61\147\x65"));
    }
    function plugin_settings_style($ye)
    {
        if (!("\164\157\x70\x6c\x65\166\x65\154\137\x70\x61\x67\145\137\x6d\x6f\x5f\x73\x61\x6d\x6c\137\163\x65\x74\x74\x69\x6e\147\163" != $ye && "\155\x69\x6e\151\x6f\162\141\156\147\x65\55\163\x61\155\x6c\x2d\62\55\60\x2d\163\163\x6f\137\x70\141\x67\145\137\x6d\157\x5f\155\x61\x6e\141\x67\145\137\154\x69\143\145\156\x73\x65" != $ye)) {
            goto Y3;
        }
        return;
        Y3:
        if (!(isset($_REQUEST["\x74\141\142"]) && $_REQUEST["\164\x61\x62"] == "\x6c\x69\x63\x65\x6e\x73\151\156\x67")) {
            goto ni;
        }
        wp_enqueue_style("\x6d\x6f\x5f\163\141\155\x6c\x5f\142\157\157\164\x73\164\x72\141\x70\137\143\x73\x73", plugins_url("\x69\x6e\143\154\x75\x64\x65\x73\57\143\x73\163\57\142\x6f\x6f\x74\163\164\x72\141\x70\x2f\142\157\x6f\x74\x73\x74\x72\141\x70\x2e\x6d\x69\156\56\143\x73\163", __FILE__), array(), mo_options_plugin_constants::Version, "\141\x6c\154");
        ni:
        wp_enqueue_style("\x6d\x6f\x5f\x73\141\x6d\154\x5f\x61\x64\155\x69\x6e\137\163\x65\164\164\x69\x6e\147\x73\137\x6a\x71\x75\145\x72\x79\137\163\164\x79\154\145", plugins_url("\151\x6e\143\x6c\165\144\145\163\x2f\x63\x73\x73\x2f\152\161\165\x65\162\x79\x2e\x75\151\56\143\163\163", __FILE__), array(), mo_options_plugin_constants::Version, "\x61\154\x6c");
        wp_enqueue_style("\155\157\x5f\163\141\x6d\x6c\137\141\x64\x6d\x69\156\x5f\163\x65\164\x74\x69\x6e\x67\163\x5f\x73\x74\x79\x6c\145\x5f\164\x72\x61\143\x6b\145\162", plugins_url("\151\x6e\143\x6c\165\x64\145\163\57\x63\163\163\57\x70\162\157\147\x72\145\163\x73\55\164\x72\141\143\153\x65\162\56\x63\x73\x73", __FILE__), array(), mo_options_plugin_constants::Version, "\x61\x6c\x6c");
        wp_enqueue_style("\x6d\x6f\137\163\x61\x6d\x6c\137\141\x64\155\151\x6e\137\x73\x65\x74\x74\x69\156\x67\163\x5f\163\x74\171\x6c\145", plugins_url("\151\x6e\x63\154\x75\144\x65\x73\57\x63\163\163\x2f\x73\x74\171\154\x65\137\x73\145\x74\x74\x69\156\x67\x73\x2e\x6d\151\156\56\143\x73\x73", __FILE__), array(), mo_options_plugin_constants::Version, "\141\154\x6c");
        wp_enqueue_style("\x6d\x6f\x5f\x73\141\x6d\x6c\137\x61\144\155\x69\x6e\137\x73\x65\x74\x74\x69\x6e\x67\163\137\x70\150\x6f\x6e\145\137\x73\164\x79\154\x65", plugins_url("\x69\156\143\x6c\x75\144\145\163\57\143\x73\x73\x2f\x70\150\x6f\x6e\x65\x2e\x6d\151\156\x2e\143\163\x73", __FILE__), array(), mo_options_plugin_constants::Version, "\141\154\x6c");
        wp_enqueue_style("\155\x6f\137\163\141\x6d\x6c\137\x77\x70\x62\55\146\x61", plugins_url("\151\156\143\x6c\165\144\145\x73\57\x63\x73\x73\x2f\x66\157\x6e\x74\x2d\x61\167\145\163\157\155\x65\x2e\155\151\156\x2e\x63\163\x73", __FILE__), array(), mo_options_plugin_constants::Version, "\141\154\154");
        wp_enqueue_style("\x6d\x6f\137\163\141\155\154\x5f\x6d\x61\156\x61\147\145\x5f\154\151\143\x65\x6e\163\145\x5f\163\x65\164\164\x69\x6e\x67\163\137\163\164\171\x6c\145", plugins_url("\114\151\x63\145\x6e\x73\145\125\x74\x69\x6c\163\57\x76\x69\x65\167\163\x2f\114\151\x63\145\156\x73\145\x56\x69\145\167\x2e\x63\x73\x73", __FILE__), array(), mo_options_plugin_constants::Version, "\141\x6c\154");
    }
    function plugin_settings_script($ye)
    {
        if (!("\x74\x6f\160\x6c\x65\166\145\x6c\137\160\141\x67\x65\137\x6d\x6f\x5f\163\141\x6d\x6c\137\163\x65\164\164\x69\156\x67\x73" != $ye && "\155\151\x6e\151\157\162\141\156\147\145\55\163\x61\x6d\x6c\x2d\62\55\60\x2d\163\163\157\x5f\x70\141\x67\x65\x5f\x6d\157\x5f\x6d\x61\156\x61\147\x65\137\154\151\143\145\x6e\163\x65" != $ye)) {
            goto hN;
        }
        return;
        hN:
        wp_enqueue_script("\152\x71\165\x65\162\x79");
        wp_enqueue_script("\155\x6f\x5f\163\141\x6d\154\137\x61\144\155\x69\156\x5f\x73\145\x74\164\x69\156\x67\163\137\x63\x6f\154\x6f\162\137\163\x63\162\x69\160\x74", plugins_url("\x69\156\x63\154\x75\x64\145\x73\57\152\x73\57\152\163\x63\157\x6c\x6f\162\x2f\152\163\x63\x6f\x6c\157\162\x2e\152\x73", __FILE__), array(), mo_options_plugin_constants::Version, false);
        wp_enqueue_script("\x6d\157\x5f\x73\x61\x6d\x6c\x5f\x61\144\155\151\156\x5f\x62\x6f\157\x74\x73\164\162\x61\x70\137\163\143\162\x69\160\x74", plugins_url("\151\156\x63\x6c\x75\144\x65\x73\x2f\x6a\x73\57\142\x6f\x6f\164\163\164\162\141\160\56\x6a\x73", __FILE__), array(), mo_options_plugin_constants::Version, false);
        wp_enqueue_script("\x6d\x6f\137\x73\141\x6d\154\x5f\141\144\155\x69\x6e\137\x73\x65\164\x74\151\x6e\x67\163\137\163\143\162\x69\160\164", plugins_url("\x69\156\143\x6c\x75\144\145\x73\57\x6a\x73\x2f\163\145\x74\x74\151\156\147\163\x2e\x6d\151\x6e\x2e\152\x73", __FILE__), array(), mo_options_plugin_constants::Version, false);
        wp_enqueue_script("\x6d\157\137\163\x61\155\x6c\x5f\x61\x64\x6d\151\x6e\137\163\145\164\x74\x69\x6e\x67\x73\137\160\x68\157\x6e\x65\x5f\163\x63\x72\151\160\164", plugins_url("\151\156\143\154\165\144\145\163\57\x6a\x73\57\160\150\157\x6e\x65\x2e\x6d\x69\x6e\x2e\x6a\163", __FILE__), array(), mo_options_plugin_constants::Version, false);
        if (!(isset($_REQUEST["\x74\x61\x62"]) && $_REQUEST["\x74\x61\x62"] == "\x6c\151\x63\x65\156\x73\151\156\147")) {
            goto u7;
        }
        wp_enqueue_script("\x6d\x6f\x5f\x73\141\x6d\154\137\155\x6f\x64\145\x72\x6e\x69\x7a\x72\x5f\163\143\162\151\160\x74", plugins_url("\151\156\143\154\x75\144\145\x73\57\152\163\x2f\x6d\157\144\x65\x72\156\x69\172\x72\56\x6a\x73", __FILE__), array(), mo_options_plugin_constants::Version, false);
        wp_enqueue_script("\x6d\x6f\137\x73\x61\x6d\154\137\x70\x6f\160\157\x76\x65\x72\x5f\x73\143\x72\151\160\x74", plugins_url("\x69\x6e\143\x6c\x75\144\x65\x73\x2f\152\163\x2f\142\157\157\x74\163\x74\x72\x61\160\57\x70\x6f\160\160\145\x72\x2e\x6d\151\156\56\x6a\x73", __FILE__), array(), mo_options_plugin_constants::Version, false);
        wp_enqueue_script("\155\157\x5f\x73\141\x6d\154\137\x62\157\157\x74\x73\164\x72\141\160\x5f\163\x63\x72\151\160\x74", plugins_url("\151\x6e\x63\154\165\144\x65\163\57\152\x73\x2f\142\157\x6f\164\163\164\x72\141\160\57\142\x6f\157\x74\x73\x74\162\141\x70\x2e\155\151\x6e\56\152\163", __FILE__), array(), mo_options_plugin_constants::Version, false);
        u7:
    }
    function mo_saml_activation_message()
    {
        $b2 = "\165\160\144\x61\x74\145\144";
        $AP = get_option("\155\x6f\137\163\141\155\x6c\x5f\x6d\145\x73\163\x61\147\x65");
        echo "\74\x64\x69\166\40\143\154\141\163\163\75\47" . $b2 . "\47\x3e\40\x3c\160\x3e" . $AP . "\74\x2f\x70\76\74\x2f\144\151\166\x3e";
    }
    function get_empty_strings()
    {
        return '';
    }
    function mo_saml_custom_attr_column($B8)
    {
        $XH = maybe_unserialize(get_option("\155\157\x5f\x73\141\x6d\x6c\137\x63\x75\x73\x74\157\x6d\x5f\x61\x74\x74\x72\x73\x5f\x6d\141\160\x70\151\156\x67"));
        $ob = get_option("\x73\x61\x6d\x6c\x5f\x73\150\157\167\137\165\163\x65\162\x5f\141\x74\164\x72\151\x62\165\x74\x65");
        $y_ = 0;
        if (!is_array($XH)) {
            goto lT;
        }
        foreach ($XH as $y9 => $nj) {
            if (empty($y9)) {
                goto jG;
            }
            if (!in_array($y_, $ob)) {
                goto z5;
            }
            $B8[$y9] = $y9;
            z5:
            jG:
            $y_++;
            aD:
        }
        WY:
        lT:
        return $B8;
    }
    function mo_saml_attr_column_content($pB, $SQ, $DT)
    {
        $XH = maybe_unserialize(get_option("\x6d\x6f\x5f\163\141\155\x6c\137\143\165\163\x74\x6f\155\x5f\141\164\164\x72\163\137\x6d\141\160\160\x69\156\x67"));
        if (!is_array($XH)) {
            goto BR;
        }
        foreach ($XH as $y9 => $nj) {
            if (!($y9 === $SQ)) {
                goto wD;
            }
            $fY = get_user_meta($DT, $SQ, false);
            if (empty($fY)) {
                goto gJ;
            }
            if (!is_array($fY[0])) {
                goto pi;
            }
            $ch = '';
            foreach ($fY[0] as $Wg) {
                $ch = $ch . $Wg;
                if (!next($fY[0])) {
                    goto Iq;
                }
                $ch = $ch . "\x20\x7c\x20";
                Iq:
                uT:
            }
            ol:
            return $ch;
            goto n1;
            pi:
            return $fY[0];
            n1:
            gJ:
            wD:
            TD:
        }
        jI:
        BR:
        return $pB;
    }
    static function mo_check_option_admin_referer($j5)
    {
        return isset($_POST["\157\160\164\x69\x6f\156"]) and $_POST["\157\160\164\151\x6f\156"] == $j5 and check_admin_referer($j5);
    }
    function miniorange_login_widget_saml_save_settings()
    {
        if (!current_user_can("\155\141\156\x61\x67\x65\x5f\x6f\160\164\151\x6f\156\x73")) {
            goto lJ;
        }
        if (!(is_admin() && get_option("\x41\143\164\151\166\141\x74\x65\x64\x5f\120\x6c\165\x67\x69\x6e") == "\x50\x6c\x75\x67\x69\156\55\123\154\x75\147")) {
            goto ZA;
        }
        delete_option("\x41\143\x74\151\166\141\x74\145\144\137\120\x6c\165\x67\151\156");
        update_option("\x6d\x6f\x5f\x73\x61\x6d\x6c\x5f\155\145\163\163\141\x67\x65", "\x47\157\40\164\x6f\40\x70\x6c\165\147\x69\156\40\74\x62\x3e\74\x61\40\150\x72\x65\x66\x3d\42\x61\x64\x6d\x69\156\56\x70\150\160\x3f\x70\141\147\145\75\x6d\x6f\x5f\x73\141\x6d\154\x5f\x73\x65\164\164\151\156\147\x73\42\76\163\145\164\164\151\x6e\147\x73\74\x2f\x61\76\74\x2f\142\x3e\x20\x74\x6f\40\143\157\156\x66\151\x67\x75\x72\145\40\x53\x41\x4d\x4c\40\123\x69\x6e\147\154\x65\x20\123\151\x67\156\40\117\x6e\40\x62\171\x20\x6d\x69\156\151\x4f\162\141\x6e\x67\145\56");
        add_action("\141\144\x6d\151\x6e\137\156\x6f\x74\x69\143\145\163", array($this, "\155\157\x5f\x73\x61\155\x6c\x5f\141\x63\x74\151\166\141\x74\151\157\156\x5f\x6d\x65\163\x73\x61\x67\x65"));
        ZA:
        lJ:
        if (!(isset($_POST["\157\160\x74\x69\x6f\156"]) && current_user_can("\x6d\x61\156\x61\x67\x65\137\157\x70\164\151\157\156\x73"))) {
            goto AF;
        }
        if (!self::mo_check_option_admin_referer("\x6d\x6f\x5f\155\x61\156\x61\x67\145\137\154\x69\143\x65\x6e\163\145")) {
            goto qB;
        }
        if (array_key_exists("\155\x6f\137\x65\156\141\x62\x6c\145\x5f\x6d\x75\154\x74\151\x70\154\145\137\154\151\x63\x65\x6e\x73\x65\163", $_POST)) {
            goto c8;
        }
        delete_option("\155\x6f\137\x65\156\x61\x62\154\x65\137\155\165\x6c\x74\x69\160\x6c\145\x5f\x6c\x69\143\145\x6e\163\x65\x73");
        goto AK;
        c8:
        update_option("\x6d\157\x5f\x65\x6e\x61\x62\154\x65\137\155\165\x6c\164\x69\160\154\x65\137\154\151\x63\145\x6e\163\145\163", "\143\x68\x65\x63\x6b\145\x64");
        initializeLicenseObjectArray();
        AK:
        update_option("\x6d\x6f\x5f\163\x61\155\x6c\137\155\145\x73\163\x61\147\x65", "\x43\x6f\x6e\146\151\147\165\x72\x61\x74\151\157\x6e\x20\163\141\x76\145\144\40\x73\165\143\143\x65\x73\x73\146\x75\x6c\x6c\x79");
        $this->mo_saml_show_success_message();
        qB:
        if (!self::mo_check_option_admin_referer("\155\x6f\x5f\141\x64\144\151\156\147\137\141\154\x74\145\x72\x6e\141\164\x65\x5f\145\x6e\166\151\x72\x6f\x6e\x6d\x65\156\164\x73")) {
            goto a9;
        }
        if (updateLicenseObjects($_POST)) {
            goto fA;
        }
        update_option("\155\157\x5f\163\141\155\x6c\x5f\x6d\x65\x73\x73\141\x67\x65", "\x59\x6f\165\x72\40\x63\x68\x61\156\x67\x65\x73\x20\167\145\162\145\x20\x6e\x6f\x74\x20\163\x61\166\145\x64\56\x20\120\154\x65\x61\163\x65\40\x70\x72\x6f\x76\x69\x64\145\40\x75\x6e\151\x71\x75\145\x20\x76\141\154\165\x65\x73\x20\146\x6f\x72\x20\x79\157\165\x72\x20\x65\156\166\x69\x72\157\156\x6d\x65\x6e\164\163\40\x61\x6e\144\40\x64\x6f\x6e\47\164\40\x72\145\x6d\157\x76\145\40\164\150\145\x20\143\165\162\x72\145\156\x74\x20\x65\156\166\151\x72\157\156\x6d\x65\156\164");
        $this->mo_saml_show_error_message();
        goto rY;
        fA:
        update_option("\x6d\157\x5f\x73\141\155\154\x5f\155\145\x73\163\141\147\x65", "\105\x6e\x76\151\162\x6f\x6e\x6d\145\156\164\x73\40\165\x70\144\141\164\x65\144\40\163\x75\143\143\145\163\163\146\165\154\154\171");
        $this->mo_saml_show_success_message();
        rY:
        a9:
        if (!self::mo_check_option_admin_referer("\155\x6f\137\143\150\x61\156\147\x65\137\x65\x6e\x76\x69\162\157\x6e\145\155\x74")) {
            goto eW;
        }
        update_option("\155\x6f\x5f\163\141\x6d\154\137\163\145\x6c\x65\x63\x74\145\144\x5f\x65\x6e\x76\x69\162\157\x6e\x6d\145\x6e\164", $_POST["\x65\x6e\166\x69\x72\157\x6e\x6d\x65\156\x74"]);
        update_option("\155\157\x5f\x73\x61\x6d\x6c\x5f\x6d\145\163\x73\x61\x67\x65", "\105\x6e\x76\151\x72\157\x6e\x6d\145\156\164\x20\143\x68\141\156\x67\x65\144\x20\163\x75\143\x63\145\163\163\146\165\x6c\x6c\x79");
        $this->mo_saml_show_success_message();
        eW:
        if (self::mo_check_option_admin_referer("\x6c\x6f\x67\151\156\x5f\167\151\144\147\x65\164\137\x73\141\x6d\154\x5f\163\x61\166\145\137\x73\145\x74\x74\151\156\x67\x73")) {
            goto V1;
        }
        if (self::mo_check_option_admin_referer("\x6c\x6f\x67\151\x6e\137\167\x69\x64\x67\145\164\x5f\x73\x61\x6d\x6c\137\141\164\164\x72\151\142\165\x74\x65\x5f\x6d\141\160\x70\x69\156\x67")) {
            goto Kg;
        }
        if (self::mo_check_option_admin_referer("\143\154\x65\x61\x72\137\x61\164\164\162\x73\x5f\x6c\151\163\x74")) {
            goto lo;
        }
        if (self::mo_check_option_admin_referer("\155\x6f\x5f\163\141\x6d\x6c\137\x61\x64\144\157\x6e\163\x5f\155\145\x73\x73\141\x67\145")) {
            goto pv;
        }
        if (self::mo_check_option_admin_referer("\154\x6f\x67\x69\x6e\x5f\167\x69\144\x67\145\x74\137\163\x61\x6d\x6c\137\x72\157\x6c\145\x5f\x6d\x61\160\x70\151\156\x67")) {
            goto Of;
        }
        if (self::mo_check_option_admin_referer("\163\141\x6d\x6c\137\146\157\x72\155\x5f\x64\x6f\155\x61\151\x6e\x5f\x72\x65\x73\x74\162\x69\x63\x74\x69\x6f\x6e\x5f\x6f\x70\164\x69\157\156")) {
            goto q7;
        }
        if (self::mo_check_option_admin_referer("\x6d\x6f\137\x73\x61\155\154\x5f\165\x70\x64\141\x74\145\x5f\x69\x64\x70\137\163\x65\x74\x74\151\x6e\x67\163\137\157\x70\x74\151\157\156")) {
            goto yv;
        }
        if (!self::mo_check_option_admin_referer("\x73\141\x6d\154\x5f\165\x70\154\157\x61\144\137\x6d\145\x74\141\x64\x61\x74\x61")) {
            goto HC;
        }
        if (preg_match("\x2f\x5e\134\x77\52\44\x2f", $_POST["\163\141\x6d\154\x5f\151\x64\145\156\164\151\x74\x79\137\x6d\x65\x74\141\x64\x61\x74\x61\x5f\160\x72\x6f\166\x69\x64\x65\x72"])) {
            goto lS;
        }
        update_option("\x6d\x6f\137\163\141\x6d\154\137\155\145\x73\x73\141\x67\145", "\120\x6c\145\x61\x73\145\40\155\x61\x74\x63\x68\x20\x74\150\145\40\162\145\161\x75\145\x73\x74\x65\144\x20\x66\157\162\x6d\x61\x74\40\146\157\162\x20\x49\x64\x65\x6e\x74\151\164\171\x20\120\162\x6f\x76\x69\x64\x65\x72\x20\116\141\155\145\56\x20\x4f\x6e\154\x79\40\x61\x6c\x70\x68\x61\x62\145\x74\x73\54\40\156\x75\x6d\142\x65\x72\x73\40\x61\156\x64\40\165\x6e\144\x65\162\x73\x63\157\162\145\x20\151\163\40\x61\154\x6c\157\167\145\144\x2e");
        $this->mo_saml_show_error_message();
        return;
        lS:
        if (!function_exists("\x77\160\137\x68\141\156\x64\154\x65\137\165\x70\x6c\157\x61\144")) {
            require_once ABSPATH . "\167\160\55\x61\144\x6d\151\x6e\x2f\151\156\x63\154\x75\x64\x65\x73\57\146\151\x6c\145\x2e\x70\150\x70";
        }
        $this->_handle_upload_metadata();
        HC:
        goto NH;
        yv:
        if (!(isset($_POST["\x6d\157\137\x73\141\x6d\154\137\x73\x70\x5f\x62\x61\x73\145\137\x75\162\154"]) && isset($_POST["\x6d\x6f\137\163\x61\155\x6c\x5f\163\160\137\x65\x6e\164\x69\x74\x79\137\151\x64"]))) {
            goto ie;
        }
        $uW = htmlspecialchars($_POST["\155\x6f\x5f\x73\141\x6d\x6c\137\x73\160\137\x62\x61\x73\145\x5f\x75\162\x6c"]);
        $Hq = htmlspecialchars($_POST["\155\157\137\x73\x61\x6d\154\137\x73\160\137\x65\x6e\164\x69\164\x79\137\x69\144"]);
        if (!(substr($uW, -1) == "\x2f")) {
            goto hz;
        }
        $uW = substr($uW, 0, -1);
        hz:
        update_option("\x6d\157\x5f\163\141\x6d\154\x5f\x73\160\x5f\x62\141\163\x65\x5f\x75\162\154", $uW);
        update_option("\x6d\x6f\x5f\x73\x61\155\154\x5f\x73\x70\137\145\x6e\x74\x69\164\171\x5f\x69\x64", $Hq);
        ie:
        update_option("\155\157\137\163\141\x6d\154\137\155\x65\x73\163\141\147\x65", "\x53\x65\x74\x74\x69\156\x67\x73\40\x75\160\x64\141\164\145\x64\x20\x73\x75\143\x63\x65\x73\163\x66\165\x6c\154\x79\x2e");
        $this->mo_saml_show_success_message();
        NH:
        goto nq;
        q7:
        $di = LicenseHelper::getSelectedEnvironment();
        mo_save_environment_settings($_POST);
        if (!($di and $di != LicenseHelper::getCurrentEnvironment())) {
            goto Kk;
        }
        return;
        Kk:
        $YD = isset($_POST["\155\157\x5f\163\x61\x6d\x6c\137\x65\156\141\x62\154\x65\x5f\x64\157\155\x61\x69\x6e\137\x72\145\163\x74\162\151\x63\x74\x69\x6f\156\137\154\157\147\x69\x6e"]) && !empty($_POST["\x6d\157\137\163\x61\155\x6c\137\145\156\141\x62\x6c\x65\x5f\144\157\155\x61\151\156\x5f\162\145\163\x74\162\151\x63\x74\151\x6f\156\137\154\x6f\147\x69\x6e"]) ? htmlspecialchars($_POST["\x6d\157\x5f\163\x61\x6d\x6c\x5f\x65\x6e\141\142\x6c\145\137\144\157\155\x61\x69\156\137\162\x65\x73\164\162\x69\143\164\x69\x6f\x6e\x5f\154\157\147\x69\156"]) : '';
        $m1 = isset($_POST["\155\x6f\137\x73\141\x6d\154\137\x61\x6c\154\157\x77\x5f\x64\145\156\171\x5f\165\x73\145\x72\x5f\167\x69\x74\x68\x5f\x64\157\x6d\x61\151\156"]) && !empty($_POST["\155\157\137\x73\141\x6d\x6c\x5f\x61\x6c\x6c\157\x77\137\x64\x65\156\x79\x5f\x75\163\145\x72\137\167\151\164\x68\137\144\157\x6d\x61\x69\x6e"]) ? htmlspecialchars($_POST["\155\157\x5f\x73\x61\155\x6c\137\x61\154\x6c\x6f\x77\x5f\144\x65\156\x79\137\165\x73\145\162\x5f\x77\x69\x74\150\x5f\x64\157\x6d\141\151\156"]) : "\x61\154\154\157\x77";
        $yS = isset($_POST["\163\141\155\154\x5f\x61\x6d\x5f\x65\155\141\151\x6c\x5f\144\x6f\x6d\x61\151\x6e\x73"]) && !empty($_POST["\x73\x61\155\154\x5f\141\155\137\x65\155\x61\x69\154\x5f\x64\x6f\x6d\x61\151\156\163"]) ? htmlspecialchars($_POST["\x73\x61\x6d\154\x5f\141\x6d\137\x65\155\x61\151\154\x5f\144\157\x6d\x61\x69\156\x73"]) : '';
        update_option("\155\157\x5f\163\141\x6d\x6c\137\145\156\x61\x62\154\145\x5f\x64\x6f\x6d\x61\151\156\137\x72\x65\x73\164\x72\151\x63\164\x69\157\156\137\x6c\157\x67\151\156", $YD);
        update_option("\155\157\137\163\x61\155\x6c\x5f\141\154\x6c\157\167\x5f\x64\x65\x6e\x79\137\x75\163\145\162\137\x77\x69\164\150\x5f\144\x6f\155\141\x69\x6e", $m1);
        update_option("\x73\x61\x6d\x6c\137\x61\x6d\x5f\145\x6d\x61\151\154\137\x64\x6f\155\x61\x69\x6e\163", $yS);
        update_option("\x6d\x6f\x5f\163\x61\x6d\x6c\x5f\x6d\145\163\163\x61\x67\x65", "\x44\157\155\141\151\156\x20\122\x65\x73\164\x72\x69\x63\x74\151\x6f\x6e\x20\150\x61\x73\x20\142\145\x65\156\40\x73\141\166\x65\144\x20\x73\x75\143\x63\x65\x73\x73\x66\x75\154\x6c\171\56");
        $this->mo_saml_show_success_message();
        nq:
        goto yE;
        Of:
        $di = LicenseHelper::getSelectedEnvironment();
        mo_save_environment_settings($_POST);
        if (!($di and $di != LicenseHelper::getCurrentEnvironment())) {
            goto Ka;
        }
        return;
        Ka:
        if (mo_saml_is_extension_installed("\143\165\x72\154")) {
            goto rj;
        }
        update_option("\x6d\x6f\x5f\163\141\x6d\x6c\x5f\155\x65\x73\163\141\147\x65", "\x45\122\122\x4f\x52\x3a\40\120\110\120\x20\143\x55\122\114\x20\145\170\164\x65\x6e\x73\151\x6f\x6e\x20\x69\163\40\x6e\157\x74\x20\x69\156\163\164\141\154\154\145\144\40\x6f\x72\x20\x64\x69\163\x61\x62\154\x65\x64\x2e\x20\123\x61\166\145\x20\x52\157\154\145\x20\x4d\x61\x70\160\x69\156\x67\40\x66\x61\x69\154\x65\x64\56");
        $this->mo_saml_show_error_message();
        return;
        rj:
        if (!isset($_POST["\163\x61\155\154\137\141\x6d\137\x64\145\146\x61\165\x6c\164\137\x75\x73\x65\x72\137\x72\157\x6c\145"])) {
            goto bS;
        }
        $iN = htmlspecialchars($_POST["\x73\x61\x6d\154\x5f\x61\x6d\137\144\x65\x66\141\x75\x6c\164\x5f\x75\163\x65\162\x5f\x72\x6f\x6c\x65"]);
        update_option("\x73\141\x6d\x6c\x5f\141\155\x5f\x64\x65\146\141\165\x6c\164\137\x75\x73\x65\x72\x5f\x72\x6f\x6c\x65", $iN);
        bS:
        if (isset($_POST["\163\x61\155\x6c\x5f\x61\x6d\137\144\157\x6e\164\x5f\x61\154\x6c\157\167\137\x75\x6e\x6c\x69\x73\x74\x65\x64\x5f\165\x73\x65\x72\137\162\x6f\x6c\145"])) {
            goto wd;
        }
        update_option("\x73\141\x6d\x6c\x5f\141\155\x5f\x64\x6f\156\164\x5f\x61\154\x6c\157\167\x5f\x75\156\154\151\x73\164\145\144\x5f\x75\x73\x65\162\137\162\157\x6c\x65", "\165\156\143\150\145\143\153\x65\x64");
        goto BD;
        wd:
        update_option("\163\141\x6d\154\x5f\141\x6d\137\x64\x65\146\x61\x75\154\164\137\165\163\145\162\x5f\x72\x6f\154\145", false);
        update_option("\x73\141\155\154\137\141\155\x5f\144\x6f\x6e\x74\x5f\141\154\x6c\157\167\x5f\x75\x6e\x6c\x69\x73\164\x65\144\x5f\165\163\145\162\x5f\162\157\x6c\x65", "\x63\x68\x65\143\x6b\x65\144");
        BD:
        if (isset($_POST["\155\x6f\137\x73\141\x6d\154\x5f\x64\157\156\x74\137\143\x72\145\x61\x74\x65\137\165\x73\145\x72\x5f\x69\146\137\162\x6f\154\x65\x5f\156\x6f\164\x5f\155\x61\160\160\x65\x64"])) {
            goto qo;
        }
        update_option("\155\x6f\137\163\x61\155\154\x5f\x64\157\x6e\164\x5f\143\162\145\141\164\145\137\x75\x73\145\162\137\x69\146\x5f\162\157\154\x65\x5f\156\157\x74\137\x6d\x61\x70\x70\x65\x64", "\165\x6e\143\150\x65\143\x6b\x65\144");
        goto ip;
        qo:
        update_option("\x6d\x6f\x5f\163\141\x6d\x6c\x5f\x64\x6f\x6e\x74\137\143\x72\145\141\x74\145\x5f\165\x73\145\x72\137\151\x66\137\162\157\154\145\x5f\156\x6f\164\x5f\155\141\160\160\145\x64", "\x63\150\x65\x63\x6b\145\144");
        update_option("\x73\141\x6d\154\137\141\155\x5f\144\x65\146\x61\x75\x6c\x74\137\165\x73\x65\162\137\x72\x6f\154\x65", false);
        update_option("\163\141\x6d\154\x5f\141\x6d\137\x64\157\x6e\x74\x5f\141\x6c\x6c\157\x77\137\x75\156\154\x69\x73\164\145\144\x5f\165\163\145\162\137\x72\x6f\154\x65", "\165\x6e\x63\x68\145\143\x6b\x65\144");
        ip:
        if (isset($_POST["\x6d\157\137\163\x61\155\x6c\137\x64\157\156\164\137\x75\x70\144\x61\x74\x65\x5f\x65\170\151\x73\164\x69\x6e\147\137\x75\163\x65\162\x5f\x72\157\x6c\145"])) {
            goto Nw;
        }
        update_option("\x73\141\155\x6c\137\141\155\x5f\x64\157\156\164\x5f\165\x70\144\141\x74\x65\137\x65\x78\x69\x73\x74\x69\x6e\147\x5f\x75\x73\x65\162\137\162\x6f\x6c\145", "\x75\156\x63\x68\145\143\153\x65\144");
        goto K9;
        Nw:
        update_option("\x73\x61\155\154\x5f\x61\155\137\x64\x6f\156\x74\137\165\x70\x64\x61\x74\145\x5f\145\x78\151\x73\x74\x69\156\147\x5f\165\163\x65\x72\137\x72\x6f\x6c\x65", "\143\150\x65\143\153\x65\x64");
        update_option("\163\141\x6d\154\x5f\141\x6d\x5f\x75\160\144\141\x74\x65\x5f\141\144\155\151\156\137\165\163\x65\x72\x73\137\162\x6f\x6c\145", "\x75\156\143\150\x65\143\153\x65\144");
        K9:
        if (isset($_POST["\x6d\157\x5f\163\x61\x6d\x6c\137\165\160\x64\x61\164\x65\x5f\x61\144\x6d\151\156\x5f\165\163\145\162\163\x5f\162\x6f\154\x65"])) {
            goto hU;
        }
        update_option("\163\x61\155\154\x5f\x61\155\x5f\x75\160\144\x61\164\x65\x5f\141\144\x6d\x69\156\137\x75\x73\x65\x72\163\137\162\157\154\x65", "\165\x6e\143\150\x65\143\x6b\x65\144");
        goto eU;
        hU:
        update_option("\163\141\155\x6c\137\x61\155\x5f\x75\x70\x64\x61\x74\145\137\141\144\155\x69\x6e\137\165\163\x65\162\163\137\162\157\x6c\145", "\x63\150\145\143\x6b\145\144");
        eU:
        if (isset($_POST["\x6d\157\137\163\141\x6d\154\x5f\144\157\x6e\164\137\x61\x6c\154\157\167\x5f\165\163\145\162\137\x74\x6f\x6c\x6f\147\151\x6e\137\x63\162\145\x61\x74\x65\137\167\x69\164\x68\137\147\151\166\x65\156\137\147\162\x6f\x75\x70\x73"])) {
            goto x4;
        }
        update_option("\163\x61\155\x6c\x5f\141\x6d\x5f\144\x6f\156\164\x5f\141\x6c\154\x6f\167\x5f\165\x73\x65\162\137\x74\x6f\x6c\x6f\147\x69\x6e\x5f\143\162\x65\x61\x74\145\x5f\x77\151\164\150\x5f\147\151\x76\x65\156\137\x67\162\x6f\165\160\163", "\x75\x6e\x63\150\x65\143\153\x65\144");
        goto UI;
        x4:
        update_option("\163\x61\155\154\137\x61\155\137\x64\157\156\164\x5f\x61\x6c\x6c\157\167\x5f\165\x73\145\162\137\164\157\154\x6f\x67\151\156\x5f\x63\162\x65\141\164\145\137\167\151\x74\150\137\147\x69\166\x65\156\137\x67\x72\157\165\x70\163", "\x63\150\145\143\153\145\x64");
        if (!isset($_POST["\155\157\137\x73\141\155\x6c\x5f\162\145\163\164\x72\151\143\164\x5f\x75\163\145\162\163\x5f\167\151\164\x68\137\x67\x72\x6f\165\160\x73"])) {
            goto C9;
        }
        if (!empty($_POST["\155\x6f\x5f\163\141\155\x6c\x5f\162\145\x73\x74\x72\x69\x63\164\137\x75\163\145\x72\x73\137\x77\151\164\x68\137\147\x72\x6f\x75\x70\x73"])) {
            goto rU;
        }
        update_option("\x6d\157\137\x73\141\155\154\137\x72\x65\x73\164\162\151\x63\x74\x5f\165\163\145\162\163\137\167\x69\164\x68\137\x67\x72\157\x75\160\x73", '');
        goto uv;
        rU:
        update_option("\x6d\157\x5f\163\141\x6d\154\x5f\162\145\x73\x74\162\151\143\164\137\165\x73\x65\x72\163\x5f\x77\x69\x74\150\137\147\x72\157\165\160\163", htmlspecialchars(stripslashes($_POST["\x6d\157\137\163\141\x6d\x6c\137\162\x65\x73\x74\162\151\x63\x74\137\x75\163\145\x72\x73\x5f\x77\x69\164\x68\137\x67\162\x6f\165\x70\163"])));
        uv:
        C9:
        UI:
        $wp_roles = new WP_Roles();
        $Iu = $wp_roles->get_names();
        $XK = array();
        foreach ($Iu as $Jt => $ip) {
            $TU = "\163\x61\155\x6c\x5f\x61\155\137\147\x72\157\x75\160\137\x61\x74\164\x72\137\x76\141\x6c\x75\145\163\x5f" . $Jt;
            $XK[$Jt] = htmlspecialchars(stripslashes($_POST[$TU]));
            nx:
        }
        Nq:
        update_option("\x73\141\155\154\x5f\141\x6d\x5f\162\157\154\145\137\x6d\141\x70\x70\x69\x6e\x67", $XK);
        update_option("\155\x6f\137\163\x61\155\x6c\137\155\145\x73\163\x61\x67\145", "\122\x6f\x6c\145\40\115\x61\160\x70\151\156\x67\x20\x64\x65\164\141\151\154\163\x20\163\x61\166\x65\x64\x20\x73\x75\143\143\145\x73\163\x66\x75\x6c\x6c\x79\56");
        $this->mo_saml_show_success_message();
        yE:
        goto ec;
        pv:
        update_option("\x6d\x6f\137\163\x61\155\154\137\163\150\x6f\167\x5f\141\x64\144\x6f\x6e\163\137\x6e\x6f\x74\x69\x63\145", 1);
        ec:
        goto qa;
        lo:
        delete_option("\x6d\157\137\x73\x61\155\154\x5f\x74\145\163\164\x5f\143\157\156\146\x69\x67\137\141\x74\x74\162\163");
        update_option("\x6d\157\x5f\x73\141\155\154\x5f\155\x65\x73\163\141\x67\x65", "\x41\164\x74\162\x69\x62\x75\164\x65\x73\40\x6c\151\x73\164\40\x72\x65\155\x6f\x76\145\144\x20\163\x75\x63\143\145\163\x73\x66\165\154\154\171");
        $this->mo_saml_show_success_message();
        qa:
        goto TO;
        Kg:
        if (mo_saml_is_extension_installed("\143\x75\162\x6c")) {
            goto c2;
        }
        update_option("\x6d\157\x5f\163\x61\x6d\x6c\x5f\155\145\163\163\141\x67\145", "\x45\x52\122\x4f\122\x3a\40\120\x48\x50\x20\143\x55\x52\114\x20\145\x78\x74\145\156\163\151\x6f\x6e\x20\x69\x73\40\x6e\x6f\164\x20\x69\x6e\x73\164\141\x6c\154\145\x64\40\x6f\162\x20\144\x69\x73\141\x62\154\145\x64\56\40\123\141\166\145\40\101\164\x74\162\151\142\165\x74\x65\40\115\141\x70\x70\x69\x6e\147\40\x66\141\151\154\x65\x64\x2e");
        $this->mo_saml_show_error_message();
        return;
        c2:
        $di = LicenseHelper::getSelectedEnvironment();
        mo_save_environment_settings($_POST);
        if (!($di and $di != LicenseHelper::getCurrentEnvironment())) {
            goto ee;
        }
        return;
        ee:
        update_option("\x73\141\x6d\x6c\137\x61\x6d\137\165\x73\x65\x72\156\x61\x6d\145", htmlspecialchars(stripslashes($_POST["\x73\141\155\x6c\137\141\155\x5f\x75\163\x65\x72\156\141\155\x65"])));
        update_option("\163\141\155\154\x5f\x61\x6d\x5f\145\155\x61\151\x6c", htmlspecialchars(stripslashes($_POST["\163\x61\155\154\137\141\x6d\137\x65\155\x61\x69\x6c"])));
        update_option("\x73\141\155\x6c\x5f\141\155\x5f\x66\151\162\163\164\x5f\x6e\141\155\145", htmlspecialchars(stripslashes($_POST["\163\141\155\154\137\141\155\x5f\146\x69\x72\x73\x74\x5f\156\x61\x6d\145"])));
        update_option("\x73\141\x6d\154\x5f\141\x6d\x5f\x6c\141\x73\x74\x5f\x6e\141\x6d\x65", htmlspecialchars(stripslashes($_POST["\x73\x61\155\154\137\141\155\137\154\x61\163\x74\137\156\x61\x6d\145"])));
        update_option("\x73\141\155\x6c\137\141\155\x5f\x67\x72\157\165\x70\137\x6e\x61\x6d\145", htmlspecialchars(stripslashes($_POST["\163\141\x6d\x6c\137\141\x6d\x5f\147\162\157\x75\160\x5f\156\x61\x6d\145"])));
        update_option("\163\x61\x6d\x6c\137\x61\x6d\137\x64\x69\163\160\x6c\141\171\x5f\x6e\141\155\145", htmlspecialchars(stripslashes($_POST["\163\141\x6d\x6c\137\x61\155\137\x64\x69\163\160\154\141\171\x5f\x6e\141\155\x65"])));
        $XH = array();
        $WI = array();
        $JZ = array();
        $Aa = array();
        if (!(isset($_POST["\155\157\x5f\163\x61\x6d\154\x5f\x63\165\x73\164\x6f\x6d\137\x61\x74\x74\162\151\x62\x75\x74\x65\x5f\153\145\x79\x73"]) && !empty($_POST["\x6d\x6f\137\x73\141\x6d\154\137\143\x75\163\x74\157\x6d\x5f\x61\x74\x74\x72\151\142\165\164\145\x5f\x6b\x65\171\163"]))) {
            goto A7;
        }
        $WI = $_POST["\x6d\x6f\137\163\141\x6d\154\137\143\165\x73\164\x6f\x6d\137\x61\x74\164\x72\x69\x62\165\164\x65\137\x6b\x65\171\163"];
        A7:
        if (!(isset($_POST["\155\x6f\x5f\x73\141\155\154\137\x63\x75\163\x74\157\155\x5f\141\x74\x74\x72\x69\142\x75\164\145\137\166\141\x6c\165\145\x73"]) && !empty($_POST["\155\157\x5f\x73\x61\x6d\154\137\x63\x75\x73\164\x6f\155\137\x61\x74\164\x72\x69\142\165\x74\x65\137\x76\x61\154\x75\145\163"]))) {
            goto iS;
        }
        $JZ = $_POST["\155\157\137\x73\141\x6d\154\137\x63\x75\x73\x74\157\x6d\x5f\x61\164\164\x72\151\x62\x75\164\x65\137\x76\141\154\x75\x65\163"];
        iS:
        $gP = count($WI);
        if (!($gP > 0)) {
            goto Rd;
        }
        $WI = array_map("\150\x74\x6d\x6c\x73\160\145\x63\151\141\x6c\143\150\x61\162\x73", $WI);
        $JZ = array_map("\150\x74\x6d\154\x73\x70\145\143\x69\x61\x6c\143\x68\141\162\163", $JZ);
        $DU = 0;
        MK:
        if (!($DU < $gP)) {
            goto Gh;
        }
        if (!(isset($_POST["\x6d\157\137\163\141\155\154\137\x64\151\163\160\154\x61\x79\137\x61\164\x74\162\151\142\165\x74\x65\137" . $DU]) && !empty($_POST["\x6d\157\x5f\x73\x61\155\x6c\x5f\144\x69\163\x70\x6c\x61\x79\x5f\x61\x74\x74\162\x69\x62\x75\x74\145\x5f" . $DU]))) {
            goto Ac;
        }
        array_push($Aa, $DU);
        Ac:
        $DU++;
        goto MK;
        Gh:
        Rd:
        update_option("\163\x61\x6d\154\137\163\150\x6f\167\137\165\x73\145\x72\137\x61\x74\164\x72\x69\142\x75\x74\145", $Aa);
        $XH = array_combine($WI, $JZ);
        $XH = array_filter($XH);
        if (!empty($XH)) {
            goto Px;
        }
        $XH = get_option("\155\x6f\x5f\163\x61\155\x6c\137\x63\165\163\164\157\x6d\137\x61\x74\x74\162\x73\137\155\x61\x70\160\x69\156\x67");
        if (empty($XH)) {
            goto bM;
        }
        delete_option("\155\157\x5f\163\141\x6d\x6c\137\143\x75\163\x74\x6f\x6d\137\x61\x74\x74\162\163\137\x6d\x61\x70\x70\x69\156\x67");
        bM:
        goto g3;
        Px:
        update_option("\155\157\x5f\x73\x61\155\x6c\137\143\165\163\164\157\x6d\x5f\x61\x74\x74\162\x73\x5f\155\x61\x70\x70\151\156\x67", $XH);
        g3:
        update_option("\155\157\x5f\x73\141\155\x6c\137\x6d\145\163\163\x61\147\145", "\x41\164\x74\162\151\142\165\164\145\x20\x4d\141\x70\x70\151\156\x67\x20\144\145\164\x61\x69\x6c\163\40\163\x61\x76\x65\144\x20\163\x75\143\143\x65\x73\x73\x66\165\x6c\154\171");
        $this->mo_saml_show_success_message();
        TO:
        goto mG;
        V1:
        if (mo_saml_is_extension_installed("\143\165\162\x6c")) {
            goto q6;
        }
        update_option("\155\157\137\163\x61\155\x6c\x5f\155\145\x73\163\141\x67\x65", "\105\x52\x52\x4f\x52\x3a\40\x50\110\120\40\x63\125\122\x4c\40\145\x78\x74\x65\156\x73\151\x6f\156\40\x69\x73\40\156\x6f\x74\x20\x69\156\x73\164\x61\154\x6c\145\x64\40\x6f\162\40\144\151\163\x61\x62\154\145\144\56\40\x53\x61\166\145\x20\x49\x64\x65\x6e\164\151\164\171\x20\120\162\157\166\151\x64\145\x72\40\x43\x6f\x6e\x66\151\x67\165\162\141\164\151\x6f\x6e\x20\146\141\151\x6c\x65\x64\56");
        $this->mo_saml_show_error_message();
        return;
        q6:
        $di = LicenseHelper::getSelectedEnvironment();
        mo_save_environment_settings($_POST);
        if (!($di and $di != LicenseHelper::getCurrentEnvironment())) {
            goto Eg;
        }
        return;
        Eg:
        $gY = '';
        $Yi = '';
        $le = '';
        $bN = '';
        $wW = '';
        $EE = '';
        $FL = '';
        $wK = '';
        $AS = '';
        if ($this->mo_saml_check_empty_or_null($_POST["\163\141\155\154\x5f\x69\144\145\x6e\164\151\164\x79\x5f\x6e\141\155\x65"]) || $this->mo_saml_check_empty_or_null($_POST["\163\x61\x6d\x6c\x5f\x6c\157\x67\x69\156\x5f\x75\x72\x6c"]) || $this->mo_saml_check_empty_or_null($_POST["\163\x61\155\154\137\x69\x73\x73\165\145\162"]) || $this->mo_saml_check_empty_or_null($_POST["\163\141\x6d\x6c\x5f\156\141\x6d\x65\151\144\x5f\x66\x6f\x72\x6d\x61\x74"])) {
            goto bR;
        }
        if (!preg_match("\x2f\x5e\134\x77\x2a\x24\57", $_POST["\x73\141\x6d\154\x5f\x69\144\x65\x6e\x74\151\164\171\x5f\x6e\x61\x6d\145"])) {
            goto VR;
        }
        $gY = htmlspecialchars(trim($_POST["\x73\141\155\x6c\x5f\151\x64\x65\156\x74\151\x74\x79\137\156\141\x6d\x65"]));
        $le = htmlspecialchars(trim($_POST["\163\141\155\x6c\137\154\157\147\x69\156\x5f\x75\162\x6c"]));
        if (!array_key_exists("\x73\x61\x6d\x6c\x5f\154\x6f\x67\151\x6e\137\142\151\x6e\x64\151\156\147\x5f\164\171\x70\x65", $_POST)) {
            goto qF;
        }
        $Yi = htmlspecialchars($_POST["\x73\141\x6d\154\x5f\x6c\157\x67\151\156\x5f\142\151\156\144\151\156\147\x5f\x74\x79\x70\145"]);
        qF:
        if (!array_key_exists("\163\141\155\x6c\137\154\157\x67\157\165\x74\137\142\151\x6e\x64\x69\x6e\147\x5f\x74\171\x70\145", $_POST)) {
            goto BG;
        }
        $bN = htmlspecialchars($_POST["\x73\x61\x6d\154\x5f\154\x6f\147\x6f\165\x74\x5f\x62\151\x6e\144\151\x6e\147\137\x74\x79\x70\145"]);
        BG:
        if (!array_key_exists("\163\141\x6d\x6c\x5f\154\157\x67\157\165\x74\137\165\x72\x6c", $_POST)) {
            goto Wl;
        }
        $wW = htmlspecialchars(trim($_POST["\x73\141\x6d\154\137\x6c\157\x67\157\165\x74\137\x75\x72\154"]));
        Wl:
        $EE = htmlspecialchars(trim($_POST["\x73\141\155\x6c\137\x69\163\163\165\x65\162"]));
        if (!array_key_exists("\155\157\x5f\163\141\155\154\137\x69\144\x65\x6e\x74\x69\164\x79\137\x70\162\157\x76\x69\x64\x65\x72\137\x69\144\x65\156\164\151\x66\x69\145\x72\137\156\141\x6d\x65", $_POST)) {
            goto ml;
        }
        $gw = htmlspecialchars($_POST["\155\x6f\x5f\163\x61\155\154\137\x69\x64\x65\156\x74\151\164\171\x5f\x70\162\x6f\166\151\x64\145\x72\x5f\151\x64\145\x6e\164\x69\146\151\x65\162\x5f\x6e\x61\155\x65"]);
        update_option("\155\x6f\137\x73\141\x6d\154\x5f\x69\x64\x65\x6e\164\x69\x74\171\137\x70\x72\157\166\x69\x64\x65\162\137\151\144\145\x6e\164\151\146\151\145\x72\x5f\156\141\155\x65", $gw);
        ml:
        $FL = $_POST["\x73\141\x6d\154\x5f\170\x35\x30\x39\137\x63\x65\x72\164\x69\x66\x69\x63\x61\x74\x65"];
        $AS = htmlspecialchars($_POST["\163\x61\x6d\x6c\137\x6e\141\x6d\x65\151\144\x5f\146\x6f\162\x6d\141\164"]);
        goto y_;
        VR:
        update_option("\x6d\157\137\163\x61\x6d\x6c\137\155\x65\x73\163\141\147\145", "\x50\154\x65\x61\163\x65\40\x6d\x61\164\143\x68\40\x74\x68\145\40\x72\x65\161\165\x65\x73\x74\x65\x64\40\x66\x6f\x72\x6d\141\x74\x20\x66\x6f\x72\x20\111\x64\x65\156\164\x69\164\171\40\x50\162\157\166\x69\x64\x65\x72\40\x4e\x61\x6d\x65\x2e\x20\x4f\x6e\x6c\x79\x20\x61\154\x70\x68\x61\142\145\x74\163\x2c\40\x6e\165\155\x62\x65\162\163\x20\x61\156\144\x20\x75\x6e\144\145\162\163\143\x6f\x72\x65\40\x69\x73\x20\x61\x6c\154\157\x77\145\x64\56");
        $this->mo_saml_show_error_message();
        return;
        y_:
        goto XJ;
        bR:
        update_option("\x6d\157\x5f\163\x61\x6d\154\137\x6d\x65\163\163\x61\x67\145", "\101\154\x6c\40\164\150\x65\x20\x66\x69\145\x6c\x64\163\x20\141\x72\145\x20\162\145\161\x75\x69\x72\x65\x64\x2e\x20\x50\x6c\x65\x61\x73\x65\40\x65\156\164\x65\x72\x20\166\141\x6c\151\x64\40\x65\x6e\x74\x72\151\145\163\x2e");
        $this->mo_saml_show_error_message();
        return;
        XJ:
        update_option("\x73\x61\x6d\154\137\151\x64\145\156\x74\x69\x74\171\137\156\x61\x6d\145", $gY);
        update_option("\x73\141\155\x6c\137\154\x6f\147\151\x6e\x5f\142\x69\x6e\144\x69\x6e\x67\x5f\x74\171\x70\145", $Yi);
        update_option("\x73\141\155\x6c\x5f\x6c\x6f\x67\x69\156\x5f\x75\162\x6c", $le);
        update_option("\163\141\x6d\154\137\154\157\147\x6f\165\x74\x5f\142\x69\x6e\144\x69\156\147\x5f\164\x79\160\145", $bN);
        update_option("\163\x61\x6d\154\x5f\154\x6f\147\157\x75\x74\x5f\165\x72\154", $wW);
        update_option("\x73\141\x6d\x6c\x5f\x69\x73\163\165\x65\x72", $EE);
        update_option("\x73\x61\155\154\137\x6e\141\155\x65\x69\x64\x5f\146\157\162\155\141\x74", $AS);
        if (isset($_POST["\x73\141\x6d\x6c\137\x72\x65\161\165\x65\163\x74\137\x73\x69\147\x6e\145\x64"])) {
            goto Za;
        }
        update_option("\163\141\x6d\x6c\x5f\162\145\161\165\145\163\164\x5f\x73\151\147\156\145\x64", "\165\156\143\150\145\x63\153\x65\144");
        goto hl;
        Za:
        update_option("\163\x61\x6d\x6c\137\162\x65\x71\x75\x65\163\164\x5f\x73\x69\147\x6e\x65\x64", "\x63\150\145\143\x6b\145\144");
        hl:
        foreach ($FL as $y9 => $nj) {
            if (empty($nj)) {
                goto dm;
            }
            $FL[$y9] = SAMLSPUtilities::sanitize_certificate($nj);
            if (@openssl_x509_read($FL[$y9])) {
                goto OM;
            }
            update_option("\x6d\157\x5f\163\x61\155\x6c\137\155\x65\x73\x73\141\x67\145", "\111\156\x76\141\154\x69\x64\40\143\x65\x72\164\151\x66\x69\143\141\x74\x65\72\40\120\154\145\x61\163\145\x20\x70\x72\x6f\x76\x69\x64\145\40\141\40\x76\141\154\x69\x64\40\x63\145\x72\164\x69\x66\x69\143\141\164\145\x2e");
            $this->mo_saml_show_error_message();
            delete_option("\x73\x61\155\154\x5f\170\65\x30\71\x5f\143\145\x72\164\151\x66\x69\x63\x61\x74\x65");
            return;
            OM:
            goto u1;
            dm:
            unset($FL[$y9]);
            u1:
            U_:
        }
        Js:
        if (!empty($FL)) {
            goto Dq;
        }
        update_option("\155\157\x5f\163\x61\155\x6c\x5f\x6d\x65\x73\163\x61\147\x65", "\x49\x6e\x76\x61\154\x69\144\40\x43\x65\162\x74\x69\x66\151\143\x61\x74\x65\x3a\120\x6c\145\x61\x73\x65\x20\x70\162\x6f\166\151\144\145\40\141\40\x63\x65\x72\164\x69\x66\x69\143\x61\x74\145");
        $this->mo_saml_show_error_message();
        return;
        Dq:
        update_option("\163\141\155\x6c\137\170\65\60\71\137\x63\x65\x72\164\151\146\x69\x63\x61\x74\145", maybe_serialize($FL));
        if (isset($_POST["\163\141\x6d\x6c\x5f\162\145\163\x70\x6f\x6e\163\145\137\163\x69\x67\x6e\145\x64"])) {
            goto hf;
        }
        update_option("\163\141\155\x6c\x5f\x72\x65\x73\160\157\156\x73\x65\x5f\x73\x69\x67\x6e\145\144", "\x59\145\163");
        goto PV;
        hf:
        update_option("\163\141\155\x6c\x5f\162\x65\x73\160\x6f\156\163\x65\x5f\x73\151\147\x6e\145\144", "\x63\x68\x65\143\x6b\x65\144");
        PV:
        if (isset($_POST["\x73\x61\x6d\x6c\137\141\163\x73\145\x72\x74\151\157\x6e\x5f\x73\151\x67\x6e\145\x64"])) {
            goto NK;
        }
        update_option("\163\x61\x6d\x6c\x5f\141\163\x73\x65\162\164\151\x6f\156\x5f\x73\x69\x67\x6e\x65\144", "\131\145\x73");
        goto UT;
        NK:
        update_option("\163\x61\155\x6c\x5f\x61\163\163\x65\x72\164\x69\157\x6e\137\x73\151\x67\x6e\x65\144", "\x63\x68\145\x63\153\145\144");
        UT:
        if (array_key_exists("\x6d\x6f\137\163\141\155\154\137\x65\x6e\x63\x6f\x64\151\x6e\x67\137\145\x6e\x61\142\x6c\145\x64", $_POST)) {
            goto Uu;
        }
        update_option("\x6d\x6f\137\163\x61\x6d\x6c\137\x65\x6e\x63\x6f\144\151\x6e\x67\x5f\x65\156\x61\x62\x6c\145\144", "\x75\x6e\x63\150\x65\x63\x6b\145\x64");
        goto AB;
        Uu:
        update_option("\155\x6f\137\x73\x61\155\x6c\137\x65\156\143\157\x64\151\156\147\x5f\x65\156\141\x62\x6c\145\144", "\x63\x68\x65\143\153\145\144");
        AB:
        update_option("\155\x6f\137\163\x61\x6d\154\x5f\x6d\x65\163\163\x61\147\x65", "\111\144\x65\156\164\x69\164\x79\40\120\162\x6f\x76\x69\x64\x65\x72\x20\x64\x65\x74\x61\x69\154\163\40\163\x61\x76\145\144\x20\x73\x75\143\143\x65\x73\163\x66\165\x6c\154\x79\56");
        $this->mo_saml_show_success_message();
        mG:
        if (!self::mo_check_option_admin_referer("\x75\x70\x67\x72\x61\144\145\137\x63\145\x72\x74")) {
            goto Qb;
        }
        $EK = file_get_contents(plugin_dir_path(__FILE__) . "\162\x65\163\157\x75\162\x63\x65\x73" . DIRECTORY_SEPARATOR . "\x6d\151\x6e\x69\157\x72\141\x6e\147\145\x5f\x73\160\137\x32\x30\62\x30\x2e\x63\162\164");
        $H2 = file_get_contents(plugin_dir_path(__FILE__) . "\x72\145\163\157\165\x72\143\145\163" . DIRECTORY_SEPARATOR . "\x6d\x69\x6e\151\157\162\x61\156\147\x65\137\163\x70\x5f\62\x30\62\60\137\160\x72\x69\166\56\x6b\x65\171");
        update_option("\x6d\x6f\137\x73\141\x6d\x6c\137\143\x75\162\x72\145\156\164\137\143\x65\162\164", $EK);
        update_option("\155\x6f\137\x73\x61\x6d\x6c\x5f\143\165\x72\162\x65\156\x74\x5f\x63\145\x72\164\x5f\x70\x72\x69\166\141\x74\145\x5f\x6b\x65\x79", $H2);
        update_option("\x6d\x6f\x5f\163\x61\x6d\154\x5f\x63\145\162\164\x69\146\151\x63\141\x74\145\x5f\162\157\x6c\x6c\x5f\x62\x61\x63\153\x5f\141\x76\x61\151\154\141\x62\x6c\145", true);
        update_option("\155\157\137\163\x61\155\x6c\x5f\x6d\x65\163\163\x61\147\x65", "\103\x65\x72\164\151\x66\x69\x63\141\164\145\x20\125\x70\x67\x72\141\x64\x65\x64\40\x73\165\143\x63\145\x73\163\x66\x75\x6c\154\x79");
        $this->mo_saml_show_success_message();
        Qb:
        if (!self::mo_check_option_admin_referer("\162\x6f\154\154\142\141\x63\x6b\137\x63\145\x72\164")) {
            goto yP;
        }
        $EK = file_get_contents(plugin_dir_path(__FILE__) . "\162\145\x73\x6f\165\x72\x63\145\x73" . DIRECTORY_SEPARATOR . "\x73\160\x2d\143\x65\162\x74\151\146\151\143\141\164\x65\x2e\143\x72\x74");
        $H2 = file_get_contents(plugin_dir_path(__FILE__) . "\x72\145\x73\x6f\x75\162\143\145\163" . DIRECTORY_SEPARATOR . "\163\x70\x2d\153\x65\171\x2e\153\145\171");
        update_option("\155\x6f\x5f\163\141\x6d\154\x5f\x63\x75\x72\162\x65\156\x74\137\143\x65\x72\164", $EK);
        update_option("\155\157\137\163\x61\x6d\154\x5f\x63\165\162\162\145\x6e\x74\137\143\x65\x72\164\137\x70\x72\x69\x76\141\x74\x65\137\x6b\x65\171", $H2);
        update_option("\x6d\157\137\163\141\x6d\x6c\x5f\x6d\145\x73\x73\141\147\145", "\103\x65\162\164\x69\146\x69\143\141\x74\x65\40\x52\157\154\154\x2d\x62\141\x63\153\145\x64\x20\163\x75\x63\x63\145\x73\163\x66\x75\154\x6c\171");
        delete_option("\155\x6f\x5f\x73\x61\155\x6c\x5f\143\145\162\164\x69\x66\x69\x63\x61\164\145\137\162\x6f\x6c\x6c\137\142\x61\143\153\x5f\x61\166\141\151\154\x61\142\x6c\145");
        $this->mo_saml_show_success_message();
        yP:
        if (self::mo_check_option_admin_referer("\141\x64\x64\137\143\165\x73\164\x6f\155\137\143\145\162\164\151\x66\151\x63\x61\x74\x65")) {
            goto A0;
        }
        if (self::mo_check_option_admin_referer("\141\144\x64\x5f\143\165\163\164\157\155\137\x6d\145\163\163\141\x67\145\x73")) {
            goto iD;
        }
        if (!self::mo_check_option_admin_referer("\x6d\157\137\163\x61\155\x6c\x5f\162\x65\x6c\x61\171\137\x73\x74\141\x74\145\x5f\x6f\x70\x74\151\157\156")) {
            goto M5;
        }
        if (isset($_POST["\155\157\137\x73\141\x6d\154\137\x73\145\x6e\x64\x5f\x61\x62\163\x6f\154\x75\164\145\137\x72\x65\154\x61\171\137\x73\x74\x61\x74\x65"]) and !empty($_POST["\155\x6f\x5f\163\141\155\154\x5f\x73\145\156\144\137\x61\142\x73\x6f\154\x75\x74\x65\137\162\x65\154\141\x79\x5f\163\164\141\164\145"])) {
            goto Rq;
        }
        $pY = false;
        goto fC;
        Rq:
        $pY = true;
        fC:
        $yZ = isset($_POST["\x6d\157\x5f\163\141\155\154\137\x72\145\x6c\141\171\x5f\x73\x74\141\164\145"]) ? htmlspecialchars($_POST["\x6d\x6f\137\x73\141\155\154\x5f\x72\145\x6c\x61\x79\x5f\x73\x74\141\x74\x65"]) : '';
        $KO = isset($_POST["\x6d\x6f\x5f\163\141\155\x6c\x5f\x6c\157\147\157\x75\x74\137\x72\x65\154\141\171\137\x73\x74\x61\164\x65"]) ? htmlspecialchars($_POST["\x6d\157\x5f\x73\x61\155\154\137\x6c\157\147\157\165\164\137\162\x65\154\x61\x79\x5f\163\x74\x61\164\x65"]) : '';
        update_option("\x6d\157\137\x73\x61\x6d\x6c\x5f\162\x65\154\x61\x79\x5f\163\164\141\x74\145", $yZ);
        update_option("\155\x6f\137\163\141\x6d\154\x5f\x6c\x6f\x67\x6f\165\x74\137\x72\145\x6c\141\x79\137\163\164\x61\164\145", $KO);
        update_option("\x6d\x6f\137\x73\x61\x6d\154\x5f\163\145\x6e\x64\x5f\x61\x62\163\157\154\x75\164\145\x5f\x72\145\154\141\x79\x5f\163\164\141\x74\145", $pY);
        update_option("\155\157\x5f\x73\141\x6d\x6c\137\155\145\163\163\x61\x67\145", "\122\145\x6c\141\x79\x20\123\164\141\164\x65\40\x75\x70\144\x61\x74\145\x64\40\x73\x75\143\143\145\x73\x73\146\x75\154\x6c\171\x2e");
        $this->mo_saml_show_success_message();
        M5:
        goto oZ;
        iD:
        update_option("\155\x6f\137\163\x61\155\x6c\x5f\141\x63\x63\157\x75\156\164\x5f\143\x72\145\x61\x74\151\x6f\x6e\137\144\151\163\x61\142\x6c\145\x64\x5f\155\x73\x67", htmlspecialchars($_POST["\x6d\157\x5f\163\x61\x6d\154\137\x61\x63\x63\157\x75\156\x74\137\143\162\x65\141\164\x69\157\156\x5f\144\x69\x73\141\x62\x6c\x65\144\137\155\x73\147"]));
        update_option("\x6d\x6f\137\x73\x61\155\x6c\x5f\162\x65\x73\x74\x72\x69\143\164\x65\x64\137\144\157\155\141\x69\x6e\x5f\145\x72\162\157\162\137\x6d\163\147", htmlspecialchars($_POST["\x6d\157\137\163\141\155\154\137\x72\145\x73\164\x72\x69\x63\x74\x65\x64\137\144\x6f\155\141\x69\x6e\x5f\145\x72\162\157\162\137\155\x73\147"]));
        update_option("\x6d\x6f\137\163\x61\x6d\x6c\137\x6d\145\163\163\141\x67\145", "\x43\157\x6e\146\151\x67\x75\x72\x61\x74\151\157\156\40\x68\x61\163\40\142\x65\145\x6e\40\x73\141\x76\x65\144\40\163\x75\x63\x63\145\x73\x73\146\165\154\x6c\x79\56");
        $this->mo_saml_show_success_message();
        oZ:
        goto Zx;
        A0:
        $EK = file_get_contents(plugin_dir_path(__FILE__) . "\x72\145\x73\157\x75\x72\143\145\163" . DIRECTORY_SEPARATOR . "\155\x69\x6e\x69\157\162\141\156\x67\145\x5f\x73\x70\137\x32\x30\62\x30\56\143\162\x74");
        $H2 = file_get_contents(plugin_dir_path(__FILE__) . "\x72\x65\x73\x6f\x75\162\x63\x65\x73" . DIRECTORY_SEPARATOR . "\155\x69\156\x69\x6f\162\141\x6e\x67\x65\x5f\163\160\x5f\62\x30\62\60\137\x70\162\151\x76\56\153\x65\x79");
        if (isset($_POST["\163\165\x62\155\151\164"]) and $_POST["\x73\x75\x62\155\151\164"] == "\x55\x70\154\x6f\141\144") {
            goto Fd;
        }
        if (!(isset($_POST["\x73\x75\x62\x6d\x69\x74"]) and $_POST["\163\x75\142\155\x69\x74"] == "\x52\x65\163\x65\x74")) {
            goto bZ;
        }
        delete_option("\155\x6f\137\163\141\x6d\154\x5f\143\x75\x73\164\x6f\x6d\137\143\x65\162\164");
        delete_option("\x6d\157\137\163\141\155\154\137\x63\165\x73\x74\x6f\155\137\143\145\162\x74\x5f\160\162\151\166\141\x74\145\137\x6b\x65\x79");
        update_option("\155\x6f\x5f\x73\x61\155\x6c\137\x63\x75\x72\162\x65\156\164\137\143\145\x72\x74", $EK);
        update_option("\155\157\x5f\x73\x61\155\154\x5f\x63\165\162\162\x65\x6e\x74\x5f\x63\x65\162\x74\x5f\x70\x72\151\166\x61\x74\145\x5f\153\x65\171", $H2);
        update_option("\155\x6f\x5f\x73\141\155\154\137\155\145\x73\163\141\147\145", "\x52\x65\x73\145\164\40\x43\x65\x72\164\151\146\x69\x63\141\x74\x65\x20\163\x75\143\143\145\x73\163\146\x75\154\x6c\x79\x2e");
        $this->mo_saml_show_success_message();
        bZ:
        goto p0;
        Fd:
        if (!@openssl_x509_read($_POST["\163\x61\x6d\x6c\x5f\160\x75\142\154\151\143\137\x78\65\x30\x39\137\143\x65\x72\x74\x69\x66\151\x63\141\x74\145"])) {
            goto z_;
        }
        if (!@openssl_x509_check_private_key($_POST["\x73\141\x6d\154\x5f\x70\165\x62\154\151\143\x5f\170\x35\60\x39\137\143\145\162\x74\151\146\151\143\141\x74\x65"], $_POST["\163\141\155\154\x5f\160\162\x69\x76\141\x74\x65\x5f\x78\65\60\x39\137\143\x65\162\164\151\146\151\x63\x61\164\x65"])) {
            goto sN;
        }
        if (openssl_x509_read($_POST["\x73\x61\x6d\x6c\137\x70\x75\x62\154\151\x63\137\x78\65\x30\71\137\x63\x65\162\164\151\146\x69\x63\x61\164\145"]) && openssl_x509_check_private_key($_POST["\x73\141\x6d\x6c\137\160\165\142\x6c\x69\143\137\170\x35\x30\71\x5f\143\x65\162\164\x69\146\x69\x63\x61\x74\x65"], $_POST["\163\141\x6d\154\x5f\x70\x72\151\x76\x61\x74\145\137\x78\65\60\71\x5f\143\145\162\x74\x69\146\x69\x63\141\164\x65"])) {
            goto Mq;
        }
        goto g2;
        z_:
        update_option("\x6d\x6f\137\163\x61\155\x6c\137\155\145\163\163\141\x67\x65", "\x49\x6e\166\x61\x6c\x69\144\40\103\145\x72\x74\151\x66\151\143\141\x74\145\40\x66\x6f\x72\x6d\x61\x74\x2e\x20\x50\154\145\x61\x73\145\40\145\156\x74\x65\162\40\x61\40\166\x61\x6c\x69\x64\40\x63\145\x72\164\151\146\151\x63\x61\164\x65\x2e");
        $this->mo_saml_show_error_message();
        return;
        goto g2;
        sN:
        update_option("\155\x6f\x5f\163\x61\x6d\154\x5f\x6d\145\x73\163\141\147\x65", "\111\x6e\166\x61\x6c\x69\144\x20\120\x72\151\166\141\164\x65\x20\113\145\171\x2e");
        $this->mo_saml_show_error_message();
        return;
        goto g2;
        Mq:
        $An = $_POST["\x73\141\155\154\137\x70\165\142\x6c\151\x63\x5f\x78\x35\x30\x39\x5f\143\x65\x72\164\151\146\x69\x63\141\x74\145"];
        $yl = $_POST["\x73\141\x6d\x6c\x5f\160\x72\x69\x76\x61\164\145\x5f\x78\x35\x30\x39\x5f\143\x65\x72\164\x69\146\x69\x63\141\164\x65"];
        update_option("\x6d\x6f\x5f\163\x61\x6d\154\x5f\x63\x75\x73\164\157\155\137\143\145\162\164", $An);
        update_option("\155\157\x5f\x73\141\155\154\x5f\143\x75\x73\164\157\155\137\143\x65\x72\164\137\x70\162\x69\x76\x61\164\145\x5f\x6b\145\171", $yl);
        update_option("\x6d\x6f\x5f\163\x61\x6d\154\x5f\x63\165\x72\x72\145\156\x74\x5f\x63\x65\x72\164", $An);
        update_option("\155\157\x5f\x73\141\155\154\x5f\143\165\x72\162\x65\156\164\x5f\x63\145\162\164\x5f\x70\162\x69\166\x61\164\x65\x5f\x6b\x65\171", $yl);
        update_option("\155\x6f\137\163\x61\x6d\154\x5f\155\x65\163\x73\141\x67\x65", "\103\165\163\164\157\x6d\40\x43\145\x72\x74\x69\x66\x69\143\x61\164\x65\x20\165\x70\x64\x61\164\145\144\40\163\x75\x63\143\145\163\x73\146\x75\x6c\154\171\56");
        $this->mo_saml_show_success_message();
        g2:
        p0:
        Zx:
        if (self::mo_check_option_admin_referer("\x6d\x6f\x5f\163\141\x6d\x6c\x5f\x77\151\x64\147\145\x74\137\x6f\160\x74\151\157\x6e")) {
            goto qG;
        }
        if (self::mo_check_option_admin_referer("\155\x6f\x5f\x73\141\x6d\154\137\x72\145\147\151\x73\164\x65\x72\137\x63\165\163\x74\x6f\155\145\162")) {
            goto vU;
        }
        if (self::mo_check_option_admin_referer("\155\x6f\x5f\163\x61\x6d\x6c\137\x76\141\x6c\x69\144\141\164\x65\x5f\157\x74\x70")) {
            goto gS;
        }
        if (self::mo_check_option_admin_referer("\155\x6f\x5f\x73\x61\155\154\137\x76\x65\162\151\x66\171\x5f\x63\x75\x73\164\x6f\155\145\x72")) {
            goto hv;
        }
        if (self::mo_check_option_admin_referer("\x6d\x6f\x5f\163\x61\155\154\x5f\x63\157\x6e\x74\141\x63\164\137\165\163\137\161\165\145\162\171\x5f\157\x70\164\x69\x6f\x6e")) {
            goto Py;
        }
        if (self::mo_check_option_admin_referer("\x6d\157\x5f\163\141\155\154\137\x72\145\x73\x65\x6e\144\x5f\x6f\x74\x70\x5f\x65\x6d\x61\151\154")) {
            goto ba;
        }
        if (self::mo_check_option_admin_referer("\155\157\137\163\141\155\x6c\x5f\x72\145\x73\145\156\144\x5f\x6f\x74\160\137\x70\x68\157\156\x65")) {
            goto pu;
        }
        if (self::mo_check_option_admin_referer("\x6d\157\137\x73\141\155\x6c\137\147\x6f\x5f\142\141\x63\x6b")) {
            goto FD;
        }
        if (self::mo_check_option_admin_referer("\x6d\157\137\163\x61\x6d\x6c\137\x72\145\147\x69\x73\164\145\x72\x5f\x77\151\x74\150\x5f\x70\x68\157\156\145\x5f\x6f\x70\164\151\x6f\x6e")) {
            goto ZL;
        }
        if (self::mo_check_option_admin_referer("\x6d\157\x5f\163\141\x6d\154\x5f\x72\x65\x67\x69\163\164\145\162\145\144\137\x6f\156\x6c\x79\x5f\x61\143\x63\x65\x73\163\137\x6f\x70\x74\x69\157\156")) {
            goto aJ;
        }
        if (self::mo_check_option_admin_referer("\x6d\157\x5f\x73\x61\x6d\154\137\162\x65\x64\x69\x72\x65\143\x74\x5f\x74\x6f\x5f\167\160\137\154\x6f\x67\x69\156\137\157\x70\x74\x69\157\156")) {
            goto yL;
        }
        if (self::mo_check_option_admin_referer("\155\157\137\x73\141\x6d\154\137\x66\157\162\x63\145\x5f\141\165\x74\x68\x65\x6e\x74\151\x63\x61\164\151\x6f\156\x5f\x6f\x70\164\151\157\x6e")) {
            goto WH;
        }
        if (self::mo_check_option_admin_referer("\155\157\x5f\163\x61\155\154\x5f\145\x6e\141\142\154\x65\x5f\x72\163\163\x5f\141\143\143\145\x73\x73\x5f\157\160\x74\x69\x6f\156")) {
            goto Zr;
        }
        if (self::mo_check_option_admin_referer("\155\x6f\137\163\141\155\x6c\137\145\156\141\x62\x6c\x65\x5f\x6c\157\147\151\x6e\x5f\x72\145\x64\151\x72\x65\143\164\137\157\x70\164\x69\x6f\156")) {
            goto ht;
        }
        if (self::mo_check_option_admin_referer("\x6d\157\137\163\141\155\154\x5f\x61\144\144\137\163\x73\x6f\137\x62\165\164\x74\x6f\156\137\167\x70\x5f\x6f\x70\x74\x69\x6f\156")) {
            goto fw;
        }
        if (self::mo_check_option_admin_referer("\x6d\157\x5f\x73\x61\x6d\x6c\x5f\165\163\x65\137\142\x75\x74\x74\x6f\x6e\137\141\x73\x5f\163\150\157\x72\164\x63\x6f\x64\x65\137\157\x70\164\151\x6f\x6e")) {
            goto f6;
        }
        if (self::mo_check_option_admin_referer("\155\157\137\163\141\x6d\154\x5f\165\x73\x65\137\x62\165\164\164\157\156\x5f\x61\x73\137\x77\x69\x64\147\x65\x74\x5f\157\x70\164\x69\157\156")) {
            goto Ur;
        }
        if (self::mo_check_option_admin_referer("\x6d\157\137\x73\141\x6d\154\137\141\x6c\x6c\x6f\x77\137\167\160\x5f\x73\151\147\156\151\156\x5f\157\x70\164\151\x6f\x6e")) {
            goto Yd;
        }
        if (self::mo_check_option_admin_referer("\x6d\x6f\x5f\x73\x61\x6d\x6c\x5f\x63\x75\x73\164\157\155\x5f\x62\165\x74\x74\157\156\137\157\160\x74\x69\157\156")) {
            goto Ii;
        }
        if (self::mo_check_option_admin_referer("\x6d\x6f\137\163\141\x6d\154\x5f\x66\157\162\147\157\x74\x5f\160\141\163\163\x77\x6f\162\144\137\x66\157\x72\155\137\157\x70\164\x69\x6f\x6e")) {
            goto dC;
        }
        if (self::mo_check_option_admin_referer("\155\x6f\137\x73\141\155\x6c\x5f\166\145\162\x69\x66\171\137\x6c\151\x63\145\x6e\163\x65")) {
            goto mT;
        }
        if (self::mo_check_option_admin_referer("\155\x6f\137\163\x61\x6d\154\x5f\x66\162\145\145\x5f\164\x72\151\141\x6c")) {
            goto mN;
        }
        if (self::mo_check_option_admin_referer("\x6d\x6f\x5f\x73\141\x6d\x6c\137\143\150\145\x63\x6b\137\x6c\151\143\145\156\163\x65")) {
            goto lF;
        }
        if (!self::mo_check_option_admin_referer("\155\x6f\137\x73\141\155\154\137\162\x65\155\x6f\x76\x65\x5f\141\x63\143\x6f\x75\x6e\x74")) {
            goto nr;
        }
        $this->mo_sso_saml_deactivate();
        add_option("\x6d\x6f\x5f\163\141\x6d\x6c\x5f\162\x65\147\151\163\164\x72\141\164\151\157\156\137\x73\164\141\x74\x75\163", "\162\145\x6d\157\166\x65\144\137\x61\143\143\157\x75\x6e\164");
        $H4 = add_query_arg(array("\164\x61\142" => "\x6c\157\x67\x69\x6e"), $_SERVER["\x52\105\121\125\105\x53\x54\x5f\125\x52\111"]);
        header("\114\157\143\x61\x74\x69\x6f\156\72\40" . $H4);
        nr:
        goto BF;
        lF:
        LicenseHelper::migrateExistingEnvironments();
        $dI = new Customersaml();
        $fY = $dI->check_customer_ln();
        if ($fY) {
            goto QL;
        }
        return;
        QL:
        $fY = json_decode($fY, true);
        if (strcasecmp($fY["\x73\x74\141\x74\x75\x73"], "\x53\x55\103\x43\x45\123\123") == 0) {
            goto Yc;
        }
        $y9 = get_option("\x6d\x6f\x5f\163\141\x6d\154\x5f\x63\x75\163\164\157\x6d\x65\x72\137\164\x6f\x6b\x65\x6e");
        update_option("\x73\151\x74\x65\x5f\143\153\137\154", AESEncryption::encrypt_data("\x66\141\154\x73\145", $y9));
        $H4 = add_query_arg(array("\164\141\142" => "\x6c\151\x63\145\156\x73\151\156\147"), $_SERVER["\x52\105\x51\x55\x45\x53\124\137\125\122\111"]);
        update_option("\x6d\x6f\137\163\x61\x6d\154\137\x6d\145\x73\163\x61\147\x65", "\x59\x6f\x75\x20\150\x61\166\145\40\156\x6f\164\x20\165\160\147\162\x61\144\x65\x64\x20\x79\x65\164\x2e\x20" . addLink("\x43\x6c\151\143\x6b\x20\150\x65\162\145", $H4) . "\40\x74\x6f\x20\x75\160\x67\162\141\144\145\x20\164\157\40\160\x72\145\155\151\x75\155\x20\166\x65\162\x73\x69\x6f\156\x2e");
        $this->mo_saml_show_error_message();
        goto ef;
        Yc:
        if (array_key_exists("\x6c\151\x63\x65\156\x73\145\x50\154\x61\156", $fY) && !$this->mo_saml_check_empty_or_null($fY["\x6c\151\143\145\x6e\x73\x65\x50\x6c\x61\156"])) {
            goto XS;
        }
        $y9 = get_option("\155\x6f\x5f\163\x61\155\154\x5f\x63\165\163\164\157\155\x65\162\137\x74\157\x6b\x65\x6e");
        update_option("\163\x69\x74\x65\x5f\x63\x6b\137\x6c", AESEncryption::encrypt_data("\146\x61\154\x73\145", $y9));
        $H4 = add_query_arg(array("\x74\141\x62" => "\x6c\151\x63\145\156\x73\x69\x6e\147"), $_SERVER["\x52\105\x51\x55\x45\x53\x54\137\125\122\111"]);
        update_option("\155\x6f\x5f\x73\141\x6d\x6c\137\155\x65\163\x73\x61\147\145", "\131\157\x75\40\150\x61\x76\x65\x20\x6e\157\x74\x20\x75\160\147\x72\x61\144\145\x64\40\x79\145\164\56\40" . addLink("\x43\154\151\x63\153\x20\150\x65\x72\145", $H4) . "\40\164\157\40\x75\160\147\162\x61\144\145\x20\164\157\40\x70\162\x65\155\x69\165\x6d\40\166\145\x72\163\x69\x6f\156\x2e");
        $this->mo_saml_show_error_message();
        goto QB;
        XS:
        update_option("\x6d\157\x5f\163\x61\x6d\154\x5f\154\x69\143\145\x6e\x73\x65\137\156\x61\155\145", base64_encode($fY["\154\151\x63\145\156\163\145\120\x6c\141\156"]));
        $y9 = get_option("\155\x6f\x5f\163\x61\155\154\x5f\143\165\163\164\157\155\145\162\x5f\x74\x6f\153\x65\156");
        if (!(array_key_exists("\156\157\x4f\146\125\163\x65\162\x73", $fY) && !$this->mo_saml_check_empty_or_null($fY["\x6e\x6f\117\146\125\x73\x65\162\x73"]))) {
            goto A_;
        }
        update_option("\155\x6f\x5f\x73\x61\155\x6c\137\165\x73\162\x5f\154\x6d\x74", AESEncryption::encrypt_data($fY["\156\157\x4f\146\125\x73\x65\162\x73"], $y9));
        A_:
        if (!(array_key_exists("\x6c\151\143\x65\156\163\x65\105\x78\x70\151\162\x79", $fY) && !$this->mo_saml_check_empty_or_null($fY["\x6c\151\143\145\x6e\163\x65\105\x78\x70\151\162\x79"]))) {
            goto RC;
        }
        update_option("\x6d\157\x5f\x73\x61\155\x6c\x5f\154\151\143\145\x6e\163\x65\137\x65\170\160\x69\x72\x79\137\144\x61\164\145", $this->mo_saml_parse_expiry_date($fY["\154\x69\x63\x65\156\163\145\105\170\x70\151\162\x79"]));
        if (new DateTime() > new DateTime($fY["\x6c\151\143\145\x6e\x73\x65\x45\x78\x70\151\x72\x79"])) {
            goto uG;
        }
        update_option("\x6d\157\137\163\141\x6d\154\137\163\154\145", false);
        goto US;
        uG:
        update_option("\155\x6f\x5f\x73\141\x6d\x6c\137\x73\154\x65", true);
        US:
        RC:
        update_option("\163\x69\x74\145\x5f\x63\x6b\x5f\x6c", AESEncryption::encrypt_data("\x74\162\165\145", $y9));
        $s5 = plugin_dir_path(__FILE__);
        $GW = home_url();
        $GW = trim($GW, "\x2f");
        if (preg_match("\43\x5e\150\x74\x74\x70\50\x73\51\77\72\x2f\x2f\x23", $GW)) {
            goto St;
        }
        $GW = "\x68\x74\164\160\72\x2f\x2f" . $GW;
        St:
        $X5 = parse_url($GW);
        $aY = preg_replace("\57\136\x77\x77\x77\x5c\56\57", '', $X5["\150\157\x73\x74"]);
        $bX = wp_upload_dir();
        $Ka = $aY . "\55" . $bX["\142\x61\x73\x65\144\151\x72"];
        $RQ = hash_hmac("\163\150\x61\62\65\x36", $Ka, "\x34\x44\x48\146\x6a\147\146\x6a\x61\x73\x6e\144\146\163\141\x6a\x66\x48\107\x4a");
        $Ve = $this->djkasjdksa();
        $Fv = round(strlen($Ve) / rand(2, 20));
        $Ve = substr_replace($Ve, $RQ, $Fv, 0);
        $U5 = base64_decode($Ve);
        if (is_writable($s5 . "\154\x69\x63\145\x6e\x73\x65")) {
            goto GO;
        }
        $Ve = str_rot13($Ve);
        $Bf = base64_decode("\x62\x47\116\x6b\x61\155\x74\150\x63\x32\160\x6b\141\x33\116\150\x59\62\167\75");
        update_option($Bf, $Ve);
        goto ag;
        GO:
        file_put_contents($s5 . "\154\151\143\x65\156\x73\145", $U5);
        ag:
        update_option("\x6c\x63\x77\162\x74\x6c\x66\163\x61\155\x6c", true);
        $H4 = add_query_arg(array("\164\141\x62" => "\x67\145\156\x65\162\141\x6c"), $_SERVER["\x52\x45\x51\125\105\123\x54\x5f\x55\122\x49"]);
        update_option("\155\157\137\x73\x61\x6d\x6c\x5f\155\x65\163\x73\141\147\x65", "\x59\157\165\x20\150\x61\x76\145\40\163\165\x63\x63\x65\x73\x73\146\165\154\x6c\171\40\165\x70\x67\x72\x61\x64\145\x64\40\x79\x6f\165\x72\40\x6c\x69\143\x65\x6e\163\145\x2e");
        $this->mo_saml_show_success_message();
        QB:
        ef:
        BF:
        goto Kf;
        mN:
        if (decryptSamlElement()) {
            goto fz;
        }
        $ew = postResponse();
        $dI = new Customersaml();
        $fY = $dI->mo_saml_vl($ew, false);
        if ($fY) {
            goto GV;
        }
        return;
        GV:
        $fY = json_decode($fY, true);
        if (strcasecmp($fY["\163\164\x61\164\165\x73"], "\123\125\103\x43\x45\x53\123") == 0) {
            goto MY;
        }
        if (strcasecmp($fY["\x73\164\141\164\165\x73"], "\x46\x41\111\x4c\x45\104") == 0) {
            goto W4;
        }
        update_option("\x6d\157\x5f\x73\x61\x6d\x6c\137\155\x65\x73\163\141\x67\x65", "\x41\x6e\40\145\x72\162\x6f\x72\40\157\143\x63\165\162\145\x64\40\167\x68\x69\x6c\x65\40\x70\162\x6f\x63\x65\163\x73\x69\x6e\x67\40\x79\157\x75\x72\x20\x72\145\161\x75\x65\x73\164\56\x20\120\154\145\141\163\x65\x20\124\162\171\40\141\x67\141\x69\x6e\x2e");
        $this->mo_saml_show_error_message();
        goto tH;
        W4:
        update_option("\x6d\x6f\137\163\x61\155\x6c\137\155\145\163\163\141\x67\145", "\124\150\145\162\145\x20\x77\x61\x73\40\x61\x6e\x20\145\162\162\157\x72\x20\x61\x63\x74\x69\166\141\x74\x69\x6e\147\x20\171\157\165\x72\40\124\x52\x49\101\114\40\x76\x65\x72\163\x69\x6f\156\56\x20\120\x6c\x65\x61\163\145\40\143\157\x6e\x74\x61\143\x74\40\151\x6e\x66\x6f\100\x78\x65\143\x75\162\151\146\x79\56\x63\x6f\x6d\40\146\x6f\162\40\x67\x65\x74\164\151\156\147\40\x6e\x65\167\x20\x6c\151\x63\x65\x6e\x73\x65\40\x66\x6f\x72\x20\x74\x72\x69\x61\154\x20\x76\x65\162\x73\151\157\x6e\x2e");
        $this->mo_saml_show_error_message();
        tH:
        goto yz;
        MY:
        $y9 = get_option("\155\157\x5f\163\x61\x6d\x6c\x5f\x63\165\163\164\x6f\155\145\162\x5f\164\157\x6b\145\x6e");
        $y9 = get_option("\155\x6f\137\x73\x61\155\154\137\x63\165\x73\x74\157\x6d\x65\x72\137\x74\x6f\x6b\x65\156");
        update_option("\x74\137\x73\151\164\x65\x5f\x73\x74\x61\x74\x75\x73", AESEncryption::encrypt_data("\x74\x72\x75\x65", $y9));
        update_option("\155\157\137\x73\x61\x6d\x6c\x5f\x6d\145\163\163\x61\147\145", "\131\157\165\162\x20\65\40\144\x61\171\163\40\124\122\x49\101\114\x20\x69\x73\x20\x61\x63\x74\151\166\141\164\145\144\56\x20\131\x6f\x75\x20\143\141\156\x20\156\x6f\167\40\163\145\164\x75\160\40\164\150\x65\x20\x70\154\x75\x67\x69\x6e\x2e");
        $this->mo_saml_show_success_message();
        yz:
        goto mE;
        fz:
        update_option("\155\x6f\x5f\163\x61\x6d\x6c\137\155\145\x73\x73\x61\x67\145", "\124\x68\x65\162\x65\40\x77\x61\x73\40\x61\x6e\40\x65\162\162\157\x72\40\141\x63\x74\151\x76\141\x74\x69\156\x67\40\171\x6f\165\162\x20\124\x52\x49\x41\114\x20\166\x65\162\163\x69\157\156\56\x20\x45\151\x74\x68\x65\x72\40\x79\157\165\x72\x20\x74\x72\x69\141\x6c\x20\160\145\x72\x69\157\144\40\151\x73\40\145\x78\160\151\162\145\x64\x20\157\x72\40\171\x6f\165\40\141\x72\x65\x20\x75\x73\151\x6e\147\x20\x77\162\x6f\156\147\40\164\x72\x69\141\x6c\40\166\x65\x72\x73\x69\157\156\56\x20\x50\154\x65\x61\163\145\40\x63\x6f\156\x74\x61\x63\x74\40\x69\x6e\146\157\100\170\145\143\165\162\x69\x66\x79\56\143\157\x6d\40\x66\157\x72\x20\x67\145\x74\x74\x69\156\x67\x20\x6e\145\x77\40\x6c\x69\x63\x65\156\x73\145\40\x66\157\162\x20\164\162\151\141\x6c\40\166\x65\x72\163\151\x6f\156\56");
        $this->mo_saml_show_error_message();
        mE:
        Kf:
        goto YB;
        mT:
        if (!$this->mo_saml_check_empty_or_null($_POST["\163\141\155\x6c\137\x6c\x69\143\x65\156\143\145\x5f\x6b\145\x79"])) {
            goto Yv;
        }
        update_option("\155\x6f\x5f\x73\x61\x6d\154\x5f\x6d\x65\x73\x73\141\x67\145", "\x41\154\154\40\x74\x68\x65\x20\146\151\x65\154\x64\x73\40\141\x72\145\x20\x72\x65\x71\x75\151\162\145\144\x2e\40\120\x6c\x65\141\x73\145\x20\x65\156\x74\x65\x72\40\x76\141\x6c\x69\x64\x20\154\x69\143\145\x6e\x73\x65\x20\x6b\145\x79\56");
        $this->mo_saml_show_error_message();
        return;
        Yv:
        $ew = htmlspecialchars(trim($_POST["\x73\x61\155\154\137\x6c\151\143\x65\156\143\x65\137\x6b\x65\171"]));
        $dI = new Customersaml();
        $this->djkasjdksaduwaj($ew, $dI);
        YB:
        goto wV;
        dC:
        if (mo_saml_is_extension_installed("\143\165\x72\154")) {
            goto WN;
        }
        update_option("\155\157\137\163\x61\x6d\x6c\x5f\x6d\145\x73\163\x61\x67\x65", "\105\x52\x52\117\x52\x3a\x20\120\110\x50\40\143\125\122\114\x20\145\x78\x74\145\x6e\x73\151\x6f\x6e\40\x69\163\40\x6e\x6f\164\40\151\156\x73\164\x61\x6c\154\x65\144\x20\157\x72\x20\x64\151\163\x61\x62\x6c\x65\144\x2e\40\122\145\x73\145\x6e\144\x20\x4f\x54\120\x20\146\141\x69\154\x65\x64\x2e");
        $this->mo_saml_show_error_message();
        return;
        WN:
        $Dm = get_option("\155\157\137\x73\x61\x6d\x6c\137\141\x64\x6d\151\x6e\137\145\155\141\x69\154");
        $dI = new Customersaml();
        $fY = $dI->mo_saml_forgot_password($Dm);
        if ($fY) {
            goto by;
        }
        return;
        by:
        $fY = json_decode($fY, true);
        if (strcasecmp($fY["\163\x74\x61\164\x75\163"], "\x53\x55\x43\x43\x45\x53\x53") == 0) {
            goto ii;
        }
        update_option("\x6d\x6f\x5f\x73\x61\x6d\154\137\x6d\x65\x73\163\x61\147\x65", "\101\156\40\145\x72\x72\157\x72\40\157\x63\x63\165\x72\145\144\40\x77\150\x69\x6c\x65\40\x70\162\157\x63\x65\x73\x73\x69\156\x67\x20\x79\x6f\x75\162\x20\162\145\161\165\145\x73\x74\x2e\40\x50\154\145\x61\163\x65\40\x54\x72\x79\40\x61\x67\141\151\156\x2e");
        $this->mo_saml_show_error_message();
        goto YA;
        ii:
        update_option("\155\x6f\x5f\x73\x61\x6d\x6c\x5f\155\145\x73\163\x61\147\145", "\x59\157\x75\x72\x20\160\141\x73\x73\167\157\162\x64\40\x68\x61\163\x20\142\145\x65\x6e\40\162\x65\x73\x65\x74\40\x73\x75\x63\143\x65\163\x73\x66\165\x6c\154\171\56\x20\x50\x6c\x65\x61\163\x65\x20\x65\156\164\x65\162\40\x74\x68\145\40\156\x65\x77\x20\x70\141\163\163\x77\157\162\144\40\163\145\x6e\164\40\164\157\40" . $Dm . "\56");
        $this->mo_saml_show_success_message();
        YA:
        wV:
        goto oQ;
        Ii:
        $G0 = '';
        $pi = '';
        $wj = '';
        $WZ = '';
        $mY = '';
        $MV = '';
        $NG = '';
        $D4 = '';
        $HH = '';
        $ga = '';
        $iC = "\141\x62\157\x76\145";
        if (!(array_key_exists("\x6d\157\x5f\x73\x61\155\154\137\142\x75\164\x74\x6f\156\x5f\163\x69\x7a\145", $_POST) && !empty($_POST["\x6d\157\x5f\163\x61\155\x6c\x5f\142\x75\x74\164\157\156\x5f\x73\x69\x7a\x65"]))) {
            goto wq;
        }
        $wj = htmlspecialchars($_POST["\155\x6f\137\163\x61\155\154\137\142\x75\164\164\157\x6e\137\x73\151\x7a\145"]);
        wq:
        if (!(array_key_exists("\x6d\157\137\x73\x61\x6d\154\x5f\142\x75\164\x74\157\x6e\137\167\151\144\x74\150", $_POST) && !empty($_POST["\x6d\157\137\163\x61\155\x6c\x5f\142\x75\164\x74\x6f\x6e\137\x77\x69\144\x74\x68"]))) {
            goto Av;
        }
        $WZ = htmlspecialchars($_POST["\x6d\157\x5f\x73\x61\x6d\154\x5f\142\165\x74\x74\x6f\x6e\137\x77\x69\144\x74\x68"]);
        Av:
        if (!(array_key_exists("\x6d\157\137\x73\141\155\x6c\137\x62\165\x74\164\157\156\137\150\145\x69\147\x68\164", $_POST) && !empty($_POST["\x6d\x6f\x5f\163\141\x6d\x6c\x5f\x62\165\x74\x74\x6f\156\x5f\x68\x65\x69\x67\x68\x74"]))) {
            goto CV;
        }
        $mY = htmlspecialchars($_POST["\155\x6f\x5f\x73\141\155\x6c\137\x62\165\164\x74\157\156\137\150\145\151\x67\x68\x74"]);
        CV:
        if (!(array_key_exists("\155\157\137\x73\x61\155\x6c\x5f\x62\165\x74\164\157\x6e\x5f\143\165\x72\x76\145", $_POST) && !empty($_POST["\x6d\157\137\163\141\155\154\137\142\x75\164\164\157\x6e\137\143\x75\162\166\145"]))) {
            goto uJ;
        }
        $MV = htmlspecialchars($_POST["\155\x6f\x5f\x73\141\155\x6c\137\142\165\x74\x74\x6f\x6e\x5f\x63\165\162\x76\x65"]);
        uJ:
        if (!array_key_exists("\155\157\137\163\141\155\x6c\137\142\x75\164\164\x6f\x6e\x5f\143\157\154\x6f\162", $_POST)) {
            goto P2;
        }
        $NG = htmlspecialchars($_POST["\x6d\157\x5f\163\x61\x6d\154\137\142\x75\x74\x74\157\x6e\137\143\157\x6c\x6f\162"]);
        P2:
        if (!array_key_exists("\155\x6f\x5f\x73\x61\155\154\x5f\x62\165\164\164\157\156\137\x74\150\x65\155\145", $_POST)) {
            goto rX;
        }
        $G0 = htmlspecialchars($_POST["\x6d\157\x5f\163\141\155\x6c\x5f\x62\165\164\x74\157\156\137\164\x68\x65\x6d\x65"]);
        rX:
        if (!array_key_exists("\x6d\x6f\137\163\x61\x6d\154\x5f\142\165\164\164\x6f\x6e\137\164\145\x78\164", $_POST)) {
            goto JQ;
        }
        $D4 = htmlspecialchars($_POST["\155\157\x5f\x73\x61\155\x6c\x5f\142\165\x74\x74\157\156\x5f\x74\x65\170\x74"]);
        if (!(empty($D4) || $D4 == "\114\x6f\x67\151\x6e")) {
            goto HU;
        }
        $D4 = "\x4c\157\147\151\156";
        HU:
        $eO = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Identity_name);
        $D4 = str_replace("\43\x23\x49\104\120\x23\43", $eO, $D4);
        JQ:
        if (!array_key_exists("\x6d\157\x5f\x73\141\x6d\154\137\146\x6f\156\x74\x5f\143\x6f\154\157\x72", $_POST)) {
            goto Mf;
        }
        $HH = htmlspecialchars($_POST["\x6d\157\137\x73\x61\x6d\154\137\146\x6f\x6e\x74\x5f\x63\157\154\x6f\x72"]);
        Mf:
        if (!array_key_exists("\x6d\157\x5f\x73\x61\155\154\137\x66\157\156\x74\x5f\163\x69\172\x65", $_POST)) {
            goto sE;
        }
        $ga = htmlspecialchars($_POST["\155\x6f\x5f\163\141\155\x6c\x5f\146\x6f\x6e\164\x5f\163\151\x7a\145"]);
        sE:
        if (!array_key_exists("\x73\163\x6f\137\142\x75\164\164\x6f\156\x5f\154\157\147\x69\156\137\146\157\x72\155\137\x70\157\163\151\164\x69\157\x6e", $_POST)) {
            goto sK;
        }
        $iC = htmlspecialchars($_POST["\163\163\157\137\142\165\x74\x74\157\156\x5f\x6c\x6f\x67\151\156\x5f\x66\157\162\x6d\137\x70\x6f\163\x69\x74\151\157\x6e"]);
        sK:
        update_option("\155\x6f\137\163\x61\155\x6c\137\142\165\164\x74\157\156\137\164\150\145\x6d\x65", $G0);
        update_option("\155\x6f\137\163\x61\x6d\x6c\x5f\142\165\x74\164\x6f\x6e\x5f\x73\151\172\145", $wj);
        update_option("\x6d\x6f\137\x73\141\x6d\154\137\142\x75\x74\x74\157\156\137\x77\151\144\x74\150", $WZ);
        update_option("\155\157\x5f\163\141\155\x6c\x5f\x62\165\x74\x74\x6f\x6e\137\150\145\151\147\150\164", $mY);
        update_option("\155\x6f\x5f\x73\x61\x6d\154\x5f\x62\165\x74\164\157\156\137\143\x75\162\x76\145", $MV);
        update_option("\x6d\x6f\x5f\x73\141\155\154\x5f\142\x75\164\x74\157\x6e\x5f\143\x6f\154\157\162", $NG);
        update_option("\x6d\157\137\x73\x61\155\154\137\x62\x75\164\x74\157\x6e\137\164\145\170\x74", $D4);
        update_option("\x6d\x6f\x5f\163\x61\x6d\154\x5f\x66\157\156\164\x5f\x63\x6f\x6c\x6f\162", $HH);
        update_option("\x6d\x6f\137\x73\141\155\154\137\146\x6f\156\164\137\x73\x69\172\145", $ga);
        update_option("\x73\163\x6f\x5f\x62\x75\x74\x74\157\x6e\137\154\157\147\x69\156\137\x66\157\162\x6d\137\160\x6f\163\x69\x74\x69\x6f\156", $iC);
        update_option("\155\x6f\x5f\163\x61\x6d\154\x5f\155\145\x73\163\x61\x67\x65", "\123\151\147\156\40\111\156\x20\163\145\164\x74\151\156\x67\x73\x20\165\x70\x64\141\164\x65\144\x2e");
        $this->mo_saml_show_success_message();
        oQ:
        goto h4;
        Yd:
        $Rk = "\146\x61\154\163\x65";
        if (array_key_exists("\x6d\157\x5f\163\x61\x6d\x6c\x5f\x61\x6c\154\x6f\x77\x5f\x77\x70\x5f\x73\x69\147\156\x69\x6e", $_POST)) {
            goto oC;
        }
        $oB = "\146\x61\x6c\163\x65";
        goto O7;
        oC:
        $oB = htmlspecialchars($_POST["\x6d\157\137\163\141\155\x6c\x5f\141\154\x6c\x6f\167\137\167\x70\x5f\x73\x69\147\x6e\151\x6e"]);
        O7:
        if ($oB == "\164\x72\165\145") {
            goto Ni;
        }
        update_option("\x6d\x6f\x5f\163\x61\155\x6c\x5f\x61\154\x6c\x6f\167\137\x77\160\x5f\163\x69\x67\156\x69\x6e", '');
        goto iT;
        Ni:
        update_option("\x6d\x6f\x5f\x73\141\155\x6c\137\x61\x6c\154\157\167\137\167\x70\137\x73\151\147\x6e\151\156", "\164\162\x75\145");
        if (!array_key_exists("\155\x6f\x5f\x73\x61\155\154\137\142\141\x63\153\144\x6f\x6f\162\137\x75\x72\154", $_POST)) {
            goto Fg;
        }
        $Rk = htmlspecialchars(trim($_POST["\155\x6f\137\x73\141\155\x6c\x5f\x62\x61\x63\x6b\x64\x6f\x6f\162\x5f\165\162\154"]));
        Fg:
        iT:
        update_option("\x6d\x6f\137\163\x61\x6d\x6c\137\x62\141\143\153\x64\157\x6f\162\x5f\x75\162\x6c", $Rk);
        update_option("\x6d\x6f\137\x73\x61\155\x6c\x5f\155\x65\x73\x73\141\x67\145", "\x53\x69\147\156\x20\111\156\x20\x73\145\164\164\x69\x6e\x67\163\x20\165\160\x64\x61\164\x65\144\56");
        $this->mo_saml_show_success_message();
        h4:
        goto rr;
        Ur:
        if (mo_saml_is_sp_configured()) {
            goto gr;
        }
        update_option("\x6d\x6f\x5f\163\141\x6d\x6c\137\155\145\163\x73\141\x67\x65", "\x50\154\145\141\x73\145\x20\143\157\155\160\154\145\164\145\40" . addLink("\x53\x65\162\166\151\x63\145\40\120\x72\x6f\166\151\x64\145\162", add_query_arg(array("\x74\x61\x62" => "\x73\141\x76\x65"), $_SERVER["\x52\105\x51\x55\x45\x53\124\x5f\x55\x52\111"])) . "\40\x63\x6f\x6e\x66\151\x67\165\x72\141\x74\x69\x6f\x6e\x20\x66\x69\162\x73\164\x2e");
        $this->mo_saml_show_error_message();
        goto WR;
        gr:
        if (array_key_exists("\155\157\137\x73\141\x6d\x6c\x5f\x75\163\145\137\x62\165\x74\x74\x6f\156\137\141\163\x5f\167\151\144\x67\145\x74", $_POST)) {
            goto C5;
        }
        $PF = "\x66\141\154\163\145";
        goto ko;
        C5:
        $PF = htmlspecialchars($_POST["\x6d\x6f\137\x73\x61\x6d\154\137\x75\163\145\137\142\x75\164\x74\157\156\137\x61\163\x5f\x77\151\x64\x67\145\164"]);
        ko:
        update_option("\x6d\157\137\x73\141\x6d\154\x5f\x75\x73\145\137\x62\x75\x74\x74\157\156\x5f\x61\x73\x5f\167\151\144\x67\x65\x74", $PF);
        update_option("\155\x6f\x5f\163\x61\x6d\x6c\137\155\x65\163\x73\141\147\145", "\123\x69\x67\x6e\40\151\x6e\x20\x6f\x70\164\x69\157\x6e\x73\x20\165\160\x64\x61\164\x65\144\x2e");
        $this->mo_saml_show_success_message();
        WR:
        rr:
        goto tV;
        f6:
        if (mo_saml_is_sp_configured()) {
            goto Vk;
        }
        update_option("\x6d\x6f\x5f\163\141\x6d\x6c\x5f\155\x65\x73\163\x61\x67\x65", "\120\154\145\141\x73\x65\40\x63\157\155\160\x6c\x65\164\x65\x20" . addLink("\123\x65\x72\x76\151\x63\145\x20\x50\x72\x6f\166\x69\144\145\162", add_query_arg(array("\x74\x61\142" => "\x73\141\x76\145"), $_SERVER["\x52\x45\x51\125\105\x53\124\137\x55\x52\111"])) . "\40\143\x6f\156\x66\x69\147\165\162\x61\164\x69\x6f\156\40\146\151\x72\163\x74\56");
        $this->mo_saml_show_error_message();
        goto vq;
        Vk:
        if (array_key_exists("\x6d\157\137\x73\141\x6d\x6c\x5f\x75\163\145\x5f\x62\x75\x74\x74\157\156\x5f\x61\163\x5f\x73\150\157\162\164\x63\x6f\x64\x65", $_POST)) {
            goto Nf;
        }
        $PF = "\x66\x61\154\163\x65";
        goto ca;
        Nf:
        $PF = htmlspecialchars($_POST["\155\157\137\163\x61\155\x6c\x5f\x75\163\145\x5f\142\165\164\x74\x6f\x6e\x5f\x61\163\x5f\x73\150\x6f\x72\164\x63\x6f\x64\x65"]);
        ca:
        update_option("\155\157\x5f\x73\x61\x6d\154\137\x75\x73\x65\x5f\x62\x75\164\164\157\156\137\141\x73\137\163\150\x6f\162\x74\143\157\144\145", $PF);
        update_option("\155\x6f\137\x73\141\x6d\x6c\137\x6d\x65\x73\x73\141\x67\x65", "\x53\151\x67\156\x20\151\156\x20\157\x70\164\x69\x6f\156\163\x20\165\160\144\141\x74\145\x64\x2e");
        $this->mo_saml_show_success_message();
        vq:
        tV:
        goto je;
        fw:
        if (mo_saml_is_sp_configured()) {
            goto We;
        }
        update_option("\x6d\157\x5f\x73\141\x6d\x6c\x5f\x6d\x65\163\x73\x61\147\x65", "\x50\154\145\x61\163\x65\40\143\157\155\160\x6c\x65\x74\145\x20" . addLink("\123\x65\162\166\x69\x63\145\x20\x50\x72\157\166\x69\144\145\162", add_query_arg(array("\164\x61\142" => "\163\x61\x76\x65"), $_SERVER["\x52\x45\121\125\x45\x53\124\137\125\x52\x49"])) . "\40\143\157\156\x66\151\x67\165\x72\x61\x74\x69\157\156\x20\x66\151\162\163\164\x2e");
        $this->mo_saml_show_error_message();
        goto pF;
        We:
        if (array_key_exists("\155\x6f\137\163\141\x6d\x6c\137\141\x64\x64\x5f\x73\163\157\137\142\x75\164\x74\x6f\156\x5f\167\160", $_POST)) {
            goto V7;
        }
        $q7 = "\146\x61\154\x73\145";
        goto o3;
        V7:
        $q7 = htmlspecialchars($_POST["\x6d\157\x5f\163\141\155\x6c\137\141\144\144\x5f\x73\163\157\137\142\x75\x74\x74\x6f\x6e\137\167\160"]);
        o3:
        update_option("\x6d\x6f\137\163\x61\155\154\x5f\x61\144\x64\x5f\163\163\x6f\137\x62\x75\164\x74\x6f\x6e\x5f\167\160", $q7);
        update_option("\155\157\137\x73\141\155\154\137\155\x65\x73\x73\x61\147\x65", "\x53\x69\x67\156\40\x69\156\x20\157\x70\x74\151\x6f\156\x73\x20\x75\160\144\x61\x74\x65\x64\56");
        $this->mo_saml_show_success_message();
        pF:
        je:
        goto RW;
        ht:
        if (mo_saml_is_sp_configured()) {
            goto v4;
        }
        update_option("\155\157\137\163\141\x6d\154\x5f\x6d\x65\x73\x73\x61\x67\x65", "\x50\154\145\x61\x73\x65\x20\x63\157\155\x70\x6c\x65\164\x65\x20" . addLink("\123\145\x72\x76\151\x63\x65\40\120\x72\x6f\166\x69\x64\x65\162", add_query_arg(array("\164\x61\142" => "\163\141\x76\x65"), $_SERVER["\122\105\x51\125\x45\x53\124\x5f\x55\122\x49"])) . "\40\143\157\x6e\x66\x69\147\x75\x72\x61\x74\151\x6f\156\40\146\x69\x72\163\x74\56");
        $this->mo_saml_show_error_message();
        goto M2;
        v4:
        if (array_key_exists("\x6d\157\x5f\163\141\x6d\x6c\x5f\x65\x6e\x61\142\x6c\145\x5f\154\x6f\147\151\x6e\x5f\x72\x65\x64\x69\162\x65\143\x74", $_POST)) {
            goto nO;
        }
        $Z3 = "\146\x61\154\163\x65";
        goto f5;
        nO:
        $Z3 = htmlspecialchars($_POST["\x6d\157\x5f\x73\141\155\154\137\x65\156\x61\142\x6c\x65\x5f\154\157\x67\x69\x6e\x5f\x72\145\144\151\x72\x65\x63\x74"]);
        f5:
        if ($Z3 == "\164\162\165\145") {
            goto t8;
        }
        update_option("\x6d\157\137\163\x61\x6d\x6c\137\x65\156\x61\x62\154\x65\x5f\154\x6f\x67\151\x6e\137\x72\x65\144\x69\162\145\143\164", '');
        update_option("\155\157\x5f\163\x61\x6d\x6c\137\141\x6c\154\x6f\x77\137\x77\x70\137\163\151\x67\x6e\x69\156", '');
        goto XF;
        t8:
        update_option("\155\x6f\137\163\x61\x6d\x6c\137\145\156\141\142\154\x65\x5f\x6c\157\x67\151\156\137\162\x65\x64\x69\x72\145\143\164", "\x74\x72\x75\x65");
        update_option("\x6d\157\137\163\x61\x6d\154\137\141\154\154\157\x77\137\167\160\137\163\151\147\x6e\151\156", "\x74\162\165\x65");
        XF:
        update_option("\155\157\x5f\163\x61\155\154\137\155\145\163\x73\141\x67\145", "\x53\151\147\x6e\x20\151\156\40\157\x70\x74\x69\157\x6e\163\x20\165\x70\144\x61\164\145\x64\56");
        $this->mo_saml_show_success_message();
        M2:
        RW:
        goto hJ;
        Zr:
        if (mo_saml_is_sp_configured()) {
            goto hh;
        }
        update_option("\155\x6f\137\163\141\155\x6c\137\155\145\x73\163\x61\147\145", "\120\154\145\141\x73\x65\x20\143\x6f\x6d\160\154\145\164\x65\40" . addLink("\123\x65\x72\166\x69\143\x65\40\120\162\157\166\x69\x64\x65\x72", add_query_arg(array("\x74\141\142" => "\x73\141\166\145"), $_SERVER["\x52\105\121\x55\105\123\124\x5f\x55\x52\x49"])) . "\x20\143\x6f\156\146\x69\x67\x75\162\141\164\x69\157\x6e\x20\146\151\x72\163\164\56");
        $this->mo_saml_show_error_message();
        goto Rr;
        hh:
        if (array_key_exists("\155\x6f\137\163\x61\x6d\x6c\137\145\156\x61\142\154\x65\137\162\163\x73\x5f\141\x63\143\145\163\163", $_POST)) {
            goto r8;
        }
        $Tg = false;
        goto bz;
        r8:
        $Tg = htmlspecialchars($_POST["\155\x6f\137\163\141\x6d\x6c\x5f\x65\156\141\x62\x6c\145\137\162\163\x73\137\x61\143\143\x65\163\163"]);
        bz:
        if ($Tg == "\x74\x72\x75\x65") {
            goto gI;
        }
        update_option("\x6d\157\137\x73\x61\x6d\154\x5f\x65\156\x61\x62\154\145\137\x72\163\163\x5f\x61\x63\x63\145\163\163", '');
        goto qp;
        gI:
        update_option("\x6d\157\137\x73\x61\155\x6c\x5f\145\156\x61\142\x6c\x65\x5f\x72\163\163\137\x61\143\143\145\x73\x73", "\164\x72\165\145");
        qp:
        update_option("\x6d\157\137\163\x61\155\x6c\x5f\x6d\x65\163\163\141\147\x65", "\x52\123\123\40\x46\145\x65\144\40\157\x70\x74\151\x6f\x6e\x20\x75\x70\x64\141\164\145\144\x2e");
        $this->mo_saml_show_success_message();
        Rr:
        hJ:
        goto TK;
        WH:
        if (mo_saml_is_sp_configured()) {
            goto cY;
        }
        update_option("\155\x6f\137\163\141\155\154\x5f\155\145\163\x73\141\x67\x65", "\120\x6c\145\141\163\145\x20\143\157\155\160\x6c\x65\x74\145\40" . addLink("\123\x65\x72\166\x69\143\x65\40\120\x72\x6f\166\151\144\145\x72", add_query_arg(array("\164\x61\142" => "\x73\141\166\145"), $_SERVER["\x52\x45\121\125\x45\123\x54\137\x55\x52\111"])) . "\x20\x63\x6f\x6e\x66\x69\147\165\x72\x61\x74\151\x6f\x6e\x20\x66\x69\x72\163\x74\56");
        $this->mo_saml_show_error_message();
        goto BL;
        cY:
        if (array_key_exists("\155\157\x5f\163\x61\x6d\154\137\146\x6f\162\143\x65\137\141\165\164\x68\145\x6e\164\151\143\x61\x74\151\x6f\x6e", $_POST)) {
            goto bc;
        }
        $Z3 = "\146\141\154\x73\x65";
        goto m6;
        bc:
        $Z3 = htmlspecialchars($_POST["\155\x6f\137\163\141\155\154\137\146\x6f\162\143\x65\x5f\x61\165\164\150\x65\x6e\164\151\x63\x61\164\151\157\156"]);
        m6:
        if ($Z3 == "\x74\x72\165\x65") {
            goto L7;
        }
        update_option("\155\157\x5f\x73\x61\155\x6c\x5f\x66\x6f\x72\x63\145\137\141\165\164\x68\x65\156\x74\151\143\x61\x74\x69\x6f\x6e", '');
        goto P9;
        L7:
        update_option("\155\x6f\137\163\x61\155\154\137\x66\157\162\143\145\137\141\x75\x74\150\x65\156\164\x69\143\x61\x74\x69\157\x6e", "\x74\162\x75\145");
        P9:
        update_option("\155\x6f\137\x73\141\155\154\x5f\x6d\x65\163\x73\x61\147\x65", "\123\151\x67\x6e\40\x69\156\40\157\x70\x74\151\157\156\163\40\x75\x70\144\141\164\x65\x64\56");
        $this->mo_saml_show_success_message();
        BL:
        TK:
        goto Ak;
        yL:
        if (!mo_saml_is_sp_configured()) {
            goto Mw;
        }
        if (array_key_exists("\x6d\x6f\x5f\x73\x61\x6d\154\137\162\x65\144\x69\x72\x65\x63\164\137\164\x6f\137\167\160\x5f\x6c\x6f\x67\x69\x6e", $_POST)) {
            goto k0;
        }
        $cW = "\x66\141\x6c\163\x65";
        goto vH;
        k0:
        $cW = htmlspecialchars($_POST["\x6d\157\x5f\x73\141\x6d\154\137\x72\145\144\151\x72\145\x63\164\137\164\157\x5f\167\x70\x5f\x6c\x6f\147\151\x6e"]);
        vH:
        update_option("\x6d\x6f\137\x73\x61\x6d\154\x5f\162\x65\144\x69\x72\x65\143\x74\x5f\x74\157\x5f\x77\160\137\154\x6f\x67\151\x6e", $cW);
        update_option("\x6d\157\x5f\x73\x61\x6d\154\137\x6d\145\x73\163\141\147\x65", "\123\x69\x67\156\x20\x69\156\x20\157\x70\x74\151\x6f\156\163\40\165\160\x64\141\x74\x65\144\56");
        $this->mo_saml_show_success_message();
        Mw:
        Ak:
        goto Mh;
        aJ:
        if (mo_saml_is_sp_configured()) {
            goto Sb;
        }
        update_option("\155\157\x5f\163\x61\155\154\137\x6d\x65\163\163\x61\x67\x65", "\x50\154\x65\x61\x73\145\x20\143\x6f\x6d\160\x6c\145\164\145\40" . addLink("\x53\x65\x72\x76\151\143\x65\x20\120\x72\157\x76\x69\x64\145\x72", add_query_arg(array("\164\141\x62" => "\163\x61\x76\145"), $_SERVER["\x52\x45\x51\x55\x45\123\x54\x5f\125\x52\x49"])) . "\40\143\x6f\x6e\x66\x69\147\x75\x72\141\x74\151\x6f\x6e\40\x66\x69\162\163\164\56");
        $this->mo_saml_show_error_message();
        goto Km;
        Sb:
        if (array_key_exists("\155\x6f\x5f\163\x61\x6d\x6c\x5f\162\145\147\x69\163\164\x65\x72\145\144\x5f\x6f\x6e\x6c\x79\137\141\x63\x63\145\x73\163", $_POST)) {
            goto U9;
        }
        $Z3 = "\146\x61\x6c\163\x65";
        goto NT;
        U9:
        $Z3 = htmlspecialchars($_POST["\155\157\137\x73\141\x6d\154\x5f\162\x65\147\151\x73\x74\145\x72\145\144\137\x6f\156\154\171\x5f\x61\143\x63\x65\163\x73"]);
        NT:
        if ($Z3 == "\164\162\x75\x65") {
            goto x9;
        }
        update_option("\155\x6f\137\163\141\155\x6c\x5f\x72\145\x67\x69\x73\164\145\x72\x65\144\x5f\x6f\156\x6c\171\x5f\x61\x63\143\145\x73\163", '');
        goto DV;
        x9:
        update_option("\x6d\x6f\x5f\x73\x61\155\154\137\x72\x65\147\151\163\x74\x65\x72\145\144\137\157\156\x6c\171\137\x61\x63\x63\x65\x73\163", "\x74\162\x75\x65");
        DV:
        update_option("\155\157\137\x73\x61\x6d\154\137\x6d\145\x73\x73\x61\x67\145", "\x53\x69\x67\x6e\40\151\156\x20\157\x70\164\x69\x6f\x6e\163\x20\165\x70\x64\x61\164\145\x64\56");
        $this->mo_saml_show_success_message();
        Km:
        Mh:
        goto GC;
        ZL:
        if (mo_saml_is_extension_installed("\143\x75\x72\x6c")) {
            goto Un;
        }
        update_option("\155\157\x5f\x73\141\155\x6c\x5f\x6d\x65\x73\x73\141\x67\145", "\105\122\122\117\x52\72\x20\120\110\120\40\x63\x55\x52\x4c\x20\145\170\164\145\x6e\163\x69\157\156\40\x69\x73\x20\x6e\x6f\x74\40\x69\x6e\163\x74\141\x6c\154\x65\x64\40\157\x72\40\x64\151\x73\x61\x62\154\145\144\56\40\x52\x65\163\145\156\144\x20\117\x54\x50\x20\x66\x61\x69\154\145\144\x2e");
        $this->mo_saml_show_error_message();
        return;
        Un:
        $mp = htmlspecialchars($_POST["\x70\x68\157\156\145"]);
        $mp = str_replace("\x20", '', $mp);
        $mp = str_replace("\x2d", '', $mp);
        update_option("\155\157\x5f\163\x61\155\154\137\141\144\155\151\x6e\137\160\x68\157\156\145", $mp);
        $dI = new CustomerSaml();
        $fY = $dI->send_otp_token('', $mp, FALSE, TRUE);
        if ($fY) {
            goto Fr;
        }
        return;
        Fr:
        $fY = json_decode($fY, true);
        if (strcasecmp($fY["\163\164\141\164\165\163"], "\123\125\103\103\x45\x53\123") == 0) {
            goto kk;
        }
        update_option("\x6d\x6f\137\163\x61\x6d\154\x5f\x6d\x65\163\x73\141\x67\x65", "\x54\x68\x65\x72\145\40\167\x61\163\40\141\156\40\145\x72\162\157\x72\x20\151\x6e\40\x73\x65\156\144\x69\156\147\40\123\x4d\x53\56\x20\120\154\145\141\x73\x65\x20\x63\x6c\x69\x63\x6b\x20\157\x6e\x20\x52\x65\x73\x65\156\144\40\117\x54\120\40\x74\157\40\x74\162\x79\x20\141\147\141\151\x6e\x2e");
        update_option("\x6d\x6f\x5f\163\141\x6d\x6c\137\x72\145\x67\x69\x73\x74\x72\x61\164\x69\157\156\x5f\x73\x74\x61\x74\x75\x73", "\115\x4f\137\x4f\x54\x50\x5f\104\105\x4c\111\x56\105\122\105\104\x5f\x46\101\111\114\125\122\x45\137\120\110\x4f\116\105");
        $this->mo_saml_show_error_message();
        goto IG;
        kk:
        update_option("\x6d\157\x5f\x73\141\155\154\x5f\155\145\163\163\141\x67\x65", "\40\101\x20\157\156\145\x20\164\x69\155\145\x20\x70\141\163\x73\x63\157\x64\145\40\x69\163\40\x73\x65\156\164\40\164\x6f\x20" . get_option("\155\157\x5f\x73\x61\x6d\154\137\141\144\155\151\156\137\x70\150\x6f\156\145") . "\x2e\40\120\x6c\x65\141\163\145\x20\x65\x6e\x74\x65\x72\x20\x74\x68\145\x20\x6f\164\x70\x20\x68\145\x72\x65\x20\x74\x6f\x20\166\x65\x72\151\146\171\40\x79\x6f\x75\x72\x20\145\x6d\141\x69\x6c\56");
        update_option("\x6d\x6f\x5f\163\x61\155\x6c\137\x74\162\x61\156\163\x61\x63\164\151\157\x6e\x49\144", $fY["\164\x78\111\144"]);
        update_option("\x6d\x6f\137\x73\141\155\154\137\162\x65\147\x69\163\x74\x72\x61\x74\x69\x6f\156\x5f\x73\164\141\x74\x75\x73", "\x4d\x4f\x5f\117\x54\x50\x5f\104\x45\x4c\111\x56\x45\122\105\x44\137\123\x55\103\x43\x45\x53\x53\x5f\120\110\x4f\x4e\x45");
        $this->mo_saml_show_success_message();
        IG:
        GC:
        goto ys;
        FD:
        update_option("\x6d\157\137\163\x61\x6d\154\x5f\x72\145\147\x69\163\x74\x72\x61\164\151\x6f\156\137\163\x74\x61\x74\x75\163", '');
        update_option("\x6d\157\137\x73\141\155\x6c\x5f\x76\x65\x72\x69\x66\x79\x5f\x63\x75\x73\x74\x6f\155\145\162", '');
        delete_option("\x6d\157\137\163\x61\x6d\x6c\x5f\x6e\x65\x77\137\162\145\x67\x69\163\x74\162\141\164\151\x6f\156");
        delete_option("\155\x6f\x5f\163\x61\x6d\154\x5f\141\144\x6d\x69\156\x5f\145\155\x61\x69\154");
        delete_option("\155\x6f\137\x73\141\x6d\x6c\x5f\141\144\x6d\x69\x6e\137\160\x68\x6f\x6e\x65");
        delete_site_option("\163\155\x6c\x5f\154\153");
        delete_site_option("\164\137\x73\151\164\145\137\163\164\141\164\165\163");
        delete_site_option("\x73\151\x74\145\x5f\143\153\137\x6c");
        ys:
        goto aW;
        pu:
        if (mo_saml_is_extension_installed("\143\x75\x72\x6c")) {
            goto ub;
        }
        update_option("\x6d\157\137\x73\141\155\x6c\x5f\x6d\145\163\x73\141\147\145", "\x45\x52\122\x4f\122\x3a\x20\x50\x48\x50\x20\x63\x55\122\x4c\40\145\170\164\145\x6e\x73\151\157\x6e\40\151\x73\x20\156\x6f\x74\x20\151\156\163\x74\x61\154\x6c\x65\x64\x20\x6f\162\x20\144\x69\163\x61\142\154\x65\144\56\x20\x52\145\163\145\x6e\x64\40\117\124\120\40\x66\141\x69\154\145\x64\x2e");
        $this->mo_saml_show_error_message();
        return;
        ub:
        $mp = get_option("\155\157\x5f\163\141\x6d\x6c\x5f\141\144\155\151\156\137\x70\x68\157\x6e\145");
        $dI = new CustomerSaml();
        $fY = $dI->send_otp_token('', $mp, FALSE, TRUE);
        if ($fY) {
            goto c5;
        }
        return;
        c5:
        $fY = json_decode($fY, true);
        if (strcasecmp($fY["\163\x74\x61\x74\165\163"], "\x53\125\103\x43\105\x53\123") == 0) {
            goto Gf;
        }
        update_option("\155\x6f\x5f\163\141\155\154\x5f\x6d\145\163\x73\x61\x67\145", "\124\150\145\x72\x65\40\167\141\163\x20\x61\156\40\x65\162\x72\157\x72\x20\151\x6e\x20\163\145\156\x64\x69\x6e\147\x20\x65\x6d\x61\151\154\56\40\x50\x6c\145\x61\163\x65\x20\x63\x6c\x69\x63\x6b\40\157\156\40\122\x65\163\x65\x6e\144\x20\117\124\120\40\164\x6f\x20\x74\162\x79\40\141\147\x61\x69\156\56");
        update_option("\155\157\x5f\163\x61\155\x6c\137\x72\145\147\x69\x73\164\x72\141\164\151\x6f\156\x5f\163\x74\141\164\x75\x73", "\x4d\x4f\137\x4f\x54\x50\x5f\x44\105\114\x49\x56\105\x52\x45\x44\x5f\x46\x41\x49\x4c\x55\122\x45\x5f\x50\110\x4f\116\105");
        $this->mo_saml_show_error_message();
        goto H9;
        Gf:
        update_option("\x6d\x6f\137\163\141\155\x6c\137\155\x65\163\x73\141\x67\145", "\40\x41\x20\x6f\x6e\145\x20\164\151\x6d\145\40\160\x61\163\163\143\x6f\144\145\40\x69\x73\x20\163\145\156\164\x20\x74\x6f\x20" . $mp . "\x20\141\147\141\x69\x6e\56\x20\x50\154\145\x61\x73\145\x20\x63\x68\145\x63\x6b\40\151\x66\x20\x79\x6f\x75\x20\147\157\x74\40\x74\150\x65\40\x6f\x74\x70\40\x61\x6e\x64\40\x65\x6e\x74\x65\x72\x20\x69\164\40\x68\145\x72\145\56");
        update_option("\155\x6f\137\x73\141\155\154\137\x74\x72\x61\x6e\163\x61\143\x74\151\157\156\111\x64", $fY["\164\170\111\144"]);
        update_option("\x6d\x6f\137\163\x61\x6d\154\x5f\162\x65\147\151\x73\164\x72\x61\x74\151\x6f\156\137\x73\x74\x61\164\x75\163", "\115\x4f\137\117\124\120\137\104\x45\x4c\111\x56\x45\122\x45\104\x5f\123\125\103\103\105\x53\123\137\120\110\x4f\116\x45");
        $this->mo_saml_show_success_message();
        H9:
        aW:
        goto ct;
        ba:
        if (mo_saml_is_extension_installed("\x63\165\162\154")) {
            goto bo;
        }
        update_option("\155\x6f\x5f\x73\x61\x6d\x6c\137\x6d\145\163\163\141\147\x65", "\105\x52\122\x4f\122\x3a\x20\x50\110\x50\40\x63\x55\x52\x4c\40\x65\170\164\145\156\163\x69\157\156\40\151\x73\40\156\157\x74\x20\x69\x6e\163\x74\141\154\154\145\x64\x20\157\x72\40\144\151\x73\x61\x62\154\x65\x64\x2e\40\x52\145\163\x65\156\144\x20\x4f\x54\x50\40\146\x61\x69\x6c\x65\x64\x2e");
        $this->mo_saml_show_error_message();
        return;
        bo:
        $Dm = get_option("\155\157\x5f\x73\141\x6d\x6c\137\x61\144\155\x69\x6e\137\145\155\x61\x69\x6c");
        $dI = new CustomerSaml();
        $fY = $dI->send_otp_token($Dm, '');
        if ($fY) {
            goto q_;
        }
        return;
        q_:
        $fY = json_decode($fY, true);
        if (strcasecmp($fY["\x73\x74\141\x74\165\x73"], "\123\125\x43\x43\x45\123\123") == 0) {
            goto j6;
        }
        update_option("\155\x6f\137\163\x61\x6d\154\x5f\155\x65\x73\x73\x61\x67\x65", "\x54\x68\x65\162\x65\x20\167\141\163\40\x61\156\x20\x65\x72\162\x6f\x72\x20\151\156\40\x73\x65\x6e\144\151\156\x67\40\x65\155\x61\151\154\x2e\x20\120\x6c\x65\x61\x73\145\40\x63\x6c\151\x63\x6b\40\157\x6e\40\x52\145\163\145\156\x64\40\117\124\x50\x20\164\x6f\40\164\162\171\x20\141\147\x61\151\x6e\56");
        update_option("\155\157\137\163\x61\155\154\137\162\x65\147\x69\x73\164\162\x61\x74\151\157\x6e\x5f\163\x74\141\x74\x75\x73", "\115\117\137\117\x54\x50\x5f\104\x45\114\x49\x56\105\x52\105\104\x5f\106\x41\x49\114\125\122\x45\137\105\x4d\x41\111\114");
        $this->mo_saml_show_error_message();
        goto nn;
        j6:
        update_option("\x6d\x6f\137\x73\141\155\x6c\x5f\155\x65\163\163\141\147\x65", "\x20\101\x20\157\156\145\x20\x74\x69\x6d\145\x20\160\x61\163\163\x63\x6f\x64\145\40\151\x73\x20\163\145\x6e\164\40\164\157\40" . get_option("\x6d\157\137\163\141\x6d\x6c\137\141\144\155\x69\x6e\x5f\x65\x6d\141\x69\x6c") . "\x20\x61\147\141\x69\x6e\x2e\40\x50\x6c\145\141\163\x65\x20\143\x68\145\x63\153\40\151\146\40\x79\157\165\40\x67\157\164\40\x74\150\x65\x20\157\164\x70\x20\141\156\144\40\145\x6e\x74\145\162\x20\151\164\x20\150\x65\162\145\x2e");
        update_option("\x6d\157\137\163\141\155\154\x5f\x74\162\x61\x6e\163\x61\x63\164\151\x6f\x6e\111\x64", $fY["\164\x78\x49\144"]);
        update_option("\155\157\x5f\x73\141\x6d\x6c\x5f\x72\145\147\x69\163\164\162\141\x74\151\x6f\x6e\x5f\x73\x74\x61\164\165\163", "\115\117\x5f\x4f\x54\x50\x5f\x44\105\x4c\x49\126\x45\x52\x45\x44\137\123\x55\x43\x43\x45\x53\x53\137\105\115\101\111\114");
        $this->mo_saml_show_success_message();
        nn:
        ct:
        goto t2;
        Py:
        if (mo_saml_is_extension_installed("\143\165\x72\154")) {
            goto GH;
        }
        update_option("\x6d\157\x5f\163\141\x6d\x6c\137\155\145\163\x73\141\147\x65", "\105\122\x52\x4f\122\72\40\120\x48\x50\40\143\125\122\114\x20\145\x78\164\145\x6e\x73\151\157\156\x20\x69\163\x20\156\x6f\164\40\151\x6e\163\164\x61\154\154\x65\x64\x20\157\x72\40\x64\151\x73\x61\142\x6c\x65\x64\x2e\x20\x51\165\145\x72\171\x20\x73\165\x62\x6d\151\x74\40\x66\x61\x69\x6c\x65\x64\56");
        $this->mo_saml_show_error_message();
        return;
        GH:
        $Dm = sanitize_email($_POST["\155\x6f\137\x73\141\x6d\154\x5f\x63\x6f\x6e\164\141\x63\x74\x5f\165\163\x5f\145\x6d\141\x69\154"]);
        $mp = htmlspecialchars($_POST["\155\157\137\x73\x61\x6d\x6c\137\x63\x6f\x6e\164\x61\x63\x74\137\x75\x73\137\x70\x68\157\x6e\145"]);
        $k0 = htmlspecialchars($_POST["\155\157\137\x73\x61\x6d\154\x5f\143\157\156\164\141\143\x74\x5f\x75\x73\137\x71\x75\145\x72\171"]);
        if (array_key_exists("\x73\145\x6e\x64\x5f\160\x6c\x75\x67\x69\x6e\x5f\143\x6f\x6e\x66\x69\x67", $_POST) === true) {
            goto y9;
        }
        update_option("\163\145\x6e\144\137\x70\x6c\165\147\x69\x6e\x5f\143\x6f\156\146\151\x67", "\157\x66\x66");
        goto Z5;
        y9:
        $wz = miniorange_import_export(true, true);
        $k0 .= $wz;
        delete_option("\163\145\156\x64\x5f\x70\154\x75\147\x69\156\x5f\x63\x6f\x6e\x66\x69\x67");
        Z5:
        $dI = new CustomerSaml();
        if ($this->mo_saml_check_empty_or_null($Dm) || $this->mo_saml_check_empty_or_null($k0)) {
            goto su;
        }
        if (!filter_var($Dm, FILTER_VALIDATE_EMAIL)) {
            goto DE;
        }
        $be = $dI->submit_contact_us($Dm, $mp, $k0);
        if ($be) {
            goto W3;
        }
        return;
        W3:
        update_option("\155\x6f\137\x73\141\155\154\137\155\x65\163\163\x61\x67\x65", "\x54\x68\x61\156\x6b\x73\x20\146\157\x72\x20\x67\x65\x74\x74\x69\x6e\x67\x20\x69\156\40\164\x6f\165\143\150\41\40\x57\x65\x20\x73\150\x61\x6c\154\x20\x67\x65\x74\40\142\141\x63\153\x20\164\157\x20\x79\x6f\x75\40\x73\150\157\x72\164\154\171\56");
        $this->mo_saml_show_success_message();
        goto LP;
        DE:
        update_option("\155\x6f\137\x73\x61\155\154\x5f\155\x65\163\163\141\x67\x65", "\120\154\145\x61\163\x65\x20\145\x6e\164\x65\x72\40\141\40\x76\x61\x6c\151\144\40\x65\x6d\141\x69\x6c\x20\141\x64\144\162\145\x73\163\56");
        $this->mo_saml_show_error_message();
        return;
        LP:
        goto S7;
        su:
        update_option("\x6d\x6f\137\163\x61\155\x6c\137\x6d\145\x73\163\x61\147\x65", "\120\154\x65\141\x73\x65\40\x66\x69\154\154\40\165\160\x20\x45\x6d\141\x69\x6c\40\141\x6e\x64\x20\121\x75\x65\162\171\x20\x66\x69\x65\154\144\163\40\x74\157\40\x73\x75\x62\x6d\x69\164\x20\x79\x6f\165\162\40\161\x75\145\x72\171\x2e");
        $this->mo_saml_show_error_message();
        S7:
        t2:
        goto Ed;
        hv:
        if (mo_saml_is_extension_installed("\x63\165\x72\x6c")) {
            goto WI;
        }
        update_option("\155\x6f\137\x73\x61\x6d\154\x5f\155\x65\x73\x73\x61\x67\x65", "\105\122\x52\x4f\122\72\x20\x50\110\x50\40\x63\x55\x52\x4c\40\145\170\x74\145\156\x73\151\157\156\x20\x69\x73\40\156\x6f\164\x20\151\156\x73\164\141\154\154\145\144\40\x6f\x72\x20\144\151\x73\141\x62\154\x65\x64\x2e\x20\114\157\147\151\x6e\40\x66\x61\151\x6c\145\144\x2e");
        $this->mo_saml_show_error_message();
        return;
        WI:
        $Dm = '';
        $ZL = self::get_empty_strings();
        if ($this->mo_saml_check_empty_or_null($_POST["\x65\155\x61\151\x6c"]) || $this->mo_saml_check_empty_or_null($_POST["\x70\141\163\x73\x77\x6f\162\x64"])) {
            goto TN;
        }
        if ($this->checkPasswordPattern(strip_tags($_POST["\x70\141\163\163\167\157\162\x64"]))) {
            goto jm;
        }
        $Dm = sanitize_email($_POST["\x65\155\x61\151\154"]);
        $ZL = stripslashes(strip_tags($_POST["\160\141\x73\163\x77\157\162\144"]));
        goto vy;
        jm:
        update_option("\155\157\x5f\163\x61\x6d\154\x5f\155\x65\x73\x73\x61\147\145", "\115\151\x6e\x69\x6d\165\155\x20\x36\40\x63\150\x61\162\141\143\x74\145\x72\x73\40\x73\x68\x6f\165\x6c\x64\x20\142\145\x20\160\162\145\x73\x65\x6e\164\56\40\x4d\141\x78\x69\155\165\155\x20\61\65\40\x63\x68\x61\x72\x61\143\164\x65\x72\163\40\163\150\x6f\x75\154\x64\x20\142\145\40\x70\162\x65\x73\x65\156\164\56\x20\117\x6e\154\x79\40\146\157\x6c\x6c\x6f\167\151\x6e\147\40\x73\171\155\x62\157\154\163\40\x28\x21\100\43\56\44\x25\x5e\46\52\55\x5f\x29\40\163\150\x6f\165\x6c\x64\40\x62\145\40\x70\162\145\163\x65\156\x74\56");
        $this->mo_saml_show_error_message();
        return;
        vy:
        goto vF;
        TN:
        update_option("\155\x6f\137\163\x61\x6d\x6c\137\x6d\145\163\163\141\x67\x65", "\101\x6c\154\x20\164\x68\x65\40\x66\x69\145\x6c\x64\163\40\141\x72\145\40\162\x65\161\165\151\162\x65\x64\x2e\x20\120\x6c\x65\141\x73\145\40\x65\156\x74\x65\x72\x20\166\141\x6c\151\144\x20\x65\156\164\x72\x69\x65\163\x2e");
        $this->mo_saml_show_error_message();
        return;
        vF:
        update_option("\x6d\157\137\x73\x61\x6d\154\x5f\x61\144\155\x69\x6e\137\145\x6d\141\x69\x6c", $Dm);
        update_option("\155\157\x5f\x73\x61\155\x6c\x5f\141\144\155\151\x6e\x5f\x70\x61\x73\163\x77\157\162\144", $ZL);
        $dI = new Customersaml();
        $fY = $dI->get_customer_key();
        if ($fY) {
            goto qe;
        }
        return;
        qe:
        $Da = json_decode($fY, true);
        if (json_last_error() == JSON_ERROR_NONE) {
            goto n6;
        }
        update_option("\155\157\x5f\x73\141\155\154\x5f\x6d\x65\163\163\141\147\145", "\x49\x6e\x76\x61\x6c\x69\x64\40\165\x73\145\162\156\141\155\145\x20\157\162\40\x70\141\x73\163\167\157\162\x64\56\x20\x50\x6c\145\141\x73\x65\x20\164\162\171\x20\141\147\x61\151\x6e\x2e");
        $this->mo_saml_show_error_message();
        goto CE;
        n6:
        update_option("\155\x6f\137\x73\141\x6d\x6c\x5f\141\144\155\151\x6e\137\x63\x75\x73\164\157\x6d\145\162\137\153\145\171", $Da["\151\x64"]);
        update_option("\155\x6f\x5f\x73\x61\x6d\154\x5f\x61\144\155\x69\156\137\141\160\x69\137\153\145\x79", $Da["\141\x70\151\113\x65\x79"]);
        update_option("\x6d\157\137\x73\141\x6d\154\x5f\143\x75\163\x74\x6f\x6d\145\x72\137\x74\x6f\153\145\x6e", $Da["\164\x6f\153\x65\156"]);
        if (empty($Da["\x70\x68\x6f\x6e\145"])) {
            goto qf;
        }
        update_option("\155\157\x5f\x73\x61\x6d\x6c\137\141\144\155\151\156\x5f\x70\x68\157\x6e\x65", $Da["\x70\x68\x6f\x6e\x65"]);
        qf:
        update_option("\155\157\x5f\x73\141\x6d\154\x5f\x61\144\155\x69\x6e\x5f\160\141\163\163\167\157\x72\144", '');
        update_option("\x6d\157\137\x73\x61\x6d\x6c\137\155\x65\163\x73\x61\x67\x65", "\103\165\x73\164\157\155\145\162\40\162\145\x74\162\x69\145\x76\x65\144\x20\163\x75\143\x63\145\163\163\146\165\x6c\x6c\171");
        update_option("\x6d\x6f\x5f\163\141\155\154\137\162\x65\147\x69\163\164\162\x61\164\151\x6f\156\x5f\163\x74\141\164\x75\163", "\x45\x78\x69\x73\164\x69\x6e\x67\x20\125\163\x65\162");
        delete_option("\x6d\157\x5f\163\x61\155\154\137\166\x65\x72\151\146\171\x5f\x63\165\163\x74\x6f\155\145\162");
        if (get_option("\163\155\154\x5f\154\153")) {
            goto hV;
        }
        $this->mo_saml_show_success_message();
        goto bf;
        hV:
        $y9 = get_option("\155\157\x5f\x73\141\155\x6c\x5f\143\x75\x73\x74\x6f\x6d\145\162\x5f\164\157\153\x65\156");
        $ew = AESEncryption::decrypt_data(get_option("\x73\x6d\x6c\x5f\154\153"), $y9);
        $fY = json_decode($dI->mo_saml_vl($ew, false), true);
        update_option("\x76\154\137\143\x68\145\143\153\137\164", time());
        if (is_array($fY) and strcasecmp($fY["\163\164\x61\x74\165\163"], "\123\x55\x43\x43\x45\x53\x53") == 0) {
            goto YZ;
        }
        update_option("\x6d\157\x5f\x73\141\x6d\154\137\155\145\x73\x73\x61\x67\x65", "\114\151\x63\145\x6e\163\x65\40\x6b\145\171\x20\x66\x6f\162\40\x74\150\151\163\x20\x69\156\163\164\141\x6e\x63\145\x20\x69\x73\40\x69\x6e\x63\x6f\x72\x72\145\x63\x74\x2e\x20\115\x61\x6b\x65\x20\x73\165\162\x65\40\171\157\x75\40\150\x61\166\x65\x20\156\157\x74\40\x74\x61\x6d\x70\145\162\145\144\40\167\151\x74\x68\x20\x69\x74\x20\141\164\x20\x61\x6c\x6c\x2e\x20\120\154\x65\x61\163\x65\40\x65\x6e\164\145\x72\40\x61\x20\x76\x61\154\151\x64\x20\x6c\x69\x63\145\x6e\163\145\x20\153\145\171\56");
        delete_option("\x73\155\154\137\154\153");
        $this->mo_saml_show_error_message();
        goto mu;
        YZ:
        $s5 = plugin_dir_path(__FILE__);
        $GW = home_url();
        $GW = trim($GW, "\x2f");
        if (preg_match("\43\136\x68\x74\x74\160\50\163\x29\77\72\57\x2f\x23", $GW)) {
            goto gx;
        }
        $GW = "\150\164\x74\160\x3a\x2f\x2f" . $GW;
        gx:
        $X5 = parse_url($GW);
        $aY = preg_replace("\57\136\167\x77\x77\x5c\56\57", '', $X5["\150\x6f\163\164"]);
        $bX = wp_upload_dir();
        $Ka = $aY . "\55" . $bX["\x62\141\163\x65\x64\x69\x72"];
        $RQ = hash_hmac("\163\150\x61\x32\65\x36", $Ka, "\x34\104\110\x66\x6a\x67\x66\x6a\x61\x73\x6e\x64\x66\163\141\x6a\146\x48\x47\112");
        $Ve = $this->djkasjdksa();
        $Fv = round(strlen($Ve) / rand(2, 20));
        $Ve = substr_replace($Ve, $RQ, $Fv, 0);
        $U5 = base64_decode($Ve);
        if (is_writable($s5 . "\x6c\151\x63\145\x6e\x73\x65")) {
            goto FL;
        }
        $Ve = str_rot13($Ve);
        $Bf = base64_decode("\142\107\x4e\153\x61\155\164\x68\x63\62\160\153\141\63\x4e\x68\x59\x32\167\75");
        update_option($Bf, $Ve);
        goto zU;
        FL:
        file_put_contents($s5 . "\x6c\x69\x63\x65\x6e\x73\145", $U5);
        zU:
        update_option("\x6c\x63\167\x72\164\154\146\163\141\x6d\154", true);
        $this->mo_saml_show_success_message();
        mu:
        bf:
        CE:
        update_option("\x6d\x6f\x5f\x73\141\x6d\x6c\137\x61\x64\x6d\x69\156\x5f\x70\141\x73\x73\x77\157\162\x64", '');
        Ed:
        goto QG;
        gS:
        if (mo_saml_is_extension_installed("\x63\165\x72\154")) {
            goto CQ;
        }
        update_option("\x6d\157\x5f\163\141\x6d\x6c\x5f\155\145\163\163\x61\147\145", "\x45\x52\x52\x4f\122\72\40\x50\110\x50\40\143\125\122\x4c\40\145\170\164\145\156\163\x69\x6f\x6e\x20\x69\x73\x20\x6e\x6f\164\x20\x69\x6e\163\x74\141\x6c\154\x65\144\x20\157\162\40\x64\x69\x73\141\142\154\x65\144\56\40\126\141\x6c\x69\x64\141\164\145\x20\117\124\120\40\x66\141\x69\x6c\145\144\x2e");
        $this->mo_saml_show_error_message();
        return;
        CQ:
        $Qr = '';
        if ($this->mo_saml_check_empty_or_null($_POST["\x6f\x74\160\x5f\164\157\153\x65\156"])) {
            goto dy;
        }
        $Qr = htmlspecialchars($_POST["\157\164\x70\x5f\x74\157\153\x65\x6e"]);
        goto j1;
        dy:
        update_option("\x6d\157\x5f\163\141\155\x6c\137\x6d\x65\x73\163\141\147\145", "\120\x6c\x65\x61\x73\x65\40\145\156\164\145\162\40\141\x20\x76\141\154\x75\145\x20\151\156\x20\157\164\160\40\146\151\x65\x6c\144\56");
        $this->mo_saml_show_error_message();
        return;
        j1:
        $dI = new CustomerSaml();
        $fY = $dI->validate_otp_token(get_option("\155\157\137\x73\141\155\154\137\164\162\x61\x6e\163\141\143\x74\151\x6f\156\x49\x64"), $Qr);
        if ($fY) {
            goto P7;
        }
        return;
        P7:
        $fY = json_decode($fY, true);
        if (strcasecmp($fY["\x73\x74\141\x74\x75\163"], "\123\125\x43\103\105\123\123") == 0) {
            goto bK;
        }
        update_option("\155\157\x5f\x73\141\155\x6c\x5f\x6d\145\x73\x73\x61\x67\145", "\x49\x6e\166\x61\154\x69\144\x20\x6f\156\x65\40\x74\x69\x6d\x65\40\160\141\163\163\x63\157\144\x65\x2e\40\x50\x6c\145\x61\163\x65\40\145\x6e\x74\x65\x72\40\141\x20\x76\x61\x6c\151\x64\40\x6f\164\160\56");
        $this->mo_saml_show_error_message();
        goto ON;
        bK:
        $this->create_customer();
        ON:
        QG:
        goto uN;
        vU:
        if (mo_saml_is_extension_installed("\143\x75\x72\154")) {
            goto iM;
        }
        update_option("\155\x6f\137\x73\x61\x6d\154\137\155\145\x73\x73\141\147\x65", "\105\x52\x52\x4f\122\x3a\x20\x50\110\x50\x20\x63\125\x52\114\40\145\170\x74\x65\156\163\x69\x6f\x6e\40\x69\163\40\x6e\x6f\x74\40\x69\x6e\163\164\141\154\154\145\x64\40\x6f\x72\40\144\151\x73\x61\x62\154\145\144\56\40\122\145\147\x69\163\x74\x72\x61\x74\151\157\156\40\x66\141\151\154\145\x64\x2e");
        $this->mo_saml_show_error_message();
        return;
        iM:
        $Dm = '';
        $mp = '';
        $ZL = self::get_empty_strings();
        $Y1 = self::get_empty_strings();
        if ($this->mo_saml_check_empty_or_null($_POST["\145\155\141\151\x6c"]) || $this->mo_saml_check_empty_or_null($_POST["\160\x61\x73\x73\167\157\162\144"]) || $this->mo_saml_check_empty_or_null($_POST["\x63\x6f\156\146\151\162\x6d\x50\141\x73\163\x77\x6f\x72\144"])) {
            goto dV;
        }
        if (strlen($_POST["\x70\x61\163\x73\x77\x6f\x72\x64"]) < 6 || strlen($_POST["\x63\x6f\x6e\x66\x69\x72\x6d\x50\141\x73\163\167\157\x72\x64"]) < 6) {
            goto Cz;
        }
        if ($this->checkPasswordPattern(strip_tags($_POST["\160\141\x73\163\167\157\x72\144"]))) {
            goto x1;
        }
        $Dm = sanitize_email($_POST["\145\155\141\151\154"]);
        if (!isset($_POST["\x70\150\x6f\156\x65"])) {
            goto gj;
        }
        $mp = htmlspecialchars($_POST["\160\x68\157\156\145"]);
        gj:
        $ZL = stripslashes(strip_tags($_POST["\160\x61\x73\163\x77\157\x72\144"]));
        $Y1 = stripslashes(strip_tags($_POST["\x63\x6f\156\x66\151\x72\x6d\x50\x61\163\163\167\x6f\162\x64"]));
        goto PK;
        x1:
        update_option("\x6d\157\x5f\163\x61\155\154\137\x6d\145\163\163\141\147\x65", "\115\151\156\151\x6d\x75\x6d\40\66\40\x63\150\x61\162\x61\143\x74\x65\162\163\x20\x73\150\x6f\165\x6c\x64\40\x62\x65\x20\160\x72\145\x73\x65\156\x74\x2e\40\115\x61\170\x69\155\x75\x6d\x20\61\65\40\x63\x68\x61\162\141\143\x74\145\162\x73\x20\x73\x68\157\165\x6c\144\40\x62\145\x20\x70\x72\145\x73\145\156\164\x2e\x20\x4f\x6e\x6c\171\40\x66\157\x6c\x6c\157\x77\x69\156\147\x20\x73\171\155\x62\x6f\154\x73\40\x28\41\100\43\x2e\x24\45\136\46\52\x2d\x5f\51\40\163\150\157\x75\x6c\144\40\142\x65\x20\160\x72\145\x73\x65\x6e\164\x2e");
        $this->mo_saml_show_error_message();
        return;
        PK:
        goto nS;
        Cz:
        update_option("\x6d\157\137\163\141\x6d\154\x5f\155\145\163\163\x61\x67\x65", "\103\150\x6f\x6f\163\145\x20\x61\40\160\141\x73\x73\x77\157\x72\x64\x20\x77\x69\x74\150\40\x6d\x69\x6e\151\x6d\165\155\x20\x6c\145\156\147\x74\150\40\66\56");
        $this->mo_saml_show_error_message();
        return;
        nS:
        goto On;
        dV:
        update_option("\155\157\x5f\163\141\x6d\154\x5f\x6d\145\163\x73\x61\x67\145", "\x41\x6c\154\x20\x74\x68\145\40\x66\x69\x65\154\x64\163\x20\141\162\145\40\x72\x65\161\165\x69\x72\x65\144\56\40\120\154\x65\141\163\145\40\x65\156\164\x65\162\40\x76\141\x6c\x69\x64\x20\x65\x6e\x74\x72\151\x65\163\x2e");
        $this->mo_saml_show_error_message();
        return;
        On:
        update_option("\x6d\x6f\x5f\x73\x61\x6d\x6c\137\141\x64\155\151\156\x5f\145\155\x61\x69\154", $Dm);
        update_option("\155\157\137\x73\x61\155\154\137\141\x64\155\x69\156\x5f\160\150\x6f\x6e\145", $mp);
        if (strcmp($ZL, $Y1) == 0) {
            goto Xy;
        }
        update_option("\155\157\x5f\163\x61\155\154\x5f\155\x65\x73\163\x61\147\145", "\120\x61\x73\163\167\157\x72\144\x73\40\144\157\x20\x6e\157\164\40\155\x61\x74\x63\150\56");
        delete_option("\155\157\x5f\x73\x61\155\x6c\x5f\166\x65\162\151\x66\x79\x5f\143\x75\163\164\x6f\155\x65\162");
        $this->mo_saml_show_error_message();
        goto f8;
        Xy:
        update_option("\x6d\x6f\x5f\x73\141\155\x6c\x5f\141\x64\x6d\151\x6e\x5f\160\141\163\x73\167\x6f\x72\144", $ZL);
        $Dm = get_option("\155\157\x5f\163\141\155\154\x5f\141\144\155\151\156\137\x65\155\141\x69\x6c");
        $dI = new CustomerSaml();
        $fY = $dI->check_customer();
        if ($fY) {
            goto xN;
        }
        return;
        xN:
        $fY = json_decode($fY, true);
        if (strcasecmp($fY["\x73\164\x61\x74\x75\x73"], "\103\x55\x53\124\117\115\105\122\x5f\116\117\x54\x5f\106\117\x55\x4e\x44") == 0) {
            goto O0;
        }
        $this->get_current_customer();
        goto av;
        O0:
        $fY = $dI->send_otp_token($Dm, '');
        if ($fY) {
            goto GY;
        }
        return;
        GY:
        $fY = json_decode($fY, true);
        if (strcasecmp($fY["\x73\164\141\164\x75\163"], "\123\x55\x43\103\105\123\x53") == 0) {
            goto gQ;
        }
        update_option("\155\x6f\x5f\163\141\155\x6c\137\x6d\145\x73\163\x61\x67\x65", "\x54\x68\145\162\x65\40\x77\141\x73\x20\x61\x6e\x20\145\x72\162\157\162\x20\151\156\x20\163\145\x6e\144\151\x6e\x67\40\x65\x6d\141\151\154\56\x20\x50\154\x65\141\x73\x65\x20\x76\145\162\151\x66\x79\40\x79\x6f\x75\x72\x20\x65\155\x61\x69\x6c\x20\141\156\x64\40\x74\x72\x79\40\141\x67\141\151\156\56");
        update_option("\155\x6f\137\163\x61\x6d\154\137\162\145\x67\151\163\164\162\x61\x74\x69\157\x6e\137\163\164\141\x74\165\163", "\x4d\117\x5f\117\124\x50\x5f\104\x45\x4c\x49\126\x45\x52\x45\104\137\106\101\111\x4c\125\122\105\x5f\x45\x4d\x41\x49\x4c");
        $this->mo_saml_show_error_message();
        goto xr;
        gQ:
        update_option("\x6d\157\137\x73\x61\x6d\x6c\x5f\x6d\x65\163\163\x61\147\145", "\x20\x41\x20\157\156\145\40\164\151\155\x65\40\160\x61\x73\x73\x63\x6f\x64\145\x20\151\163\40\163\145\156\164\40\x74\157\40" . get_option("\x6d\157\137\x73\141\x6d\x6c\x5f\x61\144\x6d\x69\x6e\x5f\145\155\x61\x69\154") . "\x2e\x20\x50\x6c\145\141\163\x65\40\145\x6e\x74\x65\x72\40\x74\150\145\x20\157\164\160\40\150\x65\162\x65\40\x74\157\40\x76\x65\162\x69\146\171\40\x79\x6f\x75\162\40\x65\155\141\x69\154\x2e");
        update_option("\x6d\157\x5f\163\141\155\154\137\164\162\x61\x6e\163\141\x63\164\x69\x6f\x6e\x49\144", $fY["\164\170\x49\x64"]);
        update_option("\x6d\x6f\x5f\163\141\x6d\x6c\x5f\162\x65\147\151\163\x74\x72\x61\x74\151\157\x6e\x5f\x73\164\x61\164\x75\x73", "\115\117\137\x4f\124\120\x5f\x44\x45\x4c\111\x56\105\x52\x45\x44\137\123\x55\x43\103\105\123\123\137\105\115\101\x49\114");
        $this->mo_saml_show_success_message();
        xr:
        av:
        f8:
        uN:
        goto mx;
        qG:
        $WY = htmlspecialchars($_POST["\155\157\137\x73\x61\155\154\137\143\x75\163\x74\157\155\137\x6c\x6f\x67\151\156\137\x74\x65\x78\x74"]);
        update_option("\x6d\157\x5f\x73\x61\155\x6c\137\143\165\163\x74\157\155\x5f\154\157\x67\x69\x6e\x5f\164\x65\x78\164", stripcslashes($WY));
        $zJ = htmlspecialchars($_POST["\x6d\x6f\x5f\163\141\155\154\137\143\x75\x73\x74\x6f\155\x5f\147\162\x65\x65\x74\x69\x6e\147\x5f\164\145\x78\164"]);
        update_option("\155\x6f\137\x73\x61\155\x6c\137\143\165\x73\164\157\x6d\x5f\147\162\145\x65\x74\x69\156\147\137\164\145\170\164", stripcslashes($zJ));
        $N9 = htmlspecialchars($_POST["\155\157\x5f\x73\x61\x6d\x6c\137\147\x72\145\x65\x74\151\x6e\x67\137\156\x61\155\x65"]);
        update_option("\155\157\137\163\x61\x6d\154\x5f\147\x72\x65\x65\164\151\156\x67\137\156\x61\x6d\145", stripslashes($N9));
        $oz = htmlspecialchars($_POST["\x6d\157\137\163\141\x6d\x6c\x5f\143\x75\163\164\x6f\x6d\137\x6c\157\x67\157\165\x74\x5f\x74\x65\x78\x74"]);
        update_option("\155\x6f\x5f\163\141\x6d\154\x5f\143\x75\x73\x74\x6f\155\x5f\154\x6f\147\x6f\x75\x74\137\164\x65\x78\x74", stripcslashes($oz));
        update_option("\x6d\x6f\x5f\163\x61\155\x6c\137\155\x65\163\x73\x61\147\x65", "\127\x69\x64\147\x65\x74\x20\123\145\164\x74\x69\x6e\x67\163\x20\x75\160\144\x61\164\145\144\40\x73\x75\143\x63\145\163\163\146\x75\154\x6c\x79\56");
        $this->mo_saml_show_success_message();
        mx:
        AF:
        if (mo_saml_is_trial_active()) {
            goto m9;
        }
        if (site_check()) {
            goto Ww;
        }
        delete_option("\155\x6f\137\x73\141\x6d\154\x5f\x66\x6f\162\143\x65\137\x61\165\x74\x68\x65\x6e\164\x69\x63\x61\164\151\x6f\x6e");
        Ww:
        goto gE;
        m9:
        if (!decryptSamlElement()) {
            goto cM;
        }
        $y9 = get_option("\x6d\x6f\x5f\x73\x61\155\154\137\143\x75\163\164\157\x6d\x65\x72\x5f\164\157\x6b\145\156");
        update_option("\164\x5f\x73\151\x74\145\137\163\x74\x61\x74\x75\163", AESEncryption::encrypt_data("\146\x61\x6c\x73\x65", $y9));
        cM:
        gE:
    }
    function djkasjdksa()
    {
        $VJ = "\41\x7e\x40\x23\x24\45\136\46\x2a\x28\x29\137\x2b\x7c\x7b\175\74\76\77\x30\61\62\x33\x34\65\66\x37\x38\x39\141\x62\x63\x64\145\x66\147\150\151\152\x6b\154\155\x6e\x6f\160\161\162\163\164\x75\x76\x77\170\x79\x7a\x41\102\x43\x44\105\106\x47\x48\111\x4a\113\x4c\115\116\x4f\120\x51\122\123\x54\x55\x56\x57\x58\x59\x5a";
        $WO = strlen($VJ);
        $lL = '';
        $y_ = 0;
        hB:
        if (!($y_ < 10000)) {
            goto xP;
        }
        $lL .= $VJ[rand(0, $WO - 1)];
        Tr:
        $y_++;
        goto hB;
        xP:
        return $lL;
    }
    function create_customer()
    {
        $dI = new CustomerSaml();
        $fY = $dI->create_customer();
        if ($fY) {
            goto xL;
        }
        return;
        xL:
        $Da = json_decode($fY, true);
        if (strcasecmp($Da["\163\x74\x61\x74\x75\x73"], "\x43\x55\123\x54\x4f\x4d\105\x52\x5f\x55\x53\105\122\x4e\x41\115\105\137\x41\114\x52\105\101\x44\131\137\x45\x58\x49\x53\124\123") == 0) {
            goto Zj;
        }
        if (!(strcasecmp($Da["\163\164\x61\x74\x75\x73"], "\x53\x55\x43\103\x45\123\123") == 0)) {
            goto nV;
        }
        update_option("\155\157\x5f\163\141\155\x6c\137\x61\x64\155\151\156\x5f\143\x75\x73\x74\x6f\155\x65\162\137\x6b\x65\x79", $Da["\151\144"]);
        update_option("\x6d\157\x5f\163\141\x6d\154\137\x61\144\x6d\151\156\x5f\x61\x70\x69\x5f\153\x65\171", $Da["\x61\160\151\113\x65\171"]);
        update_option("\155\x6f\x5f\163\141\155\154\137\x63\x75\163\164\157\155\x65\x72\x5f\164\x6f\x6b\x65\x6e", $Da["\164\x6f\x6b\145\x6e"]);
        update_option("\x6d\x6f\137\163\x61\x6d\x6c\137\141\x64\x6d\x69\156\x5f\160\x61\163\163\167\157\162\144", '');
        update_option("\x6d\x6f\x5f\x73\141\x6d\154\137\155\x65\x73\163\141\x67\x65", "\124\150\141\x6e\x6b\x20\171\157\x75\x20\x66\157\x72\40\162\x65\x67\x69\163\x74\x65\162\x69\x6e\x67\x20\x77\151\164\x68\40\x6d\151\156\151\x6f\162\x61\156\x67\145\x2e");
        update_option("\x6d\157\137\163\x61\155\x6c\x5f\x72\x65\x67\151\163\164\x72\x61\x74\x69\157\x6e\137\x73\x74\x61\164\165\x73", '');
        delete_option("\155\157\x5f\x73\141\x6d\154\137\x76\145\162\151\146\x79\x5f\143\165\163\x74\157\x6d\145\162");
        delete_option("\x6d\x6f\x5f\163\x61\x6d\x6c\137\x6e\x65\x77\137\x72\145\147\x69\163\164\x72\141\x74\151\x6f\156");
        $this->mo_saml_show_success_message();
        nV:
        goto pQ;
        Zj:
        $this->get_current_customer();
        pQ:
        update_option("\x6d\157\137\163\x61\155\154\137\141\x64\x6d\151\156\137\x70\x61\163\x73\167\x6f\162\x64", '');
    }
    function get_current_customer()
    {
        $dI = new CustomerSaml();
        $fY = $dI->get_customer_key();
        if ($fY) {
            goto Tk;
        }
        return;
        Tk:
        $Da = json_decode($fY, true);
        if (json_last_error() == JSON_ERROR_NONE) {
            goto r4;
        }
        update_option("\x6d\157\137\163\x61\155\x6c\x5f\155\145\163\163\x61\x67\145", "\131\157\x75\40\x61\154\162\145\x61\144\171\40\150\x61\166\145\x20\x61\x6e\x20\141\143\x63\157\165\156\x74\40\167\151\164\x68\40\155\151\x6e\151\117\x72\141\156\147\145\x2e\x20\120\154\145\141\x73\145\40\145\x6e\164\x65\162\x20\141\40\x76\x61\154\x69\x64\40\160\141\163\163\167\x6f\x72\144\x2e");
        update_option("\x6d\157\x5f\163\141\x6d\154\137\x76\145\162\x69\146\x79\x5f\x63\165\x73\x74\x6f\x6d\x65\x72", "\164\162\165\145");
        delete_option("\x6d\x6f\137\x73\x61\x6d\x6c\137\156\x65\167\137\x72\x65\x67\151\x73\164\162\141\x74\151\157\x6e");
        $this->mo_saml_show_error_message();
        goto bq;
        r4:
        update_option("\155\157\x5f\163\141\155\x6c\x5f\141\x64\x6d\x69\x6e\x5f\143\165\x73\x74\x6f\155\145\x72\x5f\x6b\x65\171", $Da["\x69\144"]);
        update_option("\x6d\x6f\x5f\163\141\x6d\x6c\137\141\144\x6d\151\156\137\141\160\x69\137\x6b\x65\x79", $Da["\141\160\x69\x4b\x65\x79"]);
        update_option("\x6d\x6f\137\x73\x61\155\154\x5f\x63\x75\163\164\157\x6d\145\x72\x5f\x74\157\x6b\145\156", $Da["\x74\x6f\x6b\145\x6e"]);
        update_option("\155\157\137\163\x61\x6d\x6c\x5f\141\144\155\x69\x6e\137\x70\x61\x73\x73\x77\x6f\x72\144", '');
        update_option("\155\157\x5f\163\141\x6d\154\x5f\155\145\163\x73\x61\147\x65", "\131\x6f\165\x72\40\x61\143\x63\157\165\156\x74\40\150\141\163\x20\x62\x65\145\x6e\x20\x72\x65\x74\162\151\x65\x76\x65\x64\x20\x73\x75\x63\143\x65\163\x73\146\165\154\x6c\171\x2e");
        delete_option("\155\157\137\163\x61\155\x6c\137\x76\145\x72\x69\x66\x79\x5f\143\x75\x73\x74\x6f\x6d\x65\162");
        delete_option("\155\x6f\137\163\x61\155\x6c\137\x6e\145\167\137\162\x65\147\151\163\x74\x72\x61\x74\x69\157\x6e");
        $this->mo_saml_show_success_message();
        bq:
    }
    public function mo_saml_check_empty_or_null($nj)
    {
        if (!(!isset($nj) || empty($nj))) {
            goto ji;
        }
        return true;
        ji:
        return false;
    }
    function miniorange_sso_menu()
    {
        $ye = add_menu_page("\x4d\x4f\x20\123\101\115\x4c\x20\123\x65\164\164\151\156\147\163\40" . __("\103\x6f\x6e\146\x69\x67\165\x72\x65\x20\123\101\115\114\x20\x49\144\x65\x6e\x74\x69\164\171\40\x50\x72\157\x76\x69\144\145\x72\40\146\x6f\162\x20\123\x53\117", "\x6d\x6f\137\163\x61\x6d\154\137\163\145\x74\164\x69\x6e\147\x73"), "\x6d\x69\x6e\151\117\162\x61\x6e\x67\x65\x20\123\101\x4d\x4c\40\62\x2e\60\x20\123\x53\117", "\141\144\155\x69\x6e\x69\163\x74\x72\141\164\x6f\x72", "\155\157\137\x73\x61\155\x6c\137\x73\x65\164\x74\151\x6e\147\163", array($this, "\155\157\x5f\x6c\157\147\x69\x6e\x5f\167\x69\x64\x67\145\164\137\163\141\155\x6c\x5f\157\x70\x74\151\x6f\x6e\163"), plugin_dir_url(__FILE__) . "\151\155\141\147\145\163\x2f\155\x69\x6e\x69\x6f\162\x61\156\147\x65\x2e\x70\156\147");
        if (!mo_saml_is_customer_license_key_verified()) {
            goto fT;
        }
        add_submenu_page("\x6d\x6f\137\x73\x61\155\154\137\163\x65\164\x74\x69\x6e\x67\x73", "\x4d\141\156\x61\147\145\40\114\x69\143\x65\156\163\x65\x20\x4b\145\x79\x73", "\115\x61\x6e\141\147\x65\x20\x4c\151\x63\145\x6e\163\x65\x20\113\x65\x79\163", "\141\x64\x6d\x69\156\x69\163\x74\162\141\x74\157\162", "\155\157\x5f\155\141\156\x61\x67\x65\137\x6c\151\x63\145\156\163\x65", "\x6d\157\137\x6d\141\156\141\x67\145\137\x6c\x69\x63\145\x6e\163\145");
        add_submenu_page("\155\x6f\137\x73\141\x6d\154\x5f\163\145\164\164\x69\156\147\163", "\x6d\x69\156\151\117\x72\x61\x6e\x67\x65\40\123\101\115\114\x20\x32\56\x30\x20\x53\x53\x4f", __("\74\144\x69\x76\40\151\144\x3d\42\x6d\157\137\x73\141\155\x6c\x5f\141\x64\x64\157\x6e\163\137\x73\x75\142\x6d\x65\156\165\42\76\x41\x64\x64\55\x4f\156\x73\x3c\x2f\x64\151\166\x3e", "\x6d\x69\156\x69\157\162\141\x6e\x67\x65\55\163\141\x6d\x6c\55\62\60\55\163\x69\156\x67\x6c\x65\x2d\x73\151\x67\x6e\55\x6f\x6e"), "\x6d\141\x6e\141\x67\x65\x5f\x6f\x70\x74\151\x6f\156\163", "\155\x6f\137\x73\141\155\154\137\163\145\164\x74\151\156\147\x73\x26\x74\x61\x62\75\141\x64\x64\55\157\x6e\x73", array($this, "\x6d\157\x5f\154\157\147\x69\x6e\137\167\151\x64\147\x65\x74\137\163\x61\155\x6c\137\157\x70\x74\x69\157\156\x73"));
        fT:
    }
    function mo_saml_redirect_for_authentication($yZ)
    {
        if (!mo_saml_is_customer_license_key_verified()) {
            goto ex;
        }
        if (!(get_option("\x6d\157\x5f\163\141\x6d\x6c\x5f\x72\x65\x67\x69\x73\164\145\162\x65\x64\137\157\x6e\x6c\x79\137\141\x63\143\x65\x73\163") == "\x74\162\165\145")) {
            goto up;
        }
        $base_url = home_url();
        echo "\74\163\x63\162\151\x70\x74\x3e\167\x69\x6e\x64\157\x77\x2e\154\157\x63\x61\164\151\157\156\x2e\150\x72\x65\x66\x3d\x27{$base_url}\57\x3f\x6f\x70\164\151\157\156\75\x73\141\x6d\x6c\137\x75\x73\x65\x72\137\154\x6f\147\x69\x6e\46\162\145\x64\151\x72\145\143\164\x5f\x74\x6f\x3d\47\x2b\x65\156\x63\x6f\x64\145\125\x52\111\x43\x6f\x6d\x70\157\156\145\156\164\50\167\x69\156\x64\x6f\x77\56\x6c\x6f\x63\x61\164\151\x6f\156\56\150\162\145\x66\51\x3b\74\x2f\x73\x63\162\151\x70\x74\x3e";
        exit;
        up:
        if (get_option("\155\157\x5f\x73\141\155\x6c\137\x72\145\x67\x69\x73\x74\145\162\145\x64\x5f\157\x6e\x6c\171\137\141\x63\x63\145\x73\x73") == "\x74\x72\x75\145" || get_option("\155\x6f\137\x73\x61\x6d\x6c\137\x65\x6e\x61\142\x6c\x65\137\154\157\x67\x69\x6e\137\x72\145\144\151\x72\x65\x63\x74") == "\x74\162\165\x65") {
            goto Uc;
        }
        if (!(get_option("\x6d\157\137\163\x61\155\x6c\x5f\162\x65\144\x69\x72\145\143\164\137\x74\157\x5f\167\160\x5f\154\157\147\x69\156") == "\x74\x72\165\x65")) {
            goto z7;
        }
        if (!(mo_saml_is_sp_configured() && !is_user_logged_in())) {
            goto Mr;
        }
        $H4 = site_url() . "\57\167\160\55\154\x6f\x67\151\156\56\160\150\x70";
        if (empty($yZ)) {
            goto vm;
        }
        $H4 = $H4 . "\77\x72\145\144\x69\x72\x65\143\164\137\164\x6f\x3d" . urlencode($yZ) . "\46\162\145\x61\165\x74\x68\75\61";
        vm:
        header("\114\x6f\x63\141\x74\151\157\x6e\72\40" . $H4);
        exit;
        Mr:
        z7:
        goto E4;
        Uc:
        if (!(mo_saml_is_sp_configured() && !is_user_logged_in())) {
            goto Zz;
        }
        $uW = get_option("\155\157\x5f\163\141\x6d\x6c\137\163\x70\137\x62\141\163\145\x5f\165\162\154");
        if (!empty($uW)) {
            goto pp;
        }
        $uW = home_url();
        pp:
        if (!(get_option("\155\x6f\x5f\x73\x61\x6d\154\137\x72\x65\x6c\141\x79\x5f\163\x74\141\164\x65") && get_option("\x6d\157\137\x73\141\x6d\x6c\x5f\x72\x65\154\141\x79\137\163\x74\141\164\145") != '')) {
            goto GR;
        }
        $yZ = get_option("\x6d\157\137\x73\x61\155\154\x5f\x72\x65\154\x61\x79\137\x73\164\x61\164\x65");
        GR:
        $yZ = mo_saml_get_relay_state($yZ);
        $gA = empty($yZ) ? "\x2f" : $yZ;
        $jG = htmlspecialchars_decode(LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Login_URL));
        $mj = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Login_binding_type);
        $z8 = get_option("\155\x6f\x5f\163\141\155\154\137\x66\157\162\143\x65\x5f\x61\x75\164\x68\145\x6e\164\151\x63\141\164\151\157\156");
        $hC = $uW . "\57";
        $Hq = get_option(mo_options_enum_identity_provider::SP_Entity_ID);
        $AS = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::NameID_Format);
        if (!empty($AS)) {
            goto F7;
        }
        $AS = "\61\56\x31\x3a\x6e\141\155\x65\x69\x64\55\146\157\x72\155\x61\164\72\165\x6e\x73\x70\145\143\x69\x66\x69\145\144";
        F7:
        if (!empty($Hq)) {
            goto sQ;
        }
        $Hq = $uW . "\x2f\167\x70\55\143\157\156\164\x65\x6e\x74\57\160\x6c\165\147\151\x6e\163\x2f\155\x69\156\x69\x6f\x72\141\x6e\x67\145\x2d\x73\x61\x6d\154\55\x32\x30\x2d\163\x69\x6e\147\154\145\x2d\163\151\147\x6e\x2d\x6f\x6e\57";
        sQ:
        $AA = SAMLSPUtilities::createAuthnRequest($hC, $Hq, $jG, $z8, $mj, $AS);
        if (empty($mj) || $mj == "\x48\164\x74\160\122\145\144\x69\x72\145\x63\164") {
            goto pH;
        }
        if (!(LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Request_signed) == "\x75\156\143\150\145\x63\x6b\x65\x64")) {
            goto vI;
        }
        $z1 = base64_encode($AA);
        SAMLSPUtilities::postSAMLRequest($jG, $z1, $gA);
        exit;
        vI:
        $z1 = SAMLSPUtilities::signXML($AA, "\x4e\x61\x6d\145\x49\x44\x50\x6f\x6c\151\x63\171");
        SAMLSPUtilities::postSAMLRequest($jG, $z1, $gA);
        goto Tq;
        pH:
        $ud = $jG;
        if (strpos($jG, "\77") !== false) {
            goto VM;
        }
        $ud .= "\77";
        goto sZ;
        VM:
        $ud .= "\x26";
        sZ:
        if (!(LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Request_signed) == "\165\156\x63\x68\145\143\153\145\144")) {
            goto is;
        }
        $ud .= "\123\x41\x4d\114\x52\145\161\165\x65\x73\x74\75" . $AA . "\46\122\145\154\141\x79\x53\164\x61\164\145\75" . urlencode($gA);
        header("\143\141\143\150\145\55\143\157\156\164\x72\157\x6c\72\x20\155\x61\170\x2d\141\x67\145\75\60\x2c\x20\160\x72\x69\x76\141\164\145\54\40\x6e\157\x2d\163\164\x6f\x72\x65\x2c\x20\x6e\x6f\x2d\x63\x61\x63\150\145\x2c\40\x6d\x75\163\x74\x2d\162\x65\x76\x61\x6c\151\144\x61\164\145");
        header("\114\157\x63\141\164\151\x6f\156\x3a\40" . $ud);
        exit;
        is:
        $AA = "\123\x41\x4d\114\122\x65\x71\x75\145\163\x74\x3d" . $AA . "\46\122\145\154\141\171\123\x74\x61\164\x65\x3d" . urlencode($gA) . "\46\x53\x69\147\x41\x6c\147\75" . urlencode(XMLSecurityKey::RSA_SHA256);
        $we = array("\164\171\x70\145" => "\160\162\151\x76\141\164\145");
        $y9 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $we);
        $ln = get_option("\x6d\157\x5f\x73\141\155\154\137\x63\x75\162\x72\145\x6e\x74\137\143\x65\162\x74\137\160\162\151\166\141\x74\x65\x5f\x6b\145\x79");
        $y9->loadKey($ln, FALSE);
        $Ce = new XMLSecurityDSig();
        $IB = $y9->signData($AA);
        $IB = base64_encode($IB);
        $ud .= $AA . "\46\x53\x69\x67\156\x61\x74\165\x72\x65\x3d" . urlencode($IB);
        header("\x63\141\x63\x68\x65\55\143\x6f\156\x74\x72\157\x6c\x3a\x20\155\x61\x78\x2d\141\x67\145\x3d\60\54\x20\x70\x72\151\166\x61\164\x65\54\40\x6e\x6f\55\163\164\x6f\162\x65\54\x20\x6e\157\x2d\x63\141\143\150\145\54\x20\155\165\163\164\x2d\x72\x65\166\x61\x6c\151\x64\141\164\145");
        header("\x4c\x6f\143\x61\164\151\157\x6e\x3a\x20" . $ud);
        exit;
        Tq:
        Zz:
        E4:
        ex:
    }
    function mo_saml_login_redirect($Nj)
    {
        $Tc = false;
        if (!(strcmp(wp_login_url(), $Nj) == 0)) {
            goto KV;
        }
        $Tc = true;
        KV:
        if (!empty($Nj) && !$Tc) {
            goto Dx;
        }
        header("\114\x6f\x63\x61\164\151\x6f\156\x3a\40" . home_url());
        goto Qz;
        Dx:
        header("\x4c\x6f\143\141\x74\151\157\156\72\40" . $Nj);
        Qz:
        exit;
    }
    function mo_saml_authenticate()
    {
        $Nj = '';
        if (!isset($_REQUEST["\x72\x65\144\x69\x72\145\143\164\x5f\164\157"])) {
            goto t1;
        }
        $Nj = htmlspecialchars($_REQUEST["\x72\145\x64\151\162\145\x63\164\137\164\157"]);
        t1:
        if (!is_user_logged_in()) {
            goto fj;
        }
        $this->mo_saml_login_redirect($Nj);
        fj:
        if (!(get_option("\155\157\x5f\x73\141\155\x6c\137\x65\x6e\141\142\x6c\x65\x5f\154\x6f\x67\x69\156\x5f\x72\145\x64\151\x72\x65\143\x74") == "\164\162\165\x65")) {
            goto zJ;
        }
        $FN = get_option("\x6d\157\137\x73\141\155\154\137\x62\x61\x63\x6b\x64\157\x6f\x72\137\x75\x72\154") ? trim(get_option("\x6d\157\x5f\x73\x61\155\x6c\x5f\142\141\x63\153\x64\157\157\162\x5f\x75\x72\x6c")) : "\x66\x61\x6c\163\x65";
        if (isset($_GET["\154\x6f\x67\147\145\x64\157\165\164"]) && $_GET["\x6c\157\147\x67\145\x64\x6f\165\x74"] == "\x74\162\x75\x65") {
            goto AT;
        }
        if (get_option("\155\157\137\x73\x61\155\x6c\x5f\141\154\x6c\x6f\x77\x5f\167\x70\137\163\x69\147\x6e\151\x6e") == "\164\162\165\145") {
            goto le;
        }
        goto wZ;
        AT:
        header("\x4c\157\143\141\164\x69\x6f\x6e\72\x20" . home_url());
        exit;
        goto wZ;
        le:
        if (isset($_GET["\x73\x61\155\154\x5f\163\163\x6f"]) && $_GET["\x73\141\155\x6c\137\163\163\157"] === $FN || isset($_POST["\163\x61\x6d\154\x5f\x73\x73\x6f"]) && $_POST["\x73\x61\155\x6c\x5f\163\x73\157"] === $FN) {
            goto nD;
        }
        if (isset($_REQUEST["\162\x65\144\x69\162\x65\x63\x74\x5f\164\157"])) {
            goto H0;
        }
        goto UU;
        nD:
        return;
        goto UU;
        H0:
        $Nj = htmlspecialchars($_REQUEST["\x72\145\144\x69\x72\x65\143\164\137\164\x6f"]);
        if (!(strpos($Nj, "\x77\x70\55\x61\x64\x6d\x69\156") !== false && strpos($Nj, "\x73\x61\x6d\x6c\137\x73\x73\x6f\x3d" . $FN) !== false)) {
            goto hu;
        }
        return;
        hu:
        UU:
        wZ:
        $this->mo_saml_redirect_for_authentication($Nj);
        zJ:
    }
    function mo_saml_auto_redirect()
    {
        $ch = false;
        $ch = apply_filters("\155\x6f\x5f\x73\141\155\154\137\x62\x65\146\x6f\x72\145\x5f\141\x75\164\157\x5f\162\x65\x64\151\x72\145\x63\164", $ch);
        if (!(is_user_logged_in() || $ch)) {
            goto Jx;
        }
        return;
        Jx:
        if (!(get_option("\x6d\157\x5f\x73\141\x6d\x6c\137\162\145\x67\x69\163\164\x65\162\145\x64\137\157\156\154\171\x5f\141\143\x63\145\x73\163") == "\x74\162\165\x65" || get_option("\155\157\x5f\x73\141\155\154\137\162\145\144\151\x72\145\x63\164\137\x74\157\137\167\x70\x5f\x6c\157\147\x69\x6e") == "\164\x72\165\145")) {
            goto GZ;
        }
        if (!(get_option("\155\x6f\137\163\141\x6d\x6c\137\x65\x6e\x61\142\154\x65\137\162\163\163\x5f\x61\x63\x63\145\163\163") == "\x74\162\x75\145" && is_feed())) {
            goto Qy;
        }
        return;
        Qy:
        $yZ = saml_get_current_page_url();
        $this->mo_saml_redirect_for_authentication($yZ);
        GZ:
    }
    function mo_saml_modify_login_form()
    {
        $FN = get_option("\x6d\157\x5f\163\141\155\154\x5f\142\x61\x63\x6b\x64\157\x6f\x72\x5f\x75\162\x6c") ? trim(get_option("\155\x6f\137\163\x61\x6d\154\x5f\142\x61\x63\x6b\x64\157\x6f\x72\x5f\165\162\154")) : "\x66\141\154\163\x65";
        echo "\x3c\x69\x6e\x70\x75\164\40\x74\171\160\145\x3d\42\150\x69\x64\144\x65\156\x22\40\156\x61\x6d\x65\75\42\x73\141\x6d\x6c\137\x73\163\157\x22\x20\x76\141\x6c\x75\145\x3d" . $FN . "\x3e" . "\12";
        if (!(get_option("\x6d\x6f\137\163\141\x6d\154\x5f\x61\144\x64\137\163\x73\157\137\142\165\164\164\157\156\x5f\167\x70") == "\164\162\165\145")) {
            goto AO;
        }
        $this->mo_saml_add_sso_button();
        AO:
    }
    function mo_saml_login_enqueue_scripts()
    {
        wp_enqueue_script("\152\161\x75\145\162\x79");
    }
    function mo_saml_add_sso_button()
    {
        $Qf = SAMLSPUtilities::mo_saml_is_user_logged_in();
        if ($Qf) {
            goto NB;
        }
        $uW = get_option("\155\157\137\x73\141\155\154\137\163\x70\x5f\142\x61\163\145\137\x75\x72\x6c");
        if (!empty($uW)) {
            goto GD;
        }
        $uW = home_url();
        GD:
        $Od = get_option("\155\x6f\x5f\163\x61\x6d\154\x5f\142\x75\x74\x74\157\156\137\167\151\144\x74\x68") ? get_option("\155\157\x5f\x73\141\x6d\x6c\137\x62\165\164\164\x6f\156\x5f\167\x69\144\x74\x68") : "\61\x30\x30";
        $W7 = get_option("\155\x6f\x5f\163\141\155\154\x5f\x62\x75\x74\x74\157\x6e\x5f\150\x65\151\x67\150\164") ? get_option("\155\x6f\x5f\163\x61\155\x6c\x5f\x62\165\164\x74\157\156\x5f\x68\x65\x69\x67\x68\164") : "\x35\x30";
        $XQ = get_option("\x6d\x6f\x5f\x73\x61\155\154\137\x62\165\164\x74\157\156\137\163\x69\172\x65") ? get_option("\x6d\157\x5f\x73\141\155\154\x5f\x62\165\164\x74\x6f\156\137\x73\x69\172\145") : "\x35\x30";
        $z7 = get_option("\155\x6f\x5f\x73\x61\x6d\x6c\x5f\142\x75\164\164\157\156\x5f\143\x75\162\166\x65") ? get_option("\155\x6f\137\x73\141\155\x6c\137\142\x75\x74\164\157\x6e\137\x63\x75\162\x76\145") : "\65";
        $b1 = get_option("\x6d\x6f\x5f\x73\x61\155\x6c\x5f\x62\x75\x74\164\x6f\x6e\x5f\143\157\154\x6f\162") ? get_option("\155\157\x5f\x73\141\x6d\x6c\x5f\x62\x75\x74\x74\157\x6e\137\x63\157\154\157\162") : "\x30\60\70\x35\142\x61";
        $Xa = get_option("\x6d\157\x5f\x73\x61\155\154\137\142\x75\164\x74\x6f\156\x5f\x74\150\145\x6d\x65") ? get_option("\x6d\x6f\137\163\x61\155\154\x5f\142\165\164\164\157\156\x5f\164\150\145\155\x65") : "\x6c\x6f\x6e\147\142\x75\x74\164\157\x6e";
        $YB = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Identity_name);
        $WD = get_option("\155\157\137\x73\141\x6d\x6c\137\142\165\164\164\157\x6e\137\x74\x65\x78\x74") ? get_option("\x6d\157\x5f\x73\141\155\154\x5f\x62\165\164\x74\x6f\156\x5f\x74\145\170\x74") : ($YB ? $YB : "\x4c\157\x67\151\x6e");
        $j7 = get_option("\x6d\157\x5f\x73\141\155\154\137\x66\x6f\x6e\x74\137\143\x6f\154\157\x72") ? get_option("\155\157\137\x73\141\x6d\154\137\x66\x6f\156\x74\137\143\x6f\x6c\x6f\162") : "\146\x66\146\x66\x66\x66";
        $r4 = get_option("\155\157\x5f\163\141\x6d\x6c\137\146\x6f\156\x74\x5f\163\151\172\145") ? get_option("\155\x6f\137\163\141\x6d\154\x5f\146\x6f\x6e\x74\x5f\x73\x69\172\145") : "\62\60";
        $iC = get_option("\x73\x73\157\x5f\x62\165\x74\164\x6f\156\137\x6c\x6f\147\x69\x6e\x5f\x66\x6f\162\155\x5f\160\157\x73\x69\164\x69\157\156") ? get_option("\163\x73\157\137\x62\x75\x74\164\x6f\x6e\137\x6c\x6f\147\151\x6e\137\146\157\x72\x6d\x5f\x70\x6f\163\151\164\x69\x6f\x6e") : "\x61\142\157\166\145";
        $qb = "\x3c\x69\x6e\160\x75\164\x20\x74\x79\160\145\x3d\42\x62\x75\x74\x74\x6f\156\42\x20\156\x61\155\x65\75\42\x6d\x6f\137\x73\141\155\x6c\137\167\x70\x5f\163\x73\157\x5f\142\165\164\x74\157\x6e\42\40\166\x61\x6c\165\145\75\x22" . $WD . "\x22\x20\163\x74\x79\154\145\75\x22";
        $qZ = '';
        if ($Xa == "\x6c\157\x6e\x67\142\x75\x74\x74\157\x6e") {
            goto q1;
        }
        if ($Xa == "\x63\x69\162\x63\154\x65") {
            goto gM;
        }
        if ($Xa == "\x6f\x76\141\154") {
            goto Gr;
        }
        if ($Xa == "\x73\161\165\141\162\145") {
            goto gp;
        }
        goto eV;
        gM:
        $qZ = $qZ . "\x77\x69\x64\164\x68\x3a" . $XQ . "\160\170\x3b";
        $qZ = $qZ . "\x68\145\x69\147\150\164\72" . $XQ . "\160\x78\73";
        $qZ = $qZ . "\x62\157\x72\144\x65\162\55\x72\x61\x64\x69\165\x73\72\71\x39\71\x70\x78\73";
        goto eV;
        Gr:
        $qZ = $qZ . "\x77\x69\144\x74\150\x3a" . $XQ . "\160\170\x3b";
        $qZ = $qZ . "\150\145\x69\x67\x68\164\72" . $XQ . "\160\170\73";
        $qZ = $qZ . "\x62\157\x72\x64\145\x72\x2d\162\141\144\151\165\163\72\65\160\x78\x3b";
        goto eV;
        gp:
        $qZ = $qZ . "\x77\x69\x64\x74\150\x3a" . $XQ . "\x70\170\x3b";
        $qZ = $qZ . "\150\x65\151\147\150\x74\72" . $XQ . "\x70\x78\x3b";
        $qZ = $qZ . "\142\x6f\162\144\x65\x72\55\162\x61\144\151\165\x73\x3a\60\x70\x78\73";
        $qZ = $qZ . "\160\x61\x64\144\151\x6e\147\x3a\x30\160\x78\73";
        eV:
        goto Kj;
        q1:
        $qZ = $qZ . "\167\151\x64\x74\x68\72" . $Od . "\x70\170\73";
        $qZ = $qZ . "\150\145\151\147\x68\164\x3a" . $W7 . "\x70\x78\x3b";
        $qZ = $qZ . "\x62\157\x72\144\145\x72\x2d\162\141\x64\x69\165\163\x3a" . $z7 . "\x70\170\x3b";
        Kj:
        $qZ = $qZ . "\142\x61\143\x6b\x67\162\157\165\156\144\x2d\x63\x6f\154\157\x72\72\43" . $b1 . "\73";
        $qZ = $qZ . "\142\157\162\144\145\162\55\x63\157\x6c\157\162\72\164\162\141\x6e\163\160\x61\x72\145\x6e\x74\73";
        $qZ = $qZ . "\143\157\154\157\162\x3a\x23" . $j7 . "\x3b";
        $qZ = $qZ . "\146\x6f\x6e\x74\x2d\x73\x69\172\x65\x3a" . $r4 . "\x70\x78\73";
        $qZ = $qZ . "\143\x75\x72\163\157\x72\x3a\x70\157\151\156\164\x65\162";
        $qb = $qb . $qZ . "\42\x2f\76";
        $Nj = '';
        if (!isset($_GET["\x72\x65\144\151\x72\145\143\164\137\164\157"])) {
            goto YF;
        }
        $Nj = urlencode($_GET["\162\x65\x64\x69\162\145\x63\x74\x5f\x74\157"]);
        YF:
        $qC = "\74\141\x20\x68\162\145\x66\x3d\42" . $uW . "\x2f\x3f\x6f\x70\x74\x69\157\x6e\75\x73\x61\155\x6c\137\x75\163\x65\x72\137\154\157\x67\151\156\46\x72\x65\144\151\162\145\143\x74\137\164\157\75" . $Nj . "\x22\40\x73\164\171\x6c\x65\x3d\x22\x74\x65\x78\x74\x2d\x64\145\143\x6f\162\141\x74\151\x6f\x6e\x3a\x6e\x6f\156\145\73\x22\76" . $qb . "\74\x2f\141\x3e";
        $qC = "\x3c\x64\151\x76\40\x73\x74\171\154\145\75\x22\x70\141\x64\144\x69\x6e\147\x3a\61\x30\x70\170\x3b\x22\x3e" . $qC . "\x3c\x2f\x64\151\x76\x3e";
        if ($iC == "\x61\142\157\166\x65") {
            goto qb;
        }
        $qC = "\x3c\x64\151\x76\40\151\144\75\x22\x73\x73\x6f\137\x62\165\x74\164\x6f\x6e\x22\40\x73\x74\x79\x6c\145\x3d\x22\x74\x65\x78\x74\x2d\x61\154\151\147\x6e\x3a\x63\x65\x6e\x74\145\x72\42\x3e\x3c\144\151\166\x20\x73\x74\x79\154\145\x3d\x22\x70\141\x64\x64\x69\156\147\x3a\x35\160\x78\73\146\x6f\x6e\164\55\163\151\x7a\145\72\61\x34\x70\x78\73\42\76\x3c\x62\x3e\x4f\122\74\x2f\x62\x3e\74\57\144\x69\x76\x3e" . $qC . "\x3c\x2f\144\x69\x76\x3e\x3c\x62\x72\57\x3e";
        goto lq;
        qb:
        $qC = "\74\x64\151\166\40\151\144\x3d\42\163\x73\x6f\x5f\x62\x75\x74\164\x6f\156\x22\x20\163\164\171\x6c\x65\x3d\x22\164\x65\170\164\x2d\x61\x6c\x69\147\x6e\72\x63\145\156\x74\145\162\x22\76" . $qC . "\x3c\x64\x69\166\x20\x73\x74\x79\x6c\x65\x3d\x22\160\x61\144\x64\x69\x6e\x67\72\65\x70\170\x3b\146\x6f\x6e\x74\55\x73\x69\x7a\x65\72\61\64\160\x78\73\42\x3e\74\x62\x3e\x4f\x52\x3c\x2f\142\x3e\x3c\x2f\144\151\166\x3e\74\57\144\x69\x76\76\74\142\x72\x2f\x3e";
        $qC = $qC . "\74\163\143\x72\x69\x70\164\x3e\15\12\11\11\x9\x76\141\162\40\x24\145\154\x65\155\145\x6e\x74\x20\x3d\40\152\x51\165\x65\162\x79\x28\x22\43\165\x73\x65\162\137\x6c\157\147\x69\x6e\42\51\x3b\xd\12\x9\x9\x9\x6a\x51\165\145\162\171\50\42\x23\x73\x73\157\137\x62\x75\164\164\x6f\156\x22\x29\56\x69\156\x73\145\x72\x74\x42\145\146\157\x72\x65\50\x6a\x51\x75\145\x72\x79\50\x22\154\141\142\145\154\x5b\x66\x6f\162\x3d\x27\x22\53\x24\x65\154\145\x6d\145\x6e\x74\x2e\x61\x74\x74\162\x28\47\x69\144\47\51\53\x22\x27\x5d\42\x29\51\x3b\xd\12\x9\x9\x9\x3c\57\x73\143\x72\x69\x70\164\x3e";
        lq:
        echo $qC;
        NB:
    }
    function mo_get_saml_shortcode($Nz)
    {
        $Qf = SAMLSPUtilities::mo_saml_is_user_logged_in();
        if (!$Qf) {
            goto pq;
        }
        $current_user = wp_get_current_user();
        $zJ = "\x48\145\154\154\157\x2c";
        if (!get_option("\x6d\157\x5f\x73\141\155\x6c\137\143\165\163\164\157\x6d\137\x67\x72\145\x65\164\x69\156\147\137\164\x65\170\x74")) {
            goto ep;
        }
        $zJ = get_option("\x6d\x6f\137\x73\x61\x6d\154\x5f\x63\165\x73\164\x6f\x6d\x5f\x67\162\x65\145\x74\x69\156\x67\137\164\x65\x78\x74");
        ep:
        $N9 = '';
        if (!get_option("\155\x6f\137\x73\x61\155\x6c\x5f\x67\162\145\145\x74\151\x6e\x67\x5f\x6e\141\155\x65")) {
            goto DG;
        }
        switch (get_option("\x6d\x6f\137\163\x61\x6d\x6c\x5f\x67\x72\x65\x65\164\x69\156\147\x5f\x6e\141\x6d\145")) {
            case "\x55\x53\105\x52\x4e\101\115\105":
                $N9 = $current_user->user_login;
                goto CR;
            case "\105\115\x41\x49\114":
                $N9 = $current_user->user_email;
                goto CR;
            case "\x46\x4e\101\x4d\105":
                $N9 = $current_user->user_firstname;
                goto CR;
            case "\x4c\x4e\x41\x4d\x45":
                $N9 = $current_user->user_lastname;
                goto CR;
            case "\106\116\101\x4d\x45\x5f\x4c\116\101\x4d\105":
                $N9 = $current_user->user_firstname . "\40" . $current_user->user_lastname;
                goto CR;
            case "\x4c\116\x41\115\x45\137\106\116\x41\115\105":
                $N9 = $current_user->user_lastname . "\x20" . $current_user->user_firstname;
                goto CR;
            default:
                $N9 = $current_user->user_login;
        }
        xA:
        CR:
        DG:
        $N9 = trim($N9);
        if (!empty($N9)) {
            goto OS;
        }
        $N9 = $current_user->user_login;
        OS:
        $qv = $zJ . "\40" . $N9;
        $hU = "\x4c\x6f\x67\157\165\x74";
        if (!get_option("\x6d\x6f\137\x73\x61\x6d\x6c\137\x63\x75\163\x74\x6f\155\x5f\154\157\x67\x6f\x75\164\137\164\x65\x78\164")) {
            goto ve;
        }
        $hU = get_option("\155\x6f\x5f\163\x61\x6d\x6c\137\x63\165\163\x74\x6f\155\137\154\x6f\x67\x6f\x75\164\x5f\x74\x65\x78\164");
        ve:
        $qC = $qv . "\40\174\40\74\x61\x20\x68\x72\145\146\75\x22" . wp_logout_url(home_url()) . "\x22\40\164\151\164\154\x65\x3d\x22\154\x6f\147\x6f\x75\x74\42\x20\76" . $hU . "\x3c\x2f\x61\76\74\57\154\x69\x3e";
        goto rw;
        pq:
        $uW = get_option("\x6d\x6f\x5f\x73\141\x6d\x6c\x5f\163\x70\x5f\x62\141\x73\x65\x5f\165\x72\x6c");
        if (!empty($uW)) {
            goto vM;
        }
        $uW = home_url();
        vM:
        if (mo_saml_is_sp_configured() && mo_saml_is_customer_license_key_verified()) {
            goto yG;
        }
        $qC = "\123\x50\40\151\163\x20\156\x6f\x74\x20\x63\x6f\156\x66\151\x67\165\x72\145\144\56";
        goto Zf;
        yG:
        $O3 = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Identity_name);
        $xP = '';
        if (!(!empty($Nz) and is_array($Nz))) {
            goto J4;
        }
        if (!isset($Nz["\x69\x64\x70"])) {
            goto VX;
        }
        $O3 = $Nz["\151\x64\160"];
        $xP = $O3;
        VX:
        J4:
        $kX = "\114\x6f\147\151\x6e\x20\167\x69\164\150\x20" . LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Identity_name);
        if (!get_option("\155\157\x5f\163\x61\x6d\x6c\137\143\165\x73\164\x6f\x6d\137\154\157\x67\151\x6e\x5f\x74\x65\x78\164")) {
            goto xB;
        }
        $kX = get_option("\x6d\x6f\137\163\x61\x6d\x6c\137\143\165\x73\164\157\155\x5f\x6c\x6f\147\x69\156\x5f\164\x65\170\164");
        xB:
        $eO = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Identity_name);
        $kX = str_replace("\43\x23\x49\x44\120\43\x23", $eO, $kX);
        $PF = false;
        if (!get_option("\155\x6f\x5f\x73\x61\155\154\x5f\x75\163\145\137\142\165\x74\164\x6f\156\x5f\x61\x73\137\163\x68\157\162\x74\143\x6f\144\145")) {
            goto U0;
        }
        if (!(get_option("\x6d\x6f\137\x73\141\x6d\154\x5f\x75\163\x65\137\x62\165\x74\164\x6f\x6e\137\141\163\137\x73\x68\157\162\x74\x63\x6f\x64\x65") == "\164\x72\165\145")) {
            goto U3;
        }
        $PF = true;
        U3:
        U0:
        if (!$PF) {
            goto PX;
        }
        $Od = get_option("\x6d\x6f\x5f\163\x61\x6d\154\137\x62\x75\164\x74\157\x6e\x5f\x77\x69\x64\164\150") ? get_option("\x6d\x6f\137\163\141\x6d\154\x5f\x62\165\x74\164\157\x6e\x5f\x77\x69\144\164\150") : "\x31\x30\60";
        $W7 = get_option("\155\x6f\x5f\x73\x61\x6d\154\x5f\142\x75\x74\x74\x6f\x6e\137\150\x65\151\147\150\x74") ? get_option("\155\157\137\x73\141\155\x6c\x5f\x62\x75\164\x74\x6f\156\137\x68\x65\x69\147\x68\x74") : "\65\x30";
        $XQ = get_option("\155\157\x5f\163\141\155\154\x5f\x62\165\164\164\157\x6e\x5f\x73\151\172\145") ? get_option("\x6d\x6f\x5f\x73\x61\155\154\x5f\x62\165\164\x74\157\x6e\x5f\163\x69\x7a\x65") : "\x35\x30";
        $z7 = get_option("\155\x6f\137\163\141\x6d\154\x5f\x62\165\x74\x74\x6f\156\x5f\x63\165\x72\x76\145") ? get_option("\155\157\x5f\x73\x61\155\x6c\137\142\x75\x74\164\157\x6e\137\x63\165\162\x76\145") : "\x35";
        $b1 = get_option("\x6d\157\x5f\x73\141\155\154\137\142\x75\164\x74\x6f\156\x5f\143\157\x6c\157\x72") ? get_option("\x6d\x6f\x5f\163\x61\155\x6c\137\142\165\164\164\157\x6e\137\x63\x6f\154\x6f\162") : "\x30\60\x38\65\x62\141";
        $Xa = get_option("\x6d\157\137\x73\x61\x6d\x6c\137\x62\x75\164\164\157\156\137\164\150\145\x6d\x65") ? get_option("\155\157\137\163\141\x6d\x6c\x5f\142\165\164\164\x6f\156\x5f\164\x68\x65\155\x65") : "\x6c\157\x6e\147\x62\x75\164\x74\x6f\156";
        $YB = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Identity_name);
        $WD = get_option("\x6d\x6f\x5f\x73\x61\x6d\154\137\142\165\x74\x74\157\x6e\137\x74\145\170\164") ? get_option("\155\157\137\x73\x61\155\154\x5f\142\x75\164\164\157\156\x5f\x74\x65\x78\x74") : ($YB ? $YB : "\114\157\147\x69\156");
        $j7 = get_option("\x6d\157\x5f\163\x61\x6d\154\137\146\x6f\156\164\137\143\157\x6c\x6f\162") ? get_option("\x6d\x6f\x5f\163\141\155\154\x5f\x66\x6f\156\164\137\143\x6f\154\x6f\162") : "\146\146\146\146\x66\x66";
        $r4 = get_option("\155\x6f\x5f\163\141\x6d\x6c\137\x66\x6f\x6e\164\x5f\x73\151\172\145") ? get_option("\x6d\157\x5f\x73\x61\x6d\154\137\146\157\x6e\164\137\163\x69\172\x65") : "\x32\x30";
        $kX = "\x3c\x69\156\x70\165\x74\x20\x74\171\160\x65\75\42\x62\x75\164\164\157\156\42\40\156\x61\x6d\145\x3d\x22\155\157\137\x73\x61\155\154\x5f\x77\x70\137\x73\163\x6f\x5f\x62\165\x74\x74\157\156\42\x20\166\141\x6c\x75\x65\x3d\42" . $WD . "\42\x20\163\x74\171\x6c\145\x3d\x22";
        $qZ = '';
        if ($Xa == "\154\157\156\x67\142\x75\164\x74\157\156") {
            goto W0;
        }
        if ($Xa == "\143\151\x72\x63\x6c\145") {
            goto UW;
        }
        if ($Xa == "\157\x76\141\154") {
            goto Xg;
        }
        if ($Xa == "\163\x71\x75\x61\162\x65") {
            goto DD;
        }
        goto F_;
        UW:
        $qZ = $qZ . "\167\x69\x64\x74\150\x3a" . $XQ . "\160\x78\73";
        $qZ = $qZ . "\x68\145\151\147\x68\164\72" . $XQ . "\160\170\73";
        $qZ = $qZ . "\142\x6f\162\x64\145\x72\55\x72\141\144\x69\x75\x73\x3a\x39\x39\71\160\x78\x3b";
        goto F_;
        Xg:
        $qZ = $qZ . "\167\151\144\x74\150\x3a" . $XQ . "\x70\170\73";
        $qZ = $qZ . "\x68\145\151\x67\150\x74\72" . $XQ . "\x70\170\x3b";
        $qZ = $qZ . "\x62\157\162\x64\x65\162\x2d\162\141\144\151\165\163\x3a\x35\160\170\x3b";
        goto F_;
        DD:
        $qZ = $qZ . "\167\151\144\164\150\x3a" . $XQ . "\x70\x78\73";
        $qZ = $qZ . "\x68\145\x69\147\x68\164\x3a" . $XQ . "\160\x78\x3b";
        $qZ = $qZ . "\x62\157\162\x64\145\x72\55\x72\141\144\x69\165\x73\72\x30\160\x78\x3b";
        F_:
        goto TY;
        W0:
        $qZ = $qZ . "\167\151\x64\x74\150\x3a" . $Od . "\x70\170\x3b";
        $qZ = $qZ . "\150\145\x69\x67\150\164\x3a" . $W7 . "\160\170\73";
        $qZ = $qZ . "\142\157\x72\x64\145\162\x2d\x72\x61\144\151\x75\163\x3a" . $z7 . "\x70\x78\73";
        TY:
        $qZ = $qZ . "\142\141\x63\x6b\x67\162\x6f\x75\x6e\x64\55\143\x6f\x6c\157\x72\72\x23" . $b1 . "\73";
        $qZ = $qZ . "\x62\157\162\144\x65\162\x2d\143\157\x6c\x6f\x72\x3a\164\162\x61\x6e\163\160\x61\x72\145\x6e\x74\73";
        $qZ = $qZ . "\143\x6f\154\157\162\72\43" . $j7 . "\73";
        $qZ = $qZ . "\146\x6f\156\x74\x2d\x73\x69\x7a\145\72" . $r4 . "\x70\170\x3b";
        $qZ = $qZ . "\x70\x61\144\x64\151\x6e\x67\72\60\160\170\73";
        $kX = $kX . $qZ . "\42\57\x3e";
        PX:
        $Nj = urlencode(saml_get_current_page_url());
        $qC = "\x3c\x61\x20\x68\x72\x65\146\75\x22" . $uW . "\57\x3f\x6f\x70\x74\151\x6f\156\75\x73\141\155\154\x5f\x75\x73\145\162\x5f\x6c\157\x67\x69\156";
        if (empty($xP)) {
            goto WQ;
        }
        $qC .= "\x26\151\144\x70\x3d" . $O3;
        WQ:
        $qC .= "\x26\162\145\x64\x69\x72\145\x63\x74\x5f\x74\x6f\x3d" . $Nj . "\x22";
        if (!$PF) {
            goto FP;
        }
        $qC = $qC . "\x73\164\171\154\x65\x3d\x22\x74\145\170\x74\55\144\145\143\157\x72\141\x74\151\x6f\156\x3a\156\x6f\x6e\x65\x3b\x22";
        FP:
        $qC = $qC . "\x3e" . $kX . "\x3c\x2f\x61\x3e";
        Zf:
        rw:
        return $qC;
    }
    function _handle_upload_metadata()
    {
        if (!(isset($_FILES["\x6d\145\x74\x61\144\141\164\x61\137\146\x69\154\x65"]) || isset($_POST["\155\x65\164\141\x64\x61\x74\141\137\x75\x72\154"]))) {
            goto md;
        }
        if (!empty($_FILES["\x6d\145\x74\x61\144\141\x74\141\x5f\146\x69\x6c\x65"]["\x74\155\x70\x5f\156\x61\x6d\145"])) {
            goto H5;
        }
        if (mo_saml_is_extension_installed("\x63\165\162\154")) {
            goto ps;
        }
        update_option("\155\x6f\137\163\141\155\x6c\x5f\155\x65\x73\x73\141\147\145", "\120\x48\x50\x20\143\x55\x52\114\x20\145\170\x74\x65\x6e\163\x69\157\x6e\x20\x69\163\x20\156\x6f\164\x20\151\x6e\x73\164\x61\154\x6c\x65\144\40\157\162\40\x64\151\x73\x61\142\154\145\144\x2e\x20\103\x61\156\156\x6f\x74\40\x66\145\x74\143\150\40\x6d\145\x74\x61\x64\141\164\x61\x20\146\162\x6f\x6d\40\125\122\x4c\56");
        $this->mo_saml_show_error_message();
        return;
        ps:
        $H4 = filter_var(htmlspecialchars($_POST["\x6d\x65\x74\x61\x64\141\164\141\137\165\162\154"]), FILTER_SANITIZE_URL);
        $Jq = SAMLSPUtilities::mo_saml_wp_remote_call($H4, array("\163\x73\x6c\166\x65\x72\x69\x66\x79" => false), true);
        if (!$Jq) {
            goto dn;
        }
        $aH = $Jq;
        goto Om;
        dn:
        return;
        Om:
        if (isset($_POST["\x73\171\156\x63\x5f\x6d\145\164\141\144\141\164\x61"])) {
            goto PC;
        }
        delete_option("\163\x61\x6d\154\x5f\155\145\164\141\144\x61\x74\x61\x5f\x75\x72\x6c\137\146\157\162\137\x73\171\156\x63");
        delete_option("\x73\141\x6d\154\x5f\155\145\x74\141\x64\141\164\x61\x5f\x73\171\156\143\137\151\x6e\x74\145\162\166\x61\x6c");
        wp_unschedule_event(wp_next_scheduled("\x6d\145\164\x61\144\x61\164\x61\137\x73\171\156\x63\x5f\x63\162\157\156\x5f\x61\x63\164\151\157\x6e"), "\x6d\x65\164\141\144\141\164\x61\x5f\x73\x79\156\x63\x5f\x63\x72\157\156\x5f\141\x63\x74\x69\157\156");
        goto yT;
        PC:
        update_option("\163\141\155\x6c\x5f\x6d\x65\x74\x61\144\141\x74\x61\137\x75\x72\x6c\x5f\x66\157\162\x5f\163\x79\156\x63", htmlspecialchars($_POST["\155\145\x74\x61\144\141\164\x61\137\165\162\x6c"]));
        update_option("\x73\141\155\154\137\x6d\145\164\x61\x64\x61\x74\x61\x5f\163\171\156\143\x5f\151\156\x74\x65\162\x76\141\154", htmlspecialchars($_POST["\163\x79\156\143\x5f\151\x6e\x74\x65\162\x76\x61\x6c"]));
        if (wp_next_scheduled("\155\x65\164\x61\144\x61\x74\x61\x5f\163\x79\156\143\137\x63\x72\x6f\x6e\137\x61\x63\164\151\157\156")) {
            goto Bc;
        }
        wp_schedule_event(time(), htmlspecialchars($_POST["\x73\x79\x6e\143\137\151\x6e\x74\145\x72\166\x61\x6c"]), "\x6d\145\164\141\x64\141\x74\141\x5f\x73\x79\x6e\x63\137\143\162\x6f\x6e\x5f\141\x63\x74\x69\157\x6e");
        Bc:
        yT:
        goto V0;
        H5:
        $aH = @file_get_contents($_FILES["\x6d\145\164\141\144\141\164\x61\x5f\146\x69\x6c\x65"]["\x74\x6d\x70\137\156\141\155\145"]);
        V0:
        $this->upload_metadata($aH);
        md:
    }
    function upload_metadata($aH)
    {
        $QP = set_error_handler(array($this, "\150\141\x6e\x64\154\145\130\x6d\154\105\x72\162\157\x72"));
        $Jl = new DOMDocument();
        $Jl->loadXML($aH);
        restore_error_handler();
        $CR = $Jl->firstChild;
        if (!empty($CR)) {
            goto hc;
        }
        if (!empty($_FILES["\155\x65\164\x61\144\x61\x74\141\137\x66\x69\154\x65"]["\x74\155\x70\x5f\x6e\141\155\145"])) {
            goto NE;
        }
        if (!empty($_POST["\155\145\x74\x61\144\141\164\141\137\165\x72\154"])) {
            goto EH;
        }
        update_option("\155\157\x5f\x73\141\155\x6c\x5f\155\145\163\163\141\x67\x65", "\120\x6c\145\x61\x73\x65\x20\160\162\157\x76\x69\144\x65\40\141\x20\166\x61\154\151\144\x20\155\x65\x74\x61\144\x61\164\x61\x20\x66\x69\x6c\145\x20\157\x72\40\141\40\166\141\x6c\151\x64\40\x55\122\x4c\56");
        $this->mo_saml_show_error_message();
        return;
        goto N0;
        EH:
        update_option("\155\157\137\x73\141\155\154\137\x6d\145\x73\163\x61\147\x65", "\120\154\x65\141\x73\x65\40\160\162\x6f\x76\151\144\x65\x20\141\40\x76\141\x6c\x69\x64\x20\155\145\164\x61\x64\141\x74\x61\x20\x55\122\x4c\x2e");
        $this->mo_saml_show_error_message();
        N0:
        goto x5;
        NE:
        update_option("\155\x6f\137\163\141\155\154\x5f\x6d\x65\x73\163\x61\147\145", "\120\x6c\145\141\163\145\40\x70\162\x6f\x76\x69\144\145\40\x61\40\166\141\x6c\151\x64\40\x6d\x65\164\x61\144\141\x74\141\x20\146\x69\154\x65\x2e");
        $this->mo_saml_show_error_message();
        x5:
        goto rg;
        hc:
        $gl = new IDPMetadataReader($Jl);
        $Uv = $gl->getIdentityProviders();
        if (!empty($Uv)) {
            goto rT;
        }
        update_option("\155\x6f\137\163\x61\x6d\154\137\x6d\145\163\163\x61\x67\x65", "\x50\x6c\145\141\x73\145\40\160\162\x6f\x76\151\x64\x65\x20\141\40\x76\141\154\151\x64\40\155\x65\x74\x61\144\141\x74\141\x20\x66\151\x6c\145\56");
        $this->mo_saml_show_error_message();
        return;
        rT:
        foreach ($Uv as $y9 => $O3) {
            $gY = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Identity_name);
            if (!isset($_POST["\x73\x61\155\x6c\137\x69\x64\145\x6e\164\151\164\x79\x5f\155\145\x74\x61\x64\x61\164\x61\137\160\x72\x6f\166\151\x64\x65\162"])) {
                goto Im;
            }
            $gY = htmlspecialchars($_POST["\163\x61\155\x6c\x5f\151\x64\x65\x6e\x74\x69\x74\x79\137\155\145\164\x61\144\141\164\141\137\160\x72\157\166\151\144\145\x72"]);
            Im:
            $Yi = "\110\x74\x74\x70\x52\x65\144\x69\162\x65\143\164";
            $le = '';
            if (array_key_exists("\x48\124\x54\x50\x2d\x52\145\144\151\162\145\143\164", $O3->getLoginDetails())) {
                goto I2;
            }
            if (!array_key_exists("\110\124\124\x50\55\120\117\123\124", $O3->getLoginDetails())) {
                goto pZ;
            }
            $Yi = "\110\164\164\160\120\157\x73\x74";
            $le = $O3->getLoginURL("\110\124\124\x50\x2d\120\x4f\123\124");
            pZ:
            goto ny;
            I2:
            $le = $O3->getLoginURL("\110\x54\124\120\55\122\145\144\151\162\x65\x63\x74");
            ny:
            $bN = "\110\x74\x74\160\122\145\144\x69\x72\x65\143\x74";
            $wW = '';
            if (array_key_exists("\110\124\x54\x50\55\122\x65\x64\151\162\145\x63\164", $O3->getLogoutDetails())) {
                goto WW;
            }
            if (!array_key_exists("\110\124\x54\x50\x2d\120\117\123\124", $O3->getLogoutDetails())) {
                goto AI;
            }
            $bN = "\110\164\164\x70\120\157\163\x74";
            $wW = $O3->getLogoutURL("\110\124\x54\x50\55\x50\117\x53\124");
            AI:
            goto vD;
            WW:
            $wW = $O3->getLogoutURL("\110\x54\124\x50\55\122\145\x64\x69\x72\145\x63\164");
            vD:
            $EE = $O3->getEntityID();
            $FL = $O3->getSigningCertificate();
            if (!get_option("\155\157\137\145\156\141\142\x6c\145\137\x6d\165\154\164\151\160\x6c\145\137\x6c\x69\x63\145\156\163\145\163")) {
                goto g1;
            }
            $Kt = get_option("\x6d\x6f\137\x73\x61\x6d\154\137\145\156\166\151\162\x6f\156\x6d\145\x6e\x74\x5f\157\x62\x6a\x65\x63\164\163");
            $og = LicenseHelper::getSelectedEnvironment();
            if (!isset($Kt[$og])) {
                goto v7;
            }
            $kz = $Kt[$og]->getPluginSettings();
            $kz[mo_options_enum_service_provider::Identity_name] = $gY;
            $kz[mo_options_enum_service_provider::Login_URL] = $le;
            $kz[mo_options_enum_service_provider::Issuer] = $EE;
            $kz[mo_options_enum_service_provider::X509_certificate] = maybe_serialize($FL);
            $kz[mo_options_enum_service_provider::Logout_URL] = $wW;
            $kz[mo_options_enum_service_provider::Login_binding_type] = $Yi;
            $kz[mo_options_enum_service_provider::Logout_binding_type] = $bN;
            $Kt[$og]->setPluginSettings($kz);
            update_option("\x6d\x6f\137\x73\x61\x6d\154\137\x65\156\x76\x69\x72\x6f\156\x6d\145\156\x74\x5f\157\x62\x6a\145\x63\x74\x73", $Kt);
            $di = LicenseHelper::getSelectedEnvironment();
            if (!($di and $di != LicenseHelper::getCurrentEnvironment())) {
                goto fE;
            }
            goto GN;
            fE:
            v7:
            g1:
            update_option("\163\141\155\154\137\151\x64\x65\x6e\164\151\164\x79\137\156\141\x6d\145", $gY);
            update_option("\163\x61\155\154\137\154\x6f\147\x69\156\x5f\142\x69\156\144\151\156\x67\137\164\171\x70\145", $Yi);
            update_option("\163\141\155\x6c\x5f\x6c\x6f\x67\x69\x6e\137\x75\x72\x6c", $le);
            update_option("\x73\141\x6d\x6c\137\x6c\x6f\147\157\x75\x74\137\x62\x69\x6e\x64\x69\x6e\147\x5f\x74\x79\160\145", $bN);
            update_option("\x73\x61\x6d\154\137\x6c\x6f\147\157\x75\x74\137\x75\162\154", $wW);
            update_option("\x73\141\155\x6c\x5f\x69\x73\163\x75\145\162", $EE);
            update_option("\x73\x61\x6d\154\137\x6e\x61\x6d\145\151\x64\137\x66\x6f\x72\x6d\x61\x74", "\61\56\61\x3a\x6e\x61\155\x65\151\x64\x2d\x66\157\162\x6d\x61\164\x3a\x75\156\x73\x70\145\143\151\x66\151\x65\144");
            update_option("\163\x61\155\x6c\137\170\65\x30\x39\x5f\x63\145\162\164\151\x66\151\143\141\164\x65", maybe_serialize($FL));
            goto GN;
            cR:
        }
        GN:
        update_option("\155\x6f\137\163\x61\155\x6c\137\155\x65\163\x73\x61\x67\x65", "\111\144\145\x6e\164\151\164\x79\x20\120\x72\157\166\151\x64\x65\x72\40\144\x65\x74\141\151\x6c\163\x20\163\141\x76\145\144\40\x73\165\143\143\145\163\163\146\165\154\x6c\x79\56");
        $this->mo_saml_show_success_message();
        rg:
    }
    function handleXmlError($fn, $sm, $sP, $UQ)
    {
        if ($fn == E_WARNING && substr_count($sm, "\x44\117\115\104\157\x63\x75\155\x65\x6e\x74\72\x3a\x6c\x6f\141\144\130\x4d\x4c\x28\x29") > 0) {
            goto KI;
        }
        return false;
        goto VA;
        KI:
        return;
        VA:
    }
    function mo_saml_plugin_action_links($sS)
    {
        $sS = array_merge(array("\x3c\x61\x20\x68\162\x65\x66\75\x22" . esc_url(admin_url("\141\x64\155\x69\156\56\x70\150\x70\77\x70\x61\147\145\75\x6d\x6f\x5f\x73\141\x6d\x6c\x5f\163\x65\164\164\151\x6e\x67\163")) . "\42\76" . __("\x53\145\164\164\151\156\147\x73", "\164\145\x78\x74\144\157\x6d\x61\151\x6e") . "\x3c\x2f\x61\x3e"), $sS);
        return $sS;
    }
    function checkPasswordPattern($ZL)
    {
        $pU = "\57\x5e\133\x28\134\x77\51\52\x28\x5c\41\x5c\x40\x5c\x23\x5c\44\134\x25\134\x5e\x5c\46\x5c\x2a\x5c\x2e\134\55\x5c\x5f\x29\52\135\x2b\x24\57";
        return !preg_match($pU, $ZL);
    }
    function mo_saml_parse_expiry_date($IY)
    {
        $QK = new DateTime($IY);
        $Je = $QK->getTimestamp();
        return date("\106\40\152\54\40\131", $Je);
    }
}
new saml_mo_login();
