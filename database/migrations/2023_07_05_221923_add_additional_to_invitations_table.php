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
        Schema::table('invitations', function (Blueprint $table) {
            $table->integer('additional_package_id')->after('package_id')->nullable();   // الباقة الاضافية
            $table->decimal('additional_package_price')->after('package_price')->default(0);   //سعر الباقة الاضافية

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn('additional_package_id');
            $table->dropColumn('additional_package_price');

        });
    }
};
