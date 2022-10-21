@include('herder')
<style>
    span {
        color: red;
        marg
    }
</style>

<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100 border rounded p-5">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                    class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <span class="result"></span>
                <form id="login_form">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" name="email" id="form1Example13" class="form-control form-control-lg"
                            placeholder="Enter Email" />
                        <span class="error email_err"></span>
                        {{-- <label class="form-label" for="form1Example13">Email address</label>  --}}
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="form1Example23" class="form-control form-control-lg"
                            placeholder="Enter Password" />
                        <span class="error password_err"></span>
                        {{-- <label class="form-label" for="form1Example23">Password</label> --}}
                    </div>

                    <div class="d-flex justify-content-around align-items-center mb-4">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="form1Example3" value=""
                                name="checkbox" checked />
                            <label class="form-check-label" for="form1Example3"> Remember me </label>
                        </div>
                        <a href="#!" class="text-right">Forgot password?</a>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                    <!-- Register -->
                    <p class="text-right">Not a member?
                        <a href="/register">Register</a>
                    </p>

                    <div class="divider align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                    </div>

                    <a href="#!" class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;"
                        role="button"><i class="fab fa-google me-2"></i> Sign in with google</a>
                    <a href="#!" class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998"
                        role="button"><i class="fab fa-facebook-f me-2"></i> Continue with Facebook
                    </a>

                </form>
            </div>
        </div>
    </div>
</section>

{{-- <section>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <!-- Default form login -->
                <form class="text-center border border-dark p-5" id="login_form" action="POST">

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
</section> --}}


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
