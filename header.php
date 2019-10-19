<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php endif; ?>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/css/responsive.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/css/flexslider.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/css/jquery.typeahead.css">
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<div class="site-inner">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
	<div class="top_bar">
	<div class="container">
		<div class="row">
		<div class="col-6">
			<div class="top_contact">
					<ul>
						<li><a href="callto:<?php the_field('phone_number', 'option');?>"> <?php the_field('phone_number', 'option');?></a></li>
						<li><a href="mailto:<?php the_field('email_address', 'option');?>"> <?php the_field('email_address', 'option');?></a></li>
					</ul>
			 </div>
		</div>
		<div class="col-6">
			<!-- <div class="top_social">
				<ul>
					<li> <a href="#"><i class="fab fa-facebook-f"></i></a></li>
					<li> <a href="#"><i class="fab fa-twitter"></i></a></li>
					<li> <a href="#"><i class="fab fa-instagram"></i></i></a></li>
					<li> <a href="#"><i class="fab fa-linkedin-in"></i></a></li>
				</ul>

			 </div> -->



<div class="login_addlisting_section">
<ul>
<?php
global $current_user;
?>
<?php if(is_user_logged_in()){ ?>
	               <li>Hi <?php echo $current_user->first_name;?></li>
                	<li><a href="<?php echo site_url();?>/my-account/">| My Account</a></li>
                	<li><a href="<?php echo wp_logout_url(home_url('/'));?>">| Log out</a></li>
                	<?php } else { ?>
                		<li><a href="<?php echo get_bloginfo('url') ?>/login/">LOGIN </a></li>
                		<li><a href="<?php echo get_bloginfo('url') ?>/buyer-register/">/ SIGN UP</a></li>
                		<?php } ?>
</ul>
</div>




		</div>
	</div>
</div>
</div>                  
<div class="site-header-main">
             <div class="container">
               <div class="row">
               <div class="col-md-4 col-lg-3 col-6">
               <?php if(is_front_page()){ ?>
				<div class="site-branding home_page_logo">
				<?php $image = get_field('header_logo', 'option');?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $image['url'];?>"></a>
				</div><!-- .site-branding -->
				<div class="site-branding inner_page_logo sticky_logo">
				<?php $image = get_field('inner_page_header_logo', 'option');?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $image['url'];?>"></a>
				</div><!-- .site-branding -->
				<?php } else { ?>
                <div class="site-branding inner_page_logo">
				<?php $image = get_field('inner_page_header_logo', 'option');?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $image['url'];?>"></a>
				</div><!-- .site-branding -->
				<?php } ?>
                 </div>
                 <div class="col-md-8 col-lg-9 col-6">
                  <div class="menu_section_business">
				<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
					<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'twentysixteen' ); ?></button>

					<div id="site-header-menu" class="site-header-menu">
						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'primary',
											    'menu_class' => 'primary-menu',
										)
									);
								?>
							    </nav><!-- .main-navigation -->
						        <?php endif; ?>

		<?php if ( has_nav_menu( 'social' ) ) : ?>
		<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'twentysixteen' ); ?>">
						           <?php
									wp_nav_menu(
										array(
											'theme_location' => 'social',
											'menu_class'  => 'social-links-menu',
											'depth'       => 1,
											'link_before' => '<span class="screen-reader-text">',
											'link_after'  => '</span>',
										)
									);
								?>
							</nav><!-- .social-navigation -->
						<?php endif; ?>
					</div><!-- .site-header-menu -->
				<?php endif; ?>
                </div>

                <div class="addlisting_section">  
                <ul>
                <?php if(is_user_logged_in()){ ?>
                <li>
                <a class="btn" href="<?php echo site_url();?>/add-bussiness/">Sell a Business</a>
              </li>
                <?php
                } else {
                ?>
               <li>
                <a class="btn" href="<?php echo site_url();?>/sell-a-business/">Sell a Business</a>
              </li>
          <?php } ?>
<li class="side-bar"><span onclick="openNav()">&#9776;</span> </li>

</ul>      
</div>
<div id="mySidenav" class="sidenav">
	<div class="side_content">
                            <div class="notification-close">
                                 <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            </div>
                           <div class="side_top"> <h4>Get quick support</h4>
                            <p><i class="fas fa-envelope"></i> <?php the_field('email_address', 'option');?></p>
                            <p><i class="fas fa-phone-volume"></i> <?php the_field('phone_number', 'option');?></p>
                            <p><i class="fas fa-map-marker-alt"></i> <?php the_field('address', 'option');?></p>
                          </div>
     	<div id="site-header-menu" class="site-header-menu mobile_menu">
     		  <h4>Get Started</h4>
						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'primary',
											    'menu_class' => 'primary-menu',
										)
									);
								?>
							    </nav><!-- .main-navigation -->
						        <?php endif; ?>

		<?php if ( has_nav_menu( 'social' ) ) : ?>
		<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'twentysixteen' ); ?>">
						           <?php
									wp_nav_menu(
										array(
											'theme_location' => 'social',
											'menu_class'  => 'social-links-menu',
											'depth'       => 1,
											'link_before' => '<span class="screen-reader-text">',
											'link_after'  => '</span>',
										)
									);
								?>
							</nav><!-- .social-navigation -->
						<?php endif; ?>
					</div>



                            <h4>Subscribe Now</h4>
                            
                            <form method="post" action="http://demosrvr.com/wp/getabusiness/?na=s" onsubmit="return newsletter_check(this)">
                            <input type="hidden" name="nlang" value="">
                            <input type="text" class="form-control" placeholder="Enter email" name="ne" required>
                            <input class="btn" type="submit" value="Subscribe">
                            </form>
                            <h4>social</h4>
                         <ul class="top-social">
    <li><a href="<?php the_field('facebook_link', 'option');?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
    <li><a href="<?php the_field('twitter_link', 'option');?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
    <li><a href="<?php the_field('instagram_link', 'option');?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
    <li><a href="<?php the_field('linkedin_link', 'option');?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
           </ul>
</div>
</div>
                </div>
                 </div>
              </div>
             </div>
			</div><!-- .site-header-main -->
			<?php if (get_header_image()) : ?>
				<?php
					/**
					 * Filter the default twentysixteen custom header sizes attribute.
					 *
					 * @since Twenty Sixteen 1.0
					 *
					 * @param string $custom_header_sizes sizes attribute
					 * for Custom Header. Default '(max-width: 709px) 85vw,
					 * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
					 */
			$custom_header_sizes = apply_filters( 'twentysixteen_custom_header_sizes', '(max-width: 709px) 85vw, 
						(max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );?>
	   <div class="header-image">
       <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	   <img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
	   </a>
	   </div><!-- .header-image -->
			<?php endif; // End header image check. ?>
	

		</header><!-- .site-header -->
		<div id="content" class="site-content">
			




