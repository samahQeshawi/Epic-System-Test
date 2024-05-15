<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invitees_lists', function (Blueprint $table) {
            $table->string('serial_number')->after('invitation_id')->unique()->nullable();
            $table->boolean('is_send')->default(false)->after('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invitees_lists', function (Blueprint $table) {
            $table->dropColumn('serial_number');
            $table->dropColumn('sending_status');

        });
    }
};
