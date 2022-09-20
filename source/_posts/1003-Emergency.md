---
title: 1003 Emergency
date: 2020-01-08 19:18:23
categories:
- PAT
mathjax: true
tag:
- 最短路径
---
As an emergency rescue team leader of a city, you are given a special map of your country. The map shows several scattered cities connected by some roads. Amount of rescue teams in each city and the length of each road between any pair of cities are marked on the map. When there is an emergency call to you from some other city, your job is to lead your men to the place as quickly as possible, and at the mean time, call up as many hands on the way as possible.

>Input Specification:
Each input file contains one test case. For each test case, the first line contains 4 positive integers: $N (\le 500)$ - the number of cities (and the cities are numbered from 0 to *N−1*), *M* - the number of roads, $C_{1}​$​​ and $C_{2}$​​​ - the cities that you are currently in and that you must save, respectively. The next line contains *N* integers, where the *i*-th integer is the number of rescue teams in the *i*-th city. Then *M* lines follow, each describes a road with three integers $c_{1}, c_{2}$ and *L*, which are the pair of cities connected by a road and the length of that road, respectively. It is guaranteed that there exists at least one path from $C_{2}$ to $C_{2}$​.
>Output Specification:
For each test case, print in one line two numbers: the number of different shortest paths between $C_{1}, C_{2}$, and the maximum amount of rescue teams you can possibly gather. All the numbers in a line must be separated by exactly one space, and there is no extra space allowed at the end of a line.

### Sample Input:
```
5 6 0 2
1 2 1 5 3
0 1 1
0 2 2
0 3 1
1 2 1
2 4 1
3 4 1
```
 
### Sample Output:
```
2 4
```

### AC Code
```c++
#include<iostream>
#include<algorithm>

using namespace std;

void dij(int **matrix,int *dis,int *cnt,int *num, int *cap, int s, int N) {//N:节点数，s:起点,cnt：记录路径数；
	int **e,*m, min, u;
	e = new int*[N];
	for (int i = 0; i < N; i++)e[i] = new int[N];
	m = new int[N];
	for (int k = 0; k < N; k++)
		for (int l = 0; l < N; l++) {
			if (matrix[k][l] == -1)e[k][l] = 0x3f3f3f3f;
			else e[k][l] = matrix[k][l];
		}
	for (int k = 0; k < N; k++) {
		dis[k] = 0x3f3f3f3f;
		m[k] = 0;
	}
	cnt[s] = 1; dis[s] = 0; num[s] = cap[s];
	for (int i = 1; i < N; i++) {
		min = 0x3f3f3f3f;
		u = -1;
		for (int s = 0; s < N; s++) {
			if (m[s] == 0 && dis[s] < min) {
				min = dis[s];
				u = s;
			}
		}
		if (u == -1) {
			continue;
		}
		else {
			m[u] = 1;
		}
		for (int k = 0; k < N; k++) {
			if (e[u][k] < 0x3f3f3f3f) {
				if (u == k)continue;
				else if (dis[k] > (dis[u] + e[u][k])) {
					dis[k] = dis[u] + e[u][k];
					num[k] = num[u] + cap[k];
					cnt[k] = cnt[u];
				}
				else if (dis[k] == (dis[u] + e[u][k])) {
					cnt[k] += cnt[u];
					num[k] = max(num[k],num[u]+ cap[k]);
				}
			}
		}
	}
}

int main() {
	int  s, t, *cnt,N,M,*num,*cap, **matrix,*dis;
	while (cin >> N >> M >> s >> t) {
		cap = new int[N];
		cnt = new int[N];
		num = new int[N];
		dis = new int[N];
		matrix = new int*[N];
		for (int i = 0; i < N; i++) {
			cin >> cap[i];
			matrix[i] = new int[N];
			cnt[i] = 0;
			num[i] = 0;
		}
		for (int i = 0; i < N; i++)
			for (int j = i; j < N; j++) {
				if (i == j)matrix[i][j] = matrix[j][i] = 0;
				else matrix[i][j] = matrix[j][i] = -1;
			}
		for (int i = 0; i < M; i++) {
			int t1, t2,t3;
			cin >> t1 >> t2 >> t3;
			matrix[t1][t2] = matrix[t2][t1] = t3;
		}
		dij(matrix, dis, cnt, num, cap, s, N);
		cout << cnt[t] << " " << num[t] << endl;
	}
	return 0;
}
```