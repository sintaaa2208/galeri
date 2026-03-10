<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') abort(403, 'Akses Ditolak');
        return view('products.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403, 'Akses Ditolak');

        $request->validate([
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // PERBAIKAN: Menggunakan parameter disk 'public' langsung
        // Ini otomatis menyimpan ke storage/app/public/produk_foto
        $fotoPath = $request->file('foto')->store('produk_foto', 'public');

        Product::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath // Tersimpan di database murni: produk_foto/namafileacak.jpg
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $product = Product::with('comments.user')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') abort(403, 'Akses Ditolak');
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403, 'Akses Ditolak');

        $product = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // PERBAIKAN: Hapus foto lama menggunakan disk 'public'
            if ($product->foto) {
                Storage::disk('public')->delete($product->foto);
            }
            
            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('produk_foto', 'public');
            $product->foto = $fotoPath;
        }

        $product->nama_produk = $request->nama_produk;
        $product->deskripsi = $request->deskripsi;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') abort(403, 'Akses Ditolak');

        $product = Product::findOrFail($id);
        
        // PERBAIKAN: Hapus file fisik gambar menggunakan disk 'public'
        if ($product->foto) {
            Storage::disk('public')->delete($product->foto);
        }
        
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}