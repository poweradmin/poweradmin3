<?php

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create(array(
            'status' => User::STATUS_ACTIVE,
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'username' => 'admin',
            'description' => 'Administrator main account',
        ));

        $this->command->info('User table seeded!');
    }
}
