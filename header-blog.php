<?php
/**
 * The  template for blog headers. Used for both single and blog.
 *
 * @package WordPress
 * @subpackage dvla_theme
 * @since dvla theme 1.0
 */
?>

<?php $page_for_posts = get_option( 'page_for_posts' ); ?>
  <header class="header-blog"><div class="inner cf">
  	<?php if ( has_post_thumbnail($page_for_posts) ) : ?>
			<?php echo get_the_post_thumbnail($page_for_posts, 'medium', array( 'class' => 'blog-header' ) ); ?>
  	<?php else : ?>
	    <h1><a href="<?php bloginfo('url') ?>/lifeline"><span>Lifeline</span></a></h1>
  	<?php endif; ?>
    <p><span>Real stories about what is possible when you #SayYES.</span></p>
  </div></header>