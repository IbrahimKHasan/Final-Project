<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(50)->create();
        // \App\Models\Contact::factory(50)->create();
        // \App\Models\Company::factory(50)->create();
        // \App\Models\CompanyUser::factory(100)->create();
        \App\Models\Review::factory(100)->create();
    }
}
