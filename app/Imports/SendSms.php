<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SendSms implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $phone_number = $row[0];
            if (substr($phone_number, 0, 1) === '0') {
                $phone_number = "233" . substr($phone_number, 1);
            }
            $response = $this->sendSmsGuzzleRequest($phone_number, new Client());
        }
    }

    /**
     * @param string $phone_number
     * @return bool|string
     */
    public function sendSmsCurlRequest(string $phone_number)
    {
        $curl = curl_init();

        $sms_message = env("SMS_MESSAGE");
        $token = env("SMS_API_TOKEN");
        curl_setopt_array($curl, array(
            CURLOPT_URL => env("SMS_API_URL"),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "{\"msisdn\": \"{$phone_number}\",\"message\": \"{$sms_message}\",\"senderId\": \"SCH DIRECT\"}",
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $token,
                'accept: application/json',
                'Content-Type: application/json'
            ),
        ));

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($curl);

        curl_close($curl);
        Log::info('$response', [
            '$response' => $response
        ]);
        return $response;
    }

    public function sendSmsGuzzleRequest(string $phone_number, Client $client)
    {
        $sms_message = env("SMS_MESSAGE");
        $token = env("SMS_API_TOKEN");

        $response = $client->post(env("SMS_API_URL"), [
            'headers' => [
                'Authorization' => 'Basic ' . $token,
                'accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'msisdn' => $phone_number,
                'message' => $sms_message,
                'senderId' => 'SCH DIRECT',
            ],
            'verify' => false,
        ]);
        /*Log::info('$response', [
            $response->getStatusCode()
        ]);*/
        return $response->getBody()->getContents();
    }
}
