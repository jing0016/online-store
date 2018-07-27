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

function display_cart($cart, $change=true, $images =1)
{
   // display items in shopping cart
  // optionally allow changes (true or false)
  // optionally include images (1 - yes, 0 - no)

   echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\">
         <form action=\"show_cart.php\" method=\"post\">
         <tr><th colspan=\"".(1 + $images)."\" bgcolor=\"#cccccc\">Item</th>
         <th bgcolor=\"#cccccc\">Price</th>
         <th bgcolor=\"#cccccc\">Quantity</th>
         <th bgcolor=\"#cccccc\">Total</th>
         </tr>";

  //display each item as a table row
  foreach ($cart as $isbn => $qty)  {
      $book = get_book_details($isbn);
      echo "<tr>";
      if($images == true) {
          echo "<td align=\"left\">";
          if (file_exists("images/{$isbn}.jpg")) {
              $size = GetImageSize("images/{$isbn}.jpg");
              if(($size[0] > 0) && ($size[1] > 0)) {
                  echo "<img src=\"images/".htmlspecialchars($isbn).".jpg\"
                  style=\"border: 1px solid black\"
                  width=\"".($size[0]/3)."\"
                  height=\"".($size[1]/3)."\"/>";
              }
          } else {
              echo "&nbsp;";
          }
          echo "</td>";
      }
      echo "<td align=\"left\">
          <a href=\"show_book.php?isbn=".urlencode($isbn)."\">".htmlspecialchars($book['title'])."</a>
          by ".htmlspecialchars($book['author'])."</td>
          <td align=\"center\">\$".number_format($book['price'], 2)."</td>
          <td align=\"center\">";

      // if we allow changes, quantities are in text boxes
      if ($change == true) {
          echo "<input type=\"text\" name=\"".htmlspecialchars($isbn)."\" value=\"".htmlspecialchars($qty)."\" size=\"3\">";
      } else {
          echo $qty;
      }
      echo "</td><td align=\"center\">\$".number_format($book['price']*$qty,2)."</td></tr>\n";
  }

  // display total row
  echo "<tr>
        <th colspan=\"".(2+$images)."\" bgcolor=\"#cccccc\">&nbsp;</td>
        <th align=\"center\" bgcolor=\"#cccccc\">".htmlspecialchars($_SESSION['items'])."</th>
        <th align=\"center\" bgcolor=\"#cccccc\">
            \$".number_format($_SESSION['total_price'], 2)."
        </th>
        </tr>";

  // display save change button
  //type="hidden",the original purpose was to make a field which will be submitted with form's submit.
    // Sometimes, there were need to store some information in hidden field and submit it with form's submit.
  //name and value fields are required
  if($change == true) {
      echo "<tr>
          <td colspan=\"".(2+$images)."\">&nbsp;</td>
          <td align=\"center\">
             <input type=\"hidden\" name=\"save\" value=\"true\"/>
             <input type=\"image\" src=\"images/save-changes.gif\"
                    border=\"0\" alt=\"Save Changes\"/>
          </td>
          <td>&nbsp;</td>
          </tr>";
  }
  echo "</form></table>";
}