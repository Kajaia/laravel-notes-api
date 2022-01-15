<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Note;
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
        Label::factory(10)->create();
        Note::factory(50)->create();
    }
}
