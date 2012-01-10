<?php get_header(); ?>

<div id="main">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <?php if ( trim( get_post_meta( $post->ID, 'answer', true ) ) != '' ) : ?>
            <h2><a href="<?php the_permalink(); ?>">Antwort: <?php echo get_post_meta( $post -> ID, 'answer', true ); ?></a></h2>
        <?php else : ?>
            <h2><?php the_title(); ?></h2>
        <?php endif; ?>
        
        <?php the_excerpt(); ?>
        
        <em><small>von: <?php the_author_link(); ?> am: <?php the_time( 'd.m.Y' ); ?> um <?php the_time( 'H:i' ); ?> Uhr<br /></small></em>
        <hr />
        
    <?php endwhile; endif; ?>
    
    <?php if ( have_posts() ) : ?>
        <div id="pagination">
            <div class="alignleft"><?php next_posts_link( '&laquo; &Auml;ltere Eintr&auml;ge' ); ?></div>
            <div class="alignright"><?php previous_posts_link( 'Neuere Eintr&auml;ge &raquo;' ); ?></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>