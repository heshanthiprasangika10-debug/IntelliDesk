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
    Schema::create('leave_requests', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('employee_id');

        $table->string('leave_type', 50);
        $table->date('start_date');
        $table->date('end_date');
        $table->text('reason');

        $table->string('status', 20)->default('Pending');
        $table->text('admin_remarks')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
