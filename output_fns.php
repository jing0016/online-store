<?php
/**
 * Created by PhpStorm.
 * User: jing
 * Date: 2018/7/25
 * Time: 7:38 PM
 */

function display_categories($cat_array)
{
    if(!is_array($cat_array))
    {
        echo "<p>No categories currently available</p>";
        return;
    }
    echo "<ul>";
    foreach ($cat_array as $row)
    {
        $url = "show_cat.php?catid=".urlencode($row['catid']);
        $title = $row['catname'];
        echo "<li>";
        do_html_url($url,$title);
        echo "</li>";
    }
    echo "</ul>";
    echo "<hr />";
}