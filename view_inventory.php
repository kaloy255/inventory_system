<?php 
    require('database.php');
    require('session.php');
    require('chart_data.php');

    $errorMessage = "";
    $formValid = "";
    if(isset($_POST['add-item'])){
        $item_name = $_POST['item-name'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        if($category == "null-category"){
            $errorMessage = "Please Choose the valid Category";
        }else{
            $queryAdd = "INSERT INTO inventory (item_name, category, quantity, price) VALUES ('$item_name', '$category', $quantity, $price);";
             mysqli_query($conn, $queryAdd);

             $formValid = "ADD SUCCESSFULLY";
             echo "<script>
                setTimeout(function() {
                document.getElementById('valid-message').textContent = '';
                document.getElementById('myForm').reset(); // Reset the form
                 }, 3000); // 5000 milliseconds = 5 seconds
            </script>";
        }
      
    }
    if(isset($_POST['get-item'])){
        $item_id = $_POST['item-id'];
        $count_remove = $_POST['count-remove'];
        if($count_remove == 0 || empty($count_remove)){

           

            
        }else{
            $queryUpdate = "UPDATE inventory set quantity = quantity-$count_remove WHERE  item_id = $item_id";
            mysqli_query($conn, $queryUpdate);

            $queryRemove = "DELETE FROM inventory WHERE quantity <= 0";
            mysqli_query($conn, $queryRemove);
            
        }
    }



    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#121C20] flex flex-col">

    <nav class="w-full flex items-center justify-between py-2 pl-10 pr-20">
        <img src="assets/logo.svg" alt="">

        <div class="flex items-center gap-5">
        <div class="flex items-center gap-1 border-[1px] px-5 py-1 rounded-full border-[#626D6E]" id="dashboard">
            <img src="assets/dashboard-icon.svg" alt="" width="20">
            <p class="text-[#626D6E] text-sm"><a href="home.php">Dashboard</a></p>
        </div>
        <div class="flex items-center gap-1 border-[1px] px-5 py-1 rounded-full border-[#626D6E]" id="inventory">
            <img src="assets/inventory-icon.svg" alt="" width="20" >
            <p class="text-[#626D6E] text-sm"><a href="view_inventory.php">Inventory</a></p>
        </div>
        </div>

        <div class="relative z-10">
        <!-- profile -->
        <div class="w-9 h-9 bg-[#F3A952] rounded-full z-10" id="profile">
            <div class="absolute -bottom-[4.3rem] left-0 bg-[#2B3942] w-24 py-2 rounded-lg hidden" id="profile_option">
            <div class="hover:bg-[#455863]">
            <a href="" class="text-white text-sm ml-3">Settings</a>
            </div>
            <div class="hover:bg-[#455863]">
            <a href="logout.php" class="text-white text-sm ml-3 ">Logout</a>
            </div>
            
            </div>
        </div>
        </div>
    </nav>

    <div class="flex items-center gap-[60px] p-2">
        <div class="flex items-center gap-5">
            <p class="text-white text-4xl font-bold">Product</p>
            <div class="text-white border-[1px] border-[#626D6E] px-2 py-1 rounded-lg">
                <p class="text-sm"><?= $sum?> <span class="text-[#626D6E]">Total product</span></p>
            </div>
        </div>

        <div class="w-[40%] h-8">
            <form action="" method="post" class="w-full h-full">
                <input class="w-full h-full px-3 rounded-lg border-[1px] border-[#626D6E] bg-transparent text-white text-sm" type="text" name="search-bar" id="" placeholder="Search product...">
            </form>
        </div>
    </div>

    <div class="flex">

        <div class="w-72 h-[560px] bg-[#1A262D] flex flex-col items-center justify-center rounded-lg self-center ml-3">
            <p class="text-white text-1xl font-bold tracking-wider">Restock Item</p>
            <form action="" method="post" class="flex flex-col gap-5" id="myForm">

                <p class="text-[#FF6565] text-center" id="invalid-message"><?=$errorMessage?></p>
                <p class="text-[#2F9761] text-center" id="valid-message"><?=$formValid?></p>
                <input class="px-2 py-1 border-[1px] border-[#626D6E] bg-transparent rounded-lg text-white text-center text-sm" type="text" name="item-name" id="" placeholder="Item name" required>

                <select class="bg-transparent text-center text-sm text-[#9CA3AF] border-[1px] border-[#626D6E] rounded-lg px-2 py-1" name="category" id="" required>
                    <option class="text-white bg-[#202E36] " value="null-category">Choose Category</option>
                    <?php
                        foreach ($categories as $category) {
                    ?>
                    <option class="text-white bg-[#202E36] " value="<?= $category?>"><?= $category?></option>
                    
                    <?php } ?>
                </select>

                <input class="px-2 py-1 border-[1px] border-[#626D6E] bg-transparent rounded-lg text-white  text-center text-sm" type="number"  placeholder="Quantity" name="quantity" required>

            <!-- <div class="text-white self-center">
                    <button class="border-[1px] border-[#626D6E] px-3 py-1 rounded-md" id="minus-btn">-</button>
                    <input class="bg-transparent w-12 text-center focus:border-none focus:outline-none" type="number"  id="quantity-value">
                    <button class="border-[1px] border-[#626D6E] px-3 py-1 rounded-md" onclick="" id="add-btn">+</button>
            </div> -->

            <input class="px-2 py-1 border-[1px] border-[#626D6E] bg-transparent rounded-lg text-white  text-center text-sm" type="text"  placeholder="Price"  name="price" required>

            <input type="submit" name="add-item" value="Add Product" class="text-sm  font-bold bg-[#5CE796] rounded-lg w-32 p-2 self-center hover:bg-[#75E6A4] mt-5">

            </form>
        
        </div>

        <div class="mt-5 h-[580px] w-full overflow-x-auto relative px-5 mr-5 ">
            <div>
                <?php
                    $search_bar = " ";
                    if(!empty(isset($_POST['search-bar']))){
                        $search_bar = $_POST['search-bar'];

                        $query = "SELECT * FROM inventory WHERE item_name LIKE '%$search_bar%'";
                        $fetch = mysqli_query($conn, $query);
    
                        if($fetch){
                            while($row = $fetch->fetch_assoc()){
                               
                ?>


                    <div class="mb-3 px-5 py-5 bg-[#1A262D] rounded-xl flex justify-between">
                    <div class="min-w-[50%]">
                        <p class="text-white"><?= $row['item_name'];?></p>
                        <div class="flex gap-2 mt-2">
                        <p class="text-black font-semibold bg-[#4DB0E8] rounded-full px-2"><?= $row['category'];?></p>
                        <p class="text-[#626D6E]">Stoked Product <?php if($row['quantity'] <= 50){?><span class="text-red-500"><?=$row['quantity'];?> in stock</span></p>
                        <?php } 
                        else{
                            ?>
                            <span class="text-green-500"><?=$row['quantity'];?> in stock</span></p>
                        <?php
                        }
                        ?>    
                    </div>
                    </div>

                    <div class="flex items-center gap-20 border-l-2 border-[#23323B] pl-10 ">
                        <div class="flex items-center gap-5">
                            <p class="text-[#626D6E] font-semibold">Price</p>
                            <p class="text-white">P <?= $row['price'];?></p>
                        </div>
                        <div>
                            <form action="" method="post" class="flex gap-5 ">
                                <input class="bg-transparent text-center text-sm text-[#9CA3AF] border-[1px] border-[#626D6E] rounded-lg " type="number" name="count-remove" id="">
                                <input class="bg-[#F3A952] text-white px-3 py-1 rounded-full" type="submit" name="get-item" value="Get item">
                                <input type="hidden" name ="item-id" value="<?= $row['item_id']?>">
                            </form>
                        
                        </div>
                    </div>
                    </div>                    
                <?php      
                            }
                        }
                    }
                ?>

                <?php
                    if(!isset($_POST['search-bar']) || empty($search_bar)){
                    
                    $query = "SELECT * FROM inventory";
                    $fetch = mysqli_query($conn, $query);

                    if(!$fetch){
                      echo "failed";
                    }else{
                      while($row = $fetch->fetch_assoc()){
                ?>
              
                <div class="mb-3 px-5 py-5 bg-[#1A262D] rounded-xl flex justify-between">
                  <div class="min-w-[50%]">
                    <p class="text-white"><?= $row['item_name'];?></p>
                    <div class="flex gap-2 mt-2">
                        <p class="text-black font-semibold bg-[#4DB0E8] rounded-full px-2"><?= $row['category'];?></p>
                        <p class="text-[#626D6E]">Stoked Product <?php if($row['quantity'] <= 50){?><span class="text-red-500"><?=$row['quantity'];?> in stock</span></p>
                        <?php } 
                        else{
                            ?>
                            <span class="text-green-500"><?=$row['quantity'];?> in stock</span></p>
                        <?php
                        }
                        ?>    
                    </div>
                  </div>

                  <div class="flex items-center gap-20 border-l-2 border-[#23323B] pl-10 ">
                    <div class="flex items-center gap-5">
                        <p class="text-[#626D6E] font-semibold">Price</p>
                        <p class="text-white">P <?= $row['price'];?></p>
                    </div>
                    <div class="pt-2">
                        <form action="" method="post" class="flex gap-5">
                            <input class="bg-transparent text-center text-sm text-[#9CA3AF] border-[1px] border-[#626D6E] rounded-lg " type="number" name="count-remove" id="">
                            <input class="bg-[#F3A952] text-white px-3 py-1 rounded-full" type="submit" name="get-item" value="Get item">
                            <input type="hidden" name ="item-id" value="<?= $row['item_id']?>">
                        </form>
                     
                    </div>
                  </div>
                </div> 
              
                <?php   
                            } 
                        } 
                    }
                ?>
            </div>
        </div>
    </div>
</body>
    <script>
        document.getElementById("profile").addEventListener("click", function(){
        document.getElementById("profile_option").classList.toggle('hidden');
    });
    </script>
    <style>
        /* Hide arrows in Chrome, Safari, and Edge */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        ::-webkit-scrollbar {
     width: 8px;
    } 

    ::-webkit-scrollbar-track {
        background: #1A262D;
    }

    ::-webkit-scrollbar-thumb {
        background: #303F48;
        border-radius: 6px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }  
    </style>
</html>