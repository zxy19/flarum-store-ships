<?php

namespace Xypp\StoreShips;

use Flarum\Foundation\ValidationException;
use Flarum\Locale\Translator;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;
use Xypp\StoreShips\ShipsResult;

class ShipsResultRepository
{
    protected Translator $translator;
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }
    public function getRandom($seed): ShipsResult
    {
        mt_srand($seed);
        $maxSum = ShipsResult::max("sum") ?? 0;
        if ($maxSum == 0) {
            throw new ValidationException([
                "msg" => $this->translator->trans("xypp-store-ships.api.no-configuration")
            ]);
        }
        $rnd = mt_rand(0, $maxSum);
        return ShipsResult::orderByDesc("sum")->where("sum", "<=", $rnd)->first();
    }
}
