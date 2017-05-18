<?php

    require_once "vendor/autoload.php";
    $app = new \MerryPayout\App();
    $app->increaseViews();

    $msg1 = "";
    if (isset($_POST['contact']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $sub2 = "Thank you for Contacting Merrypayout";
        $message2 = "We have gotten your email, We will get back to you soon.";

        if (!\MerryPayout\Validate::String($name) || !\MerryPayout\Validate::Email($email) ||
            !\MerryPayout\Validate::String($message))
        {
            $msg1 = "<div class='alert alert-danger'>Some Input are in valid</div>";
        }
        else{
            $to = 'support@merrypayout.com';
            $subject = 'New Message From Contact Form';
            $Tomsg = "Name : $name .<br>. Email : $email . <br> . Message : $message";
            mail($to , $subject , $Tomsg);
            mail($email , $sub2 , $message2);
            $msg1 = "<div class='alert alert-success'>Thank you for contacting us , We will get back to you.</div>";

        }
    }

?>

<?php
    $msg = "";
    if (isset($_POST['submit']))
    {
        $email = $_POST['email'];
        if (!\MerryPayout\Validate::Email($email))
        {
            $msg = "Sorry the email is invalid";
        }else{
            $to = "seekerofhope2@gmail.com";
            $subject = "Newsletter subscription";
            $message = $email;
            mail($to, $subject, $message);
            $msg = "You have successfully subscribed to our newsletter";
        }
    }
    ?>



<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/idangerous.swiper.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/animate.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="img/favicon.ico" />
    <title><?php echo $title;?> - MerryPayout</title>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/58b40a005e0c3809ffba68f4/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</head>

