<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      'name' => 'Admin',
      'email' => 'admin@coufie.id',
      'password' => Hash::make('admin123'),
      'phone_number' => '0812345',
      'avatar' => '',
      'role' => 'admin',
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  }
}
