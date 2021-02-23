<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class DefaultJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $defaultJob = new Job();
        $defaultJob -> status = 'active';

        $defaultJob->save();
    }
}
