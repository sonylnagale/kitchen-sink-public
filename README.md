# KITCHEN SINK

# PURPOSE
The purpose of this repo is to get the Node.js Livefyre Library in your local development environment

# STRUCTURE
This is an Express.js web server running on Node.js platform

# INSTALLATION
Assuming your environment lacks command line tools & node, here are the steps to quickly get you up and running:

* Go to http://nodejs.org/download/ and download the Universal Mac OS X Installer (.pkg)
* Install Node.js by double-clicking node-v0.10.X.pkg
* Go to /Applications/Utilities/ and launch Terminal.app

In Terminal.app, copy and paste the following steps (when you see a “$” in the next steps, it means to run the following command. Do not paste in the “$” into Terminal.app):

If command line tools are not installed:
* $ git --version (This should prompt you to install command line tools. Click install => agree)

If command line tools are installed:
* $ cd ~/ && mkdir “dev” && cd dev
* $ git clone https://github.com/cid8600/kitchen-sink && cd kitchen-sink
* $ make install
* Answer prompt for security purposes (hint: answer is in all lowercase)
* Hit "y" to create your randomly generated instance name || "n" to make your own 
* Open a web browser and go to http://localhost:3000

If you see the home page:
* do a jig && go to the fridge && have wine and cheese

If you do not see the home page:
* contact snagale@livefyre.com || cid@livefyre.com

# STARTING NODE
* $ cd ~/dev/kitchen-sink/ && npm start

# STOPING NODE
* $ ^C (or quit Terminal.app)
