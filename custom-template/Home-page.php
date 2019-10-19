

<?php
   /*
    Display Template Name: Home Page
   */
   get_header();
   ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php $image = get_field('home_banner_image'); ?>
<div class="home-page-banner" style="background-image:url(<?php echo $image['url'];?>);">
   <div class="container d-table w-100 m-auto h-100">
      <div id="post-<?php the_ID(); ?>" class="d-table-cell align-middle">
         <h3 class="heading-title"><?php the_field('banner_title');?></h3>
         <form name="homesearch" action="<?php bloginfo('url') ?>/buy-a-business/" method="POST">
         <div id="address">
            <div class="row">
              
               <div class="col-lg-5">
                  <input class="form-control" id="business_type" name="business_type" placeholder="Business Type" required>
               </div>
               <div class="col-lg-5">

  <div class="typeahead__container">
            <div class="typeahead__field">
                <div class="typeahead__query">
                  <span class="location_icon"></span>
                 <!--  <input  placeholder="Choose a Location"
                      type="text" class="form-control"> -->

   <input class="js-typeahead form-control" name="searchlocation" type="search"  autocomplete="off" placeholder="Choose a Location" required>
 </div>
               
            </div>
        </div>


                  <!-- <span class="location_icon"></span>
                  <input id="autocomplete" placeholder="Choose a Location"
                     onFocus="geolocate()" type="text" class="form-control"> -->
               </div>
               <div class="col-lg-2">
                  <button type="submit" name="searchsubmit" class="btn btn-danger wrn-btn">Search</button>
               </div>
            
            </div>
         </div>
          </form>
      </div>
   </div>
</div>
<?php endwhile;?>



<section class="business_for_sale_section">
   <div class="container">
      <div class="business_sale_wrapper">
         <div class="business_sale_heading text-center">
            <h2><?php the_field('business_for_sale_title');?></h2>
         </div>
         <div class="row">
            <?php
               $args = array('post_type' => 'buy', 'posts_per_page' => 6, 'order' => 'ASC');
               $query = new WP_Query($args);
               while($query->have_posts()): $query->the_post();
               $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
               ?>
            <div class="col-lg-4 col-md-6">
               <div class="sale_listing">
                  <div class="sale_pic">
                     <a href="<?php the_permalink();?>"><img src="<?php echo esc_url( $large_image_url[0]);?>"></a>
                  </div>
                  <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                  <?php $price = get_post_meta( get_the_ID(), 'bprice', 1 );?>
                  <?php if($price){ ?>
                  <p class="price"><span>Price:</span> $<?php echo $price;?></p>
                  <?php } ?>
                  <!-- <?php $offer_price = get_post_meta( get_the_ID(), '_business_offer_price', 1 );?>
                  <?php if($offer_price){ ?>
                  <p class="price"><span>Price:</span> <?php echo $offer_price;?></p>
                  <?php } ?> -->
                  <p class="location"><span>Location:</span> <?php echo get_post_meta( get_the_ID(), 'country', 1 );?></p>
                  <div class="more_details">
                     <a href="<?php the_permalink();?>">More Details</a>
                  </div>
               </div>
            </div>
            <?php
               endwhile;
               ?>
         </div>
         <div class="view_more text-center">
            <a href="<?php echo site_url();?>/buy-a-business/">View More</a>
         </div>
      </div>
   </div>
</section>
<section class="franchise_opportunity_section">
   <div class="container">
      <div class="franchise_wrapper">
         <?php while(have_posts()): the_post();?>
         <div class="franchise_heading_title text-center">
            <h2><?php the_field('franchise_opportunity_title');?></h2>
         </div>
         <?php endwhile;?>
   
         <div class="flexslider carousel franchise-slider">
          <ul class="slides">
            <?php
            $franchiseopportunity = array('post_type' => 'franchise', 'posts_per_page' => 8, 'order' => 'ASC');
            $franchise = new WP_Query($franchiseopportunity);
            while($franchise->have_posts()): $franchise->the_post();
            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            ?>
            <li>
             <div class="panel panel-default">
               <div class="panel-thumbnail">
                  <a href="<?php the_permalink();?>" title="<?php the_title();?>" class="thumb">
                  <img class="img-fluid mx-auto d-block" src="<?php echo esc_url( $large_image_url[0]);?>" alt="<?php the_title();?>">
                  </a>
               </div>
            </div>
            </li>
            <?php
            $i++;
            endwhile;
            ?>
            
          </ul>
        </div>


      </div>
   </div>
</section>
<section class="recently_added_section">
   <div class="container">
      <div class="business_sale_wrapper">
         <?php while(have_posts()): the_post();?>
         <div class="business_sale_heading text-center">
            <h2><?php the_field('recently_added_business_title');?></h2>
         </div>
         <?php endwhile;?>
         <div class="row">
            <?php
               $recentlbusiness = array('post_type' => 'buy', 'posts_per_page' => 6, 'order' => 'DASC');
               $buy = new WP_Query($recentlbusiness);
               while($buy->have_posts()): $buy->the_post();
               $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
               ?>
            <div class="col-lg-4 col-md-6">
               <div class="sale_listing">
                  <div class="sale_pic">
                     <a href="<?php the_permalink();?>"><img src="<?php echo esc_url( $large_image_url[0]);?>"></a>
                  </div>
                  <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                  <?php $price = get_post_meta( get_the_ID(), 'bprice', 1 );?>
                  <?php if($price){ ?>
                  <p class="price"><span>Price:</span> $<?php echo $price;?></p>
                  <?php } ?>
                  <!-- <?php $offer_price = get_post_meta( get_the_ID(), '_business_offer_price', 1 );?>
                  <?php if($offer_price){ ?>
                  <p class="price"><span>Price:</span> <?php echo $offer_price;?></p>
                  <?php } ?> -->
                  <p class="location"><span>Location:</span> <?php echo get_post_meta( get_the_ID(), 'country', 1 );?></p>
                  <div class="more_details">
                     <a href="<?php the_permalink();?>">More Details</a>
                  </div>
               </div>
            </div>
            <?php
               endwhile;
               ?>
         </div>
         <div class="view_more text-center">
            <a href="<?php echo site_url();?>/buy-a-business/">View More</a>
         </div>
      </div>
   </div>
</section>
<section class="featured_broker_section">
   <div class="container">
      <div class="business_sale_wrapper">
         <?php while(have_posts()): the_post();?>
         <div class="business_sale_heading text-center">
            <h2><?php the_field('featured_broker_title');?></h2>
         </div>
         <?php endwhile;?>
         <div class="row">
            <?php
               $roles = array('broker');
               $users = array();

               foreach($roles as $role){
                   $args = array(
                                'orderby' => 'nicename',
                                'role' => $role,
                                'number' => 6
                                );
                   $current_role_users = get_users($args);
                   $users = array_merge($current_role_users, $users);
               }
                   foreach ($users as $user) {
               ?>
            <div class="col-lg-4 col-md-6">
               <div class="sale_listing">
                  <div class="sale_pic">
                     <?php $images = get_the_author_meta( 'profile_image', $user->ID );
                        $images = explode(',',$images);
                        foreach($images as $img) {
                        ?>
                     <a href="<?php echo get_author_posts_url($user->ID); ?>"><img src="<?php echo wp_get_attachment_url( $img );?>"></a>
                     <?php } ?>
                  </div>
               </div>
            </div>
            <?php 
               } 
               ?>
         </div>
         <div class="view_more text-center">
            <a href="<?php echo site_url();?>/business-broker/">View More</a>
         </div>
      </div>
   </div>
</section>
<?php
   get_footer();
   ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/jquery.flexslider.js"></script>
  <script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 316,
        itemMargin: 5,
        pausePlay: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>
  <script src="<?php bloginfo('template_url');?>/js/jquery.easing.js"></script>
  <script src="<?php bloginfo('template_url');?>/js/jquery.mousewheel.js"></script>
  <script src="<?php bloginfo('template_url');?>/js/demo.js"></script>