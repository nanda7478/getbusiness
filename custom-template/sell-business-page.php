<?php
  /*
   Display Template Name: Sell a Business
  */
session_start();
if ( ! function_exists( 'wp_handle_upload' ) ) {
  require_once ( ABSPATH . 'wp-admin/includes/file.php' );
}
// Include image.php
require_once(ABSPATH . 'wp-admin/includes/image.php');

global $current_user;
wp_get_current_user();
$userID = $current_user->ID;
get_header();






//session_unset();
//session_destroy(); 

if($_SESSION['signlisting']['countstep']){
 
}elseif($_SESSION['secondsignlisting']['countstep']){

}elseif($_SESSION['packagelisting']['countstep']){

}
else{
 $_SESSION['friststep'] = 1; 
}
?>
<?php
if(isset($_POST['signlisting']) == "Next provide Basic info"){


$emailid = $_POST['emailid'];
$userby = get_user_by( 'email', $emailid);

$userid = $userby->data->ID;
$userroles =   $userby->roles[0];

if($userroles == 'broker'){

  $author_id = get_current_user_id();
$args777858 = array(
  'author'        =>  $userid,
  'orderby'       =>  'post_date',
  'order'         =>  'ASC',
  'post_type' => 'buy',
  'posts_per_page' => 1
);
$query = new WP_Query($args777858);
if ( $query->have_posts() ){


$error = "list allow one list";



  }else{
  unset($_SESSION['packagelisting']['countstep']);
  unset($_SESSION['secondsignlisting']['countstep']);
  unset($_SESSION['friststep']);
  $_SESSION['signlisting'] = $_POST;
  }


}else{
  unset($_SESSION['packagelisting']['countstep']);
  unset($_SESSION['secondsignlisting']['countstep']);
  unset($_SESSION['friststep']);
  $_SESSION['signlisting'] = $_POST;
}
  

  
}
if(isset($_POST['secondsignlisting']) == "Now, Choose a Plan"){
  unset($_SESSION['signlisting']['countstep']);
  unset($_SESSION['packagelisting']['countstep']);
  unset($_SESSION['friststep']);
  $_SESSION['secondsignlisting'] = $_POST;
}
if(isset($_POST['fristpakage']) == "Select Showcase Ad"){


if(!$_SESSION['signlisting']['stepcount']){
  $error = "Please Fill all field frist step";
  
}
elseif(!$_SESSION['secondsignlisting']['stepcount1']){
$error = "Please Fill all field second step";
}else{
 unset($_SESSION['secondsignlisting']['countstep']);
 unset($_SESSION['signlisting']['countstep']);
 unset($_SESSION['friststep']);
 $_SESSION['packagelisting'] = $_POST; 
}


 
}
if(isset($_POST['secondpakagepakage']) == "Select Basic Ad"){



if(!$_SESSION['signlisting']['stepcount']){
  $error = "Please Fill all field frist step";
  

}
elseif(!$_SESSION['secondsignlisting']['stepcount1']){
$error = "Please Fill all field second step";
}else{
 unset($_SESSION['secondsignlisting']['countstep']);
 unset($_SESSION['signlisting']['countstep']);
 unset($_SESSION['friststep']);
 $_SESSION['packagelisting'] = $_POST; 
}
 
}


//echo $_SESSION['signlisting']['countstep'];
?>
<section class="bradcrumbs_section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <a href="#">Home</a> <span>/ Sell a Business</span>
        <?php
         echo $error;
        ?>
      </div>
    </div>
  </div>
</section>
<section id="tabs" class="sell-business">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
  <nav>
  <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

  <a class="nav-item nav-link <?php if($_SESSION['friststep'] == '1'){ echo 'active'; } ?>" id="nav-home-tab" data-toggle="tab" href="#creat-account" role="tab" aria-controls="nav-home" aria-selected="true">Create Account  >></a>

  <a class="nav-item nav-link <?php if($_SESSION['signlisting']['countstep'] == '2'){ echo 'active'; } ?>" id="nav-profile-tab" data-toggle="tab" href="#basic-info" role="tab" aria-controls="nav-profile" aria-selected="false">Basic Info  >></a>

  <a class="nav-item nav-link <?php if($_SESSION['secondsignlisting']['countstep'] == '3'){ echo 'active'; } ?>" id="nav-contact-tab" data-toggle="tab" href="#select-plan" role="tab" aria-controls="nav-contact" aria-selected="false">Select Plan (not complete)  >></a>

  <a class="nav-item nav-link <?php if($_SESSION['packagelisting']['countstep'] == '4'){ echo 'active'; } ?>" id="nav-contact-tab" data-toggle="tab" href="#select-plan-2" role="tab" aria-controls="nav-contact" aria-selected="false">Payment  >></a>


  </div>
  </nav>

<!-- first tabing start -->
  <div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade <?php if($_SESSION['friststep'] == '1'){ echo 'show active'; } ?>" id="creat-account" role="tabpanel" aria-labelledby="creat-account-tab">
  
  <div class="sell-business-wrapper">
  <div class="row"> 
    <div class="col-md-9">
      <div class="creat-account">
        <div class="description">
        <h2>Let's set <span> starting creating</span> your add</h2>
        <p>You are on your way to selling your business on the Internet's Largest Business for Sale Marketplace. Complete this form to reach over 1.4 million buyers monthly. </p>
    </div>
    <div class="basic-info-form"> 
  <h2>Your Account Info <span> | </span><a href="#"> Already have an account? Sign in here.</a> </h2>
    <form  method="post" name="signformlisting">
      <input type="hidden" name="stepcount" value="1">
      <div class="row">
        <div class="from-group col-md-6">
      <input type="text" name="fristname" class="from-control" placeholder="First Name*" value="<?php if($_SESSION['signlisting']['fristname']){ echo $_SESSION['signlisting']['fristname']; } ?>" required>
        </div>
        <div class="from-group col-md-6">
      <input type="text" name="lastname" class="from-control" placeholder="Last Name*" value="<?php if($_SESSION['signlisting']['lastname']){ echo $_SESSION['signlisting']['lastname']; } ?>" required>
        </div>
        <div class="from-group col-md-12">
      <input type="emiail" name="emailid" class="from-control" placeholder="Email Address*" value="<?php if($_SESSION['signlisting']['emailid']){ echo $_SESSION['signlisting']['emailid']; } ?>" required>
        </div>
        <div class="from-group col-md-6">
      <input type="number" name="mobnumber" class="from-control" placeholder="Phone Number*" value="<?php if($_SESSION['signlisting']['mobnumber']){ echo $_SESSION['signlisting']['mobnumber']; } ?>" required>
        </div>
        <div class="from-group col-md-6">
      <input type="password" name="upassword" class="from-control" placeholder="Password*" value="<?php if($_SESSION['signlisting']['upassword']){ echo $_SESSION['signlisting']['upassword']; } ?>" required>
       <input type="hidden" name="countstep" value="2">
        </div>

        <div class="from-group col-md-6">
      
       <select class="input-field" name="userroles" id="userroles" style="display: block;margin-bottom: 20px;" required>
  <option value="">Select Roles</option>  
  <option value="buyer">Business Owner</option>
  <option value="broker">Business Broker</option>

</select>
        </div>

          <div class="from-group col-md-6">
     <!--  <a href="#" class="btn">Next provide Basic info</a> -->
      <input type="submit" name="signlisting" value="Next provide Basic info" class="btn">

        </div>
      </div>
    </form>

    </div>
  </div>
  </div>

  <div class="col-md-3">
  <div class="question_box">
  <h4>Have Qusestiomns? We can Help. </h4>
  <h3>Call <span> Toll</span> -Free </h3>
  <span class="icon_box"> <img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/06/call_icon.png"> </span>
  <h2>(123-456-789)</h2>
  </div>
  </div>
  </div>
  </div>
  </div>
<!-- first tabing end -->

<!-- ============================== -->
<!-- second tabing start -->

  <div class="tab-pane fade <?php if($_SESSION['signlisting']['countstep'] == '2'){ echo 'show active'; } ?>" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab">
  <div class="sell-business-wrapper">
  <div class="row"> 
    <div class="col-md-9">
      <div class="basic-info">
        <div class="description">
        <h2>A little basic <span> business info.</span></h2>
        <p>You may keep certain information confidential but keep in mind, the more details you provide the more effective your ad will be. </p>
    </div>

    <div class="business-info-form"> 

  
   <form  method="post" name="signuplistingsecond">
       <input type="hidden" name="stepcount1" value="2">
      <div class="row">
        <div class="from-group col-md-6">
    <input type="text" name="titleforthisadd" class="from-control"  placeholder="Title for this ad*" value="<?php if($_SESSION['secondsignlisting']['titleforthisadd']){ echo $_SESSION['secondsignlisting']['titleforthisadd']; } ?>" required>
        </div>


         <div class="from-group col-md-6">
    <input type="text" name="price" class="from-control"  placeholder="Price*"  value="<?php if($_SESSION['secondsignlisting']['price']){ echo $_SESSION['secondsignlisting']['price']; } ?>" required>
        </div>

         <div class="from-group col-md-6">
    <input type="text" name="annualturnover" class="from-control" value="<?php if($_SESSION['secondsignlisting']['annualturnover']){ echo $_SESSION['secondsignlisting']['annualturnover']; } ?>"  placeholder="Annual Turnover*" required>
        </div>
       
      <div class="from-group col-md-6">
    <input type="text" name="tradinghours" class="from-control" value="<?php if($_SESSION['secondsignlisting']['tradinghours']){ echo $_SESSION['secondsignlisting']['tradinghours']; } ?>"  placeholder="Trading Hours*" required>
        </div>

        <div class="from-group col-md-6 select_box">
            <span class="select_border"></span>
      <select class="from-control select" name="businesstype" required>
        <option value="">Select Business Category</option>
       <?php  $listingtype = array('orderby' => 'name', 'order'=> 'ASC', 'hide_empty'=> false ); 
                      $listingtypeterm = get_terms("business-category", $listingtype);
                      foreach($listingtypeterm as $list) { ?>
        <option value="<?php echo $list->slug; ?>"><?php echo $list->name; ?></option>
      <?php } ?>
       
      </select>
        </div>
        


        <div class="from-group col-md-12">
      <h4>Gallery Images >> </h4>
        </div>
        <div class="from-group col-md-12">
            <div class="row" id="images-div"></div>
            <input type="file" id="property_images" name="property_images">
            Please uploade one by one

            <div id='loadingmessage1'  class="loadindimage" style='display:none; color: red;'>
  images loading..
</div>
        </div>


            <div class="from-group col-md-12">
      <h4>Business Description  >> </h4>
        </div>
        <div class="from-group col-md-12">
            <textarea class="from-control" name="businessdescription" value="<?php if($_SESSION['secondsignlisting']['businessdescription']){ echo $_SESSION['secondsignlisting']['businessdescription']; } ?>" placeholder="Business Description..." required></textarea>
        </div>

        <div class="from-group col-md-12">
      <h4>Property Details  >> </h4>
        </div>
        <div class="from-group col-md-12">
            <textarea class="from-control" name="propertydetails" value="<?php if($_SESSION['secondsignlisting']['propertydetails']){ echo $_SESSION['secondsignlisting']['propertydetails']; } ?>" placeholder="Property Details..." required></textarea>
        </div>

        <div class="from-group col-md-12">
      <h4>Other Details  >> </h4>
        </div>
        <div class="from-group col-md-12">
            <textarea class="from-control" name="otherdetail" value="<?php if($_SESSION['secondsignlisting']['otherdetail']){ echo $_SESSION['secondsignlisting']['otherdetail']; } ?>" placeholder="Other Details..." required></textarea>
        </div>


        <div class="from-group col-md-12">
      <h4>Operation Details  >> </h4>
        </div>
        <div class="from-group col-md-12">
            <textarea class="from-control" name="operationdeatil" value="<?php if($_SESSION['secondsignlisting']['operationdeatil']){ echo $_SESSION['secondsignlisting']['operationdeatil']; } ?>" placeholder="Operation Details..." required></textarea>
        </div>

          <div class="from-group col-md-12">
      <h4>Miscellaneous  >> </h4>
        </div>
        <div class="from-group col-md-12">
            <textarea class="from-control" name="miscellaneous" value="<?php if($_SESSION['secondsignlisting']['miscellaneous']){ echo $_SESSION['secondsignlisting']['miscellaneous']; } ?>" placeholder="Miscellaneous..." required></textarea>
        </div>

         <div class="from-group col-md-12">
      <h4>Feature  >> </h4>
        </div>
        <div class="from-group col-md-12">
             <?php
                      $feature_args = array('orderby' => 'name', 'order'=> 'ASC', 'hide_empty'=> false ); 
                      $feature__terms = get_terms("business-feature", $feature_args);
                      foreach($feature__terms as $feature) {
                        
                        echo '<div class="col-sm-4">';
                          echo '<div class="checkbox">';
                            echo '<label class="input-checkbox">';
                            echo '<input type="checkbox" name="features[]" value="'.$feature->slug.'"> '.$feature->name;
                            echo '<span class="checkmark"></span>';
                            echo '</label>';
                          echo '</div>';
                        echo '</div>';
                      }
                    ?>
        </div>



       
        <div class="from-group col-md-12">
      <h4>Business Location  >> </h4>
        </div>
        <div class="from-group col-md-6 select_box">
            <span class="select_border"></span>
   


       <?php
          global $wpdb;
      $sqlquery = $wpdb->get_results("SELECT * FROM countries WHERE status = 1 ORDER BY country_name ASC");
          
        ?>
     <select name="country" id="country" class="from-control select" required>
        <option value="">Select Country</option>
       <?php
       foreach ($sqlquery as  $value) {
        ?>
        <option value="<?php echo $value->country_id; ?>"><?php echo $value->country_name; ?></option>
        <?php
       }
       ?>
    </select>


        </div>
    <div class="from-group col-md-6"> 
    <select name="state" id="state" class="from-control select" required>
    <option value="">Select State</option>
    </select>
   </div>

      <div class="from-group col-md-6"> 
      <select name="city" id="city" class="form-control select" required>
      <option value="">Select City</option>
      </select>
      </div>

          <div class="from-group col-md-6">
      <input type="text" name="streetaddress" value="<?php if($_SESSION['secondsignlisting']['streetaddress']){ echo $_SESSION['secondsignlisting']['streetaddress']; } ?>" class="from-control" placeholder="Street Address*" required>
        </div>
     <!-- <div class="from-group col-md-12">
          <ul class="label_list">
    <li>  <h4>  ? Make Confidential:</h4></li>

   <li>
      <label class="input-checkbox"> <input type="checkbox" name=""> State  <span class="checkmark"></span></label</li>
<li>  <label class="input-checkbox"> <input type="checkbox" name=""> Country  <span class="checkmark"></span></label>
</li>
<li><label class="input-checkbox"> <input type="checkbox" name=""> City  <span class="checkmark"></span></label>
</li>

<li><label class="input-checkbox"> <input type="checkbox" name=""> Address  <span class="checkmark"></span></label>
</li></ul>
</div> -->
          <div class="from-group col-md-12">
      <h4>Business Location  >> </h4>
        </div>

<div class="from-group col-md-6">
    <input type="text" name="contactname" class="from-control" value="<?php if($_SESSION['secondsignlisting']['contactname']){ echo $_SESSION['secondsignlisting']['contactname']; } ?>" placeholder="Contact Name*" required>
        </div>
        <div class="from-group col-md-6">
    <input type="text" name="contactphone" class="from-control" value="<?php if($_SESSION['secondsignlisting']['contactphone']){ echo $_SESSION['secondsignlisting']['contactphone']; } ?>" placeholder="Contact Phone*" required>
        </div>
        <div class="from-group col-md-12">
    <input type="text" name="contactemailaddress" value="<?php if($_SESSION['secondsignlisting']['contactemailaddress']){ echo $_SESSION['secondsignlisting']['contactemailaddress']; } ?>" class="from-control" placeholder="Contact Email Address*" required>
        </div>
      <div class="from-group col-md-12">
      <h4>Business Location  >> </h4>
        </div>
<!-- <div class="from-group col-md-6 select_box">
  <span class="select_border"></span>
      <select class="from-control select">
        <option>Best Matching Category</option>
        <option>Business Country 1</option>
        <option>Business Country 2</option>
        <option>Business Country 3</option>
        <option>Business Country 4</option>
        <option>Business Country 5</option>
        <option>Business Country 6</option>
        <option>Business Country 7</option>
        <option>Business Country 8</option>
      </select>
        </div>
        <div class="from-group col-md-6 select_box">
            <span class="select_border"></span>
      <select class="from-control select">
        <option>Other Matching Category</option>
        <option>Category 1</option>
        <option>Category 2</option>
        <option>Category 3</option>
        <option>Category 4</option>
        <option>Category 5</option>
        <option>Category 6</option>
        <option>Category 7</option>
        <option>Category 8</option>
      </select>
        </div> -->
        <div class="from-group col-md-6 select_box">
            <span class="select_border"></span>
      <select class="from-control select" name="numberofemployees" required>
        <option>Number Of Employees</option>
        <option value="1">Employees 1</option>
        <option value="2">Employees 2</option>
        <option value="3">Employees 3</option>
        <option value="4">Employees 4</option>
        <option value="5">Employees 5</option>
        <option value="6">Employees 6</option>
        <option value="7">Employees 7</option>
        <option value="8">Employees 8</option>
      </select>
        </div>
        <div class="from-group col-md-6 select_box">
       <span class="select_border"></span>
      <select class="from-control select" name="yearestablished" required="">
        <option>Year Established</option>
        <option>1990</option>
        <option>1991</option>
        <option>1992</option>
        <option>1993</option>
        <option>1994</option>
        <option>1995</option>
        <option>1996</option>
        <option>1997</option>
        <option>1998</option>
        <option>1999</option>
        <option>2000</option>
      </select>
        </div>

<!-- <div class="from-group col-md-12 web-link">
  <span>https:// </span>
  <input type="text" name="" class="from-control" placeholder="Bussiness Website*">
</div>
<div class="from-group col-md-12">
    <label class="input-checkbox"> <input type="checkbox" name=""> Keep Website Confidential <span class="checkmark"></span></label>
    </div> -->
<!-- <div class="from-group col-md-12">
  <ul class="label_list"><li>
      <h4> ?  Business is:</h4></li>

     <li> <label class="input-checkbox"> <input type="checkbox" name=""> Relocatable    
        <span class="checkmark"></span></label></li>

    <li> <label class="input-checkbox"> <input type="checkbox" name=""> Home-based  
        <span class="checkmark"></span></label></li>

    <li>  <label class="input-checkbox"> <input type="checkbox" name=""> Established Franchise  
        <span class="checkmark"></span></label></li>
      </ul>
        </div> -->
         <input type="hidden" name="countstep" value="3">
          <div class="from-group col-md-6">
        <input type="submit" name="secondsignlisting" value="Now, Choose a Plan" class="btn">
        </div>
      </div>
    </form>

    </div>
  </div>
  </div>

<div class="col-md-3">
  <div class="question_box">
  <h4>Have Qusestiomns? We can Help. </h4>
  <h3>Call <span> Toll</span> -Free </h3>
  <span class="icon_box"> <img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/06/call_icon.png"> </span>
  <h2>(123-456-789)</h2>
  </div>
</div>
</div>
</div>
</div>
<!-- second tabing end -->

<!-- ============================== -->
<!-- thrid tabing start -->

  <div class="tab-pane fade <?php if($_SESSION['secondsignlisting']['countstep'] == '3'){ echo 'show active'; } ?>" id="select-plan" role="tabpanel" aria-labelledby="plan-select-tab">

  <div class="sell-business-wrapper">
  <div class="row"> 
    <div class="col-md-9">
      <div class="select-basic-plan">
        <div class="description">
        <h2>Choose a <span> Plan to Meet</span> Your Needs. </h2>
        <p>Choose an ad type below, then in the next step you will be able to add photos and additional details. You will also have access to a Valuation Report to help set the right asking price.</p>
    </div>
    <div class="select-plan-tab"> 
  <h4>Choose from one of <span>2 Advertising</span> Plans</h4>

<div class="row showcase_row"> 


  <div class="col-md-6"> 
   <form  name="fristpackage" method="post">
    <div class="showcase"> 
      <div class="title"> <h2>Showcase <span>Ad</span> </h2> <h4> <span> 5X More Leads</span> (vs Basic)</h4> </div>
        <p><span>Multiple</span> Photos, Attachments & Video</p>
        <p>View Stats & Leads Online</p>
        <p><span>Higher Placement</span> in Search</p>
        <p>Free Valuation Report <span>($59.95 value)</span></p>
        <p>Contact List of Interested Buyers</p>
        <p>Targeted Email Blast Included</p>
        
        <div class="plan_select">
           <span class="select_border"></span>
    <select class="from-control select" id="fristplian" name="datetime">
        <option value="6">6-month Showcase Ad: $69.95/mo</option>
        <option value="12">Year 1</option>
        <option value="24">Year 2</option>
        <option value="36">Year 3</option>
      </select>
         </div>
         <input type="hidden" name="countstep" value="4">
          <input type="hidden" name="packagename" value="1">
          <input type="hidden" name="packagetotal" id="packagetotal" value="<?php echo 69.40*6; ?>">

         <div class="select-btn"> 
            <input type="submit" name="fristpakage" value="Select Showcase Ad" class="btn">
         </div>
    </div> 
  </form>
  </div>



    <div class="col-md-6"> 
      <form name="secondpackage" method="post">
    <div class="showcase"> 
      <div class="title"> <h2>Basic <span>Ad</span> </h2> <h4> <span> 5X More Leads</span> (vs Basic)</h4> </div>
        <p>Single Photo and Attachment</p>
        <p>View Stats & Leads Online</p>
        <p>Free Valuation Report <span>($59.95 value)</span></p>
  
        <div class="plan_select">
           <span class="select_border"></span>
      <select class="from-control select" id="secondplian" name="datetime">
        <option value="6">6-month Basic Ad: $49.95/mo</option>
         <option value="12">Year 1</option>
        <option value="24">Year 2</option>
        <option value="36">Year 3</option>
      </select>
         </div>

          <input type="hidden" name="countstep" value="4">
           <input type="hidden" name="packagename" value="2">
           <input type="hidden" name="packagetotal" id="packagetotal1" value="<?php echo 49.95*6; ?>">


         <div class="select-btn"> 
          <input type="submit" name="secondpakagepakage" value="Select Basic Ad" class="btn">
         </div>
    </div> 
  </form>
  </div>
</div>

<div class="product_description">
<div class="titile"> <h3>Product Description: </h3>  <span class="price">Price </span></div>
<div class="monthly-plan"> <h3>Month Basic Ad - ($<span class="monthid">69.95</span>/month) </h3><spna class="price">$<span class="totalpriceo"><?php echo 69.40*6; ?></spna></spna> </div>
<p>Your 6-month initial term begins one week after your purchase date, but you can publish your ad as soon as you 
are ready. Following your initial 6-month term, your ad will be billed monthly at $49.95/month unless you turn off 
renewal via the My Listings page.</p>
<div class="total_price"> Total $<span class="totalpriceo"><?php echo 69.40*6; ?></span> </div>
</div>

   <!--  <form action="" method="post" class="payment_form">
      <div class="row">
        <div class="from-group col-md-12">
      <h3>Payment Information  >></h3>
        </div>

          <div class="from-group col-md-6">
      <input type="text" name="" class="from-control" placeholder="First Name">
        </div>
        <div class="from-group col-md-6">
      <input type="text" name="" class="from-control" placeholder="Last Name">
        </div>
            <div class="from-group col-md-6">
      <input type="number" name="" class="from-control" placeholder="Phone Number">
        </div>
        <div class="from-group col-md-6">
      <input type="text" name="" class="from-control" placeholder="Street Address">
        </div>
      <div class="from-group col-md-6">
      <input type="text" name="" class="from-control" placeholder="City">
        </div>
    
        <div class="from-group col-md-6 select_box">
           <span class="select_border"></span>
    <select class="from-control select">
        <option>Country</option>
        <option>Year 1</option>
        <option>Year 2</option>
        <option>Year 3</option>
        <option>Year 4</option>
        <option>Year 5</option>
        <option>Year 6</option>
        <option>Year 7</option>
        <option>Year 8</option>
      </select>
        </div>

        <div class="from-group col-md-6 select_box">
           <span class="select_border"></span>
    <select class="from-control select">
        <option>State</option>
        <option>Year 1</option>
        <option>Year 2</option>
        <option>Year 3</option>
        <option>Year 4</option>
        <option>Year 5</option>
        <option>Year 6</option>
        <option>Year 7</option>
        <option>Year 8</option>
      </select>
        </div>
            <div class="from-group col-md-6">
      <input type="text" name="" class="from-control" placeholder="Zip/Postal Code">
        </div>


<div class="col-md-12"> 
<div class="cardit_card_details">
<div class="select_card"> 
  <div class="card-name"> <span></span> Credit card </div> 
<div class="card_type">
  <ul>
    <li><a href="#"> <img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/06/visa.png"> </a> </li>
    <li><a href="#"> <img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/06/master-card.png"> </a> </li>
    <li><a href="#"> <img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/06/americon-express.png"> </a> </li>
    <li><a href="#"> <img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/06/discover.png"> </a> </li>
  </ul>
</div>
</div>
<form action="#" method="" enctype="Multiple">
  <div class="row">
      <div class="from-group col-12 card-number">
        <span class="card_no_icon"></span>
      <input type="text" name="" class="from-control" placeholder="Card Number">
        </div>
        <div class="from-group col-6 card-holder">
      <input type="text" name="" class="from-control" placeholder="Name of card">
        </div>
        <div class="from-group col-3 date">
        <span class="date_no_icon"></span>
        <input type="text" name="" class="from-control" placeholder="MM/YY">
        </div>
        <div class="from-group col-3 cvv">
        <span class="cvv_no_icon"></span>
        <input type="text" name="" class="from-control" placeholder="CVV">
      </div>
</div>
</form>
</div>
</div>

  <div class="from-group col-md-12">
    <h3>Terms of Use >> </h3>
      </div>


  <div class="from-group col-md-12">
    <label class="input-checkbox"> <input type="checkbox" name=""> I have read and agree to BizBuySell's <span class="checkmark"></span><a href="#"> Terms of Use.</a></label>
    </div>

    <div class="from-group col-md-6">
      <a href="#" class="btn">Purchase Basic ad</a>
        </div>
      </div>
    </form> -->

    </div>
  </div>
  </div>

<!-- <div class="col-md-3">
  <div class="question_box">
  <h4>Have Qusestiomns? We can Help. </h4>
  <h3>Call <span> Toll</span> -Free </h3>
  <span class="icon_box"> <img src="http://demosrvr.com/wp/getabusiness/wp-content/uploads/2019/06/call_icon.png"> </span>
  <h2>(123-456-789)</h2>
  </div>
</div> -->
</div>
</div>
</div>




  <div class="tab-pane fade <?php if($_SESSION['packagelisting']['countstep'] == '4'){ echo 'show active'; } ?>" id="select-plan-2" role="tabpanel" aria-labelledby="plan-select-2-tab">
    <div class="sell-business-wrapper">
  <div class="row"> 
    <div class="col-md-9">
      <div class="select-basic-plan">
        <div class="description">
        <h2>Payment </h2>
        package : <?php 
         if($_SESSION['packagelisting']['packagename'] == '1'){
            echo 'Showcase Ad';
         }
         if($_SESSION['packagelisting']['packagename'] == '2'){
           echo 'Basic Ad';
         }
         

         ?><br>
        Package time :   <?php echo $_SESSION['packagelisting']['datetime'] ?>Month<br>
        Total Price :   <?php echo $_SESSION['packagelisting']['packagetotal'] ?><br>
       By Paypal 
        
    </div>
    
</div>


 <form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" onsubmit="return validateForm()">
<!-- Identify your business so that you can collect the payments. -->
<input type="hidden" value="dasun_1358759028_biz@archmage.lk" name="business">
<!-- Specify a Buy Now button. -->
<input type="hidden" value="_xclick" name="cmd">
<!-- Specify details about the item that buyers will purchase. -->
<input type="hidden" value="sell-a-business" name="item_name">
<input type="hidden" value="<?php echo $_SESSION['packagelisting']['packagetotal'] ?>" id="amountval" name="amount">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" value="item_number" name="item_number">
<!-- Display the payment button. -->
  <input type='hidden' name='cancel_return' value='http://demosrvr.com/wp/getabusiness/cancel'>
        <input type='hidden' name='return' value='http://demosrvr.com/wp/getabusiness/success'>
        <input type='hidden' name='notify_url' value='<?php bloginfo('template_url'); ?>/ipn.php'>
<input type="image" name="submit"  border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
</form>

</div>

</div></div>

    



  </div>
  </div>
  </div>
  </div>
  </div>
  </section>


<?php
  get_footer();
  ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#secondplian').on('change', function() {
  
     var secondplianvalue = this.value; 
    var totalvalue = secondplianvalue*49.95;
    var totalvaluen = totalvalue.toFixed(2);
    $('.totalpriceo').text(totalvaluen);
    $('#packagetotal1').val(totalvaluen);
    $('.monthid').text("49.95");

    
  });

  $('#fristplian').on('change', function() {

    var secondplianvalue = this.value; 
    var totalvalue = secondplianvalue*69.95;
    var totalvaluen = totalvalue.toFixed(2);
    $('.totalpriceo').text(totalvaluen);
   $('#packagetotal').val(totalvaluen);

    $('.monthid').text("69.95");

 
  });

});
</script>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/ajaxupload.3.5.js"></script>
<script>
 var btnUpload = jQuery('#property_images');

    new AjaxUpload(btnUpload, {
      action: '<?php echo get_bloginfo('stylesheet_directory'); ?>/upload-images.php',
      name: 'uploadfile',
      onSubmit: function(file, ext){
          $('#loadingmessage1').show();
        if( ! (ext && /^(jpg|png|jpeg|gif)$/.test(ext)) ){
          // extension is not allowed
          alert('Only jpg, png or gif files are allowed');
          return false;
        }
      },
      onComplete: function(file, response){
        
        //Add uploaded file to list
        if(response == 'error') {
          alert('Problem with Image.');
        } else {
          jQuery("#images-div").append(response);
          $('#loadingmessage1').hide();
        }
      }
    });
    jQuery('#images-div').on("click", ".deleteimg", function() {
    var dataid = jQuery(this).attr("data-id");
    jQuery('#' + dataid).remove();
  });
</script>
<script type="text/javascript">
  function validateForm() {
  var amountval = $('#amountval').val();

  if(amountval == "" || amountval == undefined){
    alert("Please Fill All step");
    return false;
  }else{
      return true;
  }
  
} 
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery('#country').on('change',function(){
          var countryID = $(this).val();
          
           jQuery.ajax({
            type:'post',
            url:'<?php echo get_bloginfo('stylesheet_directory'); ?>/ajaxData.php',
                      data: 'country_id='+countryID,
            success:function(html) 
            {
                          jQuery('#state').html(html);
                      jQuery('#city').html('<option value="">Select state first</option>'); 
            }
        });

      });



    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
               url:'<?php echo get_bloginfo('stylesheet_directory'); ?>/ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });


});
</script>