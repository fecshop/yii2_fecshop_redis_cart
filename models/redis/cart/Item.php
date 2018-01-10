<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace fecshop\rediscart\models\redis\cart;

use yii\redis\ActiveRecord;

/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Item extends ActiveRecord
{
    public function attributes()
    {
        return [
            'item_id', 
            'store',
            'cart_id', 
            'created_at',
            'updated_at',
            'product_id',
            'qty',
            'custom_option_sku',
        ];
    }
    public static function primaryKey()
    {
        return ['item_id'];
    }
}
