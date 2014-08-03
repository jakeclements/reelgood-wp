        
        <?php zilla_content_end(); ?>
		<!-- END #content -->
		</div>
		
		<?php zilla_footer_before(); ?>
		<!-- BEGIN #footer -->
		<div id="footer">
	    <?php zilla_footer_start(); ?>
		    
		    <?php 
    		    $footer_feature_posts = zilla_get_option('footer_feature_posts');
                get_template_part('content', 'footer-feature');
			?>
			
		    <div class="footer-widgets">
		    	<div class="inner clearfix">
					<div class="col"><?php dynamic_sidebar( 'footer1' ); ?></div>
					<div class="col middle"><?php dynamic_sidebar( 'footer2' ); ?></div>
					<div class="col last"><?php dynamic_sidebar( 'footer3' ); ?></div>
				</div>
		    </div>
		    
		    <div class="footer-bottom inner">
				<p class="copyright">&copy; <?php _e('Copyright', 'zilla') ?> <?php echo date( 'Y' ); ?>. <?php _e('Powered by', 'zilla') ?> <a href="http://wordpress.org/">WordPress</a></p>
			
				<p class="credit"><a href="http://www.themezilla.com/themes/viewport/">Viewport Theme</a> by <a href="http://www.themezilla.com/">ThemeZilla</a></p>
			</div>
		
		<?php zilla_footer_end(); ?>
		<!-- END #footer -->
		</div>
		<?php zilla_footer_after(); ?>
		
	<!-- END #container -->
	</div> 
		
	<!-- Theme Hook -->
	<?php wp_footer(); ?>
	<?php zilla_body_end(); ?>
	<script type="text/javascript">
adroll_adv_id = "5YIYRNUXOVAHXDBSKOSRAP";
adroll_pix_id = "IG7YAGZMEJBCLBJXKLBFAM";
(function () {
var oldonload = window.onload;
window.onload = function(){
   __adroll_loaded=true;
   var scr = document.createElement("script");
   var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
   scr.setAttribute('async', 'true');
   scr.type = "text/javascript";
   scr.src = host + "/j/roundtrip.js";
   ((document.getElementsByTagName('head') || [null])[0] ||
    document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
   if(oldonload){oldonload()}};
}());
</script>

<!--END body-->
</body>
<!--END html-->
</html>