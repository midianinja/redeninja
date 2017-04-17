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
		margin-bottom: 1em;
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

	<?php //echo get_page(get_the_ID())->post_content; ?>


	<article id="page-capa" class="page type-page status-publish hentry">


		<div class="entry-content">
			<?php

			$slider_speed = 5000;
			$slider_font_size = "200%";
			$string = '';
			$string .= '[et_pb_row admin_label="row" make_fullwidth="off" use_custom_width="off" width_unit="off" custom_width_px="1080px" custom_width_percent="80%" use_custom_gutter="off" gutter_width="3" custom_padding="27px|0px|0px|0px" padding_mobile="off" allow_player_pause="off" parallax="off" parallax_method="on" make_equal="off" column_padding_mobile="on" parallax_1="off" parallax_method_1="on" parallax_2="off" parallax_method_2="on" parallax_3="off" parallax_method_3="on" parallax_4="off" parallax_method_4="on" disabled="off"][et_pb_column type="4_4"][et_pb_text admin_label="Texto" background_layout="light" text_orientation="left" text_font="Droid Serif|on|||" text_font_size="50px" text_font_size_tablet="40px" text_font_size_last_edited="on|phone" text_line_height_tablet="1em" text_line_height_last_edited="on|tablet" use_border_color="off" border_style="solid" custom_margin_last_edited="on|phone" custom_padding_phone="|||" custom_padding_last_edited="on|phone" disabled="off"]<p id="opn_title" style="text-align: center;">'.get_the_title().'</p>[/et_pb_text][et_pb_divider admin_label="Divisor" color="#000000" show_divider="on" divider_style="solid" divider_position="top" divider_weight="1px" hide_on_mobile="off" disabled="off"][/et_pb_divider][/et_pb_column][/et_pb_row]';
			echo do_shortcode($string);
			nj_destaque_slider(5000);
			?>
			<div id="know-more-author">Conheça os colunistas da Mídia NINJA!</div>
			<div class="filter_wrap"><input id="colunistas_filter" type="text"><span class="dashicons dashicons-search"></span></div>
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
			foreach ($authors as $author) {
				$author_ID = $author->ID;
				ob_start();
				nj_author_card($author_ID);
				$string .= ob_get_contents();
				ob_end_clean();
			}
			//Adiciona card em branco pra manter o alinhamento
			for ($i=0; $i < 4; $i++) {
				ob_start();
				nj_author_card(-1);
				$string .= ob_get_contents();
				ob_end_clean();
			}

			$string .= '[/et_pb_row][/et_pb_section]</div>';
			echo do_shortcode($string);
			?>
		</div> <!-- .entry-content -->


	</article> <!-- .et_pb_post -->
	<script>
	jQuery.fn.highlight = function(pat) {
		function innerHighlight(node, pat) {
			var skip = 0;
			if (node.nodeType == 3) {
				var pos = node.data.toUpperCase().indexOf(pat);
				pos -= (node.data.substr(0, pos).toUpperCase().length - node.data.substr(0, pos).length);
				if (pos >= 0) {
					var spannode = document.createElement('span');
					spannode.className = 'highlight';
					var middlebit = node.splitText(pos);
					var endbit = middlebit.splitText(pat.length);
					var middleclone = middlebit.cloneNode(true);
					spannode.appendChild(middleclone);
					middlebit.parentNode.replaceChild(spannode, middlebit);
					skip = 1;
				}
			}
			else if (node.nodeType == 1 && node.childNodes && !/(script|style)/i.test(node.tagName)) {
				for (var i = 0; i < node.childNodes.length; ++i) {
					i += innerHighlight(node.childNodes[i], pat);
				}
			}
			return skip;
		}
		return this.length && pat && pat.length ? this.each(function() {
			innerHighlight(this, pat.toUpperCase());
		}) : this;
	};

	jQuery.fn.removeHighlight = function() {
		return this.find("span.highlight").each(function() {
			this.parentNode.firstChild.nodeName;
			with (this.parentNode) {
				replaceChild(this.firstChild, this);
				normalize();
			}
		}).end();
	};


	</script>
	<script>
	jQuery.extend(jQuery.expr[":"], {
		"containsNC": function(elem, i, match, array) {
			return (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
		}
	});
	jQuery("#colunistas_filter").on("change paste keyup", function()
	{
		var val = jQuery(this).val();
		jQuery(".nj_post_author_card").removeHighlight();
		jQuery(".nj_post_author_card:not(.empty)").hide();
		jQuery(".nj_post_author_card:containsNC('"+val+"')").show();
		jQuery(".nj_post_author_card").highlight(jQuery(this).val());
	});
	</script>


</div>

<?php get_footer(); ?>
