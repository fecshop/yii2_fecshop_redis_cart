<p>
  <a href="http://fecshop.appfront.fancyecommerce.com/">
    <img src="http://img.appfront.fancyecommerce.com/custom/logo.png">
  </a>
</p>
<br/>

[![Latest Stable Version](https://poser.pugx.org/fancyecommerce/fecshop_redis_cart/v/stable)](https://packagist.org/packages/fancyecommerce/fecshop_redis_cart)
[![Total Downloads](https://poser.pugx.org/fancyecommerce/fecshop_redis_cart/downloads)](https://packagist.org/packages/fancyecommerce/fecshop_redis_cart)
[![Latest Unstable Version](https://poser.pugx.org/fancyecommerce/fecshop_redis_cart/v/unstable)](https://packagist.org/packages/fancyecommerce/fecshop_redis_cart)
[![License](https://poser.pugx.org/fancyecommerce/fecshop_redis_cart/license)](https://packagist.org/packages/fancyecommerce/fecshop_redis_cart)

Fecshop Redis购物车的实现

> fecshop 采用redis实现底层, 存储用户的cart信息。


安装
-------

```
composer require --prefer-dist fancyecommerce/fecshop_redis_cart 
```

or 在根目录的`composer.json`中添加

```
"fancyecommerce/fecshop_redis_cart": "1.1.0"

```

**注意版本号**: 

fecshop-1.7.1.0以上版本请使用yii2_fecshop_redis_cart-1.2.0以上的版本

fecshop-1.7.0.0以下的版本请使用yii2_fecshop_redis_cart-1.1.0

版本查看：https://github.com/fecshop/yii2_fecshop_redis_cart/releases

https://github.com/fecshop/yii2_fecshop_redis_cart/releases

然后执行

```
composer update
```

配置
-----

1.配置文件复制

将`vendor\fancyecommerce/fecshop_redis_cart\config\fecshop_rediscart.php` 复制到
`@common\config\fecshop_third_extensions\fecshop_rediscart.php`(需要创建该文件)

该文件是扩展的配置文件，通过上面的操作，加入到fecshop的插件配置中

2.redis配置

Cart信息保存到磁盘，因此需要配置redis写入到磁盘，可以参看:
[yii2 – redis 配置](http://www.fancyecommerce.com/2016/05/03/yii2-redis-%E9%85%8D%E7%BD%AE/)
的 `1.2 （可选操作）对于redis的磁盘存储` 部分。

3.配置文件


4.然后，cart信息就存储到redis里面了，该扩展安装在路径 `vendor/fancyecommerce/fecshop_redis_cart`下



