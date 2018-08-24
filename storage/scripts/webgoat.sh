#!/bin/bash

# clone repo with startup scripts
git clone https://github.com/wesleya/webgoat.git

# run init script with access ip variable
source webgoat/init.sh "63.150.103.146" >> init.log