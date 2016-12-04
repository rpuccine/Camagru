<div class="page center">
  <?php if ($page > 1) { ?>
    <a href='?page=<?php echo ($page - 1) ?>'>prev</a>
  <?php } ?>
  <?php for ($i=1; $i <= $last_page; $i++) { ?>
    <a <?php if ($page == $i) {echo ("class='current'");} ?> href='?page=<?php echo ($i) ?>'><?php echo ($i) ?></a>
  <?php } ?>
  <?php if ($page < $last_page) { ?>
    <a href='?page=<?php echo ($page + 1) ?>'>next</a>
  <?php } ?>
</div>
