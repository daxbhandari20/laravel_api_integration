@include('herder')
<style>
    span {
        color: red;
    }
</style>

<h1>Login User</h1>

<form id="login_form">
    <input type="email" name="email" placeholder="Enter Email">
    <br>
    <span class="error email_err"></span>
    <br><br>
    <input type="password" name="password" placeholder="Enter Password">
    <br>
    <span class="error password_err"></span>
    <br><br>
    <input type="submit" value="Login">
</form>
<br>
<p class="result"></p>

<script>
    $(document).ready(function() {
        $('#login_form').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "http://127.0.0.1:8000/api/login",
                type: "POST",
                data: formData,
                success: function(data) {
                    $(".error").text("");
                    if (data.success == false) {
                        $('.result').text(data.msg);
                    } else if (data.success == true) {
                        localStorage.setItem("user_token", data.token_type + " " + data
                            .access_token);
                        window.open('/profile', "_self");
                    } else {
                        printErrorMsg(data);
                    }
                }
            });

            function printErrorMsg(msg) {
                $('.error').text("");
                $.each(msg, function(key, val) {
                    $('.' + key + '_err').text(val);
                });
            }

        });
    })
</script>
