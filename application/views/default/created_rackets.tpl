<div id='created-racket' class='theader'>
	<span id='racket-category' class='headname'></span>
	<a href='javascript:void(0)' id='racket-title' class='headname currenthn sort-asc'>Title</a>
	<a href='javascript:void(0)' id='racket-inventory' class='headname'>Progress</a>
	<a href='javascript:void(0)' id='racket-reserve' class='headname'>Reserved Money</a>
	<a href='javascript:void(0)' id='racket-date' class='headname'>Date Posted</a>
	<a href='javascript:void(0)' id='racket-update' class='headname'></a>
</div>

{foreach $user_rackets as $key=>$val}
<div class="entry" on>
	<div class="status"></div>
	<div class="name">{$val['racket_name']}</div>
	<div class="progress">0%</div>
	<div class="money">{$val['racket_price']*$val['racket_available_positions']}</div>
	<div class="date_posted">{$val['racket_date_created']}</div>
</div>
{/foreach}