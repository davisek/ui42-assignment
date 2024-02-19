@extends('layout')
@section('content')
<section id="home">
    <div class="d-flex align-items-center justify-content-center vh-60">
        <div class="container text-center">
            <div class="mb-5">
                <h1>Vyhľadať v databáze obcí</h1>
            </div>
            <div class="d-flex justify-content-center">
                <form class="w-50 position-relative" role="search">
                    @csrf
                    <input id="searchInput" class="form-control" type="search" placeholder="Zadajte názov" aria-label="Search">
                    <div id="autocompleteResults" class="autocomplete-results"></div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
