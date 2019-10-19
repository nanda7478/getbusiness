<?php
/**
 * Template Name: Membership
 *
 * @package WP Pro Real Estate 7
 * @subpackage Template
 */

if (session_status() == PHP_SESSION_NONE) { session_start(); } 
if(!is_user_logged_in()){
  wp_redirect ( home_url("/") );  
 }
global $ct_options; 

$ct_membership = isset( $ct_options['ct_membership'] ) ? esc_html( $ct_options['ct_membership'] ) : '';
$ct_package_list = isset( $ct_options['ct_package_list'] ) ? esc_html( $ct_options['ct_package_list'] ) : '';
$inside_page_title = get_post_meta($post->ID, "_ct_inner_page_title", true);
$edit = $ct_options['ct_edit'];
$userID = get_current_user_id();

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

if($inside_page_title == "Yes") { 
	// Custom Page Header Background Image
	if(get_post_meta($post->ID, '_ct_page_header_bg_image', true) != '') {
		echo'<style type="text/css">';
		echo '#single-header { background: url(';
			echo get_post_meta($post->ID, '_ct_page_header_bg_image', true);
		echo ') no-repeat center center; background-size: cover;}';
		echo '</style>';
	} ?>

	<!-- Single Header -->
	<div id="single-header">
		<div class="dark-overlay">
			<div class="container">
				<h1 class="marT0 marB0"><?php the_title(); ?></h1>
				<?php if(get_post_meta($post->ID, '_ct_page_sub_title', true) != '') { ?>
					<h2 class="marT0 marB0"><?php echo get_post_meta($post->ID, "_ct_page_sub_title", true); ?></h2>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- //Single Header -->
<?php }

endwhile; endif; ?>

<div class="container marT30">
<div class="row">
	<div class="col-lg-3">
			<?php if(current_user_can( 'broker' ) || current_user_can( 'seller' ) ) { ?>
    <div class="list-group ">
              <a href="<?php echo site_url();?>/my-account/" class="list-group-item list-group-item-action active"><?php echo esc_html__('My Account', 'Get Business');?></a>
              <a href="<?php echo site_url();?>/my-properties/" class="list-group-item list-group-item-action"><?php echo esc_html__('My Properties', 'Get Business');?></a>
              <a href="<?php echo site_url();?>/add-bussiness/" class="list-group-item list-group-item-action"><?php echo esc_html__('Add Business', 'Add Business');?></a>
              <a href="<?php echo site_url();?>/sell-a-franchise/" class="list-group-item list-group-item-action"><?php echo esc_html__('Sell a Franchise', 'Get Business');?></a>
              <!-- <a href="#" class="list-group-item list-group-item-action">
              <?php //echo esc_html__('Messages', 'Get Business');?>
              </a> -->
              <a href="<?php echo site_url();?>/membership/" class="list-group-item list-group-item-action"><?php echo esc_html__('Membership', 'Get Business');?></a>
             <a href="<?php echo site_url();?>/view-invoices/" class="list-group-item list-group-item-action"><?php echo esc_html__('Invoice', 'Get Business');?></a>
             <a href="<?php echo site_url();?>/view-franchise-listing/" class="list-group-item list-group-item-action"><?php echo esc_html__('View Franchise Listing', 'Get Business');?></a>
              <a href="<?php echo get_author_posts_url($current_user->ID); ?>" class="list-group-item list-group-item-action"><?php echo esc_html__('User Profile', 'Get Business');?></a>

              <a href="<?php echo wp_logout_url(home_url('/'));?>" class="list-group-item list-group-item-action"><?php echo esc_html__('Log out', 'Get Business');?></a>

            </div>
            <?php } elseif(current_user_can( 'administrator' )) { ?>
            <a href="<?php echo site_url();?>/my-account/" class="list-group-item list-group-item-action active"><?php echo esc_html__('My Account', 'Get Business');?></a>
              
              <a href="<?php echo wp_logout_url(home_url('/'));?>" class="list-group-item list-group-item-action"><?php echo esc_html__('Log out', 'Get Business');?></a>
            <?php } else { ?>
            <a href="<?php echo site_url();?>/my-account/" class="list-group-item list-group-item-action active"><?php echo esc_html__('My Account', 'Get Business');?></a>
            <a href="<?php echo site_url();?>/membership/" class="list-group-item list-group-item-action"><?php echo esc_html__('Membership', 'Get Business');?></a>
             <a href="<?php echo site_url();?>/view-invoices/" class="list-group-item list-group-item-action"><?php echo esc_html__('Invoice', 'Get Business');?></a>
            
            <a href="<?php echo site_url();?>/add-active-buyer-listing/" class="list-group-item list-group-item-action"><?php echo esc_html__('Add Buyer Listing', 'Get Business');?></a>
            <a href="<?php echo site_url();?>/view-active-buyer-listing/" class="list-group-item list-group-item-action"><?php echo esc_html__('View Buyer Listing', 'Get Business');?></a>
              
              <a href="<?php echo wp_logout_url(home_url('/'));?>" class="list-group-item list-group-item-action"><?php echo esc_html__('Log out', 'Get Business');?></a>
            <?php } ?>	
			</div>

<div class="col-lg-9">
    <article class="col <?php if(is_user_logged_in()) { echo 'span_9'; } else { echo 'span_12 first'; } ?> marB60">

        <?php if(!is_user_logged_in()) {
                echo '<div class="inner-content">';
	                	echo '<div class="must-be-logged-in">';
		                    echo '<h4 class="center marB20">' . __('You must be logged in to view this page.', 'contempo') . '</h4>';
		                    echo '<p class="center login-register-btn marB0"><a class="btn login-register" href="http://demosrvr.com/wp/getabusiness/buyer-register/">Login/Register</a></p>';
	                echo '</div>';
                echo '</div>';
            } else { ?>

               <?php the_content(); ?>
        
            <div class="clear"></div>
            
        <?php } ?>

    </article>
</div>
	</div>
		<div class="clear"></div>

</div>

<?php get_footer(); ?>