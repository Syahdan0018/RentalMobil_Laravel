<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/registerpage.css') }}">
</head>

<body>
    @if ($type == 'tenant')
        <h2 class="text-center mt-4" style="margin-bottom: 25px;">Register Page Tenant</h2>
        <form action="{{ route('register.submit', ['type' => $type]) }}" enctype="multipart/form-data"
            class="container-fluid"method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 col-sm-12 py-2" style="height: 85vh; margin-left: 10px;">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">🏷️</span>
                        <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="name"
                            aria-describedby="basic-addon1">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text">email</span>
                        <input type="email" placeholder="email" name="email" class="form-control"
                            aria-describedby="bassic-addon1" aria-label="email">
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                            name="username" aria-describedby="basic-addon1">
                    </div>
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">🔐</span>
                        <input type="password" class="form-control" placeholder="Password" aria-label="Passsword"
                            name="password" aria-describedby="basic-addon1">
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text">Gender</span>
                        <select name="gender" class="form-select" class="form-select" id="">
                            <option value="male" selected>Laki Laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                    </div>
                    @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">📅</span>
                        <input type="date" class="form-control" placeholder="Tanggal Lahir" name="born_date"
                            aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    @error('born_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text">Regional</span>
                        <select name="regional" class="form-select" class="form-select" id="">
                            @foreach ($regionals as $regional)
                                <option value="{{ $regional->id }}">Provinsi: {{ $regional->province }}, Distrik:
                                    {{ $regional->district }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('regional')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group">
                        <span class="input-group-text">Alamat</span>
                        <textarea class="form-control" name="address" aria-label="With textarea"></textarea>
                    </div>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="mt-2">
                        <p>Avatar Image</p>
                        <input type="file" class="form-control" name="avatar">
                    </div>
                    @error('avatar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="row mt-3">
                        <div class="col-12 justify-content-end" style="display: flex;">
                            <button type="submit" class="btn btn-primary"
                                style="margin-right: 20px;">REGISTER</button>
                            <a href="{{ route('login') }}" class="btn btn-danger">CANCEL</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @elseif ($type == 'admin')
        <h2 class="text-center">Register Page Admin</h2>
        <form action="{{ route('register.submit', ['type' => $type]) }}" enctype="multipart/form-data"
            class="container-fluid"method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 col-sm-12 py-2" style="height: 85vh; margin-left: 10px;">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">🏷️</span>
                        <input type="text" class="form-control" placeholder="Name" aria-label="Name"
                            name="name" aria-describedby="basic-addon1">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text">email</span>
                        <input type="email" placeholder="email" name="email" class="form-control"
                            aria-describedby="bassic-addon1" aria-label="email">
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                            name="username" aria-describedby="basic-addon1">
                    </div>
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">🔐</span>
                        <input type="password" class="form-control" placeholder="Password" aria-label="Passsword"
                            name="password" aria-describedby="basic-addon1">
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="mt-2">
                        <p>Avatar Image</p>
                        <input type="file" class="form-control" name="avatar">
                    </div>
                    @error('avatar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="row mt-3">
                        <div class="col-12 justify-content-end" style="display: flex;">
                            <button type="submit" class="btn btn-primary"
                                style="margin-right: 20px;">REGISTER</button>
                            <a href="{{ route('login') }}" class="btn btn-danger">CANCEL</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        @error('pesan_error')
            alert('{{ $message }}');
        @enderror
    </script>
</body>

</html>
