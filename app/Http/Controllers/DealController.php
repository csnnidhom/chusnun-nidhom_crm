<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Customer;
use App\Models\Deal;
use App\Models\DealItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $query = Deal::with(['customer','items.product','user'])->orderBy('created_at', 'asc');

            if (Auth::user()->role != 'manager') {
                $query->where('user_id', Auth::id());
            }
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('customer_name')) {
                $query->whereHas('customer', function($q) use ($request) {
                    $q->where('nama', 'like', '%'.$request->customer_name.'%');
                });
            }

            if (request('start_date') && request('end_date')) {
                $query->whereDate('created_at', '>=', request('start_date'))
                    ->whereDate('created_at', '<=', request('end_date'));
            }

            $deals = $query->orderBy('id','desc')
                        ->paginate(5)
                        ->withQueryString();

            return view('pages.deals.index', compact('deals'));
        }catch(\Exception $e){
            Log::error('DealController : ' .$e->getMessage());
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
        try{
            $customers = Auth::user()->role === 'manager'
                ? Customer::all()
                : Customer::where('user_id', Auth::id())->get();

            $products = Product::all();

            return view('pages.deals.add', compact('customers','products'));
        }catch(\Exception $e){
            Log::error('DealController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.harga_deal' => 'required|numeric',
            ]);

            DB::transaction(function () use ($request) {
                $status_approval = 'approved';

                $deal = Deal::create([
                    'customer_id' => $request->customer_id,
                    'status' => 'waiting approval',
                    'total_harga' => 0,
                    'user_id'   => Auth::id()
                ]);

                $total = 0;

                foreach ($request->items as $item) {
                    $product = Product::find($item['product_id']);

                    $total += $item['harga_deal'];

                    if($item['harga_deal'] < $product->harga_jual){
                        $status_approval = 'waiting approval';
                    }

                    DealItem::create([
                        'deal_id' => $deal->id,
                        'product_id' => $item['product_id'],
                        'harga_deal' => $item['harga_deal'],
                    ]);
                }

                $deal->update([
                    'total_harga' => $total,
                    'status' => $status_approval
                ]);

                if ($status_approval === 'approved') {
                    Customer::where('id', $request->customer_id)
                        ->update(['status' => 'customer']);

                    Approval::create([
                        'deal_id' => $deal->id,
                        'user_id' => Auth::id(),
                        'action' => $status_approval,
                        'notes' => 'Harga deal >= harga jual, otomatis approved'
                    ]);
                }

            });

            return redirect()->route('deals.index')->with('success','Deal berhasil dibuat.');

        }catch(\Exception $e){
            Log::error('DealController : ' .$e->getMessage());
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
        try{
            $deal = Deal::with(['customer', 'items.product'])->findOrFail($id);

            return view('pages.deals.show', compact('deal'));
        }catch(\Exception $e){
            Log::error('DealController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export()
    {
        try{
            $query = Deal::with(['customer', 'items.product', 'user']);

            if (Auth::user()->role != 'manager') {
                $query->where('user_id', Auth::id());
            }

            if (request('status')) {
                $query->where('status', request('status'));
            }

            if (request('customer_name')) {
                $query->whereHas('customer', function($q) {
                    $q->where('nama', 'like', '%' . request('customer_name') . '%');
                });
            }
            if (request('start_date') && request('end_date')) {
                $query->whereDate('created_at', '>=', request('start_date'))
                    ->whereDate('created_at', '<=', request('end_date'));
            }

            $deals = $query->orderBy('id','desc')->get();

            $output = "No\tCustomer\tProduk\tTotal Harga\tStatus\tTanggal Dibuat\n";

            foreach ($deals as $i => $deal) {
                $produkList = $deal->items->pluck('product.nama_produk')->implode(', ');
                $output .= ($i+1)."\t".
                    $deal->customer->nama."\t".
                    $produkList."\t".
                    $deal->total_harga."\t".
                    $deal->status."\t".
                    $deal->created_at->format('d-M-Y')."\n";
            }

            return response($output)
                ->header('Content-Type', 'application/vnd.ms-excel')
                ->header('Content-Disposition', 'attachment; filename="laporan_deals.xls"');
        }catch(\Exception $e){
            Log::error('DealController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }
        
    }




}
