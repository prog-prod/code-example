<?php

namespace App\Exceptions;

use Exception;

class ProductQuantityException extends Exception
{

    public function __construct()
    {
        parent::__construct();
        $this->message = __('messages.product_quantity_is_not_in_stock');
    }

}
