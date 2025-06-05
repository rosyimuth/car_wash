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
            DROP TRIGGER IF EXISTS kurangi_kuota_schedule;

            CREATE TRIGGER kurangi_kuota_schedule
            AFTER INSERT ON bookings
            FOR EACH ROW
            BEGIN
                UPDATE schedules
                SET kuota = kuota - 1
                WHERE id = NEW.schedule_id;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS kurangi_kuota_schedule");
    }
};
