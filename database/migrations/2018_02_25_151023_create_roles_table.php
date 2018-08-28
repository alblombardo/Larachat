<?php

use App\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Role::create(['name' => 'Administrator', 'description' => 'Everything is allowed.']);
        Role::create(['name' => 'Manager', 'description' => 'Allowed to manage all contents.']);
        Role::create(['name' => 'Registered User', 'description' => 'Basic user.']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
