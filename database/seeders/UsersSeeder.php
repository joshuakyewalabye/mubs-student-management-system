<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
       $users = [
    // name, email, role
    ['System Administrator',   'admin@mubs.ac.ug',              'administrator'],
    ['Dr. Bashir Mutebi',       'bashir.mutebi@mubs.ac.ug',       'lecturer'],
    ['Mr. Mosh Gyagenda',       'mosh.gyagenda@mubs.ac.ug',       'lecturer'],
    ['Matovu Mathew Philip',   'mathew.matovu@mubs.ac.ug',      'student'],
    ['Kyewalabye Joshua Joram','joshua.kyewalabye@mubs.ac.ug',  'student'],
    ['Kushaba Adrona',         'adrona.kushaba@mubs.ac.ug',     'student'],
    ['Magumba Benjamin Samuel','benjamin.magumba@mubs.ac.ug',   'student'],
    ['Magala Eric',            'eric.magala@mubs.ac.ug',        'student'],
    ['Kazosi Sharif',          'sharif.kazosi@mubs.ac.ug',      'student'],
];

        foreach ($users as [$name, $email, $role]) {
            // updateOrCreate: matches on email, so re-running never duplicates (Q2d)
            $user = User::updateOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => Hash::make('password')]
            );

            // syncRoles: the user ends up with exactly this one role
            $user->syncRoles([$role]);
        }
    }
}