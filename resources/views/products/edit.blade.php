@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white"><h4>Edit Foto Produk</h4></div>
    <div class="card-body">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="{{ $product->nama_produk }}" required>
            </div>
            <div class="mb-3">
                <label>Foto Produk Baru (Biarkan kosong jika tidak ingin mengubah)</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="form-control" required>{{ $product->deskripsi }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection