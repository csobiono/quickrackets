{if $is_logged_in}
</div><!-- element pair is on overall_header.tpl (playground) -->
<div id='account-min-view'></div>
<div id='account-min-view-arrow'></div>
</div><!-- element pair is on overall_header.tpl (middle) -->
</div><!-- element pair is on overall_header.tpl (main_container) -->
{else}

<br />
<br />
<div id='footer-holder'>
<div id='about' class='inlines'><p class='link-title'>About</p>Blog<br />Contact<br />Forum</div>
<div id='terms' class='inlines'><p class='link-title'>Terms</p>How it works?<br />Privacy<br />Support</div>
<div id='social' class='inlines'><p class='link-title'>Get Social</p>Like Us!<br />Follow<br /><br /></div>
<div class='inlines' style='margin-right: 10px'>Copyright © 2012  quickRackets. All rights reserved.</div>
<a id='sitelock-logo' href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=www.quickrackets.com','SiteLock','width=600,height=600,left=160,top=170');" ><img alt="website security" title="SiteLock"  src="//shield.sitelock.com/shield/www.quickrackets.com"/></a> 
</div>
</div><!-- element pair is on overall_header.tpl (main_container) -->
{/if}

{if $is_logged_in}
{js_include src='user_general.js'}
{else}
{js_include src='general.js'}
{/if}

{if $controller_js}
{js_include src=$controller_js}
{/if}
{js_include src='head.min.js'}
</body>
</html>