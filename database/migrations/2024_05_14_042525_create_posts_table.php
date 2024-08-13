<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('for')->default('buy');
            $table->foreignId('user_id')->constrained('users');
            $table->bigInteger('quality');
            $table->bigInteger('rate')->nullable();
            $table->string('limit')->nullable();
            $table->integer('exchange_amount')->nullable();
            $table->integer('like')->default(0);
            $table->integer('trade')->default(0);
            $table->integer('completion')->default(0);
            $table->string('contact_number')->nullable();
            $table->string('gateway')->nullable();
            $table->integer('relise_user')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('posts');
    }
};
