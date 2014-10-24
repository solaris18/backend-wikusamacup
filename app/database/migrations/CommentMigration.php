<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class CommentMigration {
    function run()
    {
        Capsule::schema()->dropIfExists('comments');
        Capsule::schema()->create('comments', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('generation');
            $table->string('email');
            $table->boolean('join');
            $table->text('comment');
            $table->timestamps();
        });
    }
}
