<?php
$url = $_GET['url'] ?? null;
$amount = $_GET['amount'] ?? null;
?>
<section id="payment-detail" class="p-4 mt-12 mx-auto sm:max-w-screen max-w-4xl border text-center">
  <h1 class="sm:text-4xl text-xl font-bold mb-10">Muchas gracias por preferirnos</h1>

  <h4 class="sm:p-4 p-2 my-4 sm:text-2xl">Tu pago por <?= $amount ?> ha sido exitoso!!</h4>

  <a class="sm:p-4 p-2 border rounded bg-indigo-600 text-white sm:text-2xl sm:w-full hover:cursor-pointer hover:bg-indigo-800" href="<?= $url ?>" target="_blank">Descargar boleta</a>

</section>
