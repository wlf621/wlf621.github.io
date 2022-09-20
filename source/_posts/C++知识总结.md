---
title: C++知识总结
date: 2022-09-17 16:18:02
categories:
- C++
mathjax: true
tag:
- C++

---

### 类

##### 前向引用

> 在提供一个完整的类声明之前，不能声明该类的对象，也不能在内联成员函数中使用该类的对象。

```c++
class Fred;	//前向引用声明
class Barney {
   Fred x;	//错误
};
```

```c++
class Fred;	//前向引用声明
class Barney {
 public:
   void method()
   {
     x->yabbaDabbaDo();	//错误：Fred类的对象在定义之前被使用
   }
 private:
   Fred* x;   //正确
 };

```

##### 静态成员函数

> 可以使用类名和作用域操作符（对象. 或 对象指针->）来调用静态成员函数，静态成员函数只能引用属于该类的静态数据成员或静态成员函数。

##### 静态数据成员

> 用关键字static声明，该类的所有对象维护该成员的同一个拷贝，必须在**类外定义和初始化（类内声明）**，用(::)来指明所属的类。

```c++
class A	
{
public:
	static int a;
};

//必须在类外定义和初始化，用(::)来指明所属的类。
int A::a=0; 
```

##### const用法

> 常类型的对象必须进行初始化，而且不能被更新。

- 常引用：被引用的对象不能被更新。const  类型说明符  &引用名

- 常对象：必须进行初始化,不能被更新。类名  const  对象名

- 常数组：数组元素不能被更新。类型说明符  const  数组名[大小]...

通过常对象只能调用它的常成员函数

```c++
class R
{    public:
         void print();
};
void R::print()
{     
    cout<<"普通调用"<<endl;
    cout<<R1<<":"<<R2<<endl;
}
int main()
{   
    R a(5,4);
    a.print();  //调用void print()
    //通过常对象只能调用它的常成员函数
    const R b(20,52);  
    b.print();  //错误
    system("pause");
    return 0;
}
```

