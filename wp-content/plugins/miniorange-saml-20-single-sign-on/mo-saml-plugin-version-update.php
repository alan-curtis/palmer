<?php


require_once dirname(__FILE__) . "\57\151\x6e\143\x6c\x75\144\145\x73\57\154\151\x62\57\x6d\x6f\55\x6f\x70\164\151\x6f\156\x73\55\x65\x6e\165\x6d\x2e\160\x68\x70";
add_action("\x61\x64\x6d\x69\156\137\x69\156\151\164", "\155\157\137\x73\141\x6d\154\137\x75\160\x64\141\x74\145");
class mo_saml_update_framework
{
    private $current_version;
    private $update_path;
    private $plugin_slug;
    private $slug;
    private $plugin_file;
    private $new_version_changelog;
    public function __construct($N1, $j2 = "\x2f", $mi = "\x2f")
    {
        $this->current_version = $N1;
        $this->update_path = $j2;
        $this->plugin_slug = $mi;
        list($KT, $my) = explode("\57", $mi);
        $this->slug = $KT;
        $this->plugin_file = $my;
        add_filter("\160\x72\x65\137\x73\145\x74\x5f\x73\151\164\145\137\x74\162\x61\x6e\163\151\145\x6e\x74\x5f\165\160\144\141\x74\145\137\x70\x6c\165\147\x69\x6e\x73", array(&$this, "\155\x6f\137\x73\141\x6d\x6c\137\143\150\x65\x63\x6b\x5f\165\x70\144\x61\164\x65"));
        add_filter("\x70\154\165\147\151\156\163\x5f\141\160\x69", array(&$this, "\x6d\157\x5f\x73\141\x6d\x6c\x5f\143\x68\145\x63\x6b\137\151\156\x66\x6f"), 10, 3);
    }
    public function mo_saml_check_update($Kh)
    {
        if (!empty($Kh->checked)) {
            goto o2;
        }
        return $Kh;
        o2:
        $K2 = $this->getRemote();
        if (!empty($K2)) {
            goto oo;
        }
        return $Kh;
        oo:
        if (!(isset($K2["\154\x69\x63\145\156\x73\145\x49\156\x66\x6f\162\x6d\x61\164\x69\x6f\156"]) and get_option("\x6d\x6f\137\163\x61\x6d\x6c\x5f\163\x6c\145"))) {
            goto R5;
        }
        update_option("\x6d\157\x5f\162\x65\x6e\145\x77\x61\x6c\x5f\141\144\155\151\x6e\x5f\156\157\164\x69\143\x65", $K2["\154\x69\x63\145\x6e\163\145\x49\x6e\x66\157\x72\x6d\141\x74\x69\x6f\156"]);
        R5:
        if ($K2["\x73\164\x61\x74\165\x73"] == "\x53\x55\103\103\x45\x53\x53") {
            goto Jt;
        }
        if (!($K2["\x73\164\x61\164\165\x73"] == "\x44\x45\x4e\111\105\104")) {
            goto i2;
        }
        if (!version_compare($this->current_version, $K2["\x6e\x65\167\126\145\162\163\151\x6f\156"], "\x3c")) {
            goto Mm;
        }
        $m5 = new stdClass();
        $m5->slug = $this->slug;
        $m5->new_version = $K2["\156\x65\x77\x56\x65\x72\x73\x69\157\156"];
        $m5->url = "\x68\164\164\160\x73\x3a\57\57\x6d\151\156\x69\x6f\x72\141\156\x67\x65\56\143\157\155";
        $m5->plugin = $this->plugin_slug;
        $m5->tested = $K2["\143\x6d\x73\103\157\x6d\x70\x61\164\151\x62\151\x6c\x69\x74\171\126\145\x72\163\151\x6f\x6e"];
        $m5->icons = array("\61\170" => $K2["\151\x63\157\156"]);
        $m5->status_code = $K2["\x73\164\141\x74\165\163"];
        $m5->license_information = $K2["\x6c\151\143\145\x6e\163\145\x49\x6e\x66\157\x72\x6d\141\x74\x69\x6f\x6e"];
        update_option("\155\157\137\163\x61\x6d\x6c\137\154\151\143\x65\x6e\163\x65\137\x65\x78\160\151\162\x79\137\144\x61\164\145", $K2["\x6c\x69\x63\x65\x6e\x65\x45\x78\160\151\x72\x79\104\x61\x74\145"]);
        $Kh->response[$this->plugin_slug] = $m5;
        $Hj = true;
        update_option("\155\157\137\x73\141\x6d\x6c\x5f\x73\154\x65", $Hj);
        set_transient("\165\160\144\141\164\145\x5f\x70\154\165\147\151\x6e\x73", $Kh);
        return $Kh;
        Mm:
        i2:
        goto py;
        Jt:
        $Hj = false;
        update_option("\x6d\157\x5f\163\141\x6d\154\x5f\x73\x6c\145", $Hj);
        if (!version_compare($this->current_version, $K2["\156\x65\x77\126\145\162\163\151\x6f\156"], "\74")) {
            goto mP;
        }
        ini_set("\x6d\x61\170\137\145\x78\145\x63\165\164\x69\157\x6e\x5f\x74\151\155\x65", 600);
        ini_set("\x6d\x65\155\x6f\x72\171\x5f\154\151\155\x69\x74", "\x31\60\x32\64\115");
        $s5 = plugin_dir_path(__FILE__);
        $s5 = rtrim($s5, "\x2f");
        $s5 = rtrim($s5, "\134");
        $uk = $s5 . "\x2d\160\162\x65\155\151\165\155\55\x62\x61\x63\x6b\165\160\55" . $this->current_version . "\56\172\x69\x70";
        $this->mo_saml_create_backup_dir();
        $GZ = $this->getAuthToken();
        $JI = round(microtime(true) * 1000);
        $JI = number_format($JI, 0, '', '');
        $m5 = new stdClass();
        $m5->slug = $this->slug;
        $m5->new_version = $K2["\x6e\x65\x77\x56\x65\x72\163\x69\x6f\x6e"];
        $m5->url = "\x68\x74\x74\x70\163\72\x2f\57\155\151\x6e\151\x6f\x72\x61\156\147\x65\56\x63\x6f\155";
        $m5->plugin = $this->plugin_slug;
        $m5->package = mo_options_plugin_constants::HOSTNAME . "\57\155\x6f\x61\x73\57\160\x6c\165\x67\x69\x6e\x2f\x64\x6f\x77\156\x6c\157\x61\144\x2d\x75\x70\144\x61\x74\145\x3f\160\x6c\165\x67\151\156\x53\x6c\165\x67\75" . $this->plugin_slug . "\x26\154\151\143\x65\x6e\163\x65\x50\x6c\x61\156\x4e\141\x6d\145\75" . mo_options_plugin_constants::LICENSE_PLAN_NAME . "\x26\143\165\x73\164\157\155\x65\162\111\x64\x3d" . get_option("\x6d\x6f\x5f\x73\141\155\154\x5f\141\144\155\x69\156\137\x63\165\163\164\157\x6d\145\162\x5f\x6b\x65\x79") . "\x26\x6c\151\143\x65\x6e\x73\145\x54\x79\160\145\75" . mo_options_plugin_constants::LICENSE_TYPE . "\x26\141\x75\x74\x68\x54\157\153\145\x6e\x3d" . $GZ . "\46\157\164\160\124\157\x6b\x65\156\x3d" . $JI;
        $m5->tested = $K2["\143\155\163\103\157\155\160\141\x74\x69\x62\151\x6c\x69\164\x79\x56\x65\x72\163\151\157\x6e"];
        $m5->icons = array("\x31\x78" => $K2["\151\x63\x6f\x6e"]);
        $m5->new_version_changelog = $K2["\143\150\x61\156\x67\x65\154\x6f\147"];
        $m5->status_code = $K2["\x73\164\141\x74\x75\x73"];
        update_option("\x6d\157\137\163\x61\155\154\x5f\154\151\143\x65\x6e\163\x65\x5f\x65\x78\160\x69\162\171\x5f\144\141\164\x65", $K2["\154\x69\143\x65\156\x65\x45\170\x70\x69\x72\x79\x44\141\164\x65"]);
        $Kh->response[$this->plugin_slug] = $m5;
        set_transient("\x75\160\144\141\164\x65\137\160\x6c\165\147\x69\156\x73", $Kh);
        return $Kh;
        mP:
        py:
        return $Kh;
    }
    public function mo_saml_check_info($m5, $FK, $M1)
    {
        if (!(($FK == "\161\165\145\162\171\137\x70\x6c\x75\147\x69\x6e\163" || $FK == "\160\x6c\x75\147\151\156\x5f\x69\x6e\x66\x6f\162\x6d\x61\164\x69\157\156") && isset($M1->slug) && ($M1->slug === $this->slug || $M1->slug === $this->plugin_file))) {
            goto d9;
        }
        $AW = $this->getRemote();
        if (!empty($AW)) {
            goto jv;
        }
        return $m5;
        jv:
        remove_filter("\x70\x6c\165\147\151\156\163\x5f\x61\x70\151", array($this, "\155\x6f\137\x73\x61\x6d\154\137\143\x68\x65\x63\153\x5f\151\156\146\157"));
        $FG = plugins_api("\160\154\x75\x67\151\x6e\x5f\151\156\146\157\162\x6d\x61\x74\x69\157\156", array("\x73\154\x75\x67" => $this->slug, "\146\151\x65\154\144\x73" => array("\141\x63\164\151\x76\x65\137\151\156\163\x74\141\x6c\154\163" => true, "\x6e\165\155\137\x72\x61\x74\151\156\x67\x73" => true, "\x72\x61\164\x69\x6e\147" => true, "\162\141\x74\x69\156\x67\x73" => true, "\x72\145\166\x69\x65\167\x73" => true)));
        $RK = false;
        $U7 = false;
        $lr = false;
        $J0 = false;
        $yb = '';
        $cy = '';
        if (is_wp_error($FG)) {
            goto Zk;
        }
        $RK = $FG->active_installs;
        $U7 = $FG->rating;
        $lr = $FG->ratings;
        $J0 = $FG->num_ratings;
        $yb = $FG->sections["\x64\x65\x73\143\162\x69\x70\164\151\157\156"];
        $cy = $FG->sections["\162\145\x76\151\x65\167\x73"];
        Zk:
        add_filter("\160\154\165\147\151\156\x73\x5f\141\160\x69", array($this, "\x6d\x6f\x5f\x73\141\155\x6c\x5f\x63\x68\x65\x63\153\137\151\156\x66\157"), 10, 3);
        if ($AW["\x73\x74\x61\x74\165\163"] == "\x53\125\103\103\105\123\x53") {
            goto CA;
        }
        if (!($AW["\163\164\x61\164\x75\x73"] == "\x44\105\116\x49\x45\x44")) {
            goto W1;
        }
        if (!version_compare($this->current_version, $AW["\x6e\145\x77\x56\145\x72\x73\151\x6f\156"], "\x3c")) {
            goto sJ;
        }
        $B9 = new stdClass();
        $B9->slug = $this->slug;
        $B9->plugin = $this->plugin_slug;
        $B9->name = $AW["\x70\x6c\165\147\x69\156\116\x61\x6d\x65"];
        $B9->version = $AW["\156\x65\167\x56\x65\x72\x73\151\x6f\x6e"];
        $B9->new_version = $AW["\156\x65\167\x56\145\x72\163\x69\157\x6e"];
        $B9->tested = $AW["\x63\x6d\x73\103\x6f\x6d\160\x61\x74\151\142\151\x6c\x69\x74\x79\x56\145\162\163\151\157\156"];
        $B9->requires = $AW["\143\x6d\163\x4d\151\156\x56\x65\x72\x73\151\157\156"];
        $B9->requires_php = $AW["\x70\150\x70\115\x69\156\x56\x65\162\163\x69\157\156"];
        $B9->compatibility = array($AW["\x63\155\163\x43\157\155\x70\x61\164\151\x62\151\154\x69\x74\x79\x56\145\x72\163\151\x6f\156"]);
        $B9->url = $AW["\143\155\163\120\x6c\165\147\151\156\125\162\154"];
        $B9->author = $AW["\x70\154\165\147\151\156\101\x75\x74\150\157\162"];
        $B9->author_profile = $AW["\x70\x6c\165\147\x69\x6e\101\x75\x74\x68\x6f\162\120\162\x6f\146\151\x6c\x65"];
        $B9->last_updated = $AW["\154\141\163\164\x55\x70\x64\x61\x74\x65\x64"];
        $B9->banners = array("\154\157\x77" => $AW["\142\x61\x6e\x6e\145\162"]);
        $B9->icons = array("\x31\x78" => $AW["\151\x63\157\156"]);
        $B9->sections = array("\x63\x68\x61\156\147\x65\x6c\x6f\147" => $AW["\143\x68\141\x6e\147\x65\x6c\157\x67"], "\154\x69\143\145\156\x73\145\137\x69\x6e\x66\157\x72\155\141\x74\x69\x6f\156" => _x($AW["\x6c\x69\143\x65\x6e\163\145\x49\x6e\x66\157\162\x6d\141\164\x69\x6f\x6e"], "\120\154\x75\147\x69\156\40\x69\x6e\x73\164\x61\x6c\154\145\162\x20\163\x65\x63\x74\x69\157\156\40\x74\151\x74\154\x65"), "\x64\145\163\143\162\x69\160\x74\x69\x6f\x6e" => $yb, "\x52\145\166\x69\x65\167\x73" => $cy);
        $B9->external = '';
        $B9->homepage = isset($AW["\x68\x6f\x6d\x65\x70\141\147\x65"]) ? $AW["\150\157\x6d\145\160\141\x67\x65"] : '';
        $B9->reviews = true;
        $B9->active_installs = $RK;
        $B9->rating = $U7;
        $B9->ratings = $lr;
        $B9->num_ratings = $J0;
        update_option("\155\x6f\x5f\163\141\x6d\154\x5f\x6c\151\x63\x65\x6e\x73\x65\137\x65\170\160\151\162\x79\x5f\x64\x61\164\x65", $AW["\154\151\143\x65\156\x65\105\x78\160\151\x72\x79\x44\141\x74\x65"]);
        return $B9;
        sJ:
        W1:
        goto um;
        CA:
        $Hj = false;
        update_option("\x6d\x6f\137\163\x61\155\154\x5f\163\x6c\145", $Hj);
        if (!version_compare($this->current_version, $AW["\156\x65\x77\126\145\x72\x73\151\x6f\x6e"], "\x3c\x3d")) {
            goto p7;
        }
        $B9 = new stdClass();
        $B9->slug = $this->slug;
        $B9->name = $AW["\x70\154\165\x67\x69\x6e\116\141\x6d\145"];
        $B9->plugin = $this->plugin_slug;
        $B9->version = $AW["\156\145\167\126\x65\162\x73\x69\157\156"];
        $B9->new_version = $AW["\156\x65\167\126\x65\162\x73\151\x6f\156"];
        $B9->tested = $AW["\143\x6d\x73\x43\x6f\155\x70\141\164\x69\x62\x69\x6c\x69\x74\171\126\145\162\163\151\157\x6e"];
        $B9->requires = $AW["\143\155\x73\115\x69\x6e\x56\145\162\x73\x69\x6f\x6e"];
        $B9->requires_php = $AW["\160\150\x70\x4d\151\x6e\126\x65\x72\x73\151\157\x6e"];
        $B9->compatibility = array($AW["\x63\155\x73\103\157\155\160\x61\164\x69\142\x69\x6c\151\164\171\x56\145\162\163\151\x6f\x6e"]);
        $B9->url = $AW["\143\155\x73\120\x6c\x75\x67\151\156\125\x72\x6c"];
        $B9->author = $AW["\160\154\165\147\151\x6e\101\165\x74\150\157\x72"];
        $B9->author_profile = $AW["\160\x6c\165\147\151\x6e\x41\x75\x74\150\157\x72\120\162\x6f\x66\x69\x6c\x65"];
        $B9->last_updated = $AW["\154\x61\x73\164\x55\160\144\x61\x74\145\144"];
        $B9->banners = array("\154\x6f\x77" => $AW["\x62\141\x6e\156\145\x72"]);
        $B9->icons = array("\x31\170" => $AW["\x69\143\x6f\156"]);
        $B9->sections = array("\143\150\x61\156\x67\x65\154\157\x67" => $AW["\143\150\141\156\147\x65\x6c\157\x67"], "\x6c\151\143\x65\x6e\163\x65\x5f\x69\x6e\x66\157\162\155\x61\x74\151\x6f\156" => _x($AW["\x6c\151\143\145\x6e\x73\145\x49\x6e\146\x6f\162\x6d\x61\164\151\157\156"], "\x50\x6c\165\147\151\156\40\x69\x6e\163\x74\141\154\x6c\x65\162\x20\x73\145\x63\164\x69\157\156\x20\x74\151\164\154\145"), "\144\145\163\143\162\151\160\164\151\x6f\x6e" => $yb, "\x52\x65\x76\151\145\167\163" => $cy);
        $GZ = $this->getAuthToken();
        $JI = round(microtime(true) * 1000);
        $JI = number_format($JI, 0, '', '');
        $B9->download_link = mo_options_plugin_constants::HOSTNAME . "\x2f\155\x6f\141\x73\57\160\154\165\147\151\156\x2f\144\157\167\156\154\157\x61\x64\55\165\160\144\x61\164\x65\77\x70\x6c\165\x67\151\156\x53\x6c\165\x67\x3d" . $this->plugin_slug . "\x26\x6c\151\x63\145\156\163\145\x50\154\x61\x6e\116\141\x6d\145\x3d" . mo_options_plugin_constants::LICENSE_PLAN_NAME . "\x26\x63\165\x73\x74\157\155\145\162\x49\x64\75" . get_option("\155\157\137\x73\x61\x6d\154\137\141\144\155\151\156\137\143\x75\163\x74\x6f\155\x65\x72\137\x6b\x65\171") . "\46\x6c\151\143\x65\x6e\163\x65\x54\x79\160\x65\75" . mo_options_plugin_constants::LICENSE_TYPE . "\x26\141\165\x74\150\x54\x6f\x6b\145\x6e\75" . $GZ . "\x26\x6f\164\160\x54\x6f\x6b\145\x6e\75" . $JI;
        $B9->package = $B9->download_link;
        $B9->external = '';
        $B9->homepage = isset($AW["\x68\157\x6d\145\x70\x61\147\145"]) ? $AW["\150\x6f\155\145\160\141\147\x65"] : '';
        $B9->reviews = true;
        $B9->active_installs = $RK;
        $B9->rating = $U7;
        $B9->ratings = $lr;
        $B9->num_ratings = $J0;
        update_option("\x6d\157\x5f\163\141\155\154\137\x6c\x69\143\145\x6e\163\145\137\145\x78\160\x69\162\x79\x5f\144\x61\164\145", $AW["\x6c\x69\x63\x65\x6e\145\x45\x78\x70\x69\162\171\104\x61\x74\145"]);
        return $B9;
        p7:
        um:
        d9:
        return $m5;
    }
    private function getRemote()
    {
        $Da = get_option("\x6d\x6f\137\x73\x61\x6d\154\x5f\x61\x64\155\151\156\137\x63\165\x73\164\x6f\155\145\162\x5f\153\x65\171");
        $Ir = get_option("\155\157\x5f\163\141\155\154\137\141\144\x6d\151\x6e\x5f\141\160\x69\137\153\x65\171");
        $JI = round(microtime(true) * 1000);
        $Lh = $Da . number_format($JI, 0, '', '') . $Ir;
        $GZ = hash("\163\x68\141\65\x31\x32", $Lh);
        $JI = number_format($JI, 0, '', '');
        $mZ = array("\160\154\165\147\151\156\123\154\165\147" => $this->plugin_slug, "\x6c\151\143\x65\156\x73\x65\120\154\141\156\116\141\x6d\x65" => mo_options_plugin_constants::LICENSE_PLAN_NAME, "\143\165\163\x74\x6f\x6d\x65\x72\111\144" => $Da, "\154\151\x63\x65\x6e\163\145\124\171\160\x65" => mo_options_plugin_constants::LICENSE_TYPE);
        $Jo = array("\x68\145\141\144\x65\x72\x73" => array("\103\x6f\x6e\x74\145\156\164\55\x54\171\160\145" => "\141\x70\160\x6c\151\143\141\164\x69\x6f\x6e\57\152\163\157\x6e\73\x20\143\150\x61\162\163\145\x74\x3d\x75\164\x66\55\x38", "\103\165\x73\x74\157\155\x65\x72\x2d\x4b\145\171" => $Da, "\x54\151\155\145\x73\164\x61\x6d\160" => $JI, "\101\x75\164\x68\157\x72\151\172\141\164\151\x6f\156" => $GZ), "\142\157\144\171" => json_encode($mZ), "\155\145\x74\150\x6f\x64" => "\x50\x4f\123\124", "\x64\x61\x74\141\x5f\x66\157\x72\155\x61\164" => "\142\x6f\x64\171", "\163\163\154\x76\x65\x72\x69\x66\171" => false);
        $Jq = wp_remote_post($this->update_path, $Jo);
        if (!(!is_wp_error($Jq) || wp_remote_retrieve_response_code($Jq) === 200)) {
            goto gm;
        }
        $dC = json_decode($Jq["\x62\x6f\x64\171"], true);
        return $dC;
        gm:
        return false;
    }
    private function getAuthToken()
    {
        $Da = get_option("\x6d\x6f\x5f\x73\x61\155\154\137\141\x64\x6d\x69\x6e\137\x63\165\163\164\157\x6d\145\x72\x5f\153\x65\171");
        $Ir = get_option("\x6d\x6f\x5f\163\x61\x6d\x6c\x5f\141\144\x6d\x69\156\137\x61\160\151\x5f\x6b\145\171");
        $JI = round(microtime(true) * 1000);
        $Lh = $Da . number_format($JI, 0, '', '') . $Ir;
        $GZ = hash("\163\x68\x61\x35\x31\62", $Lh);
        return $GZ;
    }
    function zipData($mv, $GH)
    {
        if (!(extension_loaded("\x7a\x69\160") && file_exists($mv) && count(glob($mv . DIRECTORY_SEPARATOR . "\x2a")) !== 0)) {
            goto bp;
        }
        $ZM = new ZipArchive();
        if (!$ZM->open($GH, ZIPARCHIVE::CREATE)) {
            goto J9;
        }
        $mv = realpath($mv);
        if (is_dir($mv) === true) {
            goto yJ;
        }
        if (!is_file($mv)) {
            goto wB;
        }
        $ZM->addFromString(basename($mv), file_get_contents($mv));
        wB:
        goto B3;
        yJ:
        $BR = new RecursiveDirectoryIterator($mv);
        $BR->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
        $fH = new RecursiveIteratorIterator($BR, RecursiveIteratorIterator::SELF_FIRST);
        foreach ($fH as $aH) {
            $aH = realpath($aH);
            if (is_dir($aH) === true) {
                goto GP;
            }
            if (!(is_file($aH) === true)) {
                goto G1;
            }
            $ZM->addFromString(str_replace($mv . DIRECTORY_SEPARATOR, '', $aH), file_get_contents($aH));
            G1:
            goto YD;
            GP:
            $ZM->addEmptyDir(str_replace($mv . DIRECTORY_SEPARATOR, '', $aH . DIRECTORY_SEPARATOR));
            YD:
            P0:
        }
        uX:
        B3:
        J9:
        return $ZM->close();
        bp:
        return false;
    }
    function mo_saml_plugin_update_message($hN, $Jq)
    {
        if (array_key_exists("\x73\x74\141\164\x75\163\137\143\x6f\144\x65", $hN)) {
            goto iX;
        }
        return;
        iX:
        if ($hN["\x73\164\x61\x74\165\163\x5f\x63\157\x64\145"] == "\123\125\x43\103\105\x53\123") {
            goto Vq;
        }
        if (!($hN["\163\164\141\x74\x75\163\137\143\x6f\x64\145"] == "\104\x45\116\x49\x45\104")) {
            goto Hn;
        }
        echo sprintf(__($hN["\x6c\x69\143\x65\156\x73\x65\137\x69\x6e\146\157\x72\155\x61\x74\151\x6f\x6e"]));
        Hn:
        goto YI;
        Vq:
        $UW = wp_upload_dir();
        $t0 = $UW["\142\x61\163\x65\x64\151\162"];
        $UW = rtrim($t0, "\x2f");
        $s5 = $UW . DIRECTORY_SEPARATOR . "\142\x61\143\153\165\160";
        $uk = "\x6d\151\156\151\x6f\162\x61\156\x67\145\x2d\163\x61\155\x6c\x2d\x32\60\55\x73\x69\156\x67\x6c\x65\x2d\163\151\147\156\x2d\157\x6e\x2d\x70\x72\x65\155\x69\165\155\x2d\142\x61\143\x6b\x75\160\x2d" . $this->current_version;
        $g_ = explode("\74\57\x75\x6c\x3e", $hN["\x6e\x65\167\137\166\x65\x72\163\x69\x6f\156\x5f\x63\150\x61\x6e\147\145\x6c\157\x67"]);
        $Qa = $g_[0];
        $qC = $Qa . "\x3c\57\165\154\76";
        echo "\74\x64\151\166\76\x3c\142\x3e" . __("\74\x62\x72\40\x2f\x3e\x41\x6e\x20\141\x75\x74\x6f\155\x61\164\151\x63\x20\x62\141\143\153\x75\x70\40\157\146\x20\143\165\x72\x72\x65\156\164\x20\x76\x65\x72\x73\x69\x6f\156\x20" . $this->current_version . "\x20\x68\141\163\40\x62\145\x65\x6e\x20\143\162\145\141\x74\x65\x64\x20\x61\164\x20\x74\x68\x65\40\154\x6f\x63\141\x74\x69\x6f\156\40" . $s5 . "\x20\167\x69\164\150\x20\164\x68\x65\x20\156\x61\155\x65\x20\74\163\160\141\156\x20\x73\x74\171\x6c\145\75\42\x63\x6f\x6c\x6f\x72\x3a\x23\60\x30\67\x33\x61\x61\x3b\x22\x3e" . $uk . "\x3c\x2f\163\160\x61\156\76\x2e\40\x49\156\40\x63\x61\163\145\54\40\163\157\x6d\145\164\x68\x69\156\147\40\142\x72\x65\x61\153\163\x20\144\x75\x72\151\156\147\40\164\x68\145\x20\x75\x70\x64\x61\164\145\x2c\x20\171\x6f\165\x20\143\141\x6e\40\x72\145\166\x65\x72\x74\x20\x74\157\40\171\x6f\x75\162\40\143\x75\162\162\x65\156\x74\40\x76\145\162\x73\x69\157\x6e\40\142\x79\40\162\x65\160\x6c\x61\143\151\156\147\40\x74\x68\145\40\142\141\143\x6b\165\160\x20\165\163\151\156\147\40\106\124\120\x20\x61\143\143\145\x73\163\x2e", "\155\151\156\151\x6f\162\x61\156\x67\x65\55\x73\x61\155\154\x2d\x32\60\55\163\151\x6e\147\x6c\x65\x2d\x73\x69\147\x6e\x2d\x6f\156") . "\74\x2f\142\x3e\x3c\57\144\x69\166\76\74\x64\151\166\40\x73\x74\171\x6c\x65\75\42\143\x6f\154\x6f\x72\72\40\43\x66\60\x30\x3b\x22\76" . __("\74\x62\162\x20\x2f\x3e\124\141\153\145\40\x61\x20\x6d\x69\x6e\x75\164\x65\40\164\x6f\40\143\150\145\143\153\x20\164\x68\x65\40\x63\x68\141\x6e\147\x65\154\157\x67\x20\x6f\146\40\154\x61\164\145\163\x74\x20\166\x65\x72\x73\x69\x6f\x6e\x20\x6f\146\x20\x74\x68\145\40\x70\154\x75\x67\x69\156\56\x20\110\145\x72\x65\x27\163\x20\167\x68\x79\40\x79\157\165\x20\x6e\145\x65\x64\40\x74\x6f\40\165\x70\x64\141\x74\145\72", "\155\151\x6e\x69\x6f\162\x61\156\x67\145\55\x73\141\155\154\x2d\x32\60\x2d\163\151\x6e\147\x6c\145\x2d\163\x69\147\156\55\157\156") . "\74\x2f\144\151\166\76";
        echo "\x3c\144\151\166\x20\163\164\171\154\x65\75\42\146\x6f\x6e\164\55\x77\x65\151\x67\150\164\72\40\156\x6f\162\x6d\141\x6c\x3b\42\x3e" . $qC . "\x3c\x2f\144\151\166\x3e\x3c\x62\76\x4e\x6f\x74\x65\72\74\x2f\142\x3e\x20\x50\154\x65\141\x73\145\x20\x63\x6c\x69\143\153\40\x6f\156\40\x3c\x62\76\x56\x69\x65\x77\40\x56\145\x72\163\x69\157\156\x20\x64\145\164\x61\151\x6c\163\74\57\x62\76\x20\x6c\151\156\x6b\x20\x74\157\40\x67\145\x74\40\143\157\155\x70\x6c\145\164\145\x20\143\150\x61\156\x67\x65\154\157\x67\x20\x61\156\144\x20\154\x69\x63\x65\156\163\145\40\x69\x6e\x66\x6f\x72\155\x61\x74\151\157\x6e\56\40\103\x6c\151\143\x6b\x20\x6f\x6e\x20\x3c\x62\x3e\125\160\144\141\164\145\40\x4e\x6f\x77\74\57\x62\x3e\40\x6c\x69\x6e\x6b\x20\164\157\40\165\x70\x64\x61\x74\145\x20\x74\x68\145\40\x70\x6c\x75\147\x69\156\x20\164\157\40\x6c\141\164\145\x73\164\40\x76\x65\162\163\x69\x6f\156\x2e";
        YI:
    }
    public function mo_saml_license_key_notice()
    {
        if (!array_key_exists("\155\157\163\x61\155\154\x2d\x64\x69\163\155\x69\163\163", $_GET)) {
            goto jM;
        }
        return;
        jM:
        $user = wp_get_current_user();
        $tV = $user->roles;
        $kO = 0;
        if (empty(get_option("\x6d\157\137\x73\x61\155\154\137\154\151\x63\x65\156\x73\x65\137\x65\x78\160\151\162\171\137\144\x61\x74\145"))) {
            goto nv;
        }
        $kO = date_diff(new DateTime(), new DateTime(get_option("\x6d\x6f\137\x73\x61\155\154\137\x6c\151\143\x65\156\x73\145\x5f\x65\x78\160\151\162\171\137\144\x61\x74\145")))->days;
        nv:
        if (!(!in_array("\x61\x64\x6d\151\x6e\151\163\x74\x72\141\x74\x6f\x72", $tV) && $kO <= 30)) {
            goto EI;
        }
        return;
        EI:
        if (!(get_option("\155\157\137\163\x61\155\x6c\137\163\x6c\x65") && new DateTime() > get_option("\x6d\x6f\55\163\x61\155\154\55\x70\154\165\147\151\x6e\x2d\164\x69\155\145\x72"))) {
            goto pY;
        }
        $H4 = esc_url(add_query_arg(array("\x6d\x6f\x73\x61\155\x6c\x2d\144\x69\x73\x6d\151\x73\x73" => wp_create_nonce("\163\x61\x6d\154\55\x64\x69\163\155\151\x73\163"))));
        echo "\74\163\143\x72\151\x70\164\x3e\15\xa\x9\x9\11\x9\x66\x75\156\143\x74\x69\157\x6e\40\155\157\123\x41\115\x4c\x50\141\171\155\145\x6e\x74\123\x74\145\160\x73\x28\51\x20\173\xd\xa\x9\x9\11\11\11\x76\x61\x72\x20\141\x74\164\x72\40\75\40\x64\157\x63\165\x6d\145\x6e\x74\56\x67\x65\164\105\154\145\x6d\x65\x6e\x74\x42\171\111\x64\x28\x22\155\157\x73\x61\155\154\160\x61\x79\x6d\x65\156\x74\x73\164\x65\x70\163\42\x29\56\163\164\171\154\x65\x2e\144\151\x73\160\154\141\171\73\xd\xa\x9\x9\x9\x9\x9\x69\x66\50\x61\x74\164\162\40\75\75\x20\x22\156\x6f\x6e\145\x22\51\173\15\12\11\11\x9\11\x9\11\144\x6f\143\165\155\x65\156\x74\x2e\147\x65\x74\x45\154\145\x6d\x65\156\x74\x42\171\111\x64\50\42\x6d\157\x73\x61\x6d\154\x70\141\x79\155\145\156\x74\x73\x74\145\160\x73\42\x29\56\x73\x74\171\x6c\x65\56\144\151\x73\160\154\141\171\x20\75\40\x22\142\x6c\157\x63\153\42\73\xd\xa\11\x9\11\11\11\x7d\145\154\163\x65\x7b\15\12\x9\11\11\x9\x9\x9\144\157\x63\165\155\x65\x6e\164\56\147\x65\x74\x45\154\145\x6d\x65\x6e\x74\102\x79\x49\x64\50\42\x6d\x6f\163\141\x6d\x6c\160\141\x79\155\145\x6e\164\x73\x74\x65\160\x73\x22\x29\x2e\x73\x74\171\x6c\x65\56\144\151\163\160\x6c\x61\x79\x20\x3d\40\x22\x6e\157\156\145\x22\x3b\15\12\11\11\11\11\x9\x7d\xd\xa\x9\x9\x9\x9\x7d\xd\xa\11\11\x9\x3c\x2f\163\x63\x72\x69\160\164\76";
        $NV = get_option("\x6d\157\137\162\145\156\x65\167\141\x6c\x5f\x61\144\x6d\x69\x6e\x5f\156\157\164\151\143\x65");
        if (empty($NV)) {
            goto tI;
        }
        $zA = "\x3c\x64\x69\x76\x20\151\x64\75\x22\x6d\x65\163\163\x61\147\x65\42\x20\x73\x74\x79\x6c\145\x3d\42\160\x6f\x73\151\164\x69\157\x6e\72\162\x65\x6c\141\x74\x69\x76\145\42\40\x63\154\x61\163\x73\x3d\x22\x6e\x6f\164\151\143\145\x20\x6e\157\x74\x69\x63\x65\40\x6e\157\164\151\x63\145\x2d\x77\x61\x72\x6e\151\x6e\x67\x22\x3e\74\x62\x72\x20\57\76\x3c\163\160\x61\156\x20\143\x6c\141\x73\x73\75\x22\x61\x6c\151\147\x6e\154\145\x66\164\x22\40\163\x74\171\x6c\145\x3d\42\143\157\x6c\x6f\x72\72\x23\141\60\x30\x3b\146\x6f\x6e\x74\55\x66\x61\x6d\x69\154\x79\x3a\40\55\x77\145\142\153\x69\164\x2d\x70\151\143\x74\x6f\147\162\141\160\150\x3b\x66\x6f\x6e\x74\55\163\x69\172\145\x3a\40\x32\65\160\170\x3b\42\x3e\111\115\120\x4f\x52\124\x41\116\124\41\74\57\x73\160\141\x6e\76\x3c\142\x72\40\57\x3e\x3c\151\x6d\x67\40\163\162\x63\x3d\x22" . plugin_dir_url(__FILE__) . "\151\155\141\x67\145\x73\x2f\x6d\151\x6e\151\x6f\x72\x61\156\147\x65\x2d\154\157\x67\157\56\x70\156\147" . "\x22\x20\x63\154\x61\163\163\x3d\x22\141\154\151\x67\x6e\154\145\x66\164\42\40\x68\x65\x69\x67\x68\x74\x3d\x22\70\x37\x22\x20\x77\x69\144\164\x68\x3d\x22\x36\66\42\x20\x61\154\164\75\42\155\x69\156\151\117\x72\x61\x6e\x67\x65\40\154\157\147\157\42\40\x73\164\171\154\x65\75\x22\x6d\141\x72\147\151\156\x3a\x31\60\x70\170\40\61\x30\x70\170\40\61\x30\x70\x78\x20\60\73\40\150\145\x69\x67\150\x74\x3a\61\62\70\x70\x78\73\x20\x77\151\x64\164\150\x3a\40\61\x32\x38\160\170\x3b\42\76\74\150\x33\x3e\x6d\151\156\x69\117\162\141\156\x67\x65\40\x53\x41\115\114\x20\x32\56\x30\x20\123\x69\x6e\x67\x6c\145\x20\123\x69\x67\156\x2d\x4f\x6e\x20\x53\165\x70\160\x6f\x72\x74\40\x26\x20\115\141\x69\x6e\x74\x65\x6e\141\156\x63\145\40\x4c\151\143\145\x6e\163\x65\40\105\x78\160\151\x72\x65\144\x3c\57\x68\x33\76";
        $zA .= $NV;
        $zA .= "\x3c\x61\40\150\x72\x65\x66\75\42" . $H4 . "\42\x20\143\154\x61\163\163\75\42\x61\x6c\151\x67\x6e\162\151\147\150\164\x20\142\165\164\x74\x6f\x6e\x20\x62\x75\x74\164\157\x6e\55\154\x69\156\153\x22\x3e\104\x69\163\155\151\x73\163\x3c\57\x61\x3e\x3c\x2f\x70\x3e\74\144\x69\166\40\143\154\x61\x73\x73\x3d\x22\143\x6c\x65\x61\162\x22\76\74\57\144\x69\166\x3e\74\57\x64\x69\x76\76";
        echo $zA;
        tI:
        pY:
    }
    public function mo_saml_dismiss_notice()
    {
        if (!empty($_GET["\x6d\x6f\x73\141\155\x6c\55\144\151\x73\155\x69\x73\163"])) {
            goto hS;
        }
        return;
        hS:
        if (wp_verify_nonce($_GET["\155\x6f\x73\141\155\x6c\55\x64\x69\x73\x6d\x69\x73\x73"], "\163\141\155\154\55\x64\151\x73\155\151\163\x73")) {
            goto pb;
        }
        return;
        pb:
        if (!(isset($_GET["\x6d\x6f\x73\x61\x6d\x6c\x2d\144\151\163\x6d\151\163\x73"]) && wp_verify_nonce($_GET["\155\x6f\x73\141\155\154\x2d\x64\151\x73\155\151\x73\x73"], "\x73\x61\155\154\x2d\144\x69\x73\155\x69\x73\163"))) {
            goto nw;
        }
        $XB = new DateTime();
        $XB->modify("\x2b\x31\40\x64\x61\x79");
        update_option("\155\157\55\163\x61\x6d\154\x2d\x70\x6c\x75\147\151\x6e\x2d\164\x69\x6d\x65\162", $XB);
        nw:
    }
    function mo_saml_create_backup_dir()
    {
        $s5 = plugin_dir_path(__FILE__);
        $s5 = rtrim($s5, "\57");
        $s5 = rtrim($s5, "\x5c");
        $hN = get_plugin_data(__FILE__);
        $kF = $hN["\124\x65\170\x74\x44\x6f\155\141\x69\156"];
        $UW = wp_upload_dir();
        $t0 = $UW["\x62\x61\163\x65\x64\x69\162"];
        $UW = rtrim($t0, "\57");
        $JH = $UW . DIRECTORY_SEPARATOR . "\x62\141\143\153\x75\x70" . DIRECTORY_SEPARATOR . $kF . "\x2d\160\162\145\x6d\x69\165\155\55\142\141\x63\x6b\165\160\x2d" . $this->current_version;
        if (file_exists($JH)) {
            goto aj;
        }
        mkdir($JH, 0777, true);
        aj:
        $mv = $s5;
        $GH = $JH;
        $this->mo_saml_copy_files_to_backup_dir($mv, $GH);
    }
    function mo_saml_copy_files_to_backup_dir($s5, $JH)
    {
        if (!is_dir($s5)) {
            goto rK;
        }
        $oF = scandir($s5);
        rK:
        if (!empty($oF)) {
            goto pj;
        }
        return;
        pj:
        foreach ($oF as $fY) {
            if (!($fY == "\x2e" || $fY == "\56\x2e")) {
                goto xv;
            }
            goto cJ;
            xv:
            $QR = $s5 . DIRECTORY_SEPARATOR . $fY;
            $nc = $JH . DIRECTORY_SEPARATOR . $fY;
            if (is_dir($QR)) {
                goto cV;
            }
            copy($QR, $nc);
            goto an;
            cV:
            if (file_exists($nc)) {
                goto lL;
            }
            mkdir($nc, 0777, true);
            lL:
            $this->mo_saml_copy_files_to_backup_dir($QR, $nc);
            an:
            cJ:
        }
        l1:
    }
}
function mo_saml_update()
{
    if (!mo_saml_is_customer_registered()) {
        goto Bq;
    }
    $sf = mo_options_plugin_constants::HOSTNAME;
    $DY = mo_options_plugin_constants::Version;
    $QQ = $sf . "\57\x6d\x6f\141\x73\57\141\160\151\57\160\154\x75\147\x69\x6e\x2f\155\145\164\x61\144\x61\x74\141";
    $mi = plugin_basename(dirname(__FILE__) . "\x2f\x6c\x6f\x67\151\156\56\160\150\x70");
    $TA = new mo_saml_update_framework($DY, $QQ, $mi);
    add_action("\x69\156\x5f\x70\x6c\x75\147\x69\x6e\137\x75\x70\x64\141\164\x65\x5f\x6d\x65\163\x73\141\x67\145\x2d{$mi}", array($TA, "\155\157\137\x73\x61\155\x6c\137\x70\154\x75\x67\151\x6e\x5f\x75\160\144\x61\164\x65\x5f\x6d\145\163\163\x61\x67\x65"), 10, 2);
    add_action("\x61\x64\x6d\x69\x6e\x5f\x68\145\x61\144", array($TA, "\155\157\x5f\x73\x61\155\154\x5f\x6c\151\x63\145\156\163\145\x5f\153\145\171\137\156\157\164\151\x63\x65"));
    add_action("\141\144\x6d\151\156\x5f\156\157\x74\151\x63\x65\x73", array($TA, "\155\157\137\163\141\x6d\x6c\x5f\x64\151\x73\155\151\163\163\x5f\x6e\x6f\x74\x69\143\145"), 50);
    if (!get_option("\155\157\137\x73\141\x6d\154\137\x73\x6c\145")) {
        goto hC;
    }
    update_option("\155\157\137\163\x61\x6d\x6c\x5f\x73\x6c\145\137\155\x65\163\163\141\147\145", "\131\x6f\x75\162\x20\123\101\x4d\114\40\160\154\x75\x67\151\156\40\154\x69\143\x65\x6e\163\x65\40\x68\x61\x73\x65\x20\142\x65\145\x6e\x20\145\170\160\x69\x72\145\144\x2e\40\x59\x6f\x75\x20\141\162\145\40\155\x69\x73\x73\x69\156\x67\40\157\x75\x74\40\x6f\156\40\165\x70\144\141\164\x65\x73\40\x61\x6e\x64\40\163\x75\x70\160\x6f\x72\164\x21\40\120\154\145\141\x73\x65\40\74\x61\40\150\162\x65\146\x3d\42" . mo_options_plugin_constants::HOSTNAME . "\57\x6d\x6f\x61\x73\x2f\x6c\x6f\x67\x69\x6e\77\x72\145\144\151\162\145\143\164\x55\162\154\75" . mo_options_plugin_constants::HOSTNAME . "\57\x6d\x6f\x61\x73\x2f\141\x64\155\x69\x6e\x2f\143\x75\x73\164\157\155\x65\x72\57\154\151\x63\x65\x6e\163\145\x72\145\156\x65\x77\x61\154\163\x3f\x72\145\156\145\x77\x61\x6c\162\145\x71\165\145\x73\x74\x3d" . mo_options_plugin_constants::LICENSE_TYPE . "\40\x22\40\164\141\x72\147\x65\x74\x3d\x22\137\x62\154\x61\x6e\153\42\x3e\74\142\76\x43\x6c\151\143\153\40\110\x65\x72\145\74\57\142\x3e\x3c\57\x61\x3e\40\164\157\x20\162\x65\x6e\x65\167\40\164\x68\x65\x20\x53\x75\x70\160\x6f\162\x74\x20\141\156\144\40\115\x61\151\156\164\145\156\141\143\x65\x20\160\x6c\141\x6e\56");
    hC:
    Bq:
}
