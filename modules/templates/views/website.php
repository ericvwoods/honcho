<?php
/*
  The public website's page (Templates::website()): Inspinia's landing-page look with no member
  side menu. Used by Welcome::website() and Welcome::job(). The content view draws the sections
  (modules/cms/content/views/site/page.php); this file adds the head, the scripts the one-page
  menu needs (scroll, scrollspy, sticky header, WOW) and nothing else.
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= out(isset($page_title) && $page_title !== '' ? $page_title.' | '.SITENAME : SITENAME) ?></title>
    <meta name="description" content="<?= out($page_description ?? SITENAME) ?>">
    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/custom.css" rel="stylesheet">
    <style>
        body.cms-public { background: #fff; }
        .cms-public .cms-login { margin-left: 10px; }
        .cms-public .cms-login a { color: #fff !important; background: #1ab394; border-radius: 3px; padding: 6px 14px !important; margin-top: 9px; }
        .cms-public .cms-page-pad { padding-top: 110px; }
    </style>
</head>
<body id="page-top" class="landing-page cms-public">

<main><?= Template::display($data) ?></main>

<script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.1.1.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/popper.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/bootstrap.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/wow/wow.min.js"></script>
<script>
    $(function(){
        $('body').scrollspy({ target: '#navbar', offset: 80 });

        // menu links scroll smoothly to their section
        $('a.page-scroll').on('click', function(event){
            var target = $($(this).attr('href'));
            if(!target.length){ return; }
            $('html, body').stop().animate({ scrollTop: target.offset().top - 50 }, 500);
            event.preventDefault();
            $('#navbar').collapse('hide');
        });

        // the menu bar gets its solid background once you scroll down
        var header = document.querySelector('.navbar-default');
        function onScroll(){ if(header){ header.classList.toggle('navbar-scroll', window.pageYOffset >= 200); } }
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();

        new WOW().init();
    });
</script>
</body>
</html>
