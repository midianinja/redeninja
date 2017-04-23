<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>


<style>
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
	.bottom_ss .addtoany_shortcode {
		text-align: center;
	}
}

@media only screen and ( max-width: 980px ) {
	.et_pb_text_1 { margin-right: 0px !important; margin-left: 0px !important; }
	.et_pb_text_0 { margin-right: 0px !important; margin-left: 0px !important; }
}

@media (min-width: 480px) and (max-width: 980px)
{
	.et_pb_divider_0
	{
		display: none;

	}
}
@media (max-width: 479px)
{
	.et_pb_divider_0
	{
		display: none;

	}
}
.addtoany_shortcode {
	margin: 0.5em 0 1em;
}
.et_pb_divider_0
{
	margin-bottom: 0 !important;
}
p.post-meta {
	padding: 0 !important;
	margin: 0 !important;
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
nav.post-nav
{
	display: none;
}
.entry-content .et_pb_row {
	padding: 0 !important;
}
</style>
<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
				<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
					<?php $author_ID = $post->post_author; ?>

					<div class="et_post_meta_wrapper">
						<p class="post-meta"><span class="published"><?php the_date('d/m/Y'); ?><span class="dashicons dashicons-clock"></span><?php the_time(); ?></span></p>
						<a href="<?php echo get_post_permalink(get_the_ID()); ?>"><h1 class="entry-title"><?php the_title(); ?></h1></a>
						<div class="nj_author_meta_mini"><a href="<?php echo get_author_posts_url($author_ID); ?>">
							<img src="<?php the_author_meta('avatar',$author_ID); ?>">
							<span>por <?php the_author_meta('display_name',$author_ID); ?></span>
						</a></div>
					</div> <!-- .et_post_meta_wrapper -->

					<div class="entry-content">

						<div class="et_pb_section  et_pb_section_0 et_section_regular">



							<div class="et_pb_row et_pb_row_0 et_pb_row">

								<div class="post-body et_pb_column et_pb_column  et_pb_column_0">
									<div class="et_pb_module et_pb_space et_pb_divider et_pb_divider_0"></div>
									<div class="top_ss"><?php echo do_shortcode("[addtoany]"); ?></div>
									<?php the_content(); ?>
									<div class="bottom_ss"><?php echo do_shortcode("[addtoany]"); ?></div>
									<nav class="post-nav"><span class="alignleft nav-link-previous"><?php previous_post_link("< %link"); ?></span><span class="alignright nav-link-next"><?php next_post_link("%link >"); ?></span></nav>
									<div class="facebook_comments">
										<div id="fb-root"></div>
										<script>(function(d, s, id) {
											var js, fjs = d.getElementsByTagName(s)[0];
											if (d.getElementById(id)) return;
											js = d.createElement(s); js.id = id;
											js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
											fjs.parentNode.insertBefore(js, fjs);
										}(document, 'script', 'facebook-jssdk'));</script>
										<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="10" data-order-by="social" data-colorscheme="light"></div>
									</div>
								</div> <!-- .et_pb_column -->

							</div> <!-- .et_pb_section -->
						</div> <!-- .entry-content -->
						<div class="et_post_meta_wrapper">

						</div> <!-- .et_post_meta_wrapper -->
					</article>

				<?php endwhile; ?>
			</div> <!-- #left-area -->

		</div> <!-- .container -->
	</div> <!-- #main-content -->


	<?php get_footer(); ?>
