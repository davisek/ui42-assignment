@props(['city'])
<div class="row show-box">
    <div class="col-lg-6 city-info">
        <div class="row">
            <div class="col-6">
                <h3>Meno starostu:</h3>
            </div>
            <div class="col-6">
                <p>{{ $city->mayor_name }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h3>Adresa obecného úradu:</h3>
            </div>
            <div class="col-6">
                <p>{{ $city->city_hall_address }}</p>
            </div>
        </div>
        @unless($city->phone === '')
            <div class="row">
                <div class="col-6">
                    <h3>Telefón:</h3>
                </div>
                <div class="col-6">
                    <p>{{ $city->phone }}</p>
                </div>
            </div>
        @endunless
        @unless($city->fax === '')
            <div class="row">
                <div class="col-6">
                    <h3>Fax:</h3>
                </div>
                <div class="col-6">
                    <p>{{ $city->fax }}</p>
                </div>
            </div>
        @endunless
        @unless($city->web_address === '')
            <div class="row">
                <div class="col-6">
                    <h3>Web:</h3>
                </div>
                <div class="col-6">
                    <p>{{ $city->web_address }}</p>
                </div>
            </div>
        @endunless
        <div class="row">
            <div class="col-6">
                <h3>Zemepisné súradnice:</h3>
            </div>
            <div class="col-6">

            </div>
        </div>
    </div>

    <div class="col-lg-6 text-center text-center d-flex align-items-center justify-content-center p-5 p-lg-0">
        <div class="w-100">
            <div>
                <img class="mb-3" src="{{ asset('storage/' . $city->image_path) }}" alt="erb">
            </div>
            <div>
                <h1 class="">{{ $city->name }}</h1>
            </div>
        </div>
    </div>
</div>
