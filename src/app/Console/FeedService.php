<?php
namespace App\Console;


use App\Models\FeedModeler;
use App\Models\FeedFacade;
use App\Exceptions\SaveFeedException;

class FeedService
{
    private $feedModeler;

    public function __construct(FeedModeler $feedModeler = null)
    {
        $this->save($feedModeler);
    }

    private final function save(FeedModeler $feedModeler) : bool {
        $feedFacade = new FeedFacade();
        return $feedFacade->saveArticles($feedModeler->getModeled());
    }
}