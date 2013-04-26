<form method="Post" name="login" id="form1" name="form1" action='/login'>
            
    <div class='login-field username-field'>
        <p>Email / Username:</p>
        <input type="text" class='field4login' class="fr" name="login">
        <p class='login-text'>
            <input type="checkbox" name="remember" style='height: 13px;' value='{if isset($data)}{'yeah'}{/if}'>
            Keep me logged in
        </p>
    </div>
                
    <div class='login-field password-field'>
        <p>Password:</p>
        <input type="password" class='field4login' class="fr" name="password">
        <div id='submit-login'>Log In</div>
        
        <p class='login-text'>Forgot Password?</p>
    </div>
</form> 