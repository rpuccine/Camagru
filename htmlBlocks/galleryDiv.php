<?php
  $comments = Comment::get_comments_by_montage($montage->get_id());
?>
<div class="gal center">
  <div class="galImg">
    <img src=<?php echo($montage->get_src()) ?> alt="">
  </div>
  <div>
    Likes : <span id="like_<?php echo($montage->get_id()); ?>"><?php echo($montage->get_likes()) ?></span>
  </div>
  <form class="form_like" method="post">
    <input type="hidden" name="id"
      value="<?php echo ($montage->get_id()) ?>">
      <input type="submit" value="like">
  </form>
  <div class="galCmts" id="list_comment_<?php echo($montage->get_id()); ?>">
    <?php foreach ($comments as $comment ) { ?>
      <p><?php echo ($comment->get_content()) ?></p>
    <?php } ?>
  </div>
  <div>
    <form class="form_comment" method="post" id="postCmt<?php echo ($montage->get_user_id()) ?>">
      <input type="hidden" name="montage_id"
        value="<?php echo ($montage->get_id()) ?>">
      <input type="hidden" name="user_id"
        value="<?php echo ($montage->get_user_id()) ?>">
      <input class="galNewCmt" type="text" name="content">
      <input type="submit" value="Post">
    </form>
  </div>
</div>
