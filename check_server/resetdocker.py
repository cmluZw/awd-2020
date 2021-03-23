#!/usr/bin/env python
# -*- coding:utf8 -*-

import os
import requests

os.system("docker ps | awk '{print $1}' | xargs docker stop ")
os.system("docker ps -a | awk '{print $1}' | xargs docker rm")
os.system('rm -rf /var/www/html/awd-lastest/docker/team*')
#os.system('python /var/www/html/awd-lastest/docker/start.py')
