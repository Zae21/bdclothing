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
             <form  action="<?= site_url()?>/cart/do_checkout" method="post">
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
                        <td><a class="remove" href="<?= site_url()?>/user/cart/hapuslog/<?= $data->id?>"><fa class="fa fa-close"></fa></a></td>
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
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->

 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form action="<?= site_url()?>/user/cart/do_checkout" method="post">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="">
                    <!-- Coupon section -->
                    <!-- Login section -->
                    
                    <!-- Billing Details -->
                    
                    <!-- Shipping Address -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="">
                            Transaction Detail
                          </a>
                        </h4>
                      </div>
                      <div id="" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-6">
                              <h4>Shiping From:</h4>
                              <label>Jl. Telekomunikasi I, Kota Bandung, Indonesia</label>
                            </div>
                            <div class="col-md-6">
                              <table>
                                <tr>
                                  <th>Transaction ID</th>
                                  <th>:</th>
                                  <th><?= $idtr ?></th>
                                </tr>
                                <tr>
                                  <th>Transaction Date</th>
                                  <th>:</th>
                                  <th><?= date('d F Y')?></th>
                                </tr>
                                <tr>
                                  <th>Transaction Total</th>
                                  <th>:</th>
                                  <th id="total_byr"></th>
                                </tr>
                              </table>
                            </div>
                          </div>        
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <!-- Coupon section -->
                    <!-- Login section -->
                    
                    <!-- Billing Details -->
                    
                    <!-- Shipping Address -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            Shippping Address
                          </a>
                        </h4>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            
                         <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="nama_penerima" placeholder="Nama Lengkap*" required="">
                              </div>                             
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="email" placeholder="Email*" required="" name="email">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" placeholder="Nomor Telepon*" required="" name="notelp">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3" required="" name="alamat">Alamat*</textarea>
                              </div>                             
                            </div>                            
                          </div>   
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <select name="provinsi" required="">
                                  
                                </select>
                              </div>                             
                            </div>  
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <select name="kota" required="">
                                  <option> Pilih Kota* </option>
                                </select>
                              </div>                             
                            </div>                            
                          </div> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <select name="expedisi" required="">
                                  <option> Pilih Expedisi* </option>
                                  
                                </select>
                              </div>                             
                            </div>  
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <select name="paket" required="">
                                  <option> Pilih Paket* </option>
                                  
                                </select>
                                <input type="text" name="ongkir" id="biaya_kirim" hidden="">
                                <input type="text" name="total_transaksi" id="total_seluruh" hidden="">
                                <input type="text" name="id_transaksi"  value="<?= $idtr ?>" hidden>
                                <input type="text" name="tanggal_transaksi"  value="<?= date('Y-m-d') ?>" hidden>
                                <input type="text" name="id_pelanggan"  value="<?= $this->session->userdata('id_user') ?>" hidden>
                                <input type="text" name="nama_expedisi" id="nama_expedisi"  value="" hidden>
                                <input type="text" name="nama_paket" id="nama_paket"  value="" hidden>
                                <input type="text" name="nama_kota" id="nama_kota"  value="" hidden>
                              </div>                             
                            </div>                            
                          </div>         
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Product</th>
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
                        <td><?= $data->nama_barang?> <b><?= $data->jumlah?>x</b></td>
                        <td>Rp. <?= number_format($subtotal) ?></td>
                      </tr>
                      <?php } ?>
                      <tfoot>
                        <tr>
                          <th>Subtotal</th>
                          <td>Rp. <?= number_format($total) ?></td>
                        </tr>
                         <tr>
                          <th>Ongkir</th>
                          <td id="ongkir"></td>
                        </tr>
                         <tr>
                          <th>Total</th>
                          <td id="total_bayar"></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <h4>Payment Method</h4>
                  <div class="aa-payment-method">                    
                    <label for="cashdelivery"> Transfer Rekening BNI : 123456 An Rundina </label>    
                    <input type="submit" value="Place Order" class="aa-browse-btn">                
                  </div>
                </div>
              </div>
            </div>
          </form>
         </div>
       </div>
     </div>
   </div>
 </section>



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
          <form class="aa-login-form">
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


      $(document).ready(function(){

        //masukan provinsi
        $.ajax({
          type: "POST",
          url: "<?= site_url()?>/user/cart/rajaongkirprovince",
          success: function(provinsi){
            $("select[name=provinsi]").html(provinsi);
          }
        });

        //masukan kota
        $("select[name=provinsi]").on("change", function(){
          var province_id_selected = $("option:selected", this).attr("id_province");
          $.ajax({
            type: "POST",
            url: "<?= site_url()?>/user/cart/rajaongkirCity",
            data : 'id_province='+province_id_selected,
            success: function(city){
              $("select[name=kota]").html(city);
            }
          });
        });

        $("select[name=kota]").on("change", function(){
          $.ajax({
            type: "POST",
            url: "<?= site_url()?>/user/cart/rajaongkirExpedisi",
            success: function(expedisi){
              $("select[name=expedisi]").html(expedisi);
            }
          });
        });

        $("select[name=expedisi]").on("change", function(){
          var expedisi_selected = $("select[name=expedisi]").val();
          var city_selected = $("option:selected", "select[name=kota]").attr("id_city");

          $.ajax({
            type: "POST",
            url: "<?= site_url()?>/user/cart/rajaongkirPaket",
            data : "expedisi="+expedisi_selected+"&id_city="+city_selected,
            success: function(paket){
              $("select[name=paket]").html(paket);
            }
          });
        });

        $("select[name=paket]").on("change", function(){
          var ongkir = $("option:selected", this).attr("ongkir");
          $("#ongkir").html("Rp. "+ongkir);

          var tot = parseInt(ongkir)+parseInt(<?= $total ?>)
          $("#total_bayar").html("Rp. "+tot);
          $("#total_byr").html("Rp. "+tot);
          $('#total_seluruh').val(ongkir);
          $('#biaya_kirim').val(tot);

          var nama_expedisi = $("option:selected", "select[name=expedisi]").val();
          $('#nama_expedisi').val(nama_expedisi);
          var nama_paket = $("option:selected", this).attr("nama_paket");
          $('#nama_paket').val(nama_paket);
          var nama_kota = $("option:selected", "select[name=kota]").attr("nama_kota");
          $('#nama_kota').val(nama_kota);
        });

      });
    </script>

  </body>
</html>