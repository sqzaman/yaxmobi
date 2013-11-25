<?php
  $count = 0;
  foreach ($audioJokes as $audioJoke) { ?>

   <div id="<?php echo (++$count%2 ? "active" : "no-active") ?>">
   <a href="/songs/preview/<?php echo $audioJoke['id']?>" ><?php echo $audioJoke['composition'] ?></a>
   </div>

<?php } ?>
