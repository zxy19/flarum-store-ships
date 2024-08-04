<?php

namespace Xypp\StoreShips\Api\Controller;

use Flarum\Api\Controller\AbstractCreateController;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use \Tobscure\JsonApi\Document;
use Xypp\StoreShips\ShipsResult;

class CreateShipsResultController extends AbstractCreateController
{
    public $serializer = ShipsResultSerializer::class;
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $attributes = Arr::get($request->getParsedBody(), 'data.attributes', []);
        $sum = ShipsResult::max("sum") ?? 0;
        $model = new ShipsResult();
        $model->text = Arr::get($attributes, "text");
        $model->reward = Arr::get($attributes, "reward");
        $model->weight = Arr::get($attributes, "post");
        $model->sum = $sum + $model->weight;
        $model->save();
        return $model;
    }
}