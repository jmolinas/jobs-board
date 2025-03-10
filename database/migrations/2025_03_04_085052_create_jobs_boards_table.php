<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('jobs_boards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company');
            $table->string('location');
            $table->string('department');
            $table->string('employment_type');
            $table->string('schedule');
            $table->text('description');
            $table->enum('status', ['pending', 'published', 'spam'])->default('pending');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to user table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs_boards');
    }
};
