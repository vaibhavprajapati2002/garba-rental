```blade
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bookings | Garba Rental</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #111827;
            color: white;
        }

        tr:hover {
            background: #f9fafb;
        }

        .edit-btn {
            text-decoration: none;
            color: #2563eb;
            margin-right: 8px;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="card">


            <h1>📋 All Bookings</h1>

            <form action="{{ route('bookings.search') }}" method="GET"
                style="display:flex; gap:10px; margin-bottom:20px;">

                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Search customer, mobile or dress code..."
                    style="flex:1; padding:10px; border:1px solid #ccc; border-radius:5px;">

                <button type="submit"
                    style="padding:10px 20px; background:#111827; color:white; border:none; border-radius:5px; cursor:pointer;">
                    🔍 Search
                </button>

                <a href="{{ route('bookings.index') }}"
                    style="padding:10px 20px; background:#6b7280; color:white; text-decoration:none; border-radius:5px;">
                    Reset
                </a>

            </form>

            @if (session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Mobile</th>
                        <th>Dress Code</th>
                        <th>Booking Date</th>
                        <th>Return Date</th>
                        <th>Total</th>
                        <th>Advance</th>
                        <th>Remaining</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($bookings as $booking)
                        <tr>

                            <td>{{ $booking->id }}</td>

                            <td>{{ $booking->customer_name }}</td>

                            <td>{{ $booking->mobile_number }}</td>

                            <td>{{ $booking->dress_code }}</td>

                            <td>{{ $booking->booking_date->format('d-m-Y') }}</td>

                            <td>{{ $booking->return_date->format('d-m-Y') }}</td>

                            <td>₹{{ number_format($booking->total_amount, 2) }}</td>

                            <td>₹{{ number_format($booking->advance_amount, 2) }}</td>

                            <td>₹{{ number_format($booking->remaining_amount, 2) }}</td>

                            <td>{{ ucfirst($booking->status) }}</td>

                            <td>

                                <a href="{{ route('bookings.edit', $booking) }}" class="edit-btn">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this booking?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="delete-btn">
                                        🗑️ Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="11">
                                No bookings found.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>
```
