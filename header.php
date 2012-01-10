<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title><?php bloginfo("name"); ?></title>
  <link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/images/favicon.ico" type="image/x-icon" /> 
  <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo( 'template_url' ); ?>/style.css" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <script type="text/javascript">
    var ajaxurl = '<?php bloginfo( 'url' ); ?>/wp-admin/admin-ajax.php';
  </script>
  <?php if ( is_singular() ) : wp_enqueue_script( 'comment-reply' ); endif; ?>
  <?php wp_head(); ?>
 </head>
 <body>
 
 <div id="wrapper">
  <div id="header">
   <h1><a href="<?php bloginfo( 'home' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
   <div id="meta"><?php wp_nav_menu( array( 'theme_location' => 'nav_header' ) ); ?></div>
   <hr class="clear" />
  </div>