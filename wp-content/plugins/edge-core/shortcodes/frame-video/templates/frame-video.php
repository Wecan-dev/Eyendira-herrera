<div class="edge-frame-video-holder">

	<?php $videoHolder = get_template_directory_uri() . "/assets/img/laptop_video.png"; ?>

	<div class="edge-frame-image-holder">
		<img src="<?php echo adorn_edge_get_module_part($videoHolder); ?>" alt="<?php esc_attr_e('Video holder image', 'edge-core'); ?>" />
	</div>

	<video width="725" autoplay loop>
	  <source src="<?php echo esc_url($video_link); ?>" type="video/mp4">
	</video>
</div>