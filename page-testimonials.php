<?php
/**
 * The template for displaying the testimonials page
 *
 * @package crystal
 */

get_header(); ?>

	<div id="slider">
		<?php if (!get_field( 'Wide_Feature_Image' )): ?>
		<div class="container">
		<?php endif; ?>
			<?php  $slider = get_field('slider'); if( $slider ): ?>
			<div class="slides">
			<?php foreach( $slider as $slide ): ?>
				<div class="slide">
					<img src="<?php echo $slide['url']; ?>" alt="<?php echo $slide['alt']; ?>" />
					<div class="caption">
						<h2><?php echo $slide['caption']; ?></h2>
						<p><?php echo $slide['description']; ?></p>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
			<?php elseif(has_post_thumbnail()): ?>
			<div class="slides">
				<div class="slide">
					<?php the_post_thumbnail( 'cover' ); ?>
				</div>
			</div>
			<?php endif; ?>
		<?php if (!get_field( 'Wide_Feature_Image' )): ?>
		</div>
		<?php endif; ?>
	</div>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile;

		endif;

		?>

		<div class="testimonials container">
		<?php
		$args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1 );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
		?>
		<div class="testimonial">
			<?php the_content( ); ?>
			<?php the_title( '<h3>', '</h3>' ); ?>
		</div>
		<?php
		endwhile;
		wp_reset_query(); wp_reset_postdata();
		?>
		</div>

		</main>

		<?php 
			get_template_part( 'partials/services', 'boxes' );
		?>

		<?php 
		if (get_field( 'enable_cta' )): 
		$cta_image = get_field( 'cta_background' ); 
		?>

		<section id="cta" class="parallax-window" data-bleed="50" data-parallax="scroll" data-image-src="<?php echo $cta_image['sizes']['large']; ?>">
			<div class="overlay">
				<div class="container">

					<?php the_field( 'cta_content' ); ?>

				</div>
			</div>
		</section>

		<?php endif; ?>

	</div>

<?php
get_footer();
