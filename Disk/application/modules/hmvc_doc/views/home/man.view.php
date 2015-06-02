<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN"><head>
    <title>Cross PHP Framework</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Keywords" content="php, php框架, composer, HMVC, Layer, 路由别名, PSR, 注释配置, 轻量php开发框架, Cross Framework, PHP Framework">
    <meta name="Description" content="Cross PHP Framework 是一个简单, 轻量, 易扩展的PHP5开发框架, 遵循PSR标准,
                      支持composer, HMVC, 支持注释配置, Layer布局, 路由别名, 全局的异常处理, 简单的Mysql查询, 欢迎各种性能对比测试">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/A/U/U2/jquery-ui-1.css" media="all" rel="stylesheet" type="text/css">
    <link href="/A/U/U2/sons-of-obsidian.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/A/U/U2/pure-min.css">
    <link rel="stylesheet" rev="stylesheet" href="/A/U/U2/style.css" media="all">

    <script src="/A/U/U2/hm.js"></script>
    <script src="/A/Jquery/jquery-1.11.1.js" type="text/javascript"></script>
    <script src="/A/U/U2/jquery-ui-1.js" type="text/javascript"></script>
    <script src="/A/U/U2/marked.js" type="text/javascript"></script>
    <script src="/A/U/U2/base.js" type="text/javascript"></script>
    <script src="/A/U/U2/prettify.js" type="text/javascript"></script>


    <!--[if lte IE 8]>
    <link rel="stylesheet" href="http://document.crossphp.com/static/ lib/pure/0.5.0/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="/A/U/U2/grids-responsive-min.css">
    <!--<![endif]-->

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="http://document.crossphp.com/static/ css/layouts/blog-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="/A/U/U2/blog.css">
    <!--<![endif]-->
    <style>
        .doc-nav-ul{clean:both;}
    </style>

</head>
<body class="pure-skin-mine">

<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-md-1-4">
        <div class="header" style="text-align: left;margin:10% 10px">
            <div style="text-align: left">
                <img src="/1A/U/U2/logo.png" style="width:200px;" alt="Sham PHP Framework">
            </div>

            <nav class="nav" style="padding-bottom: 20px;">
                <ul class="nav-list">
                    <li class="nav-item"><a class="pure-button" href="/doc/home.index">主页</a></li>
                    <li class="nav-item"><a class="pure-button" href="/doc/home.man">管理</a></li>
                    <li class="nav-item"><a class="pure-button" href="/doc/home.about">关于</a></li>
                </ul>
            </nav>

            <nav class="nav" style="float:left;">
                <ul class="nav-list">
                       <ul class="doc-nav-ul"><span class="doc-nav-menu" style="cursor:pointer;font-weight:700">概览</span>
                                    <ul class="doc-nav-ul">
                                    <li style="padding-left:30px;"><a href="/doc/home.manbook">1.book管理</a></li>
                                    <li style="padding-left:30px;"><a href="/doc/home.manset">2.配置</a></li>
                                    </ul>
                       </ul>
                </ul>
            </nav>
        </div>
    </div>

    <div class="content pure-u-1 pure-u-md-3-4">
        <div>
            <!-- A wrapper for all the blog posts -->
            <div class="posts">
                <!-- A single blog post -->
                <section class="post">
                    <div id="main" style="position: relative;padding-bottom: 70px;">
                        <!--[if lte IE 8]>
                        <pre class="markdown-body" id="markdown-preview"></pre>
                        <![endif]-->
                        <!--[if gt IE 8]><!-->
                        <div class="markdown-body" id="markdown-preview">
                        
                        
                        </div>
                        <!--<![endif]-->
                    </div>
                    <div style="display:none">
                        <textarea name="" id="content" style="display:none;width:100%;min-height:800px;">
##CrossPHP一个简洁高效，轻量易扩展的PHP5.3+开发框架。

### 一. 需求
PHP5.3以上版本，mysql需要PDO支持。

### 二. 简介

支持PSR标准，支持composer。HMVC，支持注释配置（支持自定义，只有想不到，没有做不到）。
Layer布局支持，更换模板更简单。路由别名（先写代码，后定义，比如rul：/Controoooooller/Actiooooon/5，可以通过
别名指定为：/d/5）。
全局的异常处理系统及错误展示，在开发中可以快速定位到具体的代码行数。简单的Mysql查询。欢迎各种性能对比测试。

### 三. 下载安装
1. 从[http://www.crossphp.com/download](http://www.crossphp.com/download 
"crossphp.com")下载框架完整版并解压到本地目录（默认情况下skeleton和crossphp要保持在同级目录）。
2. 通过 `http://localhost/skeleton/htdocs/web` 来访问默认的web页面


&gt;正常访问 `http://localhost/skeleton/htdocs/admin`, 
需要修改你的数据库配置`skeleton/config/db.config.php`,并导入`skeleton/sql/admin
/back.sql`文件。


### 四. 使用Composer安装
单独下载最新版skeleton，并解压到web目录，在skeleton根目录下新建一个名为 `composer.json` 文件，输入如下内容

    {
        "require": {
            "ideaa/cross": "dev-master"
        }
    }

进入进入系统的命令行模式并切换到skeleton目录，在命令行中输入 `composer install` , 
等待安装完后，编辑skeleton目录下的 `crossboot.php` 文件，修改文件的最后两行为：

    require PROJECT_PATH.'vendor/autoload.php';
    class_alias('Cross\Core\Delegate', 'Cross');

加载`vendor`提供的autoload文件， 为 `Cross\Core\Delegate` 指定一个别名，至此安装结束。
&gt;正常访问 `http://localhost/skeleton/htdocs/admin`, 
需要修改你的数据库配置`skeleton/config/db.config.php`,并导入`skeleton/sql/admin
/back.sql`文件。
</textarea>
                    </div>
                </section>
            </div>

            <div class="footer">
                <div class="pure-menu pure-menu-horizontal pure-menu-open">

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
//    var cpf = {
//        "url_dot": "/",
//        "site_url": "http://document.crossphp.com/",
//        "res_base_url": "./static",
//        "url_link": function (s) {
//            var url = s.split(":");
//            return url[1] ? this.site_url + url[0] + this.url_dot + url[1] : this.site_url + url[0];
//        }
//    };

    $(function () {
        var $markdown_preview = $("#markdown-preview"), aid = hashData.read("id");
        if (aid.id) {
            var id = aid.id, doc = $("#" + id), doc_id = doc.attr("doc-id");
            if (doc_id) {
                $("#menu").scrollTop(doc.offset().top - 50);
                getDocAndMarked(doc_id);
            } else {
               // window.location.href = cpf.site_url;
            }
        } else {
            $markdown_preview.html(marked(document.getElementById('content').value));
        }

        $("#markdown-preview pre").addClass("prettyprint").attr('style',
            'background:#333;' +
            'padding: 9.5px;' +
            'font-size: 13px;' +
            'line-height: 20px; ' +
            'border-radius: 10px;'
        );

        prettyPrint();

//        $("#menu").resizable({
//            handles: "e",
//            resize: function (event, ui) {
//                $markdown_preview.width($('body').width() - ui.size.width - 10); //10 is padding value
//            }
//        });

        $(".doc-nav-menu").click(function () {
            $(this).next("ul").toggle();
        });

//        $("#editDOC").click(function () {
//            var doc = $(this).attr("doc")
//            if (doc) {
//               // window.location.href = cpf.url_link("doc:edit") + cpf.url_dot + doc;
//            }
//            console.log(doc);
//        });

//        var isOut = false;
//        var doc_menu = $("#doc-menu");
//        var other = document.getElementsByTagName('body')[0];

//        $("#doc-m").hover(function () {
//            doc_menu.slideDown('fast').show(200);
//            isOut = true;
//        }, function () {
//            other.onclick = function () {
//                if (isOut) {
//                    doc_menu.hide(1);
//                }
//            };
//        });
    });

//    function getContent(t) {
//        var doc_id = $(t).attr("doc-id");
//        getDocAndMarked(doc_id);
//        hashData.write("id", $(t).attr("id"));
//    }

//    function getDocAndMarked(id) {
//        $.get(cpf.url_link("read") + cpf.url_dot + id, function (d) {
//            var dd = $.parseJSON(d);
//            if (dd.content) {
//                $("#editDOC").attr("doc", dd.path).show();
//                $("#markdown-preview").html(marked(dd.content));
//                $("#markdown-preview pre").addClass("prettyprint").attr('style',
//                    'background:#333;' +
//                    'padding: 9.5px;' +
//                    'font-size: 13px;' +
//                    'line-height: 20px; ' +
//                    'border-radius: 10px;'
//                );
//                prettyPrint();
//            } else {
//                $("#markdown-preview").html("暂无内容");
//            }
//        })
    //}
</script>


</body></html>