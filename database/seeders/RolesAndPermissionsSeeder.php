<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Kreiraj uloge ako ne postoje
        Bouncer::role()->firstOrCreate(['name' => 'admin', 'title' => 'Administrator']);
        Bouncer::role()->firstOrCreate(['name' => 'user', 'title' => 'Regular User']);

        // Dozvoli adminu da upravlja (kreira, menja, briše) kategorijama i lokacijama
        Bouncer::allow('admin')->toManage(\App\Models\Category::class);
        Bouncer::allow('admin')->toManage(\App\Models\Location::class);

        // Dozvoli adminu da brise bilo koji oglas
        Bouncer::allow('admin')->to('delete', Ad::class);

        // Dozvoli adminu da šalje poruke
        Bouncer::allow('admin')->to('send-messages');


        // Dozvoli korisnicima da kreiraju i upravljaju samo svojim oglasima
        Bouncer::allow('user')->to('create', Ad::class);
        Bouncer::allow('user')->toOwn(Ad::class)->to('delete');

        // Dozvoli korisnicima da šalju poruke
        Bouncer::allow('user')->to('send-messages');
    }
}

