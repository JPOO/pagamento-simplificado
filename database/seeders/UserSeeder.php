<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'dois',
                'email' => 'dois@gmail.com',
                'password' => Hash::make('password'),
                'cpfcnpj' => '2',
                'role' => User::COMMON_USER,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'um',
                'email' => 'um@gmail.com',
                'password' => Hash::make('password'),
                'cpfcnpj' => '1',
                'role' => User::SHOPKEEPER,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'Ronaldo Ferreira da SIlva',
                'email' => 'ronaldo@gmail.com',
                'password' => Hash::make('password'),
                'cpfcnpj' => '021.635.739-07',
                'role' => User::COMMON_USER,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'ECC Serviços Técnicos',
                'email' => 'ecc@gmail.com',
                'password' => Hash::make('password'),
                'cpfcnpj' => '00.748.341/0001-40',
                'role' => User::COMMON_USER,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'Cliente 1',
                'email' => 'cliente1@gmail.com',
                'password' => Hash::make('password'),
                'cpfcnpj' => '11',
                'role' => User::COMMON_USER,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'Cliente 3',
                'email' => 'cliente3@gmail.com',
                'password' => Hash::make('password'),
                'cpfcnpj' => '13',
                'role' => User::SHOPKEEPER,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'comprador',
                'email' => 'comprador@gmail.com',
                'password' => Hash::make('password'),
                'cpfcnpj' => '61075342376',
                'role' => User::COMMON_USER,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'shopkeeper',
                'email' => 'shopkeeper@gmail.com',
                'password' => Hash::make('password'),
                'cpfcnpj' => '61075342372',
                'role' => User::SHOPKEEPER,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'Daniel Lopes',
                'email' => 'daniel@gmail.com',
                'password' => Hash::make('password'),
                'cpfcnpj' => '61075342370',
                'role' => User::SHOPKEEPER,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'Lojinha',
                'email' => 'lojinha@gmail.com',
                'password' => Hash::make('password'),
                'cpfcnpj' => '61075342371',
                'role' => User::SHOPKEEPER,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
