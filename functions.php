<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'divi', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style('Fjalla_one_font','https://fonts.googleapis.com/css?family=Fjalla+One');
}

add_action( 'after_setup_theme', 'nj_theme_setup' );

function nj_theme_setup()
{
	add_theme_support( 'post-thumbnails' ) ;
	add_image_size( 'facebook', 1200, 630, true);

}

function cptui_register_my_cpts_news() {

	/**
	 * Post Type: News.
	 */

	$labels = array(
		"name" => __( 'News', 'divi-child-theme' ),
		"singular_name" => __( 'News', 'divi-child-theme' ),
	);

	$args = array(
		"label" => __( 'News', 'divi-child-theme' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "news", "with_front" => true ),
		"query_var" => true,
		'supports' => array('title', 'editor', 'thumbnail', 'author'),
		"menu_position" => 5,
		"taxonomies" => array( "category", "post_tag" ),
	);

	register_post_type( "news", $args );
}

add_action( 'init', 'cptui_register_my_cpts_news' );


function my_et_builder_post_types( $post_types ) {
    $post_types[] = 'news';

    return $post_types;
}
add_filter( 'et_builder_post_types', 'my_et_builder_post_types' );

function modify_user_contact_methods( $user_contact ) {
	$user_contact['avatar']   = __( 'Avatar Image Link'   );
	$user_contact['facebook']   = __( 'Facebook Link'   );
	$user_contact['facebook_thumb']   = __( 'Facebook Thumbnail Link (1200 x 630)'   );
	$user_contact['twitter'] = __( 'Twitter Link' );
	$user_contact['youtube']   = __( 'Youtube Link'   );
	$user_contact['instagram'] = __( 'Instagram Link' );
	$user_contact['video'] = __( 'Video Link' );
	$user_contact['author_tags'] = __( 'Tags' );

	return $user_contact;
}
add_filter( 'user_contactmethods', 'modify_user_contact_methods' );

add_action( 'show_user_profile', 'nj_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'nj_show_extra_profile_fields' );

function nj_show_extra_profile_fields( $user ) { ?>

<h3>Extra profile information</h3>

<table class="form-table">

	<tr>
		<th><label for="prioridade">Prioridade</label></th>

		<td>
			<input type="number" name="prioridade" id="prioridade" value="<?php echo esc_attr( get_the_author_meta( 'prioridade', $user->ID ) ); ?>" class="regular-number" /><br />
			<span class="description">Prioridade do autor na capa.</span>
		</td>
	</tr>

</table>
<?php }

add_action( 'personal_options_update', 'nj_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'nj_save_extra_profile_fields' );

function nj_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_user_meta( $user_id, 'prioridade', $_POST['prioridade'] );
}



add_filter('manage_users_columns', 'nj_add_user_id_column');
function nj_add_user_id_column($columns) {
	$columns['prioridade'] = 'Prioridade';
	return $columns;
}

add_action('manage_users_custom_column',  'nj_show_user_id_column_content', 10, 3);
function nj_show_user_id_column_content($value, $column_name, $user_id) {
	$user = get_userdata( $user_id );
	if ( 'prioridade' == $column_name )
		return get_the_author_meta('prioridade',$user_id);;
	return $value;
}


function nj_sortable_columns( $columns ) {

	$columns['prioridade'] = 'prioridade';
	return $columns;

}
add_filter( 'manage_users_sortable_columns', 'nj_sortable_columns' );

function nj_sort_by_prioridade( $query ) {

	if ( 'prioridade' == $query->get( 'orderby' ) ) {
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'meta_key', 'prioridade' );
	}
}
add_action( 'pre_get_users', 'nj_sort_by_prioridade' );

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

function nj_author_card($author_ID)
{
	?>
	<div class="nj_post_author_card et_pb_column et_pb_column_1_4  et_pb_column_1 <?php if ($author_ID == -1) { echo "empty"; } ?>">
		<?php if ($author_ID != -1) { ?>
		<div class="author_card_img et_pb_module et-waypoint et_pb_image et_pb_animation_off et_pb_image_1 et_always_center_on_mobile et-animated">
			<a href="<?php echo get_author_posts_url($author_ID); ?>"><img class="nj_author_card_pic_right" src="<?php the_author_meta('avatar',$author_ID); ?>" alt="<?php the_author_meta('display_name',$author_ID); ?>">
			</a>
		</div><div class="author_card_info">
		<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_2">

			<p><a class="author-name" href="<?php echo get_author_posts_url($author_ID); ?>"><?php the_author_meta('display_name',$author_ID); ?></a></p>

		</div><div class="et_pb_module et_pb_space et_pb_divider et_pb_divider_2"></div>
		<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_3">

			<div class="_3c-4 _2x70 __2p _2pi0 _52jv">
				<div class="_50f9 _50f3">
					<p class="author_desc"><?php the_author_meta('description',$author_ID); ?></p>
					<?php if (get_the_author_meta('twitter',$author_ID)) { ?>
					<a href="<?php the_author_meta('twitter',$author_ID); ?>" target="_blank"><img class="nj_author_card_icon alignleft wp-image-193 size-full" src="<?php echo get_stylesheet_directory_uri()."/images/twitter.svg"; ?>" alt="Twitter" width="35" height="35"></a>
					<?php } if (get_the_author_meta('facebook',$author_ID)) { ?>
					<a href="<?php the_author_meta('facebook',$author_ID); ?>" target="_blank"><img class="nj_author_card_icon alignleft wp-image-194 size-full" src="<?php echo get_stylesheet_directory_uri()."/images/facebook.svg"; ?>" alt="Facebook" width="34" height="34"></a>
					<?php } if (get_the_author_meta('youtube',$author_ID)) { ?>
					<a href="<?php the_author_meta('youtube',$author_ID); ?>" target="_blank"><img class="nj_author_card_icon alignleft wp-image-194 size-full" src="<?php echo get_stylesheet_directory_uri()."/images/youtube.svg"; ?>" alt="Youtube" width="34" height="34"></a>
					<?php } if (get_the_author_meta('instagram',$author_ID)) { ?>
					<a href="<?php the_author_meta('instagram',$author_ID); ?>" target="_blank"><img class="nj_author_card_icon alignleft wp-image-194 size-full" src="<?php echo get_stylesheet_directory_uri()."/images/instagram.svg"; ?>" alt="Instagram" width="34" height="34"></a>
					<?php } ?>

				</div>
			</div>

		</div> <!-- .et_pb_text -->
		<div class="author_tags"><?php the_author_meta('author_tags',$author_ID); ?></div>
	</div>
	<?php } ?>
</div> <!-- .et_pb_column -->
<?php
}

function nj_destaque_slider($speed)
{


	$slider_speed = 5000;
	$slider_font_size = "200%";
	$string = '';
	$string .= '<div class="destaque_slider">[et_pb_section bb_built="1" admin_label="section" transparent_background="off" allow_player_pause="off" inner_shadow="off" parallax="off" parallax_method="on" custom_padding="0px|0px|0px|0px" padding_mobile="off" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" make_equal="off" use_custom_gutter="off" fullwidth="off" specialty="off" disabled="off"][et_pb_row admin_label="row" make_fullwidth="on" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" use_custom_gutter="on" gutter_width="1" custom_padding="0px|0px|0px|0px" padding_mobile="off" allow_player_pause="off" parallax="off" parallax_method="on" make_equal="off" column_padding_mobile="on" parallax_1="off" parallax_method_1="on" parallax_2="off" parallax_method_2="on" parallax_3="off" parallax_method_3="on" parallax_4="off" parallax_method_4="on" custom_padding_last_edited="on|desktop" disabled="off"][et_pb_column type="1_3"]<div id="destaque1">[et_pb_slider admin_label="Deslizante" show_arrows="off" show_pagination="on" auto="on" auto_speed="'.$slider_speed.'" auto_ignore_hover="off" parallax="off" parallax_method="off" remove_inner_shadow="off" background_position="default" background_size="default" top_padding="30px" bottom_padding="30px" hide_content_on_mobile="off" hide_cta_on_mobile="off" show_image_video_mobile="on" header_font_size="29px" header_font_size_phone="30px" header_letter_spacing="16px" header_line_height="1.4em" body_font_size_tablet="12px" body_font_size_phone="11px" body_line_height="1.8em" custom_button="off" button_text_size="20" button_letter_spacing="0" button_use_icon="default" button_icon_placement="right" button_on_hover="on" button_letter_spacing_hover="0" disabled="off" saved_tabs="all"]';
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
		$string .= '[et_pb_slide heading="'.get_the_author_meta('display_name',$author_ID).'" button_text="Ver agora" button_link="'.get_post_permalink($destaque->ID).'" background_image="'.get_the_post_thumbnail_url($destaque->ID,"medium_large").'" background_position="default" background_size="default" background_color="#ffffff" use_bg_overlay="on" bg_overlay_color="rgba(0,0,0,0.38)" use_text_overlay="off" alignment="center" background_layout="dark" allow_player_pause="off" text_border_radius="0px" header_font="Roboto Condensed|on||on|" header_font_size="27px" header_font_size_tablet="27px" header_font_size_phone="27px" header_letter_spacing="0px" header_letter_spacing_tablet="0px" header_letter_spacing_phone="0px" body_font="Roboto Condensed|on|||" body_font_size="'.$slider_font_size.'" body_font_size_tablet="'.$slider_font_size.'" body_font_size_phone="'.$slider_font_size.'" body_line_height="1em" body_line_height_tablet="1em" body_line_height_phone="1em" custom_button="on" button_text_size="12px" button_border_width="1px" button_border_radius="1px" button_letter_spacing="1px" button_font="Droid Sans|||on|" button_use_icon="off" button_icon="" button_icon_placement="left" button_on_hover="on" button_border_radius_hover="1px" button_letter_spacing_hover="1px" button_text_size_tablet="12px" button_text_size_phone="12px" button_letter_spacing_tablet="1px" button_letter_spacing_phone="1px" button_letter_spacing_hover_tablet="1px" button_letter_spacing_hover_phone="1px" disabled="off"]'.$destaque->post_title.'[/et_pb_slide]';
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
		$string .= '[et_pb_slide heading="'.get_the_author_meta('display_name',$author_ID).'" button_text="Ver agora" button_link="'.get_post_permalink($destaque->ID).'" background_image="'.get_the_post_thumbnail_url($destaque->ID,"medium_large").'" background_position="default" background_size="default" background_color="#ffffff" use_bg_overlay="on" bg_overlay_color="rgba(0,0,0,0.38)" use_text_overlay="off" alignment="center" background_layout="dark" allow_player_pause="off" text_border_radius="0px" header_font="Roboto Condensed|on||on|" header_font_size="27px" header_font_size_tablet="27px" header_font_size_phone="27px" header_letter_spacing="0px" header_letter_spacing_tablet="0px" header_letter_spacing_phone="0px" body_font="Roboto Condensed|on|||" body_font_size="'.$slider_font_size.'" body_font_size_tablet="'.$slider_font_size.'" body_font_size_phone="'.$slider_font_size.'" body_line_height="1em" body_line_height_tablet="1em" body_line_height_phone="1em" custom_button="on" button_text_size="12px" button_border_width="1px" button_border_radius="1px" button_letter_spacing="1px" button_font="Droid Sans|||on|" button_use_icon="off" button_icon="" button_icon_placement="left" button_on_hover="on" button_border_radius_hover="1px" button_letter_spacing_hover="1px" button_text_size_tablet="12px" button_text_size_phone="12px" button_letter_spacing_tablet="1px" button_letter_spacing_phone="1px" button_letter_spacing_hover_tablet="1px" button_letter_spacing_hover_phone="1px" disabled="off"]'.$destaque->post_title.'[/et_pb_slide]';
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
		$string .= '[et_pb_slide heading="'.get_the_author_meta('display_name',$author_ID).'" button_text="Ver agora" button_link="'.get_post_permalink($destaque->ID).'" background_image="'.get_the_post_thumbnail_url($destaque->ID,"medium_large").'" background_position="default" background_size="default" background_color="#ffffff" use_bg_overlay="on" bg_overlay_color="rgba(0,0,0,0.38)" use_text_overlay="off" alignment="center" background_layout="dark" allow_player_pause="off" text_border_radius="0px" header_font="Roboto Condensed|on||on|" header_font_size="27px" header_font_size_tablet="27px" header_font_size_phone="27px" header_letter_spacing="0px" header_letter_spacing_tablet="0px" header_letter_spacing_phone="0px" body_font="Roboto Condensed|on|||" body_font_size="'.$slider_font_size.'" body_font_size_tablet="'.$slider_font_size.'" body_font_size_phone="'.$slider_font_size.'" body_line_height="1em" body_line_height_tablet="1em" body_line_height_phone="1em" custom_button="on" button_text_size="12px" button_border_width="1px" button_border_radius="1px" button_letter_spacing="1px" button_font="Droid Sans|||on|" button_use_icon="off" button_icon="" button_icon_placement="left" button_on_hover="on" button_border_radius_hover="1px" button_letter_spacing_hover="1px" button_text_size_tablet="12px" button_text_size_phone="12px" button_letter_spacing_tablet="1px" button_letter_spacing_phone="1px" button_letter_spacing_hover_tablet="1px" button_letter_spacing_hover_phone="1px" disabled="off"]'.$destaque->post_title.'[/et_pb_slide]';
	}
	$string .= '[/et_pb_slider]</div>[/et_pb_column][/et_pb_row][/et_pb_section]</div>';
	echo do_shortcode($string);

}

add_action( 'pre_get_posts',  'set_posts_per_page', 99999 );
function set_posts_per_page( $query ) {

	global $wp_the_query;

	if ( ( ! is_admin() ) && ( $query->is_author() ) ) {
		$query->set( 'posts_per_page', 10 );
	}

	return $query;
}

function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', do_shortcode($post->post_content), $matches);
	$first_img = isset( $matches[1][0] ) ? $matches[1][0] : null;

	return $first_img;
}

function fb_opengraph()
{
	global $post, $wp;

	if (isset($wp->query_vars["author_name"]))
	{
		$author = get_user_by('slug',$wp->query_vars["author_name"]);
		if (!empty($author))
		{
			$author_ID = $author->ID;
		}
	}
	$current_url = home_url(add_query_arg(array(),$wp->request));

	if (is_single() || is_page())
	{
		if(has_post_thumbnail($post->ID)) {
			$img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'facebook')[0];
		} else {
			$img_src = catch_that_image();
		}

	}
	else if (is_author())
	{
		$img_src = get_the_author_meta('facebook_thumb',$author_ID);
		if (empty($img_src))
		{
			$img_src = get_the_author_meta('avatar',$author_ID);
		}
	}

	if (is_single() || is_page())
	{
		$desc = wp_strip_all_tags($post->post_excerpt);
	}
	else if (is_author())
	{
		$desc = get_the_author_meta('description',$author_ID);
	}
	else
	{
		$desc = wp_trim_words(wp_strip_all_tags($post->post_content));
	}

	if (is_front_page())
	{
		$title = get_bloginfo('description');
	}
	else if (is_author())
	{
		$title = get_the_author_meta('display_name',$author_ID);
	}
	else
	{
		$title = get_the_title();
	}

	if (is_single())
	{
		$type = 'article';
	}
	else
	{
		$type = 'website';
	}
	?>

	<meta property="og:url" content="<?php echo esc_attr($current_url); ?>"/>
	<meta property="og:type" content="<?php echo esc_attr($type); ?>"/>
	<meta property="og:title" content="<?php echo esc_attr($title); ?>"/>
	<meta property="og:image" content="<?php echo esc_attr($img_src); ?>"/>
	<meta property="og:description" content="<?php echo esc_attr($desc); ?>"/>
	<meta property="og:site_name" content="Rede NINJA" />
	<meta property="og:locale" content="pt_BR" />
	<meta property="fb:app_id" content="320229188395757">

	<?php
}

add_action('wp_head', 'fb_opengraph', 5);



?>
