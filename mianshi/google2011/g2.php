<?php
/**
 *题目描述

银行取款排队模拟
假设银行有4个柜台，假设某天有200位客户来办理业务，每个客户到达银行的时间和业务处理时间分别用两个数组arrive_time 和 process_time 来描述。
请写程序计算所有客户的平均等待时间，假设每个客户在去到营业部之后先拿号排队，然后在任意一个柜台有空闲的时候，号码数最小的客户上去办理，假设所有的客户拿到号码之后不会因为银行众所周知的慢而失去耐心走掉。
 */
/**
 * key的顺序重要   到达银行的时间
 * 4个队列  排序  先把 到达时间 和 处理时间 组合
 * 到达时间是一个时间点（几时几分）  处理时间是一个时间段（几分钟，几小时）
 * 简化为用 秒 处理 时间戳
 *
 * 看到达时间
 * 
 * 生成四个等待数组
 * 第一个等待数组  第二个 第三个  第四个
 */


function deal($arr,$pro){
	asort($arr);
}




function createArr($n,$start=1460040000,$end=1460126400){
	for($i=0;$i<$n;$i++){
		$rand=mt_rand($start,$end);
		$arr[]=$rand;
	}
	return $arr;
}
$arr=createArr(200);
$pro=createArr(200,100,1000);