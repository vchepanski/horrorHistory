<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::select('id', 'name', 'status')->get());

    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'status' => 'ativo'
        ]);

        return response()->json($category, 201);
    }

    public function toggleStatus($id)
    {
    $category = Category::findOrFail($id);

    $category->status = $category->status === 'ativo' ? 'inativo' : 'ativo';
    $category->save();

    return response()->json([
        'message' => 'Status atualizado com sucesso.',
        'category' => $category
    ]);
}

}

