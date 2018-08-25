#!/bin/bash

# run this from the home directory
cd ~

# clone repo with startup scripts
git clone https://github.com/wesleya/dvwa.git

# run init script with access ip variable
source dvwa/init.sh "{ACCESS_IP}" >> init.log 2>init-errors.log