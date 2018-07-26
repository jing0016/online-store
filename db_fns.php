<?php
/**
 * Created by PhpStorm.
 * User: jing
 * Date: 2018/7/25
 * Time: 7:43 PM
 */

function db_result_to_array($result)
{
    $res_array = array();

    for($count=0;$row = $result->fetch_assoc();$count++)
    {
        $res_array[$count] = $row;
    }
    return $res_array;
}