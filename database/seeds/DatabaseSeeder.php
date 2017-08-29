<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AlunosTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(TurmasTableSeeder::class);
        $this->call(ContratosTableSeeder::class);
        $this->call(DespesasTableSeeder::class);
        $this->call(ProdutosTableSeeder::class);
    }
}
