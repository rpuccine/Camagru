<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<!-- Optinnal auth Protect -->
<?php
  $montage_id = $_POST['montage_id'];
  $content = $_POST['content'];
  if (!(Comment::post($montage_id, $content))) {
    echo ("error");
    exit();
  }
  else {
    $msg = "post sucess";
  }

  if (!($user = User::get_user_by_id($_POST['user_id']))) {
    $msg2 = "User not find";
    echo ("error");
    exit();
  }
  else if (!($user->send_comment_notif_mail())) {
    $msg2 = "mail failed";
    echo ("error");
    exit();
  }
  else {
    $msg2 = "Mail send";
    echo ("sucess");
  }
?>
