<?php
   /**
    Display Template Name: Form Listing
    
    */
   
   get_header(); ?>
<form name="listform" action="" method="post" enctype="multipart/form-data">
   <div class="row">
      <div class="from-group col-md-6">
         <input id="title" name="title" type="text"  class="listing-form" placeholder="Title*" />
         
      </div>
      <div class="from-group col-md-6">
         <textarea class="listing-form" id="cnt-area" name="cnt-area" placeholder="Content" ></textarea>
      </div>
      <div class="from-group col-md-6">
         <input id="features-title" name="features-title" type="text"  class="listing-form" placeholder="Features Title*" />
      </div>
      <div class="from-group col-md-6">
         <input id="price" name="price" type="text"  class="listing-form" placeholder="Price*" />
      </div>
      <div class="from-group col-md-6">
         <input id="offer-price" name="offer-price" type="text"  class="listing-form" placeholder="Offer Price*" />
      </div>
      <div class="from-group col-md-6">
         <input id="anu-turnover" name="anu-turnover" type="text"  class="listing-form" placeholder="Annual Turnover*" />
      </div>
      <div class="from-group col-md-6">
         <input id="location" type="text" class="from-control input-field" placeholder="Location*" name="location" />
         <span id="userlocation" class="info"></span>
      </div>
      <div class="from-group col-md-6">
         <input id="timezone" name="timezone" type="text"  class="listing-form" placeholder="Time Zone*" />
      </div>
      <div class="from-group col-md-6">
         <input id="from-day" name="from-day" type="text"  class="listing-form" placeholder="From Day*" />
      </div>
      <div class="from-group col-md-6">
         <input id="to-day" name="to-day" type="text"  class="listing-form" placeholder="To Day*" />
      </div>
      <div class="from-group col-md-6">
         <input id="start-time" name="start-time" type="text"  class="listing-form" placeholder="Start Time*" />
      </div>
      <div class="from-group col-md-6">
         <input id="end-time" name="end-time" type="text"  class="listing-form" placeholder="End Time*" />
      </div>
      <div class="from-group col-md-12">
         <input name="filesToUpload[]" id="filesToUpload" type="file" multiple="" />
         <!-- Select images: <input id="gallery-img" name="gallery-img" type="image"  class="listing-form" placeholder="Gallery Images*" /> -->
      </div>
      <div class="from-group col-md-6">
         <textarea class="listing-form" id="pro-detail" name="pro-detail" placeholder="Property Details" ></textarea>
      </div>
      <div class="from-group col-md-6">
         <textarea class="oth-detail" id="oth-detail" name="oth-detail" placeholder="Other Details" ></textarea>
      </div>
      <div class="from-group col-md-6">
         <textarea class="listing-form" id="operation" name="operation" placeholder="Operation Details" ></textarea>
      </div>
      <div class="from-group col-md-6">
         <textarea class="listing-form" id="miscellaneous" name="miscellaneous" placeholder="Miscellaneous" ></textarea>
      </div>
      <div class="from-group col-md-12 submit_btn">
         <input class="btn" type="submit" name="submit"  value="Submit"/>
      </div>
   </div>
</form>
<?php get_footer(); ?>