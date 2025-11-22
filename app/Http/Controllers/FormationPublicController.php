<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Inertia\Inertia;

class FormationPublicController extends Controller
{
    public function index()
    {
        $formations = Formation::published()
            ->latest()
            ->paginate(12);

        return Inertia::render('Public/Formations/Index', [
            'formations' => $formations,
        ]);
    }

    public function show($slug)
    {
        $formation = Formation::where('slug', $slug)
            ->published()
            ->firstOrFail();

        $relatedFormations = Formation::published()
            ->where('id', '!=', $formation->id)
            ->where('level', $formation->level)
            ->take(3)
            ->get();

        return Inertia::render('Public/Formations/Show', [
            'formation' => $formation,
            'relatedFormations' => $relatedFormations,
        ]);
    }
}
