<?php

/*
 * This file is part of xypp/flarum-store-ships.
 *
 * Copyright (c) 2024 小鱼飘飘.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Xypp\StoreShips;

use Flarum\Extend;
use Xypp\Store\Extend\StoreItemProvider;
use Xypp\StoreShips\Api\Controller\CreateShipsResultController;
use Xypp\StoreShips\Api\Controller\DeleteShipsResultController;
use Xypp\StoreShips\Api\Controller\EditShipsResultController;
use Xypp\StoreShips\Api\Controller\ListShipsResultController;
use Xypp\StoreShips\Api\Serializer\ShipsResultSerializer;
use Xypp\StoreShips\Notification\ShipBackNotification;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js')
        ->css(__DIR__ . '/less/admin.less'),
    new Extend\Locales(__DIR__ . '/locale'),
    (new Extend\Notification())
        ->type(ShipBackNotification::class, ShipsResultSerializer::class),
    (new Extend\Routes("api"))
        ->get("/store-ships-result", "store-ships-result.list", ListShipsResultController::class)
        ->post("/store-ships-result", "store-ships-result.create", CreateShipsResultController::class)
        ->post("/store-ships-result/{id}", "store-ships-result.update", EditShipsResultController::class)
        ->delete("/store-ships-result/{id}", "store-ships-result.delete", DeleteShipsResultController::class),
    (new StoreItemProvider())
        ->provide(ShipsStoreProvider::class)
];
