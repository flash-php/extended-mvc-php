<?php
  if (isset($data['errors'])) {
    foreach ($data['errors'] as $error)
      echo "<div class='danger'>$error</div>";
  }
?>

<br><br>

<form action="/auth/register" method="post">
  <!-- <input type="hidden" name="method" value="post"> -->

  <label for="fname">Firstname: </label>
  <input type="text" name="firstname" placeholder="firstname" id="fname"
    value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : "" ?>">
  
  <label for="lname">Lastname: </label>
  <input type="text" name="lastname" placeholder="lastname" id="lname"
    value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : "" ?>">
  
  <label for="email">Email: </label>
  <input type="email" name="email" placeholder="email" id="email"
    value="<?= isset($_POST['email']) ? $_POST['email'] : "" ?>">
  
  <label for="pwd">Password: </label>
  <input type="password" name="password" placeholder="password" id="pwd"
    value="<?= isset($_POST['password']) ? $_POST['password'] : "" ?>">

  <label for="pwd2">Re-enter password: </label>
  <input type="password" name="password2" placeholder="re-enter password" id="pwd2"
    value="<?= isset($_POST['password2']) ? $_POST['password2'] : "" ?>">
  <input type="submit" value="Register">
</form>