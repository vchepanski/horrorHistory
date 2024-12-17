<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cotegory;


class Story extends Model
{
    use HasFactory;

    protected $table = 'stories'; // Nome da tabela no banco de dados

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'category_id',
        'is_published',
    ];

    // Relacionamento com categoria
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relacionamento com autor
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}

