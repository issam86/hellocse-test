<?php

namespace Database\Seeders;

use Database\Factories\ProfileFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Infrastructure\Models\Admin;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = Admin::all();
        ProfileFactory::new()
            ->setAdminId($admins->random()->id)
            ->createMany(2);
    }
}
