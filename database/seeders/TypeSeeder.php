<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;
class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['frontend', 'backend', 'fullstack', 'design', 'devOps'];
        foreach($categories as $category) {
           $type = new Type();
           $type->name = $category;
           $type->slug = Str::slug($category);
           $type->save();
        }
    }
}
