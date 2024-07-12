<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Portofolio Ilham Shubkhi - 2024</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Ilham Shubkhi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs
                target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center fw-bold mt-2">Welcome to My Portfolio</h1>
                <p class="text-center text-exception">This is my portfolio, where I showcase my skills
                    and experiences as a web developer.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($portofolios as $index => $data)
                <div class="card shadow-sm mt-3" style="width: 20rem;">
                    <img src="{{ url("assets/images/{$data->image}") }}" alt="Image" class="rounded shadow" style="width: 100%; height: 100%; max-width: 400px;">
                    <div class="card-body">
                        <div class="card-title">
                            <h2 class="fw-bold">{{ $data->title }}</h2>
                        </div>
                        <p class="card-text">{{ $data->description }}</p>
                        <a href="{{ url('#') }}" class="btn btn-primary shadow-sm">View Project</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <footer class="footer">
        <p class="text-center mt-3">&copy; 2024 - Build with ❤️ Ilham Shubkhi</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
