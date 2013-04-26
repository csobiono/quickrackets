<form method='post' id='add-racket-part-1-of-3' class='add-racket-form'>
	<div class='form-label'>Racket Name</div>
	<div class='form-misc'>
		<input type='text' name='rtitle' id='rtitle' class='form-field' maxLenght='124' />
		<a class='ins-icon' href='#' onclick="seeMore('rtitle', $(this))">&nbsp;&nbsp;&nbsp;&nbsp;</a>
		<p class='form-instruction'></p>
		<p class='form-error'></p>
	</div>
	<div class='clear'></div>

	<div class='form-label'>Choose a Category</div>
	<div class='form-misc'>	
		<select name='category' id='racket-category' class='form-field'>
			<option value='0'>Pick one from this list...</option>
			{foreach $categories as $key => $val}
			<option value={$key}>{$val['category_name']}</option>
			{/foreach}
		</select>
		<a class='ins-icon' href='#' onclick="seeMore('racket-category', $(this))">&nbsp;&nbsp;&nbsp;&nbsp;</a>
		<p class='form-instruction'></p>
		<p class='form-error'></p>	
	</div>
	<div class='clear'></div>

	<div class='form-label' style='min-width: 380px; display:inline'>List the Things to Get Done</div>
	<div id='field-enumeration' style='display: inline-block; margin-left: 395px; position:absolute'>
			<div class='field-num' id='instruction-field-num-1'>1.</div>
			<div class='field-num' id='instruction-field-num-2'>2.</div>
			<div class='field-num' id='instruction-field-num-3'>3.</div>
			<div class='field-num' id='instruction-field-num-4'>4.</div>
			<div class='field-num' id='instruction-field-num-5'>5.</div>
	</div>
	<div class='form-misc'>
		
		<div id='instructions-list'>
			<div>
				<input type='text' name='racket-instruction-1' id='racket-instruction-1' class='form-field' maxLenght='124' />
				&nbsp;<a href="#" onclick="removeField(1)" class='remove-instruction-field'>Remove</a>
			</div>
			<div>
				<input type='text' name='racket-instruction-2' id='racket-instruction-2' class='form-field' maxLenght='124' />
				&nbsp;<a href="#" onclick="removeField(2)" class='remove-instruction-field'>Remove</a>
			</div>
		</div>
		<a href="#" onclick="addField()" class='add-instruction-field'>Add a field</a>
		<a class='ins-icon' href='#' onclick="seeMore('min-to-finish', $(this))">&nbsp;&nbsp;&nbsp;&nbsp;</a>
		<p class='form-instruction'></p>
		<p class='form-error'></p>
	</div>
	<div class='clear'></div>

	<div class='form-label'>Minutes To Finish</div>
	<div class='form-misc'>
		<select id='min-to-finish' name='min-to-finish' class='form-field'>
			{for $i=1; $i<=58; $i=$i+3}
			<option value='{$i}'>{$i} to {$i+2} minutes</option>
			{/for}
			<option value='60'>An hour</option>
			<option value='61'>More than an hour</option>
		</select>
		<a class='ins-icon' href='#' onclick="seeMore('min-to-finish', $(this))">&nbsp;&nbsp;&nbsp;&nbsp;</a>
		<p class='form-instruction'></p>
		<p class='form-error'></p>
	</div>
	<div class='clear'></div>
</form>

<form method='post' id='add-racket-part-2-of-3' class='add-racket-form'>
	<div id='targetting-options-panel'>
		<div>
			<input type='radio' name='main-target-option' id='make-racket-public' class='main-target-option' />
			<label for='make-racket-public'>Make this Racket <strong>Public</strong></label>
			<span>or</span><br />
			<input type='radio' name='main-target-option' id='choose-racket-target' class='main-target-option' />
			<label for='choose-racket-target'>Choose Specific Targets for your Racket</label>
		</div>
		<div class='target-option'>
			<input type='checkbox' name='groups' id='groups' class='target-name' />
			<label for='groups'>Choose From Your Groups</label>
			<div class='target-nodes' id='nodes-for-groups'>
				<input type='checkbox' name='group_1' id='group_1' class='target-range groups-range' />
				<label for='group_1'>Dummy Group</label>
			</div>
		</div>
		{include file="user_sorting_form.tpl"}
	<div>
		<p class='form-instruction'></p>
		<p class='form-error'></p>
	</div>
	</div>
	{js_include src='sort_racketeers.js'}
	<style type="text/css">
	div#racketeers-container{
		display: inline-block;
		margin-top: 20px;
		margin-left: 10px;
	}
	div.r-slot
	{
		width: 150px;
		max-width: 150px;
		height: 80px;
		margin-right: 18px;
		border: 1px solid #A5FF73;
		display: inline-block;
		font-size: 11px;
	}
	div.r-slots-break{
		height: 18px;
	}
	div.flag-slot{
		width: 40px;
		height: 26px;
		background-size: 40px 26px;
		display: inline-block;
		margin: 5px;
		float: left;
	}
	div.name-slot{
		display: inline-block;
	}
	</style>
	<div id="racketeers-container">
	</div>
	<div class='clear'></div>
</form>

<form method='post' id='add-racket-part-3-of-3' class='add-racket-form'>
	<div class='form-label' style='min-width: 380px; display:inline'>Proofs You Need</div>
	<div id='field-enumeration' style='display: inline-block; margin-left: 395px; position:absolute'>
			<div class='field-num' id='proof-field-num-1'>1.</div>
			<div class='field-num' id='proof-field-num-2'>2.</div>
			<div class='field-num' id='proof-field-num-3'>3.</div>
			<div class='field-num' id='proof-field-num-4'>4.</div>
			<div class='field-num' id='proof-field-num-5'>5.</div>
	</div>
	<div class='form-misc'>
		
		<div id='proofs-list'>
			<div>
				<input type='text' name='racket-proof-1' id='racket-proof-1' class='form-field' maxLenght='124' />
				&nbsp;<a href="#" onclick="removeField(1)" class='remove-proof-field'>Remove</a>
			</div>
			<div>
				<input type='text' name='racket-proof-2' id='racket-proof-2' class='form-field' maxLenght='124' />
				&nbsp;<a href="#" onclick="removeField(2)" class='remove-proof-field'>Remove</a>
			</div>
		</div>
		<a href="#" onclick="addField()" class='add-proof-field'>Add a field</a>
		<a class='ins-icon' href='#' onclick="seeMore('min-to-finish', $(this))">&nbsp;&nbsp;&nbsp;&nbsp;</a>
		<p class='form-instruction'></p>
		<p class='form-error'></p>
	</div>
	<div class='clear'></div>
	
</form>

<div style='margin: 20px 0 0 430px'>
<div class='prev-part-btn'>previous</div>
<div class='next-part-btn'>next</div>
<div class='submit-racket-btn'>Submit</div>
</div>
<!--<div style="height: 100%; width: 100%; background-color:#ad9292; position:absolute; left:0px; top:0px;z-index:4; opacity: 0.4"></div>-->