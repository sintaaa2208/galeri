@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Katalog Produk</h2>
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('products.create') }}" class="btn btn-success">Tambah Foto Produk</a>
    @endif
</div>

<div class="row">
    @foreach($products as $p)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('storage/' . $p->foto) }}" 
                     class="card-img-top bg-light" 
                     alt="{{ $p->nama_produk }}" 
                     style="height: 250px; object-fit: cover;">
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold">{{ $p->nama_produk }}</h5>
                    <p class="card-text text-muted mb-4" style="font-size: 0.9rem;">
                        {{ Str::limit($p->deskripsi, 100) }}
                    </p>
                    
                    <div class="mt-auto">
                        <a href="{{ route('products.show', $p->id) }}" class="btn btn-info text-white w-100 mb-2">Lihat Detail & Komentar</a>
                        
                        @if(Auth::user()->role === 'admin')
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning flex-fill">Edit</a>
                                <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="flex-fill" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">Hapus</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection