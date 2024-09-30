<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;
use App\Models\User;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Kreiraj uloge
        Bouncer::role()->firstOrCreate(['name' => 'admin', 'title' => 'Administrator']);
        Bouncer::role()->firstOrCreate(['name' => 'user', 'title' => 'Regular User']);

        // Dodeli admin ulogu korisniku sa ID-jem 1
        $adminUser = User::find(1);
        Bouncer::assign('admin')->to($adminUser);

        // Dodeli user ulogu korisniku sa ID-jem 2
        $regularUser = User::find(2);
        Bouncer::assign('user')->to($regularUser);
    }
}

