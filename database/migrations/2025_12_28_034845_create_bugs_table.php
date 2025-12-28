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
        Schema::create('bugs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();

            $table->foreignId('reporter_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();

            $table->string('title', 255);
            $table->text('description');

            $table->foreignId('status_id')->constrained('bug_statuses')->restrictOnDelete();
            $table->foreignId('severity_id')->constrained('bug_levels')->restrictOnDelete();
            $table->foreignId('priority_id')->constrained('bug_levels')->restrictOnDelete();

            $table->text('steps_to_reproduce')->nullable();
            $table->text('expected_result')->nullable();
            $table->text('actual_result')->nullable();

            $table->timestamps();

            $table->index('project_id');
            $table->index(['project_id', 'status']);
            $table->index(['project_id', 'assigned_to']);
            $table->index(['project_id', 'created_at']);
            $table->index('reporter_id');
            $table->index('assigned_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bugs');
    }
};
