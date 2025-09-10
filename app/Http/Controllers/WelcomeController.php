<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $response = Http::get('https://pixabay.com/api/videos', [
            'key' => config('auth.pixabay_key'),
            'page' => rand(1, 2),
            'per_page' => rand(1, 50),
            'category' => 'animals,nature,people,business,sport,transportation,places',
            'min_width' => 900,
            'safesearch' => true
        ]);
        if ($response->failed()) {
            dd($response);
        }
        $json = $response->json();
        $video = $json['hits'][rand(0, count($json['hits']) - 1)]['videos']['large'];

        return Inertia::render('Welcome', [
            'url' => $video['url']
        ]);
    }
}
