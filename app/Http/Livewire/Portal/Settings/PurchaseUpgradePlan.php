<?php

namespace App\Http\Livewire\Portal\Settings;

use App\Models\Plan;
use Livewire\Component;

class PurchaseUpgradePlan extends Component
{
    public $plans;

    public function __construct(){
        $this->plan = new Plan();
    }

    public function mount(){

    }
    public function render()
    {
        $this->plans = $this->plan->getPlans();
        return view('livewire.portal.settings.purchase-upgrade-plan')
            ->extends('layouts.master-layout')
            ->section('main-content');
    }
}
