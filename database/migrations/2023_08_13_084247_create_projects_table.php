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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('status')->comment('1=Not started|2=In progress|3=Modification|4=Completed');
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('set null')->onDelete('set null');
            $table->string('helping_kits')->nullable();
            $table->text('related_comment')->nullable();
            $table->string('delivered_files')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
