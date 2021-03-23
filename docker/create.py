#!/usr/bin/python

import sys
import os

#num=sys.argv[1]
#flag= sys.argv[2]
###need web_name  docker_web_name team_num

def copy_team(web_name,team_no):

    content='cp -r /var/www/html/awd-lastest/docker/%s team_%d'%(web_name,team_no)
    return content





def create_run_sh(num):
    content = """#!/bin/sh
    cd /var/www/html
    service apache2 stop
    service apache2 start
    /etc/init.d/ssh start
    /bin/bash""" 
    return content

def create_docker_sh(team_no,team_web_name):

    content = """
docker run -p %d:80  -p %d:22 -v /var/www/html/awd-lastest/docker/%s:/var/www/html -v /var/www/html/awd-lastest/docker/d7297256b8cf26ab/Team_F1AG_%d:/flag -d  --name team%d -it awd-lastest /run.sh 
"""% (8800 + team_no, 2200 + team_no,team_web_name,team_no,team_no)
    return content


def create_flag_sh():
    content = """
docker run -p 8800:80 -v /var/www/html/awd-lastest/docker/flag:/var/www/html -d  --name flag_docker -it awd-lastest /run.sh 
"""
    return content

def create_check_docer():
    content = """
docker run  -v /var/www/html/awd-lastest/check_server:/check_server -d  --name check_docker -it check_server /run.sh
"""
    return content


def main():
    team_num = int(sys.argv[1])
    web_name =str(sys.argv[2])
    end_time=int(sys.argv[3])

    open('run.sh','w').write(create_run_sh(team_num))
    open('flag.sh','a').write(create_flag_sh())
    open('check.sh','a').write(create_check_docer())

    
    for i in range(team_num):

        open('cp.sh','a').write(copy_team(web_name,i+1)+'\n')

	open('docker.sh','a').write(create_docker_sh(i+1,"team_"+str(i+1))+'\n')
        #open('flag.sh','a').write(create_flag_sh())
        #open('check.sh','a').write(create_check_docer())
    os.system('python start.py %d %d'%(team_num,end_time))


   # os.system('sh cp.sh')
if __name__ == '__main__':
	main()
       # os.system('python start.py %d %d'%(team_num,end_time))
	
#python create.py 3 ../test
