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
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                Ilham Shubkhi</a>
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
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center fw-bold mt-2">Welcome to My Portfolio</h1>
                <p class="text-center text-muted">This is my portfolio, where I showcase my skills and experiences as a web developer.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($portofolios as $index => $data)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="{{ url("assets/images/{$data->image}") }}" alt="Image" class="card-img-top rounded shadow image-clickable" style="width: 100%; height: 100%;">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="text-muted">Created: <strong>{{ \Carbon\Carbon::parse($data->dateCreate)->format('d/M/Y - H:i') }}</strong></span>
                                <p class="text-muted">Last Update: <strong>{{ \Carbon\Carbon::parse($data->lastUpdate)->format('d/M/Y - H:i') }}</strong></p>
                            </div>
                            <h2 class="fw-bold">{{ $data->title }}</h2>
                            <p class="card-text flex-grow-1">{{ $data->description }}</p>
                            <a href="{{ url('#') }}" class="btn btn-primary shadow-sm mt-auto">View Project</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade shadow" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" id="modalImage" class="img-fluid shadow rounded" alt="Preview Image" style="width: 100%; height: 100%;">
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p class="text-center mt-3">&copy; 2024 - Build with ❤️ Ilham Shubkhi</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const images = document.querySelectorAll('.image-clickable');
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            const modalImage = document.getElementById('modalImage');

            images.forEach(image => {
                image.addEventListener('dblclick', function () {
                    modalImage.src = this.src;
                    modal.show();
                });
            });
        });
    </script>
</body>

</html>
