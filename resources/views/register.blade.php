<!doctype html>
<html lang="en">
<head>
    <title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('cssLogin/style.css') }}">

</head>
<body class="img js-fullheight" style="background-image: url({{asset('img/bg.jpg')}});">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Login #10</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Register</h3>
                    <form action="{{ route('user.register') }}" class="signin-form" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name" name="name" required>
                        </div>
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <input id="password-field" type="text" class="form-control" placeholder="Password"
                                   name="password" required>
                        </div>
                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        @can('admin')
                            <table style="width: 70%;">
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input"
                                                       name="role"
                                                       id="optionsRadios1" value="1">
                                                Admin
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input"
                                                       name="role"
                                                       id="optionsRadios2" value="2">
                                                User
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        @else
                            <input type="hidden" name="role" value="2">
                        @endcan
                        @error('role')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="{{ route('user.formLogin') }}" style="color: #fff">Have account??</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<script src="{{ asset('jsLogin/jquery.min.js') }}"></script>
<script src="{{ asset('jsLogin/popper.js') }}"></script>
<script src="{{ asset('jsLogin/bootstrap.min.js') }}"></script>
<script src="{{ asset('jsLogin/main.js') }}"></script>

</body>
</html>


w
