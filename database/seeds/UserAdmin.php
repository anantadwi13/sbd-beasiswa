<?php

use Illuminate\Database\Seeder;

class UserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\User();
        $admin->name = "Admin";
        $admin->email = "admin@admin.com";
        $admin->password = bcrypt('123123');
        $admin->type = \App\User::TYPE_ADMIN;
        $admin->save();
    }
}
