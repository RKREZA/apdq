<?php

namespace App\Services;

use GuzzleHttp\Client;

class RumbleApiService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getVideoInfo($videoId)
    {
        $response = $this->client->request('GET', "https://api.rumble.com/v1/videos/$videoId");

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody()->getContents(), true);
        } else {
            throw new \Exception('Error fetching video information');
        }
    }
}
