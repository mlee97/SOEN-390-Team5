<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ERP System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Global Styles -->
    <style>


    </style>

</head>
<body>

@if(count($errors->all()))
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <form action={{route('login')}} method="POST">

                <div class="d-flex flex-column border rounded shadow mt-5 p-2 ">
                    <div class="p-3 text-center">
                        <h1 class="display-6">Login</h1>
                    </div>

                    <div class="p-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}"
                               required>
                    </div>

                    <div class="p-3 flex-shrink-1">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name=password class="form-control" id="password" required
                               autocomplete="current-password">

                    </div>
                    {{csrf_field()}}
                    <div class="p-4">
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>

