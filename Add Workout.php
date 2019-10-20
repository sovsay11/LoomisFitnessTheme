<?php /* Template Name: Add Workout */
 
get_header(); ?>
 
<div id="primary" class="site-content-fullwidth">
    <main id="main" class="site-main">

			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
					
				get_template_part( 'template-parts/content/content', 'page' );
				
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

			endwhile; // End of the loop.
			?>
        
		
    </main><!-- .site-main -->
 
</div><!-- .content-area -->

<?php get_footer(); ?>
<!--The exercise name, weight, # of sets, # of reps should be side by side to each other.
She needs some way to mark that she is going to be increasing either the weight, reps, or both, on the next time that person does that exercise.
She then needs to mark the day that she actually increases the weight, reps, or both. 
She needs to be able to do this for any of the exercises that person is doing any given session. 
We’ll have to brainstorm this one, because I haven’t figured out a good solution for it yet.

Need a checkbox next to each exercise line so that she can mark when it has been completed during the session.-->
