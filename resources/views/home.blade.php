@extends('layouts.app')

@section('content')
<div class="container-fluid" style="min-height:80vh">
<ul class="nav nav-tabs justify-content-center mb-3" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="petitions-tab" data-toggle="tab" href="#petitions" role="tab" aria-controls="home" aria-selected="true">My Petitions</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">My Profile</a>
  </li>
</ul>


@if(session()->has('message'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('message') }}
            </div>
@endif

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="petitions" role="tabpanel" aria-labelledby="petitions-tab">
        <div class="container">
            @if(count($petitions) > 0)
                @foreach($petitions as $petition)
                <div class="row mb-2">
                    <div class="col-6 text-center">
                        <img class="w-100 h-100 mx-0 px-0" src="{{$petition->cover_image ? '/storage/cover_images/'.$petition->cover_image : 'https://www.lansingcitypulse.com/uploads/original/20200320-134347-petition.jpg'}}" />
                    </div>
                    <div class="col-6 text-center d-flex align-items-center justify-content-center">
                        <div style="">
                            <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-info">{{$petition->petition_title}}</h1>
                            <p style="font-family: 'Quicksand', sans-serif;">{!!$petition->petition_description!!}</p>
                            @can('modify', $petition)
                            <div class="text-center mt-4">
                                <span class="p-2 alert alert-success mr-4" style="cursor:pointer"><i class="far fa-edit"></i><a href="/petitions/{{$petition->id}}/edit" style="text-decoration:none">Edit</a></span>
                                <form action="/petitions/{{$petition->id}}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2 alert alert-danger" style="cursor:pointer">
                                        <i class="fas fa-trash"></i>Delete
                                    </button>
                                </form>
                                <div class="text-center"><a href="/petitions/{{$petition->id}}">View details</a></div>
                            </div>
                        @endcan
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach

            @else
                <div class="alert alert-info text-center">No Petitions yet - Start Creating Petitions</div>
            @endif
            <div class="d-flex justify-content-center mt-4">
                <a class="btn btn-info" href="/petitions/create">Create New Petition</a href="/petitions/create">
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
       <div class="container">
            @if(isset($petition))
            @can('view', $petition)
            <div class="row mb-3">
                <div class="offset-md-3 col-6">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title lead">Your Role</p>
                        </div>
                        <div class="card-body">
                            <span>{{ucfirst(Auth::user()->role)}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            @endif
            <div class="row mb-3">
                <div class="offset-md-3 col-6">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title lead">Your Name</p>
                        </div>
                        <div class="card-body">
                            <span>{{Auth::user()->name}}</span>
                            <span data-toggle="modal" data-target="#nameeditmodal" class="p-2 alert alert-success float-right" style="cursor:pointer"><i class="far fa-edit"></i>Edit</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-md-3 col-6">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title lead">Your Email</p>
                        </div>
                        <div class="card-body">
                            <span>{{Auth::user()->email}}</span>
                            <span data-toggle="modal" data-target="#emaileditmodal" class="p-2 alert alert-success float-right" style="cursor:pointer"><i class="far fa-edit"></i>Edit</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-md-3 col-6">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title lead">Your Password</p>
                        </div>
                        <div class="card-body">
                            <span>{{'hidden'}}</span>
                            <span data-toggle="modal" data-target="#passwordeditmodal" class="p-2 alert alert-success float-right" style="cursor:pointer"><i class="far fa-edit"></i>Edit</span>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
</div>


<!--Modal Section-->
<div class="modal" id="nameeditmodal" tabindex="-1" role="dialog">
<form method="post" action="/profile/name">
    @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <input name="name" class="form-control" type="text" value="{{Auth::user()->name}}"/>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</form>
</div>


<div class="modal" id="emaileditmodal" tabindex="-1" role="dialog">
<form method="post" action="/profile/email">
    @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <input name="email" class="form-control" type="email" value="{{Auth::user()->email}}"/>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</form>
</div>

<div class="modal" id="passwordeditmodal" tabindex="-1" role="dialog">
<form method="post" action="/profile/password">
    @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <input name="password" class="form-control" type="password" placeholder="Enter Old Password"/>
            </div>
            <div class="form-group">
                <input name="npassword" class="form-control" type="password" placeholder="Enter New Password"/>
            </div>
            <div class="form-group">
                <input name="cpassword" class="form-control" type="password" placeholder="Confirm New Password"/>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</form>
</div>




</div>
@endsection
