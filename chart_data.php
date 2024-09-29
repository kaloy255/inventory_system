<?php
require "database.php";

$categories = ['Beverages', 'Snacks', 'Meat', 'Canned Goods', 'Frozen Foods', 'Appliances', 'Hardware'];
$beverageCount = 0;
$snacksCount = 0;
$meatCount = 0;
$cannedCount = 0;
$frozenCount = 0;
$appCount = 0;
$hwareCount = 0;
$sum = 0;

$results=[];

foreach ($categories as $category) {
    $stmt = $conn->prepare("SELECT sum(quantity) FROM inventory WHERE category = ?");
    
    // Bind the parameter category as a string
    $stmt->bind_param('s', $category);
    
    // Execute the statement
    $stmt->execute();
    
    // Bind the result to a variable
    $stmt->bind_result($count);
    
    // Fetch the result
    $stmt->fetch();
    //total of quantity
    $sum += $count;
    
    // reasign totalquantity each category    
    if($category == $categories[0]){
        $beverageCount = $count;
    }
    if($category == $categories[1]){
        $snacksCount = $count;
    }
    if($category == $categories[2]){
        $meatCount = $count;
    }
    if($category == $categories[3]){
        $cannedCount = $count;
    }
    if($category == $categories[4]){
        $frozenCount = $count;
    }
    if($category == $categories[5]){
        $appCount = $count;
    }
    if($category == $categories[6]){
        $hwareCount = $count;
    }


    // Close the statement to avoid "Commands out of sync" error
    $stmt->close();

}
