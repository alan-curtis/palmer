<?php

function truncateResponse() {
    if ($_GET["security"] == "cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=") {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tmp_chiro_response';
        $import_usa_states = $wpdb->prefix . 'chiro_usa_states';
        $wpdb->query("TRUNCATE TABLE $table_name");
        $wpdb->query("UPDATE $import_usa_states SET `status` = 0");
    }
    die;
}

function import_states_usa() {
    if ($_GET["security"] == "cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=") {
        /***************************** GET ALL STATES INSIDE USA ******************/
        global $wpdb;
        $import_usa_states = $wpdb->prefix . 'chiro_usa_states';

        $wpdb->query("TRUNCATE TABLE $import_usa_states");

        $url = "https://apichiropractic.azurewebsites.net/findachiro/vr1/usstates/";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('ApiKey: PMAK-61804081ca1aba003fe346fd-fef4917c01919caad510c988b82ec49626'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);
        $states = json_decode($resp); //STATES

        foreach ($states as $state) {
            if( !empty($state) ) {
                $sql = $wpdb->prepare("INSERT INTO `$import_usa_states` (
                    `state_code`)
                    values (%s)", "$state");
                $wpdb->query($sql);
            }
        }
    }
    die;
}

function import_chiropractors_in_usa() {
    if ($_GET["security"] == "cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=") {
        /***************************** GET ALL STATES INSIDE USA ******************/
        global $wpdb;
        $table_name = $wpdb->prefix . 'tmp_chiro_response';
        $import_usa_states = $wpdb->prefix . 'chiro_usa_states';

        $state_result = $wpdb->get_results("SELECT * FROM `$import_usa_states` WHERE status='0' LIMIT 2", ARRAY_A);

        if( !empty($state_result)) {
            foreach ($state_result as $state) {
                $state_code = $state["state_code"];
                $id  = $state["id"];
                if(!empty($state_code)) {
        
                    $url = "https://apichiropractic.azurewebsites.net/findachiro/vr1/state/" . strtolower($state_code) . ""; //state url
    
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array('ApiKey: PMAK-61804081ca1aba003fe346fd-fef4917c01919caad510c988b82ec49626'));
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
                    $resp = curl_exec($curl);
                    curl_close($curl);
                    $states_data = json_decode($resp, true);
    
                    foreach ($states_data as $key => $data) {  // chiropractor data per state
    
                        $peopleID = $data['peoplE_ORG_CODE_ID'];
                        $apiResult = serialize($data);
    
                        $sql = $wpdb->prepare("INSERT INTO `$table_name` (
                            `PeopleID`,`APIResponse`)
                            values (%s,%s)", "$peopleID", "$apiResult");
                        $wpdb->query($sql);
                    } // chiropractor data loop
                    $wpdb->query("UPDATE $import_usa_states SET `status` = 1 WHERE `id`= '$id' ");
                    
                }else{
                    $wpdb->query("UPDATE $import_usa_states SET `status` = 1 WHERE `id`= '$id' ");
                }
            }
        }else{
            echo "All USA Response Added";
        }
        die;
    }
}

function import_chiropractors_outside_usa() {
    if ($_GET["security"] == "cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=") {
        /***************************** GET ALL COUNTRIES ******************/ global $wpdb;
        $table_name = $wpdb->prefix . 'tmp_chiro_response';

        $url = "https://apichiropractic.azurewebsites.net/findachiro/vr1/countries/";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('ApiKey: PMAK-61804081ca1aba003fe346fd-fef4917c01919caad510c988b82ec49626'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);
        $states = json_decode($resp); //STATES

        foreach ($states as $state) { //STATES loop

            if (!empty($state)) {
                // echo $state.'<br>';

                $url = "https://apichiropractic.azurewebsites.net/findachiro/vr1/country/" . strtolower($state) . ""; //state url

                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('ApiKey: PMAK-61804081ca1aba003fe346fd-fef4917c01919caad510c988b82ec49626'));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

                $resp = curl_exec($curl);
                curl_close($curl);
                $states_data = json_decode($resp, true);

                foreach ($states_data as $key => $data) {  // chiropractor data per state

                    $peopleID = $data['peoplE_ORG_CODE_ID'];
                    $apiResult = serialize($data);

                    $sql = $wpdb->prepare("INSERT INTO `$table_name` (
                       `PeopleID`,`APIResponse`)
                       values (%s,%s)", "$peopleID", "$apiResult");
                    $wpdb->query($sql);
                } // chiropractor data loop

            }  // if state has data

        } // states loop

    }
    // echo 'we r in chiro function';
    //create_woo_product();
    die;
}

/* Checking Category If Exists then Return Id Else Create A New Ctegory */
function chiro_category( $category_name ) {
	$cat = get_term_by( 'name',$category_name,'chiro_techniques' );
	$catid = '';

	if( !empty($cat->term_id) ){
		$catid = $cat->term_id;
	}else{
		$catgory_arr = wp_insert_term(
			"$Category",  // the term 
			'chiro_techniques' // the taxonomy
		);
		$catid = $catgory_arr["term_id"];
	}
	return $catid;
}

function import_chiropractors_to_post() {
    if ($_GET["security"] == "cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=") {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tmp_chiro_response';
        $map_table_name = $wpdb->prefix . 'tmp_chiro_map';

        $chiros_data = $wpdb->get_results("SELECT * FROM `$table_name` WHERE status='0' LIMIT 150");
        //print_r($chiros_data);
        foreach ($chiros_data as $key => $value) {
            $data = unserialize($value->APIResponse);
            $peopleID = $data['peoplE_ORG_CODE_ID'];
            $techniques_array = array();

            if (!empty($data["technique"])) {
                $techniques_array['chiro_techniques'] = explode(';', $data["technique"]);
            }

            $msql = "SELECT * FROM `$map_table_name` WHERE `PeopleID` = '$peopleID'";
            $mresult = $wpdb->get_results($msql, ARRAY_A);

            if (!empty($mresult)) {
                $postID = $mresult[0]["postID"];

                $chiropracter_data = array('ID' => $postID, 'post_title' => $data['name'], 'post_status' => 'publish', 'post_type' => 'chiropractor',

                    'meta_input' => array('people_org_code_id' => $data['peoplE_ORG_CODE_ID'], 'first_name' => $data['firsT_NAME'], 'last_name' => $data['lasT_NAME'], 'phone' => $data['phonE_NUMBER'], 'address_line_1' => $data['addR_LINE_1'], 'address_line_2' => $data['addR_LINE_2'], 'address_line_3' => $data['addR_LINE_3'], 'city' => $data['city'], 'state_abbreviation' => $data['state'], 'state' => $data['statE_DESC'], 'zip_code' => $data['ziP_CODE'], 'country' => $data['country'], 'web_address' => $data['weB_ADDRESS'],),

                    'tax_input' => $techniques_array,

                );

                echo $chiropracter_post_id = wp_update_post($chiropracter_data);

                $catIDS = [];
                foreach ( $techniques_array['chiro_techniques'] as $key => $val ) {
                    $cat_id = chiro_category($val);
                    $catIDS[] = $cat_id;
                }
                wp_set_object_terms( $chiropracter_post_id, $catIDS, 'chiro_techniques' );

                $wpdb->query("UPDATE `$map_table_name` SET `marker_status` = 0 WHERE `PeopleID` = '$peopleID'");
            }
            else {
                $chiropracter_data = array('post_title' => $data['name'], 'post_status' => 'publish', 'post_type' => 'chiropractor',

                    'meta_input' => array('people_org_code_id' => $data['peoplE_ORG_CODE_ID'], 'first_name' => $data['firsT_NAME'], 'last_name' => $data['lasT_NAME'], 'phone' => $data['phonE_NUMBER'], 'address_line_1' => $data['addR_LINE_1'], 'address_line_2' => $data['addR_LINE_2'], 'address_line_3' => $data['addR_LINE_3'], 'city' => $data['city'], 'state_abbreviation' => $data['state'], 'state' => $data['statE_DESC'], 'zip_code' => $data['ziP_CODE'], 'country' => $data['country'], 'web_address' => $data['weB_ADDRESS'],),

                    'tax_input' => $techniques_array,

                );

                echo $chiropracter_post_id = wp_insert_post($chiropracter_data);

                $catIDS = [];
                foreach ( $techniques_array['chiro_techniques'] as $key => $val ) {
                    $cat_id = chiro_category($val);
                    $catIDS[] = $cat_id;
                }
                wp_set_object_terms( $chiropracter_post_id, $catIDS, 'chiro_techniques' );

                if ($chiropracter_post_id != 0) {
                    $sql = $wpdb->prepare("INSERT INTO `$map_table_name` (
                                    `PeopleID`,`postID`)
                                    values (%s,%s)", "$peopleID", "$chiropracter_post_id");
                    $wpdb->query($sql);
                }
            }

            $updatesql = $wpdb->prepare("UPDATE `$table_name` SET status='1' WHERE PeopleID='$peopleID'");
            $wpdb->query($updatesql);
        }
    }
    //echo '</pre>';
    die;
}

function delete_chiropractors() {
    if ($_GET["security"] == "cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=") {
        global $wpdb;
        $chiro_table = $wpdb->prefix . 'tmp_chiro_response';
        $chiro_map_table = $wpdb->prefix . 'tmp_chiro_map';
        $map_table_IDS = $wpdb->prefix . "wpgmza_maps";
        $livearray = [];
        $maparray = [];

        /* SQL Query */
        $sql = "SELECT `PeopleID` FROM `$chiro_table` ";
        $result = $wpdb->get_results($sql, ARRAY_A);

        $msql = "SELECT `PeopleID` FROM `$chiro_map_table` ";
        $mresult = $wpdb->get_results($msql, ARRAY_A);

        /* Array Creating */
        foreach ($result as $data) {
            $livearray[] = $data["PeopleID"];
        }

        foreach ($mresult as $mdata) {
            $maparray[] = $mdata["PeopleID"];
        }

        /* Difference */
        $differece = array_diff($maparray, $livearray);

        //$ids                =   "'" .implode("', ' ", $differece). "'";

        /* Delete Posts */
        foreach ($differece as $k => $v) {
            $psql = "SELECT `postID` FROM `$chiro_map_table` WHERE `PeopleID` = '$v' ";
            $presult = $wpdb->get_results($psql, ARRAY_A);
            $postID = $presult[0]["postID"];
            $delete = wp_delete_post($postID, true);
            $deletesql = "DELETE FROM `$chiro_map_table` WHERE `PeopleID` = '$v'";
            $wpdb->query($deletesql);
            $deletemapsql = "DELETE FROM `$map_table_IDS` WHERE `category` = '$v'";
            $wpdb->query($deletemapsql);
            echo "Post ID: " . $postID . " has been deleted successfully";
        }
    }

    die;
}

function create_marker() {
    if ($_GET["security"] == "cGFsbWVyY2hpcm9wcmFjdG9yZGF0YQ=") {
        global $wpdb;
        $marker_plugin_table = $wpdb->prefix . "wpgmza";
        $address_table = $wpdb->prefix . "address_lat_lang";
        $map_table_name = $wpdb->prefix . 'tmp_chiro_map';
        $configuration = $wpdb->prefix . "chiro_configuration";
        $map_table_IDS = $wpdb->prefix . "wpgmza_maps";

        /* Getting Configuration */
        $config_sql = $wpdb->get_results("SELECT * FROM `$configuration` ");

        $chunks = $config_sql[0]->chunks;
        $map_id = $config_sql[0]->map_id;
        $map_key = $config_sql[0]->map_key;

        $check_map_exists = $wpdb->get_results("SELECT * FROM `$map_table_IDS` WHERE `id` = $map_id ", ARRAY_A);

        if (empty($check_map_exists)) {
            echo "Map ID: " . $map_id . " does not exist.";
            die();
        }

        $check_sql = $wpdb->get_results("SELECT `postID` FROM `$map_table_name` WHERE `marker_status` = 0 LIMIT $chunks", ARRAY_A);

        if (!empty($check_sql)) {
            foreach ($check_sql as $key => $value) {
                echo $post_id = $value["postID"];
                $people_org_code_id = get_field("people_org_code_id", $post_id);
                $practice_name = '';
                if ($address_line_3 = get_field("address_line_3", $post_id)) {
                    $address_line_3 = get_field("address_line_3", $post_id);
                }
                $email = get_field("email", $post_id);
                $phone = get_field("phone", $post_id);
                $address_line_1 = get_field("address_line_1", $post_id);
                $address_line_2 = get_field("address_line_2", $post_id);
                $address_line_3 = get_field("address_line_3", $post_id);
                $city = get_field("city", $post_id);
                $state = get_field("state", $post_id);
                $state_abbreviation = get_field("state_abbreviation", $post_id);
                $zip_code = get_field("zip_code", $post_id);
                $country = get_field("country", $post_id);
                $web_address = get_field("web_address", $post_id);

                // outputs 'somedomain.co.uk'

                // address_line_1, address_line_2, address_line_3, city, state, zip_code, country => Address/GPS
                $full_address = $address_line_1 . '  ' . $address_line_2 . ', ' . $city . ' , ' . $state . ' , ' . $zip_code . ' , ' . $country;
                $full_address_formarkerui = $address_line_1 . '  ' . $address_line_2 . '  ' . $address_line_3 . '  ' . $city . ' , ' . $state . '  ' . $zip_code . ' , ' . $country;


                $address_listing_line_1 = $address_line_1 . ' ' . $address_line_2;

                $address_listing_line_2 = $city . ', ' . $state . '  ' . $zip_code . ', ' . $country;

                // Insert below data to marker
                $title = get_the_title($post_id);

                $description_html = "";

                $description_html .= "<div class='chiro-listing-main'><div class='practice-address'><div class='practice-name'>" . $address_line_3 . "</div><div class='address address-line-1'>" . $address_listing_line_1 . "</div>";
                $description_html .= "<div class='address address-line-2'>". $address_listing_line_2 . "</div></div>";

                $description_html .= "<div class='chiro-listing-more-info'>";
                $description_html .= "<div class='contact'>";
                if (!empty($email)) {
                    $description_html .= "<div class='email-address'><a href='mailto:" . $email . "'>" . $email . "</a></div>";
                }
                if (!empty($phone)) {
                    $description_html .= "<div class='phone-number'><a href='tel:" . $phone . "'>" . $phone . "</a></div>";
                }
                if (!empty($web_address)) {
                    $description_html .= "<div class='website'><a href='https://" . $web_address . "' target='_blank' rel='noopener'>" . get_domain($web_address) . "</a></div>";
                }
                $description_html .= "</div>";
                $description_html .= "</div>";
                $description_html .= "</div>";

                $techniques = get_the_terms($post_id, 'chiro_techniques');

                if ($techniques) {
                    $description_html .= "<div class='techniques'>
                    <div class='list-heading'>Techniques</div><ul>";

                    foreach ($techniques as $technique) {
                        $description_html .= "<li>" . $technique->name . "</li>";
                    }

                    $description_html .= "</ul></div>";
                }


                if (strpos($full_address, "'") !== FALSE) {
                    $sanitized_address_for_markers = str_replace('"', "'", $sanitized_address_for_markers);
                    $sanitized_address_for_markers = str_replace("'", "\'", $full_address); // Sanitized string for database

                }
                else {
                    $sanitized_address_for_markers = $full_address;
                }

                /* Address Key Without space for DB Compare */
                $address_key = strtolower(preg_replace('/\s+/', '', $sanitized_address_for_markers));
                
                /* Marker Validation */
                $result = $wpdb->get_results("SELECT `category` FROM `$marker_plugin_table` WHERE `category` = '$people_org_code_id'");
                if (empty($result)) {
                    $query = 'SELECT `lat`,`lang` FROM `' . $address_table . '` WHERE `Address` = "' . $address_key . '"';
                    $address_result = $wpdb->get_results($query);

                    if (!empty($address_result)) {
                        $lat = $address_result[0]->lat;
                        $long = $address_result[0]->lang;

                        $sql = 'INSERT INTO `' . $marker_plugin_table . '` (
                                            `map_id`, `address`, `description`,`pic`,
                                            `link`, `icon`, `lat`, `lng`, `anim`, `title`,
                                            `infoopen`, `category`, `latlng`, `approved`, `retina`,
                                            `type`, `did`, `sticky`, `other_data`)
                                            VALUES
                                            ("' . $map_id . '","' . $sanitized_address_for_markers . '","' . $description_html . '",
                                            "","","","' . $lat . '", "' . $long . '",0,"' . $title . '",
                                            0,"' . $people_org_code_id . '",POINT("' . $lat . '" ,"' . $long . '"),1,0,0,"",0,"")';

                        $insert = $wpdb->get_results($sql);

                        $wpdb->query($wpdb->prepare("UPDATE $map_table_name SET `marker_status` = 1 WHERE `postID`= '$post_id' "));
                    }
                    else {
                        $address = urlencode($sanitized_address_for_markers);
                        $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$map_key}";
                        $geocodeResponseData = file_get_contents($googleMapUrl);
                        $responseData = json_decode($geocodeResponseData, true);
                        if ($responseData['status'] == 'OK') {
                            $lat = $responseData['results'][0]['geometry']['location']['lat'];
                            $long = $responseData['results'][0]['geometry']['location']['lng'];

                            $isql = 'INSERT INTO `' . $address_table . '` ( `Address`,`lat`,`lang`)
                                                VALUES ("' . $address_key . '","' . $lat . '","' . $long . '")';
                            $i_insert = $wpdb->get_results($isql);

                            //$point = POINT($lat , $long);
                            $msql = 'INSERT INTO `' . $marker_plugin_table . '` (
                                                    `map_id`, `address`, `description`,`pic`,
                                                    `link`, `icon`, `lat`, `lng`, `anim`, `title`,
                                                    `infoopen`, `category`, `latlng`, `approved`, `retina`,
                                                    `type`, `did`, `sticky`, `other_data`)
                                                    VALUES
                                                    ("' . $map_id . '","' . $sanitized_address_for_markers . '","' . $description_html . '",
                                                    "","","","' . $lat . '", "' . $long . '",0,"' . $title . '",
                                                    0,"' . $people_org_code_id . '",POINT("' . $lat . '" ,"' . $long . '"),1,0,0,"",0,"")';

                            $minsert = $wpdb->get_results($msql);

                            $wpdb->query($wpdb->prepare("UPDATE $map_table_name SET `marker_status` = 1 WHERE `postID`= '$post_id' "));
                        } else if( $responseData['status'] == 'ZERO_RESULTS' ){
                            $wpdb->query($wpdb->prepare("UPDATE $map_table_name SET `marker_status` = 1 WHERE `postID`= '$post_id' "));        
                        } else {
                            echo "<pre>";
                            print_r($responseData);
                            echo "</pre>";
                            echo "Failed ID: " . $people_org_code_id;
                            echo "<br>";
                        }
                    }
                }
                else {
                    echo "In update condition";
                    
                    $query = 'SELECT `lat`,`lang` FROM `' . $address_table . '` WHERE `Address` = "' . $address_key . '"';
                    $address_result = $wpdb->get_results($query);

                    $description_html = str_replace("'", "\'", $description_html);

                    if (!empty($address_result)) {
                        $lat = $address_result[0]->lat;
                        $long = $address_result[0]->lang;

                        $sql = "UPDATE $marker_plugin_table SET `address` = '$sanitized_address_for_markers',
                                `description` = '$description_html',
                                `lat` = '$lat',
                                `lng` = '$long',
                                `title` = '$title',
                                `latlng` = POINT('$lat','$long')
                                WHERE `category` = '$people_org_code_id' ";

                        $wpdb->query($sql);
                        $wpdb->query($wpdb->prepare("UPDATE $map_table_name SET `marker_status` = 1 WHERE `postID`= '$post_id' "));
                    }
                    else {
                        $address = urlencode($sanitized_address_for_markers);
                        $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$map_key}";
                        $geocodeResponseData = file_get_contents($googleMapUrl);
                        $responseData = json_decode($geocodeResponseData, true);
                        if ($responseData['status'] == 'OK') {
                            $lat = $responseData['results'][0]['geometry']['location']['lat'];
                            $long = $responseData['results'][0]['geometry']['location']['lng'];

                            $isql = 'INSERT INTO `' . $address_table . '` ( `Address`,`lat`,`lang`)
                                                VALUES ("' . $address_key . '","' . $lat . '","' . $long . '")';
                            $i_insert = $wpdb->get_results($isql);

                            $sql = "UPDATE $marker_plugin_table SET `address` = '$sanitized_address_for_markers',
                                `description` = '$description_html',
                                `lat` = '$lat',
                                `lng` = '$long',
                                `title` = '$title',
                                `latlng` = POINT('$lat','$long')
                                WHERE `category` = '$people_org_code_id' ";
                            $wpdb->query($sql);

                        } else if( $responseData['status'] == 'ZERO_RESULTS' ){
                            $wpdb->query($wpdb->prepare("UPDATE $map_table_name SET `marker_status` = 1 WHERE `postID`= '$post_id' "));        
                        } else {
                            echo "<pre>";
                            print_r($responseData);
                            echo "</pre>";
                            echo "Failed ID: " . $people_org_code_id;
                            echo "<br>";
                        }
                    }

                    $wpdb->query($wpdb->prepare("UPDATE $map_table_name SET `marker_status` = 1 WHERE `postID`= '$post_id' "));
                }
            }
        }
    }

    die;
}
