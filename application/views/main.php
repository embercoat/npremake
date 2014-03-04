<?php echo '<?xml version="1.0"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
    <head>
        <title>LTU - Nolleperioden 2014</title>
        <style type="text/css">
            @import url('/css/resethtml5.css');
            @import url('/css/style.css');
            @import url('/css/form.css');
<?php
            if(isset($css))
                foreach($css as $c)
                    echo '@import url(\''.$c.'\');'."\r\n";
?>
        </style>
        <script type="text/javascript" src="/js/jquery.js">1;</script>
        <meta http-equiv="Content-Language" content="sv" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="robots" content="all" />
        <meta name="author" content="Kristian Tiny Nordman" />
        <meta name="email" content="npg@nolleperioden.se" />
        <meta name="description" content="LTU's nolleperiods hemsida" />
        <meta name="keywords" content="Nolleperiod Nolleperioden Ph&ouml;sare Adel Lule&aring; LTU Universitet LUTH" />
        <?php
            if(isset($js))
                foreach($js as $j)
                    echo '<script type="text/javascript" src="'.$j.'">1;</script>'."\r\n";
        ?>
        <script type="text/javascript" src="/js/main.js">1;</script>
        <?php if(!isset($_SESSION['user']) || !$_SESSION['user']->logged_in()) { ?>
        <script type="text/javascript">
            $(document).ready(function(){ $('#textbox_username').focus(); });
        <?php } ?>
        </script>
    </head>
        <body>
        <div id="topLogo">
            <div id="login_form">
                <?php
                if (isset($_SESSION['user']) && $_SESSION['user']->logged_in()){
                        echo '<a href="/backend/logout">Logga ut '.$_SESSION['user']->get_full_name().'</a>';
                } else {
                    ?>
                <form id="loginform" method="post" action="/backend/login">
                    <p>
                    Login
                    <input name="username" type="text" id="textbox_username" class="login" />
                    L&ouml;senord
                    <input name="password" type="password" id="textbox_password" class="login" />
                    <button type="submit" id="submit" class="floatRight">Logga In</button>
                    </p>
                </form>
                <?php
                }
                ?>
            </div>
        </div>
		<a href = "http://www.teknologkaren.se/">
		<img src = "/images/tkllogo.jpg" style = "width: 150px; margin: 10px 0 0 10px; position: absolute; left: 899px; top: 0px"/></a>
		<a href = "http://medlem.teknologkaren.se/">
		<img src = "/images/bli-medlem-300x93.png" style = "width: 150px; margin: 10px 0 0 10px; position: absolute; left: 899px; top: 160px"/>
		</a>
		<a href = "http://www.luleastudentkar.com">
		<img src = "/images/ls.gif" style = "width: 150px; margin: 10px 0 0 10px; position: absolute; left: 1070px; top: 0px"/></a>
		<a href = "http://medlem.luleastudentkar.com/">
		<img src = "/images/LS-medlem.png" style = "width: 150px; margin: 10px 0 0 10px; position: absolute; left: 1070px; top: 160px"/></a>
		
		
        <div id="sideMenu">
            <?php echo $menu; ?>
        </div>
		
        <div id="main">
            <?php
            if(isset($_SESSION['message'])){
                echo "<ul>\r\n";
                foreach($_SESSION['message'] as $class => $cont)
                    foreach($cont as $m)
                        echo '<li class="'.$class.'">'.$m.'</li>';
                echo "</ul>";
            }
            unset($_SESSION['message']);

            echo $content; ?>
        </div>
        <?php if(Model::factory('store')->get_value('show_statusbox')) echo View::factory('stats'); ?>
    </body>
</html>
