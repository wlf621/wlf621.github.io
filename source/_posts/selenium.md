---
title: selenium
date: 2022-09-24 20:52:33
categories:
- selenium
tags:
- spider
---

### css_selector

| 属性                 | 用来表示的符号                                        |
| -------------------- | ----------------------------------------------------- |
| id                   | #                                                     |
| class                | **.**                                                 |
| 所有属性             | [] 例：[id = '“1”]、[class = '“flo_rev”]、[value=“1”] |
| 标签名前没有任何符号 | 标签名可以在css_selector中使用                        |
| >                    | 表示父元素和子元素之间的关系                          |
| 空格                 | 表示祖先元素和子孙元素的关系                          |

p:nth-child(1)             # 选择第一个p标签，还可写为 p:first-child 

p:nth-last-child(1)             # 选择倒数第一个p标签（要保证最后一个标签是p） 

p:only-child        #唯一的p标签



- [ ]  [处理点选验证码 手把手教你用selenium模拟登录B站 - 腾讯云开发者社区-腾讯云 (tencent.com)](https://cloud.tencent.com/developer/article/1770228)
