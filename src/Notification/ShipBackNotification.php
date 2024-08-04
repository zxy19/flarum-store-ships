<?php

namespace Xypp\StoreShips\Notification;

use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\MailableInterface;
use Flarum\User\User;
use Symfony\Contracts\Translation\TranslatorInterface;
use Xypp\StoreShips\ShipsResult;

class ShipBackNotification implements BlueprintInterface
{
    public $user;
    public $result;

    public function __construct(ShipsResult $result, User $user)
    {
        $this->result = $result;
        $this->user = $user;
    }

    public function getSubject()
    {
        return $this->result;
    }

    public function getFromUser()
    {
        return $this->user;
    }

    public function getData()
    {
    }

    public static function getType()
    {
        return 'ships_result';
    }

    public static function getSubjectModel()
    {
        return ShipsResult::class;
    }
}