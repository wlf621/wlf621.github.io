---
title: Linux 常用操作
date: 2022-09-25 21:31:39
tags:
- Linux
---

### uname

> Linux uname（英文全拼：unix name）命令用于显示系统信息。

```shell
uname [-amnrsv][--help][--version]
```

**参数说明**：

- -a或--all 　显示全部的信息。
- -m或--machine 　显示电脑类型。
- -n或--nodename 　显示在网络上的主机名称。
- -r或--release 　显示操作系统的发行编号。
- -s或--sysname 　显示操作系统名称。
- -v 　显示操作系统的版本。
- --help 　显示帮助。
- --version 　显示版本信息。



### systemctl

> 管理服务(unit)
> systemctl 提供了一组子命令来管理单个的 unit

```shell
systemctl [command] [unit]
```



- 查看版本号
  systemctl –-version
- command 主要有：
  - start：立刻启动后面接的 unit。
  - stop：立刻关闭后面接的 unit。
  - restart：立刻关闭后启动后面接的 unit，亦即执行 stop 再 start 的意思。
  - reload：不关闭 unit 的情况下，重新载入配置文件，让设置生效。
  - enable：设置下次开机时，后面接的 unit 会被启动。
  - disable：设置下次开机时，后面接的 unit 不会被启动。
  - status：目前后面接的这个 unit 的状态，会列出有没有正在执行、开机时是否启动等信息。
  - is-active：目前有没有正在运行中。
  - is-enabled：开机时有没有默认要启用这个 unit。
  - kill ：不要被 kill 这个名字吓着了，它其实是向运行 unit 的进程发送信号。
  - show：列出 unit 的配置。
  - mask：注销 unit，注销后你就无法启动这个 unit 了。
  - unmask：取消对 unit 的注销。
