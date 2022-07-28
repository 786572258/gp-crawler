<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2022/7/28
 * Time: 10:43 PM
 */

$str = file_get_contents("querytojson.txt");
parse_str($str, $query_arr);
echo json_encode($query_arr);