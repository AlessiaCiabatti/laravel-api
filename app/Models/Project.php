<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function technology(){
        return $this->belongsTo(Technology::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class);
    }

    protected $fillable = [
        'title',
        'technology_id',
        'slug',
        'text',
        'reading_time',
        'image',
        'image_original_name'
    ];
}
