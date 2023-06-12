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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('password')->nullable();

            $table->string('full_name')->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('url')->nullable();
            $table->text('introduce')->nullable();
            $table->string('size')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
