<?php
/*
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*
* Template Design by Pixel Point Creative.
*/

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once('mods.php');
$totalwidth     = $this->params->get ("totalwidth"); 
$enable_ie6warn = ($this->params->get("enableIe6warn", 1) == 0)?"false":"true";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/joomla.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/styles/<?php echo $this->params->get('styleVariation'); ?>.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/typo.css" type="text/css" />
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template?>/js/smoothsc.js"></script>
<script type="text/javascript" src="templates/<?php echo $this->template ?>/js/cufon-yui.js"></script>
<script type="text/javascript" src="templates/<?php echo $this->template ?>/js/cufon-replace.js"></script>
<script type="text/javascript" src="templates/<?php echo $this->template ?>/js/fonts/<?php echo $this->params->get('fontVariation'); ?>"></script>
<!--[if lte IE 7]><link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ie7.css" type="text/css" /><![endif]-->
<!--[if lte IE 6]><?php if($enable_ie6warn=="true") : ?><script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template?>/js/ie6warning.js"></script><?php endif; ?><![endif]-->
  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-9729091-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body id="bd" style="background:<?php echo $this->params->get('bgVariation'); ?>; color:<?php echo $this->params->get('colorVariation'); ?>">
 <div id="wrapper">
 <div id="innerwrap" style="width:<?php echo ($totalwidth);?>">
<div id="contentwrap" style="width:<?php echo ($totalwidth) - 20;?>px;">
<div id="logo"><div id="title"><a href="index.php" title="<?php echo $this->params->get('alt'); ?>"><?php echo $this->params->get('headline'); ?></a></div>
  <div id="downloadcv"><a href = "http://martinconaghan.dyndns.org/joomla/downloads/MartinConaghan.pdf"> Download CV as PDF </a><br><p>&nbsp;</p></div>  
</div>
<?php if($this->countModules('top')) : ?><div id="top"><jdoc:include type="modules" name="top" style="xhtml" /></div><?php endif; ?>
<?php if($this->countModules('above1')!='' || $this->countModules('above2')!='' || $this->countModules('above3')!=''):?>
<div id="abovewrap">
<div id="abovemods">
<?php if($this->countModules('above1')) : ?><div id="above1<?php echo $abovewidth; ?>"><jdoc:include type="modules" name="above1" style="rounded"/></div><?php endif;?>
<?php if($this->countModules('above2')) : ?><div id="above2<?php echo $abovewidth; ?>"><jdoc:include type="modules" name="above2" style="rounded" /></div><?php endif;?>
<?php if($this->countModules('above3')) : ?><div id="above3<?php echo $abovewidth; ?>"><jdoc:include type="modules" name="above3" style="rounded" /></div><?php endif;?>
</div>
</div>
<?php endif;?>
<div id="contentarea" >
<div class="contentareaback" >
<?php if($this->countModules('breadcrumbs')) : ?><div id="pathway" ><jdoc:include type="modules" name="breadcrumbs" style="raw" /></div> <?php endif; ?>
<jdoc:include type="message" />
<?php if($this->countModules('left')) : ?><div id="left"><jdoc:include type="modules" name="left" style="rounded" /></div><?php endif; ?>
<div id="content<?php echo $contentwidth; ?>"><jdoc:include type="component" style="xhtml"/> </div>
<?php if($this->countModules('right')) : ?><div class="rightcontain"><div class="right"><jdoc:include type="modules" name="right" style="rounded" /></div></div><?php endif; ?>
<div class="clr"></div>
<?php if($this->countModules('user1')!='' || $this->countModules('user2')!=''):?>
<div id="userwrap1"> <?php if($this->countModules('user1')) : ?>
<div id="user1<?php echo $modwidth; ?>"><jdoc:include type="modules" name="user1" style="rounded"/></div>
<?php endif;?>
<?php if($this->countModules('user2')) : ?>
<div id="user2<?php echo $modwidth; ?>"><jdoc:include type="modules" name="user2" style="rounded" /></div>
<?php endif;?>
<?php endif;?>
</div>
</div>
<div id="footerwrap">
<div id="footerwrap1">
  <div id="pplogo"><a target="_blank" href="http://www.pixelpointcreative.com"> <img border="0" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/blank.gif" width="200" height="38" title="Template by Pixel Point Creative" alt="Template by Pixel Point Creative" /></a><a href = "http://martinconaghan.dyndns.org/joomla/downloads/MartinConaghan.pdf"> Download CV as PDF </a><br><p>&nbsp;</p>
  <div id="email"><a href = "mailto:mconaghan@gmail.com"> mconaghan@gmail.com </a><br><p>&nbsp;</p></div></div>
<?php if($this->countModules('footer')) : ?>
<div id="footerwrap2" style="margin:auto;"><div id="footer"><jdoc:include type="modules" name="footer" style="raw" /></div> </div><?php endif;?>
</div>
<div id="up"><a href="#bd"><img border="0" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/top.png" width="50" height="22" title="Go to Top" alt="Go to Top" /></a></div>
</div>
</div>
</div>
</div>
<div class="debug"><jdoc:include type="modules" name="debug" style="raw" /></div>
<script type="text/javascript">Cufon.now();</script>
</body>
</html>
