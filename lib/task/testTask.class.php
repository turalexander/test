<?php
class testTask extends sfBaseTask
{
    public function configure()
    {
//        $this->namespace = 'say';
        $this->name      = 'generate';
        $this->addArgument('count', sfCommandArgument::OPTIONAL, 'К-во заказов (по умолчанию 100)', 100);
    }

    public function execute($arguments = array(), $options = array())
    {
        // Натройка подключения к БД
        $configuration = sfProjectConfiguration::getApplicationConfiguration('frontend','dev',true);
        sfContext::createInstance($configuration);
        $databaseManager = new sfDatabaseManager($configuration);
        $databaseManager->loadConfiguration();

        $orders = new Doctrine_Collection('order');
        $orderItems = new Doctrine_Collection('orderItem');

        $startDate = DateTime::createFromFormat('d.m.Y H:i','01.01.2018 09:00');
        echo 'Creating ...';

        for ($i = 0; $i <= $arguments['count']; $i++){
            $order = new Order();
            $startDate->add(new DateInterval("PT{$i}H"));
            $order->created_date = $startDate->format('Y-m-d H:i:s');
            $orders->add($order);

        }

        $orders->save();

        foreach ($orders as $order) {

            for ($j = 1; $j <= rand(1,5); $j++){
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->number;
                $orderItem->product_name = 'Товар-' . $j;
                $orderItem->product_price = rand(100,9999);
                $orderItem->amount = rand(1,10);

                $orderItems->add($orderItem);
            }
        }

        $orderItems->save();

        echo 'Done';
    }
}