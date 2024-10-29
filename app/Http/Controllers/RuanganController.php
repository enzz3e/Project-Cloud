<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RuanganController extends Controller
{
    public function index($lantai = 'Lantai 1')
    {
        return redirect()->route('showLantai', ['lantai' => 'Lantai 1']);
    }

    /**
     * Manage Lantai
     */
    public function showLantai($lantai)
    {
        confirmDelete();
        $title = "Ruangan";
        $dataRuangan = Ruangan::where('lantai', $lantai)->get();

        // Redirect
        return view('dashboard.Sarpra.DataRuangan', compact('dataRuangan', 'lantai', 'title'));
    }

    /**
     * To form create
     */
    public function create(Request $request)
    {
        $title = "Tambah Ruangan";
        $lantai = $request->query('lantai', 'Lantai 1');

        // Redirect
        return view('dashboard.Sarpra.createRuangan', compact('title', 'lantai'));
    }

    /**
     * Add data to database
     */
    public function store(Request $request)
    {
        // Pesan validasi kustom
        $messages = [
            'required' => ':Attribute harus diisi.',
            'in' => ':Attribute harus salah satu dari :values.',
            'string' => ':Attribute harus berupa teks.',
            'max' => ':Attribute tidak boleh lebih dari :max karakter.',
        ];

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'lantai' => 'required|in:Lantai 1,Lantai 2,Lantai 3',
        ], $messages);

        // Jika validasi gagal, kembalikan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data ke database
        $ruangan = new Ruangan();
        $ruangan->nama = $request->input('nama');
        $ruangan->deskripsi = $request->input('deskripsi');
        $ruangan->lantai = $request->input('lantai');
        $ruangan->save();

        // Redirect dengan pesan sukses
        Alert::success('Berhasil di Tambahkan', 'Data berhasil ditambahkan.');
        return redirect()->route('showLantai', $ruangan->lantai);
    }

    /**
     * See data (Pop Up)
     */
    public function show(string $id)
    {
    }

    /**
     * To form update
     */
    public function edit(string $id)
    {
        // Find ruangan by id
        $ruangan = Ruangan::query()->find((int)$id);
        $lantai = $ruangan->lantai;
        $title = "Edit Ruangan";

        // Redirect
        return view('dashboard.Sarpra.EditRuangan', data: compact(['ruangan', 'title', 'lantai']));
    }

    /**
     * Action update data
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'in' => ':Attribute harus salah satu dari :values.',
            'string' => ':Attribute harus berupa teks.',
            'max' => ':Attribute tidak boleh lebih dari :max karakter.',
        ];

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'lantai' => 'required|in:Lantai 1,Lantai 2,Lantai 3',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // First find by id
        $ruangan = Ruangan::findOrFail($id);

        // Update data use fill
        $ruangan->fill($request->only(['nama', 'deskripsi', 'lantai']));
        $ruangan->save();

        Alert::success('Berhasil di Ubah', 'Data berhasil diperbarui.');
        // Redirect
        return redirect()->route('showLantai', $ruangan->lantai);
    }


    /**
     * Remove data
     */
    public function destroy(string $id)
    {
        // Find by id
        $findRuangan = Ruangan::findOrFail((int)$id);
        $lantai = $findRuangan->lantai;

        // Delete ruangan
        $findRuangan->delete();

        Alert::success('Data Telah di Hapus', 'Data Berhasil di Hapus.');
        // Redirect
        return redirect()->route('showLantai', $lantai);
    }
}
