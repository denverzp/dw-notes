<?php
/**
 * The template for displaying notes page.
 * @version 1.0
 */
?>
<?php \get_header(); ?>

<div class="wrap">
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php while (\have_posts()) { ?>
	        <?php \the_post(); ?>
	        <article id="post-<?php the_ID(); ?>" <?php post_class('notes__wrap'); ?>>
		        <header class="entry-header">
			        <?php \the_title('<h1 class="entry-title">', '</h1>'); ?>
			        <?php \twentyseventeen_edit_link(); ?>
		        </header><!-- .entry-header -->
		        <div class="entry-content" id="dw-notes-app">
			        <?php \the_content(); ?>
		        </div><!-- .entry-content -->
	        </article><!-- #post-## -->
        <?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php \get_footer();
