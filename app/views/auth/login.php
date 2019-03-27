<?php
  if (isset($data['errors'])) {
    foreach ($data['errors'] as $error)
      echo "<div class='danger'>$error</div>";
  }
?>

<form action="/auth/login" method="post">
  <input type="email" name="email" placeholder="email">
  <input type="password" name="password" placeholder="password">
  <input type="submit" value="Login">
</form>