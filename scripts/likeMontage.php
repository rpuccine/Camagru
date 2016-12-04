<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<!-- Optinnal auth Protect -->
<?php
  if (!($montage = Montage::get_montage($_POST['id']))) {
    echo ("error");
  }
  else {
    $montage->like();
    echo ($montage->get_likes());
  }
?>
