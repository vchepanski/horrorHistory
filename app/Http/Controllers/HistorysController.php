<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class HistorysController extends Controller
{
    // Lista todas as histórias
    public function index()
    {
        $stories = Story::all(['id', 'title']);
        return view('stories.index', compact('stories'));
    }

    public function show($id)
    {
        $story = Story::find($id); // Busca pelo ID

        if (!$story) {
            return response()->json([
                'title' => 'História não encontrada',
                'content' => 'A história que você está tentando acessar não existe.'
            ], 404);
        }

        return response()->json([
            'title' => $story->title,
            'content' => $story->content
        ]);
    }


}
