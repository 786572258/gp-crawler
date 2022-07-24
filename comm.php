<?php

function p($d, $json = false) {

   if ($json) {
      echo json_encode($d, JSON_UNESCAPED_UNICODE);
   } else {
      echo "<pre>";
      print_r($d);
   }
}

function pj($d)
{
   echo json_encode($d, JSON_UNESCAPED_UNICODE);
}

//此类包含数据库和业务方法
require_once  "pdo.php";


$db = new MysqlPdo('mysql:host=localhost;dbname=gp', 'root','root');
//$db = new MysqlPdo('mysql:host=sql110.byethost22.com;dbname=b22_18745412_gp', 'b22_18745412','3324011');
class Comm {
   public static function getDB() {
      global $db;
      return $db;
   }
}
date_default_timezone_set('Asia/Shanghai');

function currdate() {
    return date("Y-m-d H:i:s");   //给变量赋值，调用date函数，格式为 年-月-日 时:分:秒
}



function getLastLandlordSet()
{
   global $db;
   return $db->getOne("SELECT * from landlord_set ORDER BY  id DESC");
}

function writeLandLordSet($data)
{
   global $db;
   $datetime = date("Y-m-d H:i:s", time());
   return $db->exec("INSERT INTO landlord_set (power_rate1, power_rate2, water_rate1, water_rate2, people_num, room_num, property_cost, net_cost, gas_cost, create_at) VALUES('{$data['power_rate1']}', '{$data['power_rate2']}', '{$data['water_rate1']}', '{$data['water_rate2']}', '{$data['people_num']}','{$data['room_num']}','{$data['property_cost']}','{$data['net_cost']}','{$data['gas_cost']}', '$datetime' ) ");
//echo "INSERT INTO landlord_set (power_rate1, power_rate2, water_rate1, water_rate2, people_num, room_num, property_cost, net_cost, gas_cost, create_at) VALUES('{$data['power_rate1']}', '{$data['power_rate2']}', '{$data['water_rate1']}', '{$data['water_rate2']}', '{$data['people_num']}','{$data['room_num']}','{$data['property_cost']}','{$data['net_cost']}','{$data['gas_cost']}', '$datetime' ) ";
}
