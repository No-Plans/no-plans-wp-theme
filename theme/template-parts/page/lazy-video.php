<?php

// ====================================================
// Template part for loading responsive videos
// ====================================================

$srcs = [];
// mobile
if (get_field('video_mobile')) $srcs[] = get_field('video_mobile');
// full
if (get_field('video')) {
  $srcs[] = get_field('video');
} else if (get_field('video-link')) {
  $srcs[] = 'https://no-plans.com/private/wp-content/uploads/'. get_field('video-link');
}
$srcset = join(',', $srcs);
$bigimage = isset($bigimage) ? $bigimage : '';
?>

<video loop playsinline muted preload="auto" width="100%" poster='<?php echo $bigimage ?>' data-lazy="loading" data-lazy-srcset="<?=$srcset?>"></video>