<!DOCTYPE html>
<html lang="id-ID">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .w-350 {
            width: 350px;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="position-absolute top-50 start-50 translate-middle">
                    <div class="card w-350">
                        <div class="card-header text-center">
                            <h2>Sign In</h2>
                        </div>
                        <div class="card-body">
                            <form action="proses/index.php" method="POST">
                                <div class="mb-3">
                                    <input type="email" class="form-control form-control-lg " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control form-control-lg " id="exampleInputPassword1" placeholder="Masukan Password" name="password" required>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" type="submit" name="tombolSubmit">Masuk</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>