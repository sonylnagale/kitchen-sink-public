function ask(question, callback) {
 var stdin = process.stdin, stdout = process.stdout;

 stdin.resume();
 stdout.write(question + ": ");

 stdin.once('data', function(data) {
   data = data.toString().trim();
   callback(data);

 });
};

var adjs = ["autumn", "hidden", "bitter", "misty", "silent", "empty", "dry", "dark",
            "summer", "icy", "delicate", "quiet", "white", "cool", "spring", "winter",
            "patient", "twilight", "dawn", "crimson", "wispy", "weathered", "blue",
            "billowing", "broken", "cold", "falling", "frosty", "green",
            "long", "late", "lingering", "bold", "little", "morning", "muddy", "old",
	        "red", "rough", "still", "small", "sparkling", "shy",
			"wandering", "withered", "wild", "black", "young", "holy", "solitary",
			"fragrant", "aged", "snowy", "proud", "floral", "restless", "divine",
			"polished", "ancient", "purple", "lively", "nameless"];
var nouns  = ["waterfall", "river", "breeze", "moon", "rain", "wind", "sea", "morning",
              "snow", "lake", "sunset", "pine", "shadow", "leaf", "dawn", "glitter",
              "forest", "hill", "cloud", "meadow", "sun", "glade", "bird", "brook",
              "butterfly", "dew", "dust", "field", "fire", "flower", "firefly",
              "feather", "grass", "haze", "mountain", "night", "pond", "darkness",
              "snowflake", "silence", "sound", "sky", "shape", "surf", "thunder",
              "violet", "water", "wildflower", "wave", "water", "resonance", "sun",
              "wood", "dream", "cherry", "tree", "fog", "frost", "voice", "paper",
              "frog", "smoke", "star"];

var prefix = adjs[Math.floor(Math.random() * adjs.length-1)] + "-" + adjs[Math.floor(Math.random() * adjs.length-1)] + "-" + nouns[Math.floor(Math.random() * nouns.length-1)];
var base_url = "http://" + prefix + ".livefyre.com";


ask("Use " + prefix + " for your instance name? [y/n]", function (data) {
	if (data != "y") {
		ask ("Enter instance name: ", function(data) {
			prefix = data;
			setPrefix(prefix);
		});
	} else {
		setPrefix(prefix);
	}
});


function setPrefix(prefix) {
	var fs = require('fs');
	fs.readFile("./models/constants.js", 'utf8', function(err,data) {
		if (err) {
		    return console.log(err);
		}

		data = data.replace('little-broken-silence',prefix);

		fs.writeFile("./models/constants.js", data, function(err) {
		    if(err) {
		        console.log(err);
		    } else {
		        console.log("Done!");
		    }
		});
	});
	fs.readFile("./bootstrapdata.json", 'utf8', function(err,data) {
		if (err) {
		    return console.log(err);
		}

		data = data.replace(/{{DEMO_ARTICLE_ID_PREFIX}}/g,prefix);
		data = data.replace(/{{DEMO_URL_PREFIX}}/g, 'http://' + prefix + ".livefyre.com");

		var Firebase = require('firebase');

		var firebase = new Firebase('https://popping-fire-1902.firebaseio.com/kitchen-sink/' + prefix);
		firebase.set(JSON.parse(data), function(err,data) {
			if (err) {
				console.log(err);
			}
			console.log('Updated Firebase');
			process.exit();
		});

	});
}
