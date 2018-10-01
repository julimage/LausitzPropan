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
<?php
// DIESELPREIS TANKERKÖNIG API MIT PHP ABFRAGEN und in dieselpreis.json speichern
function getDieselpreis() {
	$theme_root = get_theme_root();
	$filename = glob("$theme_root/Divi-Child/dieselpreis.json", GLOB_ONLYDIR);
	if (file_exists($filename) && (time()-filemtime($filename) < 300)) {
  		$filecontent = file_get_contents($filename);
		$json_data = json_decode($filecontent,true);
		$dieselpreis = $json_data;
	} else {
		$json = file_get_contents("https://creativecommons.tankerkoenig.de/json/prices.php?ids=134139b7-92d0-4066-ba13-b556cf4a1f0a&apikey=11862a1c-5d7a-5d30-7863-6253eae65692");  
		$data = json_decode($json, true);
		$dieselpreis = $data['prices']["134139b7-92d0-4066-ba13-b556cf4a1f0a"]['diesel'];
		$fp = fopen($filename, 'w');
		fwrite($fp, json_encode($dieselpreis));
		fclose($fp);
	}
	// Dieselpreis mit hochgestellter Zahl
    $dieselpreis_substr = substr($dieselpreis, 0, 4);
	$dieselpreise_remaining_string = substr($dieselpreis, 4);
	$dieselpreis_final = $dieselpreis_substr.'<sup>'.$dieselpreise_remaining_string.'</sup>';
	return $dieselpreis_final;
}
// ENDE DIESELPREIS TANKERKÖNIG API MIT PHP ABFRAGEN 

// Gaspreis mit hochgestellter Zahl 
function getGas() {
	$gas = get_option('gas');
    $gas_substr = substr($gas, 0, 4);
    $gas_remaining_string = substr($gas, 4);
  	$gas_final = $gas_substr.'<sup>'.$gas_remaining_string.'</sup>';
    return $gas_final;
}
?>

