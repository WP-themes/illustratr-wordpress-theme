<?php
/**
 * @package Illustratr
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'illustratr' ) ); ?>
		<?php
			wp_link_pages( array(
				'before'   => '<div class="page-links clear">',
				'after'    => '</div>',
				'pagelink' => '<span class="page-link">%</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php if ( illustratr_validate_gravatar( get_the_author_meta( 'email' ) ) ) : ?>
		<div class="entry-avatar">
			<?php echo get_avatar( get_the_author_meta( 'email' ), '60' ); ?>
		</div><!-- .entry-avatar -->
	<?php endif; ?>

	<header class="entry-header">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'illustratr' ) );
			if ( 'post' == get_post_type() && $categories_list && illustratr_categorized_blog() ) :
		?>
			<span class="cat-links"><?php echo $categories_list; ?></span>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<footer class="entry-meta">
		<?php illustratr_posted_on(); ?>

		<span class="entry-format"><a href="<?php echo esc_url( get_post_format_link( 'status' ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'All %s posts', 'illustratr' ), get_post_format_string( 'status' ) ) ); ?>"><?php echo get_post_format_string( 'status' ); ?></a></span>

		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'illustratr' ) );
			if ( $tags_list ) :
		?>
			<span class="tags-links"><?php printf( __( 'Tagged %1$s', 'illustratr' ), $tags_list ); ?></span>
		<?php endif; // End if $tags_list ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'illustratr' ), __( '1 Comment', 'illustratr' ), __( '% Comments', 'illustratr' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'illustratr' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
