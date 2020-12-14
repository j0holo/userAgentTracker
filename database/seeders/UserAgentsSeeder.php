<?php

namespace Database\Seeders;

use App\Models\UserAgents;
use Illuminate\Database\Seeder;

class UserAgentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserAgents::factory()->times(6000)->create();
    }
}
