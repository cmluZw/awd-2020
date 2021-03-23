# awd-lastest

<h1>这是一个简易的线上awd攻防平台，基于php + docker + python开发，这是awd平台的核心部分，如需完整代码（awd +论坛）请联系我</h1>

<h2>目录：</h2>
check_server:check文件
docker:python文件
enter：加入队伍/创建比赛
user：比赛平台首页
dao:数据配置及数据库共有方法
public:公共方法及类
style:静态文件
awd.sql:数据库文件
index.html:登录文件


<h2>使用：</h2>

提前搭建好lamp环境，将此文件放入到/var/www/html文件夹下
使用：
chmod 775 -R docker
对docker目录赋权以便python能调用doc

在check_server下：
使用:
python stop.py
清理docker下的sh文件及已存在的docker容器

将awd.sql导入mysql数据库
将awd-lastest.tar导入docker镜像

由于这里只是核心部分，所以暂不提供注册，如有需要，请自行到数据库文件里的user表中添加用户，team表中添加team，用例已在数据库文件中给出

使用说明：
安装好之后，访问your_ip/awd-lastest
会出现以下图片:

![图片](https://user-images.githubusercontent.com/78641812/112107050-6e5a8900-8be9-11eb-9f3d-72f9e0d2ee9b.png)

直接使用数据库中user表的用户账号密码进行登录即可

注意：每次只能有一个比赛进行，每次创建比赛需要停止当前比赛后才能创建

加入比赛需要先加入队伍


祝你有个好的体验！
