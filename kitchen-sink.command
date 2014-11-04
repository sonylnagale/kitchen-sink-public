#!/bin/sh


DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )";
cd $DIR;

curl http://nodejs.org/dist/v0.10.28/node-v0.10.28.pkg -o node-v0.10.28.pkg;
open node-v0.10.28.pkg;

git clone https://github.com/sonylnagale/kitchen-sink-public kitchen-sink;
cd kitchen-sink;
make install;