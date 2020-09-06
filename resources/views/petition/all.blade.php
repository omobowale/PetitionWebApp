@extends('layouts.app')





@section("content")

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
                @can('modify', $petition)
                <span class="p-2 text-success mr-4" style="cursor:pointer"><i class="far fa-edit"></i><a href="/petitions/{{$petition->id}}/edit" style="text-decoration:none">Edit</a></span>
                    <form action="/petitions/{{$petition->id}}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="p-0 border-0 text-danger" style="cursor:pointer">
                            <i class="fas fa-trash"></i>Delete
                        </button>
                    </form>
                @endcan

                
            </td>
            
        </tr>
        @endforeach
    </table>
    {{$petitions->links()}}
    @else
    <p class="alert alert-info">No petitions yet</p>
    @endif


</div>






@endsection

<script>
window.addEventListener('load', function(){
    $(".petition").click(function(){
        window.location.href = "/petitions/" + $(this).attr("id");
    });
});
</script>