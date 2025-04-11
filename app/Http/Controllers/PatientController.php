<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();

        $hospital = Hospital::all();

        return view('patient.index', compact('patients', 'hospital'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospital = Hospital::all();

        return view('patient.create', compact('hospital'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|numeric',
            'rumah_sakit' => 'required'
        ]);

        DB::beginTransaction();

        try {
            Patient::create([
                'nama_pasien' => $request->nama_pasien,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'id_rumah_sakit' => $request->rumah_sakit
            ]);

            DB::commit();

            return redirect('/patients')->with('status', 'Data pasien berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect('/patients')->with('status', 'Data pasien gagal ditambahkan');
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
        $pastient = Patient::find($id);

        $hospital = Hospital::all();

        return view('patient.edit', compact('pastient', 'hospital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|numeric',
            'rumah_sakit' => 'required'
        ]);

        $patient = Patient::find($id);

        DB::beginTransaction();

        try {
            $patient->update([
                'nama_pasien' => $request->nama_pasien,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'id_rumah_sakit' => $request->rumah_sakit
            ]);

            DB::commit();

            return redirect('/patients')->with('status', 'Data pasien berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect('/patients')->with('status', 'Data pasien gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::find($id);

        DB::beginTransaction();

        try {
            $patient->delete();
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

    public function filter(Request $request)
    {
        $query = Patient::with('hospital');

        if ($request->rsk_id) {
            $query->where('id_rumah_sakit', $request->rsk_id);
        }

        $data = $query->get();

        return response()->json($data);
    }
}
