<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Tecnology;

class Tecnology extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];
    public function posts(){
        return $this->belongsToMany(Post::class, 'post_tecnologies');
    }
    public static function generateSlug($name){
        return Str::slug($name, '-');
    }
}
