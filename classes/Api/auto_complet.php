<?php 
include 'DB.php';
if (isset($_POST['search'])) {
  
        $search = mysqli_real_escape_string($conn,"%{$_POST['search']}%");  
        $query = "SELECT * FROM item_list WHERE name LIKE '%$search%'  ORDER BY RAND() LIMIT 3 ";
        $result = mysqli_query($conn, $query);
        $found = mysqli_num_rows($result);
        if($found === 0){
    echo " <a style='margin-left:40px;' href=''><i class='bi bi-search text-info '> </i> $_POST[search]</a> ";    
        }else{
          while($row = mysqli_fetch_assoc($result)){
            $post_id = $row['id'];
            $post_title = $row['name'];
            $thum = $row['cost'];        
            ?>
              <style>
      .fudidd:hover{
        color: blue !important;
      }
    </style> 
         <a class="dropdown-item" href="<?php echo '?page=itemview/item&id='.$post_id ?>" data-id="<?php echo $post_id ?>"><span class="fa fa-eye text-dark"></span> <?php echo $post_title  ?> View</a>
      
          <?php }
        
      
        }

        echo "<h6 style='margin-inline:10px' class='text-muted'>SALES RECORDS BY NUMBER.</h6>";

        $search2 = mysqli_real_escape_string($conn,"%{$_POST['search']}%");  
        $query2 = "SELECT * FROM sales_list WHERE sales_code LIKE '%$search2%'  ORDER BY RAND() LIMIT 5 ";
        $result2 = mysqli_query($conn, $query2);
        $found2 = mysqli_num_rows($result2);
        if($found2 === 0){
    echo " <a style='margin-left:40px;' href=''><i class='bi bi-search text-info '> </i> $_POST[search]</a> ";    
        }else{
          while($row = mysqli_fetch_assoc($result2)){
            $post_id2 = $row['id'];
            $post_title2 = $row['sales_code'];
             
            ?>
              <style>
      .fudidd:hover{
        color: blue !important;
      }
    </style> 
         <a   href="<?php echo '?page=sales/view_sale&id='.$post_id2 ?>"> <li class="list-group-item"><i class="bi bi-search text-info "> </i><?php echo $post_title2  ?> </li></a>
      
          <?php }
        
      
        }

        // purchase

        echo "<h6 style='margin-inline:10px' class='text-muted'>PURCHASED RECORDS BY NUMBER.</h6>";

        $search3 = mysqli_real_escape_string($conn,"%{$_POST['search']}%");  
        $query3 = "SELECT * FROM purchase_order_list WHERE po_code LIKE '%$search3%'  ORDER BY RAND() LIMIT 3 ";
        $result3 = mysqli_query($conn, $query3);
        $found3 = mysqli_num_rows($result3);
        if($found3 === 0){
    echo " <a style='margin-left:40px;' href=''><i class='bi bi-search text-info '> </i> $_POST[search]</a> ";    
        }else{
          while($row = mysqli_fetch_assoc($result3)){
            $post_id3 = $row['id'];
            $post_title3 = $row['po_code'];
             
            ?>
              <style>
      .fudidd:hover{
        color: blue !important;
      }
    </style> 
         <a   href="<?php echo '?page=purchase_order/view_po&id='.$post_id3 ?>"> <li class="list-group-item"><i class="bi bi-search text-info "> </i><?php echo $post_title3  ?> </li></a>

          <?php }
        
      
        }
      }
      
       ?>

