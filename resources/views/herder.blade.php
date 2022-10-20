<!DOCTYPE html>
<html lang="en">

<head>
    <title>Example API</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <script>
        var token = localStorage.getItem('user_token');
        if (window.location.pathname == '/login' || window.location.pathname == '/register') {
            if (token != null) {
                window.open('/profile', '_self');
            }
        } else {
            if (token == null) {
                window.open('/login', '_self');
            }
        }
    </script>
