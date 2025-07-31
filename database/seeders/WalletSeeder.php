<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        foreach ($userIds as $userId) {
            DB::table('wallets')->insert([
                'user_id' => $userId,
                'amount' => 4500.50,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
