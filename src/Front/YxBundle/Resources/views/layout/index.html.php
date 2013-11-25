<?php $view->extend('AviBundle:Default:base.html.php') ?>



<?php $view['slots']->start('body') ?>
<link href="<?php echo $view['assets']->getUrl('css/style1.css') ?>" rel="stylesheet" type="text/css" />
    <p>Hello dsadas <?php echo $age;?></p>
    <form method="post" action="">
        Name <input type="text" name="fname" >
        <input type="submit" value="Save">

    </form>
<?php $view['slots']->stop() ?>
