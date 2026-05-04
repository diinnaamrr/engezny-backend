<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('zone_wise_default_trip_fares', function (Blueprint $table) {
            $table->double('min_fare')->default(0)->after('min_cancellation_fee');
        });

        Schema::table('trip_fares', function (Blueprint $table) {
            $table->double('min_fare')->default(0)->after('min_cancellation_fee');
        });
    }

    public function down(): void
    {
        Schema::table('zone_wise_default_trip_fares', function (Blueprint $table) {
            $table->dropColumn('min_fare');
        });

        Schema::table('trip_fares', function (Blueprint $table) {
            $table->dropColumn('min_fare');
        });
    }
};
