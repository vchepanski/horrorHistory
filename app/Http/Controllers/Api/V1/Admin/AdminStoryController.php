<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story;

class AdminStoryController extends Controller
{
    public function index()
    {
        return Story::with('category')->latest()->get();
    }
    public function approve($id)
    {
        $story = Story::findOrFail($id);
        $story->is_published = true;
        $story->save();

        return response()->json(['message' => 'História aprovada com sucesso!']);
    }

    public function destroy($id)
    {
        $story = Story::findOrFail($id);
        $story->delete();

        return response()->json(['message' => 'História excluída com sucesso!']);
    }
}
