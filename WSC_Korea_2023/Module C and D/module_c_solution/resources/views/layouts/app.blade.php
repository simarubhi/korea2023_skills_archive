<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Gaming Portal</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap.min.css') }}">
</head>
<body>
    @yield('content')

    <script src="{{ url('/js/bootstrap.bundle.js') }}"></script>
</body>
</html>
