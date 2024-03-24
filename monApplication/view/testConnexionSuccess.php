<b>getUserByLoginAndPass:</b>
<br>
<?php echo ' Bonjour vous etes '.$context->user->nom . ' ' . $context->user->prenom; ?>
<br>
<b>getTrajet:</b>
<br>
<?php echo ' Le trajet entre ' . $context->trajet->depart . ' et ' . $context->trajet->arrivee . ' est le trajet numéro ' . $context->trajet->id; ?>
<br>
<b>getVoyagesByTrajet:</b> 
<br>
<?php echo ' les voyages correspendants au trajet choisi sont  '.'<br>' ;

foreach ($context->voyage as $voyages) {
    echo 'Le voyage numero ' . $voyages->id.' le conducteur est '.$voyages->conducteur->nom ." ".$voyages->conducteur->prenom. '<br>';
} 
?>
<b>getReservationByVoyage</b>
<br>
<?php echo ' les reservations correspendantes au voyage sont ' .'<br>';
foreach ($context->reservation as $reservations) {
    echo 'La reservation  numero ' .$reservations->id ." :le conducteur est ".$reservations->voyage->conducteur->nom." ".$reservations->voyage->conducteur->prenom." le depart du trajet est  ".$reservations->voyage->trajet->depart." et le voyageur est  ".$reservations->voyageur->nom." ".$reservations->voyageur->prenom.'<br>';
}
?>
<b>getUserById</b>
<br>
<?php
echo ' l utilisateur numero '.$context->utilisateur->id.' est '.$context->utilisateur->nom.' '.$context->utilisateur->prenom 

?>