<?php
/**
 * Child-Theme functions and definitions
 */

wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/main.js', array( 'jquery' ) );

require_once get_stylesheet_directory(). '/functions/shortcodes.php';

function dlva_child_theme_setup() {

	register_nav_menu( 'head_butt_rt', __( 'Header right buttons', 'children_theme' ) );

}
add_action( 'after_setup_theme', 'dlva_child_theme_setup' );

if ( ! function_exists( 't8_entry_meta' ) ) :
  function t8_entry_meta() {

    //
    // Author.
    //
  	$author_link = get_author_posts_url( get_the_author_meta('ID') );
    $author = sprintf( '<span>BY <a href="%1$s"> %2$s</a></span>',
    	$author_link,
      	get_the_author()
    );


    //
    // Date.
    //

    $date = sprintf( '<span><time class="entry-date" datetime="%1$s"> %2$s</time></span>',
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() )
    );


    //
    // Categories.
    //
    
	$categories        = get_the_category();
	$separator         = ', ';
	$categories_output = '';
	foreach ( $categories as $category ) {
		if($category->name != "Services"){
		    $categories_output .= '<a href="'
		                        . get_category_link( $category->term_id )
		                        . '" title="'
		                        . esc_attr( sprintf( __( "View all posts in: &ldquo;%s&rdquo;", '_t8_children' ), $category->name ) )
		                        . '">'
		                        . $category->name
		                        . '</a>'
		                        . $separator;
		}
	}

	$categories_list = sprintf( '<span>%s</span>',
		trim( $categories_output, $separator )
	);
    


	$readmore = '';

	if(!is_singular() ) {
		$readmore = '<a href="' . get_permalink() . '" class="more-link">' . __( 'Read More', '_t8_children' ) . '</a>';
	}

    //
    // Output.
    //

	  printf( '<p class="p-meta">%2$s%3$s%4$s</p>',
	    $author,
	    $date,
	    $categories_list,
	    $readmore
	  );

  }
endif;

if ( ! function_exists( 't8_featured_image' ) ) :
  function t8_featured_image( $cropped = '' ) {

    if (has_post_format('video')){
		$vid_url = get_field("featured_video", get_the_ID());
		//echo $vid_url;
		echo '<div class="video-container">'.wp_oembed_get( $vid_url, array('width'=>525) ).'</div>';
    
    } elseif ( has_post_thumbnail() ) {

      if ( $cropped == 'cropped' ) {
          $thumb = get_the_post_thumbnail( NULL, 'entry-cropped', NULL );
      } else {
          $thumb = get_the_post_thumbnail( NULL, 'entry', NULL );
      }

      switch ( is_singular() ) {
        case true:
          printf( '<div class="entry-thumb">%s</div>', $thumb );
          break;
        case false:
          printf( '<a href="%1$s" class="entry-thumb" title="%2$s">%3$s</a>',
            esc_url( get_permalink() ),
            esc_attr( sprintf( __( 'Permalink to: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ),
            $thumb
          );
          break;
      }

    }

  }
endif;

function t8_recent_posts($atts){
  $vars = shortcode_atts(array(
     'count' => 2,
     'category' => false,
     'type' => 'post',
     'style' => 'thumbs',
     'author' => '',
     'posts' => '',
  ), $atts);

  $count = $vars['count'];
  $type = $vars['type'];
  $author = $vars['author'];
  $category = $vars['category'];
  $style = $vars['style'];
  $posts = $vars['posts'];
  if ( $posts ) {
    $posts = explode(',', $posts);
  }

  $return_string = '<div class="recent-posts cf">';
  $args = array(
        'orderby' => 'date',
        'order' => 'DESC' ,
        'post_type' => $type,
        'posts_per_page' => $count,
        'post__not_in' => array(get_the_ID()),
  );

  if ( $posts ) {
    $args['post__in'] = $posts;
  }

if($author != '') $args['author_name'] = $author;
if($category != '') $args['category_name'] = $category;

if($style == "text") $return_string .= '<ul class="link-list">';

$query1 = new WP_Query( $args );

while ( $query1->have_posts() ) {
$query1->the_post();


if($style == "text"):

     $return_string .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';

 else:

  $return_string .= '<div class="post-item">';

  if ( has_post_thumbnail() ) {
     $pid = get_post_thumbnail_id( get_the_ID() );
     $pthumb = wp_get_attachment_image_src($pid, 'large', true);
     $return_string .= '<div class="post-img" style="background-image: url('.$pthumb[0].') !important;"><a class="content" href="'.get_permalink().'"></a></div>';
  }
  $return_string .= '<a class="post-details" href="'.get_permalink().'"><h4>'.get_the_title().'</h4><h5 style="text-align: right;">read the story&nbsp;»</h5></a>';
  $return_string .= '</div>';

 endif;


} //endwhile

if($style == "text") $return_string .= '</ul>';

$return_string .= '</div>';

wp_reset_postdata();
return $return_string;

}
add_shortcode( 't8-recent-posts', 't8_recent_posts' );