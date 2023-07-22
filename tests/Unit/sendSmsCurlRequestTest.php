<?php

namespace Tests\Unit;

use App\Imports\SendSms;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class sendSmsCurlRequestTest extends TestCase
{
    /** @test */
    public function sendSms()
    {
        // Mock the Guzzle client with a predefined response
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode([
                'message' => 'success'
            ])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $phone_number = '233546676098';

        // Call the method and get the response
        $sendSms = new SendSms();
        $response = $sendSms->sendSmsGuzzleRequest($phone_number, $client);

        // Assert the response is as expected
        $this->assertJson($response);
        $this->assertEquals(['message' => 'success'], json_decode($response, true));
    }
}
