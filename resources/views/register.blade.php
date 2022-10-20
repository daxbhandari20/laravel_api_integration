<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
    span {
        color: red;
    }
</style>

<h1>User Registration</h1>

<form id="register_form">
    <input type="text" name="name" placeholder="Enter Name">
    <br>
    <span class="error name_err"></span>
    <br><br>
    <input type="email" name="email" placeholder="Enter Email">
    <br>
    <span class="error email_err"></span>
    <br><br>
    <input type="password" name="password" placeholder="Enter Password">
    <br>
    <span class="error password_err"></span>
    <br><br>
    <input type="password" name="password_confirmation" placeholder="Enter Confirm Password">
    <br>
    <span class="error password_confirmation_err"></span>
    <br><br>
    <input type="submit" value="Register">
</form>
<br>
<p class="result"></p>

<script>
    $(document).ready(function() {
        $('#register_form').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "http://127.0.0.1:8000/api/register",
                type: "POST",
                data: formData,
                success: function(data) {
                    if (data.msg) {
                        $('#register_form')[0].reset();
                        $('.error').text("");
                        $('.result').text(data.msg);
                    } else {
                        printErrorMsg(data);

                    }
                }
            });

            function printErrorMsg(msg) {
                $('.error').text("");
                $.each(msg, function(key, val) {
                    if (key == 'password') {
                        if (val.length > 1) {
                            $('.password_err').text(val)[0];
                            $('.password_confirmation_err').text(val)[1];
                        } else {
                            if (val[0].includes('password confirmation')) {
                                $(".password_confirmation_err").text(val)
                            } else {
                                $(".password_err").text(val)
                            }
                        }
                    } else {
                        $('.' + key + '_err').text(val);
                    }
                });
            }

        });
    })
</script>
