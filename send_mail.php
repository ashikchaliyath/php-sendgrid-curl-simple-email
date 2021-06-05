<?php

function sendEmail($mail_to, $mail_subject, $mail_body)
{

    $cURL_key = '';
    $mail_from = '';

    $curl = curl_init();


    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"personalizations\": [{\"to\": [{\"email\": \"$mail_to\"}]}],\"from\": {\"email\": \"$mail_from\"},\"subject\": \"$mail_subject\",\"content\": [{\"type\": \"text/plain\", \"value\": \"$mail_body\"}]}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $cURL_key",
            "cache-control: no-cache",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}

sendEmail("mail to","Hello World", "Hi, welcome to programming");
