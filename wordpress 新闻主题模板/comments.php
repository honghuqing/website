<?php
if ( post_password_required() )
return;
?>
<div id="comments" class="comments-area">

<?php // You can start editing here -- including this comment! ?>
<?php if ( have_comments() ) : ?>
	<h2 class="comments-title">
	共有
	<?php
	echo get_comments_number();
	?> 
	条评论
	</h2>
	<div class="col-lg-12">
	<ul class="commentlist">
	<?php wp_list_comments( array( 'callback' => 'newsframe_twentytwelve_comment', 'style' => 'ul' ) ); ?>
	</ul><!-- .commentlist -->
	</div>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<nav id="comment-nav-below" class="navigation" role="navigation">
		<h1 class="assistive-text section-heading"><?php esc_attr_e( 'Comment navigation', 'newsframe' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'newsframe' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'newsframe' ) ); ?></div>
	</nav>
<?php endif; // check for comment navigation ?>
<?php
/* If there are no comments and comments are closed, let's leave a note.
* But we only want the note on posts and pages that had comments in the first place.
*/
	if ( ! comments_open() && get_comments_number() ) : ?>
	<p class="nocomments"><?php esc_attr_e( 'Comments are closed.' , 'newsframe' ); ?></p>
	<?php endif; ?>
<?php endif; // have_comments() ?>

<div style="clear:both"></div>

<div class="col-lg-12">
<?php comment_form(); ?>
</div>
<!-- #comments .comments-area -->
</div>