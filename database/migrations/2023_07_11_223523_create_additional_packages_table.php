<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Invitation;
use App\Models\Package;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Invitation::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Package::class)->nullable()->constrained()->onDelete('set null');
            $table->decimal('package_price')->default(0);
            $table->decimal('invitations_num')->default(0);
            $table->decimal('remaining_num')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additional_packages');

    }
};
