---
title: Docker 实践
date: 2022-11-07 20:26:02
categories:
- Docker
mathjax: true
tag:
- Docker
---

[toc]

# 基础命令

## 常用命令图示

![image-20221225215844006](image-20221225215844006.png)



## 启动Docker

```bash
systemctl start docker	#启动docker
systemctl status docker	#查看状态
systemctl enable docker	#开机自启动docker
```



## 帮助命令

```bash
docker version		#版本信息
docker info			#docker系统信息
docker [cmd] --help #帮助信息
```



## 镜像命令

### docker images

```bash
[root@VM-8-3-centos ~]# docker images --help
Usage:  docker images [OPTIONS] [REPOSITORY[:TAG]]
List images
Options:
  -a, --all             Show all images (default hides intermediate images)
      --digests         Show digests
  -f, --filter filter   Filter output based on conditions provided
      --format string   Pretty-print images using a Go template
      --no-trunc        Don't truncate output
  -q, --quiet           Only show image IDs
```

**filter**
过滤标志（-f或–filter）格式为`“key=value”`。如果有多个过滤器，则传递多个标志（例如，`–filter “foo=bar” --filter “bif=baz”`）

**目前支持的过滤器有：**

| 过滤器    | 描述                                                         |
| --------- | ------------------------------------------------------------ |
| dangling  | 显示标记为空的镜像，true和false                              |
| label     | 根据标签进行过滤，其中lable的值，是docker在Dockerfile中配置的 |
| before    | 根据时间来进行过滤，表示镜像构建时间之前的镜像               |
| since     | 根据时间来进行过滤，表示在镜像构建之后的镜像                 |
| reference | 正则匹配                                                     |

**format**
格式化选项将使用 Go 模板漂亮地打印容器输出。要以表格格式列出可以使用table
下面列出了 Go 模板的有效占位符：

| 占位符        | 描述               |
| ------------- | ------------------ |
| .ID           | 镜像id             |
| .Repository   | 镜像名称           |
| .Tag          | 镜像标签           |
| .Digest       | 镜像简介           |
| .CreatedSince | 自创以来经过的时间 |
| .CreatedAt    | 创建图像的时间     |
| .Size         | 镜像大小           |



### docker search

```bash
[root@VM-8-3-centos ~]# docker search --help
Usage:  docker search [OPTIONS] TERM
Search the Docker Hub for images
Options:
  -f, --filter filter   Filter output based on conditions provided
      --format string   Pretty-print search using a Go template
      --limit int       Max number of search results (default 25)
      --no-trunc        Don't truncate output

Eg: docker search python -f=stars=5
```



### docker pull

```bash
[root@VM-8-3-centos ~]# docker search --help
Usage:  docker search [OPTIONS] TERM
Search the Docker Hub for images
Options:
  -f, --filter filter   Filter output based on conditions provided
      --format string   Pretty-print search using a Go template
      --limit int       Max number of search results (default 25)
      --no-trunc        Don't truncate output

eg: docker pull mysql:latest
```



### docker rmi

```bash
[root@VM-8-3-centos ~]# docker rmi --help
Usage:  docker rmi [OPTIONS] IMAGE [IMAGE...]
Remove one or more images
Options:
  -f, --force      Force removal of the image
      --no-prune   Do not delete untagged parents

```



## 容器命令

### docker run

```bash
[root@VM-8-3-centos ~]# docker run --help
Usage:  docker run [OPTIONS] IMAGE [COMMAND] [ARG...]
Run a command in a new container

#参数较多，列举常用选项
--name="Name"		#命名容器
-d					#后台方式运行容器
-it					#交互方式运行，进入容器查看内容
-p					#发布容器指定端口到主机端口
	-p	#主机端口:容器端口
	-p	#容器端口
-P					#随机指定端口映射，容器内部端口随机映射到主机的端口
-e					#配置环境变量
-v					#挂载目录
```

### docker ps

```bash
[root@VM-8-3-centos ~]# docker ps --help
Usage:  docker ps [OPTIONS]
List containers
Options:
  -a, --all             Show all containers (default shows just running)
  -f, --filter filter   Filter output based on conditions provided
      --format string   Pretty-print containers using a Go template
  -n, --last int        Show n last created containers (includes all states) (default -1)
  -l, --latest          Show the latest created container (includes all states)
      --no-trunc        Don't truncate output
  -q, --quiet           Only display container IDs
  -s, --size            Display total file sizes

Eg: docker ps -an 1
```

### docker logs

```bash
[root@VM-8-3-centos ~]# docker logs --help
Usage:  docker logs [OPTIONS] CONTAINER
Fetch the logs of a container
Options:
      --details        Show extra details provided to logs
  -f, --follow         Follow log output
      --since string   Show logs since timestamp (e.g. 2013-01-02T13:23:37Z) or
                       relative (e.g. 42m for 42 minutes)
  -n, --tail string    Number of lines to show from the end of the logs (default "all")
  -t, --timestamps     Show timestamps
      --until string   Show logs before a timestamp (e.g. 2013-01-02T13:23:37Z) or
                       relative (e.g. 42m for 42 minutes)

```

### docker inspect

```bash
[root@VM-8-3-centos ~]# docker inspect --help
Usage:  docker inspect [OPTIONS] NAME|ID [NAME|ID...]
Return low-level information on Docker objects
Options:
  -f, --format string   Format the output using the given Go template
  -s, --size            Display total file sizes if the type is container
      --type string     Return JSON for specified type

```

### docker exec

```bash
[root@VM-8-3-centos ~]# docker exec --help
Usage:  docker exec [OPTIONS] CONTAINER COMMAND [ARG...]
Run a command in a running container
Options:
  -d, --detach               Detached mode: run command in the background
      --detach-keys string   Override the key sequence for detaching a container
  -e, --env list             Set environment variables
      --env-file list        Read in a file of environment variables
  -i, --interactive          Keep STDIN open even if not attached
      --privileged           Give extended privileges to the command
  -t, --tty                  Allocate a pseudo-TTY
  -u, --user string          Username or UID (format: <name|uid>[:<group|gid>])
  -w, --workdir string       Working directory inside the container

```

### docker attach

```bash
[root@VM-8-3-centos ~]# docker attach --help
Usage:  docker attach [OPTIONS] CONTAINER
Attach local standard input, output, and error streams to a running container
Options:
      --detach-keys string   Override the key sequence for detaching a container
      --no-stdin             Do not attach STDIN
      --sig-proxy            Proxy all received signals to the process (default true)

```

### docker cp

```bash
[root@VM-8-3-centos ~]# docker cp --help
Usage:  docker cp [OPTIONS] CONTAINER:SRC_PATH DEST_PATH|-
        docker cp [OPTIONS] SRC_PATH|- CONTAINER:DEST_PATH

Copy files/folders between a container and the local filesystem
Use '-' as the source to read a tar archive from stdin
and extract it to a directory destination in a container.
Use '-' as the destination to stream a tar archive of a
container source to stdout.

Options:
  -a, --archive       Archive mode (copy all uid/gid information)
  -L, --follow-link   Always follow symbol link in SRC_PATH

```

# docker镜像

## UnionFS （联合文件系统）

​	UnionFS（联合文件系统）：Union文件系统（UnionFS）是一种分层、轻量级并且高性能的文件系统，
它支持对文件系统的修改作为一次提交来一层层的叠加，同时可以将不同目录挂载到同一个虚拟文件系
统下(unite several directories into a single virtual filesystem)。Union 文件系统是 Docker 镜像的基
础。镜像可以通过分层来进行继承，基于基础镜像（没有父镜像），可以制作各种具体的应用镜像。

**特性：**一次同时加载多个文件系统，但从外面看起来，只能看到一个文件系统，联合加载会把各层文件
系统叠加起来，这样最终的文件系统会包含所有底层的文件和目录  

**`overlay2`是目前Docker 官方推荐的文件系统，也是目前安装 Docker 时默认的文件系统。**

联合文件系统（overlay）基本原理图示：

![overlay2](overlay2.png)

​	如上图所示，OverlayFS将单个Linux主机上的两个目录合并成一个目录，这些目录被称为层，统一过程被称为联合挂载。OverlayFS关联的底层目录称为lowerdir，lowerdir是只读的镜像层(image layer)，其中就包含bootfs/rootfs层，bootfs(boot file system)主要包含bootloader和kernel，bootloader主要是引导加载kernel，当boot成功 kernel 被加载到内存中，bootfs就被umount了，rootfs(root file system)包含的就是典型Linux系统中的/dev、/proc、/bin、/etc等标准目录。lowerdir是可以分很多层的，除了bootfs/rootfs层以外，还可以通过Dockerfile建立很多image层。

​	对应的高层目录upperdir层是lowerdir的上一层，只有这一层可读可写的，其实就是Container层，在启动一个容器的时候会在最后的image层的上一层自动创建，所有对容器数据的更改都会发生在这一层。

​	联合挂载后merged层就是联合挂载层，也就是给用户暴露的统一视觉，将image层和container层结合，就如最上边的图中描述一致，同一文件，在此层会展示离它最近的层级里的文件内容，或者可以理解为，只要container层中有此文件，便展示container层中的文件内容，若container层中没有，则展示image层中的。

加载过程图示：

![加载过程](lianhejiazai.png)

参考文章：

[docker的联合文件系统（UnionFS）_忍冬行者的博客-CSDN博客_docker unionfs](https://blog.csdn.net/rendongxingzhe/article/details/126864482)



## 分层镜像

​	所有的 Docker 镜像都起始于一个基础镜像层，当进行修改或增加新的内容时，就会在当前镜像层之
上，创建新的镜像层。

![镜像分层](image-layers.png)

> Docker镜像都是只读的，当容器启动时，一个新的可写层被加载到镜像的顶部！
> 这一层就是我们通常说的容器层，容器之下的都叫镜像层！  



## commit镜像

```bash
[root@VM-8-3-centos ~]# docker commit --help
Usage:  docker commit [OPTIONS] CONTAINER [REPOSITORY[:TAG]]
Create a new image from a container's changes

Options:
  -a, --author string    Author (e.g., "John Hannibal Smith <hannibal@a-team.com>")
  -c, --change list      Apply Dockerfile instruction to the created image
  -m, --message string   Commit message
  -p, --pause            Pause container during commit (default true)

```



# 容器数据卷

## 什么是容器数据卷？

​	容器挂载主机数据卷，实现数据共享



## 使用数据卷

> 方式一：使用docker run -v命令

```bash
docker run -it --name python:3.8 -p 80:5000 -v /usr/share/github_codes/timeManager:/opt/timeManager python:3.8 bash
```

主机目录/usr/share/github_codes/timeManager挂载到/opt/timeManager，类似软链接，把/opt/timeManager链接到/usr/share/github_codes/timeManager



# 可视化

**portainer**

```bash
docker run -d -p 80:9000 \
--restart=always -v /var/run/docker.sock:/var/run/docker.sock --privileged=true portainer/portainer
```



# 实践操作

## Mysql

```bash
[root@VM-8-3-centos ~]# docker pull mysql:5.7
[root@VM-8-3-centos home]# docker run -d -p 3310:3306 -v /home/mysql/conf:/etc/mysql/conf.d -v /home/mysql/data:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=QAZWSX@1234 --name mysql-timemanager mysql:5.7

-v	容器内路径:权限(ro/rw)			 # 匿名挂载
-v	卷名:容器内路径:权限(ro/rw)		# 具名挂载
-v	宿主路径:容器内路径:权限(ro/rw)	   # 指定目录挂载
# 路径为绝对路径
# ro  read only
# rw  readwrite
```



## 运行python3项目

```bash
docker pull python:3.8
   
# 启动docker
docker run -it --name python:3.8 -p 80:5000 -v /usr/share/github_codes/timeManager:/opt/timeManager python:3.8 bash

# 安装依赖
pip install -r requirements.txt -i https://pypi.tuna.tsinghua.edu.cn/simple

# 打包镜像
docker commit -a "wlf" -m "time manager" 74d22634c17f  time_manager:1.0.0
-a :提交的镜像作者；
-c :使用Dockerfile指令来创建镜像；
-m :提交时的说明文字；
-p :在commit时，将容器暂停。
```



## DockerFile

```shell
# dockerfile 文件示例
FROM centos
MAINTAINER wlf<cxwanglunfei@163.com>
ENV MYPATH /usr/share/docker_learning
WORKDIR $MYPATH
# RUN yum -y install vim   # centos不再提供服务，原始镜像源会下载失败
# RUN yum -y install net-tools
VOLUME ["volume_test"]
EXPOSE 80
CMD echo $MYPATH
CMD echo "----------end--------"
CMD /bin/bash
```

```bash
docker build -f DockerFile -t wlf/centos:1.0.0 
```

