<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('postar-historia', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload da imagem
        $imagePath = $request->file('image')->store('stories', 'public');

        // Salvando a história no banco
        Story::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('story.create')->with('success', 'História publicada com sucesso!');
    }
}

