<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Dozvoli adminu da upravlja (kreira, menja, briše) kategorijama i lokacijama
        Bouncer::allow('admin')->toManage(\App\Models\Category::class);
        Bouncer::allow('admin')->toManage(\App\Models\Location::class);

        // Dozvoli adminu da upravlja bilo kojim oglasom (svojim i tuđim)
        Bouncer::allow('admin')->toManage(\App\Models\Ad::class);

        // Dozvoli adminu da šalje poruke
        Bouncer::allow('admin')->to('send-messages');


        // Dozvoli korisnicima da kreiraju i upravljaju samo svojim oglasima
        Bouncer::allow('user')->to('create', App\Models\Ad::class);
        Bouncer::allow('user')->to('update', App\Models\Ad::class);
        Bouncer::allow('user')->to('delete', App\Models\Ad::class);

        // Dozvoli korisnicima da šalju poruke
        Bouncer::allow('user')->to('send-messages');
    }
}

