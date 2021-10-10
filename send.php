<?php
$param = json_decode($_REQUEST["param"]);

// var_dump($_POST);
// echo $param->{'g-recaptcha-response'};

if (!$param->{'g-recaptcha-response'}) {
    exit("empty");
} else {
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $key = "6LeYg78cAAAAAN_5TX3kwjn9DPc_Yt80FwMDSE2I";
    $query = array(
        "secret" => $key,
        "response" => $param->{'g-recaptcha-response'},
        "remoteip" => $_SERVER['REMOTE_ADDR']
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    $data = json_decode(curl_exec($ch), $assoc=true);
    curl_close($ch);
    if (!$data['success']) {
        exit("robot");
    } else {
        echo "success";
    }
}