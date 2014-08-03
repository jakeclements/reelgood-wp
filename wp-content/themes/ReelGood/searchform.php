<?php // searchform code, render however ?>

<div class="sidebar-module side-search">	
	<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    	<div><label class="side-search__title" for="s">SEARCH</label>
       	 	<input type="text" value="Looking for something?" class="side-search__input" name="s" id="s" />
        	<input type="submit" id="searchsubmit" class="side-search__submit anim-fast" value="&#xf002;" />
    	</div>
	</form>
</div>