<?php get_header(); ?>

<div id="main">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <?php if ( trim( get_post_meta( $post->ID, 'answer', true ) ) != '' ) : ?>
            <h2>Antwort: <?php echo get_post_meta( $post -> ID, 'answer', true ); ?></h2>
        <?php else : ?>
            <h2><?php the_title(); ?></h2>
        <?php endif; ?>
        
        <?php the_excerpt(); ?>
        
        <em class="meta"><small>
            <strong>Artikelinformationen:</strong><br />
            geschrieben von: <?php the_author_link(); ?><br />
            geschrieben am: <?php the_time( 'd.m.Y' ); ?> um <?php the_time( 'H:i' ); ?> Uhr<br />
            abgelegt unter: <?php the_category( ', ' ); ?><br />
            getaggt mit: <?php the_tags( '', ', ' ); ?>
        </small></em>
        <hr />
        
    <?php endwhile; endif; ?>    
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>