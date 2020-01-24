<?php

/**
 * order actions.
 *
 * @package    test.loc
 * @subpackage order
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orderActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
      $this->form = new OrderFormFilter();

      $query = Doctrine_Query::create()->from('Order o')
            ->select('o.number, o.created_date as date,oi.product_name as name,COUNT(oi.id) as cn,SUM(oi.product_price) as sm,
            GROUP_CONCAT(concat(oi.product_name," x ",oi.amount)) as products_info')
            ->leftJoin('o.orderItems oi')
            ->groupBy('oi.order_id')
            ->orderBy('o.number ASC');

      if ($request->isMethod('post')){
          $this->form->bind($request[$this->form->getName()]);

          $date = $this->form->getValues()['created_date'];

          $query->andWhere('o.created_date BETWEEN ? AND ?',[$date['from'],$date['to']]);
      }

      $this->orders = $query->fetchArray();
  }

  public function executeTop(sfWebRequest $request)
  {
      $this->form = new OrderFormFilter();

      $query = Doctrine_Query::create()->from('OrderItem oi indexby oi.product_name')
          ->select('oi.product_name')
          ->leftJoin('oi.Order o')
          ->groupBy('oi.product_name')
          ->orderBy('oi.amount DESC');

      $products = $query->limit(100)->fetchArray();

      $productInfoQuery = Doctrine_Query::create()->from('OrderItem oi')
          ->select('o.number as number, o.created_date as date,oi.product_name as name, oi.product_price as price')
          ->leftJoin('oi.Order o')
          ->whereIn('oi.product_name',array_keys($products));

      if ($request->isMethod('post')){
          $this->form->bind($request[$this->form->getName()]);

          $date = $this->form->getValues()['created_date'];
          $productInfoQuery->andWhere('o.created_date BETWEEN ? AND ?',[$date['from'],$date['to']]);
      }

      $productInfo = $productInfoQuery->execute([],Doctrine::HYDRATE_ARRAY_SHALLOW);

      foreach ($productInfo as $info) {
          $products[$info['name']]['orders'][] = [
              'number'=>$info['number'],
              'date'=>$info['date'],
              'price'=>$info['price'],
          ];
      }

      $this->products = $products;
  }
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new OrderForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new OrderForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($order = Doctrine_Core::getTable('Order')->find(array($request->getParameter('number'))), sprintf('Object order does not exist (%s).', $request->getParameter('number')));
    $this->form = new OrderForm($order);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($order = Doctrine_Core::getTable('Order')->find(array($request->getParameter('number'))), sprintf('Object order does not exist (%s).', $request->getParameter('number')));
    $this->form = new OrderForm($order);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($order = Doctrine_Core::getTable('Order')->find(array($request->getParameter('number'))), sprintf('Object order does not exist (%s).', $request->getParameter('number')));
    $order->delete();

    $this->redirect('order/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $order = $form->save();

      $this->redirect('order/edit?number='.$order->getNumber());
    }
  }
}
