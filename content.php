<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage dvla_theme
 * @since dvla theme 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php if ( is_single() ) : ?>
		<?php t8_featured_image();?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>

		<div class="entry-meta">
			<?php
				if(in_category("on-the-road") ) { the_author(); echo " | "; }

				$date = sprintf( '<span><time class="entry-date" datetime="%1$s"> %2$s</time></span>',
				      esc_attr( get_the_date( 'c' ) ),
				      esc_html( get_the_date() )
				    );
				echo $date;
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'dvla_theme' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'dvla_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer-t8 cf">
		<?php require(themerex_get_file_dir('templates/_parts/share.php')); ?>
		<?php //t8_entry_meta(); ?>
		<?php //echo do_shortcode('[ssba]'); ?>
		<?php //get_template_part( 'author-bio' ); ?>
		<!-- <div class="nl-signup"> -->
		<!-- BEGIN: Constant Contact Email List Form Button -->
		<!-- <a href="<?php echo esc_url( home_url( '/' ) ); ?>subscribe/" class="button small full grey" >Subscribe to Lifeline</a></div> -->
	</footer>
</article><!-- #post -->
