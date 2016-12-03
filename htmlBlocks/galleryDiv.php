<?php
  $comments = Comment::get_comments_by_montage($montage->get_id());
?>
<div class="gal center">
  <div class="galImg">
    <img src=<?php echo($montage->get_src()) ?> alt="">
  </div>
  <div>
    Likes : <?php echo($montage->get_likes()) ?>
  </div>
  <form action="/scripts/likeMontage.php" method="post">
    <input type="hidden" name="id"
      value="<?php echo ($montage->get_id()) ?>">
      <input type="submit" value="like">
  </form>
  <?php
    foreach ($comments as $comment ) { ?>
      <div class="galCmts">
          <p>
            <?php echo ($comment->get_content()) ?>
          </p>
      </div>
    <?php } ?>
  <div>
    <form action="/scripts/postComment.php" method="post">
      <input type="hidden" name="montage_id"
        value="<?php echo ($montage->get_id()) ?>">
      <input type="hidden" name="user_id"
        value="<?php echo ($montage->get_user_id()) ?>">
      <input class="galNewCmt" type="text" name="content">
      <input type="submit" value="Post">
    </form>
  </div>
</div>
