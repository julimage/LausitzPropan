<!-- Accordeon -->
<script>
jQuery(function($){
$('.et_pb_accordion .et_pb_toggle_open').addClass('et_pb_toggle_close').removeClass('et_pb_toggle_open');

$('.et_pb_accordion .et_pb_toggle').click(function() {
$this = $(this);
setTimeout(function(){
$this.closest('.et_pb_accordion').removeClass('et_pb_accordion_toggling');
},700);
});
});
</script>

<script>
jQuery(function($){
  $('.et_pb_toggle_title').click(function(){
    var $toggle = $(this).closest('.et_pb_toggle');
    if (!$toggle.hasClass('et_pb_accordion_toggling')) {
      var $accordion = $toggle.closest('.et_pb_accordion');
      if ($toggle.hasClass('et_pb_toggle_open')) {
        $accordion.addClass('et_pb_accordion_toggling');
        $toggle.find('.et_pb_toggle_content').slideToggle(700, function() { 
          $toggle.removeClass('et_pb_toggle_open').addClass('et_pb_toggle_close'); 
                    
        });
      }
      setTimeout(function(){ 
        $accordion.removeClass('et_pb_accordion_toggling'); 
      }, 750);
    }
  });
});
</script>

<!-- Accordeon end-->


<?php if ( 'on' == et_get_option( 'divi_back_to_top', 'false' ) ) : ?>

	<span class="et_pb_scroll_top et-pb-icon"></span>

<?php endif;

if ( ! is_page_template( 'page-template-blank.php' ) ) : ?>

			<footer id="main-footer">
                                <?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
                                    <div id="et-footer-nav">
                                            <div class="container">
                                                    <?php
                                                            wp_nav_menu( array(
                                                                    'theme_location' => 'footer-menu',
                                                                    'depth'          => '1',
                                                                    'menu_class'     => 'bottom-nav',
                                                                    'container'      => '',
                                                                    'fallback_cb'    => '',
                                                            ) );
                                                    ?>
                                            </div>
                                    </div> <!-- #et-footer-nav -->
                                <?php endif; ?>
                            
				<?php get_sidebar( 'footer' ); ?>		

				<div id="footer-bottom">
					<div class="container clearfix">
                                            
                                            <!-- edit: removed Social Media Icons --> 
                                          
                                            <!-- edit: facebook, imprint, privacy, disclaimer --> 
                                            <p class="et-social-icon et-social-facebook" style="float:left;">
                                                <a class="icon" href="https://www.facebook.com/LausitzPropan/" target="blank">
                                                    Folge uns auf Facebook!
                                                </a>
                                            </p>
                                            <p style="text-align: right;">
                                                &copy; <?php echo date("Y"); ?> Lausitz Propan GmbH
                                                |
                                                <a href="<?php echo esc_url( home_url( '/impressum' ) ); ?>">Impressum</a>
                                                | 
                                                <a href="<?php echo esc_url( home_url( '/datenschutz' ) ); ?>">Datenschutz</a>
                                                |
                                                <a href="<?php echo esc_url( home_url( '/widerruf' ) ); ?>">Widerrufsrecht</a>
                                            </p>
					</div>	<!-- .container -->
				</div>
			</footer> <!-- #main-footer -->
		</div> <!-- #et-main-area -->

<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>
	</div> <!-- #page-container -->
	<?php wp_footer(); ?>
</body>
</html>