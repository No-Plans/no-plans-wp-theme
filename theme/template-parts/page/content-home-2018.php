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

<article id="page-<?php the_ID(); ?>" class='home'>

	<!-- get Options Page -->
	<?php $optionspage = get_page_by_title( 'Global Options' ); ?>

  	<div class='intro-container'>
  		<!-- <div class="bg" style='background-image: url(<?php the_post_thumbnail_url('large') ?>)'> -->
  		<div class="bg" style='background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/BG-sharp.jpg)'>
			</div>
  		<div class='trunk gutters'>
		   	<div class='big-text'>
		   		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/noplans-logo.svg" class='big-logo'>
		      	<?php the_field('short_intro') ?> 
		    </div>
	    </div>
	</div>


	



	<!-- Latest -->
	<?php 

	$projects = get_field('latest');

	if( $projects ): ?>
	    <?php foreach( $projects as $post): // variable must be called $post (IMPORTANT) ?>
	        <?php setup_postdata($post); ?>
	        <?php 
				$image = get_field('poster');
				$bigimage = $image['sizes'][ 'large' ];
			?>
	        <section id='latest' class='section case-study new'>
	        	<div>
		        	<hr>
				    <div class='trunk gutters'>
				    	<div class='float-container'>
					    	<span class='new-label'>New</span>
				            <h1><?php the_title(); ?></h1>
				        </div>
		            	<div class='big-text'>
		            		<?php the_field('description'); ?>
		            	</div>
		            </div>
	            </div>
		        <div class=' video'>
		        	<div class='trunk float-container'>
			        	<div class="video-wrapper L-3-4 M-1-1 gutters">
					        <video autoplay loop playsinline muted preload='auto' width="100%"  poster='<?php echo $bigimage ?>'>
					        	<?php if(get_field('video')): ?>
					        		<source src="<?php the_field('video') ?>" type="video/mp4" />
					        	<?php elseif(get_field('video-link')): ?>
					        		<source src="https://no-plans.com/private/wp-content/uploads/<?php the_field('video-link') ?>" type="video/mp4" />
					        	<?php endif; ?>
					        </video>
					    </div>
					    <div class="caption gutters">
					    	<?php if(get_field('url')): ?>
				      			<a class='site-link' href='<?php the_field('url') ?>' target='_blank'><?php the_field('link-label') ?></a>
				      		<?php endif; ?>
				      		<?php the_field('facts_public') ?>
					    </div>
					</div>
				</div>
	        </section>
	    <?php endforeach; ?>
	    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

	    

	    
	<?php endif; ?>



	<!-- Case Studies -->
	<?php 

	$projects = get_field('featured');

	if( $projects ): ?>
	    <?php foreach( $projects as $post): // variable must be called $post (IMPORTANT) ?>
	        <?php setup_postdata($post); ?>
	        <?php 
				$image = get_field('poster');
				$bigimage = $image['sizes'][ 'large' ];
			?>
	        <section id='case-studies' class='section case-study'>
	        	<div>
		        	<hr>
				    <div class='trunk gutters'>
			            <h1><?php the_title(); ?></h1>
		            	<div class='big-text'>
		            		<?php the_field('description'); ?>
		            	</div>
		            </div>
	            </div>
		        <div class=' video'>
		        	<div class='trunk float-container'>
			        	<div class="video-wrapper L-3-4 M-1-1 gutters">
					        <video autoplay loop playsinline muted preload='auto' width="100%"  poster='<?php echo $bigimage ?>'>
					        	<?php if(get_field('video')): ?>
					        		<source src="<?php the_field('video') ?>" type="video/mp4" />
					        	<?php elseif(get_field('video-link')): ?>
					        		<source src="https://no-plans.com/private/wp-content/uploads/<?php the_field('video-link') ?>" type="video/mp4" />
					        	<?php endif; ?>
					        </video>
					    </div>
					    <div class="caption gutters">
					    	<?php if(get_field('url')): ?>
				      			<a class='site-link' href='<?php the_field('url') ?>' target='_blank'><?php the_field('link-label') ?></a>
				      		<?php endif; ?>
				      		<?php the_field('facts_public') ?>
					    </div>
					</div>
				</div>
	        </section>
	    <?php endforeach; ?>
	    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

	<?php endif; ?>




	<!-- Information -->
	<section id='information' class="section information">
		<hr>
			<div class='trunk float-container'>
				<div class='L-1-2 M-1-1 gutters about-us'>
					<?php the_field('about_us') ?>
				</div>
				<div class='L-1-2 M-1-1 gutters clients'>
					<?php the_field('clients') ?>
				</div>

				<div class='L-1-1 float-container contact'>
					
 					<h2 class='gutters L-1-1 M-hide S-show'>Contact</h2>

					<div class="addresses float-container L-1-1">

						<?php while( have_rows('emails', $optionspage->ID) ): the_row(); 
							// vars
							$link = get_sub_field('link');
							$label = get_sub_field('label');
							?>
							<div class='email gutters L-1-4 M-1-1'>
								<a class='' href="mailto:<?php echo $link; ?>"><?php echo $label; ?></a>
							</div>
						<?php endwhile; ?>

						<?php while( have_rows('addresses', $optionspage->ID) ): the_row(); 
							// vars
							$address = get_sub_field('address');
							?>
							<div class="address L-1-4 M-1-2 gutters"><?php echo $address; ?></div>
						<?php endwhile; ?>

					</div>
				</div>


				<ul class="links inline-block-container L-1-1 gutters">

					<?php while( have_rows('links', $optionspage->ID) ): the_row(); 
						// vars
						$link = get_sub_field('link');
						$label = get_sub_field('label');
						?>
						<li class="address"><a class='site-link' href="<?php echo $link; ?>" target='_blank'><?php echo $label; ?></a></li>
					<?php endwhile; ?>

				</ul>

			<div class='newsletter L-1-2 M-3-4 S-1-1 gutters'>
				<form action="https://noplans.createsend.com/t/t/s/jrlrlj/" method="post" id="subForm" class='form L-1-1'>
			        <label for="fieldEmail" class='label'></label>
			        <input id="fieldEmail" name="cm-jrlrlj-jrlrlj" type="email" required class='email L-1-1' placeholder='Email'/>
			        <button type="submit" class='button submit'>Subscribe</button>
			    </form>
			</div>

		</div>
	</section>


	<!-- Archive -->

	<?php 
	$projects = get_field('archive');
	if( $projects ): ?>
		
		<section id='archive' class="section archive">
		  	<hr>

		    <div class='projects'>

			    <?php foreach( $projects as $post): // variable must be called $post (IMPORTANT) ?>
			        <?php setup_postdata($post); ?>
			        <?php 
						$image = get_field('poster');
						$medium = 'medium'; // (thumbnail, medium, large, full or custom size)
						$large = 'large';
						$url = $image['url'];
						$alt = $image['alt'];

						$size = 'thumbnail';
						$thumb = $image['sizes'][ $medium ];
						$bigimage = $image['sizes'][ $large ];
					?>

			        <div class='project all <?php
									$posttags = get_the_tags();
									if ($posttags) {
									  foreach($posttags as $tag) {
									    echo $tag->name . ' '; 
									  }
									}
								?>
								'>

				        <header class='project-toggle project_closed'>
				        	<div class='trunk flex-container'>
				        		
								<div class='thumbnail flex-1-2 L-1-8 M-1-6 S-1-4'>
									<div class='thumbnail-wrapper'>
										<img src="<?php echo $thumb ?>" <?php echo $alt ?> class='poster'>
									</div>
									<div class='bg'></div>
									<div class='play'>
										  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/triangle.svg">
									</div>
								</div>

						        <div class='project-title float-container flex-1 L-3-4 M-1-2 S-3-4'>
						        	<h2 class='L-1-1'><?php the_title(); ?></h2>
						        	<div class='L-1-2 S-1-1'>
						        		<span class='region'>
						        			<?php the_field('region') ?> — 
						        		</span>
						           		<?php
											$posttags = get_the_tags();
											if ($posttags) {
											  foreach($posttags as $tag) {
											    echo '<span class="tag">' . $tag->name . '<span class="separator">, </span></span>'; 
											  }
											}
										?>
						           	</div>
								</div>

								<div class='flex-1'>
								    <?php if(get_field('url')): ?>
								      	<a class='site-link' href='<?php the_field('url') ?>' target='_blank'>
								      		Visit Site
								      	</a>
								     <?php else: ?>
								     	<div class='no-link'>
								      		
								      	</div>
									<?php endif; ?>
							    </div>
							</div>

				        </header>

				        <div class='project-content'>
					        <div class='video float-container trunk'>
					        	<div class="video-wrapper L-3-5 M-1-1 gutters">
							        <video loop playsinline muted preload='auto' width="100%"  poster='<?php echo $bigimage ?>'>
							        	<?php if(get_field('video')): ?>
							        		<source src="<?php the_field('video') ?>" type="video/mp4" />
							        	<?php elseif(get_field('video-link')): ?>
							        		<source src="https://no-plans.com/private/wp-content/uploads/<?php the_field('video-link') ?>" type="video/mp4" />
							        	<?php endif; ?>
							        </video>
							    </div>
							    
					      	 	<div class='caption gutters'>
					      	 		<div class='description'>
						      	 		<?php the_field('description') ?>
					      	 		</div>
					      	 		<div class='facts'>
					      				<?php the_field('facts_public') ?>
					      			</div>
					      			<?php if(get_field('url')): ?>
								      	<a class='site-link L-hide M-hide S-show' href='<?php the_field('url') ?>' target='_blank'>
								      		Visit Site
								      	</a>
								    <?php else: ?>
									<?php endif; ?>
					      		</div>

					        </div>
				        </div>

			        </div>
			    <?php endforeach; ?>
			    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

			</div>

	</section>
	<?php endif; ?>


	<div class='thankyou L-1-1'>
		<div class='trunk'>
			<div class='gutters'>
				<?php the_field('thankyou') ?>
			</div>
		</div> 
	</div>



</article><!-- page -->
