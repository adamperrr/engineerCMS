<?php

use Illuminate\Database\Seeder;

class MenuLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links[0] = new \App\MenuLink;
        $links[0]->name = 'Google';
        $links[0]->link = 'https://google.com';
        $links[0]->order = 0;

        $links[1] = new \App\MenuLink;
        $links[1]->name = 'Logowanie';
        $links[1]->link = './login/';
        $links[1]->order = 0;

        $links[2] = new \App\MenuLink;
        $links[2]->name = 'Interia';
        $links[2]->link = 'https://interia.pl';
        $links[2]->order = 0;

        $links[3] = new \App\MenuLink;
        $links[3]->name = 'Kwejk';
        $links[3]->link = 'https://kwejk.pl';
        $links[3]->order = 0;

        foreach($links as $link) {
            $link->save();
        }
    }
}
