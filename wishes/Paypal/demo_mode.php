<?php

/*
	This file is only used if you run the Donation Center in demo mode (as used at demo.tutorialzine.com).
	Demo mode bypasses paypal.com, so the Donation Center is easier to test.
	
	If you don't use demo mode, you can safely delete this file. Also make sure that $demoMode is set to false in config.php.
*/

require "config.php";
require "connect.php";

if(!$demoMode) die();

$randomID = md5(rand(0,100000).time());
$time = time();
$date = date('Y-m-d',$time);

mysql_query("	INSERT INTO Donations (Name,ProjectID,Amount,Date,Email,Message)
				VALUES (
					'jim jimmy',
					'123',
					".(float)$_POST['amount'].",
					'.$date.',
                    '17michaelm@gmail.com',
                    'yo'
				)");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Redirecting..</title>

</head>

<body>
<?php echo"hi"?>
<form id="redirectForm" method="post" action="thankyou.php">
<input type="hidden" name="txn_id" value="<?php echo $randomID ?>" />
</form>

<script type="text/javascript">
document.getElementById('redirectForm').submit();
</script>

</body>
</html>