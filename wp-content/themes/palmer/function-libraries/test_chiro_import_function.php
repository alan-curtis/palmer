<?php

function CallDearAPI( $endpoint , $data = null ) {

    $url = "https://apichiropractic.azurewebsites.net/findachiro/vr1/country/".strtolower($values['select_country']).""; //state url

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'ApiKey: PMAK-61804081ca1aba003fe346fd-fef4917c01919caad510c988b82ec49626'
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    $states_data=json_decode($resp);


}

 ?>