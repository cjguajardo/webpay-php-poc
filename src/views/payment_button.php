<?php
  $url = $_GET['url'] ?? null;
  $token = $_GET['token'] ?? null;
?>

<form action="<?=$url?>" method="POST" class="sm:text-2xl">
  <input type="hidden" name="token_ws" value="<?=$token?>"/>
  <input class="border rounded p-4 bg-red-600 text-white sm:w-full hover:cursor-pointer hover:bg-red-800" 
    type="submit" 
    value="Pagar"/>
</form>
