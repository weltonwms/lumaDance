<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Aluno::class, function (Faker\Generator $faker) {
    

    return [
        'nome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'telefone' => $faker->phoneNumber,
        'nascimento' => $faker->date('d/m/Y'),
        'endereco' => $faker->address,
    ];
});

$factory->define(App\Teacher::class, function (Faker\Generator $faker) {
    

    return [
        'nome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'telefone' => $faker->phoneNumber,
        'percentual' => $faker->numberBetween(1,50),
        
    ];
});


$factory->define(App\Turma::class, function (Faker\Generator $faker) {
    

    return [
        'descricao' => $faker->jobTitle,
        'horario_inicio' => $faker->regexify('[0-2][0-3]:00'),
        'horario_termino' => $faker->regexify('[0-2][0-3]:00'),
        'dias_semana' => [$faker->numberBetween(0, 3),$faker->numberBetween(4, 6)],
        'teacher_id'=>  App\Teacher::all()->random()->id,
        
    ];
});

$factory->define(App\Contrato::class, function (Faker\Generator $faker) {
    

    return [
        'dia_vencimento' => $faker->dayOfMonth(),
        'valor_vencimento' => $faker->randomFloat(2, 30,100),
        'inicio_contrato' => date('d\/m\/Y'),
        'aluno_id' => App\Aluno::all()->random()->id,
        'turma_id' => App\Turma::all()->random()->id,
        'ativo' => 1,
        
    ];
});
