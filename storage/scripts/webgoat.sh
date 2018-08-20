#!/bin/bash

sudo apt-get update
apt-get install -y apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
sudo apt-get update
sudo apt-get install -y docker-ce
docker pull webgoat/webgoat-8.0
docker run -p 80:8080 webgoat/webgoat-8.0 /home/webgoat/start.sh