
	<div class='target-option'>
		<input type='checkbox' name='age-bracket' id='age-bracket' class='target-name' />
		<label for='age-bracket'>Age Bracket</label>
		<div class='target-nodes' id='nodes-for-age-bracket'>
			<input type='checkbox' name='age_1' id='age_1' class='target-range age-bracket-range'>
			<label for='age_1'>Below 18 years old</label><br/>
			<input type='checkbox' name='age_2' id='age_2' class='target-range age-bracket-range'>
			<label for='age_2'>18 to 24 years old</label><br/>
			<input type='checkbox' name='age_3' id='age_3' class='target-range age-bracket-range'>
			<label for='age_3'>25 to 39 years old</label><br />
			<input type='checkbox' name='age_4' id='age_4' class='target-range age-bracket-range'>
			<label for='age_4'>40 to 49 years old</label><br/>
			<input type='checkbox' name='age_5' id='age_5' class='target-range age-bracket-range'>
			<label for='age_5'>50 to 59 years old</label><br />
			<input type='checkbox' name='age_6' id='age_6' class='target-range age-bracket-range'>
			<label for='age_6'>60+</label>
		</div>
	</div>
	<div class='target-option'>
		<input type='checkbox' name='country' id='country' class='target-name' />
		<label for='country'>Continent</label>	
		<div class='target-nodes' id='nodes-for-country'>
			{foreach $continents as $key => $val}
			<div id='continent_{$val['continent_abbrev']}'>
			<input type='checkbox' name='continent_{$key}' id='continent_{$key}' class='target-range country-range' />
			<label for='continent_{$key}'>{$val['continent_name']}</label><br />
				<div class='country-list' id='countries-for-continent-{$key}'>
				{foreach $countries as $index => $item}
					{if $key == $item['continent_id']}
					<input type='checkbox' name='country_{$index}' id='country_{$index}' class='target-range' />
					<label for='country_{$index}'>{$item['short_name']}</label><br />
					{/if}
				{/foreach}
				</div>
			</div>
			{/foreach}
		</div>
	</div>
	<div class='target-option'>
		<input type='checkbox' name='gender' id='gender' class='target-name' />
		<label for='gender'>Gender</label>
		<div class='target-nodes' id='nodes-for-gender'>
			<input type='checkbox' name='male' id='male' class='target-range gender-range' />
			<label for='male'>Male</label><br/>
			<input type='checkbox' name='female' id='female' class='target-range gender-range' />
			<label for='female'>Female</label>
		</div>
	</div>
	<div class='target-option'>
		<input type='checkbox' name='best-racketeers' id='best-racketeers' class='target-name' />
		<label for='best-racketeers'>Best Racketeers</label>
		<div class='target-nodes' id='nodes-for-best-racketeers'>
			<input type='checkbox' name='top-earners' id='top-earners' class='target-range best-racketeers-range' />
			<label for='top-earners'>Top Earners</label><br/>
			<input type='checkbox' name='most-numbers' id='most-numbers' class='target-range best-racketeers-range' />
			<label for='most-numbers'>Most Numbers of Approved</label><br/>
			{foreach $categories as $key => $val}
			{if $val['short_name'] != ""}
			<input type='checkbox' name='best-{$key}' id='best-{$key}' class='target-range best-racketeers-range' />
			<label for='best-{$key}'>Best in {$val['short_name']}</label><br/>
			{/if}
			{/foreach}
		</div>
	</div>