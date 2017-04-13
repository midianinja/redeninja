<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'divi', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('Fjalla_one_font','https://fonts.googleapis.com/css?family=Fjalla+One');
	wp_enqueue_script( 'divi', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery', 'divi-custom-script' ), '0.1.2', true );
}

function modify_user_contact_methods( $user_contact ) {
	$user_contact['avatar']   = __( 'Avatar Image Link'   );
	$user_contact['facebook']   = __( 'Facebook Link'   );
	$user_contact['twitter'] = __( 'Twitter Link' );
	$user_contact['youtube']   = __( 'Youtube Link'   );
	$user_contact['instagram'] = __( 'Instagram Link' );
	$user_contact['video'] = __( 'Video Link' );

	return $user_contact;
}
add_filter( 'user_contactmethods', 'modify_user_contact_methods' );

function custom_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
	$user = false;

	if ( is_numeric( $id_or_email ) ) {

		$id = (int) $id_or_email;
		$user = get_user_by( 'id' , $id );

	} elseif ( is_object( $id_or_email ) ) {

		if ( ! empty( $id_or_email->user_id ) ) {
			$id = (int) $id_or_email->user_id;
			$user = get_user_by( 'id' , $id );
		}

	} else {
		$user = get_user_by( 'email', $id_or_email );
	}

	if ( $user && is_object( $user ) ) {

		$avatar = get_the_author_meta('avatar',$user->ID);
		$avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";

	}

	return $avatar;
}
add_filter( 'get_avatar' , 'custom_avatar' , 1 , 5 );

function nj_add_fullwidth_body_class( $classes ){
	$blacklist = array( 'et_right_sidebar');

	$classes[] = 'et_full_width_page';
	$classes[] = 'et_pb_pagebuilder_layout';
	$classes[] = 'et_fullwidth_nav';
	$classes = array_diff($classes,$blacklist);




	return $classes;
}
add_filter( 'body_class', 'nj_add_fullwidth_body_class' , 11);


function nj_infinite_scrolling(){
	wp_register_script(
		'infinite_scrolling',
		get_stylesheet_directory_uri().'/js/jquery.jscroll.min.js',
		array('jquery'),
		null,
		true
		);
	if(is_singular()){
		wp_enqueue_script('infinite_scrolling');
	}
}

add_action('wp_enqueue_scripts', 'nj_infinite_scrolling');

function set_infinite_scrolling(){
	if(is_singular()){
		?>
		<script type="text/javascript">
		jQuery('#content-area').jscroll({
			loadingHtml: '<div class="container" style="text-align: center;"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loading.gif" alt="Carregando" /></div>',
			padding: 20,
			nextSelector: 'nav.post-nav .nav-link-previous a',
			contentSelector: '#content-area',
			callback: function(a,b) { jQuery( document.body ).trigger( 'post-load' ); FB.XFBML.parse(jQuery("article:last")[0]); }
		});

		</script>
		<?php
	}
}

add_action( 'wp_footer', 'set_infinite_scrolling',100);

function nj_destaque_slider($speed)
{


	$slider_speed = 5000;
	$slider_font_size = "200%";
	$string = '';
	$string .= '<div class="destaque_slider">[et_pb_section bb_built="1" admin_label="section" transparent_background="off" allow_player_pause="off" inner_shadow="off" parallax="off" parallax_method="on" custom_padding="0px|0px|0px|0px" padding_mobile="off" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" make_equal="off" use_custom_gutter="off" fullwidth="off" specialty="off" disabled="off"][et_pb_row admin_label="row" make_fullwidth="on" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" use_custom_gutter="on" gutter_width="1" custom_padding="0px|0px|87px|0px" padding_mobile="off" allow_player_pause="off" parallax="off" parallax_method="on" make_equal="off" column_padding_mobile="on" parallax_1="off" parallax_method_1="on" parallax_2="off" parallax_method_2="on" parallax_3="off" parallax_method_3="on" parallax_4="off" parallax_method_4="on" custom_padding_last_edited="on|desktop" disabled="off"][et_pb_column type="1_3"]<div id="destaque1">[et_pb_slider admin_label="Deslizante" show_arrows="off" show_pagination="on" auto="on" auto_speed="'.$slider_speed.'" auto_ignore_hover="off" parallax="off" parallax_method="off" remove_inner_shadow="off" background_position="default" background_size="default" top_padding="30px" bottom_padding="30px" hide_content_on_mobile="off" hide_cta_on_mobile="off" show_image_video_mobile="on" header_font_size="29px" header_font_size_phone="30px" header_letter_spacing="16px" header_line_height="1.4em" body_font_size_tablet="12px" body_font_size_phone="11px" body_line_height="1.8em" custom_button="off" button_text_size="20" button_letter_spacing="0" button_use_icon="default" button_icon_placement="right" button_on_hover="on" button_letter_spacing_hover="0" disabled="off" saved_tabs="all"]';
	$categoria = get_category_by_slug('destaque1');
	if (($categoria) && ($categoria->count > 0))
	{
		$args = array(
			'numberposts' => 5,
			'category' => $categoria->term_id,
			'post_type' => 'post'
			);
	}
	else
	{
		$args = array(
			'numberposts' => 5,
			'post_type' => 'post'
			);
	}
	$destaques = get_posts($args);
	foreach ($destaques as $destaque) {
		$author_ID = $destaque->post_author;
		$string .= '[et_pb_slide heading="'.get_the_author_meta('display_name',$author_ID).'" button_text="Ver agora" button_link="'.get_post_permalink($destaque->ID).'" background_image="'.get_the_post_thumbnail_url($destaque->ID).'" background_position="default" background_size="default" background_color="#ffffff" use_bg_overlay="on" bg_overlay_color="rgba(0,0,0,0.38)" use_text_overlay="off" alignment="center" background_layout="dark" allow_player_pause="off" text_border_radius="0px" header_font="Roboto Condensed|on||on|" header_font_size="27px" header_font_size_tablet="27px" header_font_size_phone="27px" header_letter_spacing="0px" header_letter_spacing_tablet="0px" header_letter_spacing_phone="0px" body_font="Roboto Condensed|on|||" body_font_size="'.$slider_font_size.'" body_font_size_tablet="'.$slider_font_size.'" body_font_size_phone="'.$slider_font_size.'" body_line_height="1em" body_line_height_tablet="1em" body_line_height_phone="1em" custom_button="on" button_text_size="12px" button_border_width="1px" button_border_radius="1px" button_letter_spacing="1px" button_font="Droid Sans|||on|" button_use_icon="off" button_icon="" button_icon_placement="left" button_on_hover="on" button_border_radius_hover="1px" button_letter_spacing_hover="1px" button_text_size_tablet="12px" button_text_size_phone="12px" button_letter_spacing_tablet="1px" button_letter_spacing_phone="1px" button_letter_spacing_hover_tablet="1px" button_letter_spacing_hover_phone="1px" disabled="off"]'.$destaque->post_title.'[/et_pb_slide]';
	}
	$string .= '[/et_pb_slider]</div>[/et_pb_column][et_pb_column type="1_3"]<div id="destaque2">[et_pb_slider admin_label="Deslizante" show_arrows="off" show_pagination="on" auto="on" auto_speed="'.$slider_speed.'" auto_ignore_hover="off" parallax="off" parallax_method="off" remove_inner_shadow="off" background_position="default" background_size="default" top_padding="100px" bottom_padding="100px" hide_content_on_mobile="off" hide_cta_on_mobile="off" show_image_video_mobile="on" header_font_size="29px" header_font_size_phone="30px" header_letter_spacing="16px" header_line_height="1.4em" body_font_size_tablet="12px" body_font_size_phone="11px" body_line_height="1.8em" custom_button="off" button_text_size="20" button_letter_spacing="0" button_use_icon="default" button_icon_placement="right" button_on_hover="on" button_letter_spacing_hover="0" disabled="off" saved_tabs="all"]';
	$categoria = get_category_by_slug('destaque2');
	if (($categoria) && ($categoria->count > 0))
	{
		$args = array(
			'numberposts' => 5,
			'category' => $categoria->term_id,
			'post_type' => 'post'
			);
	}
	else
	{
		$args = array(
			'numberposts' => 5,
			'post_type' => 'post'
			);
	}
	$destaques = get_posts($args);
	foreach ($destaques as $destaque) {
		$author_ID = $destaque->post_author;
		$string .= '[et_pb_slide heading="'.get_the_author_meta('display_name',$author_ID).'" button_text="Ver agora" button_link="'.get_post_permalink($destaque->ID).'" background_image="'.get_the_post_thumbnail_url($destaque->ID).'" background_position="default" background_size="default" background_color="#ffffff" use_bg_overlay="on" bg_overlay_color="rgba(0,0,0,0.38)" use_text_overlay="off" alignment="center" background_layout="dark" allow_player_pause="off" text_border_radius="0px" header_font="Roboto Condensed|on||on|" header_font_size="27px" header_font_size_tablet="27px" header_font_size_phone="27px" header_letter_spacing="0px" header_letter_spacing_tablet="0px" header_letter_spacing_phone="0px" body_font="Roboto Condensed|on|||" body_font_size="'.$slider_font_size.'" body_font_size_tablet="'.$slider_font_size.'" body_font_size_phone="'.$slider_font_size.'" body_line_height="1em" body_line_height_tablet="1em" body_line_height_phone="1em" custom_button="on" button_text_size="12px" button_border_width="1px" button_border_radius="1px" button_letter_spacing="1px" button_font="Droid Sans|||on|" button_use_icon="off" button_icon="" button_icon_placement="left" button_on_hover="on" button_border_radius_hover="1px" button_letter_spacing_hover="1px" button_text_size_tablet="12px" button_text_size_phone="12px" button_letter_spacing_tablet="1px" button_letter_spacing_phone="1px" button_letter_spacing_hover_tablet="1px" button_letter_spacing_hover_phone="1px" disabled="off"]'.$destaque->post_title.'[/et_pb_slide]';
	}
	$string .= '[/et_pb_slider]</div>[/et_pb_column][et_pb_column type="1_3"]<div id="destaque3">[et_pb_slider admin_label="Deslizante" show_arrows="off" show_pagination="on" auto="on" auto_speed="'.$slider_speed.'" auto_ignore_hover="off" parallax="off" parallax_method="off" remove_inner_shadow="off" background_position="default" background_size="default" top_padding="100px" bottom_padding="100px" hide_content_on_mobile="off" hide_cta_on_mobile="off" show_image_video_mobile="on" header_font_size="29px" header_font_size_phone="30px" header_letter_spacing="16px" header_line_height="1.4em" body_font_size_tablet="12px" body_font_size_phone="11px" body_line_height="1.8em" custom_button="off" button_text_size="20" button_letter_spacing="0" button_use_icon="default" button_icon_placement="right" button_on_hover="on" button_letter_spacing_hover="0" disabled="off" saved_tabs="all"]';
	$categoria = get_category_by_slug('destaque3');
	if (($categoria) && ($categoria->count > 0))
	{
		$args = array(
			'numberposts' => 5,
			'category' => $categoria->term_id,
			'post_type' => 'post'
			);
	}
	else
	{
		$args = array(
			'numberposts' => 5,
			'post_type' => 'post'
			);
	}
	$destaques = get_posts($args);
	foreach ($destaques as $destaque) {
		$author_ID = $destaque->post_author;
		$string .= '[et_pb_slide heading="'.get_the_author_meta('display_name',$author_ID).'" button_text="Ver agora" button_link="'.get_post_permalink($destaque->ID).'" background_image="'.get_the_post_thumbnail_url($destaque->ID).'" background_position="default" background_size="default" background_color="#ffffff" use_bg_overlay="on" bg_overlay_color="rgba(0,0,0,0.38)" use_text_overlay="off" alignment="center" background_layout="dark" allow_player_pause="off" text_border_radius="0px" header_font="Roboto Condensed|on||on|" header_font_size="27px" header_font_size_tablet="27px" header_font_size_phone="27px" header_letter_spacing="0px" header_letter_spacing_tablet="0px" header_letter_spacing_phone="0px" body_font="Roboto Condensed|on|||" body_font_size="'.$slider_font_size.'" body_font_size_tablet="'.$slider_font_size.'" body_font_size_phone="'.$slider_font_size.'" body_line_height="1em" body_line_height_tablet="1em" body_line_height_phone="1em" custom_button="on" button_text_size="12px" button_border_width="1px" button_border_radius="1px" button_letter_spacing="1px" button_font="Droid Sans|||on|" button_use_icon="off" button_icon="" button_icon_placement="left" button_on_hover="on" button_border_radius_hover="1px" button_letter_spacing_hover="1px" button_text_size_tablet="12px" button_text_size_phone="12px" button_letter_spacing_tablet="1px" button_letter_spacing_phone="1px" button_letter_spacing_hover_tablet="1px" button_letter_spacing_hover_phone="1px" disabled="off"]'.$destaque->post_title.'[/et_pb_slide]';
	}
	$string .= '[/et_pb_slider]</div>[/et_pb_column][/et_pb_row][/et_pb_section]</div>';
	echo do_shortcode($string);

}
?>
