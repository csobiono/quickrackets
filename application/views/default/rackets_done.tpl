<div id='rackets-done' class='theader'>
	<span id='racket-category' class='headname'></span>
	<a href='javascript:void(0)' id='racket-title' class='headname currenthn sort-asc'>Title</a>
	<a href='javascript:void(0)' id='racket-worth' class='headname'>Worth</a>
	<a href='javascript:void(0)' id='racket-inventory' class='headname'>Progress</a>
	<a href='javascript:void(0)' id='racket-rating' class='headname'>Status</a>
	<a href='javascript:void(0)' id='racket-date' class='headname'>Date Submitted</a>
	<a href='javascript:void(0)' id='racket-proof-update' class='headname'></a>
</div>
</div>
<div style="margin-top: 135px;">
<!-- </div>element pair is on overall_header.tpl (top_nav) -->
{foreach $participations as $key=>$val}
<div class="entry" on>
	<div class="status"></div>
	<div class="name"><a href="#" onclick="javascript:pop_panel_open({$key})">{$val['racket_name']}</a></div>
	<div class="money">$0.3</div>
	<div class="progress">20%</div>
	<div class="participation_status">{$val['participation_status']}</div>
	<div class="date_submitted">{$val['participation_submitted_date']}</div>
</div>
{/foreach}
</div>