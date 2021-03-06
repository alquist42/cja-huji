<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name'     => 'Nuruzzaman Milon',
            'email'    => 'contact@milon.im',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);
    }
}
