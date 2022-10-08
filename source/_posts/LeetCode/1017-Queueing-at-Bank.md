---
title: 1017 Queueing at Bank
date: 2020-01-09 19:12:44
categories:
- PAT
mathjax: true
tag:
- 模拟
---
Suppose a bank has K windows open for service. There is a yellow line in front of the windows which devides the waiting area into two parts. All the customers have to wait in line behind the yellow line, until it is his/her turn to be served and there is a window available. It is assumed that no window can be occupied by a single customer for more than 1 hour.

Now given the arriving time T and the processing time P of each customer, you are supposed to tell the average waiting time of all the customers.

>Input Specification:
Each input file contains one test case. For each case, the first line contains 2 numbers: $N \ (\le 10^4​​ )$ - the total number of customers, and $K \ (\le 100)$ - the number of windows. Then N lines follow, each contains 2 times: HH:MM:SS - the arriving time, and P - the processing time in minutes of a customer. Here HH is in the range [00, 23], MM and SS are both in [00, 59]. It is assumed that no two customers arrives at the same time. Notice that the bank opens from 08:00 to 17:00. Anyone arrives early will have to wait in line till 08:00, and anyone comes too late (at or after 17:00:01) will not be served nor counted into the average.

>Output Specification:
For each test case, print in one line the average waiting time of all the customers, in minutes and accurate up to 1 decimal place.

### Sample Input:
```
7 3
07:55:00 16
17:00:01 2
07:59:59 15
08:01:00 60
08:00:00 30
08:00:02 2
08:03:00 10
```
### Sample Output:
```
8.2
```

### AC Code
```c++
#include<iostream>
#include <sstream>
#include <algorithm>
#include <iomanip>

using namespace std;

struct Node {
	int arrive[3], process = 0;
};

bool comp(Node a, Node b) {
	if (a.arrive[0] < b.arrive[0])return true;
	else if (a.arrive[0] == b.arrive[0]) {
		if (a.arrive[1] < b.arrive[1])return true;
		else if (a.arrive[1] == b.arrive[1]) {
			if (a.arrive[2] <= b.arrive[2])return true;
			else return false;
		}
		else return false;
	}
	else return false;
}

int main(){
	int N, K; double avg_wait = 0, cnt = 0;
	Node *user,early,last,*W;
	early.arrive[0] = 8;
	early.arrive[1] = 0;
	early.arrive[2] = 0;
	last.arrive[0] = 17;
	early.arrive[1] = 0;
	early.arrive[2] = 0;
	cin >> N >> K;
	user = new Node[N];
	W = new Node[K];
	for (int i = 0; i < K; i++) {
		W[i].arrive[0] = 8;
		W[i].arrive[1] = 0;
		W[i].arrive[2] = 0;
	}
	for (int i = 0; i < N; i++) {
		string arr;
		int tmp = 0;
		cin >> arr;
		cin >> user[i].process;
		if (user[i].process>60)
		{
			user[i].process = 60;
		}
		stringstream ss(arr);
		while (getline(ss, arr, ':')) {
			user[i].arrive[tmp] = atoi(arr.c_str());
			tmp++;
		}
	}
	sort(user, user + N, comp);
	for (int i = 0; i < N; i++) {
		if (comp(user[i], early)) {
			avg_wait += -((user[i].arrive[0] - 8) * 60 * 60 + (user[i].arrive[1] - 0) * 60 + user[i].arrive[2] - 0);
			user[i].arrive[0] = 8;
			user[i].arrive[1] = 0;
			user[i].arrive[2] = 0;
		}
		else break;
	}
	for (int i = 0; i < N; i++) {
		if (comp(user[i],last)) {
			cnt++;
			bool flag = false;
			for (int j = 0; j < K; j++) {
				if (comp(W[j], user[i])) {
					W[j].arrive[0] = user[i].arrive[0]+ (user[i].arrive[1] + user[i].process) /60;
					W[j].arrive[1] = (user[i].arrive[1]+user[i].process)%60;
					W[j].arrive[2] = user[i].arrive[2];
					flag = true;
					break;
				}
			}
			if (!flag) {
				double min,tmp;
				int index;
				min = (W[0].arrive[0] - user[i].arrive[0]) * 60 * 60 + (W[0].arrive[1] - user[i].arrive[1]) * 60 + (W[0].arrive[2] - user[i].arrive[2]);
				index = 0;
				for (int j = 1; j < K; j++) {
					tmp = (W[j].arrive[0] - user[i].arrive[0]) * 60 * 60 + (W[j].arrive[1] - user[i].arrive[1]) * 60 + (W[j].arrive[2] - user[i].arrive[2]);
					if (tmp < min) {
						min = tmp;
						index = j;
					}
				}
				W[index].arrive[0] = W[index].arrive[0]+ (W[index].arrive[1] + user[i].process)/60;
				W[index].arrive[1] =  (W[index].arrive[1] + user[i].process) % 60;
				avg_wait += min;
			}
		}
		else break;
	}
	cout << fixed << setprecision(1) << avg_wait/(60*cnt) << endl;
	return 0;
}
```