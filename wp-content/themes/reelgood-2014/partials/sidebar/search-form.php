<?php
/*--------------------------------------------------------------------------
*
*	SIDEBAR: Search Form
*
*-------------------------------------------------------------------------*/
?>
<div class="sidebar-module">
	<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
		<input placeholder="Looking for something?" class="search-bar" type="text" value="" name="s" id="s" />
	    <input class="search-icon" type="submit" id="searchsubmit" value="" />
	</form>
</div>