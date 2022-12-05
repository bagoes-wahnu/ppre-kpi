<?php

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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ParametersTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(MappingScoresTableSeeder::class);
        $this->call(KondisiTableSeeder::class);
        $this->call(TypeYtdTableSeeder::class);
    }
}
