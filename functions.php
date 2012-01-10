<?php

if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus( array (
							'nav_header' => 'Header Navigation',
							'nav_footer' => 'Footer Navigation' ) );
}

if ( ! function_exists( 'enqueue_joepardy_scripts' ) ) {
	function enqueue_joepardy_scripts() {
		wp_enqueue_script( 'joepardy', get_bloginfo( 'template_url' ) . '/js/joepardy.js', array( 'jquery' ) );
	}
}

if ( function_exists( 'add_action' ) ) {
	add_action( 'init', 'enqueue_joepardy_scripts' );
	add_action( 'wp_ajax_get_all_joepardy_term_ids', 'get_all_joepardy_term_ids' );
	add_action( 'wp_ajax_nopriv_get_all_joepardy_term_ids', 'get_all_joepardy_term_ids' );
}

if ( function_exists( 'register_sidebar' ) ) {
        register_sidebar( array (
                'before_widget' => '',
                'after_widget'  => '<hr />',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>' ) );
}

if ( ! function_exists( 'wpstt_comment' ) ) {
	function wpstt_comment ( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' : ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			        <div id="comment-<?php comment_ID(); ?>">
			        <a name="comment-<?php comment_ID(); ?>"></a>
			          <?php echo get_avatar( $comment, 70 ); ?>
			          <em>geschrieben von: <?php comment_author_link(); ?> am: <?php comment_date(); ?> - <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></em>
	                  
	                  <?php if ( $comment->comment_approved == '0' ) : ?>
				          <br /><em>Dein Kommentar wartet auf Freischaltung</em><br />
				      <?php endif; ?>
	                  
			          <?php comment_text() ?>
			          <br class="clear" />
			        </div>
		    	<?php
		    break;
			case 'pingback'  :
			case 'trackback' :
				?>
                <a name="comment-<?php comment_ID(); ?>"></a>
                <div id="comment" <?php comment_class(); ?>>
    		    	<em>Pingback von: <?php comment_author_link(); ?></em>
                </div>
				<?php
			break;
		endswitch;
	}
}

/** Joepardy **/

if ( ! function_exists( 'get_all_joepardy_term_ids' ) ) {
	function get_all_joepardy_term_ids () {
		$rtn = array();
		$cat_args = array( 'parent' => 0 );
		$categories = get_categories( $cat_args );
		foreach ( $categories as $category ) {
			$post_args = array( 'category' => $category -> term_id );
			$posts = get_posts( $post_args );
			foreach ( $posts as $post ) {
				$rtn[ $post -> ID ] = $post -> ID;
			}
		}
		echo json_encode( $rtn );
		die;
	}
}