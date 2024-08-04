<?php

namespace Xypp\StoreShips;

use Carbon\Carbon;
use Flarum\User\User;
use Xypp\Store\AbstractStoreProvider;
use Xypp\Store\Context\ExpireContext;
use Xypp\Store\Context\PurchaseContext;
use Xypp\Store\Helper\StoreHelper;
use Xypp\Store\PurchaseHistory;
use Xypp\Store\StoreItem;

class ShipsStoreProvider extends AbstractStoreProvider
{
    public $name = "store-ships";
    protected ShipsResultRepository $shipsResultRepository;
    protected StoreHelper $storeHelper;
    public function __construct(ShipsResultRepository $shipsResultRepository, StoreHelper $storeHelper)
    {
        $this->shipsResultRepository = $shipsResultRepository;
        $this->storeHelper = $storeHelper;
    }
    function expire(PurchaseHistory $item, ExpireContext $context): bool
    {
        if (Carbon::now()->lte($item->expire_at)) {
            //Success Done
            $reward = $this->shipsResultRepository->getRandom($item->data);
            $user = $context->getUser();
            [$rewardType, $rewardVal] = explode($reward->reward, ":");
            if ($rewardType == "money") {
                $user->money += $rewardVal;
            } else if ($rewardType == "storeItem") {
                $item = StoreItem::find($rewardVal);
                if (!$item) {
                    $context->exceptionWith("xypp-store-ships.api.no-item-found");
                }
                $this->storeHelper->userPurchase(
                    $user,
                    $item,
                    function ($item, $user, $old = null, PurchaseContext $context) {
                        $context->noConsume();
                        $context->noCostMoney();
                    },
                    true
                );
            } else {
                $context->exceptionWith("xypp-store-ships.api.no-configuration");
            }
            return true;
        } else {
            $context->exceptionWith("xypp-store-ships.api.not-done");
            return false;
        }
    }
    function purchase(StoreItem $item, User $user, PurchaseHistory|null $old = null, PurchaseContext $context): array|bool|string
    {
        mt_srand();
        return mt_rand(0, 999999);
    }
    function useItem(PurchaseHistory $item, User $user, string $data, \Xypp\Store\Context\UseContext $context): bool
    {
        $context->noConsume();
        if (Carbon::now()->lte($item->expire_at)) {
            $context->expireInstantly();
            return true;
        }
        $context->successMessage("xypp-store-ships.api.not-done");
        return true;
    }
}