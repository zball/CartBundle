<?php

namespace ZB\CartBundle;

final class CartEvents{
    
    
    const CART_CREATED = 'zb_cart.created';
    const CART_SET =     'zb_cart.set';
    const ITEM_ADDED =   'zb_cart.item_added';
    const ITEM_UPDATED = 'zb_cart.item_updated';
    const CART_EMPTIED = 'zb_cart.cart_emptied';
    const ITEM_REMOVED = 'zb_cart.item_removed';
}