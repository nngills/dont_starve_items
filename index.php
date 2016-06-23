<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Don't Starve - Items</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>

	<?php
        //SETUP username, password, and establish PDO and DSN connection to database
        $user='root';
        $pass="root";
        $dbh = new PDO('mysql:host=localhost;dbname=DontStarveItems;port=8889', $user, $pass);
        
        //get ALL info from database table version
        $stmt = $dbh->prepare('select * from version;');
        $stmt->execute();
        $result_versions = $stmt->fetchall(PDO::FETCH_ASSOC);
    ?>
    
	<header>
    	<h1>Don't Starve - Items</h1>
    	<nav>
        	<?
			
        	//<button type="button">DS</button>
			foreach($result_versions as $key=>$row){
				if ($key<1) continue;
				echo "<li><button type='button'>{$row['versionName']}</button></li>";
			}
            
			?>
        </nav>
    </header>
    
    <aside>
    	<ul>
        	<?
				
			//get ALL info from database table tabs
			$stmt = $dbh->prepare('select * from tabs;');
			$stmt->execute();
			$result_tabs = $stmt->fetchall(PDO::FETCH_ASSOC);
			
        	//<li><a href="#tools"><img src="images/tabs/Tools.png"></a></li>
			foreach($result_tabs as $key=>$row){
				if ($key>11) continue;
				echo "<li><a href='#{$row['tabName']}'><img src='images/tabs/{$row['tabName']}.png'></a></li>";
			}
			
			?>
        </ul>
    </aside>
    
    <main>
    <div>
        <article id="top">
        
        	<section id="title">
                <h2>Torch</h2>
                <img src="images/items/torch.png">
            </section>
            <section id="materials">
                <h3>Materials:</h3>
                <ul>
                    <li><div class="mat"><span class="outline">2</span><img src="images/items/twigs.png"></div></li>
                    <li><div class="mat"><span class="outline">2</span><img src="images/items/cut_grass.png"></div></li>
                </ul>
            </section>
            <section id="info">
            	<h3>Durability:</h3>
                	<p>25 seconds</p>
                <ul>
                </ul>
            </section>
            <section id="values">
            	<h3>Values:</h3>
                <ul>
                	<li><img src="images/health.png"><span class="outline">+100</span></li>
                    <li><img src="images/hunger.png"><span class="outline">+100</span></li>
                    <li><img src="images/sanity.png"><span class="outline">+100</span></li>
                </ul>
            </section>

        </article>
        
        <form>
        	<input type="text" name="search_query" id="search_query">
        </form>
        <section id="itemlist">
        
        	<?
            
			//get ALL info from database table craftable_items
			$stmt = $dbh->prepare('
				select items.itemsName, tab from craftable_items
				join items on items.id = craftable_items.itemId;
			');
			$stmt->execute();
			$result_craftitems = $stmt->fetchall(PDO::FETCH_ASSOC);
			
			/*
            <article id="tools">
                <h2>Tools</h2>
                <ul>
                    <li><img src="images/items/axe.png"></li>
                </ul>
            </article>
			*/
			
			//POPULATES THE ITEM LIST WITH THE APPROPRIATE TAB NAMES AND ITEMS
			//Follows the above template
			//Loops through the tabNames in the database and outputs into HTML
			foreach($result_tabs as $key=>$row){
				if($key>11) continue;
				echo "
					<article id='{$row['tabName']}'>
						<h2>{$row['tabName']}</h2>
						<ul>";
				foreach($result_craftitems as $items_row){
					//Loops through the items in the database
					//matches the itemName to the appropriate tabName and outputs the image into HTML
					//outputs a GET into the URL
					if($items_row['tab'] == $row['id']){
						$itemName = $items_row['itemsName'];
						echo '<li title="'.ucwords(str_replace("_", " ", $itemName)).'"><img src="images/items/'.$itemName.'.png"></a></li>';
					}
				}
						
				echo "</ul>
					</article>
					";
			}
			
			?>
        
        </section>
    </div>    
    </main>
    
    <footer>
    </footer>
    
    
    <!---Jquery--->
    <script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
    <!-- main -->
	<script type="text/javascript" src="js/main.js"></script>
    
</body>
</html>