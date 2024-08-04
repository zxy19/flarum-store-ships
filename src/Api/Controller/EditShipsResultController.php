<?php

namespace Xypp\StoreShips\Api\Controller;

use Flarum\Api\Controller\AbstractShowController;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use \Tobscure\JsonApi\Document;
use Xypp\StoreShips\ShipsResult;

class EditShipsResultController extends AbstractShowController
{
    public $serializer = ShipsResultSerializer::class;
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $id = Arr::get($request->getQueryParams(), "id");
        $model = ShipsResult::findOrFail($id);
        $attributes = Arr::get($request->getParsedBody(), 'data.attributes', []);
        $model->text = Arr::get($attributes, "text");
        $model->reward = Arr::get($attributes, "reward");
        $newWeight = Arr::get($attributes, "post");
        $deltaWeight = $newWeight - $model->weight;
        $model->weight = $newWeight;
        $model->save();

        ShipsResult::lockForUpdate()->where("id", ">", $id)->increment($deltaWeight);

        return $model;
    }
}