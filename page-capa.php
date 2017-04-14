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
			$string .= '[et_pb_row admin_label="row" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" use_custom_gutter="off" gutter_width="3" custom_padding="27px|0px|0px|0px" padding_mobile="off" allow_player_pause="off" parallax="off" parallax_method="on" make_equal="off" column_padding_mobile="on" parallax_1="off" parallax_method_1="on" parallax_2="off" parallax_method_2="on" parallax_3="off" parallax_method_3="on" parallax_4="off" parallax_method_4="on" disabled="off"][et_pb_column type="4_4"][et_pb_text admin_label="Texto" background_layout="light" text_orientation="left" text_font="Droid Serif|on|||" text_font_size="50px" text_font_size_tablet="40px" text_font_size_last_edited="on|phone" text_line_height_tablet="1em" text_line_height_last_edited="on|tablet" use_border_color="off" border_style="solid" custom_margin_last_edited="on|phone" custom_padding_phone="|||" custom_padding_last_edited="on|phone" disabled="off"]<p id="opn_title" style="text-align: center;">opinião</p>[/et_pb_text][/et_pb_column][/et_pb_row]';
			echo do_shortcode($string);
			nj_destaque_slider(5000);
			?>
			<div id="know-more-author">Conheça os colunistas da Mídia NINJA!</div>
			<?php
			$string = '';
			$string .= '<div id="colunistas">[et_pb_section admin_label="Seção" transparent_background="off" allow_player_pause="off" inner_shadow="off" parallax="off" parallax_method="on" custom_padding="0px|0px|0px|0px" padding_mobile="off" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" make_equal="off" use_custom_gutter="off" fullwidth="off" specialty="off" disabled="off"][et_pb_row admin_label="row" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" use_custom_gutter="off" gutter_width="3" custom_padding="20px|0px|27px|0px" custom_padding_tablet="0px|0px|0px|0px" custom_padding_phone="0px||0px|" padding_mobile="off" allow_player_pause="off" parallax="off" parallax_method="on" make_equal="off" column_padding_mobile="on" parallax_1="off" parallax_method_1="on" parallax_2="off" parallax_method_2="on" parallax_3="off" parallax_method_3="on" parallax_4="off" parallax_method_4="on" custom_padding_last_edited="on|phone" disabled="off"]';

			$args = array(
				'blog_id'      	=> $GLOBALS['blog_id'],
				'role'         	=> 'author',
				'orderby'		=> 'meta_value_num',
				'meta_key'      => 'prioridade',
				);
			$authors = get_users( $args );
			$row_count = 1;
			foreach ($authors as $author) {
				$author_ID = $author->ID;
				ob_start();
				nj_author_card($author_ID);
				$string .= ob_get_contents();
				ob_end_clean();
				if (($row_count % 4) == 0)
				{
					$string .= '[/et_pb_row][et_pb_row admin_label="row" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" use_custom_gutter="off" gutter_width="3" custom_padding="20px|0px|27px|0px" custom_padding_tablet="0px|0px|0px|0px" custom_padding_phone="0px||0px|" padding_mobile="off" allow_player_pause="off" parallax="off" parallax_method="on" make_equal="off" column_padding_mobile="on" parallax_1="off" parallax_method_1="on" parallax_2="off" parallax_method_2="on" parallax_3="off" parallax_method_3="on" parallax_4="off" parallax_method_4="on" custom_padding_last_edited="on|phone" disabled="off"]';
					$row_count = 0;
				}
				$row_count++;
			}
			$string .= '[/et_pb_row][/et_pb_section]</div>';
			echo do_shortcode($string);
			?>
		</div> <!-- .entry-content -->


	</article> <!-- .et_pb_post -->



</div>

<?php get_footer(); ?>
