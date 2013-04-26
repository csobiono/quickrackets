{include file="includes/overall_header.tpl"}
{ci_form type="open" url="auth/forgot_password"}
<table>
	<tr>
		<td>{ci_form type="label" text="Email or login" id="login"}</td>
		<td>{ci_form type="input" name="login" id="login" value="{ci_form_validation field='login'}" maxlength="80" size="30"}</td>
		<td style="color: red;">{ci_form_validation field='login' error='true'}</td>
	</tr>
</table>
{ci_form type="submit" name="reset" value="Get a new password"}
{ci_form type="close"}
{include file="includes/overall_footer.tpl"}