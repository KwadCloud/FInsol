<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Response;

class SitemapController extends Controller
{
    public function index()
    {
        $routes = collect(Route::getRoutes())->map(function ($route) {
            $uri = $route->uri;
            $depth = substr_count($uri, '/');
            $priority = $this->calculatePriority($depth);
            return [
                'url' => url($uri),
                'lastmod' => $this->calculateLastMod($uri),
                'changefreq' => $this->calculateChangeFreq($uri),
                'priority' => $priority,
            ];
        });

        return response()->view('sitemap', ['routes' => $routes])->header('Content-Type', 'text/xml');
    }

    private function calculatePriority($depth)
    {
        // Your priority calculation logic based on depth
        // Example: higher depth -> lower priority
        return max(1 - ($depth * 0.1), 0.1);
    }

    private function calculateLastMod($uri)
    {
        // Your logic to calculate the last modification date for the given URI
        // Example: return the current date for demonstration purposes
        return now()->toAtomString();
    }

    private function calculateChangeFreq($uri)
    {
        // Your logic to calculate the change frequency based on the date added or last modified
        // Example: more recent -> more frequent changes
        // You can adjust the threshold for defining "recent" based on your application
        if (strtotime($this->calculateLastMod($uri)) >= strtotime('-1 month')) {
            return 'daily'; // URL changed daily
        } else {
            return 'weekly'; // URL changed less frequently
        }
    }
}
