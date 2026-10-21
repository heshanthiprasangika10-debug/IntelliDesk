
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('employees')) {
            return;
        }

        Schema::create('employees', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('employee_id', 100)->unique();
            $table->string('name');
            $table->string('email', 191)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->date('hire_date')->nullable();
            $table->string('status', 20)->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
