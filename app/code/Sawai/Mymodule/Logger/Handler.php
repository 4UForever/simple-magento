<?php

namespace Sawai\Mymodule\Logger;

use Magento\Framework\Logger\Handler\Base as BaseHandler;
use Monolog\Logger;

class Handler extends BaseHandler
{
    protected $loggerType = Logger::INFO;
    protected $fileName = '/var/log/product_tracking.log';
}