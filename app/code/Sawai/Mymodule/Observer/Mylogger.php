<?php

namespace Sawai\Mymodule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use \Psr\Log\LoggerInterface;
use \Magento\Customer\Model\Session;
use \Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\Request\Http;

class Mylogger implements ObserverInterface
{
  protected $logger;
  protected $session;
  protected $customerRepository;
  protected $request;

  public function __construct(LoggerInterface $logger, Session $session, CustomerRepositoryInterface $customerRepository, Http $request)
  {
    $this->logger = $logger;
    $this->session = $session;
    $this->customerRepository = $customerRepository;
    $this->request = $request;
  }

  public function execute(Observer $observer)
  {
    //product
    $product = $observer->getEvent()->getProduct();
    $productName = $product->getName();
    //customer
    if($this->session->isLoggedIn()) {
      $customer = $this->customerRepository->getById($this->session->getCustomerId());
      $cusname = $customer->getFirstname();
    } else {
      $cusname = "Guest user";
    }
    //quantity
    $params = $this->request->getParams();
    $qty = $params['qty'];

    $this->logger->info("Customer name: ".$cusname.", Product Name: ".$productName.", Qty: ".$qty);
  }
}