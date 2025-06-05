<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            DROP FUNCTION IF EXISTS ketJenis;

            CREATE FUNCTION ketJenis(kode CHAR(1))
            RETURNS VARCHAR(20)
            DETERMINISTIC
            BEGIN
                DECLARE jenis_layanan VARCHAR(20);

                SET jenis_layanan = CASE kode
                    WHEN 'R' THEN 'Regular'
                    WHEN 'M' THEN 'Medium'
                    WHEN 'C' THEN 'Complete'
                    WHEN 'D' THEN 'Drywash'
                END;

                RETURN jenis_layanan;
            END
            ");
    }

    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS ketJenis");
    }
};