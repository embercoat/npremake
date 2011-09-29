<html> 
    <head> 
        <title>LTU - Nolleperioden 2011</title> 
        <link rel="stylesheet" href="/css/resethtml5.css" type="text/css" />  
        <link rel="stylesheet" href="/css/style.css" type="text/css" />
        <link rel="stylesheet" href="/css/form.css" type="text/css" />    
        <?php
            if(isset($css))
                foreach($css as $c)
                    echo '<link rel="stylesheet" type="text/css" href="'.$c.'" />'."\r\n";
        ?>
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
        <? if(!isset($_SESSION['user']) || !$_SESSION['user']->logged_in()) { ?>
        <script type="text/javascript">
            $(document).ready(function(){
    	        document.loginform.textbox_username.focus();
            });
        <? } ?>
        </script>
    </head>
        <body>
        <div id="topLogo"> 
            <div id="login_form">
                <?
                if (isset($_SESSION['user']) && $_SESSION['user']->logged_in()){
                        echo '<a href="/backend/logout">Logga ut '.$_SESSION['user']->get_full_name().'</a>'; 
                } else {
                    ?>
                <form name="loginform" id="loginform" method="post" action="http://npremake.scripter.se/backend/login">
                    Login
                    <input name="username" type="text" id="textbox_username" class="login" />
                    L&ouml;senord
                    <input name="password" type="password" id="textbox_password" class="login" />
                    <button type="submit" id="submit" class="floatRight">Logga In</button>
                </form>
                <?
                }
                ?>
            </div> 
        </div> 
        <div id="sideMenu">
            <?=$menu; ?>
        </div>
        <div id="main">
            <?
            if(isset($_SESSION['message'])){
                echo "<ul>\r\n";
                foreach($_SESSION['message'] as $class => $cont)
                    foreach($cont as $m)
                        echo '<li class="'.$class.'">'.$m.'</li>';
                echo "</ul>";
            }
            unset($_SESSION['message']);
            ?>
            <?=$content; ?>
        </div> 
        <?=View::factory('stats');?>
    </body> 
</html>
