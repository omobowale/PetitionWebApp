@extends('layouts.app')

@section('content')
<div class="container"> 
        @if(session()->has('message'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12 text-center border-right border-left border-info">
                <img style="width:100%; height:35em" src="{{$petition->cover_image ? '/storage/cover_images/'.$petition->cover_image : 'https://www.lansingcitypulse.com/uploads/original/20200320-134347-petition.jpg'}}" />
            </div>
            <div class="col-12 bg-secondary p-5">
                <div>
                    <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-white">{{$petition->petition_title}}</h1>
                    <div class="bg-info rounded mb-4" style="width:90%">
                        @php
                            $percentage = count(App\Petition::find($petition->id)->signatures()->get()) / $petition->signature_target * 100 ? : 0
                        @endphp
                        <div class="bg-primary text-center" style="width:{{round($percentage)}}%"><span class="ml-2">{{round($percentage)}}%</span></div>
                    </div>
                    <p>Signatures: {{count(App\Petition::find($petition->id)->signatures()->get()) ? : 0 }}  of {{$petition->signature_target}}</p>
                </div>
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
                    </div>
                @endcan
            </div>
        </div>
</div>




<div class="container my-5"> 
    <h4 class="mb-4">A Petition by: {{ucwords(App\User::find($petition->user_id)->name)}}
    @guest <small class="text-info float-right text-sm">Log in to sign this petition</small>  
    
    @else

        @cannot('sign', $petition) <small class="text-success float-right text-sm">Already Signed this petition</small> @endcannot 
        @can('sign', $petition)<a href="#signform" class="btn btn-info float-right rounded-pill py-2 px-3">Sign this</a>@endcan</h4>

    @endguest
    <h6 class="mb-4">Created on: {{$petition->created_at}}</h6>
    <p class="lead text-justify">{!!$petition->petition_description!!}</p>
    <hr>
</div>




@if($petition->featured_video_url)
    <div class="container">
            <div>
                <h5>{{$petition->video_headline}}</h5>
            </div>
        <div class="row">
            <div class="col-6">
            
            @php 
                $url = explode('=', $petition->featured_video_url)
            @endphp
                <iframe width="555" height="315" 
                    src="https://www.youtube.com/embed/{{$url[1]}}" frameborder="0" 
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                </iframe>
            </div> 
            <div class="col-6">
                <small>
                    {!!$petition->video_details!!}
                </small>
            </div>
        </div>
    <div>

@endif




<div class="container text-white bg-secondary text-justify p-5 mt-5 text-capitalize" style="font-family: 'Caveat', cursive; font-size:1.5em"> 
    <p class="">To,</p>
    <p class="mb-4 text-capitalize">{{$petition->letter_recipient}}</p>
    <article class="text-justify" style="">{!!ucfirst($petition->letter)!!}</article>
    <p class="mt-4">Sincerely,</p>
    <p class="mb-4 text-captitalize">{{App\User::find($petition->user_id)->name}}</p>
</div>



<div class="container mt-4" style="background-color: lavender"> 
        <div class="row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center mt-5">
                <div class="pb-5">
                    <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-info pb-5 border-bottom border-info">Updates</h1>
                </div>
            </div>
            <div class="col-12">
                <div class="jumbotron-fluid text-center pb-4">
                    <div class="row" style="">
                        <div class="offset-1 col-10">
                            @if(count(App\Petition::find($petition->id)->updates()->get()) > 0)
                            @php
                                $updates = App\Petition::find($petition->id)->updates()->get();
                            @endphp
                            <div id="carouselExampleControls" class="carousel slide" style="height:30vh" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach($updates as $index => $update)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$index}}" class="{{$index == 0 ? 'active' : ''}}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                   
                                        
                                        @foreach($updates as $index => $update)
                                            <div class="carousel-item {{$index == 0 ? 'active' : ''}}">
                                                <h4>{{ucwords($update->updates_title)}}</h4>
                                                <p>{{ucfirst($update->updates_details)}}</p>
                                                <p class="mb-1">{{$update->created_at}}</p>
                                            </div>
                                        @endforeach 
                                    
                                   
                                   
                                </div>
                                <a class="carousel-control-prev bg-secondary" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next bg-secondary" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            @else
                            <div class="alert alert-info text-center">
                                    No updates yet
                            </div>

                            @endif


                        </div>
                    </div>
                    <div class=""></div>
                </div>
            </div>


            <div class="col-12 text-center py-4">
                 <div class="updatessection">    
                    <div class="section1"> 
                        <form method="post" action="/petitions/update"> 
                            @csrf         
                            <div>
                                <input type="hidden" name="petition_id" value="{{$petition->id}}"/>
                            </div>
                            <div class="form-group">
                                <label for="update_title" class="sr-only">Updates or News Title</label>
                                <input name="update_title" id="update_title" required value="{{ old('update_title') }}" class="form-control rounded @error('update_title') is-invalid @enderror" type="text" placeholder="Updates or News Title" />
                                @error('update_title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="update_details" class="sr-only">Update Details</label>
                                <textarea name="update_details" rows="8" required class="form-control rounded @error('update_details') is-invalid @enderror" placeholder="Write details about the updates">{{ old('update_details') }}</textarea>
                                @error('update_details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-danger rounded-pill cancelbutton" type="button">Cancel</button>
                            <button class="btn btn-info rounded-pill">Insert</button>
                        </form>
                    </div>
                    @can('update', $petition)
                    <div class="section2">
                        <button class="btn btn-info rounded-pill addupdates"> + Add Updates</button>
                    </div>
                    @endcan
                </div>         
                
            </div>
        </div>
</div>





<div class="container mt-4" style=""> 
        <div class="row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center mt-5">
                <div class="pb-5">
                    <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-info pb-5 border-bottom border-info">Signatures</h1>
                </div>
            </div>
            
            @if(count(App\Petition::find($petition->id)->signatures()->get()) > 0)
            <div class="col-12 d-flex justify-content-between " style="flex-wrap: wrap; col-gap:0.2em; row-gap:2em">
                    @php
                        $signatures = App\Petition::find($petition->id)->signatures()->get();
                    @endphp

                    @foreach($signatures as $signature)
                        <div class="row p-3" style="overflow: hidden; min-width:32%; max-width:32%; border-top: 1px solid lavender; border-left: 1px solid lavender; border-radius:1em; box-shadow: 0.2em 0.2em 0.1em 0.1em lavender">
                            <div class="col-6" style="border-right: 1px solid lavender">
                                <img style="width:100%; height:100%" src="https://www.lansingcitypulse.com/uploads/original/20200320-134347-petition.jpg" alt="image will show here" />
                            </div>
                            <div class="col-6" style="">
                                <h5>{{$signature->firstname}}</h5>
                                <small>{{$signature->created_at}}</small>
                                <hr>
                                <small style="overflow-wrap: break-word">{!!ucfirst($signature->signature_reason)!!}</small>
                            </div>
                        </div>
                    @endforeach        
                
                
                
            </div>
            

            @else
            <div class="col-12 text-center alert alert-info">No signatures yet</div>
            @endif
        </div>
</div>



@if(Auth::user())
@can('sign', $petition)
<div class="container mt-4" style="background-color: lavender"> 
        <div class="row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center mt-5">
                <div class="pb-5">
                    <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-info pb-5 border-bottom border-info">Sign this petition</h1>
                </div>
            </div>
            <div class="col-12">
                <div>
                    <form id="signform" method="post" action="/petitions/sign">
                        @csrf
                        <div class="row">

                            <input type="hidden" name="petition_id" id="petition_id" value="{{$petition->id}}" />
                            

                            <div class="offset-2 col-8 form-group mt-3">
                                <label class="">Reason For Signing</label>
                                <textarea name="signature_reason" id="signature_reason-ckeditor" required rows="12" class="form-control rounded @error('signature_reason') is-invalid @enderror" placeholder="Please enter reason why you are signing this petition">{{ old('signature_reason') }}</textarea>
                                @error('signature_reason')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                       <div class="text-center">
                            <button class="btn btn-info rounded-pill py-2 px-3 mb-4">Sign this</button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endcan

@else
    <div class="text-center text-info">
       Log in to sign this petition
    </div>

@endif

@endsection



<script>
    window.addEventListener('load', function(){
        
       CKEDITOR.replace('signature_reason-ckeditor');

        $(".section1").hide();

        $(".addupdates").click(function(){
            $(".section1").show();
            $(".section2").hide();
        });

        $(".cancelbutton").click(function(){

            $(".section1").hide();
            $(".section2").show();
        });



    });
</script>
