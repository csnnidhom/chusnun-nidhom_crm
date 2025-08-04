<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user_id = $user->role == 'manager' ? null : $user->id;

        $totalLeads = Customer::totalByStatus('lead', $user_id);
        $totalCustomer = Customer::totalByStatus('customer', $user_id);
        $totalWaitingApproval = Deal::totalByStatus('waiting approval', $user_id);
        $totalApproved = Deal::totalByStatus('approved', $user_id);
        $totalRejected = Deal::totalByStatus('rejected', $user_id);

        return view('pages.dashboard.dashboard', compact('totalLeads', 'totalCustomer', 'totalWaitingApproval', 'totalApproved','totalRejected'));
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
        //
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
}
