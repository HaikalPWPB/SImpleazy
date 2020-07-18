<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddRelationAndSomeData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        DB::table('roles')->insert([
            'slug' => 'Admin',
            'role_name' => 'admin'
        ]);

        DB::table('roles')->insert([
            'slug' => 'Member',
            'role_name' => 'member'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function(Bluepring $table){
            $table->dropForeign(['users_id']);
            $table->dropForeign(['role_id']);
        });
    }
}
