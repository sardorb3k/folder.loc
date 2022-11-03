<?php

namespace Database\Seeders;

use App\Models\Boards;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // $this->call([
        //     UserSeeder::class,
        //     SettingsSeeder::class
        // ]);
        DB::table('boards')->upsert(
            [
                [
                    'name' => 'Todo',
                    'issue_id' => '1',
                    'order_number' => 1
                ],
                [
                    'name' => 'In Progress',
                    'issue_id' => '1',
                    'order_number' => 2
                ],
                [
                    'name' => 'In Review',
                    'issue_id' => '1',
                    'order_number' => 3
                ],
                [
                    'name' => 'Completed',
                    'issue_id' => '1',
                    'order_number' => 4
                ]
            ],
            ['order_number']
        );
    }
}
