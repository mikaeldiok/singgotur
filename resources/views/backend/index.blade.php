@extends('backend.layouts.app')

@section('title') @lang("Dashboard") @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs/>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-8">
                <h4 class="card-title mb-0">@lang("Welcome to", ['name'=>config('app.name')])</h4>
                <div class="small text-muted">{{ date_today() }}</div>
            </div>
        </div>
        <hr>

        <!-- Dashboard Content Area -->
        <div class="col-md-6 border rounded-lg border-primary p-4 welcome-text">
          <p class="mb-0"><a href="{{route('backend.reports.create')}}" class="btn btn-lg btn-success px-3 py-2">Buat Laporan <i class="fas fa-arrow-right"></i></a></p>
        </div>
        <!-- / Dashboard Content Area -->

    </div>
</div>
@endsection
