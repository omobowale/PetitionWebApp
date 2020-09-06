@extends('layouts.app')

@section('content')
    @if(count($petitions) > 0)
    <div class="container-fluid" style="height:90vh"> 
        <div class="row h-100">
        @foreach($petitions as $petition)
            <div class="col-6 text-center border-right border-info">
                <img class="w-100 h-100 mx-0 px-0" src="{{$petition->cover_image ? '/storage/cover_images/'.$petition->cover_image : 'https://www.lansingcitypulse.com/uploads/original/20200320-134347-petition.jpg'}}" />
            </div>
            <div class="col-6 text-center d-flex align-items-center justify-content-center">
                <div>
                    <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-info">{{$petition->petition_title}}</h1>
                    <p style="font-family: 'Quicksand', sans-serif;">{{$petition->petition_description}}</p>
                    <div class="mt-5"><a href="/petitions/{{$petition->id}}" class="btn btn-info rounded-pill px-3 py-2">View / Sign this petition</a></div>
                </div>
            </div>
        @endforeach
    @else
    <div class="mt-4 alert alert-info text-center">No petitions yet</div>
    @endif
    </div>
    <div class="d-flex justify-content-center mt-4">
        <div class="">{{ $petitions->links() }}</div>
    </div>
</div>

<hr class="my-5">

<div class="container-fluid" style="height:90vh"> 
        <div class="row h-100">
            <div class="col-6 text-center border-right border-info d-flex align-items-center justify-content-center">
                <div>
                    <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-info">You are not alone</h1>
                    <div class="mt-5"><a href="/petitions/create" class="btn btn-info rounded-pill px-3 py-2">Create a Petition</a></div>
                </div>
            </div>
            <div class="col-6 text-center d-flex align-items-center justify-content-center bg-secondary">
                <div>
                    <img class="w-100 h-100 mx-0 px-0" src="https://news.bitcoin.com/wp-content/uploads/2019/06/india-petition.png" />
                </div>
            </div>
        </div>
</div>


<div class="container-fluid mt-4" style="height: 90vh; background-color: lavender"> 
        <div class="row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center my-5">
                <div>
                <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-info pb-3">How It Works</h1>
                    <p style="font-family: 'Quicksand', sans-serif;">Aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id facilisis enim, sed mattis magna. Aliquam erat volutpat.<br>
Lorem ipsum dolor sit amet, sed mattis magna.</p>
                </div>
            </div>
            <div class="col-12 text-center d-flex justify-content-around mt-5">
                <div class=" pt-4" style="width: 30%">
                    <i class="fas fa-pen-alt fa-3x mb-4"></i>
                    <h3>Create a Petition</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida pulvinar quam ac congue. Duis iaculis nec erat at sagittis. Vestibulum sagittis inter</p>
                </div>
                <div class=" pt-4" style="width: 30%">
                    <i class="fas fa-user-edit fa-3x mb-4"></i>
                    <h3>Collect Signatures</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida pulvinar quam ac congue. Duis iaculis nec erat at sagittis. Vestibulum sagittis inter</p>
                </div>
                <div class=" pt-4" style="width: 30%">
                    <i class="fas fa-paper-plane fa-3x mb-4"></i>
                    <h3>Raise at Parliament</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent gravida pulvinar quam ac congue. Duis iaculis nec erat at sagittis. Vestibulum sagittis inter</p>
                </div>
                
            </div>
        </div>
</div>


<div class="container-fluid mt-4" style="background-color: white"> 
        <div class="row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center mt-5">
                <div>
                    <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-info pb-3">Engagement</h1>
                    <p style="font-family: 'Quicksand', sans-serif; font-size: 1.1em">Aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id facilisis enim, sed mattis magna. Aliquam erat volutpat.<br>
Lorem ipsum dolor sit amet, sed mattis magna.</p>
                </div>
            </div>
            <div class="text-info col-12 text-center d-flex justify-content-around mt-5">
                <div class="pt-2 d-flex justify-content-center" style="width: 25%;">
                    <div class="">
                        <div class="rounded border border-info py-4 mb-4" style="">
                            <i class="far fa-file-alt fa-8x" style="font-weight:10px"></i>
                        </div>
                        <h3>{{!empty($petition) ? $petition->count() : 0}}</h3>
                        <p>Petitions created already.<br>The count goes on</p>
                    </div>
                </div>
                <div class="pt-2 d-flex justify-content-center" style="width: 25%;">
                    <div class="">
                        <div class="rounded border border-info py-4 mb-4" style="">
                        <i class="fas fa-list-ol fa-8x" style="font-weight:10px"></i>
                        </div>
                        <h3>{{App\Signature::count()}}</h3>
                        <p>Signatures collected on<br>all of the petitions</p>
                    </div>
                </div>
                <div class="pt-2 d-flex justify-content-center" style="width: 25%;">
                    <div class="">
                        <div class="rounded border border-info py-4 mb-4" style="">
                            <i class="fas fa-user-friends fa-8x" style="font-weight:10px"></i>
                        </div>
                        <h3>{{App\User::count()}}</h3>
                        <p>People on site to sign petitions<br>and discuss issues</p>
                    </div>
                </div>
            </div>
        </div>
</div>



<div class="container-fluid mt-4" style="background-color: lavender"> 
        <div class="row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center mt-5">
                <div>
                    <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-info pb-3">Successful Petitions</h1>
                    <p style="font-family: 'Quicksand', sans-serif; font-size: 1.1em">Aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id facilisis enim, sed mattis magna. Aliquam erat volutpat.<br>
Lorem ipsum dolor sit amet, sed mattis magna.</p>
                </div>
            </div>
            <div class="text-info col-12 text-center d-flex justify-content-around mt-5">
            @if(count($petitions) > 0)
                <div class="container" style=""> 
                    <div class="row h-100">
                    @foreach($petitions as $petition)
                        @if($petition->signature_target == count($petition->signatures()->get()))
                            <div class="pt-2" style="width: 40%">
                                <figure class="figure shadow-lg bg-white rounded">
                                    <img src="{{$petition->cover_image ? '/storage/cover_images/'.$petition->cover_image : 'https://www.lansingcitypulse.com/uploads/original/20200320-134347-petition.jpg'}}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                                    <figcaption class="figure-caption text-left pl-3 py-5 border border-secondary">{{$petition->petition_title}}</figcaption>
                                    <small><span class="text-secondary">Created On:</span> {{$petition->created_at}}</small>
                                </figure>
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            @endif
                
            </div>
        </div>
       
</div>





@endsection


