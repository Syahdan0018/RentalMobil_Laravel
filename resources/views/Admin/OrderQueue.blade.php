<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/authenticated.css') }}">
</head>

<body class="overflow-auto" style="display: flex; flex-direction: column;">
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
                        <li class="list-item active-li" style="padding-left: 15px; padding-top: 10px;">
                            <a href="{{ route('queue.index') }}" class="full-link active-nav">Queue</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <div class="dropdown">
                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/unknownuser.jpg') }}"
                                alt="{{ $user->name }}"
                                class="rounded-circle dropdown-toggle avatar border-2 border-white foto" role="button"
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
    <div class="container-fluid w-100" style="flex-grow: 1;">
        <div class="row mt-3">
            <div class="col-12">
                <h2 class="text-center text-white">Order Queue List</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Penyewa</th>
                            <th scope="col"></th>
                            <th scope="col">Mobil</th>
                            <th scope="col"></th>
                            <th scope="col">Jumlah Unit Di sewa</th>
                            <th scope="col">Durasi</th>
                            <th scope="col">Total Biaya</th>
                            <th scope="col">Status Penyewaan</th>
                            <th scope="col">Edit Order Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($datas as $data)
                            <tr>
                                <td scope="row" class="border">{{ $loop->iteration }}</td>
                                <td>{{ $data->tenant->user->name }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $data->tenant->user->avatar) }}"
                                        class="rounded-circle" width="35" height="35"></img>
                                </td>
                                <td class="border border-end-0">
                                    {{ $data->car->car_name }}
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $data->car->picture) }}" class="rounded"
                                        width="35" height="35">
                                </td>
                                <td class="border">
                                    {{ $data->unit }} unit
                                </td>
                                <td class="border">{{ $data->duration }} hari</td>
                                <td class="border">Rp. {{ $data->total_price }}</td>
                                <td class="border">{{ $data->status }}</td>
                                <td class="border">
                                    @if ($data->status == 'pending confirm')
                                        <form action="{{ route('queue.confirm', ['id' => $data->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">CONFIRM ORDER</button>
                                        {{-- </form>
                                        <form action="{{ route('rent.reject', ['id' => $data->id]) }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <button type="submit" class="btn btn-danger">REJECT ORDER</button>
                                        </form> --}}
                                    @elseif ($data->status == 'pending to return')
                                        <form action="{{ route('confirm.return', ['id' => $data->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">CONFIRM RETURNING</button>
                                        </form>
                                    @elseif ($data->status == 'confirmed')
                                      <form action="{{ route('rent.rentingStatus', ['id' => $data->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary">CAR HAS RENT</button>
                                      </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
