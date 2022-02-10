<?php

namespace Sawai\Mymodule\Block;

class Index extends \Magento\Framework\View\Element\Template
{
	protected $data;
	public function __construct(\Magento\Framework\View\Element\Template\Context $context)
	{
		$this->data = file_get_contents("https://bitbucket.org/acommerce/homework-challenges/raw/a4b76a6f02ec53bb49db541273264fb2cc9c77ef/list.json");
		parent::__construct($context);
	}

	public function sayHello()
	{
		return __('Hello World');
	}

	public function getContents()
	{
		return json_decode($this->data, true);
	}

	public function getStar($star)
	{
		$str = '';
		for($i=1; $i<=5; $i++){
			$active = ($i <= $star)? " active":"";
			$str .= '<span class="star'.$active.'"></span>';
		}
		return $str;
	}

	public function time_elapsed_string($datetime, $full = false)
	{
    $now = new \DateTime;
    $ago = new \DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}
