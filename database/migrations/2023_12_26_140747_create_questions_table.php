<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_name');
            $table->string('question_path');
            $table->string('level');
            $table->string('grade');
            $table->string('creator');
            $table->string('subject');
            $table->integer('duration');
            $table->string('answer_key');
            $table->boolean('status')->default(FALSE);
            $table->longText('passtest')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
