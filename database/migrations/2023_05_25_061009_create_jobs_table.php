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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('level')->nullable();
            $table->string('salary_start')->nullable();
            $table->string('salary_end')->nullable();
            $table->string('experience')->nullable();
            $table->text('languages')->nullable();
            $table->string('gender')->nullable();
            $table->text('content')->nullable();
            $table->boolean('state')->nullable()->default(1);
            $table->string('size')->nullable();
            $table->date('date_end')->nullable();
            $table->integer('count')->nullable()->default(0);
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->boolean('is_active')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
