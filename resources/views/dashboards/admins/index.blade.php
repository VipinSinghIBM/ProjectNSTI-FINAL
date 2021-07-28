{{-- @extends('layouts.authLayout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard (Index Page)') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!')  }} <h4>Welcome  {{ Auth::user()->name }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','NSTI CALICUT - Admin ')

@section('content')


<router-view></router-view>
<vue-progress-bar></vue-progress-bar>



@endsection




