<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $query = Product::query()->orderBy('created_at', 'asc');

            $products = $query->orderBy('id', 'desc')->paginate(5)->withQueryString();
            return view('pages.product.index', compact('products'));
        }catch(\Exception $e){
            Log::error('ProductController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.product.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'nama' => 'required',
                'hpp' => 'required|numeric|min:0',
                'margin' => 'required|numeric|min:0'
            ]);

            $harga_jual = $request->hpp + ($request->hpp * $request->margin / 100);

            Product::create([
                'nama_produk'      => $request->nama,
                'hpp'    => $request->hpp,
                'margin'    => $request->margin,
                'harga_jual' => $harga_jual,
            ]);

            return redirect()
                ->route('products.index')
                ->with('success', 'Produk berhasil ditambahkan!');
        }catch(\Exception $e){
            Log::error('ProductController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }
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
    public function edit(Product $product)
    {
        return view('pages.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'hpp' => 'required|numeric|min:0',
                'margin' => 'required|numeric|min:0'
            ]);

            $harga_jual = $request->hpp + ($request->hpp * $request->margin / 100);

            $product->update([
                'nama_produk'      => $request->nama,
                'hpp'    => $request->hpp,
                'margin'    => $request->margin,
                'harga_jual' => $harga_jual,
            ]);

            return redirect()
                ->route('products.index')
                ->with('success', 'Produk berhasil diupdate!');
        } catch(\Exception $e){
            Log::error('ProductController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try{
            $product->delete();
            return redirect()->route('products.index')->with('success','Produk berhasil dihapus');

        }catch(\Exception $e){
            Log::error('ProductController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }
    }
}
