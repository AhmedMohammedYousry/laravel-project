<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class GithubUser extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name','email','github_id','github_token','github_refresh_token'
    ];

    
}