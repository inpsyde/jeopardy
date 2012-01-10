<?php /* Template Name: Joepardy */ ?>
<?php get_header(); ?>

<div id="response"></div>

<div id="pad">
<?php
	$x = 1;
	$cat_args = array( 'parent' => 0 );
	$categories = get_categories( $cat_args );
	foreach ( $categories as $category ) :
		?>
        <div id="category">
	        <div id="headline">
	            <?php echo $category -> name; ?>
	        </div>
            <?php
            	$y = 1;
            	$post_args = array( 'category' => $category -> term_id );
            	$posts = get_posts( $post_args );
            	foreach ( $posts as $post ) :
            		?>
                    <div id="answer">
                        <a href="javascript:joepardy.get_answer( <?php echo $post -> ID; ?> );" id="category_<?php echo $post -> ID; ?>"><span><?php the_title(); ?></span></a>
                        <a href="javascript:joepardy.get_question( <?php echo $post -> ID; ?> );" id="answer_<?php echo $post -> ID; ?>" class="hide x<?php echo $x; ?> y<?php echo $y; ?>"><span class="answer"><span class="close">X</span><?php echo get_post_meta( $post -> ID,  'answer', TRUE ); ?></span></a>
                        <a href="<?php the_permalink(); ?>" id="question_<?php echo $post -> ID; ?>" class="hide question"><span class="question"><?php echo get_post_meta( $post -> ID,  'question', TRUE ); ?></span></a>
		            </div>
                    <?php
            		$y++;
            	endforeach;
            ?>
        </div>
        <?php
		$x++;
	endforeach;
?>
   <br class="clear" />
</div>
<p>
    <a href="javascript:joepardy.refresh_game();">Spiel neu starten</a>
</p>

<?php get_footer(); ?>