<?php

use App\Permission;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Permission::create(['name' => 'create_users']);
        Permission::create(['name' => 'view_users']);
        Permission::create(['name' => 'update_users']);
        Permission::create(['name' => 'list_users']);
        Permission::create(['name' => 'delete_users']);
        Permission::create(['name' => 'manage_users_roles']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permissions');
    }
}
