<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];

    public function Projects(){

        return $this->hasMany(Project::class);
    }
}
