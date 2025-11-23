<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReservationsTableForBookingSystem extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            if (!Schema::hasColumn('reservations', 'owner_id')) {
                $table->foreignId('owner_id')->after('user_id')->constrained('users')->onDelete('cascade');
            }
            
            if (!Schema::hasColumn('reservations', 'accepted_at')) {
                $table->timestamp('accepted_at')->nullable()->after('message');
            }
            
            if (!Schema::hasColumn('reservations', 'completed_at')) {
                $table->timestamp('completed_at')->nullable()->after('accepted_at');
            }
        });

        Schema::table('reservations', function (Blueprint $table) {
            try {
                $table->unique(['book_id', 'user_id', 'status'], 'reservations_book_id_user_id_status_unique');
            } catch (\Exception $e) {
            }
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropUnique('reservations_book_id_user_id_status_unique');
        });
    }
}