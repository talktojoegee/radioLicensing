<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                "ms_name"=>"Single",
            ],
            [
                "ms_name"=>"Married",
            ],
            [
                "ms_name"=>"Separated",
            ],
            [
                "ms_name"=>"Divorced",
            ],
            [
                "ms_name"=>"Widowed",
            ],

        ];
        foreach($statuses as $status){
            MaritalStatus::create($status);
        }
    }
}
