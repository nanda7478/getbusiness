<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
		<section class="footer_top_section">
		 <div class="container">
		 	<div class="row">
		 		<div class="footer_sec a">
		 			<div class="footer_logo_add_detail">
                     <div class="footer_log">
                         <?php $image = get_field('footer_logo', 'option');?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $image['url'];?>"></a>
                     </div>
                     <div class="footer_add">
                         <ul>
                             <li><a href="tel:<?php the_field('phone_number', 'option');?>"><?php the_field('phone_number', 'option');?></a></li>
                             <li><a href="mailto:<?php the_field('email_address', 'option');?>"><?php the_field('email_address', 'option');?></a></li>
                             <li><?php the_field('address', 'option');?></li>
                         </ul>
                     </div>
                     <div class="footer_social">
           <ul>
    <li><a href="<?php the_field('facebook_link', 'option');?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
    <li><a href="<?php the_field('twitter_link', 'option');?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
    <li><a href="<?php the_field('instagram_link', 'option');?>" target="_blank"><i class="fab fa-instagram"></i></i></a></li>
    <li><a href="<?php the_field('linkedin_link', 'option');?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
           </ul>
                     </div>           
                    </div>
		 		</div>
		 		<div class="footer_sec b">
		 			<div class="quick_links_menu">
		 				<?php dynamic_sidebar('sidebar-4');?>
		 			</div>
		 		</div>
		 		<div class="footer_sec c">
		 			<div class="buying_menu">
		 				<?php dynamic_sidebar('sidebar-5');?>
		 			</div>
		 		</div>
		 		<div class="footer_sec d">
		 			<div class="selling_menu">
		 				<?php dynamic_sidebar('sidebar-6');?>
		 			</div>
		 		</div>
		 	</div>
		 </div>
		 </section>

		 <section class="footer_bottom_section">
			<div class="container">
			  <div class="row">
				<div class="col-lg-6 col-md-5">
					<div class="copy_right_content">
						&#169;2019 All rights reserved getbusiness
					</div>
				</div>

				<div class="col-lg-6 col-md-7">
					<div class="footer_bottom_menu">
						<ul>
							<li><a href="<?php echo site_url();?>/privacy-policy/">Privacy Policy</a></li>
							<li><a href="<?php echo site_url();?>/cookies-policy/">Cookies Policy</a></li>
							<li><a href="<?php echo site_url();?>/terms-and-conditions/">Terms and Conditions</a></li>
						</ul>
					</div>
				</div>

			  </div>
			</div>
		</section>

		</footer><!-- .site-footer -->
		
	</div><!-- .site-inner -->
</div><!-- .site -->
<?php wp_footer(); ?>
<?php if(is_front_page()){ ?>
<style>
@media (min-width: 768px) {

    /* show 3 items */
    .carousel-inner .active,
    .carousel-inner .active + .carousel-item,
    .carousel-inner .active + .carousel-item + .carousel-item,
    .carousel-inner .active + .carousel-item + .carousel-item + .carousel-item  {
        display: block;
    }
    
    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item,
    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item,
    .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item + .carousel-item {
        transition: none;
    }
    
    .carousel-inner .carousel-item-next,
    .carousel-inner .carousel-item-prev {
      position: relative;
      transform: translate3d(0, 0, 0);
    }
    
    .carousel-inner .active.carousel-item + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
        position: absolute;
        top: 0;
        right: -25%;
        z-index: -1;
        display: block;
        visibility: visible;
    }
    
    /* left or forward direction */
    .active.carousel-item-left + .carousel-item-next.carousel-item-left,
    .carousel-item-next.carousel-item-left + .carousel-item,
    .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item,
    .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item,
    .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(-100%, 0, 0);
        visibility: visible;
    }
    
    /* farthest right hidden item must be abso position for animations */
    .carousel-inner .carousel-item-prev.carousel-item-right {
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        display: block;
        visibility: visible;
    }
    
    /* right or prev direction */
    .active.carousel-item-right + .carousel-item-prev.carousel-item-right,
    .carousel-item-prev.carousel-item-right + .carousel-item,
    .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item,
    .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item,
    .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
        position: relative;
        transform: translate3d(50%, 0, 0);
        visibility: visible;
        display: block;
        visibility: visible;
    }

}

</style>
<?php }?>

<script src="<?php bloginfo('template_url');?>/js/jquery-slim.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/custom.js"></script>
<script src="<?php bloginfo('template_url');?>/js/jquery.typeahead.js"></script>

<?php if(is_front_page()){ ?>
<script type="text/javascript">
$('#myCarousel').on('slide.bs.carousel', function (e) {

  
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 4;
    var totalItems = $('.carousel-item').length;
    
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});


  $('#myCarousel').carousel({ 
                interval: 2000
        });

  </script>
  <?php } ?>

 <script>
        $.typeahead({
            input: ".js-typeahead",
            minLength: 0,
            order: "asc",
            searchOnFocus: true,
            source: {
                groupName: {
                    data: ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda",
                "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh",
                "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia",
                "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burma",
                "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Central African Republic", "Chad",
                "Chile", "China", "Colombia", "Comoros", "Congo, Democratic Republic", "Congo, Republic of the",
                "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti",
                "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador",
                "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Gabon",
                "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guatemala", "Guinea",
                "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India",
                "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan",
                "Kazakhstan", "Kenya", "Kiribati", "Korea, North", "Korea, South", "Kuwait", "Kyrgyzstan", "Laos",
                "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg",
                "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands",
                "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Mongolia", "Morocco", "Monaco",
                "Mozambique", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger",
                "Nigeria", "Norway", "Oman", "Pakistan", "Panama", "Papua New Guinea", "Paraguay", "Peru",
                "Philippines", "Poland", "Portugal", "Romania", "Russia", "Rwanda", "Samoa", "San Marino",
                "Sao Tome", "Saudi Arabia", "Senegal", "Serbia and Montenegro", "Seychelles", "Sierra Leone",
                "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain",
                "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan",
                "Tajikistan", "Tanzania", "Thailand", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey",
                "Turkmenistan", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States",
                "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"]
                }
            },
           
           
        });
    </script>
 
</body>
</html>
