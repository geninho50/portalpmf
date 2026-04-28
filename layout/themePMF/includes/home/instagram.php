<div class="social-instagram hidden-sm hidden-xs">
  <h2>Instagram</h2>
  <div class="instagram-wrapper">
    <?php
      // Default images
      // "width":640
      //"height":559
       $query = "SELECT image_url, link FROM instagram LIMIT 5;";
       $result = $drive->pedido($query);
       $count = 0;
       while($obj = pg_fetch_object($result)){
         if($count == 0) {
           echo "<div class=\"instagram-image-highlight\">";
           echo "<div style=\"background-image: url('". ($obj->image_url) ."') \" class=\"instagram-image-wrapper\"> <a target=\"_blank\" href=\"". $obj->link ."\"></a>";
           echo "</div></div><div class=\"instagram-image-grid\">";
         } else {
           echo "<div style=\"background-image: url('". ($obj->image_url) ."') \" class=\"instagram-image-wrapper\"><a target=\"_blank\" href=\"". $obj->link ."\"></a></div>";
         }
         $count++;
       }
       echo "</div>";
   ?>
  </div>
</div>
