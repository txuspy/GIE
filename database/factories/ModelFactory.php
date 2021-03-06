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
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Clientes::class, function (Faker\Generator $faker) {

    return [
        'id_cliente' => $faker->unique()->randomNumber,
        'nom_cliente' => $faker->name,
        'rs_cliente'=> $faker->name,
        'tipo_cliente' => str_random(8),
        'email_cliente' => $faker->unique()->safeEmail,
        'nota_cliente' => $faker->paragraph,
    ];
});

$factory->define(App\Formaciones::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->randomNumber,
        'user_id' => $faker->unique()->randomNumber,
        'tipo'=> 'PAS',
        'modo'=> 'recibir',
        'titulo_eu'=> $faker->name,
        'titulo_es'=> $faker->name
    ];
});
