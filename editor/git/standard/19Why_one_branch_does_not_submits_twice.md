## `发生过程`

  一个分支合并到两个hotfix分支

## 发生描述：
* 假设一个功能分支完成之后merge到当天的hotfix1分支上；
* 但回到主干之后，运营测试仍有问题；
* 于是在此分支上再做修改，并merge到hotfix2分支；


## `危害`

## 1.危害范围

* (1)日常开发

* (2)上线时间

* (3)线上出现问题后的排查范围


## 2.危害认识

  * (1) 影响其他同事的日常开发

 * 1、一次分支合并到两个hotfix，致使分支需要重新创建；

 * 2、因为此分支而影响的其他同事的分支，需要再次提交；

 * 3、负责上线的同事需要重新从影响之前的结点创建新分支。



  * (2)影响同事及自己的上线时间

 * 1、分支重新提交，致使责任人需要重新从master上新建分支，并重新提交合并申请；

* 2、功能代码也需要重新整理。

* 3、因代码整理和分支新建对上线时间的影响。


  *  (3)影响上线之后系统的稳定性及可维护性

 * 1、因为一次分支合并到两分支，在分支日志图形上错乱；

* 2、因为分支的生命周期人为的延长，增加了图形阅读的时间成本。

* 3、而阅读的成本，进而影响系统的上线时间及维护成本。 


## `解决方案`

## 操作：


  * 1、力争代码上线前做好单元测试、自测、测试同事测试等环节。

  * 2、将问题解决在这个分支merge主干前，这样像该文所提到的情景即可避免。

  * 3、即使仍然出现，也可以通过git的比较工具，比较一下自己更新的代码。

  * 4、然后更新的代码复制到从master上新建的分支上，保证所取代码是稳定而安全的。

  * 5、最后将完成的代码分支再次经过测试环节，并合并当天发布分支，回归主干。


`特别提示：`

* 1、一个分支功能开发完成之后需同时删除`远端分支`和`本地分支`；

* 2、执行如下命令：

>$  git push origin :分支名称（`删除远端`）

>$  git branch - D 分支名称（`删除本地，-d：会有提示，-D：强制删除`）

3、这样可以有效避免因个人原因重复提交分支的情形发生。


## `使用原则`    


   * 保证一个分支只做一件事的原则。

   * 如果要做多件事，要开多个分支。

   * 尽量避免多个人在一个分支上做事。

   分支的下游只能是release。

   `有问题及时查看文档,或者询问他人的帮助。`


## 相关资料链接：


`GIT操作手册`http://dev45.gitlab.miyabaobei.com/git/demo/wikis/home#%E4%BB%A3%E7%A0%81%E8%A7%84%E8%8C%83
`git详细介绍及教程`http://www.liaoxuefeng.com/wiki/0013739516305929606dd18361248578c67b8067c8c017b000/00137402760310626208b4f695940a49e5348b689d095fc000


