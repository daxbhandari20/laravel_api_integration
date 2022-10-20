<!DOCTYPE html>
<html lang="en">

<head>
    <title>Example API</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <button class="logout">Logout</button>

    <script>
        var token = localStorage.getItem('user_token');
        if (window.location.pathname == '/login' || window.location.pathname == '/register') {
            if (token != null) {
                window.open('/profile', '_self');
            }
            $('.logout').hide();
        } else {
            if (token == null) {
                window.open('/login', '_self');
            }
        }

        // Logout User

        $(document).ready(function() {
            $('.logout').click(function() {
                $.ajax({
                    url: "http://127.0.0.1:8000/api/logout",
                    type: "GET",
                    headers: {
                        'Authorization': localStorage.getItem('user_token')
                    },
                    success: function(data) {
                        if (data.success == true) {
                            localStorage.removeItem('user_token');
                            window.open("/login", '_self');
                        } else {
                            alert(data.msg);
                        }
                        console.log(data);
                    }
                })
            });
        });
    </script>
