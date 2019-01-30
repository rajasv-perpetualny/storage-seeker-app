<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 10/2/17
 * Time: 1:12 PM
 */

namespace App\Models;


class Coverage extends AbstractParsedModel
{

    public function validate(): bool
    {
        return true;
    }
}