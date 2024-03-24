<b>getVoyagesByTrajet:</b> 
<br>
<?php echo ' les voyages correspendants au trajet choisi sont  '.'<br>' ;

foreach ($context->voyage as $voyages) {
    echo 'Le voyage numero ' . $voyages->id.' le conducteur est '.$voyages->conducteur->nom." ".$voyages->conducteur->prenom." le tarif est : ".$voyages->tarif." ".$voyages->heurdepart." ".$voyage->nbplace.'<br>';
} 
?>