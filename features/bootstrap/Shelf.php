<?php

/**
 * Created by PhpStorm.
 * User: goekh
 * Date: 28.09.2017
 * Time: 22:25
 */
final class Shelf
{
    private $priceMap = array();

    public function setProductPrice($product, $price)
    {
        $this->priceMap[$product] = $price;
    }

    public function getProductPrice($product)
    {
        return $this->priceMap[$product];
    }
}