<?php
/*
Template Name: Coming Soon
*/
?>

<?php get_header(); ?>

			<div class="clearfix">
				<!--BEGIN #primary .hfeed-->
				<div id="primary" class="hfeed full-width">
				<div id="comingsooncont">
                	<div id="soonwrap">
                    	<div id="minileft">
                 			<h1>the directory</h1>
                    		<p>The REEL GOOD directory is a resource for new and emerging filmmakers and moving image based artists.
                            <br /><br />We want to make this thing as kick ass as possible, but we need your help.
                            <br />We need your input during the development phase of the directory. To register your interest please provide us with your information below.</p>
                            <div class="hrmin"></div>
                            <h2>Register Interest</h2>
                            <!-- Begin MailChimp Signup Form -->
							<div id="mc_embed_signup">
							<form action="http://reelgood.us6.list-manage.com/subscribe/post?u=df2baa11b3dd6f840974d0b4d&amp;id=e3dc4f5e07" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
							<div class="mc-field-group">
							<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span></label>
							<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
							</div>
							<div class="mc-field-group">
							<label for="mce-NAME">Name  <span class="asterisk">*</span>
							</label>
							<input type="text" value="" name="NAME" class="required" id="mce-NAME">
							</div>
							<div class="mc-field-group">
							<label for="mce-OCCUPATION">Occupation  <span class="asterisk">*</span>
							</label>
							<select name="OCCUPATION" class="required" id="mce-OCCUPATION">
								<option value="">--Select an occupation--</option>
								<option value="Director">Director</option>
								<option value="Editor">Editor</option>
								<option value="Camera Operator">Camera Operator</option>
								<option value="Makeup Artist">Makeup Artist</option>
								<option value="Visual FX Artist">Visual FX Artist</option>
								<option value="Scriptwriter">Scriptwriter</option>
								<option value="Sound Recordist">Sound Recordist</option>
								<option value="Actor">Actor</option>
							</select>
							</div>
							<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
							</div>	
                        	<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
							</form>
							</div>

<!--End mc_embed_signup-->
                            
						</div><!-- END minileft -->
                        <div class="vhrmin"></div>
                        <div id="miniright">
                 			<h2>Already have a login?</h2>
                            <p>What are you waiting for..Sign in!</p>
                            <?php $logdeets = array(
        						'echo' => true,
        						'redirect' => 'http://www.reelgood.com.au/edit-profile/', 
        						'form_id' => 'loginform',
        						'label_username' => __( 'Username' ),
        						'label_password' => __( 'Password' ),
        						'label_remember' => __( 'Remember Me' ),
        						'label_log_in' => __( 'Log In' ),
        						'id_username' => 'user_login',
        						'id_password' => 'user_pass',
        						'id_remember' => 'rememberme',
        						'id_submit' => 'wp-submit',
        						'remember' => true,
        						'value_username' => NULL,
        						'value_remember' => false ); ?> 
                            <?php wp_login_form( $logdeets ); ?> 
						</div><!-- END miniright -->
                    
                    </div><!-- END soonwrap -->
                </div><!-- END comingsooncont -->
				<!--END #primary .hfeed-->
				</div>
			</div>

<?php get_footer(); ?>