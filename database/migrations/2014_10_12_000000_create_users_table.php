<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('din')->unique()->unsigned()->nullable();
            $table->string('username')->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->enum('department', ['publish', 'hr', 'it', 'accounts', 'construction', 'design', 'iqm', 'legal'])->nullable();
            $table->string('position')->nullable();
            $table->date('birthdate')->nullable();
            $table->boolean('locked')->default(false);
            $table->boolean('approved')->default(true);
            $table->boolean('admin')->default(false);
            $table->rememberToken();
            $table->timestamp('last_login')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
