<?
	$query = $_GET['query'];

	//SETUP username, password, and establish PDO and DSN connection to database
	$user='root';
	$pass="root";
	$dbh = new PDO('mysql:host=localhost;dbname=DontStarveItems;port=8889', $user, $pass);

	//get ALL info from database table craftable_items
	$stmt = $dbh->prepare("
		select itemsName from items where itemsName like '%{$query}%';
	");
	$stmt->execute();
	$result_items = $stmt->fetchall(PDO::FETCH_ASSOC);
	
	foreach($result_items as $row){
		echo '<li title="'.ucwords(str_replace("_", " ", $row['itemsName'])).'"><img src="images/items/'.$row['itemsName'].'.png"></a></li>';
	}
?>