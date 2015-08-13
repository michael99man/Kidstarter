<?php

require "paypal_integration_class/paypal.class.php";
require "config.php";
require "connect.php";

$p = new paypal_class;
$p->paypal_url = $payPalURL;

$time = time();
$date = date('Y-m-d',$time);

if ($p->validate_ipn()) {
	if($p->ipn_data['payment_status']=='Completed')
	{
		$amount = $p->ipn_data['mc_gross'] - $p->ipn_data['mc_fee'];
		
		mysql_query("	INSERT INTO Donations (TransactionID,Email,Amount,Date,ProjectID)
						VALUES ('".esc($p->ipn_data['txn_id'])."','".esc($p->ipn_data['payer_email'])."','".(float)$amount."','".$date."', '".esc($p->ipn_data['custom'])."');");
	}
}

function esc($str)
{
	global $link;
	return mysql_real_escape_string($str,$link);
}
?>