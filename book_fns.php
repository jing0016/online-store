<?php
/**
 * Created by PhpStorm.
 * User: jing
 * Date: 2018/7/25
 * Time: 5:53 PM
 */

function get_categories()
{
    $conn = db_connect();
    $query = "select catid,catname from categories";
    $result = @$conn->query($query);

    if(!$result)
    {
        return false;
    }

    $num_cats = @$result->num_rows;
    if($num_cats == 0)
    {
        return false;
    }

    $result = db_result_to_array($result);
    return $result;

}

function get_category_name($catid)
{
    $conn = db_connect();
    $query = "select catname from categories where catid='".$conn->real_escape_string($catid)."'";
    $result = @$conn->query($query);

    if(!$result)
    {
        return false;
    }

    $num_cats = @$result->num_rows;
    if($num_cats == 0)
    {
        return false;
    }

    $row = $result->fetch_object();
    return $row->catname;
}

function calculate_price($cart)
{
    //sum total price for all items in shopping cart
    $price = 0.0;
    if(is_array($cart))
    {
        $conn = db_connect();
        foreach ($cart as $isbn => $qty)
        {
            $query = "select price from books where isbn='" .$conn->real_escape_string($isbn) . "'";
            $result = $conn->query($query);
            if($result)
            {
                $item = $result->fetch_object();
                $item_price = $item->price;
                $price +=$item_price * $qty;
            }
        }
    }
    return $price;
}

function calculate_items($cart)
{
    //sum total items in shopping cart
    $items = 0;
    if(is_array($cart))   {
        foreach($cart as $isbn => $qty) {
            $items += $qty;
        }
    }
    return $items;
}