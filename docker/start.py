#!/usr/bin/env python

import sys
import os


#dir = str(sys.argv[1])##don not write to ../
def copy_run_sh(dir):
    os.system('cp /var/www/html/awd-lastest/docker/run.sh %s'%(dir))

def start_game():
    os.system('sh /var/www/html/awd-lastest/docker/docker.sh')    

def start_flag_docker():
    os.system('sh /var/www/html/awd-lastest/docker/flag.sh')    

def start_check():
     os.system('sh /var/www/html/awd-lastest/docker/check.sh')   

def copy_team():
    os.system('sh /var/www/html/awd-lastest/docker/cp.sh')

def write_flag():

    flag_arr=[]
    f = open("f1Ag_safe_very_0_1_hh.txt")
    flag_arr=f.readlines()
    # print flag_arr
    i=1
    for line in flag_arr:
        with open("team_%d/flag.php"%(i),"a") as f2:
            f2.write(line)
        i=i+1


if __name__ == '__main__':
  #  copy_run_sh(dir)
    team_num=int(sys.argv[1])
    end_time=int(sys.argv[2])
    copy_team()
    start_flag_docker()
    start_game()
    start_check()
