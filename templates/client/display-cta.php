<?php
$post_id = $args['id'];

$desktop_image_id = get_field( 'cta_desktop_image', $post_id );
$mobile_image_id = get_field( 'cta_mobile_image', $post_id );
$link = get_field( 'cta_link', $post_id );

?>
<div>
	<a href="<?php echo $link['url'] ?>">
		<div class="w-full max-md:hidden md:block">
			<?php echo wp_get_attachment_image( $desktop_image_id, 'full' ) ?>
		</div>

		<div class="w-full max-md:block md:hidden">
			<?php echo wp_get_attachment_image( $mobile_image_id, 'full' ) ?>
		</div>
	</a>
</div>