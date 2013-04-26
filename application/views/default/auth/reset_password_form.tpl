{include file="includes/overall_header.tpl"}
{ci_form type="open" url="auth/reset_password"}
<table>
	<tr>
		<td>{ci_form type="label" text="New Password" id="new_password"}</td>
		<td>{ci_form type="password" name="new_password" id="new_password" size="30"}</td>
		<td style="color: red;">{ci_form_validation field='new_password' error='true'}</td>
	</tr>
	<tr>
		<td>{ci_form type="label" text="Confirm New Password" id="confirm_new_password"}</td>
		<td>{ci_form type="password" name="confirm_new_password" id="confirm_new_password" size="30"}</td>
		<td style="color: red;">{ci_form_validation field='confirm_new_password' error='true'}</td>
	</tr>
</table>
{ci_form type="submit" name="submit" value="Change Password"}
{ci_form type="close"}
{include file="includes/overall_footer.tpl"}