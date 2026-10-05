```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Booking - Garba Rental</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            margin-bottom: 25px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .full-width {
            grid-column: 1 / 3;
        }

        label {
            font-weight: bold;
            margin-bottom: 7px;
        }

        input,
        select,
        textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        textarea {
            min-height: 100px;
        }

        button {
            margin-top: 25px;
            padding: 12px 25px;
            background: #222;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #444;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #222;
        }

        .error {
            background: #ffe5e5;
            color: #b00000;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('bookings.index') }}" class="back-btn">
        ← Back to Bookings
    </a>

    <h1>✏️ Edit Booking</h1>

    @if ($errors->any())
        <div class="error">
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.update', $booking) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-grid">

            <!-- Customer Name -->
            <div class="form-group">
                <label>Customer Name</label>
                <input
                    type="text"
                    name="customer_name"
                    value="{{ old('customer_name', $booking->customer_name) }}"
                    required
                >
            </div>

            <!-- Mobile Number -->
            <div class="form-group">
                <label>Mobile Number</label>
                <input
                    type="text"
                    name="mobile_number"
                    value="{{ old('mobile_number', $booking->mobile_number) }}"
                    required
                >
            </div>

            <!-- Dress Code -->
            <div class="form-group">
                <label>Dress Code</label>
                <input
                    type="text"
                    name="dress_code"
                    value="{{ old('dress_code', $booking->dress_code) }}"
                    required
                >
            </div>

            <!-- Booking Date -->
            <div class="form-group">
                <label>Booking Date</label>
                <input
                    type="date"
                    name="booking_date"
                    value="{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}"
                    required
                >
            </div>

            <!-- Return Date -->
            <div class="form-group">
                <label>Return Date</label>
                <input
                    type="date"
                    name="return_date"
                    value="{{ old('return_date', $booking->return_date->format('Y-m-d')) }}"
                    required
                >
            </div>

            <!-- Total Amount -->
            <div class="form-group">
                <label>Total Amount</label>
                <input
                    type="number"
                    step="0.01"
                    id="total_amount"
                    name="total_amount"
                    value="{{ old('total_amount', $booking->total_amount) }}"
                    required
                >
            </div>

            <!-- Advance Amount -->
            <div class="form-group">
                <label>Advance Amount</label>
                <input
                    type="number"
                    step="0.01"
                    id="advance_amount"
                    name="advance_amount"
                    value="{{ old('advance_amount', $booking->advance_amount) }}"
                >
            </div>

            <!-- Security Deposit -->
            <div class="form-group">
                <label>Security Deposit</label>
                <input
                    type="number"
                    step="0.01"
                    name="security_deposit"
                    value="{{ old('security_deposit', $booking->security_deposit) }}"
                >
            </div>

            <!-- Payment Mode -->
            <div class="form-group">
                <label>Payment Mode</label>

                <select name="payment_mode">
                    <option value="">Select Payment Mode</option>

                    <option value="Cash"
                        {{ old('payment_mode', $booking->payment_mode) == 'Cash' ? 'selected' : '' }}>
                        Cash
                    </option>

                    <option value="UPI"
                        {{ old('payment_mode', $booking->payment_mode) == 'UPI' ? 'selected' : '' }}>
                        UPI
                    </option>

                    <option value="Card"
                        {{ old('payment_mode', $booking->payment_mode) == 'Card' ? 'selected' : '' }}>
                        Card
                    </option>

                    <option value="Bank Transfer"
                        {{ old('payment_mode', $booking->payment_mode) == 'Bank Transfer' ? 'selected' : '' }}>
                        Bank Transfer
                    </option>
                </select>
            </div>

            <!-- Remaining Amount -->
            <div class="form-group">
                <label>Remaining Amount</label>

                <input
                    type="number"
                    step="0.01"
                    id="remaining_amount"
                    name="remaining_amount"
                    value="{{ old('remaining_amount', $booking->remaining_amount) }}"
                    readonly
                >
            </div>

            <!-- Reference By -->
            <div class="form-group">
                <label>Reference By</label>

                <input
                    type="text"
                    name="reference_by"
                    value="{{ old('reference_by', $booking->reference_by) }}"
                >
            </div>

            <!-- Status -->
            <div class="form-group">
                <label>Status</label>

                <select name="status" required>

                    <option value="booked"
                        {{ old('status', $booking->status) == 'booked' ? 'selected' : '' }}>
                        Booked
                    </option>

                    <option value="returned"
                        {{ old('status', $booking->status) == 'returned' ? 'selected' : '' }}>
                        Returned
                    </option>

                    <option value="cancelled"
                        {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>
                        Cancelled
                    </option>

                </select>
            </div>

            <!-- Entry Done By -->
            <div class="form-group">
                <label>Entry Done By</label>

                <input
                    type="text"
                    name="entry_done_by"
                    value="{{ old('entry_done_by', $booking->entry_done_by) }}"
                >
            </div>

            <!-- Notes -->
            <div class="form-group full-width">
                <label>Notes</label>

                <textarea name="notes">{{ old('notes', $booking->notes) }}</textarea>
            </div>

        </div>

        <button type="submit">
            💾 Update Booking
        </button>

    </form>

</div>

<script>

    const totalAmount = document.getElementById('total_amount');
    const advanceAmount = document.getElementById('advance_amount');
    const remainingAmount = document.getElementById('remaining_amount');

    function calculateRemaining() {

        let total = parseFloat(totalAmount.value) || 0;
        let advance = parseFloat(advanceAmount.value) || 0;

        let remaining = total - advance;

        if (remaining < 0) {
            remaining = 0;
        }

        remainingAmount.value = remaining.toFixed(2);
    }

    totalAmount.addEventListener('input', calculateRemaining);
    advanceAmount.addEventListener('input', calculateRemaining);

</script>

</body>
</html>
```
