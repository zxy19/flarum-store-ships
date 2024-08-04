<?php

namespace Xypp\StoreShips\Api\Controller;

use Flarum\Api\Controller\AbstractShowController;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use \Tobscure\JsonApi\Document;
use Xypp\StoreShips\ShipsResult;

class DeleteShipsResultController extends AbstractShowController
{
    public $serializer = ShipsResultSerializer::class;
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $id = Arr::get($request->getQueryParams(), "id");
        $model = ShipsResult::findOrFail($id);
        ShipsResult::lockForUpdate()->where("id", ">", $id)->decrement($model->weight);
        $model->delete();
        return $model;
    }
}