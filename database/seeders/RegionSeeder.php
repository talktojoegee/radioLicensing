<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            [
                "r_name"=>"North",
                "r_slug"=>Str::slug("North"),
            ],
            [
                "r_name"=>"South",
                "r_slug"=>Str::slug("South"),
            ],
            [
                "r_name"=>"East",
                "r_slug"=>Str::slug("East"),
            ],
            [
                "r_name"=>"West",
                "r_slug"=>Str::slug("West"),
            ],
            [
                "r_name"=>"Abroad",
                "r_slug"=>Str::slug("Abroad"),
            ],

        ];
        foreach($regions as $region){
            Region::create($region);
        }
    }
}
