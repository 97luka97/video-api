<?php

namespace Database\Seeders;

use App\Models\ApiToken;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApiTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $token = Str::random(60);

        dump($token);

        ApiToken::create([
            'token' => $token,
            'description' => 'Token for external service',
        ]);
    }
}
