<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS cek_kuota_schedule;

            CREATE TRIGGER cek_kuota_schedule
            BEFORE INSERT ON bookings
            FOR EACH ROW
            BEGIN
                DECLARE sisa_kuota INT;

                SELECT kuota INTO sisa_kuota
                FROM schedules
                WHERE id = NEW.schedule_id;

                IF sisa_kuota <= 0 THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Booking gagal: kuota jadwal sudah habis';
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS cek_kuota_schedule");
    }
};
