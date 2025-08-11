<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class Reservationcontroller extends Controller
{
    public function index()
    {
        $reservations = Reservation::paginate(4);
        return view('admin.reservation.index', compact('reservations'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'guest'   => 'nullable|integer|min:1',
            'time'    => 'nullable',
            'date'    => 'nullable|date',
            'message' => 'nullable|string|max:500',
        ]);

        $reservation = new Reservation();
        $reservation->name = $request->name;
        $reservation->email = $request->email;
        $reservation->phone = $request->phone;
        $reservation->guest = $request->guest;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->message = $request->message;
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation made successfully!');
    }


}
