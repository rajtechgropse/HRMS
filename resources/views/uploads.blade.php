<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial, sans-serif';
        }

        .card {
            margin: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .card-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <div class="layout-px-spacing">
        <div class="container-fluid">
            <div class="row layout-top-spacing">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        @foreach ($fileUploads as $photo)
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 d-flex">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="card-title">{{ $photo->category }}</h2>
                                            @foreach (json_decode($photo->contract) as $picture)
                                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path("images/$picture"))) }}"
                                                    alt="Contract Image" class="card-img">
                                            @endforeach
                                            <p class="card-text"><small class="text-muted">Uploaded on
                                                    {{ $photo->created_at }}</small></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
