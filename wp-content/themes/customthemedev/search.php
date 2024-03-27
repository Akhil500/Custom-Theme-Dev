<?php
get_header();
?>

<article class="content px-3 py-5 p-md-5">
	<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			get_template_part('templates-parts/content','archive');
		}
	}
    else{
        echo '<h3>No post found</h3>';
    }

	?>
</article>


<?php
get_footer();
?>