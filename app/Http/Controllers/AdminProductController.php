<?php
namespace App\Http\Controllers;
use App\Models\{Category, Product};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class AdminProductController extends Controller {
 public function index() { return view('admin.products.index', ['products' => Product::with('category')->latest()->get()]); }
 public function create() { return view('admin.products.create', ['categories' => Category::orderBy('nama_kategori')->get()]); }
 public function show(Product $product) { return redirect()->route('admin.products.edit', $product); }
 public function store(Request $request) { $data = $request->validate(['category_id'=>'required|exists:categories,id','nama_produk'=>'required|string|max:150','harga'=>'required|integer|min:1000','deskripsi'=>'required|string|max:2000','gambar'=>'required|image|mimes:jpg,jpeg,png,webp|max:2048']); $data['gambar'] = $request->file('gambar')->store('products', 'public'); Product::create($data); return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.'); }
 public function edit(Product $product) { return view('admin.products.edit', ['product'=>$product, 'categories'=>Category::orderBy('nama_kategori')->get()]); }
 public function update(Request $request, Product $product) { $data = $request->validate(['category_id'=>'required|exists:categories,id','nama_produk'=>'required|string|max:150','harga'=>'required|integer|min:1000','deskripsi'=>'required|string|max:2000','gambar'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048']); if ($request->hasFile('gambar')) { if ($product->gambar) Storage::disk('public')->delete($product->gambar); $data['gambar'] = $request->file('gambar')->store('products', 'public'); } $product->update($data); return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.'); }
 public function destroy(Product $product) { if ($product->gambar) Storage::disk('public')->delete($product->gambar); $product->delete(); return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.'); }
}
