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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('due_date');
            $table->unsignedBigInteger('priority');
            $table->unsignedBigInteger('status')->comment('1=Not started|2=In progress|3=Completed');
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('set null')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
