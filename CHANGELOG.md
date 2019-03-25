#0.2.26

- [changed] Changes to the request when adding items to a basket to prevent recursive queries.

#0.2.25

- [fixed] Make sure `min_batch` gets passed to the API resource

#0.2.24

- [improved] `min_quantity` validation now includes the minimum quantity required in the validation message.
- [added] Added a `min_batch` column on `product_variants` which defaults to `1` means you can have a minimum batch size a product can be ordered in, validation message is `You must add this item in multiples of :min_batch`

#0.2.23

- [added] Added factor tax to product variant transformer
- [added] Added `minQuantity` to `BasketValidator` when adding a variant to the basket
- [fixed] Fixed wrong offline payment type being referenced in base config

#0.2.22

- [fixed] Fixed issue where 404 wasn't thrown on product endpoint
- [fixed] Fixed issue where you couldn't search on the users endpoint
- [fixed] `ChannelResource` now only includes `published_at` if it exists on relation pivot

#0.2.21

- [fixed] Fixed contraint that prevented shipping prices from being deleted.
- [added] Added `image` include for `ProductVariantResource`
- [added] Added `groups` include for `ProductTierResource`
- [added] Added a `getFullName` getter for user details

#0.2.20

- [fixed] Make sure default channel is set on new products

#0.2.19

- [changed] Changed key check on order `tracking_no` to `array_key_exists` to handle any value
- [improved] Add variant and option data to order line when resolving lines.
- [added] Added a CandyApi util class
- [changed] Change check on `TaxCalculator` to `is_null` to allow for passing `0`
- [changed] Simplified the price calculator logic.

#0.2.18

- [fixed] Fixed SKU mapping that stopped you from sorting on it in Elastic.
- [fixed] Fixed undefined variable on order processing factory when a closure was used.
- [fixed] Fixed invalid namespace for listener.

#0.2.17

- [fixed] Fixed exception handling on a route

#0.2.16

- [fixed] Fixed issue where `published_at` date for category channel wasn't being returned in the resource.

#0.2.15

- [fixed] Fixed issue where category children weren't honouring the nested set order when loaded via relation.

#0.2.14

- [fixed] Fixed channel not being set on category query.
- [added] Added new Activity Log for orders initially.
- [added] Added `firstOrder` relation on the User model.

#0.2.13

- [improved] Improved handling of order reference increment

#0.2.12

- [fixed] Fixed issue with installer due to country column change
- [added] Added config for order table columns in the hub
- [changed] Order settings now pass through all config

#0.2.11

- [changed] Changed plugin loader to not require file extension, this was causing some issues on specific nginx servers.
- [fixed] Allow tracking no to be set to null on orders

#0.2.10

- [fixed] Fixed issue where updating shipping price zeroed out order totals.
- [changed] Updated the set shipping price method for DI.
- [fixed] Fixed offline payment driver, was a bit outdated.

#0.2.7

- [fix] Remove left over calls to countries json columns

#0.2.6

- [added] You can now specify search config for the client.

``` php
    // Rest of getcandy.php config
    'search' => [
        'client_config' => [
            'elastic' => [
                'host' => null,
                'port' => null,
                'path' => null,
                'url' => null,
                'proxy' => null,
                'transport' => null,
                'persistent' => true,
                'timeout' => null,
                'connections' => [], // host, port, path, timeout, transport, compression, persistent, timeout, username, password, config -> (curl, headers, url)
                'roundRobin' => false,
                'log' => false,
                'retryOnConflict' => 0,
                'bigintConversion' => false,
                'username' => null,
                'password' => null,
            ]
        ],
    ]
```

#v0.2.5

- [fixed] Fixed order notes and customer reference not saving on order.
- [fixed] Fixed exception when retrieving the current basket if the authenticated user never had one before.
- [changed] Don't round tiered pricing, comes back as three decimal places.
- [changed] The country name column in the database is now a text field, we aim to support translation files instead for this.

#v0.2.4

- [fixed] Fixed issue with order searching caused by changing variant to description on order lines.

#v0.2.3

- [added] Added created_at to the transaction resource

# v0.2.2

- [added] Ability to set custom attributes on resources, just call `$model->setCustomAttribute('foo', 'bar');`.
- [improved] Improved the way basket totals were displaying when discounts were applied.
- [fixed] Fixed issue where basket wasn't acknowledging free products in discounts.
- [fixed] Braintree payment driver is more up to date.
- [added] Added group helper for users and customer groups, you can call `$user->inGroup('retail')`.
- [changed] Changed the country column to a text column in the countries table.
- [improved] The shipping method calculator for an order now takes into account zones.
- [fixed] Fixed error where orders tripped over when no settings were present in the database.
- [fixed] Regional shipping calculator now takes into account no minimum basket values.
- [fixed] Fixed issue where an order wouldn't allow a zone not to have a name.
- [changed] Resolve the Guzzle client out of the container on the SagePay payment driver.
