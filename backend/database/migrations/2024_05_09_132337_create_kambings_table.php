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
        Schema::create('kambings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Essentials
            $table->text('uuid')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('ordering')->nullable();
            // Essentials end

            $table->text('name')->nullable();
            $table->text('address')->nullable();
            $table->integer('category')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kambings');
    }
};
