@extends('layout')
@section('content')
<section id="show">
    <div class="container">
        <div class="text-center">
            <h2>Detail obce</h2>
        </div>
        <x-show-city :city="$city"></x-show-city>
    </div>
</section>
@endsection
