
<?php if ($context->voyageur): ?>
    <div class="top-right-buttons">
        <button id ="deconnecterButton"onclick="deconnection()">Déconnexion</button>
        <button id="retourVersRechercher"onclick="retourVersChercher()">Retour</button>
    </div>
    <div class="profile-info">
        <h2>Profil Voyageur</h2>
        <p><strong>Nom:</strong> <?php echo $context->voyageur->nom; ?></p>
        <p><strong>Prénom:</strong> <?php echo $context->voyageur->prenom; ?></p>
        <p><strong>Pseudo:</strong> <?php echo $context->voyageur->identifiant; ?></p>
        <p><strong>ID:</strong> <?php echo $context->voyageur->id; ?></p>
        <!-- Add any other voyageur information you want to display -->
    </div>
<?php else: ?>
    <p>Aucun voyageur trouvé.</p>
<?php endif; ?>

<div class="results">
    <h2>Voyages</h2>
    <table class="voyage-table">
        <thead>
            <tr>
                <th>Conducteur</th>
                <th>Trajet</th>
                <th>Tarif</th>
                <th>Places disponibles</th>
                <th>Heure de départ</th>
                <th>Contraintes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($context->voyages as $voyage): ?>
                <tr class="voyage">
                    <td><?php echo $voyage->conducteur->nom . ' ' . $voyage->conducteur->prenom; ?></td>
                    <td><?php echo $voyage->trajet->depart . ' - ' . $voyage->trajet->arrivee; ?></td>
                    <td><?php echo $voyage->tarif; ?> euro</td>
                    <td><?php echo $voyage->nbplace; ?></td>
                    <td><?php echo $voyage->heuredepart; ?></td>
                    <td><?php echo $voyage->contraintes; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Réservations</h2>
    <table class="reservation-table">
        <thead>
            <tr>
                <th>Voyageur</th>
                <th>Trajet</th>
                <th>Heure de réservation</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($context->reservation as $reservation): ?>
                <tr class="voyage">
                    <td><?php echo $reservation->voyageur->nom . ' ' . $reservation->voyageur->prenom; ?></td>
                    <td><?php echo $reservation->voyage->trajet->depart . ' - ' . $reservation->voyage->trajet->arrivee; ?></td>
                    <td><?php echo $reservation->voyage->heuredepart; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
