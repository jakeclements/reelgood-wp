<?php

class functions_field_groups
{

	/*
	*  Constructor
	*
	*  Add actions and filters
	*
	*  @type	function
	*  @date	5/08/13
	*
	*  @param	N/A
	*  @return	N/A
	*/

	function __construct()
	{
		// validate
		if( !function_exists("register_field_group") )
		{
			return;
		}


		// Place register_field_group code here

	}

}

new functions_field_groups();
