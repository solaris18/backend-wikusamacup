<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class ScheduleMigration {
    function run()
    {
        Capsule::schema()->dropIfExists('schedules');
        Capsule::schema()->create('schedules', function($table) {
            $table->increments('id');
            $table->string('team1_id');
            $table->string('team2_id');
            $table->datetime('datetime_competition');
            $table->integer('score_team1');
            $table->integer('score_team2');
            $table->string('city');
            $table->string('category');
            $table->timestamps();
        });
    }
}
