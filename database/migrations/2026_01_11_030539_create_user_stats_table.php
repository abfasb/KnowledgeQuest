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
         Schema::create('user_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('total_points')->default(0);
            $table->integer('total_quizzes')->default(0);
            $table->integer('total_questions_attempted')->default(0);
            $table->integer('total_correct_answers')->default(0);
            $table->integer('total_incorrect_answers')->default(0);
            $table->decimal('accuracy', 5, 2)->default(0);
            $table->integer('current_streak')->default(0);
            $table->integer('max_streak')->default(0);
            $table->date('last_quiz_date')->nullable();
            $table->json('category_stats')->nullable();
            $table->json('difficulty_stats')->nullable();
            $table->timestamps();
            
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_stats');
    }
};
