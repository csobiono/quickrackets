<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>{if $pagetitle}{$pagetitle} &bull; {/if}quickRACKETS</title>
<LINK rel='shortcut icon' HREF="/themes/images/logo/quick-rackets.png">
{css_include src='data_table_jui.css'}
{css_include src='jquery-ui/south-street/jquery-ui-1.8.21.custom.css'}
{if $is_logged_in}
{css_include src='user_general.css'}
{else}
{css_include src='general.css'}
{/if}

{if $controller_css}
{css_include src=$controller_css}
{/if}

{js_include src='jquery-ui-1.8.21.custom-south-street/js/jquery-1.7.2.min.js'}
{js_include src='jquery-ui-1.8.21.custom-south-street/js/jquery-ui-1.8.21.custom.min.js'}
{js_include src='jquery.dataTables.min.js'}
{js_include src='jquery.slimScroll.min.js'}
{js_include src='jquery.validate.js'}

</head>
<body>
{if $is_logged_in}
<div id='main-container'>
	<div id='top'>
		
		<a id='account' href='javascript:void(0)'>
			<span id='user-country'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			{$user_login}
		</a><br />
	</div>
	<div id='middle'>
		{if $this->uri->segment(1) != 'start-a-racket-for-free'}
		<div id='left-nav'>
			<ul>
				<li id='add-new-racket'>Add a Racket</li>
				<li id='qracket-link'>Quick Rackets</li>
				<li id='cracket-link'>Created Rackets</li>
				<li id='dracket-link'>Participations</li>
				<li id='browse-link'>Browse Racketeers</li>
				<li id='groups-link'>My Groups</li>
				<li id='funds-link'>My Money <span class='notice'>+0.08 USD</span></li>
				<li id='support-link'>Support</li>
				<li id='events-link'>Events</li>
			</ul>
		</div>
		{else}
		<div id='head'>
			<div class='wrapper'>
			<a id='qracket-logo' href='/'>quickRACKETS</a>
			</div>
		</div>
		{/if}

		<div id='playground'>
			<div id='top_nav'>
				{if $this->uri->segment(1) == 'start-a-racket-for-free'}
				<div id='progressbar'></div>
				{/if}
				<div id='breadcrumbs'><a class='bcrumb root'></a></div>
				<div id='misc'>
					<a id='show-hidden-rackets' alt='Show Hidden' href='javascript:void(0)'></a>
					<input class='search' type='text' name='search' value='Search Rackets'></input>
				</div>
				
{else}
<div id='head'>
	<div class='wrapper'>
	<a id='qracket-logo' href='/'>quickRACKETS</a>
	{if $this->uri->segment(1) != 'login'}
	{include file="auth/login_form.tpl"}
	{/if}
	</div>
</div>
{if $this->uri->segment(1) != ""}
<div id='sign-up-notif'>
	<div class='wrapper'>
		<div id='sign-up-link' style='margin-left:20px'>Sign Up</div>
	</div>
</div>
{/if}
<div id='main-container'>

{/if}