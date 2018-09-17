# ParamountVentures Commerce: Magento 2 Order Comments

## Description
This extension allows customers to place a comment during the checkout.
The comment field is displayed in the billing step right above the place order button.

Store owners can then see these comments in the backend on the order grid and on the order view page.

### Checkout view
![comment box closed](docs/checkout_comment_closed.png)


![comment box opened](docs/checkout_comment_opened.png)

### Admin panel
![admin panel](docs/admin_panel.png)

## Installation
```
composer require "paramountventures/magento2-deliverlater":"~1.5.0"
php bin/magento module:enable ParamountVentures_DeliverLater
php bin/magento setup:upgrade
```

## Changelog
1.5.0
=============
* Third party contribution: Form selector fallback for compatability with external changes that move the comment field [#24](https://github.com/paramountventures/magento2-deliverlater/pull/24)

1.4.1
=============
* Third party contribution: Fixed it_IT translation csv [#20](https://github.com/paramountventures/magento2-deliverlater/pull/20)

1.4.0
=============
* Third party contribution: Made the comment available in the order list web api `V1/orders` [#18](https://github.com/paramountventures/magento2-deliverlater/pull/18)

1.3.0
=============
* UX changes to the max comment length feature [#15](https://github.com/paramountventures/magento2-deliverlater/issue/15)
* Made the comment available in the order detail web api `V1/orders/{id}` [#15](https://github.com/paramountventures/magento2-deliverlater/issue/15)

1.2.0
=============
* added setting to change initial collapse state of comment field (closed/opened/no collapse) [#14](https://github.com/paramountventures/magento2-deliverlater/issue/14)

1.1.4
=============
* updated composer.json to allow PHP 7.1

1.1.3
=============
* Third party contribution: Dutch translations [#10](https://github.com/paramountventures/magento2-deliverlater/pull/10)
* Third party contribution: Italian translations [#11](https://github.com/paramountventures/magento2-deliverlater/pull/11)

1.1.2
=============
* Fix for fatal error on admin order view page when used with some other extensions [#9](https://github.com/paramountventures/magento2-deliverlater/issues/9)

1.1.1
=============
* Third party contribution: Swedish translations and fixes in German translations [#5](https://github.com/paramountventures/magento2-deliverlater/pull/5)

1.1.0
=============
* Third party contribution: German translations [#2](https://github.com/paramountventures/magento2-deliverlater/pull/2)
* Third party contribution: Optional configuration for maximum comment length [#3](https://github.com/paramountventures/magento2-deliverlater/pull/3)
* Third party contribution: Show order comments in customer account [#4](https://github.com/paramountventures/magento2-deliverlater/pull/4)

1.0.0
=============
initial version

## Technical
To take in account third party payment extensions using custom implementations of Magento_Checkout/js/action/place-order.js to submit the order, this extension sends
the order comment in a separate request during the validation, before the order is placed. It should therefore work out of
the box.




## Uninstall
If you installed this module through composer, then you can run `php bin/magento module:uninstall ParamountVentures_DeliverLater` to automatically
remove the code and drop the columns added by this extension.

*note:* the uninstall command seems bugged and might get stuck at `Removing code from Magento codebase:` (It worked fine for me on a 2.1.0 install but not on a 2.1.4 install). When this happens you should
exit with `ctrl+c` and run 
```
composer update
php bin/magento maintenance:disable
```
See [github issue 3544](https://github.com/magento/magento2/issues/3544)

Alternatively you can manually remove the extension and remove the column `bold_order_comment` from the tables
* quote
* sales_order
* sales_order_grid

## License
MIT
