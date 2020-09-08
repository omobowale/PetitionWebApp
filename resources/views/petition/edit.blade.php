@extends('layouts.app')

@section('content')
<div class="container"> 
        <div class="row h-100">
            <div class="col-12 text-center border-right border-left border-info">
                <img class="w-100 h-100 mx-0 px-0" src="{{$petition->cover_image ? '/storage/cover_images/'.$petition->cover_image : 'https://news.bitcoin.com/wp-content/uploads/2019/06/india-petition.png'}}" />
            </div>
            <div class="col-12 bg-secondary p-5">
                <div>
                    <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-white">Edit your existing petition</h1>
                    <p class="text-white">Morbi nibh nibh, venenatis sed tellus id, dignissim tempor lorem. Nulla euismod elementum diam a venenatis.
Vivamus ut ante nisi. Nunc tellus eros, congue vel ligula et</p>
                </div>
            </div>
        </div>
</div>

<hr class="my-5">


<div class="container mt-4" style="background-color: lavender"> 
        <div class="row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center mt-5">
                <div class="pb-5">
                    <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-info pb-5 border-bottom border-info">Edit Petition</h1>
                </div>
            </div>
            <div class="col-12">
                <div>
                    <form id="petitionform" action="/petitions/{{$petition->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <h3>The Petition</h3>
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="petition_title" class="sr-only">Petition Title: </label>
                                <input name="petition_title" id="petition_title" required value="{{ $petition->petition_title}}" class="form-control rounded @error('petition_title') is-invalid @enderror" type="text" placeholder="Petition Title" />
                                @error('petition_title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 form-group">
                                <label for="signature_target" class="sr-only">Signature Target</label>
                                <input name="signature_target" id="signature_target" required value="{{ $petition->signature_target}}" class="form-control rounded  @error('signature_target') is-invalid @enderror" type="text" placeholder="Signature Target" />
                                @error('signature_target')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 form-group">
                                <label for="petition_description" class="sr-only">Petition Details</label>
                                <textarea name="petition_description" id="petition_description" required rows="12" class="form-control rounded  @error('petition_description') is-invalid @enderror" placeholder="Write Petition Details">{{ $petition->petition_description}}</textarea>
                                @error('petition_description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <h3 class="mt-5"> Media Items (Optional)</h3>
                        <div class="row">
                            
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="input-group mb-2 col-12">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">Cover Image</div>
                                        </div>
                                        <input name="cover_image" id="cover_image" value="" type="file" class="form-control" id="inlineFormInputGroup" placeholder="Cover Image">
                                        @error('cover_image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 form-group">
                                <label for="featured_video_url" class="sr-only">Featured Video URL</label>
                                <input name="featured_video_url" id="featured_video_url" value="{{ $petition->featured_video_url}}" class="form-control rounded  @error('featured_video_url') is-invalid @enderror" type="text" placeholder="Featured Video URL" />
                                @error('featured_video_url')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 form-group">
                                <label for="video_headline" class="sr-only">Video Headline</label>
                                <input name="video_headline" id="video_headline" value="{{ $petition->video_headline}}" class="form-control rounded  @error('video_headline') is-invalid @enderror" type="text" placeholder="Video Headline" />
                                @error('video_headline')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 form-group">
                                <label for="video_details" class="ml-1">Video Details</label>
                                <textarea rows="12" name="video_details" id="video_details" class="form-control rounded  @error('video_details') is-invalid @enderror" placeholder="Write details about the video">{{ $petition->video_details}}</textarea>
                                @error('video_details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                           

                        </div>

                        <h3 class="mt-5"> The Letter</h3>
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="letter" class="sr-only">Letter Details</label>
                                <textarea name="letter" id="letter" rows="12" required class="form-control rounded  @error('letter') is-invalid @enderror" placeholder="Write Letter with this petition">{{ $petition->letter}}</textarea>
                                @error('letter')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 form-group">
                                <label for="letter_recipient" class="sr-only">Recipient </label>
                                <input name="letter_recipient" id="letter_recipient" required value="{{ $petition->letter_recipient}}" class="form-control rounded  @error('letter_recipient') is-invalid @enderror" type="text" placeholder="Recipient" />
                                @error('letter_recipient')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 form-group">
                                <label for="recipient_designation" class="sr-only">Recipient's Designation</label>
                                <input name="recipient_designation" id="recipient_designation" required value="{{ $petition->recipient_designation}}" class="form-control rounded  @error('recipient_designation') is-invalid @enderror" type="text" placeholder="Recipient's Designation" />
                                @error('recipient_designation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h3 class="mt-5"> Updates (Optional)</h3>
                        <div class="row">
                            
                            <div class="col-12 form-group">
                                <label for="update_title" class="sr-only">Updates or News Title</label>
                                <input name="update_title" id="update_title" class="form-control rounded  @error('update_title') is-invalid @enderror" type="text" placeholder="Updates or News Title" />
                                @error('update_title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 form-group">
                                <label for="update_details" class="">Update Details</label>
                                <textarea name="update_details" rows="12" class="form-control rounded  @error('update_details') is-invalid @enderror" placeholder="Write details about the updates"></textarea>
                                @error('update_details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                           
                        </div>

                       <div class="text-center">
                            <button class="btn btn-info btn-block rounded-pill py-2 px-3 mb-4">Update</button>
                            
                       </div>
                    </form>
                    <a href="/petitions/{{$petition->id}}" class="btn btn-danger btn-block rounded-pill py-2 px-3 mb-4">Cancel</a>
                </div>
            </div>
        </div>
</div>


@endsection


<script>
    window.addEventListener('load', function(){
        
       CKEDITOR.replace('update_details');
       CKEDITOR.replace('letter');
       CKEDITOR.replace('petition_description');
       CKEDITOR.replace('video_details');


    });
</script>