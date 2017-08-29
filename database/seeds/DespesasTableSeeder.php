<?php

use Illuminate\Database\Seeder;

class DespesasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(App\Despesa::class,50)->create();
    }
}
