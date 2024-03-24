<div id="Form">
<h2>Proposer un Voyage</h2>
    <label for="depart">Départ :</label>
    <input type="text" id="depart" name="depart" required>

    <br>

    <label for="arrivee">Arrivée :</label>
    <input type="text" id="arrivee" name="arrivee" required>

    <br>

    <label for="heureDepart">Heure de Départ :</label>
    <input type="text" id="heureDepart" name="heureDepart" required>

    <br>

    <label for="nbPlaces">Nombre de Places Disponibles :</label>
    <input type="number" id="nbPlaces" name="nbPlaces" min="1" max="5" required>

    <br>

    <label for="tarif">Tarif:</label>
    <input type="text" id="tarif" name="tarif" required>

    <br>

    <label for="contraintes">Contraintes :</label>
    <textarea id="contraintes" name="contraintes" rows="4" cols="50"></textarea>

    <br>

    <button type="button" id ="voyageButton" onclick="proposerVoyage()">Proposer le Voyage</button>
    <button id="retourVersRechercher"onclick="retourVersChercher()">Retour</button>
</div>