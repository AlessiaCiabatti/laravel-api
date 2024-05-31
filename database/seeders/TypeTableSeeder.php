<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Function\Helper;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Front End', 'Back End', 'Designe', 'Laravel', 'VueJs', 'Sass', 'MySQL'];
        foreach($data as $item){
            $new_type = new Type;
            $new_type-> name = $item;
            $new_type->slug = Helper::generateSlug($item, new Type());
            $new_type->save();
        }
    }
}
