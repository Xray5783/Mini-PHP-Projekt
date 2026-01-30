<?php
declare(strict_types=1);

require __DIR__ . '/storage.php';

$errors = [];
$oldName = '';
$oldMsg  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // TODO: read input
    $name = $_POST['name'];
    $msg  = $_POST['message'];

    // TODO: keep old values
    $oldName = $name;
    $oldMsg  = $msg;

    // TODO: validate (name >= 2, message >= 5)
    if(strlen($name) < 2 || strlen($msg) < 5) {
      array_push($errors, "Name or Message is to short");
    }
    else
    {
      add_message($name, $msg);
      header("Location: /");
    }


    // TODO: if ok -> add_message + redirect
}

$messages = load_messages();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mini Guestbook</title>
</head>
<body>
  <h1>Mini Guestbook</h1>

  <?php if ($errors): ?>
    <ul>
      <?php echo $errors[-1] ?>
    </ul>
  <?php endif; ?>

  <form method="post">
    <p>
      <label>
        Name:
        <input name="name" required minlength="1" value="<?php echo $oldName; ?>">
      </label>
    </p>

    <p>
      <label>
        Message:<br>
        <textarea name="message" required minlength="5" rows="4" cols="50"><?php TODO: echo $oldMsg; ?></textarea>
      </label>
    </p>

    <button type="submit">Save</button>
  </form>

  <hr>

  <h2>Messages</h2>

  <?php if (!$messages): ?>
    <p>No messages yet.</p>
  <?php endif; ?>

  <?php foreach ($messages as $m): ?>
    <div>
      <p>
        <strong><?php echo e($m['name']); ?></strong>
        <small><?php echo date($m['message']); ?></small>
      </p>

      <p><?php echo nl2br(e($m['message'])); ?></p>
      <hr>
    </div>
  <?php endforeach; ?>
</body>
</html>
