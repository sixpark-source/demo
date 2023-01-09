#### 留园网Demo说明
1. 获取代码
`git clone https://github.com/sixpark-source/demo.git`

2. 上传代码到您的服务器的web目录下，
3. 在服务器上创建一个 Mysql的 数据库
4. 导入代码根目录下的 **db.sql** 进入数据库
5. 修改 conf 目录下的 conf.php 按照您的实际情况修改如下部分代码
```
        'host' => '数据库服务器的地址，如果在本地就是127.0.0.1',
        'user' => '数据库用户名',
        'password' => '数据库密码',
        'name' => '数据库名字',

```
6. 修改完毕 conf.php 后，请保存
7. 修改conf 目录下的 conf.auth.php 文件 根据实际情况修改对应的参数。
8. 修改服务器的Apache Nginx配置文件，绑定网页，开始进行访问

#### 模板修改指南
1. 模板文件在 view/htm 中 
2. 系统的核心如何，目前主要使用的是 route/下的 
   1. auth.php 用于用户认证后授权使用的文件
   2. index.php 为首页加载的程序文件
   3. forum.php 为论坛帖子列表文件
   4. thread.php 为帖子的内容程序文件
   5. post.php 为发帖和评论模块的程序文件

3.<font color="red">特别注意，每次修改程序和模板文件后，需要清空 tmp目录下的所有文件，否则修改不生效</font>

#### <a href="https://github.com/sixpark-source/OAuth2/blob/master/Doc/Auth2.0%E6%8E%A5%E5%8F%A3%E6%8C%87%E5%8D%97.md">留园Auth2.0文档说明</a>

#### <a href="https://github.com/sixpark-source/OAuth2/blob/master/Doc/%E8%B5%84%E6%BA%90%E6%8E%A5%E5%8F%A3%E6%96%87%E6%A1%A3.md">留园资源获取文档指南</a>


