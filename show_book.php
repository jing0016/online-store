<?php
/**
 * Created by PhpStorm.
 * User: jing
 * Date: 2018/7/25
 * Time: 10:00 PM
 */

include ('book_sc_fns.php');
session_start();

$isbn = $_GET['isbn'];

$book = get_book_details($isbn);
do_html_header($book['title']);
display_book_details($book);

//set url for "continue button"
$target = "index.php";
if($book['catid'])
{
    $target = "show_cat.php?catid=" . urlencode($book['catid']);
}

//if logged in as admin, show edit book links
if(check_admin_user())
{
    display_button("edit_book_form.php?isbn=" . urlencode($isbn), "edit-item","Edit Item");
    display_button("admin.php","admin-menu","Admin Menu");
    display_button($target,"continue","Continue");
}
else
{
    display_button("show_cart.php?new=" . urlencode($isbn),"add-to-cart",
                    "Add".htmlspecialchars($book['title'])."To My Shopping Cart");
    display_button($target,"continue-shopping","Continue Shopping");
}

do_html_footer();