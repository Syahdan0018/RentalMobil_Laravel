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

<body class="">
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
                            <a href="{{ route('queue.index') }}" class="full-link text-shadow">Queue</a>
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
                            class="text-light text-shadow">{{ $user->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="w-100 h-100" style="background-color: wheat;">
        <div class="py-5">
            <form action="{{ route('carlist.create.submit') }}" method="post" class="container"
                enctype="multipart/form-data">
                @csrf
                <div class="row" style="">
                    <div class="col-12">
                        <h2>Form Tambah Mobil</h2>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Car Name</span>
                            <input type="text" class="form-control" placeholder="" aria-label="Car Name"
                                name="car_name" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                <div class="row mb-3" style="">
                    <div class="col-12">
                        <select class="form-select" aria-label="Default select example" name="regional_id">
                            <option selected>Open this select menu</option>
                            @foreach ($regionals as $regional)
                                <option value="{{ $regional->id }}">Provinsi : {{ $regional->province }}, Kota /
                                    Kabupaten : {{ $regional->district }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3" style="">
                    <div class="col-12">
                        <div class="input-group">
                            <span class="input-group-text">Alamat</span>
                            <textarea class="form-control" aria-label="With textarea" name="address"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row" style="">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Quantity Car</span>
                            <input type="number" class="form-control" placeholder="" aria-label="Car Name"
                                name="number_of_car" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                <div class="row" style="">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Price of Car : Rp.</span>
                            <input type="number" class="form-control" placeholder="" aria-label="Car Name"
                                name="price" name="price" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                <div class="row" style="">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Picture Of Car</span>
                            <input type="file" class="form-control" placeholder="Car Picture"
                                aria-label="Car Name" name="picture" name="car_name"
                                aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 justify-content-end" style="display: flex;">
                        <button type="submit" class="btn btn-primary" style="margin-right: 30px;">TAMBAH</button>
                        <button class="btn btn-danger">
                            <a href="{{ route('carlist.admin') }}" class="w-100 h-100 block text-white">BATAL</a>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <h2 class="text-danger"></h2>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
