<?php 
/*-----------------------------------------------------------------------------------*/
/*	Add Author Role
/*-----------------------------------------------------------------------------------*/

$role = add_role('rg_author', 'ReelGood Author', array(
    'read' => true,
    'edit_posts' => false,
    'delete_posts' => false,
    'upload_files' => true,
    'read_private_pages' => true,
    'read_private_posts' => true,
));