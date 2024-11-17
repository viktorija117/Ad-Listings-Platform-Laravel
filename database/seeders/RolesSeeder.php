<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;
use App\Models\User;

class RolesSeeder extends Seeder
{
    public function run()
    {

        // Dodeli admin ulogu korisniku sa email-om 'admin@example.com'
        $adminUser = User::where('email', 'admin@example.com')->first();
        if ($adminUser) {
            Bouncer::assign('admin')->to($adminUser);
        }

        // Dodeli user ulogu korisniku sa email-om 'regular@example.com'
        $regularUser = User::where('email', 'regular@example.com')->first();
        if ($regularUser) {
            Bouncer::assign('user')->to($regularUser);
        }
    }
}
