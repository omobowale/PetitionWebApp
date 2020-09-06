@extends('layouts.app')


@section('content')

<div class="container mt-4" style="background-color: lavender"> 
        <div class="row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center mt-5">
                <div class="pb-5">
                    <h1 style="font-size:3rem; font-family: 'Raleway'" class="text-info pb-5 border-bottom border-info">Contact Us</h1>
                </div>
            </div>
            <div class="col-12">
                <div>
                    <form id="signform" method="post" action="">
                        @csrf
                        <div class="row">
                            <div class="col-6 form-group">
                                <label class="sr-only">First Name</label>
                                <input name="firstname" id="firstname" value="{{ old('firstname') }}" required class="form-control rounded p-4 text-center @error('firstname') is-invalid @enderror" type="text" placeholder="Please enter first name" />
                                @error('firstname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6 form-group">
                                <label class="sr-only">Last Name</label>
                                <input name="lastname" id="lastname" value="{{ old('lastname') }}" required class="form-control rounded p-4 text-center @error('lastname') is-invalid @enderror" type="text" placeholder="Please enter last name" />
                                @error('lastname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="offset-2 col-8 form-group">
                                <label class="sr-only">Email</label>
                                <input name="email" id="email" value="{{ old('email') }}" required class="form-control rounded p-4 text-center @error('email') is-invalid @enderror" type="email" placeholder="Please enter email" />
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="offset-2 col-8 form-group">
                                <label class="sr-only">Message</label>
                                <textarea name="message" id="message" required rows="12" class="form-control rounded @error('signature_reason') is-invalid @enderror" placeholder="Please enter your message">{{ old('message') }}</textarea>
                                @error('signature_reason')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="text-center">
                            <button class="btn btn-info rounded-pill py-2 px-3 mb-4">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>


@endsection