<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <title>Dashboard</title>
  </head>
  <body>
    <!-- <section class="dashboard">
           <div class="navbar">
               <ul>
                   <li>Customer</li>
                   <li>Employee</li>
                   <li>Bill</li>
               </ul>
           </div>
       </section> -->
<?php
$link=new mysqli('localhost','root','','laundry');

$query1=mysqli_query($link,"SELECT sum(total) as total from bill ");
$query2=mysqli_query($link,"SELECT count(cid) as count from customer  ");
$query3=mysqli_query($link,"SELECT count(L_status) as count from user_view where L_status='Done' and P_status='Paid' ");
$t=mysqli_fetch_array($query1);
$total=$t['total'];

$c=mysqli_fetch_array($query2);
$cust=$c['count'];

$cl=mysqli_fetch_array($query3);
$claim=$cl['count'];

?>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin panel</a>
        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">me-auto</span>
          </button> -->
        <!-- <div class="collapse navbar-collapse" id="navbarText"> -->
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="customer.php">Customer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="employee.php">Employee</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bill.php">Bill</a>
          </li>
        </ul>
        <!-- </div> -->
      </div>
    </nav>
    <div class="alert alert-success ml-4">
      <p>
        <b><large>Total Transactions</large></b>
      </p>
      <hr />
      <p class="text-right">
        <b
          ><large>
         <?="₹" . $total ?>
          </large></b
        >
      </p>
    </div>
    <div class="alert alert-danger ml-4">
      <p>
        <b><large>Total Customer Today</large></b>
      </p>
      <hr />
      <p class="text-right">
        <b
          ><large>
   <?=$cust; ?>
          </large></b
        >
      </p>
    </div>
    <div class="alert alert-primary ml-4">
      <p>
        <b><large>Total Paid and Claimed Laundry</large></b>
      </p>
      <hr />
      <p class="text-right">
        <b
          ><large>
  <?=$claim; ?> 
          </large></b
        >
      </p>
    </div>



<?php
$link=new mysqli('localhost','root','','laundry');

$prices=mysqli_query($link,"SELECT * from price");
while($row=mysqli_fetch_array($prices)){
  $h=$row['heavy'];
  $k=$row['kids'];
  $d=$row['delicate'];
  $o=$row['other'];
}

?>
<form action="" method="post">
  <div class="container">
  <div class="input-group mb-3">
    <label>For Delicate</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">₹</span>
  </div>
  <input type="number"  name="delicate" required class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="For Delicate" value="<?php echo $d;  ?>" >
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div> 


<div class="input-group mb-3">
<label>For Kids</label>
  <div class="input-group-prepend">
    <span class="input-group-text">₹</span>
  </div>
  <input type="number" name="kids" required class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="For Kids" value="<?php echo $k;  ?>" >
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div>


<div class="input-group mb-3">
<label for="">For Heavy</label>
  <div class="input-group-prepend">
    <span class="input-group-text">₹</span>
  </div>
  <input type="number" name="heavy" required class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="For Heavy"  value="<?php echo $h;  ?>" >
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div>

<div class="input-group mb-3">
<label for="">For Other</label>
  <div class="input-group-prepend">
    <span class="input-group-text">₹</span>
  </div>
  <input type="number" name="other" required class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="For Other" value="<?php echo $o;  ?>" >
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div>
<input type="submit" name="set" value="SET PRICE" class="btn btn-primary" />
  </div>
  
</form>
    
<?php


if(isset($_POST['set'])){
  $price=mysqli_query($link,"UPDATE price set heavy='$_POST[heavy]',delicate='$_POST[delicate]',kids='$_POST[kids]',other='$_POST[other]' where pid=1 ");
  ?>
  <script>
  window.location.href='dashboard.php';
  </script>
  <?php
  
}

?>

  </body>
</html>
