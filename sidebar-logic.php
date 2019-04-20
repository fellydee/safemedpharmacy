<?php

$currentPage = '';

// Slug of pages under each nav
$items = array(
  "inventory"
  , "categories"
  , "suppliers"
  , "add-category"
  , "add-supplier"
);

$stock = array(
  "near-expiry"
  , "expired"
);

$purchases = array(
  "add-purchase-order"
  , "move-purchase-order"
  , "purchase-order"
  , "sku-process"
);

$controlPanel = array(
  "user-account"
  , "add-user-account"
  , "log-management"
  , "archive"
  , "backup"
);

function is_nav_active($arr) {
  foreach ($arr as $value) {
    $value = '/safemedpharmacy/' . $value . '.php';

    if (strcmp($_SERVER['REQUEST_URI'], $value) == 0) {
      $currentPage = $value;
      
      return true;
    } 
  }

  return false;
}

?>