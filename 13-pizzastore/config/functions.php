<?php

function formatPrice($price){
    $explodedPrice = explode('.', $price);

    return $explodedPrice[0].'€ <span class="card-price-cents">'.$explodedPrice[1].'</span>';
}