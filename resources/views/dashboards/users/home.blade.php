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
<div id="userApp">

    <password-change></password-change>
    <documents-reupload></documents-reupload>


</div>
@elseif(Auth::user()->formNextStatus ==2)

<div class="container col-md-6">
<div class="card ">
    <div class="card-header text-center">
      <h5 class="mb-4"> Application Form Status</h5>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item h6">Personal Details<span class="float-right badge badge-pill badge-success">Submited <i class="far fa-check-circle fa-fw fa-lg"></i> </span></li>
      <li class="list-group-item h6">Educational Qualification Details <a href="{{ route('user.dashboard') }}"><button href="#" type="button" class="btn btn-primary btn-sm float-right" style="border-radius:23px;"> Fill Form</button></a></span></li>
      <li class="list-group-item h6">Experience Details<button type="button" class="btn btn-info btn-sm float-right  disabled" style="border-radius:23px;" > Fill Form</button></span></li>
      <li class="list-group-item h6">Documents Upload<button type="button" class="btn btn-info btn-sm float-right  disabled" style="border-radius:23px;" > Fill Form</button></span></li>
    </ul>
  </div>
</div>


@elseif(Auth::user()->formNextStatus ==3)

<div class="container col-md-6">
<div class="card ">
    <div class="card-header text-center">
      <h5 class="mb-4"> Application Form Status</h5>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item h6">Personal Details<span class="float-right badge badge-pill badge-success">Submited <i class="far fa-check-circle fa-fw fa-lg"></i> </span></li>
      <li class="list-group-item h6">Educational Qualification Details <span class="float-right badge badge-pill badge-success">Submited <i class="far fa-check-circle fa-fw fa-lg"></i> </span></li>

      <li class="list-group-item h6">Experience Details <a href="{{ route('user.dashboard') }}"><button type="button" class="btn btn-info btn-sm float-right" style="border-radius:23px;" > Fill Form</button></a></span></li>
      <li class="list-group-item h6">Documents Upload<button type="button" class="btn btn-info btn-sm float-right  disabled" style="border-radius:23px;" > Fill Form</button></span></li>
    </ul>
  </div>
</div>


@elseif(Auth::user()->formNextStatus ==4)

<div class="container col-md-6">
<div class="card ">
    <div class="card-header text-center">
      <h5 class="mb-4"> Application Form Status</h5>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item h6">Personal Details<span class="float-right badge badge-pill badge-success">Submited <i class="far fa-check-circle fa-fw fa-lg"></i> </span></li>
      <li class="list-group-item h6">Educational Qualification Details <span class="float-right badge badge-pill badge-success">Submited <i class="far fa-check-circle fa-fw fa-lg"></i> </span></li>

      <li class="list-group-item h6">Experience Details <span class="float-right badge badge-pill badge-success">Submited <i class="far fa-check-circle fa-fw fa-lg"></i> </span></li>

      <li class="list-group-item h6">Documents Upload<a href="{{ route('user.dashboard') }}"><button type="button" class="btn btn-info btn-sm float-right" style="border-radius:23px;" > Fill Form</button></a></span></li>
    </ul>
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
