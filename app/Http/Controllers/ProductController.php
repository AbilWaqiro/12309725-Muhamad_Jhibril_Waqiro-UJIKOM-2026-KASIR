<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'price'  => 'required|numeric',
            'stock'   => 'required|numeric',
            'image' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('product', 'public');
        }

        Product::create([
            'name'   => $request->name,
            'price'  => $request->price,
            'stock'   => $request->stock,
            'image' => $image,
        ]);

        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'   => 'required',
            'price'  => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $image = $product->image;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $image = $request->file('image')->store('product', 'public');
        }

        $product->update([
            'name'   => $request->name,
            'price'  => $request->price,
            'image'  => $image,
        ]);

        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    public function updateStock(Request $request, Product $product)
    {
        $request->validate([
            'stock' => 'required|numeric|min:0',
        ]);

        $product->update(['stock' => $request->stock]);

        return redirect()->route('product.index')
            ->with('success', 'Stok berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}