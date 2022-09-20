---
title: 1019 General Palindromic Number
date: 2020-04-21 16:49:12
categories:
- PAT
mathjax: true
tags:
- 回文数
---
### 题意：
回文数：一个整数正向和反向写是一样，比如，1234321；一般我们使用的是十进制，但是回文数可以扩展到任意数字系统即不同进制。
考虑一个整数$N > 0$和基数$b \ge 2$,标准形式可以写作{% raw %}$\sum {_{i = 0}^k \left( {{a_i}{b^i}} \right)}${% endraw %},其中$0 \le a<b$,$a_k \ne 0$;
如果对于所有的$i$,$a_i = a_{k-i}$,则整数$N$在基数$b$上是回文的，0在任何基数上都是回文的。

### 样例输入:
```
27 2
```
### 样例输出:
```
Yes
1 1 0 1 1
```

### AC 代码：
```c++
#include<iostream>

using namespace std;

int main() {
	int N, b, a[100] = { 0 }, i = 0, size;
	cin >> N >> b;
	if (N != 0) {
		while (N != 0) {
			a[i++] = N % b;
			N = N / b;
		}
		size = i;
		bool flag = true;
		for (int j = 0; j <= size / 2; j++)
			if (a[j] != a[size - j - 1])flag = false;
		if (flag)cout << "Yes" << endl;
		else cout << "No" << endl;
		for (int j = size - 1; j > 0; j--)
			cout << a[j] << " ";
		cout << a[0];
	}
	else {
		cout << "Yes" << endl << 0;
	}
	return 0;
}
```