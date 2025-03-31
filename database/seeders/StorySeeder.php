<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use Illuminate\Support\Str;

class StorySeeder extends Seeder
{
    public function run()
    {
        $categorias = [1, 2, 3];

        for ($i = 1; $i <= 10; $i++) {
            Story::create([
                'title' => "História Assustadora $i",
                'content' => Str::random(300),
                // 'image' => null,
                'category_id' => $categorias[array_rand($categorias)],
                'status' => ['pendente', 'aprovado', 'inativo'][rand(0, 2)],
            ]);
        }
    }
}
