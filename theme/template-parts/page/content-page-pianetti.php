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
	     <!-- <li><a href="#top">Introduction</a></li>
	      <li><a href="#clients">Clients</a></li>
	      <li><a href="#experience">Experience</a></li>
	      <li><a href="#work-process">Process</a></li>
	      <li><a href="#case-studies">Case Studies</a></li>
	       <li><a href="#proposals">Proposal</a></li> -->
	    
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
	<?php $opionspage = get_page_by_title( 'Global Options Italiano' ); ?>

	<section id='top' class="section about header current" style='background-image: url(<?php the_post_thumbnail_url('large') ?>)'>
	    <hr>
	    <div class='trunk'>
	        <?php the_field( 'introduction', $opionspage->ID ); ?>  
	    </div>
  	</section>

	<!-- Clients 
	<section id='clients' class="section header">
		<hr>
		<div class='trunk'>
		  <h1 class="title">Clienti</h1>
		  <div class='big-text'>
		  	<?php the_field('clients') ?>
		  </div>
		</div>
	</section> -->

	<!-- Experience 
	<section id='experience' class="section header">
		<hr>
		<div class='trunk'>
			<h1>Experience</h1>
				<?php the_field('team') ?>
		</div>
	</section> -->

	<!-- Process -->
	<section id='work-process' class="section header">
		<hr>
		<div class='trunk'>
			<!-- <h1>Processo</h1> -->
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
	        <section class='section video'>
	        	<div class='trunk float-container'>
		        	<div class="video-wrapper S-1-1">
				        <video width="100%" class='shadow' loop autoplay poster='<?php echo $bigimage ?>'>
				        	<?php if(get_field('video')): ?>
				        		<source src="<?php the_field('video') ?>" type="video/mp4" />
				        	<?php elseif(get_field('video-link')): ?>
				        		<source src="https://no-plans.com/private/wp-content/uploads/<?php the_field('video-link') ?>" type="video/mp4" />
				        	<?php endif; ?>
				        </video>
				    </div>
				    <div class="caption">
				    	<?php if(get_field('url')): ?>
			      			<a class='site-link' href='<?php the_field('url') ?>' target='_blank'><?php the_field('link-label') ?></a>
			      		<?php endif; ?>
			      		<?php the_field('facts') ?>
				    </div>
				</div>
				
	        </section>
	    <?php endforeach; ?>
	    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	<?php endif; ?>




	<!-- <section id='thanks' class="section thanks" style='background-image: url(<?php the_post_thumbnail_url('large') ?>)'>
	    <hr>
	    <div class='trunk'>
	      <h1>Grazie,</h1>
	      <div class='description big-text'>
	      	Daniel Baer & Daniel Pianetti <br>
	      	office@no-plans.com <br>
	      	Ulteriori informazioni sul nostro sito:
	      </div>
	      <a  class='site-link' target='_blank' href="https://www.no-plans.com">no-plans.com</a>
	    </div>
	  </div>
	</section>  -->





</article><!-- page -->
