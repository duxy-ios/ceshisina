## 网站压力测试工具ab的详细用法

<font face=黑体>

在学习 `ab` 工具之前，我们需要了解几个关于压力测试的概念。

## 吞吐量 

指在一次性能测试过程中网络上传输的数据量的总和。 

对于交互式应用来说，吞吐量指标反映的是服务器承受的压力，在容量规划的测试中，吞吐量是一个重点关注的指标，因为它能够说明系统级别的负载能力，另外，在性能调优过程中，吞吐量指标也有重要的价值。如一个大型工厂，他们的生产效率与生产速度很快，一天生产10W吨货物，结果工厂的运输能力不行，就两辆小型三轮车一天拉2吨的货物，比喻有些夸张，但我想说明的是这个运输能力是整个系统的瓶颈。 

提示，用吞吐量来衡量一个系统的输出能力是极其不准确的。用个最简单的例子说明，一个水龙头开一天一夜，流出10吨水；10个水龙头开1秒钟，流出0.1吨水，当然是一个水龙头的吞吐量大。你能说1个水龙头的出水能力比10个水龙头强？所以，我们要加单位时间，看谁1秒钟的出水量大，这就是吞吐率。

## 吞吐率 

单位时间内网络上传输的数据量，也可以指单位时间内处理客户请求数量。它是衡量网络性能的重要指标，通常情况下，吞吐率用“`字节数/秒`”来衡量，当然，你可以用“`请求数/秒`”和“`页面数/秒`”来衡量。其实，不管是一个请求还是一个页面，它的本质都是在网络上传输的数据，那么来表示数据的单位就是字节数。 

不过以不同的方式表达的吞吐量可以说明不同层次的问题。例如，以`字节数/秒`方式表示的吞吐量主要受网络基础设置、服务器架构、应用服务器制约；以`请求数/秒`方式表示的吞吐量主要受应用服务器和应用代码的制约。 

但是从业务的角度看，吞吐率也可以用“`业务数/小时或天`”、“`访问人数/小时或天`”、“`页面访问量/小时或天`”来衡量。例如，在银行卡审批系统中，可以用“`千件/小时`”来衡量系统的业务处理能力。那么，从用户的角度，一个表单提交可以得到一次审批。又引出来一个概念—事务。

## 事务 

就是用户某一步或几步操作的集合。不过，我们要保证它有一个完整意义。比如用户对某一个页面的一次请求，用户对某系统的一次登录，淘宝用户对商品的一次确认支付过程。这些我们都可以看作一个事务。那么如何衡量服务器对事务的处理能力。又引出一个概念—-`TPS`

## TPS 

每秒钟系统能够处理事务或交易的数量，它是衡量系统处理能力的重要指标。

## 点击率 

点击率可以看做是TPS的一种特定情况。点击率更能体现用户端对服务器的压力。TPS更能体现服务器对客户请求的处理能力。 

每秒钟用户向web服务器提交的HTTP请求数。这个指标是web 应用特有的一个指标；web应用是“请求-响应”模式，用户发一个请求，服务器就要处理一次，所以点击是web应用能够处理的交易的最小单位。如果把每次点击定义为一个交易，点击率和TPS就是一个概念。容易看出，点击率越大。对服务器的压力也越大，点击率只是一个性能参考指标，重要的是分析点击时产生的影响。 

需要注意的是，这里的点击不是指鼠标的一次“单击”操作，因为一次“单击”操作中，客户端可能向服务器发现多个HTTP请求。

## 并发连接数 

某个时刻服务器所接受的请求数目，简单的讲，就是一个会话。

## 并发用户数 

要注意区分这个概念和并发连接数之间的区别，一个用户可能同时会产生多个会话，也即连接数。

## 用户平均请求等待时间 

`处理完成所有请求数所花费的时间 / （总请求数 / 并发用户数）`，即 

`Time per request = Time taken for tests /（ Complete requests / Concurrency Level）`

## 服务器平均请求等待时间 

计算公式：`处理完成所有请求数所花费的时间 / 总请求数`，即 

`Time taken for / testsComplete requests` 

可以看到，它是吞吐率的倒数。 

同时，它也=`用户平均请求等待时间/并发用户数`，即 

`Time per request / Concurrency Level`

## 概念介绍 

ab是Apache超文本传输协议(HTTP)的性能测试工具。其设计意图是描绘当前所安装的Apache的执行性能，主要是显示你安装的Apache每秒可以处理多少个请求。

下载和安装，这里不再介绍，因为默认情况下，安装好 apache，里面就会自带这个工具。

## 使用方法 

    ab [options] [http[s]://]hostname[:port]/path

运行 ab –help 可以得到帮助和查看参数。这里对常用参数，进行相关说明，如下：
```
    -n 在测试会话中所执行的请求个数，默认时，仅执行一个请求。 
    -c 一次产生的请求个数，默认是一次一个。 
    -t 测试所进行的最大秒数，默认时，没有时间限制。 
    -p 包含了需要POST的数据的文件，文件格式如“p1=1&p2=2”. 使用方法是 -p 111.txt 
    -T POST数据所使用的Content-type头信息 
    -C 设置请求时带上 Cookie 
    -H 设置请求头
```
## 实例 

比如：我们要对 www.baidu.com 进行测试，共请求 100 次，每次模拟10个并发数，我们可以输入以下命令：
```
    ab -n 100 -c 10 http://www.baidu.com/
```
运行后，得到的结果如图：

![123.jpg][0]

这里对每一段做一下细分讲解：

1）这段展示的是web服务器的信息，可以看到服务器采用的是BWS，域名是www.baidu.com，端口是80

2）这段是关于请求的文档的相关信息，所在位置“/”，文档的大小为`102257 bytes`（此为http响应的正文长度）

3）这段展示了压力测试的几个重要指标

```
Concurrency Level:      10  # 并发请求数
Time taken for tests:   16.117 seconds   # 整个测试持续的时间
Complete requests:      100 # 完成的请求数
Failed requests:        98  # 失败的请求数
   (Connect: 0, Receive: 0, Length: 98, Exceptions: 0)
Write errors:           0  # 写入错误
Total transferred:      10324609 bytes # 整个场景中的网络传输量
HTML transferred:       10228678 bytes # 整个场景中的HTML内容传输量

# 吞吐率，大家最关心的指标之一，相当于 LR 中的每秒事务数，后面括号中的 mean 表示这是一个平均值
Requests per second:    6.20 [#/sec] (mean) 

#用户平均请求等待时间，大家最关心的指标之二，相当于 LR 中的平均事务响应时间，后面括号中的 mean 表示这是一个平均值
Time per request:       1611.698 [ms] (mean)

# 服务器平均请求处理时间，大家最关心的指标之三
Time per request:       161.170 [ms] (mean, across all concurrent requests)

# 平均每秒网络上的流量，可以帮助排除是否存在网络流量过大导致响应时间延长的问题
Transfer rate:          625.59 [Kbytes/sec] received
```

5）这段表示网络上消耗的时间的分解

6）这段是每个请求处理时间的分布情况，50%的处理时间在1592ms内，66%的处理时间在1634ms内…，重要的是看90%的处理时间

</font>

[0]: ./img/1482760839745246.jpg