<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace fecshop\rediscart\services\cart;

//use fecshop\models\mysqldb\Cart as MyCart;
use fecshop\services\Service;
use Yii;

/**
 * Cart services. 对购物车操作的具体实现部分。
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Quote extends \fecshop\services\cart\Quote
{
    protected $_cartModelName = '\fecshop\rediscart\models\redis\Cart';
    protected $_cartModel;
    
    public function init(){
        parent::init();
    }
    /**
     * @property $address_id | int 用户customer address id
     * @property $shipping_method 货运方式
     * @property $payment_method  支付方式
     * @property bool
     * 登录用户的cart信息，进行更新，更新cart的$address_id,$shipping_method,$payment_method。
     * 用途：对于登录用户，create new address（在下单页面），新创建的address会被保存，
     * 然后需要把address_id更新到cart中。
     * 对于 shipping_method 和 payment_method，保存到cart中，下次进入下单页面，会被记录
     * 下次登录用户进行下单，进入下单页面，会自动填写。
     */
    public function updateLoginCart($address_id, $shipping_method, $payment_method)
    {
        $cart = $this->getCurrentCart();
        if ($cart && $address_id) {
            $cart->customer_address_id  = (int)$address_id;
            $cart->shipping_method      = $shipping_method;
            $cart->payment_method       = $payment_method;

            return $cart->save();
        }
    }
    
    /**
     * 初始化创建cart信息，
     * 在用户的第一个产品加入购物车时，会在数据库中创建购物车.
     */
    protected function actionCreateCart()
    {
        $myCart = new $this->_cartModelName;
        $myCart->store = Yii::$service->store->currentStore;
        $myCart->created_at = time();
        $myCart->updated_at = time();
        if (!Yii::$app->user->isGuest) {
            $identity   = Yii::$app->user->identity;
            $id         = $identity['id'];
            $firstname  = $identity['firstname'];
            $lastname   = $identity['lastname'];
            $email      = $identity['email'];
            $myCart->customer_id        = (int)$id;
            $myCart->customer_email     = $email;
            $myCart->customer_firstname = $firstname;
            $myCart->customer_lastname  = $lastname;
            $myCart->customer_is_guest  = 2;
        } else {
            $myCart->customer_is_guest  = 1;
        }
        $myCart->remote_ip  = \fec\helpers\CFunc::get_real_ip();
        $myCart->app_name   = Yii::$service->helper->getAppName();
        //if ($defaultShippingMethod = Yii::$service->shipping->getDefaultShippingMethod()) {
        //    $myCart->shipping_method = $defaultShippingMethod;
        //}
        $myCart->save();
        $cart_id = $myCart['cart_id'];
        $this->setCartId($cart_id);
        $this->setCart($this->_cartModel->findOne($cart_id));
    }
}
