<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public static function generateSlug($name)
    {
        return Str::slug($name, '-');
    }
}
