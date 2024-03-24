<?php $itineraireCount = 1; ?>
<?php if (count($context->correspondances)>0): ?> <!-- Ajout de la condition -->
    <?php foreach ($context->correspondances as $correspondance): ?>
        <div class="correspondance">
            <?php
            // Transformer la chaîne '{int,int}' en un tableau d'entiers
            $idsVoyageArray = array_map('intval', explode(',', trim($correspondance['ids_voyage'], '{}'))); 
            
            // Récupérer les voyages correspondants
            $voyages = array_map(function ($voyageId) {
                return voyageTable::getVoyagesByid($voyageId); 
            }, $idsVoyageArray);
            
            // Calculer le tarif total de l'itinéraire
            $tarifTotal = array_sum(array_map(function ($voyage) {
                return $voyage->tarif;
            }, $voyages));

            // Calculer la distance totale de l'itinéraire
            $distanceTotale = array_sum(array_map(function ($voyage) {
                return $voyage->trajet->distance;
            }, $voyages));
            ?>

            <h3>Itinéraire <?= $itineraireCount++ ?> - Villes: <?= $correspondance['villes'] ?> <?= $tarifTotal ?>euro <?= $distanceTotale ?>km</h3>

            <div class="voyage-list">
                <?php foreach ($voyages as $voyage): ?>
                    <div class="voyage">
                        <div class="voyage-details">
                            <div class="voyage-title"><?= $voyage->trajet->depart . ' - ' . $voyage->trajet->arrivee." <span style='color:red;'>".$voyage->tarif; ?>euro</span></div>
                            <div class="voyage-info">
                                <div><?= 'distance :'.$voyage->trajet->distance . " Km"; ?></div>
                                <div><?= 'conducteur :'.$voyage->conducteur->nom . ' ' . $voyage->conducteur->prenom; ?></div>
                                <div><?= $voyage->nbplace . ' places disponibles'; ?></div>
                                <div><?= $voyage->heuredepart.'h -> '.($voyage->heuredepart +(int)($voyage->trajet->distance/60)).'h' ; ?> </div>
                                <div><?= 'contraintes :'.$voyage->contraintes; ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (isset($_SESSION['pseudo'])): 
                echo '<button id="reserverButton" class="reserverButton" onclick="reserver()" value="'.$correspondance['ids_voyage'].'">Réserver</button>';?>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun itinéraire trouvé.</p> <!-- Message si aucun itinéraire trouvé -->
<?php endif; ?>
