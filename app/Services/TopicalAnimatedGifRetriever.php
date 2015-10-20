<?php

namespace App\Services;

use GuzzleHttp\Client as Interwebs;

class TopicalAnimatedGifRetriever
{
    /**
     * Get a high quality Internet animated image URL.
     *
     * @return string
     */
	public function imageTagFor($topic)
	{
        $response = (new Interwebs)->get(
            'http://api.giphy.com/v1/gifs/search?q='.urlencode($topic).'&api_key=dc6zaTOxFJmzC'
        );

        return $this->parseRidiculousPayload($response);
    }

    /**
     * Parse the ridiculous payload from the web service.
     */
    protected function parseRidiculousPayload($response)
    {
        $payload = json_decode((string) $response->getBody(), true)['data'];

        return '<img src="'.$payload[array_rand($payload)]['images']['fixed_height']['url'].'">';
    }
}
