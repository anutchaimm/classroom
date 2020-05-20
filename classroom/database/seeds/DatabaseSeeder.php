<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('classroom_types')->insert([[
            'cls_type' => 1,
            'clst_name' => 'League Learning',
            'clst_status' => 'Available'
        ],
        [
            'cls_type' => 2,
            'clst_name' => 'Tranditional',
            'clst_status' => 'Available'
        ]
    ]);
    }
}
