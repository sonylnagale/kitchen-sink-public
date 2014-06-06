function ask(question, callback) {
 var stdin = process.stdin, stdout = process.stdout;
 
 stdin.resume();
 stdout.write(question + ": ");
 
 stdin.once('data', function(data) {
   data = data.toString().trim();
   callback(data);
   
 });
};

ask("Who has the biggest office in Livefyre? ", function (keyphrase) {
	var crypto = require('crypto');

	function md5(data) {
	    var hash = crypto.createHash('md5');
	    hash.update(data);
	    return new Buffer(hash.digest('hex'), 'hex');
	}

	var text = require('fs').readFileSync('./models/constants.js.crypt');
	var salt = text.slice(8, 16);
	var cryptotext = text.slice(16);
	var password = new Buffer(keyphrase);

	var hash0 = new Buffer('');
	var hash1 = md5(Buffer.concat([ hash0, password, salt ]));
	var hash2 = md5(Buffer.concat([ hash1, password, salt ]));
	var hash3 = md5(Buffer.concat([ hash2, password, salt ]));
	var key = Buffer.concat([ hash1, hash2 ]);
	var iv = hash3;

	var decoder = crypto.createDecipheriv('aes-256-cbc', key, iv);

	var chunks = [];
	chunks.push(decoder.update(cryptotext, "binary", "utf8"));
	chunks.push(decoder.final("utf8"));
	
	var fs = require('fs');
	fs.writeFile("./models/constants.js", chunks.join(''), function(err) {
	    if(err) {
	        console.log(err);
	    } else {
	        console.log("Done!");
	        process.exit();
	    }
	}); 
});