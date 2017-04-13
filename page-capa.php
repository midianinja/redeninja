<?php
/*
Template Name: Blank Page
*/

get_header();

?>
<style>
.et_pb_text_0 {
	font-family: 'Droid Serif', Georgia, "Times New Roman", serif;
	font-weight: bold;
	font-size: 50px;
}
@media only screen and (min-width: 981px)
{
	.et_pb_row_0.et_pb_row {
		padding-top: 27px;
		padding-right: 0px;
		padding-bottom: 0px;
		padding-left: 0px;
	}
	.et_pb_row_1.et_pb_row {
		padding-top: 31px;
		padding-right: 0px;
		padding-bottom: 0px;
		padding-left: 0px;
	}

	.et_pb_row_3.et_pb_row {
		padding-top: 0px;
		padding-right: 0px;
		padding-bottom: 87px;
		padding-left: 0px;
	}
	.et_pb_section_0.et_pb_section {
		padding-top: 0px;
		padding-right: 0px;
		padding-bottom: 0px;
		padding-left: 0px;
	}

}
@media only screen and (min-width: 1350px)
{
	.et_pb_section {
		padding: 54px 0;
	}
}

</style>
<div id="main-content">

	<?php echo get_page(get_the_ID())->post_content; ?>


	<article id="page-capa" class="page type-page status-publish hentry">


		<div class="entry-content">
			<?php

			$slider_speed = 5000;
			$slider_font_size = "200%";
			$string = '';
			$string .= '[et_pb_row admin_label="row" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" use_custom_gutter="off" gutter_width="3" custom_padding="27px|0px|0px|0px" padding_mobile="off" allow_player_pause="off" parallax="off" parallax_method="on" make_equal="off" column_padding_mobile="on" parallax_1="off" parallax_method_1="on" parallax_2="off" parallax_method_2="on" parallax_3="off" parallax_method_3="on" parallax_4="off" parallax_method_4="on" disabled="off"][et_pb_column type="4_4"][et_pb_text admin_label="Texto" background_layout="light" text_orientation="left" text_font="Droid Serif|on|||" text_font_size="50px" text_font_size_tablet="40px" text_font_size_last_edited="on|phone" text_line_height_tablet="1em" text_line_height_last_edited="on|tablet" use_border_color="off" border_style="solid" custom_margin_last_edited="on|phone" custom_padding_phone="|||" custom_padding_last_edited="on|phone" disabled="off"]<p id="opn_title" style="text-align: center;">opinião</p>[/et_pb_text][/et_pb_column][/et_pb_row][et_pb_section bb_built="1" admin_label="section" transparent_background="off" allow_player_pause="off" inner_shadow="off" parallax="off" parallax_method="on" custom_padding="0px|0px|0px|0px" padding_mobile="off" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" make_equal="off" use_custom_gutter="off" fullwidth="off" specialty="off" disabled="off"][et_pb_row admin_label="row" make_fullwidth="on" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" use_custom_gutter="on" gutter_width="1" custom_padding="0px|0px|87px|0px" padding_mobile="off" allow_player_pause="off" parallax="off" parallax_method="on" make_equal="off" column_padding_mobile="on" parallax_1="off" parallax_method_1="on" parallax_2="off" parallax_method_2="on" parallax_3="off" parallax_method_3="on" parallax_4="off" parallax_method_4="on" custom_padding_last_edited="on|desktop" disabled="off"][et_pb_column type="1_3"]<div id="destaque1">[et_pb_slider admin_label="Deslizante" show_arrows="off" show_pagination="on" auto="on" auto_speed="'.$slider_speed.'" auto_ignore_hover="off" parallax="off" parallax_method="off" remove_inner_shadow="off" background_position="default" background_size="default" top_padding="30px" bottom_padding="30px" hide_content_on_mobile="off" hide_cta_on_mobile="off" show_image_video_mobile="on" header_font_size="29px" header_font_size_phone="30px" header_letter_spacing="16px" header_line_height="1.4em" body_font_size_tablet="12px" body_font_size_phone="11px" body_line_height="1.8em" custom_button="off" button_text_size="20" button_letter_spacing="0" button_use_icon="default" button_icon_placement="right" button_on_hover="on" button_letter_spacing_hover="0" disabled="off" saved_tabs="all"]';
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
			$string .= '[/et_pb_slider]</div>[/et_pb_column][/et_pb_row][/et_pb_section]';
			echo do_shortcode($string);
			$string = '';
			$string .= '[et_pb_section admin_label="Seção" transparent_background="off" allow_player_pause="off" inner_shadow="off" parallax="off" parallax_method="on" custom_padding="0px|0px|0px|0px" padding_mobile="off" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" make_equal="off" use_custom_gutter="off" fullwidth="off" specialty="off" disabled="off"][et_pb_row admin_label="row" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" use_custom_gutter="off" gutter_width="3" custom_padding="0px|0px|58px|0px" padding_mobile="off" allow_player_pause="off" parallax="off" parallax_method="on" make_equal="off" column_padding_mobile="on" parallax_1="off" parallax_method_1="on" parallax_2="off" parallax_method_2="on" parallax_3="off" parallax_method_3="on" parallax_4="off" parallax_method_4="on" disabled="off"][et_pb_column type="4_4"][et_pb_text admin_label="Texto" background_layout="light" text_orientation="center" header_font="||||" text_font="Roboto Condensed|on||on|" text_font_size="21px" use_border_color="off" border_style="solid" disabled="off" inline_fonts="Droid Serif"][/et_pb_text][/et_pb_column][/et_pb_row][et_pb_row admin_label="row" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" use_custom_gutter="off" gutter_width="3" custom_padding="20px|0px|27px|0px" custom_padding_tablet="0px|0px|0px|0px" custom_padding_phone="0px||0px|" padding_mobile="off" allow_player_pause="off" parallax="off" parallax_method="on" make_equal="off" column_padding_mobile="on" parallax_1="off" parallax_method_1="on" parallax_2="off" parallax_method_2="on" parallax_3="off" parallax_method_3="on" parallax_4="off" parallax_method_4="on" custom_padding_last_edited="on|phone" disabled="off"]<div id="colunistas">';

			$args = array(
				'blog_id'      => $GLOBALS['blog_id'],
				'role'         => 'author'
				);
			$authors = get_users( $args );
			$row_count = 1;
			foreach ($authors as $author) {
				$author_ID = $author->ID;
				$string .= '[et_pb_column type="1_4"][et_pb_text admin_label="Texto" background_layout="light" text_orientation="left" text_font="Source Sans Pro|on||on|" text_font_size="20px" use_border_color="off" border_style="solid" custom_margin="||1px|" disabled="off"]'.get_the_author_meta('display_name',$author_ID).'[/et_pb_text][et_pb_divider admin_label="Divisor" color="#000000" show_divider="on" divider_style="solid" divider_position="top" divider_weight="1px" hide_on_mobile="off" disabled="off"][/et_pb_divider][et_pb_image admin_label="Imagem" src="'.get_the_author_meta('avatar',$author_ID).'" show_in_lightbox="off" url="'.get_author_posts_url($author_ID).'" url_new_window="off" use_overlay="off" sticky="off" align="center" force_fullwidth="off" always_center_on_mobile="on" use_border_color="off" border_color="#ffffff" border_width="1px" border_style="solid" custom_margin="0px|||" disabled="off"][/et_pb_image][et_pb_text admin_label="Texto" background_layout="light" text_orientation="left" text_font="Source Sans Pro||||" use_border_color="off" border_style="solid" disabled="off"]<span class="nj_author_card_text">'.get_the_author_meta('description',$author_ID).'</span>[/et_pb_text][/et_pb_column]';
				if (($row_count % 4) == 0)
				{
					$string .= '[/et_pb_row][et_pb_row admin_label="row" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" use_custom_gutter="off" gutter_width="3" custom_padding="20px|0px|27px|0px" custom_padding_tablet="0px|0px|0px|0px" custom_padding_phone="0px||0px|" padding_mobile="off" allow_player_pause="off" parallax="off" parallax_method="on" make_equal="off" column_padding_mobile="on" parallax_1="off" parallax_method_1="on" parallax_2="off" parallax_method_2="on" parallax_3="off" parallax_method_3="on" parallax_4="off" parallax_method_4="on" custom_padding_last_edited="on|phone" disabled="off"]';
					$row_count = 0;
				}
				$row_count++;
			}
			$string .= '</div>[/et_pb_row][/et_pb_section]';
			echo do_shortcode($string);
			?>
		</div> <!-- .entry-content -->


	</article> <!-- .et_pb_post -->



</div>

<?php get_footer(); ?>
