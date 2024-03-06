<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProxyController extends Controller
{
    public function proxyRequest(Request $request)
    {
        $client = new Client();
        $url = 'https://masothue.com/Search';
        $response = $client->request('GET', $url, [
            'query' => [
                'q' => $request->input('q'),
                'type' => 'auto'
            ]
        ]);

        return $response->getBody()->getContents();
    }

}