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
        Schema::create('bug_levels', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20);
            $table->string('key', 20);
            $table->string('label', 50);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->char('color', 6)->nullable();
            $table->boolean('is_active')->default(true);

            $table->unique(['type', 'key']);
            $table->index(['type', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bug_levels');
    }
};
