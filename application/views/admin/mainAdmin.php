<html>
	<head>
		<title>AdminPanel för Nolleperioden.se</title>
		<link rel="stylesheet" href="/css/resethtml5.css" type="text/css" />  
        <link rel="stylesheet" href="/css/adminstyle.css" type="text/css" />  
        <script type="text/javascript" src="/js/jquery.js"> 1;</script>
        <?php
            if(isset($css))
                foreach($css as $c)
                    echo '<link rel="stylesheet" type="text/css" href="'.$c.'" />'."\r\n";
            if(isset($js))
                foreach($js as $j)
                    echo '<script type="text/javascript" src="'.$j.'">1;</script>'."\r\n";
            if(isset($custom_head))
                foreach($custom_head as $ch)
                    echo $ch."\r\n";
        ?>
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
				<li class="menuGroupHead">Phösare</li>
				<li><a href="/admin/phosare/applicants/">Ansökningar</a></li>
				<li><a href="/admin/phosare/list/thisYear/">Årets Phösare</a></li>
				<li><a href="/admin/phosare/list/">Alla Phösare</a></li>
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
			</ul>
			
		</div>
		<div id="main">
		    <?
            if(isset($messages)){
                echo "<ul>\r\n";
                foreach($messages as $class => $cont)
                    foreach($cont as $m)
                        echo '<li class="'.$class.'">'.$m.'</li>';
                echo "</ul>";
            }
            ?>
            <?=$content; ?>
        </div>
		<?=View::factory('stats');?>
	</body>
</html>