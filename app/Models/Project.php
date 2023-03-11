<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Category;

class Project extends Model
{

     //* Definisco i campi assegnati del Model Project
     protected $fillable = [
        'title',
        'description',
        'slug',
        'published',
        'excerpt',
        'author',

    ];

    use HasFactory;

    public static function generateSlug($title){
        return Str::slug($title, '-');
    }

    public function category(){
        return $this->belongsTo(category::class); //* belongsTo = appartiene A...
    }
}
