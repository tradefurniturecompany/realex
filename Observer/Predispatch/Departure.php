<?php
namespace TFC\Realex\Observer\Predispatch;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface as IO;
use TFC\Realex\Redirector as R;
# 2023-01-30
final class Departure implements IO {
	/**
	 * 2023-01-30
	 * @override
	 * @see IO::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 */
	function execute(O $o):void {
		R::set();
	}
}