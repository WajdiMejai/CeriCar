<?php if (count($context->voyage) != 0): ?>
    <div class="voyage-list">
        <?php foreach ($context->voyage as $voyages): ?>
            <div class="voyage">
                <div class="voyage-details">
                <span class="person-icon">&#xf007;</span> <!-- Utilisez le code Unicode Font Awesome pour une icône de personne -->
    
                    <div class="voyage-title"><?php echo $voyages->trajet->depart . ' - ' . $voyages->trajet->arrivee; ?></div>
                    <div class="voyage-info">
                        <div><?php echo $voyages->trajet->distance . " Km"; ?></div>
                        <div><?php echo $voyages->conducteur->nom . ' ' . $voyages->conducteur->prenom; ?></div>
                        <div class="rating">★★★★★</div> <!-- Utilisez la notation réelle ici -->
                    </div>
                </div>
                <div class="voyage-image">
                    <!-- Ajoutez l'image du voyage ici -->
                    <img src="path/to/image.jpg" alt="Voyage Image">
                </div>
                <div class="additional-info">
                    <div><?php echo $voyages->nbplace . ' places disponibles'; ?></div>
                    <div><?php echo $voyages->tarif . " euro"; ?></div>
                    <div><?php echo $voyages->heuredepart; ?></div>
                    <div><?php echo $voyages->contraintes; ?></div>
                </div>
                                <?php
                if (isset($_SESSION['pseudo'])) {
                    // Affiche le bouton de déconnexion seulement si l'utilisateur est connecté
                    echo '<button  id ="reserverButton" class= "'.$voyages->id.'"onclick="reserver()">Reserver</button>';
                }
                ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucun voyage trouvé</p>
<?php endif; ?>
