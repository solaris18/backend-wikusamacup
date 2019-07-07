<?php
class UserSeed {
    function run()
    {
        $user = new User;
        $user->name = "admin";
        $user->email = "admin@admin.com";
        $user->password = sha1('password');
        $user->save();
    }
}