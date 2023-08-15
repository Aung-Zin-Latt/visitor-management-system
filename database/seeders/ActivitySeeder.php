<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activity_types = [
            'check_in',
            'check_out',
        ];
        foreach ($activity_types as $type) {
            ActivityType::create([
               'type' => $type 
            ]);
        }
    }
}
