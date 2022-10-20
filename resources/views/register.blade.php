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
                <!-- Default form register -->
                <form class="text-center border border-dark p-5" action="#!">

                    <p class="h4 mb-4">Sign up</p>

                    <!-- First name -->
                    <input type="text" name="name" class="form-control mb-4" placeholder="Enter Name">

                    <!-- E-mail -->
                    <input type="email" name="email" class="form-control mb-4" placeholder="E-mail">

                    <!-- Password -->
                    <input type="password" name="password" class="form-control mb-4" placeholder="Password">

                    <!-- Phone number -->
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Confirm Password">

                    <!-- Sign up button -->
                    <button class="btn btn-info my-4 btn-block" type="submit">Sign in</button>

                    <!-- Register -->
                    <p>Already Registered?
                        <a href="/login">Click here to login</a>
                    </p>

                    <!-- Social register -->
                    <p>or sign up with:</p>

                    <a href="#" class="mx-2" role="button"><i
                            class="fab fa-facebook-f light-blue-text"></i></a>
                    <a href="#" class="mx-2" role="button"><i class="fab fa-twitter light-blue-text"></i></a>
                    <a href="#" class="mx-2" role="button"><i
                            class="fab fa-linkedin-in light-blue-text"></i></a>
                    <a href="#" class="mx-2" role="button"><i class="fab fa-github light-blue-text"></i></a>

                    <hr>

                    <!-- Terms of service -->
                    <p>By clicking
                        <em>Sign up</em> you agree to our
                        <a href="" target="_blank">terms of service</a>

                </form>
                <!-- Default form register -->
            </div>
        </div>
    </div>
</section>

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
