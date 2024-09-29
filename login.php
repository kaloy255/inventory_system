<?php 
  session_start();
  require('database.php');

  // Functions 
  function pathTo($destination) {
    echo "<script>window.location.href = '$destination.php'</script>";
  }

  if ($_SESSION['status'] == 'invalid' || empty($_SESSION['status'])) {
    //Set Default Invalid 
    $_SESSION['status'] = 'invalid';  
    
      
  }

  // check if status is valid and direct to home page
  if ($_SESSION['status'] == 'valid') {
    pathTo('home');
  }
  
  if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
      echo "Please fill up all fields";
    } else {
      $query = "SELECT * FROM `admin` WHERE username = '$username' AND password = md5('$password')";
      $stmt = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($stmt);

      if (mysqli_num_rows($stmt) > 0) {
        $_SESSION['status'] = 'valid';
        
        pathTo('home');
      
      } else {
        $_SESSION['status'] = 'invalid';

        echo 'Invalid Credential';
      }
    }
  }
?>
<style>
   .line-one{
        border-bottom: 1px solid #3A4A60;
        width: 138px;
        
    }
    .line-two{
        border-bottom: 1px solid #3A4A60;
        width: 138px;
        
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center h-screen relative bg-[#121C20]">
<div class=" p-10 flex bg-[#1A262D] rounded-xl  justify-center items-center text-white">

<div class="w-[600px] p-10  flex flex-col gap-8">
   <div class="flex flex-col gap-5 ">
       <h1 class="font-bold text-5xl text-center text-[#2F9761]">Fcc Inventory</h1>
       <p class="text-gray-400 text-center">Concepcion Fcc Supermarket</p>
   </div>
   <form action="" method="post" class="flex flex-col gap-5">
           <label class="block">
               
               <input type="text" name="username" class="mt-1 px-3 py-2 bg-[#202E36] border shadow-sm border-[#202E36] placeholder-slate-400 focus:outline-none focus:border-[#030499] focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 " placeholder="Username" required/>
           </label>

           <label class="block">
              
               <input type="password" name="password" class="mt-1 px-3 py-2 bg-[#202E36] border shadow-sm border-[#202E36] placeholder-slate-400 focus:outline-none focus:border-[#030499] focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Password" required/>
           </label>



       <label for="">
           <input type="checkbox" name="" id="">
           <span class="ml-2 text-sm">Remember me</span>
       </label>

       

       <input type="submit" value="Login" name="login" class="py-2 px-5 font-semibold text-black bg-[#75E6A4] rounded-lg hover:bg-[#51B77C]">

       <div class="flex flex-col justify-center items-center gap-5 mt-5 self-center">
           <div class="flex gap-2 items-center text-gray-400">
                   <div class="line-one"></div>
                   <p >Or register with</p>
                   <div class="line-two"></div>
           </div>
           <div class="flex gap-5">
               <div class="w-48 border-[1px] border-[#3A4A60] h-12 rounded-md flex justify-center items-center gap-5 hover:text-gray-400 hover:border-2 hover:cursor-pointer">
                   <img src="assets/g-icon.svg" alt="" width="25px">
                   <p>Google</p>
               </div>
               <div class="w-48 border-[1px] h-12 rounded-md border-[#3A4A60] flex justify-center items-center gap-5 hover:text-gray-400 hover:border-2 hover:cursor-pointer">
                   <img src="assets/apple-icon.svg" alt="" width="30px">
                   <p>Apple</p>
               </div>
           </div>
       </div>
   </form>
</div>

<div class="w-[480px] relative">
   <img src="assets/logo.svg" alt="" class="absolute top-10 right-5 z-10">
   <img src="assets/login-bg.jpg" alt="" class="h-[600px] w-[480px] mt-5 rounded-lg blur-sm">
</div>
</div>

</html>