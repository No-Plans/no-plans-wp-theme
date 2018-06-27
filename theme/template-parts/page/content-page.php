<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<nav class='header-menu'>

  <div class='float-container'>
    <ul class='inline-block-container L-1-1'>
      <li>No Plans for <?php the_title(); ?>:<!-- Client Name --></li>
      <li><a href="#top">Introduction</a></li>
      <li><a href="#clients">Clients</a></li>
      <?php 
		$team = get_field('team');
		if( $team ): ?>
		<li><a href="#team">Team</a></li>
	  <?php endif; ?>
      <li><a href="#work-process">Process</a></li>
      <li><a href="#case-studies">Case Studies</a></li>
      <?php 
		if( have_rows('phase') ): ?>
		<li><a href="#proposals">Proposal</a></li>
	  <?php endif; ?>
  
      <li class="arrows">
        <div class="arrows-text">Use <span class='hide'>your keyboard: </span></div><button class="up"> <span class='triangle'>▲</span> </button><button class="down"> <span class='triangle'>▼</span> </button>
      </li>
    </ul>

  </div>
</nav>

<article id="page-<?php the_ID(); ?>" class='private'>

	<!-- Loader --> 
	<div class='loader'>
	  <div class='loading L-1-1 float-container'>
	    <div class=''>
	      No Plans for <?php the_title() ?>
	    </div>
	    <div class="arrows">
	        <div class="arrows-text">Use your keyboard:</div><button class="up"> <span class='triangle'>▲</span> </button><button class="down"> <span class='triangle'>▼</span> </button>
	    </div>
	  </div>
	</div>

	<!-- get Options Page -->
	<?php $opionspage = get_page_by_title( 'Global Options' ); ?>

	<section id='top' class="section about header current" style='background-image: url(<?php the_post_thumbnail_url('full') ?>)'>
	    <hr>
	    <div class='trunk big-text'>
	        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/noplans-logo.svg" class='big-logo'>
	        <?php the_field( 'introduction', $opionspage->ID ); ?>  
	    </div>
  	</section>

	<!-- Clients -->
	<section id='clients' class="section header">
		<hr>
		<div class='trunk'>
		  <h1 class="title">Clients</h1>
		  <div class='big-text'>
		  	<?php the_field('clients') ?>
		  </div>
		</div>
	</section>

	<!-- Team -->
	<?php 

	$team = get_field('team');

	if( $team ): ?>
		<section id='team' class="section header team">
			<hr>
			<div class='trunk'>
				<h1>Team</h1>
					<?php the_field('team') ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- Process -->
	<section id='work-process' class="section header process">
		<hr>
		<div class='trunk'>
			<h1>Typical Process</h1>
			<?php the_field( 'typical_process', $opionspage->ID ); ?>
		</div>
	</section>


	<!-- Case Studies -->
	<?php 

	$projects = get_field('case_studies');

	if( $projects ): ?>
	    <?php foreach( $projects as $post): // variable must be called $post (IMPORTANT) ?>
	        <?php setup_postdata($post); ?>
	        <?php 
				$image = get_field('poster');
				$bigimage = $image['sizes'][ 'large' ];
			?>
	        <section id='case-studies' class='section case-study'>
	        	<hr>
			    <div class='trunk'>
		            <h1><?php the_title(); ?></h1>
	            	<div class='big-text'>
	            		<?php the_field('description'); ?>
	            	</div>
	            </div>
	        </section>
	        <section class='section case-study'>
	        	<div class='trunk float-container video'>
			        	<div class="video-wrapper L-3-4 S-1-1 gutters">

					        	<?php if(get_field('video')): ?>
					        		<video autoplay loop playsinline muted preload='auto' width="100%" class='shadow' poster='<?php echo $bigimage ?>' src="<?php the_field('video') ?>" type="video/mp4" >
					        		</video>
					        	<?php elseif(get_field('video-link')): ?>
					        		<video autoplay loop playsinline muted preload='auto' width="100%" class='shadow' poster='<?php echo $bigimage ?>' src="https://no-plans.com/private/wp-content/uploads/<?php the_field('video-link') ?>" type="video/mp4" >
					        		</video>
					        	<?php endif; ?>
					        
					    </div>
					    <div class="caption L-1-4 gutters">
					    	<?php if(get_field('url')): ?>
				      			<a class='site-link' href='<?php the_field('url') ?>' target='_blank'><?php the_field('link-label') ?></a>
				      		<?php endif; ?>
				      		<?php the_field('facts') ?>
				      		<?php if(get_field('price')): ?>
				      			<ul><li>Budget: <?php the_field('price') ?></li></ul>
				      		<?php endif; ?>
					    </div>
					</div>
				
	        </section>
	    <?php endforeach; ?>
	    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	<?php endif; ?>





  <!-- Brief -->
  <?php 
	$proposals = get_field('objectives');
	if( $proposals ): ?>
	  <section id='proposals' class="section header objectives">
	  	<hr>
	    <div class='trunk'>
	      <h1>Project Objectives</h1>
	   		<div class='big-text'>
	   			<?php the_field('objectives') ?>
	   		</div>
	    </div>
	  </section>
  <?php endif; ?>


  <?php 

	// check for rows (parent repeater)
	if( have_rows('phase') ): ?>
		<section id='proposals' class='proposal section'>

			<hr>
		    <div class='trunk'>
		      <h1>Proposal</h1>
		    </div>

			<div class='float-container trunk'>
				
				<div class="specifications L-1-2 S-1-1 gutters">
				<?php 

				// loop through rows (parent repeater)
				while( have_rows('specs') ): the_row(); ?>
					<div class='phase'>
						<h3 class='phase-title'>
							<?php the_sub_field('spec-title'); ?><span class='number'><?php the_sub_field('spec-note') ?></span>
						</h3>
						<div class='item'>
							<?php the_sub_field('item') ?>
						</div>
					</div>	

				<?php endwhile;  ?>
				</div>


				<div class="phases L-1-2 S-1-1 gutters">
				<?php 

				// loop through rows (parent repeater)
				while( have_rows('phase') ): the_row(); ?>
					<div class='phase'>
						<h3 class='phase-title'>
							<?php the_sub_field('phase-title'); ?><span class='number'><?php the_sub_field('phase-number') ?></span>
						</h3>
						<?php 

						// check for rows (sub repeater)
						if( have_rows('sub-phase') ): ?>
							<?php 

							// loop through rows (sub repeater)
							while( have_rows('sub-phase') ): the_row();

								?>
								<div class='sub-phase'>
									<h4 class='sub-phase-title'>
										<?php the_sub_field('sub-phase-title') ?>
										<span class='number'><?php the_sub_field('number') ?>
									</h4>
									<?php the_sub_field('steps') ?>
								</div>
							<?php endwhile; ?>
						<?php endif;  ?>
					</div>	

				<?php endwhile;  ?>
				</div>
			</div>
		</section>
	<?php endif;  ?>


	<section id='thanks' class="section thanks" style='background-image: url(<?php the_post_thumbnail_url('full') ?>)'>
	    <hr>
	    <div class='trunk'>
	      <h1>Thank you</h1>
	      <div class='description big-text'>
	      	Daniel Baer and Daniel Pianetti. <br>
	      	office@no-plans.com <br>
	      	More of our work can be seen on our website.
	      </div>
	      <a  class='site-link' target='_blank' href="https://www.no-plans.com">no-plans.com</a>
	    </div>
	  </div>
	</section>





</article><!-- page -->
