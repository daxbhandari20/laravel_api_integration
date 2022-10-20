@include('herder')
<h1>Hii, <span class="name"></span></h1>
<div class="email_verify">
    <p><b>Email:- <span class="email"></span> &nbsp; <span class="verify"></span></b></p>
</div>

<form action="">
    <input type="text" name="name" placeholder="Enter Your Name" id="name" required>
    <br><br>
    <input type="email" name="email" placeholder="Enter Your Email" id="email" required>
    <br><br>
    <button name="submit" value="">Update Profile</button>
</form>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "http://127.0.0.1:8000/api/profile",
            type: "GET",
            headers: {
                'Authorization': localStorage.getItem('user_token')
            },
            success: function(data) {
                if (data.success == true) {
                    $('.name').html(data.data.name);
                    $('.email').html(data.data.email);
                    $('#name').val(data.data.name);
                    $('#email').val(data.data.email);
                    if (data.data.email_verified_at == null || data.data.email_verified_at == '') {
                        $('.verify').html("<a href=''>Verify</a>")
                    } else {
                        $('.verify').text("Verified")
                    }
                } else {
                    alert(data.msg);
                }
            }
        });
    });
</script>
