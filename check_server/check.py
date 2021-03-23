#!/usr/bin/env python
# -*- coding:utf8 -*-
'''

'''
import hashlib
import base64

sleep_time  = 900
debug = True
headers = {"User-Agent":"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36"}

import time
import httplib
import urllib2
import ssl
import requests
import os

__doc__ = 'http(method,host,url,data,headers)'
check_server= '47.115.18.243'
hosts = open('host.lists','r').readlines()
#user_id = [host.split(':')[0] for host in hosts]

def http(method,host,url,data,headers):
    con=httplib.HTTPConnection(host,timeout=2)
    if method=='post' or method=='POST':
        headers['Content-Length']=len(data)
        headers['Content-Type']='application/x-www-form-urlencoded'  
        con.request("POST",url,data,headers=headers)
    else:
        headers['Content-Length'] = 0    
        con.request("GET",url,headers=headers)
    res = con.getresponse()
    if res.getheader('set-cookie'):
        #headers['Cookie'] = res.getheader('set-cookie')
        pass
    if res.getheader('Location'):
        print "Your 302 direct is: "+res.getheader('Location')
    a = res.read()
    con.close()
    return a


def https(method,host,url,data,headers):
    url = 'https://' + host  + url
    req = urllib2.Request(url,data,headers)
    response = urllib2.urlopen(req)
    return response.read()



def add_score(host):
    res = http('post',check_server,'/awd-lastest/check_server/262315a1fe984698.php','ip=%s&option=add'%(host),headers)
    if 'check is ok' in res:
	return True
    if debug:
	print "[fail!] add_fail"
    return False
	
def sub_score(host):
    res = http('post',check_server,'/awd-lastest/check_server/262315a1fe984698.php','ip=%s&option=sub'%(host),headers)
    if 'check is ok' in res:
	return True
    if debug:
	print "[fail!] sub_fail"
    return False

def resetdocker():
    os.system('python resetdocker.py')

def reset():
    os.system('python reset.py')



class check():
    def __init__(self):
	print "checking host: "+host
    
    def clean_submit():
        url="http://47.115.18.243/awd-lastest/check_server/3b5f9785d44eb7ba.php"
        headers={
            "User-Agent":"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36",
        }
        html=requests.get(url,headers=headers)
        if html.status_code==200:
            return True
        else:
            return False

    def index_check(self):
	res = http('get',host,'/public/','',headers)
	if '十年磨一剑' in res:
	    return True
	if debug:
	    print "[fail!] index_fail"
	return False
	

    def test_check(self):
	res = http('get',host,'/public/index.php?s=index/think\app/invokefunction&function=call_user_func_array&vars[0]=system&vars[1][]=whoami','',headers)
	if 'www-data' not in res:
	    return True
	if debug:
	    print "[fail!] test_fail"
	return False


    def test_check_2(self):
	headers['Cookie'] = ''
	data = 'key=1'
	res = http('get',host,'/web/register?goto=/web/teacher',data,headers)
	if '邮箱地址' in res:
	    return True
	if debug:
	    print "[fail!] test_2_fail"
	return False
	

    def login_check(self):
	headers['Cookie'] = 'PHPSESSID=ujg0tpds1u9d23b969f2duj5c7;'
	headers['X-Requested-With'] = 'XMLHttpRequest'
	res = http('post',host,'/admin/login/index.html','username=admin&password=admin&verify=7480',headers)
	if '"status":1' in res:
	    return True
	if debug:
	    print "[fail!] login_fail"
	return False

    def admin_check(self):
	data = 'eval(666)'
	headers['Cookie'] = 'PHPSESSID=ujg0tpds1u9d23b969f2duj5c7;'
    	res = http('get',host,'/admin/tools/database?type=export',data,headers)
	tmp = http('get',host,'/admin/login/loginout.html','',headers)
	if 'qq3479015851_article_type' in res:
	    return True
	if debug:
	    print "[fail!] admin_fail"
	return False
    

def server_check():
    try:
	a = check()
	if not a.index_check():
	    return False
	if not a.clean_submit:
	    return False
	#if not a.test_check_2():
	 #   return False	
	return True
    except Exception,e:
	print e
	return False


game_round = 0
while True:
    print "--------------------------- round %d -------------------------------"%game_round
    for host in hosts:
	print "---------------------------------------------------------------"
	host = host[:-1]
	if server_check():
	    print "Host: "+host+" seems ok"
	    add_score(host)
            print "Host: "+host+" add is ok"
        else:
	    print "Host: "+host+" seems down"
	    sub_score(host)
            print "Host: "+host+" sub is ok"

   # if  reset():
   #    print "all docker is resetted"
    game_round += 1
    time.sleep(sleep_time)
