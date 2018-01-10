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
class QuoteItem extends \fecshop\services\cart\QuoteItem
{
    protected $_itemModelName = '\fecshop\rediscart\models\redis\cart\Item';
    
    
    /**
     * @property $item | Array, example:
     * $item = [
     *		'product_id' 		=> 22222,
     *		'custom_option_sku' => red-xxl,
     *		'qty' 				=> 22,
     * ];
     * 将某个产品加入到购物车中。在添加到cart_item表后，更新
     * 购物车中产品的总数。
     */
    public function addItem($item)
    {
        $cart_id = Yii::$service->cart->quote->getCartId();
        if (!$cart_id) {
            Yii::$service->cart->quote->createCart();
            $cart_id = Yii::$service->cart->quote->getCartId();
        }
        // 查看是否存在此产品，如果存在，则相加个数
        if (!isset($item['product_id']) || empty($item['product_id'])) {
            Yii::$service->helper->errors->add('add to cart error,product id is empty');

            return false;
        }
        $where = [
            'cart_id'    => $cart_id,
            'product_id' => (string)$item['product_id'],
        ];
        if (isset($item['custom_option_sku']) && !empty($item['custom_option_sku'])) {
            $where['custom_option_sku'] = $item['custom_option_sku'];
        }
        $item_one = $this->_itemModel->find()->where($where)->one();
        if ($item_one['cart_id']) {
            $item_one->qty = (int)$item['qty'] + (int)$item_one['qty'];
            $item_one->save();
            // 重新计算购物车的数量
            Yii::$service->cart->quote->computeCartInfo();
        } else {
            $item_one = new $this->_itemModelName;
            $item_one->store        = Yii::$service->store->currentStore;
            $item_one->cart_id      = $cart_id;
            $item_one->created_at   = time();
            $item_one->updated_at   = time();
            $item_one->product_id   = (string)$item['product_id'];
            $item_one->qty          = (int)$item['qty'];
            $item_one->custom_option_sku = ($item['custom_option_sku'] ? $item['custom_option_sku'] : '');
            $item_one->save();
            // 重新计算购物车的数量,并写入sales_flat_cart表存储
            Yii::$service->cart->quote->computeCartInfo();
        }
    }
    
}
