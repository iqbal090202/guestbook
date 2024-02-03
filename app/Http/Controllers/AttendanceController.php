<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Guests;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $datas = Attendance::all();
        return view('attendance.index', ["datas" => $datas]);
    }

    public function destroy($id)
    {
        $data = Attendance::find($id);
        $guest = Guests::find($data->guest_id);
        $guest->status = '0';
        $guest->save();

        if ($data) {
            $data->delete();
            return redirect()->route('attendance.index')->with('success', 'Data kehadiran berhasil dihapus.');
        } else {
            return redirect()->route('attendance.index')->with('error', 'Data kehadiran tidak ditemukan.');
        }
    }
}
