<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{

     //* Definisco i campi assegnati del Model Project
     protected $fillable = [
        'title',
        'description',
        'slug',
        'published',
    ];

    use HasFactory;

    public static function generateSlug($title){
        return Str::slug($title, '-');
    }
}
