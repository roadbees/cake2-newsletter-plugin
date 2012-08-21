<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Newsletter Plugin - <?php echo $title_for_layout; ?></title>
  <meta name="description" content="Newsletter Plugin for CakePHP 2.2">
  <meta name="author" content="Nicolas Traeder | Haithem Bel Haj -> for Roadbees (github.com/roadbees">  
  <meta name="viewport" content="width=device-width">
  <?php		

		echo $this->Html->css('Newsletter.extras/kickstart/css/kickstart.css');
		echo $this->Html->css('Newsletter.newsletter.css');
		

		echo $this->fetch('meta');
		echo $this->fetch('css');
			
	?>
</head>
<body class="live">
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  
  <div id="container">
	
	<!-- start content-->
	<div id="content" role="main">
	  <?php echo $this->fetch('content'); ?>
	</div><!-- end content -->
	 
  </div>
  
	
</body>
</html>
