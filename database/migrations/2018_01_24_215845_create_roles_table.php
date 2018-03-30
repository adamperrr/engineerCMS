<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        $superadmin = new \App\Role();
        $superadmin->name = 'superadmin';
        $superadmin->description = 'main admin';
        $superadmin->save();

        $admin = new \App\Role();
        $admin->name = 'admin';
        $admin->description = 'normal admin';
        $admin->save();

        $guest = new \App\Role();
        $guest->name = 'guest';
        $guest->description = 'guest';
        $guest->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
