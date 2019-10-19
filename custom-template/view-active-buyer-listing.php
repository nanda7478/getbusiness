<?php
/*
 Display Template Name: View Active Buyer Listing
*/
 if(!is_user_logged_in()){
 	wp_redirect ( home_url("/") );
 }
$userID = get_current_user_id();
get_header();
?>
<section class="view_active_buyer_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
			<?php if(current_user_can( 'broker' ) || current_user_can( 'seller' ) ) { ?>
    <div class="list-group ">
              <a href="<?php echo site_url();?>/my-account/" class="list-group-item list-group-item-action active"><?php echo esc_html__('My Account', 'Get Business');?></a>
              <a href="#" class="list-group-item list-group-item-action"><?php echo esc_html__('My Properties', 'Get Business');?></a>
              <a href="<?php echo site_url();?>/sell-a-franchise/" class="list-group-item list-group-item-action"><?php echo esc_html__('Sell a Franchise', 'Get Business');?></a>
              <a href="<?php echo site_url();?>/membership/" class="list-group-item list-group-item-action"><?php echo esc_html__('Membership', 'Get Business');?></a>
             <a href="<?php echo site_url();?>/view-invoices/" class="list-group-item list-group-item-action"><?php echo esc_html__('Invoice', 'Get Business');?></a>
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
               <?php
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
            $query = new WP_Query(
            	array(
                	'post_type' => 'active-buyer',
                	'author' => $userID,
                    'paged' => $paged,
                	'posts_per_page' => -1,
                	'post_status' => array('publish', 'pending', 'draft'),
                	'order' => 'DASC'
            	)
            ); 
			
			?>
            <?php 
            if($query->have_posts()) : 
            while($query->have_posts()) : $query->the_post();
            ?>
            <?php
            $author_id = get_the_author_meta('ID');
            $image = get_field('profile_image', 'user_'. $author_id );
             ?>
				<div class="active-buyer-listings">
				<div class="buyer-listing">
				<div class="buyer-pic"> <img src=" <?php echo $image['url'];?>"></div>
				<div class="looking-for">
				<div class="title"><a href="<?php the_permalink();?>"> <?php the_title();?></a> </div>
				<div class="active_buyer_summary">
					<?php the_field('my_requirement');?>
				</div>
				</div>
				</div>
                <div class="edit_views_button">
                
                <ul>
                <?php $edit_post = add_query_arg('activebuyer', get_the_ID(), 'http://demosrvr.com/wp/getabusiness/edit-active-buyer-listing/'); ?>
                <li>
                
				<!-- <a href="<?php echo site_url();?>/edit-active-buyer-listing/?activebuyer = <?php echo the_ID();?>"><i class="fa fa-edit"></i></a> -->
				<a class="btn edit-listing" href="<?php echo $edit_post; ?>" data-tooltip="<?php _e('Edit','contempo'); ?>"><i class="fa fa-edit"></i></a>
				</li>
                <li>
				<a href="<?php the_permalink();?>"><i class="fa fa-eye"></i></a>
				</li>
				<li>
			<?php if( current_user_can( 'delete_post' ) ) : ?>
		<?php $nonce = wp_create_nonce('my_delete_post_nonce') ?>
		<a href="<?php echo admin_url( 'admin-ajax.php?action=my_delete_post&id=' . get_the_ID() . '&nonce=' . $nonce ) ?>" data-id="<?php the_ID() ?>" data-nonce="<?php echo $nonce ?>" class="delete-post"><i class="fas fa-trash"></i></a>
	<?php endif ?>
				</li>
				</ul>
                </div>

				</div>
           <?php endwhile; ?>
            <?php endif; wp_reset_postdata(); ?>


			</div>

		</div>
	</div>
</section>

<?php
get_footer();
?>
<script type="text/javascript">
wp_localize_script( 'my_script', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	jQuery( document ).ready( function($) {
	$(document).on( 'click', '.delete-post', function() {
		var id = $(this).data('id');
		var nonce = $(this).data('nonce');
		var post = $(this).parents('.post:first');
		$.ajax({
			type: 'post',
			url: MyAjax.ajaxurl,
			data: {
				action: 'my_delete_post',
				nonce: nonce,
				id: id
			},
			success: function( result ) {
				if( result == 'success' ) {
					post.fadeOut( function(){
						post.remove();
					});
				}
			}
		})
		return false;
	})
})
</script>