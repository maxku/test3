<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
            crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <ul class="nav navbar-nav">
        <li><a href="/">Posts</a></li>
        <li><a href="/admin">Admin</a></li>
        @if(Auth::check())
            <li><a href="/logout">Logout</a></li>
        @else
            <li><a href="/login">Login</a></li>
        @endif
    </ul>
</nav>
<div class="container">
    @yield('content')
</div>
</body>
</html>
