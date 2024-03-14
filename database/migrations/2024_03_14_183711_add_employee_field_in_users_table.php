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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('added_by')->after('otp')->nullable();
            $table->enum('is_employee', [0, 1])->default(0)->after('added_by');
            $table->enum('employee_type', ['manager', 'editor'])->after('is_employee')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('employee_type');
            $table->dropColumn('is_employee');
            $table->dropColumn('added_by');
        });
    }
};
