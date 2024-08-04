<?php

namespace Xypp\StoreShips\Api\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;
use Xypp\StoreShips\ShipsResult;
use InvalidArgumentException;

class ShipsResultSerializer extends AbstractSerializer
{
    /**
     * {@inheritdoc}
     */
    protected $type = 'ships-results';

    /**
     * {@inheritdoc}
     *
     * @param ShipsResult $model
     * @throws InvalidArgumentException
     */
    protected function getDefaultAttributes($model)
    {
        if (!($model instanceof ShipsResult)) {
            throw new InvalidArgumentException(
                get_class($this) . ' can only serialize instances of ' . ShipsResult::class
            );
        }
        return [
            "text" => $model->text,
            "id" => $model->id,
            "weight" => $model->weight,
            "reward" => $model->reward
        ];
    }
}
