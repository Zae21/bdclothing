<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Daily Shop | Cart Page</title>
    
    <!-- Font awesome -->
    <link href="<?= base_url()?>/asset/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?= base_url()?>/asset/css/bootstrap.css" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="<?= base_url()?>/asset/css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>/asset/css/jquery.simpleLens.css">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>/asset/css/slick.css">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>/asset/css/nouislider.css">
    <!-- Theme color -->
    <link id="switcher" href="<?= base_url()?>/asset/css/theme-color/default-theme.css" rel="stylesheet">
    <!-- Top Slider CSS -->
    <link href="<?= base_url()?>/asset/css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

    <!-- Main style sheet -->
    <link href="<?= base_url()?>/asset/css/style.css" rel="stylesheet">    

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
   
   <!-- wpf loader Two -->
    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> 
    <!-- / wpf loader Two -->       
 <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="index.html">
                  <!-- <span class="fa fa-shopping-cart"></span> -->
                  <p>BCC.<strong>Co</strong> <span>Bandung Clothing Corporation</span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
              <div>
              </div>
               <!-- cart box -->
              <div class="aa-cartbox">
                <a class="aa-cart-link" href="#">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-notify"><?= $cart?></span>
                </a>
                <div class="aa-cartbox-summary">
                  <ul>
                    <?php
                      $total=0;
                        foreach($produk as $data){
                        $subtotal = $data->harga_jual_satuan*$data->jumlah;
                        $total = $total+$subtotal;
                      ?>
                    <li>
                      <a class="aa-cartbox-img" href="#"><img src="<?php echo base_url('upload/Barang/'.$data->gambar); ?>" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="#"><?= $data->nama_barang?></a></h4>
                        <p><?= $data->jumlah?> x Rp. <?= number_format($data->harga_jual_satuan)?></p>
                      </div>
                      <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
                    </li>
                    <?php } ?>                    
                    <li>
                      <span class="aa-cartbox-total-title">
                        Total
                      </span>
                      <span class="aa-cartbox-total-price">
                        Rp.  <?= number_format($total)?>
                      </span>
                    </li>
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="checkout.html">Checkout</a>
                </div>
              </div>
              <!-- / cart box -->
              

              <!-- search box -->
              <div class="aa-search-box">
                <form action="">
                  <input type="text" name="" id="" placeholder="Search here ex. 'man' ">
                  <button type="submit"><span class="fa fa-search"></span></button>
                </form>
              </div>
              <!-- / search box -->             
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  <!-- menu -->
  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">

            <!-- Left nav -->
                <ul class="nav navbar-nav">
                <!-- <div class="aa-header-top-left"> -->
                  <li><a href="<?= site_url()?>/user/home">Home</a></li>
                  <li><a href="#">Kategori <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <?php
                        foreach($kategori as $data){ ?>

                      <li><a href="<?= site_url()?>/user/home/product_kat/<?= $data->id ?>"><?= $data->nama ?></a></li>
                    
                    <?php  }
                      ?>              
                    </ul>
                  </li>
                <!-- </div> -->
                <!-- <div class="float:'right';"> -->
                  
              <?php
                          if($this->session->userdata('username')) {
                            ?>            
                              <li style="margin-left: 75%;"><a href="#"><?= $this->session->userdata("username") ?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                  <li><a href="<?= site_url('user/cart') ?>">Cart</a></li>
                                  <li><a href="<?= site_url('user/order') ?>">My Order</a></li>
                                  <li><a href="<?= site_url('user/auth/logout') ?>">Logout</a></li>     
                                </ul>
                              </li>                  
                            <?php
                          } else {
                            ?>
                              <li class="<?= $this->uri->segment(2) == "login" ? "active" : ""?>"><a href="<?= site_url('user/auth/login') ?>">Login</a></li>
                            <?php
                            
                          }
                        ?>
              
                <!-- </div> -->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
        </div>
      </div>       
    </div>
  </section>
 
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Cart Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Cart</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table" id="">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $total=0;
                        foreach($produk as $data){
                        $subtotal = $data->harga_jual_satuan*$data->jumlah;
                        $total = $total+$subtotal;
                      ?>
                      <tr id="<?php echo $data->id; ?>">
                        <td><a class="remove" href="<?= site_url()?>/user/cart/hapus/<?= $data->id?>"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="#"><img src="<?php echo base_url('upload/Barang/'.$data->gambar); ?>" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#"><?= $data->nama_barang?></a></td>
                        <td>Rp. <?= number_format($data->harga_jual_satuan)?></td>
                        <td contentEditable='true' class="edit" id='jumlah_<?php echo $data->id; ?>'><?= $data->jumlah?></td>
                        <td>Rp. <?= number_format($subtotal) ?></td>
                      </tr>
                      <?php } ?>
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Total</th>
                     <td>Rp. <?= number_format($total) ?></td>
                   </tr>
                 </tbody>
               </table>
               <a href="<?= site_url()?>/user/cart/checkout" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->


  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->

  <!-- footer -->  
  <footer id="aa-footer">
    <!-- footer bottom -->
    <div class="aa-footer-top">
     <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <h3>Main Menu</h3>
                  <ul class="aa-footer-nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Our Products</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Knowledge Base</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Delivery</a></li>
                      <li><a href="#">Returns</a></li>
                      <li><a href="#">Services</a></li>
                      <li><a href="#">Discount</a></li>
                      <li><a href="#">Special Offer</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Useful Links</h3>
                    <ul class="aa-footer-nav">
                      <li><a href="#">Site Map</a></li>
                      <li><a href="#">Search</a></li>
                      <li><a href="#">Advanced Search</a></li>
                      <li><a href="#">Suppliers</a></li>
                      <li><a href="#">FAQ</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <div class="aa-footer-widget">
                    <h3>Contact Us</h3>
                    <address>
                      <p> 25 Astor Pl, NY 10003, USA</p>
                      <p><span class="fa fa-phone"></span>+1 212-982-4589</p>
                      <p><span class="fa fa-envelope"></span>dailyshop@gmail.com</p>
                    </address>
                    <div class="aa-footer-social">
                      <a href="#"><span class="fa fa-facebook"></span></a>
                      <a href="#"><span class="fa fa-twitter"></span></a>
                      <a href="#"><span class="fa fa-google-plus"></span></a>
                      <a href="#"><span class="fa fa-youtube"></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
    <!-- footer-bottom -->
    <div class="aa-footer-bottom">
      <div class="container">
        <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-bottom-area">
            <p>Designed by <a href="http://www.markups.io/">MarkUps.io</a></p>
            <div class="aa-footer-payment">
              <span class="fa fa-cc-mastercard"></span>
              <span class="fa fa-cc-visa"></span>
              <span class="fa fa-paypal"></span>
              <span class="fa fa-cc-discover"></span>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </footer>
  <!-- / footer -->
  <!-- Login Modal -->  
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Login or Register</h4>
          <form class="aa-login-form" action="">
            <label for="">Username or Email address<span>*</span></label>
            <input type="text" placeholder="Username or email">
            <label for="">Password<span>*</span></label>
            <input type="password" placeholder="Password">
            <button class="aa-browse-btn" type="submit">Login</button>
            <label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
            <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
            <div class="aa-register-now">
              Don't have an account?<a href="account.html">Register now!</a>
            </div>
          </form>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?= base_url()?>/asset/js/bootstrap.js"></script>  
    <!-- SmartMenus jQuery plugin -->
    <script type="text/javascript" src="<?= base_url()?>/asset/js/jquery.smartmenus.js"></script>
    <!-- SmartMenus jQuery Bootstrap Addon -->
    <script type="text/javascript" src="<?= base_url()?>/asset/js/jquery.smartmenus.bootstrap.js"></script>  
    <!-- To Slider JS -->
    <script src="<?= base_url()?>/asset/js/sequence.js"></script>
    <script src="<?= base_url()?>/asset/js/sequence-theme.modern-slide-in.js"></script>  
    <!-- Product view slider -->
    <script type="text/javascript" src="<?= base_url()?>/asset/js/jquery.simpleGallery.js"></script>
    <script type="text/javascript" src="<?= base_url()?>/asset/js/jquery.simpleLens.js"></script>
    <!-- slick slider -->
    <script type="text/javascript" src="<?= base_url()?>/asset/js/slick.js"></script>
    <!-- Price picker slider -->
    <script type="text/javascript" src="<?= base_url()?>/asset/js/nouislider.js"></script>
    <!-- Custom js -->
    <script src="<?= base_url()?>/asset/js/custom.js"></script> 

    <script type="text/javascript" src="<?= base_url()?>/asset/js/jquery.tabledit.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
       
       // Add Class
       $('.edit').click(function(){
        $(this).addClass('editMode');
       });

       // Save data
       $(".edit").focusout(function(){
        $(this).removeClass("editMode");
        var id = this.id;
        var split_id = id.split("_");
        var field_name = split_id[0];
        var edit_id = split_id[1];
        var value = $(this).text();

        $.ajax({
         url: '<?= site_url()?>/user/cart/update',
         type: 'post',
         data: { field:field_name, value:value, id:edit_id },
         success:function(response){
           if(response == 1){
              console.log('Save successfully'); 
           }else{
              console.log("Not saved.");
           }
         }
        });
       
       });

      });
    </script>

  </body>
</html>