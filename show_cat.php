<?php
/**
 * Created by PhpStorm.
 * User: jing
 * Date: 2018/7/25
 * Time: 9:26 PM
 */

include ('book_sc_fns.php');
//shopping cart needs sessions
session_start();

$catid = $_GET['catid'];
$name = get_category_name($catid);

do_html_header($name);

$book_array = get_books($catid);
display_books($book_array);

if(isset($_SESSION['admin_user']))
{
    display_button("index.php","continue","Continue Shopping");
    display_button("admin.php","admin-menu","Admin Menu");
    display_button("edit_category_form.php?catid=".urlencode($catid),"edit-category","Edit Category");
}
else
{
    display_button("index.php","continue-shopping","Continue Shopping");
}

do_html_footer();