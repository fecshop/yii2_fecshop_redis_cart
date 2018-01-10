Fecshop Redis Cart
======================

> fecshop 购物车采用redis实现底层


1.安装

```
composer require --prefer-dist fancyecommerce/fecshop_redis_cart 
```

or 在根目录的`composer.json`中添加

```
"fancyecommerce/fecshop_redis_cart": "~1.0.6"

```

然后执行

```
composer update
```

2.redis配置

Cart信息保存到磁盘，因此需要配置redis写入到磁盘，可以参看:
[yii2 – redis 配置](http://www.fancyecommerce.com/2016/05/03/yii2-redis-%E9%85%8D%E7%BD%AE/)
的
`1.2 （可选操作）对于redis的磁盘存储` 部分。

3.配置文件

> 安装完成后，需要将配置文件复制到fecshop的第三方扩展文件夹中

3.1、将文件 `vendor\fancyecommerce/fecshop_redis_cart\config\fecshop_rediscart.php`
复制到 `@common\config\fecshop_third_extensions\` 文件夹下面

3.2、该扩展默认是开启的，如果想关掉配置，可以将
`@common\config\fecshop_third_extensions\fecshop_rediscart.php`的`enable`
设置成`false`



4.然后，cart信息就存储到redis里面了。
该扩展安装在路径 `vendor/fancyecommerce/fecshop_redis_cart`下



