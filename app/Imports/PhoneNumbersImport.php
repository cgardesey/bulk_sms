<?php

namespace App\Imports;

use App\PhoneNumber;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PhoneNumbersImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            /*PhoneNumber::create([
                'phone_number' => $row[0],
            ]);*/
            $phone_number = $row[0];
            if (substr($phone_number, 0, 1) === '0') {
                $phone_number = "233" . substr($phone_number, 1);
            }

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
        }
    }
}
