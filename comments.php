<?php if ( have_comments() ) : ?>
    <h2>Bisher <?php comments_number( 'wurden keine Kommentare', 'wurde ein Kommentar', 'wurden % Kommentare' ); ?> geschrieben</h2>
    <div id="comments">
        <ol class="commentlist">
    		<?php wp_list_comments( array( 'callback' => 'wpstt_comment' ) ); ?>
        </ol>
    </div>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <div class="navigation">
    	<div class="nav-previous"><?php previous_comments_link( '&laquo; &auml;ltere Kommentare' ); ?></div>
        <div class="nav-next"><?php next_comments_link( 'Neuere Kommentare &raquo;' ); ?></div>
    </div>
	<?php endif; ?>
    
<?php endif; ?>

<?php if ( comments_open() ) : ?>
    <a name="respond"></a>
	<?php comment_form(); ?>
<?php endif; ?>
