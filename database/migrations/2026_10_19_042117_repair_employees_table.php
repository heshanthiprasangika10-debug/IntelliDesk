
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Convert the existing table to InnoDB.
        DB::statement('ALTER TABLE employees ENGINE=InnoDB');

        // Shorten columns before adding unique indexes.
        Schema::table('employees', function (Blueprint $table) {
            $table->string('employee_id', 100)->change();
            $table->string('email', 191)->change();
            $table->string('status', 20)->default('Active')->change();
        });

        // Add unique indexes only if they do not already exist.
        $indexes = DB::select('SHOW INDEX FROM employees');
        $indexNames = array_unique(array_map(
            fn ($index) => $index->Key_name,
            $indexes
        ));

        Schema::table('employees', function (Blueprint $table) use ($indexNames) {
            if (! in_array('employees_employee_id_unique', $indexNames)) {
                $table->unique('employee_id');
            }

            if (! in_array('employees_email_unique', $indexNames)) {
                $table->unique('email');
            }
        });
    }

    public function down(): void
    {
        // Keep the repaired table and its data.
    }
};
