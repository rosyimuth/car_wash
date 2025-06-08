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
        DB::unprepared("DROP TRIGGER IF EXISTS ubah_kuota_schedule");

        DB::unprepared("
            CREATE TRIGGER ubah_kuota_schedule
            AFTER UPDATE ON bookings
            FOR EACH ROW
            BEGIN
                IF OLD.schedule_id != NEW.schedule_id THEN
                    -- Tambah kuota jadwal lama
                    UPDATE schedules
                    SET kuota = kuota + 1
                    WHERE id = OLD.schedule_id;

                    -- Kurangi kuota jadwal baru
                    UPDATE schedules
                    SET kuota = kuota - 1
                    WHERE id = NEW.schedule_id;
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS ubah_kuota_schedule");
    }
};