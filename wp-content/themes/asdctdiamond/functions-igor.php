<?php
function form_subscribe_shortcode($atts, $content) {
	$a = shortcode_atts(array(
		'id' => '',
	), $atts);
	ob_start();
	?>
	<div class="form-subscribe-sc">
		<?php echo do_shortcode('[yikes-mailchimp form="'.$a['id'].'"]'); ?>
	</div>
	<?php

	return ob_get_clean();
}
add_shortcode('vc-form-subscribe', 'form_subscribe_shortcode');
add_action('vc_before_init', 'formSubscribeVC');
function formSubscribeVC() {
	vc_map(array(
			"name" => "Form Subscribe",
			"base" => "vc-form-subscribe",
			"class" => "vc-form-subscribe",
			"category" => "Content",
			"icon" => "asdc-vc-sc",
			"params" => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Form ID',
					'param_name' => 'id',
					'value' => '',
					'description' => ''
				),
			)
		)
	);
}
?>