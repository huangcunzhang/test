<?php
ini_set("display_errors", "On"); 
error_reporting(E_ALL | E_STRICT);
$db = array(
    'host' => '127.0.0.1',         //设置服务器地址
    'port' => '3306',              //设端口 
    'dbname' => 'test',             //设置数据库名      
    'username' => 'test1',           //设置账号
    'password' => 'test0120',      //设置密码
    'charset' => 'utf8',             //设置编码格式
    'dsn' => 'mysql:host=127.0.0.1;dbname=test;port=3306;charset=utf8',   //这里不知道为什么，也需要这样再写一遍。
);
 
//连接
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //默认是PDO::ERRMODE_SILENT, 0, (忽略错误模式)
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // 默认是PDO::FETCH_BOTH, 4
);
 
try{
    $pdo = new PDO($db['dsn'], $db['username'], $db['password'], $options);
}catch(PDOException $e){
    die('数据库连接失败:' . $e->getMessage());
}
 
//或者更通用的设置属性方式:
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    //设置异常处理方式
//$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);   //设置默认关联索引遍历
 
echo '<pre/>';
 
//1 查询
 
//1)使用query
$stmt = $pdo->query('select * from user limit 2'); //返回一个PDOStatement对象
 
//$row = $stmt->fetch(); //从结果集中获取下一行，用于while循环
$rows = $stmt->fetchAll(); //获取所有
 
$row_count = $stmt->rowCount(); //记录数，2
print_r($rows);
 
 
 
 
 
 
 
echo '<br>';
 
//2)使用prepare 推荐!
$stmt = $pdo->prepare("select * from user where name = ? and age = ? ");
$stmt->bindValue(1,'allen');
$stmt->bindValue(2,20);
$stmt->execute();  //执行一条预处理语句 .成功时返回 TRUE, 失败时返回 FALSE 
$rows = $stmt->fetchAll();
$row_count = $stmt->rowCount(); //记录数，2
print_r($rows);
print_r($row_count);
