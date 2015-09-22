<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/png" href="http://campusguru.eu1.frbit.net/favicon.ico"/>
  <title><?php if(isset($title)) echo $title; else echo 'Campus Guru'; ?></title>
  <meta charset="utf-8">
  <meta name="msvalidate.01" content="9A742AD490D0DC47C3C133D37576AAE2" />
  <meta name="Description" content="Author: Varun Shrivastava, Illustrator: Campus, Category: Education, About: An online forum solely focused on the students. Have question just post it here, get the help." />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <?php echo link_tag("css/styles.css"); ?>
  <script src="//cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
  <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
  
  <link rel="stylesheet" href="<?= base_url(); ?>css/foundation.css" />
  <script src="<?= base_url(); ?>js/vendor/modernizr.js"></script>
  <link rel="stylesheet" href="<?= base_url(); ?>css/mystyle.css">   <!-- Html::script("js/myjs.js")  -->

 <?php if(isset($links)): ?>
  <?php foreach ($links as $l): ?>
    <link rel="stylesheet" type="text/css" href="<?= $l; ?>">
  <?php endforeach; ?>
<?php endif; ?>
<?php if(isset($scripts)): ?>
  <?php foreach ($scripts as $s): ?>
    <script type="text/javascript" src="<?= $s; ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>
</head>
<body>

  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=646422418788927";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>