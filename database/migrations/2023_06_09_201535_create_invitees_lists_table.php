<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Invitation;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitees_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Invitation::class)->nullable()->constrained()->onDelete('set null');
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->integer('companions_number')->default(0);
            $table->integer('phone')->nullable();
            $table->string('link');
            $table->enum('status',['waiting','accepted','rejected','complete'])->default('waiting');
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('invitees_lists');
    }
};
