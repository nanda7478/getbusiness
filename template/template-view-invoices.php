<?php
/**
 * Template Name: Invoices
 *
 * @package WP Pro Real Estate 7
 * @subpackage Template
 */
 
global $ct_options; 

$submit_listing = isset( $ct_options['ct_submit'] ) ? esc_html( $ct_options['ct_submit'] ) : '';
$inside_page_title = get_post_meta($post->ID, "_ct_inner_page_title", true);
$edit = $ct_options['ct_edit'];
$userID = get_current_user_id();

$ct_currency_placement = $ct_options['ct_currency_placement'];

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
              <a href="#" class="list-group-item list-group-item-action">
              <?php echo esc_html__('Messages', 'Get Business');?>
              </a>
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
                        echo '<p class="center login-register-btn marB0"><a class="btn login-register" href="#">Login/Register</a></p>';
                    echo '</div>';
                echo '</div>';

        } else {

            global $current_user;
            $current_user = wp_get_current_user();
            $current_user_ID = $current_user->ID;
            $today = strtotime(date("Y-m-d"));

            $args = array(
                'post_type'         => 'package_order',
                'author__in'        => $current_user_ID,
                'posts_per_page'    => -1,
            );
            $wp_query = new wp_query($args); 
        
            if (!$wp_query->have_posts()) :

                echo '<p class="nomatches"><strong>' . __('No Orders', 'contempo') . '</p>';

            elseif($wp_query->have_posts()) : ?>

                <table>
                    <thead>
                        <tr>
                            <th><?php _e('Invoice', 'contempo'); ?></th>
                            <th><?php _e('Package', 'contempo'); ?></th>
                            <th><?php _e('Start', 'contempo'); ?></th>
                            <th><?php _e('Expire', 'contempo'); ?></th>
                            <th><?php _e('Recurring', 'contempo'); ?></th>
                            <th><?php _e('Status', 'contempo'); ?></th>
                            <th><?php _e('Total', 'contempo'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($wp_query->have_posts() ) : $wp_query->the_post();
                            $package_name = get_post_meta($post->ID, 'package_name', true);
                            $package_current_date = strtotime(get_post_meta($post->ID, 'package_current_date', true));
                            $package_expire_date = strtotime(get_post_meta($post->ID, 'package_expire_date', true));
                            $package_recurring = get_post_meta($post->ID, 'pack_recurring', true);
                            $payment_amount = get_post_meta($post->ID, 'payment_amount', true);
                        ?>
                            <tr>
                                <td><?php echo $post->ID; ?></td>
                                <td><?php echo $package_name; ?></td>
                                <td><?php if(!empty($package_current_date)) { echo date('n/j/Y', $package_current_date); } else { echo '-'; } ?></td>
                                <td><?php if(!empty($package_expire_date)) { echo date('n/j/Y', $package_expire_date); } else { echo '-'; } ?></td>
                                <td><?php if($package_recurring == 'Yes') { echo '<span class="package-recurring">' . __('Yes', 'contempo') . '</span>'; } else { echo '<span class="package-not-recurring">' . __('No', 'contempo') . '</span>'; } ?></td>
                                <td><?php if($today >= strtotime(get_post_meta($post->ID, 'package_expire_date', true))) { echo '<span class="package-expired">' . __('Expired', 'contempo') . '</span>'; } else { echo '-'; } ?></td>
                                <td>
                                <?php
                                if(is_numeric($payment_amount)) {
                                    if($ct_currency_placement == 'after') { 
                                        echo $payment_amount; ct_currency();
                                    } else {
                                        ct_currency(); echo $payment_amount; 
                                    }
                                } else { 
                                    _e('-', 'contempo');
                                } ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            <?php endif; wp_reset_postdata(); ?>
            
        <?php } ?>

    </article>
</div>
	</div>
		<div class="clear"></div>

</div>

<?php get_footer(); ?>