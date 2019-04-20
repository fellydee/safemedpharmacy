<?php
// Slug of pages under each nav
$items = array(
  "inventory"
  , "categories"
  , "suppliers"
  , "add-category"
  , "edit-category"
  , "edit-inventory"
  , "edit-supplier"
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
  , "purchase-invoice"
  , "stock-card"
  , "sku-process"
);

$controlPanel = array(
  "user-account"
  , "add-user-account"
  , "edit-user-account"
  , "log-management"
  , "archive"
  , "backup"
);

function is_nav_active($arr) {
  foreach ($arr as $value) {
    $value = '/safemedpharmacy/' . $value . '.php';

    if (strcmp($_SERVER['REQUEST_URI'], $value) == 0) {

      return true;
    } 
  }

  return false;
}

function is_nav_item_active($slug) {
  $slug = '/safemedpharmacy/' . $slug . '.php';

  if (strcmp($_SERVER['REQUEST_URI'], $slug) == 0) {
    return 'active';
  }

  return '';
}

?>