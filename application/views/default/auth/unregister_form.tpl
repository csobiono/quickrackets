{include file="includes/overall_header.tpl"}
{ci_form type="open" url="auth/unregister"}
<table>
	<tr>
		<td>{ci_form type="label" text="Password" id="password"}</td>
		<td>{ci_form type="password" name="password" id="password" size="30"}</td>
		<td style="color: red;">{ci_form_validation field='password' error='true'}</td>
	</tr>
</table>
{ci_form type="submit" name="cancel" value="Delete account"}
{include file="includes/overall_footer.tpl"}
