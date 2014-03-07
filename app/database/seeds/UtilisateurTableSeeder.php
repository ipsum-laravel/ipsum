<?php

class UtilisateurTableSeeder extends Seeder
{
    public function run()
    {
        \Ipsum\Admin\Models\User::create(
            array(
                'id' => 1,
                'nom' => 'Pixell',
                'prenom' => 'admin',
                'email' => 'test@pixellweb.com',
                'password' => Hash::make('admin'),
                'role' => '1',
            )
        );

        \Ipsum\Admin\Models\User::create(
            array(
                'id' => 2,
                'nom' => 'Demo',
                'prenom' => 'Demo',
                'email' => 'demo@pixellweb.com',
                'password' => Hash::make('demo'),
                'role' => '2',
            )
        );

    }
}