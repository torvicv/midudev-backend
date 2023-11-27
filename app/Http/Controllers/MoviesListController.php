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

        $body = json_decode($response->body());

        $results = $body->results;

        return response()->json($results);
    }

    public function topMovies() {
        $response = Http::withHeaders([
            'Authorization' => env('TMDB_BEARER_TOKEN', ''),
            'accept' => 'application/json'
        ])->get('https://api.themoviedb.org/3/movie/top_rated?language=en-US&page=1');

        $body = json_decode($response->body());

        $results = $body->results;

        return response()->json($results);
    }

    public function upcoming() {
        $response = Http::withHeaders([
            'Authorization' => env('TMDB_BEARER_TOKEN', ''),
            'accept' => 'application/json'
        ])->get('https://api.themoviedb.org/3/movie/upcoming?language=en-US&page=1');

        return response()->json(json_decode($response->body())->results);
    }
}
