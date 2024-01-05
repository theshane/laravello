<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Status;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Check if we have a user with the email address
        $user = User::where("email","shane@shaneburgess.com")->first() ?? User::factory()->create([
            'name' => 'Shane',
            'email' => 'shane@shaneburgess.com',
            'password'=> bcrypt('password'),
        ]);

        print("\n\nCreated user\n\n");

        // Create a board for Shane use Board
        $board = $user->boards()->create(
            ['name' => 'Shane\'s Board']
        );

        print("\n\nCreated board\n\n");


        Status::create([
            'name' => 'To Do',
            'is_closed' => false,
            'is_blocked' => false,
        ]);

        print('Created status To Do');

        Status::create([
            'name' => 'In Progress',
            'is_closed' => false,
            'is_blocked' => false,
        ]);

        print('Created status In Progress');

        Status::create([
            'name' => 'Done',
            'is_closed' => true,
            'is_blocked' => false,
        ]);

        print('Created status Done');

        Status::create([
            'name' => 'Blocked',
            'is_closed' => false,
            'is_blocked' => true,
        ]);

        print('Created status Blocked');


    }
}
