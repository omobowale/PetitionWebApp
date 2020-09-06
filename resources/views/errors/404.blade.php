@extends('layouts.app')


@section('content')


<div class="container">

    <div class="d-flex justify-content-center align-items-center" style="height: 80vh">

        <div>
            <h3 class="alert alert-info">{{ !empty($exception->getMessage()) ? $exception->getMessage() :  'Oops!! We cannot find that page' }}</h3>
        </div>
    
    </div>

</div>


@endsection