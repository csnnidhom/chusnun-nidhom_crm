<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Customer;
use App\Models\Deal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
    public function update(Request $request)
    {
        try{
            $status_approval = $request->input('status');
            $notes = $request->input('notes');
            $deal_id = $request->input('deal_id');
            $customer_id = $request->input('customer_id');
            
            if ($status_approval == 'approved'){
                $notes = 'Approved oleh Manager';

                Customer::where('id', $customer_id)
                    ->update(['status' => 'customer']);

                Approval::create([
                    'deal_id' => $request->deal_id,
                    'user_id' => Auth::id(),
                    'action' => $status_approval,
                    'notes' => $notes
                ]);
            }else{
                Approval::create([
                    'deal_id' => $request->deal_id,
                    'user_id' => Auth::id(),
                    'action' => $status_approval,
                    'notes' => $notes
                ]);
            }

            $deal = Deal::find($deal_id);
            $deal->update(['status' => $status_approval]);
            
            return redirect()->route('deals.index')
                            ->with('success', "Deal berhasil di-$status_approval");
        }catch(\Exception $e){
            Log::error('ApprovalController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
