<?php
require_once ('application/libraries/firebaseLib.php');
define('FIREBASE_INSTANCE','https://popping-fire-1902.firebaseio.com/kitchen-sink');

// Let's generate some names
$adjs = array(		"autumn", "hidden", "bitter", "misty", "silent", "empty", "dry", "dark",
					"summer", "icy", "delicate", "quiet", "white", "cool", "spring", "winter",
					"patient", "twilight", "dawn", "crimson", "wispy", "weathered", "blue",
					"billowing", "broken", "cold", "falling", "frosty", "green",
					"long", "late", "lingering", "bold", "little", "morning", "muddy", "old",
					"red", "rough", "still", "small", "sparkling", "throbbing", "shy",
					"wandering", "withered", "wild", "black", "young", "holy", "solitary",
					"fragrant", "aged", "snowy", "proud", "floral", "restless", "divine",
					"polished", "ancient", "purple", "lively", "nameless");
$nouns = array(		"waterfall", "river", "breeze", "moon", "rain", "wind", "sea", "morning",
					"snow", "lake", "sunset", "pine", "shadow", "leaf", "dawn", "glitter",
					"forest", "hill", "cloud", "meadow", "sun", "glade", "bird", "brook",
					"butterfly", "bush", "dew", "dust", "field", "fire", "flower", "firefly",
					"feather", "grass", "haze", "mountain", "night", "pond", "darkness",
					"snowflake", "silence", "sound", "sky", "shape", "surf", "thunder",
					"violet", "water", "wildflower", "wave", "water", "resonance", "sun",
					"wood", "dream", "cherry", "tree", "fog", "frost", "voice", "paper",
					"frog", "smoke", "star");

$prefix = $adjs[rand(0,count($adjs)-1)] . "-" . $adjs[rand(0,count($adjs)-1)] . "-" . $nouns[rand(0,count($nouns)-1)];
$base_url = "http://$prefix.livefyre.com";

// read and substitute in our bootstrapped data
$json = file_get_contents('assets/bootstrapdata.json');

$json = str_replace('{{DEMO_ARTICLE_ID_PREFIX}}', $prefix, $json);
$json = str_replace('{{DEMO_URL_PREFIX}}', $base_url, $json);
$json = json_decode($json);

// let's also define our prefix in constants
$file = file_get_contents('application/config/constants.php');
$fh = fopen('application/config/constants.php', 'w+');

if ($file) {
	$file = str_replace('{{DEMO_ARTICLE_ID_PREFIX}}',$prefix, $file, $count);
	if ($count == 0) { // ok, maybe we already bootstrapped it so let's replace what we already have
		$file = preg_replace('/DEMO_ARTICLE_ID_PREFIX\',(\t+)\'(\w+)-(\w+)-(\w+)\'/',"DEMO_ARTICLE_ID_PREFIX',\t\t'$prefix'", $file);
	}
	fwrite($fh,$file,strlen($file));
	fclose($fh);
}

// write the bootstrap data

$firebase = new Firebase(FIREBASE_INSTANCE);
$firebase->set($prefix,$json);