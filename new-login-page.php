<?php
/*
 * Template Name: newLoginPage
*/

get_header();

?>
<style>
    .swb-main-parent-container-login{
        display:flex;
        width:100%;
        
    }
    .swb-main-child-left-container{
        width:50%;
        background: url('https://www.swb-waerme.de/wp-content/uploads/2024/04/1920_1080_SNACKCHECK24-1-jpg.jpg'), rgba(0, 0, 0, 0.5);
		background-repeat: no-repeat;
    	background-position: center;
    	background-size: cover;
    }
	.blue-color-overlay{
		background:rgba(40, 57, 101, .8);
		width: 100%;
    	height: 100%;
	}
    .swb-main-child-right-container{
        width:50%;
    }
	.error-message{
		display: flex;
		justify-content: center;
		align-items: center;
		color: #f14646;
		    gap: 16px;
	}
	@media only screen and (max-width: 767px){
		.swb-main-child-left-container{
			display:none;
		}
		.swb-main-child-right-container{
			width:100%;
		}
	}
</style>
<div class="swb-main-parent-container-login">
    <div  class="swb-main-child-left-container">
		<div class="blue-color-overlay">
		
		</div>
    </div>
    <div class="swb-main-child-right-container">
		<div class="login-wrap">
		  <div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab" style="display:none;" >Sign Up</label>
			<div class="login-form">
				<form name="loginform" id="loginform" action="<?php echo esc_url(home_url()); ?>/login"  method="post">
					<div class="sign-in-htm">
						<div class="group">
							<label for="user" class="label">Username</label>
							<input id="user" name="username"  type="text" class="input">
						</div>
						<div class="group">
							<label for="pass" class="label">Password</label>
							<input id="pass" type="password" name="password" class="input" data-type="password" >
						</div>
						<div class="group" id="keep_ne_sign">
							<input id="check" type="checkbox" class="check" checked>
							<label for="check"><span class="icon"></span> Keep me Signed in</label>
						</div>
						<div class="group">
							<input type="submit" class="button" value="Sign In">
						</div>
						<div class="hr"></div>
						<div class="foot-lnk">
							<a href="#forgot">Forgot Password?</a>
						</div>
					</div>
				</form>
			  <div class="sign-up-htm">
				<div class="group">
				  <label for="user" class="label">Username</label>
				  <input id="user" type="text" class="input">
				</div>
				<div class="group">
				  <label for="pass" class="label">Password</label>
				  <input id="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
				  <label for="pass" class="label">Repeat Password</label>
				  <input id="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
				  <label for="pass" class="label">Email Address</label>
				  <input id="pass" type="text" class="input">
				</div>
				<div class="group">
				  <input type="submit" class="button" value="Sign In">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
				  <label for="tab-1">Already Member?</a>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	</div>
</div>
<script>
    jQuery(document).ready(function($) {
        $('#loginform').submit(function(e) {
            e.preventDefault();
            // Check first name
            var user = $.trim($('#user').val());
            if (user === '') {
                $('#user').after(`<div class="error-message">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                                            <path d="M10.9985 8.25006V11.6876M2.47074 14.7822C1.67691 16.1572 2.66966 17.8751 4.25641 17.8751H17.7406C19.3264 17.8751 20.3192 16.1572 19.5262 14.7822L12.7851 3.09656C11.9912 1.72156 10.0057 1.72156 9.21191 3.09656L2.47074 14.7822ZM10.9985 14.4376H11.0049V14.4449H10.9985V14.4376Z" stroke="#FF2727" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                        <p>Please enter your username</p>
                                                    </div>`);
                setTimeout(() => {
                    $('.error-message').remove();
                }, 2000);
                // valid = false;
                // e.preventDefault();
            }
            var Password = $.trim($('#pass').val());
            if (Password === '') {
                $('#pass').after(`<div class="error-message">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                                            <path d="M10.9985 8.25006V11.6876M2.47074 14.7822C1.67691 16.1572 2.66966 17.8751 4.25641 17.8751H17.7406C19.3264 17.8751 20.3192 16.1572 19.5262 14.7822L12.7851 3.09656C11.9912 1.72156 10.0057 1.72156 9.21191 3.09656L2.47074 14.7822ZM10.9985 14.4376H11.0049V14.4449H10.9985V14.4376Z" stroke="#FF2727" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                        <p>Please enter your password</p>
                                                    </div>`);
                setTimeout(() => {
                    $('.error-message').remove();
                }, 2000);
                // valid = false;
                // e.preventDefault();
            }
             // Get form data
             var formData = $(this).serialize();
             console.log(formData);
             $.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: formData + '&action=custom_login',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.success == true) {
                        // Redirect to the specified URL on successful login
                        window.location.href = response.data.redirect;
                    }
                    else{
                        // Display login error message
                        $('#keep_ne_sign').after(`<div class="error-message">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path d="M10.9985 8.25006V11.6876M2.47074 14.7822C1.67691 16.1572 2.66966 17.8751 4.25641 17.8751H17.7406C19.3264 17.8751 20.3192 16.1572 19.5262 14.7822L12.7851 3.09656C11.9912 1.72156 10.0057 1.72156 9.21191 3.09656L2.47074 14.7822ZM10.9985 14.4376H11.0049V14.4449H10.9985V14.4376Z" stroke="#FF2727" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <p>${response.data.message}</p>
                        </div>`);
                        setTimeout(() => {
                            $('.error-message').remove();
                        }, 2000);
                    }
                }
                
             });
        });
    });
</script>