<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Package;
use App\Models\InvitationAddress;
use App\Models\InvitationType;
use App\Models\Coupon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Package::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(InvitationAddress::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(InvitationType::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Coupon::class)->nullable()->constrained()->onDelete('set null');
            $table->boolean('is_notice_before_time')->default(true); // ارسال اشعارات قبل 48 ساعة من وقت الحدث
            $table->boolean('is_notice_specified_date')->default(false); // ارسال اشعارات في تاريخ محدد
            $table->date('specified_date')->nullable(); //وقت ارسال الدعوة
            $table->enum('method_type',['contacts','numbered'])->default('contacts'); //طريقة الدعوة "من جهة اتصالك,مرقمة"
            $table->string('name'); //عنوان الدعوة
            $table->string('inviter_name'); //اسم الداعي
            $table->dateTime('date_time'); // الوقت والتاريخ
            $table->text('details'); //وصف الدعوة
            $table->string('Qrcode'); //الصورة qrcode
            $table->string('image'); //صورة الدعوة
            $table->string('Qrcode_place'); //مكان qrcode
            $table->boolean('is_logo_remove')->default(false);
            $table->decimal('coupon_val')->default(0); // قيمة كوبون الخصم
            $table->decimal('package_price')->default(0); //سعر الباقة
            $table->decimal('logo_remove_price')->default(0); //رسوم حذف الشعار
            $table->decimal('total')->default(0);  // السعر الكلي
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
        Schema::dropIfExists('invitations');
    }
};
