@extends('layouts.app')


@section('content')
<div class="container mt-4">


@if(session()->has('message'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('message') }}
            </div>
@endif

@if(session()->has('error'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('error') }}
            </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="list-style:none">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <div class="row mb-3">
                <div class="offset-md-3 col-6">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title lead">User Name</p>
                        </div>
                        <div class="card-body">
                            <span>{{$user->name}}</span>
                            <span data-toggle="modal" data-target="#nameeditmodal" class="p-2 alert alert-success float-right" style="cursor:pointer"><i class="far fa-edit"></i>Edit</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-md-3 col-6">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title lead">User Email</p>
                        </div>
                        <div class="card-body">
                            <span>{{$user->email}}</span>
                            <span data-toggle="modal" data-target="#emaileditmodal" class="p-2 alert alert-success float-right" style="cursor:pointer"><i class="far fa-edit"></i>Edit</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-md-3 col-6">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title lead">User Password</p>
                        </div>
                        <div class="card-body">
                            <span>{{'hidden'}}</span>
                            <span data-toggle="modal" data-target="#passwordeditmodal" class="p-2 alert alert-success float-right" style="cursor:pointer"><i class="far fa-edit"></i>Edit</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-3">
                <form action="/users/{{$user->id}}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="p-0 border-0 text-danger" style="cursor:pointer">
                        <i class="fas fa-trash"></i>Delete User [{{$user->name}}]
                    </button>
                </form>
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
                <input name="name" class="form-control" type="text" value="{{$user->name}}"/>
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
                <input name="email" class="form-control" type="email" value="{{$user->email}}"/>
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
<form method="post" action="/profile/passwordchangebyadmin">
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
                <input name="new_password" class="form-control" type="password" placeholder="Enter New Password"/>
            </div>
            <div class="form-group">
                <input name="confirm_password" class="form-control" type="password" placeholder="Confirm New Password"/>
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



       @endsection