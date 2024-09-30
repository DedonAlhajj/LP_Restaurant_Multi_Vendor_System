<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'admin', 'email' => 'admin@gmail.com', 'status'=>'approved', 'password' => bcrypt('12345678')],
        ]);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Seller']);

        $admin = User::where('email', 'admin@gmail.com')->first();

        if ($admin) {
            $admin->assignRole('Admin');
        }
    }
}
