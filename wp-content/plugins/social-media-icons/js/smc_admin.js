jQuery(document).ready(function(){
    /*Tooltip*/
    jQuery("A#more_info").tooltip({
         events: { def: "mouseenter,mouseleave" },
         position: 'center left', 
         offset: [0, 15]
     });
    jQuery("A#more_info").live("mouseenter", function(e){
        jQuery(this).tooltip({
             events: { def: "mouseenter,mouseleave" },
             position: 'center left', 
             offset: [0, 15]
         });
        jQuery(this).trigger('mouseenter');
    });
    
    jQuery("A#more_info").live("click", function(e){
        return false;
    });
    
    jQuery("#widget_icon_setup DIV.icon_container IMG:not(.icon_disabled)").live('click', function(){
        var parentdivid = jQuery(this).parent('.icon_container').attr('id');
        var iconname = parentdivid.replace("icon_container", "");
        jQuery(this).closest("DIV#widget_icon_setup").find("P.icon_url_input:not('#" + iconname + "_icon_url_input')").hide();
        jQuery(this).closest("DIV#widget_icon_setup").find("P#" + iconname + "_icon_url_input").toggle();
    });
    
});
