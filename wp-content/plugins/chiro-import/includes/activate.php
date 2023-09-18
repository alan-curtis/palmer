<?php

function chiro_activate_plugin() {
    
    global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
$table_name = $wpdb->prefix . 'tmp_chiro_response';
$sql = "CREATE TABLE `$table_name` (
`PeopleID` varchar(255) NOT NULL,
`APIResponse` LONGTEXT NOT NULL,
`status` int(11) DEFAULT '0',
PRIMARY KEY(PeopleID)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";

if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
  dbDelta($sql);
}


$map_table_name = $wpdb->prefix . 'tmp_chiro_map';
$mapsql = "CREATE TABLE `$map_table_name` 
( `PeopleID` VARCHAR(255) NOT NULL ,
 `postID` VARCHAR(255) NOT NULL ,
 `marker_status` INT NOT NULL DEFAULT '0',
  PRIMARY KEY (`PeopleID`(255))) ENGINE = InnoDB;
";

if ($wpdb->get_var("SHOW TABLES LIKE '$map_table_name'") != $map_table_name) {
  dbDelta($mapsql);
}

$address_lat_lang = $wpdb->prefix . 'address_lat_lang';
$adr_sql = "CREATE TABLE `$address_lat_lang` ( 
    `id` INT(100) NOT NULL AUTO_INCREMENT ,
    `Address` VARCHAR(300) NOT NULL , 
    `lat` VARCHAR(100) NOT NULL , 
    `lang` VARCHAR(100) NOT NULL ,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;
";
if ($wpdb->get_var("SHOW TABLES LIKE '$address_lat_lang'") != $address_lat_lang) {
    dbDelta($adr_sql);
}

$chiro_configuration = $wpdb->prefix . 'chiro_configuration';
$chiro_configuration_sql = "CREATE TABLE `$chiro_configuration` ( 
    `id` INT(100) NOT NULL AUTO_INCREMENT ,
    `map_key` VARCHAR(200) NOT NULL ,
    `chunks` VARCHAR(30) NOT NULL,
    `map_id` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;
";
if ($wpdb->get_var("SHOW TABLES LIKE '$chiro_configuration'") != $chiro_configuration) {
    dbDelta($chiro_configuration_sql);
}  
    
$import_usa_states = $wpdb->prefix . 'chiro_usa_states';
$import_usa_states_sql = "CREATE TABLE `$import_usa_states` 
( `id` INT NOT NULL AUTO_INCREMENT,
`state_code` VARCHAR(20) NOT NULL ,
 `status` INT NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)) ENGINE = InnoDB;
";
if ($wpdb->get_var("SHOW TABLES LIKE '$import_usa_states'") != $import_usa_states) {
    dbDelta($import_usa_states_sql);
}  

}

function chiro_deactivate_plugin() {
    
    global $wpdb;

    $wpdb->query( "DROP TABLE IF EXISTS `".$wpdb->prefix."tmp_chiro_response`" );
     $wpdb->query( "DROP TABLE IF EXISTS `".$wpdb->prefix."tmp_chiro_map`" );
     $wpdb->query( "DROP TABLE IF EXISTS `".$wpdb->prefix."address_lat_lang`" );
     $wpdb->query( "DROP TABLE IF EXISTS `".$wpdb->prefix."chiro_configuration`" );
     $wpdb->query( "DROP TABLE IF EXISTS `".$wpdb->prefix."chiro_usa_states`" );
    
}


function settings_page() {
    
    add_menu_page(
        'Chiropractors Feed',
        'Chiropractors Feed',
        'manage_options',
        'configuration_screen',
        'import_page_chiropractor',
        'dashicons-wordpress-alt',
        100
    );


}
add_action( 'admin_menu', 'settings_page' );


function import_page_chiropractor() {
    
    global $wpdb;

    echo "<h2 class='heading'>Configuration Panel</h2>";
    echo "<div class='configuration'>";
    echo "<div class='actions_wrapper'>";
    echo "<form method='post'>";

    $configuration 	     =   $wpdb->prefix."chiro_configuration";
    $result 	         =   $wpdb->get_results( "SELECT `map_key`,`chunks`,`map_id` FROM $configuration LIMIT 1" ,ARRAY_A );
    if( !empty($result) ) {
        echo "<div class='row'>";
        echo "<label>Map Geocoding Api Key: </label>";
        echo "<input class='input' type='text' required name='map_key' value='".$result[0]['map_key']."'>";
        echo "</div><br><br>";
        echo "<div class='row'>";
        echo "<label>Request Chunks: </label>";
        echo "<input class='input' type='text' required name='chunks' value='".$result[0]['chunks']."'>";
        echo "</div><br><br>";
        echo "<div class='row'>";
        echo "<label>Map ID: </label>";
        echo "<input class='input' type='text' required name='map_id' value='".$result[0]['map_id']."'>";
        echo "</div><br><br>";
    } else {
        echo "<div class='row'>";
        echo "<label>Map Geocoding Api Key: </label>";
        echo "<input class='input' type='text' required name='map_key'>";
        echo "</div><br><br>";
        echo "<div class='row'>";
        echo "<label>Request Chunks: </label>";
        echo "<input class='input' type='text' required name='chunks'>";
        echo "</div><br><br>";
        echo "<div class='row'>";
        echo "<label>Map ID: </label>";
        echo "<input class='input' type='text' required name='map_id'>";
        echo "</div><br><br>"; 
    }
    
    echo "<div class='row'>";
    echo "<input type='submit' name='save_values' value='save' class='button-primary'>";
    echo "</div>";
    echo "</form>";  
    echo "</div>";  
    
    echo "<style>label {width: 25%;display: inline-block;font-weight: bold;font-size: 16px;}</style>";
    echo "<style>.btn.btn-primary {padding: 5px 20px;font-size: 20px;font-weight: 700;text-transform: uppercase;margin-top: 20px;margin-bottom: 40px;cursor: pointer;}.actions_wrapper {background: #fff;padding: 20px;margin: 20px 0;}.heading{text-transform:uppercase;margin-top:0;}.red{background:#d31818 !important;}input[name='save_values'] {text-transform: uppercase;}</style>";
    

    /* DB Data */
    if( isset($_POST["save_values"]) ) {
        
        global $wpdb;
        $tablename              =   $wpdb->prefix . "chiro_configuration";
        $mapkey                 =   $_POST["map_key"];
        $chunks                 =   $_POST["chunks"];
        $map_id                 =   $_POST["map_id"];

        $dbdata 	            =   $wpdb->get_results( "SELECT `map_key` FROM $tablename  WHERE `ID` = 1" ,ARRAY_A );

        if( !empty($dbdata) ) {
            $sql = $wpdb->prepare( "UPDATE $tablename SET map_key = %s , chunks = %s, map_id = %s WHERE ID = %d", "$mapkey","$chunks","$map_id", 1 );
        } else {
            $sql = $wpdb->prepare("INSERT INTO `$tablename` (`map_key`, `chunks`, `map_id`) values (%s, %s, %s)", $mapkey, $chunks,$map_id );
        }

        $wpdb->query($sql);

        
        echo "<script type='text/javascript'>
        window.location=document.location.href;
        </script>";

    }


        $usaChiropractor = add_query_arg( [
            'action'       => 'import_chiropractors_in_usa',
            'security'  => 'cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=='
        ], admin_url( 'admin-ajax.php' ) );
        echo "<div class='actions_wrapper'>";
        echo '<h2 class="heading">OPERATIONS</h2>';
        echo "<div class='configuration'>";
        echo '<p>STEP 1 : Used to fetch chiropractors of US from Palmer API to local database.</p>';
        echo "<a class='button-primary' href='".$usaChiropractor."'>Fetch Chiropractors Feed for US.</a>";
        echo "</div>";


        $countriesChiropractor = add_query_arg( [
            'action'       => 'import_chiropractors_outside_usa',
            'security'  => 'cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=='
        ], admin_url( 'admin-ajax.php' ) );
        echo "<div class='configuration'>";
        echo '<p>STEP 2 : Used to fetch chiropractors of Other countries from Palmer API to local database.</p>';
        echo "<a class='button-primary' href='".$countriesChiropractor."'>Fetch Chiropractors Feed for other countries.</a>";
        echo "</div>";

        $importChiropractorToPosts = add_query_arg( [
            'action'       => 'import_chiropractors_to_post',
            'security'  => 'cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=='
        ], admin_url( 'admin-ajax.php' ) );
        echo "<div class='configuration'>";
        echo '<p>STEP 3 : Used to create WP chiropractor posts from feed fetched in Step 1 and Step 2.</p>';
        echo "<a class='button-primary' href='".$importChiropractorToPosts."'>Create WP POST for Feeds.</a>";
        echo "</div>";


        $markerChiropractor = add_query_arg( [
            'action'        => 'create_marker',
            'security'      => 'cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=='
        ], admin_url( 'admin-ajax.php' ) );
        echo "<div class='configuration'>";
        echo '<p>STEP 4 : Used to create Markers from WP posts.</p>';
        echo "<a class='button-primary' href='".$markerChiropractor."'>Create Map Pins.</a>";
        echo "</div>";
        echo "</div>";

        // Encoded String cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ==  DEcode String palmerchiropractordata //
        $deleteChiropractor = add_query_arg( [
            'action'        => 'delete_chiropractors',
            'security'      => 'cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=='
        ], admin_url( 'admin-ajax.php' ) );
        echo "<div class='actions_wrapper'>";
        echo '<h2 class="heading">OTHER OPERATIONS</h2>';
        echo "<div class='configuration'>";
        echo '<p>Used to Delete all WP chiropractor posts.</p>';
        echo "<a class='button-primary red' href='".$deleteChiropractor."'>Delete All WP Chiropractors Posts.</a>";
        echo "</div>"; 

        $truncate = add_query_arg( [
            'action'       => 'truncateResponse',
            'security'      => 'cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=='
        ], admin_url( 'admin-ajax.php' ) );
        echo "<div class='configuration'>";
        echo '<p>Used to Delete all chiropractors fetched in local database during Step 1 and Step 2.</p>';
        echo "<a class='button-primary red' href='".$truncate."'>Clear Feed table.</a>";
        echo "</div>";

        $import_usa_states = add_query_arg( [
            'action'       => 'import_states_usa',
            'security'      => 'cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=='
        ], admin_url( 'admin-ajax.php' ) );
        echo "<div class='configuration'>";
        echo '<p>Used to Import USA States.</p>';
        echo "<a class='button-primary red' href='".$import_usa_states."'>Import USA States.</a>";
        echo "</div>";
        echo "</div>";

}

add_action('wp_ajax_import_chiropractors_in_usa','import_chiropractors_in_usa');
add_action('wp_ajax_nopriv_import_chiropractors_in_usa','import_chiropractors_in_usa');
add_action('wp_ajax_import_chiropractors_outside_usa','import_chiropractors_outside_usa');
add_action('wp_ajax_nopriv_import_chiropractors_outside_usa','import_chiropractors_outside_usa');
add_action('wp_ajax_import_chiropractors_to_post','import_chiropractors_to_post');
add_action('wp_ajax_nopriv_import_chiropractors_to_post','import_chiropractors_to_post');
add_action('wp_ajax_nopriv_delete_chiropractors','delete_chiropractors');
add_action('wp_ajax_delete_chiropractors','delete_chiropractors');
add_action('wp_ajax_nopriv_truncateResponse','truncateResponse');
add_action('wp_ajax_truncateResponse','truncateResponse');
add_action('wp_ajax_create_marker','create_marker');
add_action('wp_ajax_nopriv_create_marker','create_marker');
add_action('wp_ajax_import_states_usa','import_states_usa');
add_action('wp_ajax_nopriv_import_states_usa','import_states_usa');


