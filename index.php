<?php
/**
 * Created by PhpStorm.
 * User: jing
 * Date: 2018/7/25
 * Time: 5:18 PM
 */
include_once 'book_sc_fns.php';
session_start();

do_html_header("Welcome to online store");

echo "<p>Please choose a category:</p>";

$cat_array = get_categories();

display_categories($cat_array);

if(isset($_SESSION['admin_user']))
{
    display_button("admin.php","admin-menu","Admin Menu");
}

do_html_footer();