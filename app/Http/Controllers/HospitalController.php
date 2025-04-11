<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // show data use model hospital
        $hospitals = Hospital::all();

        return view('hospital.index', compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hospital.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_rumah_sakit' => 'required|unique:hospitals,nama_rumah_sakit',
            'alamat' => 'required',
            'email' => 'required|email',
            'telepon' => 'required|numeric'
        ]);

        DB::beginTransaction();

        try {
            Hospital::create([
                'nama_rumah_sakit' => $request->nama_rumah_sakit,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'telepon' => $request->telepon
            ]);
            DB::commit();

            return redirect('/hospitals')->with('status', 'Data rumah sakit berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/hospitals')->with('status', 'Data rumah sakit gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hospital = Hospital::find($id);

        return view('hospital.edit', compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_rumah_sakit' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'telepon' => 'required|numeric'
        ]);

        $hospital = Hospital::find($id);

        DB::beginTransaction();

        try {
            $hospital->update([
                'nama_rumah_sakit' => $request->nama_rumah_sakit,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'telepon' => $request->telepon
            ]);

            DB::commit();

            return redirect('/hospitals')->with('status', 'Data rumah sakit berhasil diedit');
        } catch (\Exception $th) {
            DB::rollBack();

            return redirect('/hospitals')->with('status', 'Data rumah sakit gagal diedit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hospital = Hospital::find($id);

        DB::beginTransaction();

        try {
            $hospital->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'success'
            ]);
        } catch (\Exception $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'failed'
            ]);
        }
    }
}
