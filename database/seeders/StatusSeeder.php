<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Неактивный',
                'color' => '#FEE2E2',
                'status_type_id' => StatusType::USER
            ],
            [
                'name' => 'Активный',
                'color' => '#D1FAE5',
                'status_type_id' => StatusType::USER
            ]
        ];

        Status::insert($statuses);
    }
}
