
<?php
$db = "zijlspu40_cryptx";
$con = mysql_connect("127.0.0.1:3306","root","") or die(mysql_error());
mysql_select_db($db);
$get_token = $_GET['add'];

//getting details from database
$check = "SELECT * FROM transactions WHERE AMT_TOKEN = '$get_token'";
$query_check = mysql_query($check) or die(mysql_error());
$fetch = mysql_fetch_array($query_check);
if(isset($get_token)){
$add_token = $_GET['add'];
$add_token += $fetch['AMT_TOKEN'];
$date = @date("y-m-d");
$insert = "INSERT INTO transactions_1 (user,AMT_TOKEN,date) VALUES ('8a4c055e4ce6','$add_token','$date')";
$query_token = mysql_query($insert) or die(mysql_error());
$redirect = '<script>window.location.href="http://127.0.0.1/CryptXchange-master/mining.php";</script>';
echo $redirect;
//$redirect = "<script type='text/javascript'>window.location = 'http://127.0.0.1/mining.php'</script>";
}
//Mining the coin
$get_total_token = "SELECT SUM(AMT_TOKEN) AS value_sum FROM transactions_1 WHERE user = '8a4c055e4ce6'";
$query_get_total_token = mysql_query($get_total_token);
$fetch_get_token = mysql_fetch_assoc($query_get_total_token);

//Subtracting the coin from existing supply -> 10000000
$total_supply = "SELECT * FROM tot_amt WHERE admin = 'elexy1010'";
$query_total_supply = mysql_query($total_supply) or die(mysql_error());
$fetch_total_supply = mysql_fetch_array($query_total_supply);

//applying changes to total existing supply -> xxxxxxxxx
$change_supply = $fetch_total_supply['tot_amt'] - $get_token;
$update_supply = "UPDATE tot_amt SET tot_amt = '$change_supply' WHERE admin = 'elexy1010'";
$query_update_supply = mysql_query($update_supply) or die(mysql_error());
?>
<!doctype html>
<html lang="en">
<?php include('header.php');?>

<body  class="text-center" background="img/bg6.png">

               <form action = "<?php echo $_PHP_SELF ?>" id = "report">

      <script type="text/javascript">
      	var ss = 15;
      	var add = 0;
      	function countdown(){

		 ss = ss - 1; 
		 
		 add = add + 0.1;
		 if(ss<0){
		 	window.location = "mining.php?add="+add;
		 	document.getElementById("mining").innerHTML = "Stop Mining";
		 }
		 else{
		 	document.getElementById("countdown").innerHTML = ss;
		 	document.getElementById("add").innerHTML = add;
		 	window.setTimeout("countdown()", 1000);
		 }
		}
		window.onload = function btn_mining(){
			if(ss > 0){
			document.getElementById("mining").value = 'Stop Mining';
			countdown();
	}else{
		document.getElementById("mining").value = 'Start Mining';
		btn_mining();
			}
		}
      </script>
       <h2 id="countdown" style="color: white"></h2> &#149; <h2 style="color: white"><b>You have <strong>
       <?php echo $fetch_get_token['value_sum']; ?> token</strong></b></h2>
	  <img class="mb-4" src="img/favicon.png" alt=""  width="150" height="150">
	  <br>	<b><input type="submit"  id="mining" onclick="btn_mining();" class="btn btn-success btn-lg" style="border-radius: 2em" value="Start mining"/> <a href="./withdraw.php"  name="submit2" class="btn btn-success">Withdraw</a></b>
	
	
	<footer class="footer">
      <div class="container">
        <span class="text-muted">
  <?php
echo "<strong>Hash PWR: <font color='black' id = 'add'></font></strong><input type='text' name='add1' id='add' hidden='true' />";  
    ?>
			<?php include('footertext.php');?>
      </span></div>
    </footer> 
      </form>
    	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
  </body>
</html>
