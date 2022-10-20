@include('herder')
<h1>Hii, <span class="name"></span></h1>
<div class="email_verify">
    <p><b>Email:- <span class="email"></span> &nbsp; <span class="verify"></span></b></p>
</div>

<form action="" id="ProfileForm">
    <input type="hidden" value="" name="id" id="user_id">
    <input type="text" name="name" placeholder="Enter Your Name" id="name">
    <br>
    <span class="error name_error" style="color: red"></span>
    <br><br>
    <input type="email" name="email" placeholder="Enter Your Email" id="email">
    <br>
    <span class="error email_error" style="color: red"></span>
    <br><br>
    <button name="submit" value="">Update Profile</button>
</form>
<br>
<div class="result"></div>


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
                    $('#user_id').val(data.data.id);
                    $('.name').text(data.data.name);
                    $('.email').text(data.data.email);
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
        $("#ProfileForm").submit(function(event) {
            event.preventDefault();
            var formData = $('#ProfileForm').serialize();
            $.ajax({
                url: "http://127.0.0.1:8000/api/profile-update",
                type: "POST",
                data: formData,
                headers: {
                    'Authorization': localStorage.getItem('user_token')
                },
                success: function(data) {
                    if (data.success == true) {
                        $('.error').text("");
                        setTimeout(() => {
                            $('.result').text("")
                        }, 2000);
                        $('.result').text(data.msg)
                    } else {
                        printErrorMsg(data);
                    }
                }
            })
        });

        function printErrorMsg(msg) {
            $('.error').text("");
            $.each(msg, function(key, value) {
                $("." + key + "_error").text(value);
            });
        }
    });
</script>
