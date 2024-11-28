<?php
session_start();

use MongoDB\Operation\FindOne;

require '../vendor/autoload.php';

$databaseconnection = new MongoDB\Client;

$myDatabase = $databaseconnection->myDB;

$productcollection = $myDatabase->product;


// Multiple products data
$products = [
    [

        'name' => 'Red Printed T-Shirt',
        'price' => 250.00,
        'image_url' => 'Imges/product-1.jpg',
        'rating' => 4.0,
        'type' => 'T-Shirt',
        'description' => "Give your summer wardrobe a style upgrade with the HRX Men's Active T-shirt. Team it with a pair of shorts for your morning workout or a denims for an evening out with the guys."
    ],
    [
        'name' => 'Fast-x Black Shoes',
        'price' => 450.00,
        'image_url' => 'Imges/product-2.jpg',
        'rating' => 3.5,
        'type' => 'Shoes',
        'description' => 'A traditional running shoe usually has a heel drop of about 10mm and up. It offers lots of cushion in the heel and promotes landing first on the heel as the foot moves through its motion'
    ],
    [
        'name' => 'Sports Classic Track',
        'price' => 500.00,
        'image_url' => 'Imges/product-3.jpg',
        'rating' => 4.5,
        'type' => 'Track-Pant',
        'description' => 'Track pants were made to be used for athletic purposes. Track pants have a tapered leg and a drawstring waist. They are usually made from polyester material to give them a smooth and soft feel.'
    ],
    [
        'name' => 'Blue Printed T-Shirt',
        'price' => 250.00,
        'image_url' => 'Imges/product-4.jpg',
        'rating' => 4.0,
        'type' => 'T-Shirt'
    ],
    [
        'name' => 'Fast-x Gray Shoes',
        'price' => 650.00,
        'image_url' => 'Imges/product-5.jpg',
        'rating' => 4.0,
        'type' => 'Shoes'
    ],
    [
        'name' => 'Black Printed T-Shirt',
        'price' => 250.00,
        'image_url' => 'Imges/product-6.jpg',
        'rating' => 3.5,
        'type' => 'T-Shirt'
    ],
    [
        'name' => 'HRX Socks',
        'price' => 450.00,
        'image_url' => 'Imges/product-7.jpg',
        'rating' => 4.5,
        'type' => 'Socks'
    ],
    [
        'name' => 'Fossil Classy Black Watch',
        'price' => 950.00,
        'image_url' => 'Imges/product-8.jpg',
        'rating' => 4.0,
        'type' => 'Watch',
        'des'=>'Fossil watches are crafted from high-quality materials such as stainless steel, genuine leather, and mineral crystal, providing both durability and style.'
    ],
    [
        'name' => 'Casual Watch',
        'price' => 750.00,
        'image_url' => 'Imges/product-9.jpg',
        'rating' => 4.0,
        'type' => 'Watch'
    ],
    [
        'name' => 'HRX Running Shoes',
        'price' => 1250.00,
        'image_url' => 'Imges/product-10.jpg',
        'rating' => 4.0,
        'type' => 'Shoes'
    ],
    [
        'name' => 'Formal Shoes',
        'price' => 850.00,
        'image_url' => 'Imges/product-11.jpg',
        'rating' => 4.0,
        'type' => 'Shoes'
    ],
    [
        'name' => 'Classic Black Track',
        'price' => 500.00,
        'image_url' => 'Imges/product-12.jpg',
        'rating' => 4.0,
        'type' => 'Track-Pant'
    ],
];


// Insert multiple products into the MongoDB collection
$insertManyResult = $productcollection->insertMany($products);

// Check if the products were inserted
if ($insertManyResult->getInsertedCount() > 0) {
    echo "Products inserted successfully: " . $insertManyResult->getInsertedCount();

    $_SESSION['inserted_product'] = $products;

    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
} else {
    echo "Failed to insert products.";
}
