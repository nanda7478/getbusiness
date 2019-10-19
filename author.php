<?php
/**
 * The template for displaying Author Archive pages.
 */
get_header(); ?>

<section class="bradcrumbs_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo site_url();?>">Home</a> / <a href="<?php echo site_url();?>/business-broker/">Busniesses Broker</a> / <span>Business Broker Details</span>
			</div>
		</div>
	</div>
</section>


<section class="broker_details_sec">
   <?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    $author_id = $curauth->ID;
    $images = get_field('profile_image', 'user_'. $author_id);
    $images1 = get_field('company_logo', 'user_'. $author_id);
    ?>	
<div class="container">
<div class="row">

<div class="broker_head">
<div class="broker_pic" style="background-image: url(<?php echo $images['url'];?>);"> </div>
<div class="broker_details">
<div class="top_row"> <div class="broker_name"> <?php echo $curauth->display_name;?>  </div> 
<div class="broker_social">
    <ul>
    <li><a href="<?php echo esc_html($curauth->facebookurl); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
    <li><a href="http://twitter.com/#!/<?php echo esc_html($curauth->twitterhandle); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
    <li><a href="<?php echo esc_url($curauth->instagramurl); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
    <li><a href="<?php echo esc_html($curauth->linkedinurl); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
    </ul>          
 </div> 
</div>
<p> <span class="icon"><i class="fas fa-phone-volume"></i></span> <span><?php echo get_the_author_meta('tel', $author_id);?></span> </p>
<p> <span class="icon"><i class="fas fa-map-marker-alt"></i></span> <span><?php echo get_the_author_meta('state', $author_id);?>, <?php echo get_the_author_meta('country', $author_id);?></span> </p>
<p> <span class="icon"><i class="fas fa-envelope"></i></span> <span><?php echo $curauth->description;?></span> </p>
 </div>
 </div>

<div class="bus_broker" >
<div class="title"> <h4> <?php echo get_the_author_meta('company', $author_id);?> </h4> </div>
<div class="buss_pic"  style="background-image: url(<?php echo $images1['url'];?>);"></div>
<div class="dec"><?php echo get_the_author_meta('company_info', $author_id);?></div>
</div>

<?php
global $wpdb;
$author_email =  get_the_author_meta( 'user_email', $author_id );
if(isset($_POST['submit'])){
            $fullname = $_POST['full_name'];
            $number = $_POST['number'];
            $email = $_POST['email'];
            $contact_type = $_POST['contact_type'];
            $message = $_POST['message'];
            
            $message = "<html><body>
                        Name    :  $fullname<br>
                        Email   :  $email<br>
                        Mobile  :  $number<br>
                        Contact Type : $contact_type<br>                     
                        Message : $message
                        </body></html>";
                        
            $to = $author_email;//to email
            $from = $email;//from email 
            $sub = "Enquiry Details";
            
            $headers = "From: ".$from."\r\n". "Reply-To:" . $from . "\r\n" ;
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";    

            mail($to,$sub,$message,$headers);
			$success = 'Thank you for getting in touch!';
}
?>

<form name="frmContact" action="" method="post" id="author_form" onsubmit="return validateContactForm()">
  <?php if(isset($success)){ ?>
  <div class="message_title"><h4><?php echo $success; ?></h4></div>
<?php } ?>
	<div class="form-title">
	<h2> Contact <span><?php echo $curauth->display_name;?></span> </h2> </div>
	<div class="row">
	<input type="hidden" name="target_email" class="from-control" value="<?php echo $curauth->user_email;?>">
<div class="from-group col-md-6">
<input type="text" name="full_name" id="full_name" class="from-control input-field" placeholder="Full Name*">
<span id="userfull_name" class="info"></span>
 </div>
<div class="from-group col-md-6">
<input type="text" name="number" id="number" class="from-control input-field" placeholder="Your Number*">
<span id="usernumber" class="info"></span>
 </div>
<div class="from-group col-md-6">
<input type="email" name="email" id="email" class="from-control input-field" placeholder="Your Email*">
<span id="useremail" class="info"></span>
 </div>
<div class="from-group col-md-6">
<select class="from-control input-field" name="contact_type" id="contact_type">
	<option value="">I am</option>
	<option value="Buyer">Buyer</option>
	<option value="Seller">Seller</option>
	</select>
	<span id="usercontact_type" class="info"></span>
 </div>
<div class="from-group col-md-12">
<textarea id="message" name="message" placeholder="Message To Broker" class="from-control input-field"></textarea>
<span id="usermessage" class="info"></span>
 </div>
<div class="from-group col-md-12">
<label class="input-checkbox input-field"><input type="checkbox" name="agree_terms" id="agree_terms"> I have read and agree with the <a href="<?php echo site_url();?>/terms-and-conditions/" target="_blank">Terms &amp; Conditions</a> &amp; <a href="<?php echo site_url();?>/privacy-policy/" target="_blank">Privacy </a><span class="checkmark"></span></label>
<span id="useragree_terms" class="info"></span>
</div>
<div class="from-group col-md-12">
<div class="submit-btn">
 		<input id="btnvalidate" class="btn" type="submit" name="submit" value="Send Message"> <span></span>
   </div>
 </div>

</div>
</form>
</div>

</div>
</section>

<section class="similar_listing_section">
	<div class="container">
<div class="similar_listing_wrapper">
      <div class="similar_listing_heading text-center">
        <h2>Listings  <span>Posted</span> By <span><?php echo $curauth->display_name;?></span></h2>
      </div>
    
    <div class="row blog">
            <div class="col-md-12">
              <div id="blogCarousel" class="carousel slide container-blog" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#blogCarousel" data-slide-to="1" class=""></li>
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">
                 
                               
                <div class="carousel-item active">
                    <div class="row">
              
                <div class="col-lg-4 col-md-6">
         <div class="sale_listing">
          <div class="sale_pic">
            <a href="http://demosrvr.com/wp/getabusiness/buy/very-profitable-traditional-cafe-for-sale/"><img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/05/4.jpg"></a>
          </div>
          <h4><a href="http://demosrvr.com/wp/getabusiness/buy/very-profitable-traditional-cafe-for-sale/">Very Profitable Traditional Cafe For Sale</a></h4>
                              <p class="price"><span>Price:</span> $155,000</p>
                                        <p class="location"><span>Location:</span> Milton Keynes, Enlgand</p>
                    <div class="more_details">
          <a href="http://demosrvr.com/wp/getabusiness/buy/very-profitable-traditional-cafe-for-sale/">More Details</a>
          </div>
                  </div>
            </div>
                        
                <div class="col-lg-4 col-md-6">
         <div class="sale_listing">
          <div class="sale_pic">
            <a href="http://demosrvr.com/wp/getabusiness/buy/well-established-retro-video-game-shop-for-sale-in-prime/"><img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/05/3.jpg"></a>
          </div>
          <h4><a href="http://demosrvr.com/wp/getabusiness/buy/well-established-retro-video-game-shop-for-sale-in-prime/">Well Established Retro Video Game Shop For Sale In Prime</a></h4>
                              <p class="price"><span>Price:</span> $155,000</p>
                                        <p class="location"><span>Location:</span> Derby, England</p>
                    <div class="more_details">
          <a href="http://demosrvr.com/wp/getabusiness/buy/well-established-retro-video-game-shop-for-sale-in-prime/">More Details</a>
          </div>
                  </div>
            </div>
                        
                <div class="col-lg-4 col-md-6">
         <div class="sale_listing">
          <div class="sale_pic">
            <a href="http://demosrvr.com/wp/getabusiness/buy/well-established-and-profitable-coffee-shop-for-sale/"><img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/05/2.jpg"></a>
          </div>
          <h4><a href="http://demosrvr.com/wp/getabusiness/buy/well-established-and-profitable-coffee-shop-for-sale/">Well Established And Profitable Coffee Shop For Sale</a></h4>
                              <p class="price"><span>Price:</span> $95,000</p>
                                        <p class="location"><span>Location:</span> Derby, England</p>
                    <div class="more_details">
          <a href="http://demosrvr.com/wp/getabusiness/buy/well-established-and-profitable-coffee-shop-for-sale/">More Details</a>
          </div>
                  </div>
            </div>
                  
                   </div>
                    <!--.row-->
                  </div>  
                      
                       
                <div class="carousel-item">
                    <div class="row">
              
                <div class="col-lg-4 col-md-6">
         <div class="sale_listing">
          <div class="sale_pic">
            <a href="http://demosrvr.com/wp/getabusiness/buy/free-business-fish-and-chips-low-rent-landlord-sale/"><img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/05/5.jpg"></a>
          </div>
          <h4><a href="http://demosrvr.com/wp/getabusiness/buy/free-business-fish-and-chips-low-rent-landlord-sale/">Free Business Fish And Chips Low Rent Landlord Sale</a></h4>
                                                  <p class="price"><span>Price:</span> Offers Invited</p>
                    <p class="location"><span>Location:</span> Derby, England</p>
                    <div class="more_details">
          <a href="http://demosrvr.com/wp/getabusiness/buy/free-business-fish-and-chips-low-rent-landlord-sale/">More Details</a>
          </div>
                  </div>
            </div>
                        
                <div class="col-lg-4 col-md-6">
         <div class="sale_listing">
          <div class="sale_pic">
            <a href="http://demosrvr.com/wp/getabusiness/buy/successful-off-licence-convenience-store/"><img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/05/6.jpg"></a>
          </div>
          <h4><a href="http://demosrvr.com/wp/getabusiness/buy/successful-off-licence-convenience-store/">Successful Off – Licence /Convenience Store</a></h4>
                              <p class="price"><span>Price:</span> $100,000</p>
                                        <p class="location"><span>Location:</span> Milton Keynes, Enlgand</p>
                    <div class="more_details">
          <a href="http://demosrvr.com/wp/getabusiness/buy/successful-off-licence-convenience-store/">More Details</a>
          </div>
                  </div>
            </div>
                        
                <div class="col-lg-4 col-md-6">
         <div class="sale_listing">
          <div class="sale_pic">
            <a href="http://demosrvr.com/wp/getabusiness/buy/extremely-well-established-high-quality-ladies-fashion/"><img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/05/7.jpg"></a>
          </div>
          <h4><a href="http://demosrvr.com/wp/getabusiness/buy/extremely-well-established-high-quality-ladies-fashion/">Extremely Well-Established High Quality Ladies Fashion</a></h4>
                              <p class="price"><span>Price:</span> $19,500</p>
                                        <p class="location"><span>Location:</span> Cheltenham, Gloucestershire</p>
                    <div class="more_details">
          <a href="http://demosrvr.com/wp/getabusiness/buy/extremely-well-established-high-quality-ladies-fashion/">More Details</a>
          </div>
                  </div>
            </div>
                  
                   </div>
                    <!--.row-->
                  </div>  
                      
                            
                 
                  <!--.item-->
                </div>
              <a class="carousel-control-prev" href="#blogCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next text-faded" href="#blogCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

                <!--.carousel-inner-->
              </div>
              <!--.Carousel-->
            </div>
          </div>
    
    

    </div>



 </div>
 </div>

</section>


<?php
get_footer();
?>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">
 function validateContactForm() {
            var valid = true;

            $(".info").html("");
            $(".input-field").css('border', '#e0dfdf 1px solid');
            var full_name = $("#full_name").val();
            var number = $("#number").val();
            var email = $("#email").val();
            var contact_type = $("#contact_type").val();
            var message = $("#message").val();
            
            if (full_name == "") {
                $("#userfull_name").html("Please Enter Full Name.");
                $("#full_name").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (email == "") {
                $("#useremail").html("Please Enter Email Address.");
                $("#email").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (!email.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/))
            {
                $("#useremail").html("Invalid Email Address.");
                $("#email").css('border', '#e66262 1px solid');
                valid = false;
            }

            if (number == "") {
                $("#usernumber").html("Please Enter Phone Number.");
                $("#number").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (contact_type == "") {
                $("#usercontact_type").html("Please Select Contact Type.");
                $("#contact_type").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (message == "") {
                $("#usermessage").html("Please Enter Message.");
                $("#message").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (!agree_terms.checked) {
                $("#useragree_terms").html("Please Check Terms & Conditions.");
                $("#agree_terms").css('border', '#e66262 1px solid');
                valid = false;
            }
            return valid;
        }


</script>