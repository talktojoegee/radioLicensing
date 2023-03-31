<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PricingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
          [
              "plan_name"=>"Essential",
              "duration"=>30,
              "description"=>"The essentials to provide your best work for clients.",
              "amount"=>109,
              "status"=>1,
              "slug"=>Str::slug("Essential"),
          ],
            [
                "plan_name"=>"Growth",
                "duration"=>30,
                "description"=>"A plan that scales with your rapidly growing business.",
                "amount"=>209,
                "status"=>1,
                "slug"=>Str::slug("Growth"),
            ],
            [
                "plan_name"=>"Premium",
                "duration"=>30,
                "description"=>"Dedicated support and infrastructure for your company.",
                "amount"=>309,
                "status"=>1,
                "slug"=>Str::slug("Premium"),
            ],
            [
                "plan_name"=>"Excel",
                "duration"=>30,
                "description"=>"Business excellence redefined...",
                "amount"=>409,
                "status"=>1,
                "slug"=>Str::slug("Excel"),
            ],
        ];
        foreach($plans as $plan){
            Plan::create($plan);
        }
    }
}
