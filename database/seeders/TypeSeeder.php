<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['id' => 1, 'name' => 'Disconnection'],
            ['id' => 2, 'name' => 'Verification'],
            ['id' => 3, 'name' => 'Tech issue'],
            ['id' => 4, 'name' => 'Other']
        ];
        DB::table('types')->insert($types);
    }
}
