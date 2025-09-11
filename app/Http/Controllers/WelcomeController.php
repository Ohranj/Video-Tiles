<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Response;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Response as InertiaResponse;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): InertiaResponse
    {
        $response = $this->call();
        $json = $response->json();
        $video = $json['hits'][rand(0, count($json['hits']) - 2)]['videos']['large'];

        return Inertia::render('Welcome', [
            'url' => $video['url']
        ]);
    }

    /**
     * 
     */
    private function call(): Response
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
            return $this->call();
        }
        return $response;
    }
}
