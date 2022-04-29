<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'id' => 1,
            'username' => 'Moses',
            'email' => 'admin@admin.com',
            'image' => 'def.png',
            'password' => bcrypt(12345678),
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
