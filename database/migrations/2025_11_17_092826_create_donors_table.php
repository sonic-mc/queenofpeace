<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->decimal('total_donated', 12, 2)->default(0);
            $table->integer('donation_count')->default(0);
            $table->timestamp('last_donation_at')->nullable();
            $table->timestamps();

            $table->index('email');
        });
    }

    public function down()
    {
        Schema::dropIfExists('donors');
    }
};
