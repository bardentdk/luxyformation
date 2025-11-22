<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Post;
use Inertia\Inertia;

class PublicController extends Controller
{
    public function home()
    {
        $latestPosts = Post::published()
            ->with('user')
            ->latest('published_at')
            ->take(3)
            ->get();

        $upcomingFormations = Formation::upcoming()
            ->latest('start_date')
            ->take(3)
            ->get();

        return Inertia::render('Public/Home', [
            'latestPosts' => $latestPosts,
            'upcomingFormations' => $upcomingFormations,
        ]);
    }
}
