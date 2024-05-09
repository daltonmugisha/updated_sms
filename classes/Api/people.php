<?php 
include '../classes/DB.php';


if (isset($_POST['search'])) {
  $search = mysqli_real_escape_string($conn,"%{$_POST['search']}%");  
  $query = "SELECT * FROM users WHERE username LIKE '%$search%' AND allowed='YES' ORDER BY RAND() LIMIT 5 ";
  $result = mysqli_query($conn, $query);
  $found = mysqli_num_rows($result);
  if($found === 0){
   
  }else{
    echo "<p style='margin-left:20px;'>Accounts</p>";
    while($row = mysqli_fetch_assoc($result)){
      $theid = $row['id'];
      $post_title = $row['username'];
      $profileee = $row['profile_pic'];
            

      ?>
    <style>
      .fucis:hover{
        color: blue !important;
      }
    </style>
      <a  style="color: var(--text);  "class="dropdown-item text-bold fucis"  href="userprofile?user=<?php echo $theid; ?>"><img style="height:40px; width:40px; border-radius:100%;background:black;"src="<?php

if($profileee !=""){
  echo "classes/profile/$profileee";
}else{
  echo  "assets/img/profile.png";
}

?>" alt=""> <?php echo $post_title ?> </a>

    <?php }
  

  }
}

 ?>
 <center><a style="font-size:10px; margin-right:3px;" class="text-dark" href="report">report inappropriate prediction</a></center>
