<?php
namespace TFC\Realex;
# 2022-12-07
# «If the customer navigates back from the bank card payment page,
# the cart contents should be restored, and the customer should be redirected back to the Magento checkout page»:
# https://github.com/tradefurniturecompany/realex/issues/1
final class Redirector {
	/**
	 * 2022-12-07
	 */
	static function set():void {df_checkout_session()->setData(self::$K, true);}

	/**
	 * 2022-12-07
	 * https://3v4l.org/4J9n4
	 * @var string
	 */
	private static $K = __CLASS__;
}