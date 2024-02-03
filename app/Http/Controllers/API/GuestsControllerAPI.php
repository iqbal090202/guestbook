<?php

namespace App\Http\Controllers\API;

use App\Models\Guests;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GuestsControllerAPI extends Controller
{
    public function index(Request $request)
    {
        $guests = $request->search ? Guests::where('name','LIKE',"%{$request->search}%")->get() : Guests::all();
        return response()->json([
            'data' => $guests
        ]);
    }

    public function show($id)
    {
        $attendance = Attendance::whereDate('arrival', Carbon::now()->format('Y-m-d'))->where('guest_id', $id)->first();
        if (!$attendance) {
            return response()->json([
                'message' => 'kehadiran tidak ditemukan'
            ], 404);
        }
        return response()->json(['data' => $attendance]);
    }

    public function store(Request $request)
    {
        Attendance::create([
            'guest_id' => $request->input('guest_id'),
            'message' => $request->input('message'),
            'arrival' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $guest = Guests::find($request->input('guest_id'));
        $guest->status = "1";
        $guest->save();

        return response()->json([
            'message' => 'kehadiran berhasil dibuat'
        ], 201);
    }
}
