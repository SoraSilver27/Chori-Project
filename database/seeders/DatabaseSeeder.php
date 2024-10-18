<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call([
            CategoriaRepuestoSeeder::class,
            MaquinariaSeeder::class,
            //PlanillaSeeder::class,
            HistorialGeneralSeeder::class,
            FacturaSeeder::class,


        ]);

        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@test.com';
        $user->password = '1234';
        $user->role = 'admin';

        $user->save();
    }
}
