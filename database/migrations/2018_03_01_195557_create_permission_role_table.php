<?php

use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
        });
        $user_permissions = ['create_users', 'view_users', 'update_users', 'list_users', 'delete_users', 'manage_users_roles'];
        foreach ($user_permissions as $user_permission) {
            $permission = Permission::where('name', $user_permission)->firstOrFail();
            Role::findOrFail(1)->firstOrFail()->givePermissionTo($permission);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_role');
    }
}
