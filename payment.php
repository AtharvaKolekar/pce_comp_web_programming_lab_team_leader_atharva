<?php
$userInputs = array_merge($_POST);

// Print the posted variables
foreach ($userInputs as $key => $value) {
    // echo "$key: $value <br>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payment</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;0,800;0,900;1,700;1,800;1,900&display=swap');
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins',sans-serif;
}
:root {
    --primary-color: #3ab34a;
    --secondary-color: #f9f9f9;
    
  }
body{
    background: #FEFEFA;
}
.container{
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin-top: 10px;
}
.title{
    font-size: 30px;
    font-weight: 700;
    padding-bottom: 10px;
    border-bottom: 3px solid #3ab34a ;
    margin-bottom: 10px;
}

.box{
    background: #F5F5F5;
    display: flex;
    flex-direction: column;
    padding: 25px 25px;
    border-radius: 20px;
    box-shadow: rgba(80, 85, 91, 0.2) 0px 8px 24px;
}
.form-box{
     width: 550px;
     margin: 0px 10px;
}

.form-box form .field{
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
}

.form-box form .input input{
    height: 40px;
    width: 100%;
    font-size: 16px;
    margin-top: 10px;
    border-radius: 5px;
    padding: 4px;
    color: #434343;
    border: 1px solid #ccc;
    outline: none;
    -moz-appearance: textfield;
}
.btn{
    height: 35px;
    background: var(--primary-color);
    border: 0;
    border-radius: 5px;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    transition: all .3s;
    margin-top: 10px;
    padding: 0px 10px;
    font-weight: bold;
}
.btn:hover{
    opacity: 0.80;
}
.s{
    background-color: #61b33b;
}
.f{
    background-color: #d1001f;
}
    </style>
    </head>
<body>
    <div class="container">
       <div class="box form-box">
        <header class="title">Payment of Rs <?php echo $_POST['amount'];?></header>
        <form action="status.php" method="post" name="success">
               <div class="field input">
                  <input type="number" name="amount" value="<?php echo $_POST['amount'];?>" hidden>
                  <input type="text" name="txnid" value="<?php echo $_POST['txnid'];?>" hidden>
                  <input type="text" name="firstname" value="<?php echo $_POST['firstname'];?>" hidden>
                  <input type="text" name="email" value="<?php echo $_POST['email'];?>" hidden>
                  <input type="text" name="phone" value="<?php echo $_POST['phone'];?>" hidden>
                  <input type="text" name="address1" value="<?php echo $_POST['address1'];?>" hidden>
                  <input type="text" name="address2" value="<?php echo $_POST['address2'];?>" hidden>
                  <input type="text" name="city" value="<?php echo $_POST['city'];?>" hidden>
                  <input type="text" name="state" value="<?php echo $_POST['state'];?>" hidden>
                  <input type="text" name="country" value="<?php echo $_POST['country'];?>" hidden>
                  <input type="text" name="zipcode" value="<?php echo $_POST['zipcode'];?>" hidden>

                  <input type="text" name="status" value="success" hidden>
               </div>
               <div class="field">
                 <button  class="btn s" id="btn">Success</button>
               </div>
         </form>
        <form action="status.php" method="post" name="fail">
               <div class="field input">
                  <input type="number" name="amount" value="<?php echo $_POST['amount'];?>" hidden>
                  <input type="text" name="txnid" value="<?php echo $_POST['txnid'];?>" hidden>
                  <input type="text" name="firstname" value="<?php echo $_POST['firstname'];?>" hidden>
                  <input type="text" name="email" value="<?php echo $_POST['email'];?>" hidden>
                  <input type="text" name="phone" value="<?php echo $_POST['phone'];?>" hidden>
                  <input type="text" name="address1" value="<?php echo $_POST['address1'];?>" hidden>
                  <input type="text" name="address2" value="<?php echo $_POST['address2'];?>" hidden>
                  <input type="text" name="city" value="<?php echo $_POST['city'];?>" hidden>
                  <input type="text" name="state" value="<?php echo $_POST['state'];?>" hidden>
                  <input type="text" name="country" value="<?php echo $_POST['country'];?>" hidden>
                  <input type="text" name="zipcode" value="<?php echo $_POST['zipcode'];?>" hidden>
                <input type="text" name="status" value="fail" hidden>
               </div>
               <div class="field">
                 <button  class="btn f" id="btn">Fail</button>
               </div>
         </form>
       </div>
    </div>
</body>
</html>