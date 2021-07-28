@extends('layouts.authLayout.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
         {{--  <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>

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
</div> --}}
<div class="col-md-9">
    <div class="card">
        <div class="card-header"><h4>Change your Password</h4></div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
          <form action="{!! route('changePasswordForm') !!}" method="POST">
            @csrf
            <div class="form-group">
              <label for="current_password"><strong>Current Password:</strong></label>
              <input type="password" class="form-control" id="current_password" name="current_password">
            </div>
            <!-- End Current Password Input -->
            <div class="form-group">
              <label for="new_password"><strong>New Password:</strong></label>
              <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <!-- End New Password Input -->
            <div class="form-group">
              <label for="new_password_confirmation"><strong>Confirm New Password:</strong></label>
              <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
            </div>
            <!-- End New Confirm Password Input -->
            <button class="btn btn-success" type="submit">Change Password</button>
          </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection
