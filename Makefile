decrypt:
	node decrypt.js
	
prefix:
	node install.js
	
install:
	npm install
	node decrypt.js
	node install.js
	npm start