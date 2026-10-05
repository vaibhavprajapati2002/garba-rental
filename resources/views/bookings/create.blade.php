<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Add Booking | Garba Rental</title>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        color: #222;
    }

    .container {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .card {
        background: #fff;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    }

    h1 {
        margin: 0 0 30px;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        margin: 25px 0 15px;
        padding-bottom: 8px;
        border-bottom: 1px solid #ddd;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .full {
        grid-column: 1 / -1;
    }

    label {
        font-weight: 600;
        margin-bottom: 7px;
    }

    input,
    select,
    textarea {
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 7px;
        font-size: 14px;
    }

    input:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #111827;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .save-btn {
        width: 100%;
        margin-top: 30px;
        padding: 14px;
        border: none;
        border-radius: 8px;
        background: #111827;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }

    .save-btn:hover {
        background: #374151;
    }

    .alert {
        padding: 12px 15px;
        border-radius: 7px;
        margin-bottom: 20px;
    }

    .success {
        background: #dcfce7;
        color: #166534;
    }

    .error {
        background: #fee2e2;
        color: #991b1b;
    }

    @media(max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .full {
            grid-column: auto;
        }

        .card {
            padding: 20px;
        }
    }
</style>
```

</head>

<body>

<div class="container">

```
<div class="card">

    <h1>➕ Add Booking</h1>

    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert error">
            <strong>Please fix these errors:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST">

        @csrf

        <!-- Customer Details -->

        <div class="section-title">
            Customer Details
        </div>

        <div class="form-grid">

            <div class="form-group">
                <label>Customer Name *</label>

                <input
                    type="text"
                    name="customer_name"
                    value="{{ old('customer_name') }}"
                    placeholder="Enter customer name"
                    required
                >
            </div>

            <div class="form-group">
                <label>Mobile Number *</label>

                <input
                    type="tel"
                    name="mobile_number"
                    value="{{ old('mobile_number') }}"
                    placeholder="Enter mobile number"
                    maxlength="15"
                    required
                >
            </div>

        </div>


        <!-- Dress Details -->

        <div class="section-title">
            Dress Details
        </div>

        <div class="form-grid">

            <div class="form-group">
                <label>Dress Code *</label>

                <input
                    type="text"
                    name="dress_code"
                    value="{{ old('dress_code') }}"
                    placeholder="Example: GC-001"
                    required
                >
            </div>

        </div>


        <!-- Booking Details -->

        <div class="section-title">
            Booking Details
        </div>

        <div class="form-grid">

            <div class="form-group">
                <label>Booking Date *</label>

                <input
                    type="date"
                    name="booking_date"
                    value="{{ old('booking_date') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Return Date *</label>

                <input
                    type="date"
                    name="return_date"
                    value="{{ old('return_date') }}"
                    required
                >
            </div>

        </div>


        <!-- Payment Details -->

        <div class="section-title">
            Payment Details
        </div>

        <div class="form-grid">

            <div class="form-group">
                <label>Total Amount *</label>

                <input
                    type="number"
                    step="0.01"
                    id="total_amount"
                    name="total_amount"
                    value="{{ old('total_amount', 0) }}"
                    placeholder="₹ 0"
                    required
                >
            </div>

            <div class="form-group">
                <label>Advance Amount</label>

                <input
                    type="number"
                    step="0.01"
                    id="advance_amount"
                    name="advance_amount"
                    value="{{ old('advance_amount', 0) }}"
                    placeholder="₹ 0"
                >
            </div>

            <div class="form-group">
                <label>Security Deposit</label>

                <input
                    type="number"
                    step="0.01"
                    name="security_deposit"
                    value="{{ old('security_deposit', 0) }}"
                    placeholder="₹ 0"
                >
            </div>

            <div class="form-group">
                <label>Payment Mode</label>

                <select name="payment_mode">

                    <option value="">Select Payment Mode</option>

                    <option value="Cash">Cash</option>
                    <option value="UPI">UPI</option>
                    <option value="Card">Card</option>
                    <option value="Bank Transfer">Bank Transfer</option>

                </select>
            </div>

            <div class="form-group">
                <label>Remaining Amount</label>

                <input
                    type="number"
                    step="0.01"
                    id="remaining_amount"
                    name="remaining_amount"
                    value="{{ old('remaining_amount', 0) }}"
                    readonly
                >
            </div>

            <div class="form-group">
                <label>Reference By</label>

                <input
                    type="text"
                    name="reference_by"
                    value="{{ old('reference_by') }}"
                    placeholder="Reference person"
                >
            </div>

        </div>


        <!-- Other Details -->

        <div class="section-title">
            Other Details
        </div>

        <div class="form-grid">

            <div class="form-group">
                <label>Status *</label>

                <select name="status" required>

                    <option value="booked">Booked</option>
                    <option value="returned">Returned</option>
                    <option value="cancelled">Cancelled</option>

                </select>
            </div>

            <div class="form-group">
                <label>Entry Done By</label>

                <input
                    type="text"
                    name="entry_done_by"
                    value="{{ old('entry_done_by') }}"
                    placeholder="Staff name"
                >
            </div>

            <div class="form-group full">
                <label>Notes</label>

                <textarea
                    name="notes"
                    placeholder="Enter additional notes..."
                >{{ old('notes') }}</textarea>
            </div>

        </div>


        <button type="submit" class="save-btn">
            💾 Save Booking
        </button>

    </form>

</div>
```

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
