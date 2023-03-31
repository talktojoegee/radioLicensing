<?php

namespace Database\Seeders;

use App\Models\AppointmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentTypeSeeder extends Seeder
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
                'name'=>'Initial Consultation'
            ],[
                "name"=>'Follow-up Session'
            ],[
                "name"=>'Group Session'
            ]
        ];
        foreach ($types as $type){
            AppointmentType::create($type);
        }

    }
}
