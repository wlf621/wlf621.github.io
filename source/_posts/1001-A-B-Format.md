---
title: 1001 A+B Format
date: 2020-01-07 20:18:02
categories:
- PAT
mathjax: true
tag:
- 大数运算
---
Calculate a+b and output the sum in standard format -- that is, the digits must be separated into groups of three by commas (unless there are less than four digits).
>Input Specification:
Each input file contains one test case. Each case contains a pair of integers a and b where $−10^6 ≤ a$, $b ≤ 10^{​6}$. The numbers are separatedby a space.

>Output Specification:
For each test case, you should output the sum of a and b in one line. The sum must be written in the standard format.

### Sample Input:
```bash
-1000000 9
```

### Sample Output:
```bash
-999,991
```
### AC Code
```c++
#include<iostream>

using namespace std;

int main()
{
	int x, y;
	while (cin >> x >> y) {
		int a = x + y;
		bool flag;
		if (a < 0) {
			a = -a;
			flag = false;
		}
		else if (a == 0) {
			cout << a << endl;
			continue;
		}
		else {
			flag = true;
		}
		int b, i = 0,j=1;
		char c[100];
		b = a % 10;
		while (a != 0) {
			c[i++] = b+'0';
			a = a / 10;
			b = a % 10;
			if (j % 3 == 0) {
				c[i++] = ',';
				j = 1;
			}
			else j++;
		}
		i = i - 1;
		if (flag == false) {
			cout << "-";
		}
		if (c[i] == ',')i--;
		for (; i > 0; i--) {
			cout << c[i];
		}
		cout << c[i] << endl;
	}
	return 0;
}
```