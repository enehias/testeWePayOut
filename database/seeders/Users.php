<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->delete();

        // Usuários iniciais para secretaria 1
        DB::table("users")->insert([
            "name"          => "Administrator1",
            "email"         => "administrador1@administrador1.com",
            "document"     => "11111111111",
            "password"      => bcrypt("password"),
            "created_at"    => now(),
            "updated_at"    => now(),
        ]);

        DB::table("users")->insert([
            "name"        => "Administrador2",
            "email"            => "administrador2@administrador2.com",
            "document"         => "11111111112",
            "password"         => bcrypt("password"),
            "created_at"       => now(),
            "updated_at"       => now(),
        ]);

        DB::table("users")->insert([
            "name"        => "Administrador3",
            "email"            => "administrador3@administrador3.com",
            "document"     => "11111111113",
            "password"         => bcrypt("password"),
            "created_at"       => now(),
            "updated_at"       => now(),
        ]);
    }
}
