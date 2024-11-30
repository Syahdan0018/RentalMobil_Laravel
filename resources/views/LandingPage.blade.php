<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: linear-gradient(to bottom, #007bff, #6610f2);
            color: white;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .hero {
            height: 100vh;
            background: linear-gradient(to right, #6f42c1, #e83e8c);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .card {
            border: none;
        }

        .card:hover {
            transform: scale(1.05);
            transition: 0.3s;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Rental Mobil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#car-list">Daftar Mobil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="display-4">Rent Car Easy and Quick </h1>
            <p class="lead">We provide variety of car options for your needs</p>
            <a href="#car-list" class="btn btn-primary btn-lg">Lihat Daftar Mobil</a>
        </div>
    </section>

    <!-- Services Section -->
    <!-- Daftar Mobil Section -->
    <section id="car-list" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Daftar Mobil</h2>
            <div id="mobilCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Carousel Item 1 -->
                    {{-- <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="card shadow">
                                    <a href="halaman-mobil-1.html" style="text-decoration: none; color: inherit;">
                                        <img src="https://via.placeholder.com/600x400" class="card-img-top"
                                            alt="Mobil 1">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Toyota Avanza</h5>
                                            <p class="card-text">Mobil keluarga yang nyaman untuk perjalanan Anda.</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    @foreach ($cars as $car)
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="card shadow">
                                        <a href="{{ route('rent.details', ['id' => $car->id]) }}"
                                            style="text-decoration: none; color: inherit;">
                                            <img src="{{ asset('storage/' . $car->picture) }}" class="card-img-top"
                                                alt="{{ $car->name }}">
                                            <div class="card-body text-center">
                                                <h5 class="card-title text-black">{{ $car->car_name }}</h5>
                                                <p class="card-text text-black">Rp. {{ $car->price }}.00 / hari</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#mobilCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mobilCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="container-fluid bg-dark">
        <div class="row justify-content-center">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d495.1023820093716!2d109.65097213370464!3d-6.912226495259131!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7026bcbcaa2f3d%3A0xd38d69087b42810b!2s3MQ2%2B788%2C%20Bumirejo%2C%20Kec.%20Pekalongan%20Bar.%2C%20Kota%20Pekalongan%2C%20Jawa%20Tengah%2051171!5e0!3m2!1sid!2sid!4v1732755566565!5m2!1sid!2sid"
                class="col-4" style="border:0; aspect-ratio: 16/9;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="col-6">
                <h3>Zobo Luxury Car Rent</h3>
                <p class="text-start">Office Address : Jl.Pelita II , Kecamatan Buaran - Pekalongan Selatan</p>
                <p class="text-start">Follow Us on Social Media</p>
                <div style="display: flex; justify-content: center;">
                    <a href="{{ route('instagram') }}" class="no-style" style="margin-right: 10px;"><img src="{{ asset('images/icons8-instagram-48.svg') }}"
                            alt="">instagram</a>
                    <a href="{{ route('facebook') }}" class="no-style" style="margin-right: 10px;">
                        <img src="{{ asset('images/icons8-facebook.svg') }}" alt="">
                        facebook
                    </a>
                    <a href="{{ route('twitter') }}" class="no-style" style="margin-right: 10px;">
                        <img src="{{ asset('images/icons8-twitter.svg') }}" alt="">
                        twitter X
                    </a>
                </div>
            </div>
        </div>
        <div class="row"><br></div>
        <div class="row">
            <div class="col-12">
                <p class="text-end">&copy; Shitty A-Ha Flute. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
