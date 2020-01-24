<h1>Orders List</h1>
<a href="order/top">Items</a>
<form class = "form" action="" method="post">
    <?php echo $form; ?>
    <input type="submit" value="Send" />
    <input type="button" value="Clear" onClick="window.location.href=window.location.href" />
</form>
<table>
  <thead>
    <tr>
      <th>Дата</th>
      <th>Номер заказа</th>
      <th>Сумма</th>
      <th>Товары</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($orders as $order): ?>
    <tr>
      <td><?php echo $order['date'] ?></td>
      <td><?php echo $order['number'] ?></td>
      <td><?php echo $order['sm'] ?></td>
      <td><?php echo $order['products_info'] ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
