<?php
//本机存放NGINX配置文件的地方
$nginxHostPath = "/opt/homebrew/etc/nginx/vhosts";
//本机host文件地址(注意需要打开文件的可读写权限)
$ectHost = '/etc/hosts';

//伪静态
switch ($_POST['tryFile']) {
    case 2 :
        $tryFiles = "if (!-e \$request_filename){rewrite  ^(.*)$  /index.php?s=$1  last;   break;}";
        break;
    case 3 :
        $tryFiles = "try_files \$uri \$uri/ /index.php?\$args;";
        break;
    default:
            $tryFiles = "try_files \$uri \$uri/ /index.php\$is_args\$query_string;";
            break;
    }
    if (empty($_POST['domain']) || empty($_POST['dirPath'])) {
        header("Location:.?status=0");exit();
    }
    $domain = $_POST['domain'];
//不覆盖已存在的
//    if (is_file($hostPath."/".$domain)){
//        header("Location:.?status=2");exit();
//    }
    $dirPath = $_POST['dirPath'];
    if (!is_dir($dirPath)) {
        header("Location:.?status=3");exit();
    }
    $port = $_POST['port'] ?: 80;
    $tpl = include "./giiTpl.php";
    //写入文件
file_put_contents($domain, $tpl);
$shellCommand = "mv ./" . $domain . "  " . $nginxHostPath;
    //用终端命令移动文件至对应文件夹
    shell_exec($shellCommand);
    $status = 0;
if (is_file($nginxHostPath . "/" . $domain)) {
    $status = 1;
    try {
        file_put_contents($ectHost, "127.0.0.1 $domain\n", FILE_APPEND);
        $hostLog = $port == 80 ? $domain : ($domain . ':' . $port);
        file_put_contents('./host.log', $hostLog . ",", FILE_APPEND);
    } catch (\Throwable $e) {
    }
    //重启nginx
    shell_exec("nginx -s reload");
}
    header("Location:./?status=$status");exit();

