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