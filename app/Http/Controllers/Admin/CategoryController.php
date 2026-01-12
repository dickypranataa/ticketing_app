<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mengambil semua data kategori
        //$categories menyimpan data kategori dalam bentuk collection
        $categories = Kategori::all();
        //mengirim data kategori ke view admin.category.index
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi input nama harus diisi
        $payload = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        //pengecekan tambahan kategori
        if (!isset($payload['nama'])) {
            return redirect()->route('categories.index')->with('error', 'Nama kategori wajib diisi.');
        }

        //menyimpan data kategori baru ke database
        Kategori::create([
            'nama' => $payload['nama'],
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validasi input nama harus diisi (string maksimal 255 karakter)
        $payload = $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        //pengecekan tambahan kategori
        if (!isset($payload['nama'])) {
            return redirect()->route('categories.index')->with('error', 'Nama kategori wajib diisi.');
        }
        //mengambil data kategori berdasarkan id (jika tidak ditemukan akan menampilkan error 404)
        $category = Kategori::findOrFail($id);
        //mengubah nilai nama data kategori
        $category->nama = $payload['nama'];
        //menyimpan perubahan data kategori ke database
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //mencari dan menghapus data kategori berdasarkan id
        Kategori::destroy($id);
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
