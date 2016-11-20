<?php 

$select = $bdd->prepare('SELECT * FROM infos');
if($select->execute()){
	$info = $select->fetch(PDO::FETCH_ASSOC);
}

?>
<!--footer-->
<div style="clear:both;"></div>
	
<div class="container footer">

		<div class="col-md-6 copy">
			<p><i class="fa fa-copyright" aria-hidden="true"></i> Copyright - Azerquipe3</p>
		</div>
		<div class="col-md-6 adress">
			<?php echo '<p>'.$info['name'].'&nbsp;'.$info['adress'].'<br>'.$info['phone'].'&nbsp;'.$info['mail'].'</p>'; ?>
		</div>
</div>