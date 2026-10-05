<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Customer Details
            $table->string('customer_name');
            $table->string('mobile_number', 15);

            // Dress Details
            $table->string('dress_code');

            // Booking Details
            $table->date('booking_date');
            $table->date('return_date');

            // Payment Details
            $table->decimal('advance_amount', 10, 2)->default(0);
            $table->decimal('security_deposit', 10, 2)->default(0);
            $table->string('payment_mode')->nullable();

            // Reference
            $table->string('reference_by')->nullable();

            // Amount Details
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('remaining_amount', 10, 2)->default(0);

            // Booking Status
            $table->enum('status', [
                'booked',
                'returned',
                'cancelled'
            ])->default('booked');

            // Other Details
            $table->text('notes')->nullable();
            $table->string('entry_done_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
