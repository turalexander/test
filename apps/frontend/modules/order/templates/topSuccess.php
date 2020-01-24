<h1>Items List</h1>
<a href="/order">Orders</a>
<form class = "form" action="" method="post">
    <?php echo $form; ?>
    <input type="submit" value="Send" />
    <input type="button" value="Clear" onClick="window.location.href=window.location.href" />
</form>
<table>
    <thead>
    <tr>
        <th>Имя товара</th>
        <th>Данные</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($products as $name => $product): ?>
        <tr>
            <td><?php echo $name ?></td>
            <td><?php foreach ($product['orders'] as $order) {
                    echo 'Заказ '. $order['number'] . ' - Цена ' . $order['price'] . ' - Дата ' . $order['date'].';<br>';
            } ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
