<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
                            <a href="{{ route('dashboard.admin') }}" class="full-link text-shadow">Dashboard</a>
                        </li>
                        <li class="list-item" style="padding-left: 10px; padding-top: 10px;">
                            <a href="{{ route('carlist.admin') }}" class="full-link text-shadow">My Car List</a>
                        </li>
                        <li class="list-item" style="padding-left: 15px; padding-top: 10px;">
                            <a href="./aboutus.html" class="full-link text-shadow">About Us</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <div class="dropdown">
                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/unknownuser.jpg') }}"
                                alt="{{ $user->name }}"
                                class="rounded-circle dropdown-toggle avatar border border-white foto" role="button"
                                data-bs-toggle="dropdown">
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
                            class="text-light text-shadow">{{ $user->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="w-100 h-100" style="background-color: wheat;">
        <div class="py-2">
            <form action="{{ route('rent.confirm', ['id' => $data->id]) }}" method="post"
                onsubmit="return confirmRenting(event)">
                @csrf
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-center">Form Rental Mobil</h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-10 col-sm-12">
                            <img src="{{ asset('storage/' . $data->picture) }}" style="max-width: 300px;"
                                class="rounded" alt="">
                        </div>
                        <div class="col-lg-6">
                            <h6>Nama Mobil = {{ $data->car_name }}</h6>
                            <h6>Alamat Pemilik = {{ $data->address }}</h6>
                            <h6>Harga = Rp. {{ $data->price }}</h6>
                            <h6>Harga driver = Rp. 200000</h6>
                            <h6>Jumlah unit mobil tersedia = {{ $data->number_of_car }} unit</h6>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Jumlah Unit</span>
                                <input type="number" class="form-control"
                                    placeholder="Masukan jumlah unit yang ingin disewa" aria-label="Username"
                                    aria-describedby="basic-addon1" name="qty_unit">
                            </div>
                            @error('qty_unit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <select class="form-select" aria-label="Default select example" name="driver_option">
                                <option value="without" selected>Tidak dengan driver</option>
                                <option value="with">Dengan Driver (+ 200000 / mobil)</option>
                            </select>
                            @error('driver_option')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Durasi (hari)</span>
                                <input type="number" class="form-control" placeholder="masukan durasi penyewaan"
                                    aria-label="Username" aria-describedby="basic-addon1" name="duration">
                            </div>
                            @error('duration')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Tanggal Penyewaan</span>
                                <input type="date" class="form-control" aria-label="Username"
                                    aria-describedby="basic-addon1" name="start_renting">
                            </div>
                            @error('start_renting')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            {{-- <select class="form-select" aria-label="Default select example" name="payment_service">
                              @foreach ($payments as $payment)
                                <option value="{{ $payment->id }}">{{ $payment->name_of_payment_service }}</option>
                              @endforeach
                            </select> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 justify-content-end" style="display: flex;">
                            <button class="btn btn-danger" style="margin-right: 30px;">
                                <a href="{{ route('rentcar') }}" class="no-style block">CANCEL</a>
                            </button>
                            <button type="submit" class="btn btn-success">RENT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <h2 class="text-danger"></h2>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        function confirmRenting(event) {
            if (!confirm('are you sure to rent this car ? ')) {
                event.preventDefault();
            }
        }
        @error('was_renting_before')
            alert("this user was renting car before and hasn't return OR status is pending , but hasn't cancel the order");
        @enderror
        @error('car_is_null')
            alert('car was sold out');
        @enderror
    </script>
</body>

</html>