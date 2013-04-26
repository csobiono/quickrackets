{include file="includes/overall_header.tpl"}
{ci_form type="open" url="auth/change_email"}
<table>
	<tr>
		<td>{ci_form type="label" text="Password" id="password"}</td>
		<td>{ci_form type="password" name="password" id="password" size="30"}</td>
		<td style="color: red;">{ci_form_validation field='password' error='true'}</td>
	</tr>
	<tr>
		<td>{ci_form type="label" text="New email address" id="email"}</td>
		<td>{ci_form type="input" name="email" id="email" maxlength="80" size="30" value="{ci_form_validation field='email'}"}</td>
		<td style="color: red;">{ci_form_validation field='email' error='true'}</td>
	</tr>
</table>
{ci_form type="submit" name="change" value="Send confirmation email"}
{ci_form type="close"}
{include file="includes/overall_footer.tpl"}