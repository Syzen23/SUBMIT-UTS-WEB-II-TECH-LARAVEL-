<?php
namespace App\Http\Controllers;
use App\Models\{Category, Product};
use Illuminate\Http\Request;
class PublicController extends Controller {
 public function index(Request $request) { $categories = Category::orderBy('nama_kategori')->get(); $products = Product::with('category')->when($request->filled('category'), fn($q) => $q->where('category_id', $request->integer('category')))->latest()->get(); return view('public.index', compact('categories', 'products')); }
 public function show(Product $product) { $product->load('category'); return view('public.show', compact('product')); }
}
