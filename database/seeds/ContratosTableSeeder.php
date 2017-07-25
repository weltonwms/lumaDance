<?php

use Illuminate\Database\Seeder;

class ContratosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Contrato::class,10)->create();
    }
}
