<?php
namespace TFC\Realex\Observer\Predispatch;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface as IO;
# 2023-01-30
final class Departure implements IO {
	function execute(O $o) {
		xdebug_break();
	}
}