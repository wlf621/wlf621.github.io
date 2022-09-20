---
title: 1002 A+B for Polynomials
date: 2020-01-08 18:58:54
categories:
- PAT
mathjax: true
tag:
- 大数运算
---
This time, you are supposed to find A+B where A and B are two polynomials.

>Input Specification:
Each input file contains one test case. Each case occupies 2 lines, and each line contains the information of a polynomial:
${K \ N_{1 aN_{1}} \ N_{1 aN_{1}} \ N_{1 aN_{1}}}$
where *K* is the number of nonzero terms in the polynomial, $N_{i}$​​ and $aN_{i}(i=1,2,...,K)$ are the exponents and coefficients, respectively. It is given that $1 \le K \le 10，0 \le N_{K}​​ <...<N_{2} < N_{1}​​ \le 1000$.

>Output Specification:
For each test case you should output the sum of *A* and *B* in one line, with the same format as the input. Notice that there must be NO extra space at the end of each line. Please be accurate to 1 decimal place.

### Sample Input:
```
2 1 2.4 0 3.2
2 2 1.5 1 0.5
```
    
### Sample Output:
```
3 2 1.5 1 2.9 0 3.2
```

### AC Code
```c++
#include<iostream>
#include<algorithm>
#include<iomanip>

using namespace std;

typedef struct Node {
	int n;
	double a;
};

int main() {
	int K1, K2;
	Node *a1, *a2, *a3;
	while (cin >> K1) {
		a1 = new Node[K1];
		for (int i = 0; i < K1; i++) {
			cin >> a1[i].n >> a1[i].a;
		}
		cin >> K2;
		a2 = new Node[K2];
		for (int i = 0; i < K2; i++) {
			cin >> a2[i].n >> a2[i].a;
		}
		sort(a1, a1+K1, [](Node a, Node b) {return a.n > b.n; });
		sort(a2, a2+K2, [](Node a, Node b) {return a.n > b.n; });
		a3 = new Node[K1 + K2];
		int i=0,j = 0,k=0;
		while (i < K1 && j < K2) {
			if (a1[i].n == a2[j].n) {
				a3[k].n = a1[i].n;
				a3[k].a = a1[i].a + a2[j].a;
				i++; j++;
				if (a3[k].a == 0);
				else k++;
			}
			else if (a1[i].n > a2[j].n) {
				a3[k].n = a1[i].n;
				a3[k].a = a1[i].a;
				k++; i++;
			}
			else {
				a3[k].n = a2[j].n;
				a3[k].a = a2[j].a;
				k++; j++;
			}
		}
		while (i < K1)
		{
			a3[k].n = a1[i].n;
			a3[k].a = a1[i].a;
			k++; i++;
		}
		while (j < K2)
		{
			a3[k].n = a2[j].n;
			a3[k].a = a2[j].a;
			k++; j++;
		}
		if (k != 0) {
			cout << k << " ";
			i = 0;
			for (; i < k - 1; i++)
				cout << a3[i].n << " " << std::fixed << setprecision(1) << a3[i].a << " ";
			cout << a3[i].n << " " << std::fixed << setprecision(1) << a3[i].a << endl;
		}
		else cout << std::fixed << setprecision(1) << 0<< endl;
	}
	return 0;
}
```