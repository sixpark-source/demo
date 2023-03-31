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
8. 后台地址是 您的网站路径加上/admin/   注意登录用户名和密码是您上面设置的用户名和密码

#### 插件系统
1. 目前系统开放了简单的插件系统，目前插件系统仅支持修改过的插件
2. 插件文件存放在/plugin/目录下
3. 首先需要使用管理员账号登录 
4. 登录地址是你的网站访问地址加上/admin/目录，比如 https://www.demo.com/admin/
5. 进入系统后，可以看到插件的入口
   <img src="https://github.com/sixpark-source/demo/blob/main/doc_resource/admin.png">
6. 点击进入插件，可以看到插件的列表，点安装就可以完成安装
   <img src="https://github.com/sixpark-source/demo/blob/main/doc_resource/plugin_1.png">
7. 如果不需要某个插件，则可以点卸载
   <img src="https://github.com/sixpark-source/demo/blob/main/doc_resource/plugin_2.png">
8. 一般情况下插件可以组合使用，但是主题类插件，不能组合使用，容易出现冲突
9. 一般安装好插件后，清空缓存，前端就可以看到效果，如果出现冲突，直接卸载插件即可



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


