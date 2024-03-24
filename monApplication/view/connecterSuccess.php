<?php
if ($context->utilisateur ) {
    $_SESSION['nom'] = $context->utilisateur->nom;
    $_SESSION['prenom'] = $context->utilisateur->prenom;
    $_SESSION['pseudo'] = $context->utilisateur->identifiant;
    $_SESSION['id'] = $context->utilisateur->id;
    $_SESSION['pass'] = $context->utilisateur->pass;
} else if ($context->utilisateur == null) {
    echo 'aucun utilisateur';
}
?>
