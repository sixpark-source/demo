#### 留园网Demo说明
1. 请先注册一个域名，在申请应用的时候，需要回调地址，所以请先准备好一个域名。
2. 前往 https://open.6park.com 使用留园账号登录，申请创建一个应用
3. 申请后，会得到 一个 **client_id** 和 **client_secret** 请保存好对应的值，后面需要
4. 获取代码
`git clone https://github.com/sixpark-source/demo.git`
5. 上传代码到您的服务器的web目录下，
6. 使用域名访问这个web目录下的资源，默认情况下，系统会自动进入安装状态。
<img src="https://github.com/sixpark-source/demo/blob/main/doc_resource/db.png">
7. 完成安装，则系统自动进入网站。


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


