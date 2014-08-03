<!--BEGIN #searchform-->
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<fieldset>
		<input type="text" name="s" id="s" value="<?php _e('To search type and hit enter', 'zilla') ?>" onfocus="if(this.value=='<?php _e('To search type and hit enter', 'zilla') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('To search type and hit enter', 'zilla') ?>';" />
	</fieldset>
<!--END #searchform-->
</form>