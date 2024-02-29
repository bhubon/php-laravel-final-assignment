<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->default('inactive')->after('category_id');
            $table->text('thumbnail')->nullable()->after('category_id');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
            $table->dropColumn('status');
            $table->dropForeign('user_id');
        });
    }
};
