<div style='padding-bottom: 15px; border-bottom: 1px solid #44a516'>
	<h2 style='line-height: 2px; color:#27600d'>Sign Up</h2>
	<span style='color:#43a516'>It's free and always will be.</span>
</div>
<form name='register' method='post'>
<table style='padding-top: 15px; line-height: 2px'>

	<tr>
		<td class='reg-label'>{ci_form type="label" text="Username" id="username"}</td>
		<td>{ci_form type="input" name="username" id="username" value="{ci_form_validation field='username'}" maxlength="80"}</td>
	</tr>
	
	<tr>
		<td class='reg-label'>{ci_form type="label" text="First Name" id="firstname"}</td>
		<td>{ci_form type="input" name="firstname" id="firstname" value="{ci_form_validation field='firstname'}" maxlength="80"}</td>
	</tr>
	

	<tr>
		<td class='reg-label'>{ci_form type="label" text="Last Name" id="lastname"}</td>
		<td>{ci_form type="input" name="lastname" id="lastname" value="{ci_form_validation field='lastname'}" maxlength="80"}</td>
	</tr>
	

	<tr>
		<td class='reg-label'>{ci_form type="label" text="Email Address" id="email"}</td>
		<td>{ci_form type="input" name="email" id="email" value="{ci_form_validation field='email'}" maxlength="80"}</td>
	</tr>
	
	
	<tr>
		<td class='reg-label'>{ci_form type="label" text="Password" id="reg_password"}</td>
		<td>{ci_form type="password" name="reg_password" id="reg_password" maxlength="80" size="30"}</td>
	</tr>
	
	<tr>
		<td class='reg-label'>{ci_form type="label" text="Confirm Password" id="confirm_password"}</td>
		<td>{ci_form type="password" name="confirm_password" id="confirm_password" maxlength="80" size="30"}</td>
	</tr>
	
	<!--here-->
	<tr>
		<td class='reg-label'>{ci_form type="label" text="Gender" id="gender"}</td>
		<td>
			<select name="gender">
   			{html_options options=$gender selected='0'}
			</select>
		</td>
	</tr>
	

	<tr>
		<td class='reg-label'>{ci_form type="label" text="Country" id="country"}</td>
		<td>
			<select name="country">
   			{html_options options=$country selected='0'}
			</select>
		</td>
	</tr>
	

	<tr>
		<td class='reg-label'>{ci_form type="label" text="Birthday" id="birthday"}</td>
		<td>
			<select name="month" class='b-day'>
   			{html_options options=$month selected='0'}
			</select>
			<select name="day" class='b-day'>
   			{html_options options=$day selected='0'}
			</select>
			<select name="year" class='b-day'>
   			{html_options options=$year selected='0'}
			</select>
		</td>
	</tr>
	
	<!--<tr>
		<td class='reg-label'>{ci_form type="label" text="Gender" id="gender"}</td>
		<td>{ci_form type="input" name="gender" id="gender" value="{ci_form_validation field='gender'}" maxlength="80"}</td>
	</tr>
	<tr><td style="color: red;" colspan='2'>{ci_form_validation field='gender' error='true'}</td></tr>-->
    {if $captcha_registration}
		{if $use_recaptcha}
	<tr>
		<td colspan="2">
			<div id="recaptcha_image"></div>
		</td>
		<td>
			<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="recaptcha_only_if_image">Enter the words above</div>
			<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
		</td>
		<td><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
		<td style="color: red;">{ci_form_validation field='recaptcha_response_field' error='true'}</td>
		{$recaptcha_html}
	</tr>
	{else}
	<tr>
		<td colspan="3">
			<p>Enter the code exactly as it appears:</p>
			{$captcha_html}
		</td>
	</tr>
	<tr>
		<td class='reg-label'>{ci_form type="label" text="Confirm Code" id="captcha"}</td>
		<td>{ci_form type="input" name="captcha" id="captcha" maxlength="8"}</td>
		<td style="color: red;">{ci_form_validation field='captcha' error='true'}</td>
	</tr>
	   {/if}
	{/if}
</table>
<div id='submit-register'>Sign Up</div>
<div id='load-registration'></div>
{ci_form type="close"}
<div id='error-div'>Something's wrong!</div>