<?php

namespace Database\Seeders;

use Database\Factories\CommentFactory;
use Illuminate\Database\Seeder;
use Infrastructure\Models\Admin;
use Infrastructure\Models\Profile;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = Admin::all();
        $profiles = Profile::all();

        foreach ($admins as $admin) {

            $profilesToComment = $profiles->random(min(3, $profiles->count()));

            foreach ($profilesToComment as $profile) {
                CommentFactory::new()
                    ->setAdminId($admin->id)
                    ->setProfileId($profile->id)
                    ->createOne();
            }
        }
    }
}
