<style>
  th{
    text-align:left;
  }
</style>

<?php
  include('../header.php');
?>
<form action="../controller/login-act.php" method="POST">
  <table>
    <tr><th>メールアドレス：</th><td><input type="text" name="mail"></td></tr>
    <tr><th>パスワード：</th><td><input type="text" name="password"></td></tr><br>
    <tr><td><input type="submit" value="ログイン"></td></tr>
  </table>
</form>