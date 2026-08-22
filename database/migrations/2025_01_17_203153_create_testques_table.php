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
        if (!Schema::hasTable('testques')) {
            Schema::create('testques', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('test_id');
                $table->string('text');
                $table->string('type');
                $table->json('options')->nullable();
                $table->json('correct_answers')->nullable();
                $table->integer('marks')->default(1);  
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testques');
    }
};
