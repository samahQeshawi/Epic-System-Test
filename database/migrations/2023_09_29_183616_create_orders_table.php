<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Invitation;
use App\Models\Package;
use App\Models\Coupon;
use App\Models\PaymentMethod;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Invitation::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Package::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(PaymentMethod::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Coupon::class)->nullable()->constrained()->onDelete('set null');
            $table->string('phone');
            $table->decimal('total')->default(0);  // السعر الكلي
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('orders');
    }
};
