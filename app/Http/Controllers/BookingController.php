<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Show Dashboard.
     */
    public function dashboard()
    {
        $today = now()->toDateString();

        // Booking statistics
        $totalBookings = Booking::count();

        $bookedBookings = Booking::where('status', 'booked')->count();

        $returnedBookings = Booking::where('status', 'returned')->count();

        $cancelledBookings = Booking::where('status', 'cancelled')->count();

        // Payment statistics
        $totalCollection = Booking::where('status', '!=', 'cancelled')
            ->sum('advance_amount');

        $totalRemaining = Booking::where('status', '!=', 'cancelled')
            ->sum('remaining_amount');

        // Today's bookings
        $todayBookings = Booking::whereDate('booking_date', $today)
            ->where('status', 'booked')
            ->latest()
            ->get();

        // Upcoming returns
        $upcomingReturns = Booking::where('status', 'booked')
            ->whereDate('return_date', '>=', $today)
            ->orderBy('return_date', 'asc')
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalBookings',
            'bookedBookings',
            'returnedBookings',
            'cancelledBookings',
            'totalCollection',
            'totalRemaining',
            'todayBookings',
            'upcomingReturns'
        ));
    }


    /**
     * Show Add Booking form.
     */
    public function create()
    {
        return view('bookings.create');
    }


    /**
     * Show all bookings.
     */
    public function index()
    {
        $bookings = Booking::latest()->get();

        return view('bookings.index', compact('bookings'));
    }


    /**
     * Store a new booking.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'dress_code' => 'required|string|max:100',
            'booking_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:booking_date',
            'advance_amount' => 'nullable|numeric|min:0',
            'security_deposit' => 'nullable|numeric|min:0',
            'payment_mode' => 'nullable|string|max:50',
            'reference_by' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'remaining_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:booked,returned,cancelled',
            'notes' => 'nullable|string',
            'entry_done_by' => 'nullable|string|max:255',
        ]);

        Booking::create($validated);

        return redirect()
            ->route('bookings.create')
            ->with('success', 'Booking added successfully!');
    }


    /**
     * Show edit booking form.
     */
    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }


    /**
     * Update booking.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'dress_code' => 'required|string|max:100',
            'booking_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:booking_date',
            'advance_amount' => 'nullable|numeric|min:0',
            'security_deposit' => 'nullable|numeric|min:0',
            'payment_mode' => 'nullable|string|max:50',
            'reference_by' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'remaining_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:booked,returned,cancelled',
            'notes' => 'nullable|string',
            'entry_done_by' => 'nullable|string|max:255',
        ]);

        $booking->update($validated);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking updated successfully!');
    }


    /**
     * Delete booking.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking deleted successfully!');
    }


    /**
     * Search bookings.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $bookings = Booking::query()
            ->when($search, function ($query) use ($search) {

                $query->where('customer_name', 'like', '%' . $search . '%')
                    ->orWhere('mobile_number', 'like', '%' . $search . '%')
                    ->orWhere('dress_code', 'like', '%' . $search . '%');

            })
            ->latest()
            ->get();

        return view('bookings.index', compact(
            'bookings',
            'search'
        ));
    }
}

