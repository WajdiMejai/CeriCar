<div class="form">
    <h2>Rechercher un voyage</h2>

    <label for="Depart">Départ</label>
    <input type="text" id="Depart" name="Depart">

    <br>
    <br>

    <label for="Arrivee">Arrivée</label>
    <input type="text" id="Arrivee" name="Arrivee">

    <br>
    <br>

    <label for="Places">Nombre de places (de 1 à 5)</label>
    <select id="Places" name="Places">
        <?php
            // Ajoutez des options pour les places de 1 à 5
            for ($i = 1; $i <= 5; $i++) {
                echo "<option value=\"$i\">$i</option>";
            }
        ?>
    </select>

    <br>
    <br>
    <button id="chercherButton" onclick="chercher()">Envoyer</button>
    <button class ='retourButton' onclick='retour()'>Acceuil</button>
    <?php
        if (isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
            // Affiche le bouton de déconnexion seulement si l'utilisateur est connecté
            //echo '<button id="deconnecterButton" onclick="deconnection()">Déconnexion</button>';
            
            // Ajoute le bouton "Profil"
            echo '<button id="profilButton" onclick="profil()"style="  margin-left: 4px;">Profil</button>';
            echo '<button id="voyageFormulaireButton" onclick="versProposerVoyage()"style="  margin-left: 4px;">Proposer Voyage</button>';
        }
    ?>
    <div id="resultat"></div>
</div>