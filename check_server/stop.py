#!/usr/bin/env python


import os
import requests

os.system("docker ps | awk '{print $1}' | xargs docker stop ")
os.system("docker ps -a | awk '{print $1}' | xargs docker rm")
os.system('rm -rf /var/www/html/awd-lastest/docker/team*')
os.system('rm -rf  /var/www/html/awd-lastest/docker/docker.sh')
os.system('rm -rf  /var/www/html/awd-lastest/docker/flag.sh')
os.system('rm -rf  /var/www/html/awd-lastest/docker/cp.sh')
os.system('rm -rf  /var/www/html/awd-lastest/docker/f1AG/')
os.system('rm -rf  /var/www/html/awd-lastest/docker/run.sh')
os.system('rm -rf  /var/www/html/awd-lastest/check_server/host.lists')
os.system('rm -rf  /var/www/html/awd-lastest/docker/check.sh')
os.system('rm -r /var/www/html/awd-lastest/docker/flag/*')
os.system('rm -rf  /var/www/html/awd-lastest/check_server/log.txt')
os.system('rm -rf  /var/www/html/awd-lastest/docker/d7297256b8cf26ab/*')

url="http://47.115.18.243/awd-lastest/check_server/stop_match.php"
headers={
        "User-Agent":"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36",
        }
html=requests.get(url,headers=headers)

