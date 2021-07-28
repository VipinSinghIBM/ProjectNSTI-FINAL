@extends('layouts.authLayout.app')

@section('content')


@if (Auth::user()->certRemarks)

<div class="container">


    <div class="alert alert-warning alert-dismissible fade show">
        <h5 class="alert-heading font-weight-bold "><i class="fas fa-exclamation-triangle"></i> Your Documents has been Rejected ,Please Re-Upload!</h5>
<p class="font-weight-bold font-italic mt-3">{{ Auth::user()->certRemarks }}</p>
        <p>Please Re Upload your Documents and please check you cleared the above rejection reaseons before proceeding. </p>
        <hr>
        <p class="mb-0">Click here to Upload the Documents<a href="" style="text-decoration:none; color:#8D5024;"> <i class="fas fa-upload "></i> </a></p>
        {{-- <button type="button" class="close" data-dismiss="alert">&times;</button> --}}
    </div>

    {{-- <div id="userApp">
        <documents-reupload></documents-reupload>
    </div> --}}

</div>



{{--
@if(Auth::user()->address)

<div class="container text-center">

    <div class="card border-success mb-3" >
        <div class="card-header bg-transparent border-success ">Congratulations  <strong>{{ Auth::user()->name }}</strong></div>
        <div class="card-body text-success">
          <h5 class="card-title "><strong>Your Application Has Been Submitted Successfully</strong></h5>
          <p class="card-text ">Please Wait For Further Updates...</p>
        </div>
        <div class="card-footer bg-transparent border-success ">NSTI Calicut </div>
      </div>


    </div>



@else --}}
<div id="userApp">

    <password-change></password-change>
    <documents-reupload></documents-reupload>


</div>
@elseif(Auth::user()->address)
<div class="container text-center">

    <div class="card border-success mb-3" >
        <div class="card-header bg-transparent border-success ">Congratulations  <strong>{{ Auth::user()->name }}</strong></div>
        <div class="card-body text-success">
          <h5 class="card-title "><strong>Your Application Has Been Submitted Successfully</strong></h5>
          <p class="card-text ">Please Wait For Further Updates...</p>
        </div>
        <div class="card-footer bg-transparent border-success ">NSTI Calicut </div>
      </div>


    </div>

@else
<div class="container-fluid ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ "You Are Successfully Registered  " .  Auth::user()->name}}</div>

                <div class="card-body mt-5 mb-5 ">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Click Here To Fill Up Your Application Form     ') }}

                    <a href="{{ route('user.dashboard') }}">
                    <button type="button" class="btn btn-outline-success btn-sm ml-5">Application Form</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @endif --}}

<div id="userApp">
    <password-change></password-change>

</div>

@endif

@endsection
