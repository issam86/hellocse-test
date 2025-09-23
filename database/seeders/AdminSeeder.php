<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\AdminFactory;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Admin principal pour les tests
        AdminFactory::new()

            ->setEmail('admin@test.com')
            ->setPassword('password123')
            ->createOne();

        // Admin secondaire
        AdminFactory::new()

            ->setEmail('manager@test.com')
            ->setPassword('password123')
            ->createOne();

        // Quelques admins supplémentaires
        AdminFactory::new()->createMany(2);
    }
}
