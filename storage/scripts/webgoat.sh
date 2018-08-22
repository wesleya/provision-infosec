#!/bin/bash

# install software
apt-get update
apt-get install -y apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
apt-get update
apt-get install -y docker-ce
DEBIAN_FRONTEND=noninteractive apt-get install -y iptables-persistent

# secure box
iptables -I INPUT 1 -s 63.150.103.146 -j ACCEPT
iptables -I INPUT 2 -j DROP
iptables -I OUTPUT 1 -d 63.150.103.146 -j ACCEPT
iptables -I OUTPUT 2 -j DROP
iptables -I FORWARD 1 -s 63.150.103.146 -j ACCEPT
iptables -I FORWARD 2 -d 63.150.103.146 -j ACCEPT
iptables -I FORWARD 3 -j DROP
iptables --policy INPUT DROP
iptables --policy OUTPUT DROP
iptables --policy FORWARD DROP
iptables-save > /etc/iptables/rules.v4
ip6tables-save > /etc/iptables/rules.v6

# startup docker again like this so it restarts on reboot
/etc/init.d/docker restart
docker pull webgoat/webgoat-8.0
# use the --restart always so this container auto-runs everytime docker starts
# which combined with the init.d command above should mean container runs on every reboot
docker run --restart always -p 80:8080 webgoat/webgoat-8.0 /home/webgoat/start.sh