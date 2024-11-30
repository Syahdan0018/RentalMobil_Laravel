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
                        <li class="list-item active-li" style="padding-left: 10px; padding-top: 10px;">
                            <a href="{{ route('carlist.admin') }}" class="full-link active-nav">My Car List</a>
                        </li>
                        <li class="list-item" style="padding-left: 15px; padding-top: 10px;">
                            <a href="{{ route('queue.index') }}" class="full-link text-shadow">Queue</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <div class="dropdown">
                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/unknownuser.jpg') }}"
                                alt="{{ $user->name }}"
                                class="rounded-circle dropdown-toggle avatar border border-2 border-white foto"
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
    <div class="container-fluid mt-2 overflow-auto" style="overflow-y: scroll;">
        <div class="row justify-content-start px-5 mt-2">
            <div class="col-4">
                <a href="{{ route('carlist.create') }}" class="btn" style="max-width: fit-content; background-color: wheat;">TAMBAH</a>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
          <div class="col-11 bg-white justify-content-center py-2 px-2" style="display: flex; border-radius: 10px;">
            <table class="col-11 table-warning" style="border-radius: 15px;">
              <thead>
                <tr class="border-bottom border-black">
                  <th scope="col" class="border border-black px-2">#</th>
                  <th scope="col" class="px-2 border border-end-0 border-black">Car Name</th>
                  <th scope="col" class="px-2 border-top border-bottom border-black"></th>
                  <th scope="col" class="border border-black px-2">Car Price</th>
                  <th scope="col" class="border border-black px-2">Quantity</th>
                  <th scope="col" class="px-2 border border-black" style="width: 150px;">Action</th>
                </tr>
              </thead>
              <tbody class="table-striped">
                @foreach ($cars as $car)
                  <tr class="border-bottom border-black">
                    <td class="border border-black px-2">{{ $loop->iteration }}</td>
                    <td class="border border-end-0 border-black px-2">{{ $car->car_name }}</td>
                    <td class="border-end border-black"><img src="{{ asset('storage/' . $car->picture) }}" style="height: 20px; aspect-ratio: 16/9;" alt="{{ $car->car_name }}"></td>
                    <td class="border border-black px-2">Rp. {{ $car->price }}.00</td>
                    <td class="border border-black px-2">{{ $car->number_of_car }} unit</td>
                    <td class="border-end border-black">
                      <a href="{{ route('carlist.edit.render', ['id' => $car->id]) }}" class="btn btn-warning" style="margin-right: 5px;display: inline-block;">EDIT</a>
                      <form action="{{ route('carlist.delete', ['id' => $car->id]) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" onclick="confirmDelete()">DELETE</button>
                      </form>
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
    <script>
      function confirmDelete(event) {
        if (!confirm('Are you sure want to delete data ?')){
          event.preventDefault();
        }
      }
    </script>
</body>

</html>
