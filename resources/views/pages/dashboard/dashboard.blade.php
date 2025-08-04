@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 mt-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Customer</span>
                    <span class="info-box-number">{{ $totalCustomer }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-12 col-sm-6 mt-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-plus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Leads</span>
                    <span class="info-box-number">{{ $totalLeads }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 mt-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hourglass-half"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Waiting Approval</span>
                    <span class="info-box-number">{{ $totalWaitingApproval }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Approved</span>
                    <span class="info-box-number">{{ $totalApproved }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times-circle"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Rejected</span>
                    <span class="info-box-number">{{ $totalRejected }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
@endsection
