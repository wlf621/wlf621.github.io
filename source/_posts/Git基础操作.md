### Git创建远程分支
```bash
git checkout -b my-test  # 在当前分支下创建my-test的本地分支分支
git push origin my-test  # 将my-test分支推送到远程
git branch --set-upstream-to=origin/my-test # 将本地分支my-test关联到远程分支my-test上   
git branch -a # 查看远程分支
```