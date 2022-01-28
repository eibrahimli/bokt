<?php

namespace Database\Seeders;

use App\Models\Options\Service;
use App\Models\Product;
use App\Models\User;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();
         \App\Models\User::create([
             'name' => 'Elvir',
             'surname' => 'ibrahimli',
             'role' => 'admin',
             'email' => 'ibrahimlielvir@gmail.com',
             'password' => bcrypt('Sensen1997')
         ]);
         \App\Models\Customer::factory(10)->create();
    }
}
