<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/authenticated.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="nav-back"></div>
        <div class="container-fluid nav-content">
            <a class="navbar-brand kavoon text-white" style="margin-left: 20px;" href="{{ redirect('/') }}">Car Rent
                Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav me-auto mb-2 mb-lg-0 justify">
                </div>
                <div class="d-flex align-items-center">
                    <ul class="navbar-nav me-auto" style="margin-right: 25px;">
                        <li class="list-item" style="padding-left: 10px; padding-top: 10px;">
                            <a href="{{ route('dashboard.client') }}" class="full-link text-shadow">Dashboard</a>
                        </li>
                        <li class="list-item active-li" style="padding-left: 15px; padding-top: 10px;">
                            <a href="{{ route('rentcar') }}" class="full-link active-nav">Rent Car</a>
                        </li>
                        <li class="list-item" style="padding-left: 15px; padding-top: 10px;">
                            <a href="./aboutus.html" class="full-link text-shadow">About Us</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <div class="dropdown">
                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/unknownuser.jpg') }}"
                                alt="{{ $user->name }}"
                                class="rounded-circle dropdown-toggle avatar border-2 border-white foto"
                                role="button" data-bs-toggle="dropdown">
                            <ul class="dropdown-menu">
                                <li class="dropdown-list">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="text-danger btn">Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <p style="margin-top: 13px; margin-left: 20px; font-weight: bold; color: white;"
                            class="text-light text-shadow">Adolf Hitler</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid mt-2 overflow-auto">
        <div class="row justify-content-center">
            @foreach ($cars as $car)
                <div class="col-lg-3 col-md-8 col-sm-10 mt-5 mx-5 py-4"
                    style="min-height: 300px; border-radius: 15px; background-color: white; max-height: 350px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 justify-content-center" style="display: flex">
                                <img src="{{ asset('storage/' . $car->picture) }}"
                                    style="width: 250px; aspect-ratio: 16/9" alt="{{ $car->car_name }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-center">{{ $car->car_name }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p>Price Rent = Rp. {{ $car->price }}/day <br> Unit ready =
                                    {{ $car->number_of_car }}</p>
                            </div>
                        </div>
                        <div class="row">
                          <a href="{{ route('rent.details', ['id' => $car->id]) }}"
                            class="block no-style btn btn-success col-12">RENT NOW</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
