<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class MoviesListController extends Controller
{
    //
    public function popular() {
        $response = Http::withHeaders([
            'Authorization' => env('TMDB_BEARER_TOKEN', ''),
            'accept' => 'application/json'
        ])->get('https://api.themoviedb.org/3/movie/popular?language=en-US&page=1');

        return response()->json(json_decode($response->body())->results);
    }

    public function topMovies() {
        $client = new Client();

        $response = $client->request("GET", 'https://api.themoviedb.org/3/movie/top_rated?language=en-US&page=1', [
            'headers' => [
                'Authorization' => env('TMDB_BEARER_TOKEN', ''),
                'accept' => 'application/json'
            ]
        ]);

        $result = $response->getBody();
        return json_encode(json_decode($result)->results);
    }

    public function upcoming() {
        $client = new Client();

        $response = $client->request("GET", 'https://api.themoviedb.org/3/movie/upcoming?language=en-US&page=1', [
            'headers' => [
                'Authorization' => env('TMDB_BEARER_TOKEN', ''),
                'accept' => 'application/json'
            ]
        ]);

        $result = $response->getBody();
        return json_encode(json_decode($result)->results);
    }
}
