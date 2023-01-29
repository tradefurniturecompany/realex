<?php
namespace TFC\Realex;
use Magento\Checkout\Model\Session;
use Magento\Sales\Model\Order as O;
# 2022-12-07
# «If the customer navigates back from the bank card payment page,
# the cart contents should be restored, and the customer should be redirected back to the Magento checkout page»:
# https://github.com/tradefurniturecompany/realex/issues/1
final class Redirector {
	/**
	 * 2023-01-29
	 */
	static function is():bool {return !!df_checkout_session()->getData(self::$K);}

	/**
	 * 2022-01-29
	 * I have implemented it by analogy with:
	 * 1) \Df\Payment\CustomerReturn::execute():
	 * https://github.com/mage2pro/core/blob/9.2.8/Payment/CustomerReturn.php#L45-L66
	 * 2) \Df\Payment\W\Strategy\ConfirmPending::_handle():
	 * https://github.com/mage2pro/core/blob/9.2.8/Payment/W/Strategy/ConfirmPending.php#L124-L156
	 */
	static function restoreQuote():void {
		$s = df_checkout_session(); /** @var Session $s */
		if (($o = $s->getLastRealOrder()) && $o->canCancel()) { /** @var O $o */
			$o->cancel()->save();
		}
		$s->restoreQuote();
		# 2016-05-06 «How to redirect a customer to the checkout payment step?» https://mage2.pro/t/1523
		df_redirect_to_payment();
	}

	/**
	 * 2022-12-07
	 * @used-by \TFC\Realex\Observer\Predispatch\Departure::execute()
	 */
	static function set():void {df_checkout_session()->setData(self::$K, true);}

	/**
	 * 2023-01-29
	 */
	static function unset():void {df_checkout_session()->unsetData(self::$K);}

	/**
	 * 2022-12-07 https://3v4l.org/4J9n4
	 * @used-by self::set()
	 * @var string
	 */
	private static $K = __CLASS__;
}