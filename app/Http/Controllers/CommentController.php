<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $product_id,
            'komentar' => $request->komentar
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}