<?php

namespace Database\Seeders;

use App\Models\LeadSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sources = [
            [
                'source'=>'Search Engine(Google, Bing)'
            ],[
                "source"=>'Google Maps Search'
            ],[
                "source"=>'Referral'
            ],
            [
                'source'=>'Social Media'
            ],[
                "source"=>'Online Communities/Forums'
            ],[
                "source"=>'Online Advertisement'
            ],
            [
                'source'=>'Offline Advertisement'
            ],[
                "source"=>'Noticed the physical location'
            ],[
                "source"=>'Website'
            ],
            [
                'source'=>'Event'
            ],[
                "source"=>'School'
            ],[
                "source"=>'Others'
            ]
        ];
        foreach ($sources as $source){
            LeadSource::create($source);
        }
    }
}
