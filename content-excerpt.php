<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Children_Theme
 * @since Children Theme 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-featured">
    <?php t8_featured_image(); ?>
  </div>
  <div class="entry-wrap">
	<header class="entry-header cf">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h1>
		<?php if(is_singular( array( 'post' ) )): ?>
			<p class="byline">By <a href="<?php echo get_the_permalink($author_page_ID); ?>"><?php the_author_meta('display_name'); ?></a></p>
		<?php endif; ?>
	</header>
	<div class="entry-content excerpt">
		<?php the_excerpt(); ?>
	</div>
  </div>
	<footer class="entry-footer-t8 cf">
	<?php t8_entry_meta(); ?>
	</footer>
</article>