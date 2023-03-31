<?php

namespace Database\Seeders;

use App\Models\LeadStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSourceStatusSeeder extends Seeder
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
                'status'=>'New'
            ],[
                "status"=>'Invited'
            ],[
                "status"=>'Conversation'
            ],
            [
                'status'=>'Booked'
            ],[
                "status"=>'Contact Later'
            ],[
                "status"=>'Cold'
            ]
        ];
        foreach ($statuses as $status){
            LeadStatus::create($status);
        }
    }
}
