<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function projects(){
        return $this->belongsToMany(Project::class);
    }

    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
    ];
}
