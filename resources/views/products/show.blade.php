@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0">
            <img src="{{ asset('storage/' . $product->foto) }}" 
                 class="card-img-top bg-light" 
                 alt="{{ $product->nama_produk }}">
                 
            <div class="card-body">
                <h3 class="card-title fw-bold">{{ $product->nama_produk }}</h3>
                <p class="card-text" style="white-space: pre-wrap;">{{ $product->deskripsi }}</p>
                <a href="{{ route('products.index') }}" class="btn btn-secondary mt-2">Kembali ke Katalog</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Komentar</h5></div>
            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                @forelse($product->comments as $komentar)
                    <div class="mb-3 border-bottom pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong class="{{ $komentar->user->role === 'admin' ? 'text-danger' : 'text-primary' }}">
                                {{ $komentar->user->name }}
                            </strong>
                            <small class="text-muted">{{ $komentar->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-0 text-dark">{{ $komentar->komentar }}</p>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        <p class="mb-0">Belum ada komentar pada produk ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('comments.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tambahkan Komentar Baru</label>
                        <textarea name="komentar" rows="3" class="form-control" placeholder="Tulis komentar Anda di sini..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Kirim Komentar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection