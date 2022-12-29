---
title: Git基础操作
date: 2022-11-07 20:26:02
categories:
- Git基础操作
mathjax: true
tag:
- Git基础操作
---

[toc]

# 常见命令

## 生成密钥

```bash
ssh-keygen -t rsa -C "cxwanglunfei@163.com"
```



## Git创建远程分支

```bash
git checkout -b my-test  # 在当前分支下创建my-test的本地分支分支
git push origin my-test  # 将my-test分支推送到远程
git branch --set-upstream-to=origin/my-test # 将本地分支my-test关联到远程分支my-test上   
git branch -a # 查看远程分支
```



## Git配置

```bash
git config --local user.name=wlf
git config --local user.email=cxwanglunfei@163.com
git config --global user.name=wlf
git config --global user.email=cxwanglunfei@163.com
```



# 常见问题

## 解决connect to host github.com port 22: Connection timed out报错

.ssh文件夹下config文件（若没有则新建）添加以下配置

```bash
Host github.com  
User cxwanglunfei@163.com  
Hostname ssh.github.com  
PreferredAuthentications publickey  
IdentityFile /c/Users/wlf/.ssh/id_rsa  
Port 443  
```

