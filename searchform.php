<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">

	<div class="input-group">
	  <!--<span class="input-group-label">$</span>-->
	  <input type="text" value="" name="s" id="s" class="input-group-field" placeholder="<?php esc_attr_e('Search', 'cerulean'); ?>">
	  <div class="input-group-button">
	    <button type="submit" id="searchsubmit" class="button" value="Submit"><i class="nuc nuc-o-search"></i></button>
	  </div>
	</div>
	
</form>