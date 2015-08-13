<?php

require "Paypal/config.php";
require "Paypal/connect.php";
// Determining the URL of the page:
$url = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"]);

// Fetching the number and the sum of the donations:
list($number,$sum) = mysql_fetch_array(mysql_query("SELECT COUNT(*),SUM(amount) FROM Donations"));

// Calculating how many percent of the goal were met:
$percent = round(min(100*($sum/$goal),100));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
    <head>
        <title>GENERIC WISH PAGE</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv = "pragma" content = "no-cache" />
        <meta http-equiv = "expires" value = "-1"/>
        <!--[if lte IE 8]><script src="../assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="../assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="../assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="../assets/css/ie9.css" /><![endif]-->
        <link rel="shortcut icon" href="images/Web_Logos/favicon.ico"/>

        <style type="text/css">
            progress[value] {
                /* Reset the default appearance */
                -webkit-appearance: none;
                -moz-appearance: none;
                border:none;
                appearance: none;
                width: 350px;
                height: 50px;
            }
            progress[value]::-webkit-progress-bar {
                background-color: #ffffff;
                box-shadow: 2px 3px 5px rgba(0, 0, 0, 0.25) inset;
                border-radius: 12px;
            }


            progress[value]::-webkit-progress-value {
                background-color: #60ADF3;
                box-shadow: 2px 3px 5px rgba(0, 0, 0, 0.25) inset;
                border-bottom-left-radius: 12px;
                border-top-left-radius: 12px;

            }

            progress[value]::-moz-progress-bar { 
                background-color: #ffffff;
                box-shadow: 2px 3px 5px rgba(0, 0, 0, 0.25) inset;
                border-radius: 12px;
            }
            progress[value]::-moz-progress-value { 
                background-color: #60ADF3;
                box-shadow: 2px 3px 5px rgba(0, 0, 0, 0.25) inset;
                border-bottom-left-radius: 12px;
                border-top-left-radius: 12px;
            }

            .currentText, .totalText {
                font-size: 30px;
                bottom: .35em;
                position: relative;
            }

        </style>
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
                                    <li><a href="../index.html">Home</a></li>
                                    <li><a href="../Wishlist.html">Wishlist</a></li>
                                    <li><a href="../about.html">About Us</a></li>
                                    <li><a href="../contact.html">Contact Us</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </header>

            <!-- Main -->
            <article id="main">
                <header>
                    <h2>Generic Wish Page</h2>
                    <p>Help Lorem Ipsum Dolor</p>
                    <div>
                        <span class = "currentText">$50</span>
                        &nbsp;&nbsp;&nbsp;
                        <!--<meter id = "progressMeter" max="100" min = "0" value="50"></meter>-->
                        <progress max="100" value="50">
                        </progress>
                        &nbsp;&nbsp;&nbsp;
                        <span class = "totalText">$100</span>
                    </div>

                </header>
                <section class="wrapper style5">



                    <div class="inner">
                        <!-- DONATIONS -->
                        <form action="<?php echo $payPalURL?>" method="post" class="payPalForm">
                            <div>
                                <input type="hidden" name="cmd" value="_donations" />
                                <input type="hidden" name="item_name" value="Donation" />

                                <!-- Your PayPal email: -->
                                <input type="hidden" name="business"
                                       value="<?php echo $myPayPalEmail?>"/>

                  <!-- PayPal will send an IPN notification to this URL: -->
            <input type="hidden" name="notify_url" value="<?php echo $url.'/Paypal/ipn.php'?>" /> 

            <!-- The return page to which the user is navigated after the donations is complete: -->
            <input type="hidden" name="return" value="<?php echo $url.'/Paypal/thankyou.php'?>" /> 

                                <!-- Signifies that the transaction data will be
passed to the return page by POST: -->

                                <input type="hidden" name="rm" value="2" /> 

                                <!-- General configuration variables for the paypal landing page. -->

                                <input type="hidden" name="no_note" value="1" />
                                <input type="hidden" name="cbt" value="Go Back To The Site" />
                                <input type="hidden" name="no_shipping" value="1" />
                                <input type="hidden" name="lc" value="US" />
                                <input type="hidden" name="currency_code" value="USD" />

                                <!-- BUTTON ID -->
                                <input type="hidden" name="hosted_button_id" value="DN96SE9DRE4GC">

                                <!-- The amount of the transaction: -->

                                <input name="amount" type=number id="amount" maxlength="4">

                                <input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest" />

                                <!-- You can change the image of the button: -->
                                <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" />

                                <img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif"
                                     width="1" height="1" />

                            </div>
                        </form>

                        <!--
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="DN96SE9DRE4GC">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
-->


                        <h3>About Lorem ipsum dolor</h3>
                        <p>Morbi mattis mi consectetur tortor elementum, varius pellentesque velit convallis. Aenean tincidunt lectus auctor mauris maximus, ac scelerisque ipsum tempor. Duis vulputate ex et ex tincidunt, quis lacinia velit aliquet. Duis non efficitur nisi, id malesuada justo. Maecenas sagittis felis ac sagittis semper. Curabitur purus leo, tempus sed finibus eget, fringilla quis risus. Maecenas et lorem quis sem varius sagittis et a est. Maecenas iaculis iaculis sem. Donec vel dolor at arcu tincidunt bibendum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce ut aliquet justo. Donec id neque ipsum. Integer eget ultricies odio. Nam vel ex a orci fringilla tincidunt. Aliquam eleifend ligula non velit accumsan cursus. Etiam ut gravida sapien.</p>

                        <p>Vestibulum ultrices risus velit, sit amet blandit massa auctor sit amet. Sed eu lectus sem. Phasellus in odio at ipsum porttitor mollis id vel diam. Praesent sit amet posuere risus, eu faucibus lectus. Vivamus ex ligula, tempus pulvinar ipsum in, auctor porta quam. Proin nec dui cursus, posuere dui eget interdum. Fusce lectus magna, sagittis at facilisis vitae, pellentesque at etiam. Quisque posuere leo quis sem commodo, vel scelerisque nisi scelerisque. Suspendisse id quam vel tortor tincidunt suscipit. Nullam auctor orci eu dolor consectetur, interdum ullamcorper ante tincidunt. Mauris felis nec felis elementum varius.</p>

                        <hr />

                        <h4>Feugiat aliquam</h4>
                        <p>Nam sapien ante, varius in pulvinar vitae, rhoncus id massa. Donec varius ex in mauris ornare, eget euismod urna egestas. Etiam lacinia tempor ipsum, sodales porttitor justo. Aliquam dolor quam, semper in tortor eu, volutpat efficitur quam. Fusce nec fermentum nisl. Aenean erat diam, tempus aliquet erat.</p>

                        <p>Etiam iaculis nulla ipsum, et pharetra libero rhoncus ut. Phasellus rutrum cursus velit, eget condimentum nunc blandit vel. In at pulvinar lectus. Morbi diam ante, vulputate et imperdiet eget, fermentum non dolor. Ut eleifend sagittis tincidunt. Sed viverra commodo mi, ac rhoncus justo. Duis neque ligula, elementum ut enim vel, posuere finibus justo. Vivamus facilisis maximus nibh quis pulvinar. Quisque hendrerit in ipsum id tellus facilisis fermentum. Proin mauris dui, at vestibulum sit amet, auctor bibendum neque.</p>

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
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/jquery.scrollex.min.js"></script>
        <script src="../assets/js/jquery.scrolly.min.js"></script>
        <script src="../assets/js/skel.min.js"></script>
        <script src="../assets/js/util.js"></script>
        <!--[if lte IE 8]><script src="../assets/js/ie/respond.min.js"></script><![endif]-->
        <script src="../assets/js/main.js"></script>

    </body>
</html>