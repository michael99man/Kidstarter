<?php
require "config.php";
require "connect.php";

if(isset($_POST['submitform']) && isset($_POST['txn_id']))
{
    $_POST['nameField'] = esc($_POST['nameField']);
    $_POST['websiteField'] =  esc($_POST['websiteField']);
    $_POST['messageField'] = esc($_POST['messageField']);

    $error = array();

    if(mb_strlen($_POST['messageField'],"utf-8")<2)
    {
        $error[] = 'Please fill in a longer message.';
    }


    $errorString = '';
    if(count($error))
    {
        $errorString = join('<br />',$error);
    }
    else
    {
        $notifications = (int) isset($_POST['emailField']);
        mysql_query("   Update Donations Set Name = '".$_POST['nameField']."', Message = '".$_POST['messageField']."', Notifications =  '".$notifications."' Where TransactionID = '".$_POST['txn_id']."';   ");
        header("Location: http://www.kidstarter.fund/wishlist.html");
        die();
        exit();
    }
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Kidstarter</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="../../assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <link rel="shortcut icon" href="../../images/favicon.ico"/>
    </head>
    <body>

        <!-- Page Wrapper -->
        <div id="page-wrapper">

            <!-- Header -->
            <header id="header">
                <h1><a href="index.html">Kidstarter</a></h1>
                <nav id="nav">
                    <ul>
                        <li class="special">
                            <a href="#menu" class="menuToggle"><span>Menu</span></a>
                            <div id="menu">
                                <ul>
                                    <li><a href="../../index.html">Home</a></li>
                                    <li><a href="../../wishlist.html">Wishlist</a></li>
                                    <li><a href="../../about.html">About Us</a></li>
                                    <li><a href="../../contact.html">Contact Us</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </header>

            <!-- Main -->
            <article id="main">
                <header>
                    <h2>Thanks for Donating!</h2>
                    <p>Please join our Donor List</p>
                </header>
                <section class="wrapper style5">
                    <div class="inner">
                        <form action="thankyou.php" method="post">
                            <div class="6u 12u$(xsmall)">
                                <input type="text" name="nameField" id="nameField" value="" placeholder="Name">
                            </div>
                            <br>
                            
                            <div class="12u$">
                                <textarea name="messageField" id="messageField" placeholder="Is there a message you would like to send to the recipient of the wish?" rows="6"></textarea>
                            </div>
                            <br>
                            <div class="6u$ 12u$(small)">
                                <input type="checkbox" id="emailField" name="emailField" checked>
                                <label for="emailField">Would you like to receive email notifications about this wish?</label>
                            </div>
                            <br>
                            <div class="12u$">
				                    <input type="submit" value="Submit" class="special"></li>
								    <input type="hidden" name="submitform" value="0" />
                                    <input type="hidden" name="txn_id" value="<?php echo $_POST['txn_id']?>" />
                            </div>
                        </form>

                        <?php
    if($errorString)
{
    echo '<p class="error">'.$errorString.'</p>';
}
else if($messageString)
{
    echo '<p class="success">'.$messageString.'</p>';
}
                        ?>
                    </div>
                </section>
            </article>

            <!-- Footer -->
            <footer id="footer">
                <ul class="icons">
                    <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                    <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                    <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                    <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
                    <li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
                </ul>
                <ul class="copyright">
                    <li>&copy; Michael Man 2015</li>
                </ul>
            </footer>

        </div>

        <!-- Scripts -->
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/jquery.scrollex.min.js"></script>
        <script src="../../assets/js/jquery.scrolly.min.js"></script>
        <script src="../../assets/js/skel.min.js"></script>
        <script src="../../assets/js/util.js"></script>
        <!--[if lte IE 8]><script src="../../assets/js/ie/respond.min.js"></script><![endif]-->
        <script src="../../assets/js/main.js"></script>

    </body>
</html>


<?php

function esc($str)
{
    global $link;

    if(ini_get('magic_quotes_gpc'))
        $str = stripslashes($str);

    return mysql_real_escape_string(htmlspecialchars(strip_tags($str)),$link);
}

function validateURL($str)
{
    return preg_match('/(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:\/~\+#]*[\w\-\@?^=%&amp;\/~\+#])?/i',$str);
}
?>