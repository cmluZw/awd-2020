#!/usr/bin/env python

import sys
import os

def start_game():
    os.system('sh /var/www/html/awd-lastest/docker/docker.sh')    

def start_flag_docker():
    os.system('sh /var/www/html/awd-lastest/docker/flag.sh')    

def start_check():
     os.system('sh /var/www/html/awd-lastest/docker/check.sh')   

def copy_team():
    os.system('sh /var/www/html/awd-lastest/docker/cp.sh')



if __name__ == '__main__':
  #  copy_run_sh(dir)
    copy_team()
    start_flag_docker()
    start_game()
    start_check()
