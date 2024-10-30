<?php
/*
Plugin Name: Cern Online Demo Austria 
Version: 1.0
Plugin URI: http://wiki.die-truppe.com/
Description: Stop Austria´s plans of leaving CERN! Plugin adds a clickable image to support the petition SOS Save our Science. By <a href="http://www.die-truppe.com/robert">Robert Harm</a> (based on <a href="http://spannungsraum.uttx.net" target="_blank">spannungsraum</a> und Original VDS Page Peel
Author: Ralf "Arby" Brostedt
Author URI: http://zweicent.brostedt.de/
*/

### Function: Page Peel CSS
add_action('wp_head', 'pagepeel_css');

function pagepeel_css() {
global $sonder;
  echo <<<EOH
<!-- AKVS head start v1.5 -->
<style type="text/css">
<!--
div#akct {
	position: absolute; top:0px; right: 0px; z-index: 2342; width:200px; height:84px;
	background-image: url(http://wiki.die-truppe.com/images/sost-klein-en.gif);
	background-repeat: no-repeat;
	background-position: right top;
	border:none;
	padding:0;
	margin:0;
	text-align: right;
}

div#akct img {
	border:none;
	padding:0;
	margin:0;
	background: none;
}

div#akct a#akpeel img {
        width: 200px;
        height: 84px;
}

div#akct a, div#akct a:hover {
	text-decoration: none;
	border:none;
	padding:0;
	margin:0;
	display: block;
	background: none;
}

div#akct a#akpeel:hover {
	position: absolute; top:0px; right: 0px; z-index: 4223; width:500px; height:435px;
	display: block;
	background-image: url(http://wiki.die-truppe.com/images/sost-gross-en.jpg);
	background-repeat: no-repeat;
	background-position: right top;

EOH;
if (vds_get_special()) {
echo('background-image: url(http://wiki.die-truppe.com/images/sost-gross-en.jpg);');
} else {
echo('background-image: url(http://wiki.die-truppe.com/images/sost-gross-en.jpg);');
}
echo <<<EOH2
	background-repeat: no-repeat;
	background-position: right top;
}

div#akct a#akpreload {
EOH2;
if (vds_get_special()) {
echo('background-image: url(http://wiki.die-truppe.com/images/sost-gross-en.jpg);');
} else {
echo('background-image: url(http://wiki.die-truppe.com/images/sost-gross-en.jpg);');
}
echo <<<EOH3
	background-repeat: no-repeat;
	background-position: 234px 0px;
}
-->
</style>
<!--[if gte IE 5.5]>
<![if lt IE 7]>
<style type="text/css">
div#akct a#akpeel:hover {
		right: -1px;
}
</style>
<![endif]>
<![endif]-->
<!-- AKVS head end -->
EOH3;
}

add_action('wp_footer', 'pagepeel_body');
function pagepeel_body() {
	echo <<<EOB
<!-- AKVS body start v1.5 -->
<div id="akct"><a id="akpeel" href="http://sos.teilchen.at/petition/" target="_blank" title="Stop Austria´s plans of leaving CERN! Click here to act!"><img src="http://wiki.die-truppe.com/images/sost-blank.gif" alt="Stop Austria´s plans of leaving CERN" /></a>
<a id="akpreload" href="http://wiki.die-truppe.com/Online-Demo" target="_blank" title="Do you want to join this online demonstration? You will find all relevant information at wiki.die-truppe.com"><img src="http://wiki.die-truppe.com/images/sost-info.gif" alt="Do you want to join this online demonstration? You will find all relevant information at wiki.die-truppe.com" /></a></div>
<!-- AKVS body end -->
EOB;
}

add_action('admin_menu', 'vds_ppeel_config_page');

function vds_ppeel_config_page() {
	global $wpdb;
	if ( function_exists('add_submenu_page') )
		add_submenu_page('plugins.php', 'Cern Online Demo Austria', 'Cern Online Demo Austria', 'manage_options', 'ak-vds-config', 'ak_vds_conf');
}

function vds_get_special() {
  $value = trim(get_option('use_special'));
  return $value == '1';
}


function ak_vds_conf() {
	
	$path = get_option('siteurl') . '/wp-content/plugins';
	
	if (isset($_POST['submit']) ) {
		update_option('use_special', $_POST['use_special']);
	}
	
	?>
	<div class="wrap">
		<h2>Cern Online Demo Austria - Special info</h2>
		<form action="" method="post" id="vds-conf" style="margin: auto; width: 400px; ">
			
			<table border="0">
				<tr>
					<td>
						May a special info be shown (not used in this version):
					</td>
					<td>
						<input type="radio" name="use_special" id="vds_special1" value="1" <?=(vds_get_special() == '1') ? 'checked' : ''?> /> <label for="vds_special1">ja</label><br/>
						<input type="radio" name="use_special" id="vds_special0" value="0" <?=(vds_get_special() != '1') ? 'checked' : ''?> /> <label for="vds_special0">nein</label><br/>
					</td>
				</tr>
				<tr>
					<td align="center">
						<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<?php
}
?>

