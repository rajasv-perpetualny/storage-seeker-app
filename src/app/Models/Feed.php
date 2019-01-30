<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 1/11/18
 * Time: 4:19 PM
 */

namespace App\Models;


class Feed extends AbstractParsedModel
{
    use ProtocolFreedom;

    protected $table = 'articles';

    protected $fillable = ['contentId', 'title', 'location', 'description', 'link', 'ts'];

    public function __construct($raw)
    {
        $this->raw = $raw;
        parent::__construct($raw);
    }

    public function validate(): bool
    {
        return true;
    }

}