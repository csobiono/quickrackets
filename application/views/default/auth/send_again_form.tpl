{include file="includes/overall_header.tpl"}
{ci_form type="open" url=""}
<table>
	<tr>
		<td>{ci_form type="label" text="Email Address" id="email"}</td>
		<td>{ci_form type="input" name="email" id="name" value="{ci_form_validation field='email'}" maxlength="80" size="30"}</td>
		<td style="color: red;">{ci_form_validation field='email' error='true'}</td>
	</tr>
</table>
{ci_form type="submit" name="send" value="Send"}
{ci_form type="close"}
{include file="includes/overall_footer.tpl"}