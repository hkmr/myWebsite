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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('provider')->default('normal');
            $table->string('provider_id')->nullable();
            $table->string('avatar');
            $table->string('coverImage')->default('defaultProfileCoverImage.jpg');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('tumblr')->nullable();
            $table->string('youtube')->nullable();
            $table->text('info')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
