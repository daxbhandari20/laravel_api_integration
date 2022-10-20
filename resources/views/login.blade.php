@include('herder')
<style>
    span {
        color: red;
    }
</style>

<section>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <!-- Default form login -->
                <form class="text-center border border-dark p-5" id="login_form">

                    <p class="h4 mb-4">Sign in</p>

                    <!-- Email -->
                    <input type="email" name="email" class="form-control mb-4" placeholder="E-mail">

                    <span class="error email_err"></span>

                    <!-- Password -->
                    <input type="password" name="password" class="form-control mb-4" placeholder="Password">

                    <span class="error password_err"></span>

                    <div class="d-flex justify-content-around">
                        <div>
                            <!-- Remember me -->
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                                <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
                            </div>
                        </div>
                        <div>
                            <!-- Forgot password -->
                            <a href="">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Sign in button -->
                    <button class="btn btn-info btn-block my-4" type="submit">Sign in</button>

                    <!-- Register -->
                    <p>Not a member?
                        <a href="/register">Register</a>
                    </p>

                    <!-- Social login -->
                    <p>or sign in with:</p>

                    <a href="#" class="mx-2" role="button"><i
                            class="fab fa-facebook-f light-blue-text"></i></a>
                    <a href="#" class="mx-2" role="button"><i class="fab fa-twitter light-blue-text"></i></a>
                    <a href="#" class="mx-2" role="button"><i
                            class="fab fa-linkedin-in light-blue-text"></i></a>
                    <a href="#" class="mx-2" role="button"><i class="fab fa-github light-blue-text"></i></a>

                </form>
                <!-- Default form login -->
            </div>
        </div>
    </div>
</section>


{{-- <form id="login_form">
    <input type="email" name="email" placeholder="Enter Email">
    <br>
    <span class="error email_err"></span>
    <br><br>
    <input type="password" name="password" placeholder="Enter Password">
    <br>
    <span class="error password_err"></span>
    <br><br>
    <input type="submit" value="Login">
</form> --}}
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
