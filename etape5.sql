-- Cette fonction récursive trouve l'itinéraire optimal entre deux villes pour un nombre de places donné.
CREATE OR REPLACE FUNCTION trouver_itineraire_optimal(
    ville_depart VARCHAR(25),
    ville_arrivee VARCHAR(25),
    places INT,
    distanceTotale INT,
    villes_visitees VARCHAR,
    idss int[25],
    tarifTotal int,
    heureActuelle int,
    tempsTotale int 
) RETURNS TABLE (villes VARCHAR, ids_Voyage int[25], tarif int, distance int, dureeTotale int) AS $$
DECLARE
    rec RECORD;
    chemin VARCHAR;
    voyage varchar;
    distanceGlobale INT;
    villes_visitees_actuelles VARCHAR := villes_visitees;
    ids int[25] := idss;
    tarifItineraire int := tarifTotal;
    heureActuelleInt int; 
    tempsTotaleInt int; 
    heure_departInt int; 
    heureActuelleInterval int; 
    dureeTotale int;
BEGIN
    -- Parcourir tous les voyages disponibles pour la ville de départ
    FOR rec IN
        SELECT
            voyage.id AS id_voyage,
            voyage.conducteur AS id_conducteur,
            voyage.trajet AS id_trajet,
            voyage.tarif AS tarif,
            voyage.nbPlace AS nb_places,
            voyage.heureDepart AS heure_depart,
            voyage.contraintes AS contraintes,
            trajet.depart AS depart,
            trajet.arrivee AS arrivee,
            trajet.distance AS distance
        FROM
            jabaianb.voyage voyage
            JOIN jabaianb.trajet trajet ON voyage.trajet = trajet.id
        WHERE
            trajet.depart = ville_depart
            and voyage.nbPlace >= places
            and voyage.heureDepart between 0 and 23
    LOOP
        -- Ignorer les voyages où la destination est la même que le départ
        IF rec.arrivee = rec.depart THEN
            CONTINUE;
        END IF;

        -- Vérifier si la ville actuelle n'est pas déjà dans la liste des villes visitées
        IF position(rec.arrivee IN villes_visitees) = 0 THEN
            -- Ajouter la ville actuelle à la liste des villes visitées
            villes_visitees_actuelles := villes_visitees || ' ' || rec.depart;
        ELSE
            -- Si la ville est déjà visitée, passer à l'itération suivante
            CONTINUE;
        END IF;

        -- Vérifier si la distance totale dépasse la limite
        IF distanceTotale + rec.distance > 1440 THEN
            CONTINUE;
        END IF;

        -- Calculer l'heure actuelle et la durée totale
        IF heureActuelle = -1 THEN
            heureActuelleInt := rec.heure_depart + (rec.distance/60);
            dureeTotale := tempsTotale - (rec.distance/60);
        ELSE
            heureActuelleInt := rec.heure_depart;
            -- Gérer les cas où l'heure de départ est le lendemain
            IF (heureActuelleInt - heureActuelle) > 0 THEN
                dureeTotale := tempsTotale - (rec.distance/60) - (heureActuelle - heureActuelleInt);
            ELSIF (heureActuelleInt - heureActuelle) < 0 THEN
                dureeTotale := tempsTotale - (rec.distance/60) - ((24 + heureActuelleInt) - heureActuelle);
            END IF;
            heureActuelleInt := rec.heure_depart + (rec.distance/60);
        END IF; -- supposant que 1 km équivaut à 1 minute

        -- Vérifier si la durée totale est négative (dépasse le temps total autorisé)
        IF dureeTotale < 0 THEN
            CONTINUE;
        END IF;

        -- Ajouter l'ID du voyage actuel à la liste des ID
        ids := array_append(idss, rec.id_voyage);

        -- Ajouter la distance du voyage actuel à la distance totale
        distanceGlobale := distanceTotale + rec.distance;
        -- Ajouter le tarif du voyage actuel au tarif total de l'itinéraire
        tarifItineraire := tarifTotal + rec.tarif;

        -- Vérifier si la destination est atteinte
        IF rec.arrivee = ville_arrivee THEN
            -- Ajouter le voyage actuel au chemin correct
            chemin := villes_visitees_actuelles || ' ' || rec.arrivee;
            voyage := ville_depart || ' ' || ville_arrivee;
            -- Insérer les résultats dans la table de retour
            RETURN QUERY SELECT
                chemin::varchar, ids::int[25], tarifItineraire::int, distanceGlobale::int, 24 - dureeTotale::int;
        ELSE
            -- Appel récursif avec la nouvelle ville de départ et la décrémentation de la limite de récursivité
            RETURN QUERY SELECT * FROM trouver_itineraire_optimal(
                rec.arrivee,
                ville_arrivee,
                places,
                distanceGlobale,
                villes_visitees_actuelles,
                ids,
                tarifItineraire,
                heureActuelleInt,
                dureeTotale
            );
        END IF;
    END LOOP;

    -- Terminer la fonction sans retourner de résultats, car aucun chemin correct n'a été trouvé
    RETURN;
END;
$$ LANGUAGE plpgsql;

-- Exemple d'appel de la fonction
SELECT * FROM trouver_itineraire_optimal('Paris', 'Amiens', 1, 0, '', '{}'::int[], 0, -1, 24 );

-- Cette fonction encapsule la fonction précédente et la trie par durée totale
CREATE OR REPLACE FUNCTION trouverChemin(
    ville_depart VARCHAR(25),
    ville_arrivee VARCHAR(25),
    places INT
) RETURNS TABLE (villes VARCHAR, ids_Voyage int[25], tarif int, distance int, dureeTotale int) AS $$
BEGIN
    -- Appel de la fonction trouver_itineraire_optimal avec les paramètres fournis
    RETURN QUERY SELECT * FROM trouver_itineraire_optimal(ville_depart, ville_arrivee, places, 0, '', '{}', 0, -1, 24) ORDER BY dureeTotale;
    
    -- Terminer la fonction
    RETURN;
END;
$$ LANGUAGE plpgsql;

-- Exemple d'appel de la fonction encapsulée
SELECT * FROM trouverChemin
