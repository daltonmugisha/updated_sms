<style>
  .user-img {
    position: absolute;
    height: 27px;
    width: 27px;
    object-fit: cover;
    left: -7%;
    top: -12%;
  }

  .btn-rounded {
    border-radius: 50px;
  }
</style>
<!-- Navbar -->
<nav
  class="main-header navbar navbar-expand navbar-dark border border-light border-top-0  border-left-0 border-right-0 navbar-light text-sm ">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-dark" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li style="display: flex;" class="nav-item  ">
    <span style="font-size:20px;color:gray;font-weight:bold;padding-top:-20px !important;">STOKIFY</span>  
      <a href="<?php echo base_url ?>"
        class="nav-link text-dark"><?php echo (!isMobileDevice()) ? $_settings->info('name') : $_settings->info('short_name'); ?> -
        Admin</a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item d-flex">
      <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
            </a> -->
      <div class="d-flex navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
          <div class="search_groupe" id="search_groupe">

<form action="search"  class="bd-search">



<input type="search" class="form-control" value="<?php 
if(isset($_SESSION['BACKAGAINvivi'])){
echo $_SESSION['BACKAGAINvivi'];
}
else{
echo "";
}

?>" name="results" id="input" placeholder="Search..." autocomplete="off" placeholder="Example input placeholder">

</form>
 
</div>
        <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <!-- <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                    </button> -->
            </div>
          </div>
        </form>
      </div>
    </li>
    <li style="position: relative;" class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" onclick="location.href='?page=h/help'" data-slide="true" href="?page=Notification/Notification" role="button">
        <i style="font-size:25px; " class="fas fa-question-circle text-dark"></i>
      <p style="background:red;display:inline-block;border-radius:100px;font-size:10;padding-inline:7px;position:absolute;top:2px;right:10px;color:white;height:15px;width:12px"></p>

      </a>
    </li>
    <!-- Messages Dropdown Menu -->
    <li class="nav-item">

      <div class="btn-group nav-link">
        <button type="button" class="btn btn-rounded badge  text-dark dropdown-toggle dropdown-icon"
          data-toggle="dropdown">
          <span><img src="<?php echo validate_image($_settings->userdata('avatar')) ?>"
              class="img-circle elevation-2 user-img" alt="User Image"></span>
          <span
            class="ml-3"><?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname')) ?></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>

        <div class="dropdown-menu theUSERbutton" role="menu">

          <div class='d-flex'>
            <img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle Drop-image"
              alt="User Image">
            <div>
              <span style="font-weight: bold;font-size:18px;"
                class="ml-3 fw-bold fs-3"><?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname')) ?>
              </span>
              <p style="margin-block:0;padding-block:0" class='ml-3'><?php echo   $_settings->info('short_name'); ?></p>
              <p style="padding-top: -15px !important; color:green;" class='ml-3 p-0'>Users:  <?php
                            echo $conn->query("SELECT * FROM `users` where id != 1 ")->num_rows;
                            ?></p>
            </div>

          </div>
          <a style="padding-block:0 !important;margin:0; " class="dropdown-item" href="<?php echo base_url . 'admin/?page=user' ?>"><span class="fas fa-address-card	"></span> My
            Account</a>
          <div  class="dropdown-divider"></div>

          <!-- <a style="padding-block:0 !important;margin-block:0;" class="dropdown-item" href="<?php echo base_url . 'admin/?page=user' ?>"><span class="	fas fa-align-left"></span>
            My Design</a> -->
          <div class="dropdown-divider"></div>

          <a style="padding-block:0;margin:0; "  class="dropdown-item" href="<?php echo base_url . 'admin/?page=system_info' ?>"><i class="fas fa-cog "></i>
            System setting</a>
          <div class="dropdown-divider"></div>
          <a style="padding-block:0;margin:0; "  class="dropdown-item" href="<?php echo base_url . 'admin/?page=unit/unit' ?>">
          Units List</a>
          <div class="dropdown-divider"></div>

          <a style="padding-block:0;margin:0; "  class="dropdown-item" href="<?php echo base_url . 'admin/?page=h/help' ?>"><span class="fa fa-newspaper-o	"></span>
            Need help ?</a>


          <div class="dropdown-divider"></div>
          <p class="Product fw-bold text-muted">A product of Switchiify Inc, 2024</p>
          <a style="padding-block:0;margin:0; "  class="dropdown-item" href="<?php echo base_url . '/classes/Login.php?f=logout' ?>"><span
              class="fas fa-sign-out-alt"></span> Logout</a>
        </div>
      </div>
    </li>
    <li class="nav-item">

    </li>

  </ul>
</nav>

<div style="" class="newsearch" id="newsearch" >
      <h5 class="p-2">Search item, orders etc</h5>
   
 
    <ul class="list-group moresss" id="dropdown">
  
</ul>
 
   <style>
/* width */
::-webkit-scrollbar {
  width: 10px;

  height: 10px;
}

/* Track */
::-webkit-scrollbar-track {

  border-radius: 5px;

}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: var(--scrollo); 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: var(--scrollhover);
}
</style>
<!-- <ul class="morest">
  <li><a href="">wewe</a></li>
  <li>Preveusie</li>
  <li>Preveusie</li>
  <li>Preveusie</li>
  <li>Preveusie</li> <li>Preveusie</li>
  <li>Preveusie</li>
  <li>Preveusie</li>
  <li>Preveusie</li>
  <li>Preveusie</li>
  <li>Preveusie</li>
</ul> -->

   
  </div>
<!-- /.navbar -->

<script>
      $(document).ready(function(){

        
        $(document).mouseup(function(e) 
{
    var container = $("#newsearch");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
});  
          function fetchData(){
            var s = $("#input").val();
            

            if (s == '') {
               $('#dropdown').css('display', 'none');
             
            }
            $.post("http://localhost:8080/sms/classes/Api/auto_complet.php", 
                  {
                    search:s
                  },
             
                  function(data, status){
                   
                      if (data != "not found") {
                        $('#dropdown').css('display', 'block');
                        $('#newsearch').css('display', 'block');
                        $('#dropdown').html(data);
                

                       
                      }else{
                       
    
                      }
                  });
          }
          $('#input').on('input', fetchData);
         
          $("jj").on('click', () => {
            $('#dropdown').css('display', 'none');
          });
          $('#input').on('click', fetchData);


          $('#searchbutton').on('click', function () {

            
          
       
            function myFunction(x) {
            if(x.matches){ 
             
              $('.search_groupe').css('display', 'block');
             $('#searchbutton').css('display', 'none');
              $('#input').focus();
            }else{
            $('.search_groupe').css('display', 'block');
             $('.back').css('display', 'none');
             $('.logoo').css('display', 'block');
             $('.navlogin').css('display', 'block');
             $('.menu').css('display', 'none');
             $('#searchbutton').css('display', 'none');
            }
          }
            var x = window.matchMedia("(max-width:991px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes
           
           
           
          })
          $('.back').on('click', function () {
            $('#newsearch').css('display', 'none');
            function myFunction(x) {
  if (x.matches) { // If media query matches
      $('.search_groupe').css('display', 'none');
      $('.menu').css('display', 'block');
      $('.back').css('display', 'none');
             $('.logoo').css('display', 'block');
             $('.navlogin').css('display', 'block');
            
             $('#searchbutton').css('display', 'block');
  } else {
    $('.search_groupe').css('display', 'block');
    $('.menu').css('display', 'none');  $('.back').css('display', 'none');
             $('.logoo').css('display', 'block');
             $('.navlogin').css('display', 'block');
            
             $('#searchbutton').css('display', 'block');
  }
}

var x = window.matchMedia("(max-width:991px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes
           
           
           
          })
      });
</script>