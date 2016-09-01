<?php

class UtilisateurTableSeeder extends Seeder
{
    public function run()
    {
        \Ipsum\Admin\Models\User::create(
            array(
                'id' => 1,
                'nom' => 'Admin',
                'prenom' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin'),
                'role' => '1',
                'acces' => '',
                'remember_token' => '',
            )
        );

        \Ipsum\Admin\Models\User::create(
            array(
                'id' => 2,
                'nom' => 'User',
                'prenom' => 'User',
                'email' => 'user@example.com',
                'password' => Hash::make('demo'),
                'role' => '2',
                'acces' => '',
                'remember_token' => '',
            )
        );

    }
}
