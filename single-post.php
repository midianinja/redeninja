<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>
<style>
.et_pb_text_2 { font-family: 'Source Sans Pro', Helvetica, Arial, Lucida, sans-serif; font-weight: bold; text-transform: uppercase;font-size: 21px; margin-bottom: 1px !important; }
.et_pb_divider_2:before { border-top-color: #000000; }
.et_pb_image_1 { margin-left: 0; }
.et_pb_text_3 { font-family: 'Source Sans Pro', Helvetica, Arial, Lucida, sans-serif; }
.et_pb_text_1 { font-family: 'Source Sans Pro', Helvetica, Arial, Lucida, sans-serif;font-size: 18px; letter-spacing: 1px; line-height: 1.9em; margin-top: 75px !important; margin-right: 40px !important; margin-left: 40px !important; }
.et_pb_text_1 p { line-height: 1.9em; }
.et_pb_text_0 p { line-height: 1.9em; }
.et_pb_text_0 { font-family: 'Source Sans Pro', Helvetica, Arial, Lucida, sans-serif;font-size: 18px; letter-spacing: 1px; line-height: 1.9em; margin-top: 75px !important; margin-right: 40px !important; margin-left: 40px !important; }
.et_pb_image_0 { margin-top: 0px !important; text-align: center; }
.et_pb_image_0 img { width: 100%; }
.et_pb_divider_0:before { border-top-color: #000000; }

@media only screen and ( min-width: 981px ) {
	.et_pb_row_0.et_pb_row { padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; }
	.et_pb_section_0.et_pb_section { padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; }
}

@media only screen and ( max-width: 980px ) {
	.et_pb_text_1 { margin-right: 0px !important; margin-left: 0px !important; }
	.et_pb_text_0 { margin-right: 0px !important; margin-left: 0px !important; }
}

.addtoany_shortcode {
	margin: 0.5em 0 1em;
}
.et_pb_divider_0 {
	margin-bottom: 0 !important;
}
p.post-meta {
	padding: 0 !important;
	margin: 0 !important;
}
span.dashicons.dashicons-clock {
	font-size: 1.2em;
}
p.post-meta span {
	vertical-align: middle;
}

.bottom_ss {
	margin-top: 3em;
}
.bottom_ss .a2a_svg {
	width: 32px !important;
	line-height: 32px !important;
	height: 32px !important;
}
.bottom_ss .a2a_count {
	line-height: 32px !important;
	height: 32px !important;
}
</style>
<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
				<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
					<?php $author_ID = get_query_var( 'author' ); ?>

					<div class="et_post_meta_wrapper">
						<p class="post-meta"><span class="published"><?php the_date('d/m/Y'); ?><span class="dashicons dashicons-clock"></span><?php the_time(); ?></span></p>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</div> <!-- .et_post_meta_wrapper -->

					<div class="entry-content">

						<div class="et_pb_section  et_pb_section_0 et_section_regular">



							<div class="et_pb_row et_pb_row_0 et_pb_row_3-4_1-4">

								<div class="et_pb_column et_pb_column_3_4  et_pb_column_0">
									<div class="et_pb_module et_pb_space et_pb_divider et_pb_divider_0"></div>
									<?php //Espaço para o social share ?>
									<?php the_content(); ?>
									<div class="bottom_ss"><?php //Espaço para o social share ?></div>
								</div> <!-- .et_pb_column --><div class="et_pb_column et_pb_column_1_4  et_pb_column_1">

								<div class="et_pb_module et_pb_space et_pb_divider_1"></div><div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_2">

								<p><a href="<?php echo get_post_permalink($colunista->ID); ?>">por <?php the_author_meta('display_name',$author_ID); ?></a></p>

							</div> <!-- .et_pb_text --><div class="et_pb_module et_pb_space et_pb_divider et_pb_divider_2"></div><div class="et_pb_module et-waypoint et_pb_image et_pb_animation_off et_pb_image_1 et_always_center_on_mobile et-animated">
							<a href="<?php echo get_post_permalink($colunista->ID); ?>"><img src="<?php the_author_meta('avatar',$author_ID); ?>" alt="<?php the_author_meta('display_name',$author_ID); ?>">
							</a>
						</div><div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_3">

						<div class="_3c-4 _2x70 __2p _2pi0 _52jv">
							<div class="_50f9 _50f3">
								<p><?php the_author_meta('description',$author_ID); ?><br>
									<?php if (get_the_author_meta('twitter',$author_ID)) { ?>
									<a href="<?php the_author_meta('twitter',$author_ID); ?>" target="_blank"><img class="alignleft wp-image-193 size-full" src="<?php echo get_stylesheet_directory_uri()."/images/twitter.png"; ?>" alt="Twitter" width="35" height="35"></a>
									<?php } if (get_the_author_meta('facebook',$author_ID)) { ?>
									<a href="<?php the_author_meta('facebook',$author_ID); ?>" target="_blank"><img class="alignleft wp-image-194 size-full" src="<?php echo get_stylesheet_directory_uri()."/images/facebook.png"; ?>" alt="Facebook" width="34" height="34"></a>
									<?php } ?>
								</p>
							</div>
						</div>

					</div> <!-- .et_pb_text -->
				</div> <!-- .et_pb_column -->

			</div> <!-- .et_pb_row -->

		</div> <!-- .et_pb_section -->
	</div> <!-- .entry-content -->
	<div class="et_post_meta_wrapper">

		<div id="fb-root" class=" fb_reset"><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div><iframe name="fb_xdm_frame_http" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_http" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="http://staticxx.facebook.com/connect/xd_arbiter/r/nRK_i0jz87x.js?version=42#channel=f330605d0ce0498&amp;origin=http%3A%2F%2Fredeninja.redelivre.org.br" style="border: none;"></iframe><iframe name="fb_xdm_frame_https" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_https" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="https://staticxx.facebook.com/connect/xd_arbiter/r/nRK_i0jz87x.js?version=42#channel=f330605d0ce0498&amp;origin=http%3A%2F%2Fredeninja.redelivre.org.br" style="border: none;"></iframe></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	</div> <!-- .et_post_meta_wrapper -->
</article>

<?php endwhile; ?>
</div> <!-- #left-area -->

</div> <!-- #content-area -->
</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>
