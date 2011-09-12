<?php

// run this file at the command line to produce a plugin for distribution:
// $ php dml_rand_masthead.php > dml_rand_masthead-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Uncomment and edit this line to override:
# $plugin['name'] = 'abc_plugin';

$plugin['version']     = '0.5';
$plugin['author']      = 'Dan Lowe';
$plugin['author_uri']  = 'http://tangledhelix.com/archive/txp-dml-rand-masthead';
$plugin['description'] = 'Returns a random masthead, given a category';

// Plugin types:
// 0 = regular plugin; loaded on the public web side only
// 1 = admin plugin; loaded on both the public and admin side
// 2 = library; loaded only when include_plugin() or require_plugin() is called
$plugin['type'] = 0; 


@include_once('zem_tpl.php');

if (0) {
?>
# --- BEGIN PLUGIN HELP ---

<p><strong>txp:dml_rand_masthead</strong></p>

<p>This plugin returns a random masthead image from a given image category.
Upload your mastheads, put them all into some image category, then
put this in your page template or form (substituting your own category
name):</p>

<p><code>&lt;txp:dml_rand_masthead category=&quot;site-masthead&quot;&nbsp;/&gt;</code></p>

<p>Accepts the <code>linktext=&quot;label text&quot;</code> attribute,
which will be used as the ALT and TITLE tag for the masthead.</p>

<p>Accepts the <code>class=&quot;classname&quot;</code>attribute,
which defines a CSS class for the masthead.</p>

# --- END PLUGIN HELP ---
<?php
}

# --- BEGIN PLUGIN CODE ---

function dml_rand_masthead($atts) {   
	global $img_dir;

	extract(lAtts(array(
		'category' => '',
		'linktext' => 'Go to main page',
		'class' => '',
	) ,$atts));

	$rs = safe_rows_start('*', 'txp_image', "category='".doSlash($category)."'");

	if ($rs) {
		while ($a = nextRow($rs)) {
			extract($a);
			$out[] = array(id => $id, h => $h, w => $w, ext => $ext);
		}   

		if (is_array($out)) {
			srand((double)microtime() * 1000000);
			$randval = rand(0, (sizeof($out) - 1));
			$image = $out[$randval];

			return '<a href="' . hu . '" title="' . $linktext. '">'
				. '<img src="' . hu . $img_dir . '/'
				. $image['id'] . $image['ext']
				. '" width="' . $image['w'] . '" height="' . $image['h']
				. '" class="' . $class
				. '" alt="' . $linktext . '" border="0" /></a>';
		}        
	}   

	return '';
}

# --- END PLUGIN CODE ---

?>
