@extends('layouts.app')

@section('content')
<div class="container-fluid" style="min-height:80vh">
<ul class="nav nav-tabs justify-content-center mb-3" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="report-tab" data-toggle="tab" href="#report" role="tab" aria-controls="report" aria-selected="false">Users Report</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="petitions-tab" data-toggle="tab" href="#petitions" role="tab" aria-controls="petition" aria-selected="true">All Petitions</a>
  </li>
</ul>


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

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade" id="petitions" role="tabpanel" aria-labelledby="petitions-tab">
            <div class="container-fluid" style="min-height: 80vh">

                @if(count($petitions) > 0)
                <h4 class="alert alert-info text-center">All Petitions - <span class="text-primary">[Click on a row to view or sign petition]</span></h4>
                <table class="table table-hover table-responsive-sm">
                    <tr>
                        <th>S/N</th>
                        <th>Petition Title</th>
                        <th>Created By</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    @foreach($petitions as $index => $petition)
                    <tr style="cursor:pointer" class="petition" id="{{$petition->id}}">
                        <td>{{$index + 1}}</td>
                        <td>{{$petition->petition_title}}</td>
                        <td>{{$petition->user->name}}</td>
                        <td>{{$petition->created_at}}</td>
                        <td>
                            <span class="p-2 text-success mr-4" style="cursor:pointer"><i class="far fa-edit"></i><a href="/petitions/{{$petition->id}}/edit" style="text-decoration:none">Edit</a>
                            </span>
                            <form action="/petitions/{{$petition->id}}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="p-0 border-0 text-danger" style="cursor:pointer">
                                    <i class="fas fa-trash"></i>Delete
                                </button>
                            </form>
                        </td>
                        
                    </tr>
                    @endforeach
                </table>
                {{$petitions->links()}}
                @else
                <p class="alert alert-info">No petitions yet</p>
                @endif


        </div>

    </div>

    <div class="tab-pane fade show active" id="report" role="tabpanel" aria-labelledby="report-tab">
       
        @if(count($users) > 1)
        <h4 class="alert alert-info text-center">All Users - <span class="text-primary">[Click on a row to view or edit users]</span></h4>
        <table class="table table-hover table-responsive-sm">
            <tr>
                <th>User Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registration Date</th>
            </tr>
            @foreach($users as $index => $user)
            @if($user->role !== 'admin')
            <tr style="cursor:pointer" class="user" id="{{$user->id}}">
                <td>{{$index + 1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
                
                
            </tr>
            @endif
            @endforeach
        </table>
        {{$users->links()}}
        @elseif(count($users) == 1)
            <p class="alert alert-info">No users yet - You are the only user</p>
        @else
            <p class="alert alert-info">No users yet</p>
        @endif

        <div>
            <a class="btn btn-info" href="/admin/create">Add New User</a>
        </div>
    </div>
</div>






</div>
@endsection


<script>
window.addEventListener('load', function(){
    $(".user").click(function(){
        window.location.href = "/users/" + $(this).attr("id");
    });
});

window.addEventListener('load', function(){
    $(".petition").click(function(){
        window.location.href = "/petitions/" + $(this).attr("id");
    });
});
</script>