<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
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

        if ($data) {
            $data->delete();
            return redirect()->route('attendance.index')->with('success', 'Data kehadiran berhasil dihapus.');
        } else {
            return redirect()->route('attendance.index')->with('error', 'Data kehadiran tidak ditemukan.');
        }
    }
}
