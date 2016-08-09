<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class RegistrationMigration {
    function run()
    {
        Capsule::schema()->dropIfExists('registrations');
        Capsule::schema()->create('registrations', function($table) {
            $table->increments('id');
            $table->string('team_name');
            $table->string('region');
            $table->string('generation');
            $table->string('pic');
            $table->string('phone');
            $table->string('email');
            $table->string('sosmed');
            $table->timestamps();
        });
    }
}
