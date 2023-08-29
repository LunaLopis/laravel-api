<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tecnology;
use Illuminate\Support\Str;

class TecnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tecnologies = ['HTML', 'CSS', 'Javascript', 'VueJS', 'Laravel'];
        foreach($tecnologies as $tecnology){
            $new_tecnology = new Tecnology();
            $new_tecnology-> name = $tecnology;
            $new_tecnology->slug = Str::slug($tecnology);
           $new_tecnology->save();
        }
    }
}
