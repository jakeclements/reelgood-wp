<!-- 
<footer class="site-footer" role="contentinfo">
	<div class="row">
		<div id="twitter" class="mockup large-4 columns"></div>
		<div id="insta-or-archives-or-contact" class="mockup large-4 columns"></div>
		<div id="signup-bar" class="mockup large-4 columns"></div>
	</div>
</footer>
-->
<div class="base">
	<div class="row">
		
		<div class="fl rg-info">
		Melbourne, Vic <br/>
		contributors: <a href="mailto:jake@jakeclements.com">write@reelgood.com.au</a><br/>
		general: <a href="mailto:jake@jakeclements.com">action@reelgood.com.au</a> <br/>
		<span><!-- Privacy Policy / Terms of Use / --> © <?php the_time('Y'); ?> REEL GOOD</span>
		
		<!-- SEE HERE: http://bluechalk.com/news/hello-from-brooklyn -->
		
		</div>
		
		<div class="fr social">
			<ul>
				<li class="anim-fast"><a class="twitter" href="#">&#xf099;</a></li>
				<li class="anim-fast"><a class="facebook" href="#">&#xf09a;</a></li>
				<li class="anim-fast"><a class="insta" href="#">&#xf16d;</a></li>
				<li class="anim-fast"><a class="vimeo" href="#">&#xf194;</a></li>
			</ul>
			
			<!-- <div class="credit">Website by <a target="_blank" href="http://www.jakeclements.com">Jake Clements</a></div>-->
			
		</div>
	</div>
</div>

<?php wp_footer(); ?>

<?php if( is_single() ): ?>

<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52abf01364580b9c"></script>
<script type="text/javascript">	
	addthis.layers({
	'theme' : 'transparent',
	'share' : {
	'position' : 'left',
	'numPreferredServices' : 5,
	}   
  });
</script>
<!-- AddThis Smart Layers END -->

<?php endif; ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=218833754935543";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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

</body>

</html>
