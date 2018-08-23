<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION



//Custom Theme Settings
//Eingabe Diesel- und Gaspreis
add_action('admin_menu', 'add_gcf_interface');

function add_gcf_interface() {
	add_options_page('Kraftstoffpreis', 'Kraftstoffpreis', '8', 'functions', 'editglobalcustomfields');
}

function editglobalcustomfields() {
	?>
	<div class='wrap'>
	<h2>Kraftstoffpreise</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>

	<p><strong>Diesel:</strong><br />
	<input type="text" name="diesel" size="45" value="<?php echo get_option('diesel'); ?>" /></p>

	<p><strong>Gas:</strong><br />
	<input type="text" name="gas" size="45" value="<?php echo get_option('gas'); ?>" /></p>

	<p><input type="submit" name="Submit" value="Update Options" /></p>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="diesel,gas" />

	</form>
	</div>
	<?php
}

?>