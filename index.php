<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css"  crossorigin="anonymous">
</head>
<body>
<br>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">手动生成nginx配置文件</li>
        </ol>
    </nav>
    <form method="post" action="./gii.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>本地域名: </label>
            <input type="text" name="domain" class="form-control" id="domain" required aria-describedby="emailHelp">
            <small id="domainHelp" class="form-text text-muted">域名示例: xxx.test(覆盖已存在的)</small>
        </div>
        <div class="form-group">
            <label>端口: </label>
            <input type="number" name="port" value="80" class="form-control" required id="port"
                   aria-describedby="emailHelp">
            <small id="portHelp" class="form-text text-muted">本地端口默认: 80</small>
        </div>
        <div class="form-group">
            <label>对应项目地址: </label>
            <input type="text" name="dirPath" class="form-control" required id="port" aria-describedby="emailHelp">
            <small id="fileHelp" class="form-text text-muted">项目绝对路径(例:/www/wwwroot/thinkphp/public)</i></small>
        </div>
        <div class="form-group">
            <label for="inputState">框架: </label>
            <select id="inputState" name="tryFile" class="form-control  col-md-4">
                <option selected value="0">请选择</option>
                <option value="1">Laravel</option>
                <option value="2">ThinkPHP</option>
                <option value="3">Yii</option>
            </select>
            <small id="fileHelp" class="form-text text-muted">用于配置伪静态(默认:try_files $uri $uri/
                /index.php$is_args$query_string)</i></small>
        </div>
        <button type="submit" class="btn btn-primary">创建</button>
    </form>
</div>
<script>
    var status = <?php echo $_GET['status'] ?: 0 ?>;
    if (status == 1) {
        alert("域名新增成功")
    } else if (status == 2){
        alert("域名已存在")
    }else if (status == 3){
        alert("项目地址不存在")
    }else{
        alert("域名新增失败")
    }
</script>
</body>
</html>

