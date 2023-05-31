<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;
use App\Models\People;

class CreateTodosTable extends Migration // first err - wrong name - no 's' in 'todos'
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('todos');
        Schema::dropIfExists('people');  // second err - after try created table and throw err 'in use'

        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('street');
            $table->string('city');
            $table->timestamps();
        });

        $faker = Faker::create();

        for ($i = 0; $i < 200; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $phoneNumber = $faker->phoneNumber;
            $street = $faker->streetAddress;
            $city = $faker->city;

            People::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone_number' => $phoneNumber,
                'street' => $street,
                'city' => $city,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
        Schema::dropIfExists('people');
    }
}