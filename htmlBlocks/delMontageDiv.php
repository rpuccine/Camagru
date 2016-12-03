<div class="gal center">
  <form action="/pages/delMontage.php" method="post">
    <img src=<?php echo($montage->get_src()) ?> alt="">
    <input type="hidden" name="id"
      value="<?php echo($montage->get_id()) ?>">
    <input type="submit" value="Spprimer">
  </form>
</div>
