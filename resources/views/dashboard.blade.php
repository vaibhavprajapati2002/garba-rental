```blade
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Garba Rental</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #111827;
        }

        .navbar {
            background: #111827;
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h1 {
            margin-bottom: 5px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            margin: 0 0 12px;
            color: #6b7280;
            font-size: 16px;
        }

        .number {
            font-size: 32px;
            font-weight: bold;
        }

        .dashboard-sections {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 30px;
        }

        .booking-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .booking-table th,
        .booking-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            font-size: 14px;
        }

        .booking-table th {
            color: #6b7280;
            font-size: 13px;
        }

        .booking-table tr:last-child td {
            border-bottom: none;
        }

        .no-data {
            color: #6b7280;
            margin-top: 15px;
        }

        .actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            background: #111827;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn.secondary {
            background: #2563eb;
        }

        .return-date {
            font-weight: bold;
        }

        @media (max-width: 768px) {

            .cards {
                grid-template-columns: 1fr;
            }

            .dashboard-sections {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column;
                gap: 10px;
            }

            .navbar a {
                margin-left: 8px;
                margin-right: 8px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                text-align: center;
            }

            .card {
                overflow-x: auto;
            }
        }
    </style>

</head>

<body>

    <!-- Navbar -->

    <div class="navbar">

        <h2>🎀 Garba Rental</h2>

        <div>
            <a href="{{ route('dashboard') }}">Dashboard</a>

            <a href="{{ route('bookings.index') }}">
                Bookings
            </a>

            <a href="{{ route('bookings.create') }}">
                Add Booking
            </a>
        </div>

    </div>


    <!-- Main Container -->

    <div class="container">

        <!-- Welcome -->

        <div class="welcome">

            <h1>📊 Dashboard</h1>

            <p>
                Welcome to your Garba Dress Rental Management System.
            </p>

        </div>


        <!-- Statistics Cards -->

        <div class="cards">

            <!-- Total Bookings -->

            <div class="card">

                <h3>📋 Total Bookings</h3>

                <div class="number">
                    {{ $totalBookings }}
                </div>

            </div>


            <!-- Active Bookings -->

            <div class="card">

                <h3>📅 Active Bookings</h3>

                <div class="number">
                    {{ $bookedBookings }}
                </div>

            </div>


            <!-- Returned -->

            <div class="card">

                <h3>✅ Returned</h3>

                <div class="number">
                    {{ $returnedBookings }}
                </div>

            </div>


            <!-- Cancelled -->

            <div class="card">

                <h3>❌ Cancelled</h3>

                <div class="number">
                    {{ $cancelledBookings }}
                </div>

            </div>


            <!-- Total Collection -->

            <div class="card">

                <h3>💰 Total Collection</h3>

                <div class="number">
                    ₹{{ number_format($totalCollection, 2) }}
                </div>

            </div>


            <!-- Remaining Amount -->

            <div class="card">

                <h3>💵 Remaining Amount</h3>

                <div class="number">
                    ₹{{ number_format($totalRemaining, 2) }}
                </div>

            </div>

        </div>


        <!-- Today's Bookings + Upcoming Returns -->

        <div class="dashboard-sections">


            <!-- Today's Bookings -->

            <div class="card">

                <h3>📅 Today's Bookings</h3>

                @if($todayBookings->count() > 0)

                    <table class="booking-table">

                        <thead>

                            <tr>
                                <th>Customer</th>
                                <th>Dress</th>
                                <th>Date</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($todayBookings as $booking)

                                <tr>

                                    <td>
                                        {{ $booking->customer_name }}
                                    </td>

                                    <td>
                                        {{ $booking->dress_code }}
                                    </td>

                                    <td>
                                        {{ $booking->booking_date->format('d-m-Y') }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                @else

                    <p class="no-data">
                        No bookings for today.
                    </p>

                @endif

            </div>


            <!-- Upcoming Returns -->

            <div class="card">

                <h3>🔄 Upcoming Returns</h3>

                @if($upcomingReturns->count() > 0)

                    <table class="booking-table">

                        <thead>

                            <tr>
                                <th>Customer</th>
                                <th>Dress</th>
                                <th>Return Date</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($upcomingReturns as $booking)

                                <tr>

                                    <td>
                                        {{ $booking->customer_name }}
                                    </td>

                                    <td>
                                        {{ $booking->dress_code }}
                                    </td>

                                    <td class="return-date">
                                        {{ $booking->return_date->format('d-m-Y') }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                @else

                    <p class="no-data">
                        No upcoming returns.
                    </p>

                @endif

            </div>

        </div>


        <!-- Action Buttons -->

        <div class="actions">

            <a
                href="{{ route('bookings.create') }}"
                class="btn"
            >
                ➕ Add New Booking
            </a>


            <a
                href="{{ route('bookings.index') }}"
                class="btn secondary"
            >
                📋 View All Bookings
            </a>

        </div>

    </div>

</body>

</html>
```
