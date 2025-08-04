<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Customer::with('user')->orderBy('created_at', 'asc');

        try{
            if (Auth::user()->role != 'manager') {
                $query->where('user_id', Auth::id());
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $customers = $query->orderBy('id','desc')->paginate(5)->withQueryString();

            return view('pages.customers.index', compact('customers'));
        }catch(\Exception $e){
            Log::error('CustomerController : ' .$e->getMessage());
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
        return view('pages.customers.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'kontak' => 'required|numeric|min:0',
            'alamat' => 'required'
        ]);

        try {
            Customer::create([
                'user_id'   => Auth::id(),
                'nama'      => $request->nama,
                'kontak'    => $request->kontak,
                'alamat'    => $request->alamat,
                'kebutuhan' => $request->kebutuhan,
            ]);

            return redirect()
                ->route('customers.index')
                ->with('success', 'Customer berhasil ditambahkan!');
                
        }catch(\Exception $e){
            Log::error('CustomerController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('pages.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        try {
            $request->validate([
                'nama'      => 'required',
                'kontak'    => 'required|numeric|min:0',
                'alamat'    => 'required',
            ]);

            $customer->update([
                'nama'      => $request->nama,
                'kontak'    => $request->kontak,
                'alamat'    => $request->alamat,
                'kebutuhan' => $request->kebutuhan,
            ]);

            return redirect()
                ->route('customers.index')
                ->with('success', 'Customer berhasil diupdate!');
        } catch(\Exception $e){
            Log::error('CustomerController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try{
            $customer->delete();
            return redirect()->route('customers.index')->with('success','Customer berhasil dihapus');
        }catch(\Exception $e){
            Log::error('CustomerController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }

    }
}
