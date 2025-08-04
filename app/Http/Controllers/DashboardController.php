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
        $totalLeads = Customer::totalByStatus('lead', Auth::id());
        $totalCustomer = Customer::totalByStatus('customer', Auth::id());
        $totalWaitingApproval = Deal::totalByStatus('waiting approval', Auth::id());
        $totalApproved = Deal::totalByStatus('approved', Auth::id());
        $totalRejected = Deal::totalByStatus('rejected', Auth::id());

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
