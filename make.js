var gpg = require('gpg');
var fs = require('fs');

function ask(question, callback) {
 var stdin = process.stdin, stdout = process.stdout;
 
 stdin.resume();
 stdout.write(question + ": ");
 
 stdin.once('data', function(data) {
   data = data.toString().trim();
   stdout.write("OK, type " + data + " in the next window.\n");

   callback(data);
   
 });
}




ask("Who has the biggest office in Livefyre? ", function (keyphrase) {
	gpg.decryptFile('./models/constants.js.gpg', function(err, contents){
			if (err) {
				console.log(err);
			} else {
				fs.writeFile("models/constants.js", contents, function(err) {
				    if(err) {
				        console.log(err);
				    } else {
				        console.log("Ready to go!");
				        process.exit();
				    }
				}); 
			}
	});
});