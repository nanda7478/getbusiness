<?php
include_once('../../../wp-config.php');
include_once('../../../wp-load.php');

if ( ! function_exists( 'wp_handle_upload' ) ) {
	require_once ( ABSPATH . 'wp-admin/includes/file.php' );
}
// Include image.php
require_once(ABSPATH . 'wp-admin/includes/image.php');

if($_FILES['uploadfile']['error'] == 0) {

	$uploadedfile = $_FILES['uploadfile'];
	$upload_overrides = array( 'test_form' => false );
	$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

	if ( $movefile && !isset( $movefile['error'] ) ) {
		
		/* set featured image */
		$wp_filetype = $movefile['type'];
		$filename = $movefile['file'];
		$wp_upload_dir = wp_upload_dir();
		$attachment = array(
			'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
			'post_mime_type' => $wp_filetype,
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
			'post_content' => '',
			'post_status' => 'inherit'
		);

		$attach_id = wp_insert_attachment( $attachment, $filename );
		$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		// Update post
		$my_att_post = array( 'ID' => $attach_id, 'guid ' => $movefile['url'] );
		wp_update_post( $my_att_post );

		$attachdata = wp_get_attachment_image_src($attach_id, 'thumbnail' );
		echo '<div class="col-lg-4 col-md-4 col-sm-4" id="'.$attach_id.'">';
			echo '<a href="javascript:void(0)" class="thumbnail">';
				echo '<img class="img-thumbnail img-responsive" src="'.$attachdata[0].'">';
				echo '<label class="radio text-center"><input type="radio" value="'.$attach_id.'" name="featured_image" checked>Featured</label>';
				echo '<input type="hidden" value="'.$attach_id.'" name="image_array[]">';
			echo '</a>';
			echo '<i class="fa fa-times-circle fa-2x deleteimg" data-id="'.$attach_id.'" aria-hidden="true"></i>';
		echo '</div>';
	} else {
		echo "error";
	}
} else {
	echo "error";
}
die;
?>