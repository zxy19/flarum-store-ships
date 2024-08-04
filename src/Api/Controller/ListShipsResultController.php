<?php

namespace Xypp\StoreShips\Api\Controller;

use Flarum\Api\Controller\AbstractCreateController;
use Flarum\Api\Controller\AbstractListController;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use \Tobscure\JsonApi\Document;
use Xypp\StoreShips\Api\Serializer\ShipsResultSerializer;
use Xypp\StoreShips\ShipsResult;

class ListShipsResultController extends AbstractListController
{
    public $serializer = ShipsResultSerializer::class;
    protected function data(ServerRequestInterface $request, Document $document)
    {
        return ShipsResult::all();
    }
}