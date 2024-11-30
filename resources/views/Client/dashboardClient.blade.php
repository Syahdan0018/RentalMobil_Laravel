<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/authenticated.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="nav-back"></div>
        <div class="container-fluid nav-content">
            <a class="navbar-brand kavoon text-white" style="margin-left: 20px;" href="#">Car Rent Website</a>
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
                        <li class="list-item active-li" style="padding-left: 10px; padding-top: 10px;">
                            <a href="{{ route('dashboard.client') }}" class="full-link active-nav">Dashboard</a>
                        </li>
                        <li class="list-item" style="padding-left: 10px; padding-top: 10px;">
                            <a href="{{ route('rentcar') }}" class="full-link text-shadow">Rent Car</a>
                        </li>
                        <li class="list-item" style="padding-left: 15px; padding-top: 10px;">
                            <a href="./aboutus.html" class="full-link text-shadow">About Us</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <div class="dropdown">
                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/unknownuser.jpg') }}"
                                alt="" class="rounded-circle dropdown-toggle avatar border-2 border-white foto"
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
                            class="text-light text-shadow">
                            {{ $user->name }}{{ $user->role == 'Customer' ? $user->role : '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid px-xxl-5 py-lg-4 mt-1">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-10 col-sm-12 mb-1 white-op rounded-4 py-4"
                style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5)">
                <!-- card history -->
                <h3 class="text-center popin-bold" style="margin-left: 20px; margin-bottom: 20px; position: sticky;">
                    Rent
                    History</h3>
                <div class=" overflow-custom">
                    <ul class="list-group list-group-numbered">
                        @foreach ($history as $history)
                            <li style="display: flex; height: 100px; margin-bottom: 3px;">
                                <img src="{{ asset('storage/' . $history->car->picture) }}" alt=""
                                    class="foto-40">
                                <div style="margin-left: 10px; width: 65%;">
                                    <p class="text-lg-start" style="font-weight: bold;">{{ $history->car_name }}</p>
                                    <div style="height: 100px; max-height: 100px; margin-top: -20px;">
                                        <p>
                                            Status : {{ $history->status }} <br>
                                            price : Rp {{ $history->total_price }} <br>
                                            Rent at {{ date('d-m-Y', strtotime($history->start_rent)) }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-10 col-sm-11 mb-1">
                <div class="container">
                    <div class="row">
                        <div class="col-12 rounded-4 white-op text-center py-3 justify-content-center"
                            style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);">
                            <!--car recomendation -->
                            <h3 class="popin-bold">Car recomendation</h3>
                            <div style="display: flex;" class="justify-content-center">
                                <div class="carousel">
                                    @foreach ($rekomendasi as $mobil)
                                        <div class="carousel-slide">
                                            <img src="{{ asset('storage/' . $mobil->picture) }}"
                                                alt="{{ $mobil->car_name }}">
                                            <p>Rp.{{ $mobil->price }} / day</p>
                                            <a href="{{ route('rent.details', ['id' => $mobil->id]) }}"
                                                class="no-style">{{ $mobil->car_name }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-2 rounded-4 white-op text-center py-3"
                            style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);">
                            <!--status of rent of user -->
                            <h3 class="popin-bold">Status Rent</h3>
                            @if ($status)
                                @if ($status->status != 'returned')
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <img style="height: 150px; aspect-ratio: 16 / 10; border-radius: 3px;"
                                            src="{{ asset('storage/' . $status->car->picture) }}" alt="">
                                        <p class="popin-small text-start" style="margin-left: 10px;">
                                            Status : <span id="order-status">{{ $status->status }}</span> <br>
                                            Rent Date : {{ $status->start_rent }} <br>
                                            Return Date : {{ $status->end_rent }} <br>
                                            With Driver : {{ $status->driver }} <br>
                                            Total Price : Rp. {{ $status->total_price }} <br>
                                            Quantity Rent : {{ $status->duration }} day <br>
                                            Quantity Unit : {{ $status->unit }} Unit <br>
                                        </p>
                                    </div>
                                    @if ($status->status == 'pending payment')
                                        <div class="row justify-content-center">
                                            <form class="row justify-content-center"
                                                action="{{ route('rent.cancel', ['id' => $status->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <a href="{{ route('rent.payment', ['order_id' => $status->id]) }}"
                                                    class="btn btn-warning col-4" style="margin-right: 10px;">PAY</a>
                                                <button type="submit" class="btn btn-danger col-4">CANCEL</button>
                                            </form>
                                        </div>
                                    @elseif ($status->status == 'renting')
                                        <form action="{{ route('rent.return', ['id' => $status->id]) }}"
                                            class="row justify-content-center" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary col-6">RETURN THIS
                                                CAR</button>
                                        </form>
                                    @endif
                                @endif
                            @endif
                            {{-- @if ($status)
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <img style="height: 150px; aspect-ratio: 16 / 10; border-radius: 3px;"
                                        src="{{ asset('storage/' . $status->car->picture) }}" alt="">
                                    <p class="popin-small text-start" style="margin-left: 10px;">
                                        Status : <span id="order-status">{{ $status->status }}</span> <br>
                                        Rent Date : {{ $status->start_rent }} <br>
                                        Return Date : {{ $status->end_rent }} <br>
                                        With Driver : {{ $status->driver }} <br>
                                        Total Price : Rp. {{ $status->total_price }} <br>
                                        Quantity Rent : {{ $status->duration }} day <br>
                                        Quantity Unit : {{ $status->unit }} Unit <br>
                                    </p>
                                </div>
                            @endif
                            @if ($status)
                                <div class="container justify-content-center">
                                    <div class="row justify-content-end">
                                        @if ($status->status == 'pending')
                                            <form class="col-4"
                                                action="{{ route('rent.cancel', ['id' => $status->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger">CANCEL</button>
                                            </form>
                                        @elseif ($status->status == 'renting')
                                            <form class="col-4"
                                                action="{{ route('rent.return', ['id' => $status->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">RETURN</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/carousel.js') }}"></script>
    <script>
        @error('doesntexist')
            alert("this order record isn't exist");
        @enderror
        @error('hah')
            alert({{ $message }});
        @enderror
    </script>
</body>
