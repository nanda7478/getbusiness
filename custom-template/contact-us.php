<?php
/*
 Display Template Name: Contact Us
*/
get_header();
?>
<?php
if(isset($_POST['submit'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $business_name = $_POST['business_name'];
            $web_address = $_POST['web_address'];
            $your_message = $_POST['your_message'];
            
            $message = "<html><body>
                        First Name    :  $first_name<br>
                        Last Name   :  $last_name<br>
                        Phone Number : $tel<br>                     
                        Email Address : $email<br>
                        Business Name : $business_name<br>
                        Website Address : $web_address<br>
                        Message : $your_message<br>
                        </body></html>";
                        
            $to = 'dev@ptiwebtech.com' ;//to email
            $from = $email;//from email 
            $sub = "Get a business";
            
            $headers = "From: ".$from."\r\n". "Reply-To:" . $from . "\r\n" ;
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";    

            mail($to,$sub,$message,$headers);
         $success = '<div class="wp-caption alignnone" style="">
                     <h2><em>Thank you!</em></h2>
                     <p><em>Your message has been successfully sent. We will contact you very soon!</em></p>
                     </div>';
         }
     ?>
<div id="content" class="site-content contact-us">
<section class="bradcrumbs_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo site_url();?>">Home</a> <span>/ Contact Us</span>
			</div>
		</div>
	</div>
</section>
<section class="contact_us_section">
	<div class="container">
			<div class="section-heading">
				<h2><?php the_field('seen_business_title');?></h2>
        <?php the_field('contact_content');?>
			</div>
		</div>
</section>
<section class="contact-details"> 
	<div class="container">
         <div class="row">
         	 <div class="col-md-4"> <div class="con_add phone"> <h3><?php the_field('phone_title');?> </h3> <span><a href="tel:<?php the_field('phone_number');?>"><?php the_field('phone_number');?></a></span> </div></div>
             <div class="col-md-4"> <div class="con_add email"> <h3><?php the_field('email_title');?> </h3> <span><a href="mailto:<?php the_field('email_address');?>"><?php the_field('email_address');?></a> </span> </div> </div>
         	 <div class="col-md-4"> <div class="con_add location"> <h3><?php the_field('location_title');?> </h3> <span><?php the_field('location_address');?> </span> </div> </div>
         	
       	 </div>
         </div>
</section>
<section class="contact_form_map">
	<div class="container">
			<div class="message_text">
			<?php if(isset($success)){echo $success;}?>
			</div>
<div class="row">
<div class="col-md-6">
	<div class="contact_form">
			<h2>Contact our <span>commercial team</span></h2>
      <?php //echo do_shortcode('[contact-form-7 id="1243" title="Contact form 1"]');?>
<form id="myform" action="" method="POST" name="contact_form">
        <div class="row">
  <div class="form-group col-md-6">
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name*">
  </div>
  <div class="form-group col-md-6">
    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name*">
  </div>
    <div class="form-group col-md-6">
    <input type="text" class="form-control" id="tel" name="tel" placeholder="Telephone*">
  </div>
    <div class="form-group col-md-6">
    <input type="text" class="form-control" id="email" name="email" placeholder="Email Address*">
  </div>
    <div class="form-group col-md-6">
    <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Bussness Name*">
  </div>
    <div class="form-group col-md-6">
    <input type="text" class="form-control" id="web_address" name="web_address" placeholder="Website Address">
  </div>
  <div class="form-group text col-md-12">
<textarea class="form-control"  placeholder="Your Message" name="your_message" rows="4" cols="50"></textarea>
  </div>



<div class="checkbox"><label class="input-checkbox"> <input type="checkbox" name="tick" checked=""> Please tick if you consent to being contacted by email  getabusiness and carefully 
selected 3rd party services. Note we do not sell, rent or share your data with third 
parties without your consent  <span class="checkmark"></span></label></div>


<div class="checkbox"><label class="input-checkbox"> <input type="checkbox" name="terms"> I have read and accept the <a href="<?php echo site_url();?>/terms-and-conditions/" target="_blank"> Terms & Conditions</a> and <a href="<?php echo site_url();?>/privacy-policy/" target="_blank" >Privacy Policy</a> <span class="checkmark"></span></label> </div>
<div class="col-md-12">
  <input type="submit" name="submit" value="Send" class="btn">
   </div>
   
</div>
</form>
</div>
</div>
<div class="col-md-6">
<div class="contact_map">
<h2> Our <span>Location</span> </h2>
<div class="map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30703360.23043832!2d64.42667979045302!3d20.05175045156837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sin!4v1559735040462!5m2!1sen!2sin" width="100%" height="550" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
</div>
</div>
</div>
</section>
<div id="content" class="site-content">
<?php get_footer(); ?>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script type="text/javascript">
$(function() {
  $("form[name='contact_form']").validate({
    // Specify validation rules
    rules: {
      first_name: "required",
      last_name: "required",
      email: {
        required: true,
        email: true
      },
      tel: "required",
      business_name: "required",
      web_address: "required",
      terms: "required",
    },
    messages: {
      first_name: "Please enter your firstname",
      last_name: "Please enter your lastname",
      email: "Please enter a valid email address",
      tel: "Please enter phone number",
      business_name: "Please enter business name",
      web_address: "Please enter website address",
      terms: "Please accept Terms of use"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>