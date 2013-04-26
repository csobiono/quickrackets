<script type='text/javascript'>
$(document).ready(checkHorizontalScrollBar)
$(window).resize(checkHorizontalScrollBar)
</script>
<div id='quick-racket' class='theader'>
	<span id='racket-category' class='headname'></span>
	<a href='javascript:void(0)' id='racket-title' class='headname currenthn sort-asc'>Title</a>
	<a href='javascript:void(0)' id='racket-worth' class='headname'>Worth</a>
	<a href='javascript:void(0)' id='racket-inventory' class='headname'>Progress</a>
	<a href='javascript:void(0)' id='racket-duration' class='headname'>Est. Duration</a>
	<a href='javascript:void(0)' id='racket-date' class='headname'>Date Posted</a>
	<a href='javascript:void(0)' id='racket-author' class='headname'></a>
</div>
</div>
<div style="margin-top: 135px;">
<!-- </div>element pair is on overall_header.tpl (top_nav) -->
{foreach $rackets as $key=>$val}
<div class="entry" on>
	<div class="status"></div>
	<div class="name"><a href="#" onclick="javascript:pop_panel_open({$key})">{$val['racket_name']}</a></div>
	<div class="money">{$val['racket_price']}</div>
	<div class="progress">0%</div>
	<div class="duration">{$val['racket_duration']} to {$val['racket_duration']+2} mins</div>
	<div class="date_posted">{$val['racket_date_created']}</div>
</div>
{/foreach}
</div>
<div class="pop-panel"><a href="#" onclick="javascript: pop_panel_close()">X</a></div>
{js_include src='racket_participate.js'}
