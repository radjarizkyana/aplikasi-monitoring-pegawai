<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Aplikasi Monitoring Pegawai</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"><style>
        body {
            background-color: rgb(217, 220, 226);
        }
        .container {
            margin-top: 15%;
        }
        .card {
            box-shadow: 0 4px 8px 0 rgba(0.2,0,0,0.4);
            border-radius: 8px;
        }
        .card-header {
            background-color: rgb(232, 235, 240);
        }
        .form-control {
            width: 32vh;
        }
    </style>
</head>
<body>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 mx-4">
                    <div class="card-header">{{ __('Masuk Aplikasi Monitoring Pegawai') }}</div>

                    <div class="card-body mt-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                
                                <label for="username" class="col-md-4 col-form-label text-md-left"><i class="fa fa-user mx-2"></i>{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-left"><i class="fa fa-lock mx-2"></i>{{ __('Kata Sandi') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn-sm btn-primary px-3">
                                        {{ __('Masuk') }}
                                    </button>
                                </div>
                            </div>

                            @if (session('error'))
                                <div class="alert alert-danger mt-3">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>