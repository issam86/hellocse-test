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
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->foreignId('admin_id')->constrained('admin')->onDelete('cascade');
            $table->foreignId('profile_id')->constrained('profile')->onDelete('cascade');
            $table->unique(['admin_id', 'profile_id']);
            $table->index('admin_id');
            $table->index('profile_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};
