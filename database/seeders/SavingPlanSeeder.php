<?php

namespace Database\Seeders;

use App\Models\SavingPlan;
use Illuminate\Database\Seeder;

class SavingPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            ['name' => 'Paket 25rb', 'weekly_amount' => 25000, 'is_active' => true],
            ['name' => 'Paket 50rb', 'weekly_amount' => 50000, 'is_active' => true],
            ['name' => 'Paket 75rb', 'weekly_amount' => 75000, 'is_active' => true],
            ['name' => 'Paket 100rb', 'weekly_amount' => 100000, 'is_active' => true],
        ];

        foreach ($plans as $plan) {
            SavingPlan::updateOrCreate(
                ['weekly_amount' => $plan['weekly_amount']],
                $plan
            );
        }
    }
}

