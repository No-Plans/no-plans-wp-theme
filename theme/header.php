<?php
/**
 * The header for our theme
 *
 * *
 * @package WordPress
 * @subpackage No Plans Pitches
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <link rel="profile" href="http://gmpg.org/xfn/11"> -->

<?php if ( is_page( 'home' ) ): ?>
	<title>No Plans</title>
<?php else: ?>
	<title>No Plans for <?php the_title() ?></title>
<?php endif ?> 

	<meta name="description" content="No Plans is <?php the_field('short_intro') ?>">
	<meta name="keywords" content="website, design, london, new york, web, development, digital, graphic">
	<meta name="author" content="No Plans">

	<!-- Social Media -->

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@noplansstudio" />
	<meta name="twitter:creator" content="@noplansstudio" />
	<meta property="og:url" content="https://no-plans.com" />
	<meta property="og:title" content="No Plans" />
	<meta property="og:description" content="No Plans is <?php the_field('short_intro') ?>" />
	<meta property="og:image" content="https://no-plans.com/img/no-plans-social.png" />


<?php wp_head(); ?>

<!-- Style -->
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon-earth.gif" type="image/gif" >
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/framework.css" type="text/css">  
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css" type="text/css">
  
<!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">


<!-- Plugins -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/scripts.js" type="text/javascript"></script> 
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/smoothscroll.js" type="text/javascript"></script> 
</head>

<body <?php body_class(); ?>>

	<?php if ( is_user_logged_in() ): ?>
	 <div class='preview'>Preview</div>  
	<?php endif ?>

	<?php if ( is_page( 'home' ) ): ?>

	<?php else: ?>
		<div class='internet'>
	  		<?php 

			$images = get_field('mood');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)

			if( $images ): ?>
		        <?php foreach( $images as $image ): ?>
		            <?php echo wp_get_attachment_image( $image['ID'], $size ); ?>
		        <?php endforeach; ?>
			<?php endif; ?>
		</div>
	<?php endif ?>


	<div class="site-content-contain">
		<div id="content" class="site-content">
