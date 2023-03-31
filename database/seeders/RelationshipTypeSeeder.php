<?php

namespace Database\Seeders;

use App\Models\RelationshipType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RelationshipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                "rt_name"=>"Father",
                "rt_slug"=>Str::slug("Father"),
            ],
            [
                "rt_name"=>"Mother",
                "rt_slug"=>Str::slug("Mother"),
            ],
            [
                "rt_name"=>"Brother",
                "rt_slug"=>Str::slug("Brother"),
            ],
            [
                "rt_name"=>"Sister",
                "rt_slug"=>Str::slug("Sister"),
            ],
            [
                "rt_name"=>"Husband",
                "rt_slug"=>Str::slug("Husband"),
            ],
            [
                "rt_name"=>"Wife",
                "rt_slug"=>Str::slug("Wife"),
            ],
            [
                "rt_name"=>"Uncle",
                "rt_slug"=>Str::slug("Uncle"),
            ],
            [
                "rt_name"=>"Aunt",
                "rt_slug"=>Str::slug("Aunt"),
            ],
            [
                "rt_name"=>"Nephew",
                "rt_slug"=>Str::slug("Nephew"),
            ],
            [
                "rt_name"=>"Niece",
                "rt_slug"=>Str::slug("Niece"),
            ],
            [
                "rt_name"=>"Cousin",
                "rt_slug"=>Str::slug("Cousin"),
            ],

        ];
        foreach($types as $type){
            RelationshipType::create($type);
        }
    }
}
