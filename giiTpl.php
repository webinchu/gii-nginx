<?php
return <<<TPL
server {
    listen    $port;
    server_name $domain;
    root  $dirPath;
    location / {
        index index.php index.html error/index.html;
        $tryFiles
        autoindex off;
    }
    error_log /opt/homebrew/etc/nginx/logs/$domain.log;
    location ~ \.php(.*)$ {
      fastcgi_pass  127.0.0.1:9000;
      fastcgi_index index.php;
      fastcgi_split_path_info ^((?U).+\.php)(/?.+)$;
      fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
      fastcgi_param PATH_INFO \$fastcgi_path_info;
      fastcgi_param PATH_TRANSLATED \$document_root\$fastcgi_path_info;
      include    fastcgi_params;
    }
}
TPL;
