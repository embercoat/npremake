<?='<?xml version="1.0"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
	<head>
		<title>AdminPanel för Nolleperioden.se</title>
		<style type="text/css">
            @import url('/css/resethtml5.css');
            @import url('/css/adminstyle.css');
<?php
            if(isset($css))
                foreach($css as $c)
                    echo '@import url(\''.$c.'\');'."\r\n";
?>
        </style>
        <script type="text/javascript" src="/js/jquery.js"> 1;</script>
        <?php
            if(isset($js))
                foreach($js as $j)
                    echo '<script type="text/javascript" src="'.$j.'">1;</script>'."\r\n";
            if(isset($custom_head))
                foreach($custom_head as $ch)
                    echo $ch."\r\n";
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<div id="adminHead">
			<h1><a href="/admin/" style="color:black; text-decoration: none; float: left;">AdminPanel Nolleperioden</a></h1>
			<a style="float: right;" href="/">Nolleperioden.se</a>
		</div>
		<div id="adminMenu">
			<ul>
				<li><a href="/admin/">Start</a></li>
			</ul>
			<ul>
				<li><a href="/admin/news/">Nyheter</a></li>
				<li><a href="/admin/news/edit">Skriv</a></li>
			</ul>
			<ul>
				<li class="menuGroupHead">Utseende</li>
				<li><a href="/admin/menu/">MenyAdmin</a></li>
				<li><a href="/admin/dynamic/">Dynamiska Sidor</a></li>
			</ul>
			<ul>
				<li class="menuGroupHead">Avändare</li>
				<li><a href="/admin/user/">Lista</a></li>
				<li><a href="/admin/user/group/">Grupper</a></li>
			</ul>
			<ul>
				<li class="menuGroupHead">Utskick</li>
				<li><a href="/admin/mail/">Mail</a></li>
				<li><a href="/admin/sms/">SMS</a></li>
			</ul>
			<ul>
				<li class="menuGroupHead">Phösare</li>
				<li><a href="/admin/phosare/applicants/">Ansökningar</a></li>
				<li><a href="/admin/phosare/list/thisYear/">Årets Phösare</a></li>
				<li><a href="/admin/phosare/list/">Alla Phösare</a></li>
				<li><a href="/admin/phosare/dutyNow/">Ansvariga just nu</a></li>
				<li><a href="/admin/phosare/duty/">Ansvariga i år</a></li>
				<li><a href="/admin/signup/">Anmälningslistor</a></li>
			</ul>
			<ul>
				<li class="menuGroupHead">Phösaruppdrag</li>
				<li><a href="/admin/phmission/list/">Alla</a></li>
				<li><a href="/admin/phmission/edit/new/">Lägg till</a></li>
			</ul>
			<ul>
				<li class="menuGroupHead">Data</li>
				<li><a href="/admin/data/program">Program</a></li>
				<li><a href="/admin/data/organisation">Organisationer</a></li>
				<li><a href="/admin/data/homeroom">Hemklassrum</a></li>
			</ul>
			<ul>
				<li class="menuGroupHead">Dokument</li>
				<li><a href="/admin/document/">Alla</a></li>
				<li><a href="/admin/document/add">Lägg Till</a></li>
			</ul>
			<ul>
				<li class="menuGroupHead">Listor</li>
				<li><a href="/admin/list/">Listgeneratorn</a></li>
				<li><a href="/admin/list/allergy/">Phösare Allergier</a></li>
				<li><a href="/admin/list/stuklist/">Phösare Stukarbetare</a></li>
			</ul>


		</div>
		<div id="main">
		    <?php
            if(isset($messages)){
                echo "<ul>\r\n";
                foreach($messages as $class => $cont)
                    foreach($cont as $m)
                        echo '<li class="'.$class.'">'.$m.'</li>';
                echo "</ul>";
            }
            ?>
            <?php echo $content; ?>
        </div>
		<?php echo View::factory('stats');?>
	</body>
</html>