<?php
// phpinfo();
$file = "./upload_log.log";
$fele = "./upload_l.log";
 
echo "<br>$file 当前权限".substr(sprintf('%o',fileperms($file)), -3);
echo "<br>$fele 当前权限".substr(sprintf('%o',fileperms($fele)), -3);
if(is_file($file)){
  if(chmod($file, 0666)){
    $echox.= "文件《{$file}》权限修改为666成功\n";
  }else{
    $echox.= "文件《{$file}》权限修改为666失败!\n";
  }
}else{
  $echox.= "文件《{$file}》不存在,暂未修改权限!\n";
}
echo "<br>";
if(is_dir($fele)){
  if(chmod($fele, 0666)){
    $echox.= "文件夹《{$fele}》权限修改为666成功\n";
  }else{
    $echox.= "文件夹《{$fele}》权限修改为666失败!\n";
  }
}else{
  $echox.= "文件夹《{$fele}》不存在,暂未修改权限!\n";
}
echo "<br>$file 改后权限".substr(sprintf('%o',fileperms($file)), -3);
echo "<br>$fele 改后权限".substr(sprintf('%o',fileperms($fele)), -3);

