<?php
/**
 * Template Name: Service Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main>

		<?php if( have_rows('Serviceses') ): ?>
		<section id="services">
			<div class="container">

				<h1>THE SERVICES WE PROVIDE</h1>

				<div class="list-of-services">

					<?php while ( have_rows('Serviceses') ) : the_row(); ?>
					<div class="service span3">
						<?php $icon = get_sub_field( 'Icon' ); ?>
						<div class="icon" style="background-image:url(<?php echo $icon['url']; ?>);"></div>
						<h3><?php the_sub_field( 'Name' ); ?></h3>
					</div>
					<?php endwhile; ?>

				</div>

			</div>

			<div class="container">

				<h1>ADD-ON SERVICES</h1>

				<div class="addons">
					<?php the_field( 'Addonses' ); ?>
				</div>

			</div>
		</section>
		<?php endif; ?>

		<section id="packs">
			<div class="container">

				<h1>SERVICES PACKS</h1>

				<div class="list-of-services">

					<?php
					// Set up the objects needed
					$servicepacks = new WP_Query();
					$service_packs = $servicepacks->query(array('post_type' => 'page', 'posts_per_page' => '-1'));

					// Get the page as an Object
					$pagetitle = get_the_title();
					$servicepage = get_page_by_title($pagetitle);

					// Filter through all pages and find Portfolio's children
					$servicepage_children = get_page_children( $servicepage->ID, $service_packs );

					// echo what we get back from WP to the browser
					//echo '<pre>' . print_r( $servicepage_children, true ) . '</pre>';

					$nos = count($servicepage_children);
					$nos_cols = 12 / $nos;

					foreach ($servicepage_children as $servicepage_package): ?>
					<div class="service span<?php echo $nos_cols; ?>">
						<a href="<?php the_permalink($servicepage_package->ID); ?>">
							<div class="icon" style="background-image:url(<?php echo get_field( 'service_icon', $servicepage_package->ID ); ?>);"></div>
							<h3><?php echo get_the_title( $servicepage_package->ID ); ?></h3>
							<button>Details</button>
						</a>
					</div>
					<?php endforeach; ?>

				</div>

			</div>
		</section>

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
