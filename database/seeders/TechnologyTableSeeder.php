<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use App\Function\Helper;

class TechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['HTML', 'CSS', 'JavaScript', 'PHP'];
        foreach($data as $item){
            $new_technology = new Technology;
            $new_technology-> name = $item;
            $new_technology->slug = Helper::generateSlug($item, new Technology());
            $new_technology->save();
        }
    }
}
