<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>
<style>

.et_pb_blog_0 .et_pb_post .post-meta { font-family: 'Source Sans Pro', Helvetica, Arial, Lucida, sans-serif; }
.et_pb_blog_0 .et_pb_post { font-family: 'Source Sans Pro', Helvetica, Arial, Lucida, sans-serif; }
.et_pb_blog_0 .et_pb_post .entry-title { font-family: 'Source Sans Pro', Helvetica, Arial, Lucida, sans-serif !important; font-weight: bold !important; }
.et_pb_text_1 { font-family: 'Arimo', Helvetica, Arial, Lucida, sans-serif; }
.et_pb_divider_0:before { border-top-color: #000000; }
.et_pb_image_0 { margin-left: 0; }
.et_pb_text_0 { font-family: 'Droid Serif', Georgia, "Times New Roman", serif; font-weight: bold;font-size: 45px; }

@media only screen and ( min-width: 981px ) {
	.et_pb_row_0.et_pb_row { padding-top: 27px; padding-right: 0px; padding-bottom: 13px; padding-left: 0px; }
	.et_pb_section_0.et_pb_section { padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; }
}

@media only screen and ( max-width: 980px ) {
	.et_pb_text_0 p { line-height: 1em; }
}
.card_ds .post-content {
	display: inline-block;
	float: right;
}
.card_ds p.post-meta {
	display: inline-block;
	padding: 0;
}
</style>
<div id="main-content" class="author-page">
	<?php $author_ID = get_query_var( 'author' ); ?>

	<article id="author-<?php the_ID(); ?>">
		<div class="entry-content">
			<div class="et_pb_section  et_pb_section_0 et_section_regular">



				<div class="entry-title et_pb_row et_pb_row_0">

					<div class="et_pb_column et_pb_column_4_4  et_pb_column_0">

						<div class="nj_author_page_title et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_0">

							<p><?php the_author_meta('display_name',$author_ID); ?></p>

						</div>
						<div class="et_pb_module et_pb_space et_pb_divider et_pb_divider_0"></div>
					</div>

				</div>
				<div class="et_pb_row et_pb_row_1 et_pb_row_1-4_3-4">
					<?php nj_author_card($author_ID); ?>
					<!-- COMEÇA O LOOP -->
					<div id="nj_post_author_content" class="et_pb_column et_pb_column_3_4  et_pb_column_2">

						<div class="et_pb_module">
							<?php echo wp_oembed_get(get_the_author_meta('video',$author_ID)); ?>

						</div>
						<div class="et_pb_blog_grid_wrapper">
							<div class="et_pb_blog_grid clearfix et_pb_module et_pb_bg_layout_light  et_pb_blog_0" data-columns="2">
								<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
									<?php $rpost = get_post(get_the_ID()); ?><div
    										id="nj_author_post_card" class="column size-1of2">
    									<article id="<?php the_ID(); ?>"
    											class="et_pb_post clearfix post type-post status-publish format-standard has-post-thumbnail hentry">
    
    										<div class="et_pb_image_container">
    											<a href="<?php echo get_post_permalink($rpost->ID); ?>"
    												class="entry-featured-image-url">
    									      <?php echo get_the_post_thumbnail($rpost->ID); ?></a>
    										</div>
    										<!-- .et_pb_image_container -->
    										<h2 class="entry-title">
    											<a href="<?php echo get_post_permalink($rpost->ID); ?>"><?php echo $rpost->post_title; ?></a>
    										</h2>
    										<div class="card_ds">
    											<p class="post-meta">
    												<span class="published"><?php the_date('d/m/Y'); ?>
    													<span class="dashicons dashicons-clock"></span>
    													<?php the_time(); ?>
    												</span>
    											</p>
    											<div class="post-content">
    												<?php echo do_shortcode("[addtoany]"); ?>
    									    	</div>
    											<div class="card_ex">
    												<p><?php echo get_the_excerpt($rpost->ID); ?></p>
    											</div>
    										</div>
    									</article>
    								</div>
								<?php endwhile; else: ?>
    								<article class="et_pb_post clearfix post type-post status-publish format-standard has-post-thumbnail hentry">
    									Desculpe, mas ainda não há postagens  
    								</article>
								<?php endif; ?>
					</div> <!-- .et_pb_posts -->
<div>
	<div id="paginacaohack" class="">

			<div class="recentes">
				<?php previous_posts_link( 'Posts Recentes &raquo;' ); ?>
			</div>
		
			<div class="">
				<?php next_posts_link( '&laquo; Posts Anteriores' ); ?>
			</div>

	</div>

				</div>
			</div>
			<!-- TERMINA O LOOP -->
		</div>
	</div>
</div>

</article> <!-- .et_pb_post -->

</div>

<?php get_footer(); ?>
