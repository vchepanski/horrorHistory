<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    /**
     * Retorna todas as histórias publicadas com categoria.
     */
    public function index()
    {
        return response()->json(
            Story::with('category')
                ->where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }

    /**
     * Armazena uma nova história.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:2048',
        ]);

        // Armazena a imagem
        $imagePath = $request->file('image')->store('stories', 'public');

        // Cria a história
        $story = Story::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'is_published' => $request->has('is_published'),
        ]);

        return response()->json([
            'message' => 'História publicada com sucesso!',
            'story' => $story
        ], 201);
    }
}
