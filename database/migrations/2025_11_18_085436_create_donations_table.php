<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            $table->string('transaction_reference')->unique();
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('USD');
            $table->enum('donation_type', ['one-time', 'monthly'])->default('one-time');
            $table->enum('payment_method', ['card', 'mobile_money', 'bank_transfer', 'paypal']);
            $table->string('payment_id')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'pending_verification', 'cancelled'])->default('pending');
            $table->boolean('is_anonymous')->default(false);
            $table->text('message')->nullable();
            $table->text('payment_instructions')->nullable();
            $table->text('failure_reason')->nullable();
            $table->text('admin_notes')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('transaction_reference');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
};
