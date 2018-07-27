<?php
/**
 * Created by PhpStorm.
 * User: jing
 * Date: 2018/7/27
 * Time: 1:38 PM
 */

include ('book_sc_fns.php');
session_start();

do_html_header("checkout");

if(($_SESSION['cart']) && (array_count_values($_SESSION['cart'])))
{
    display_cart($_SESSION['cart'],false,0);
}