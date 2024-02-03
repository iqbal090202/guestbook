<?php

namespace App\Http\Controllers;

use App\Models\Guests;
use Illuminate\Http\Request;

class GuestsController extends Controller
{
    public function index()
    {
        $guests = Guests::all();
        return view('guest.index', ["guests" => $guests]);
    }

    public function create()
    {
        return view('guest.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        Guests::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('guest.index')->with('success', 'Data tamu berhasil disimpan.');
    }

    public function edit($id)
    {
        $guest = Guests::find($id);
        return view('guest.edit', ["guest" => $guest]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        $guest = Guests::find($id);
        $guest->name = $request->input('name');
        $guest->email = $request->input('email');
        $guest->address = $request->input('address');
        $guest->save();

        return redirect()->route('guest.index')->with('success', 'Data tamu berhasil diperbarui.');
    }

    public function nonactive() {
        $guests = Guests::where('status', '1')->update(['status' => '0']);
        if ($guests > 0) {
            return redirect()->route('guest.index')->with('success', 'Data tamu berhasil diperbarui.');
        }
        return redirect()->route('guest.index')->with('warning', 'Semua tamu sudah nonaktif.');
    }

    public function destroy($id)
    {
        $guest = Guests::find($id);

        if ($guest) {
            $guest->delete();
            return redirect()->route('guest.index')->with('success', 'Data tamu berhasil dihapus.');
        } else {
            return redirect()->route('guest.index')->with('error', 'Data tamu tidak ditemukan.');
        }
    }
}
