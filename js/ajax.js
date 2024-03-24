$(document).ready(function() {
    // Fonction pour chercher des voyages
    function chercher() {
        var depart = $("#Depart").val();
        var arrivee = $("#Arrivee").val();
        var place = $("#Places").val();
        // Vérifier si les champs sont vides
        if (!depart) {
            // Afficher un message d'erreur dans le bandeau
            $("#bandeau").text("Veuillez entrer la ville de départ");
            // Effacer le contenu de la section des résultats
            $("#resultat").html("");
            return;
        }
        if (!arrivee) {
            $("#bandeau").text("Veuillez entrer la ville d'arrivée");
            $("#resultat").html("");
            return;
        }

        // Requête AJAX pour chercher des voyages
        $.ajax({
            url: "https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=correspondance&Depart=" + depart + "&Arrivee=" + arrivee +"&Places="+place  ,
            method: "GET",
            success: function(response) {
                if (response.includes("Aucun itinéraire trouvé.")) {
                    $("#bandeau").text("Aucun voyage trouvé");
                    $("#resultat").html("");
                } else {
                    $("#bandeau").text("Voici les résultats de votre recherche");
                    $("#resultat").html(response);
                }
            },
            error: function (error) {
                console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
            }
        });
    }

    // Fonction pour rediriger vers le formulaire d'inscription
    function versInscription() {
        $.ajax({
            type: 'GET',
            url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=formulaireInscription',
            success: function (data) {
                $('#page_maincontent').html(data);
                $("#bandeau").text("Veuillez vous Inscrire");
            },
            error: function (error) {
                console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
            }
        });
    }

    // Fonction pour rediriger vers le formulaire de connexion
    function versConnexion() {
        $.ajax({
            type: 'GET',
            url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=formulaireConnexion',
            success: function (data) {
                $('#page_maincontent').html(data);
                $("#bandeau").text("Veuillez vous connecter");
            },
            error: function (error) {
                console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
            }
        });
    }



    // Fonction pour inscrire un utilisateur
    function inscrire() {
        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var pseudo = $("#pseudo").val();
        var pass = $("#pass").val();

        $.ajax({
            type: 'GET',
            url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=inscrire&nom=' + nom + "&prenom=" + prenom + "&pseudo=" + pseudo + "&pass=" + pass,
            success: function (data) {
                $.ajax({
                    type: 'GET',
                    url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=formulaireConnexion',
                    success: function (data) {
                        $("#bandeau").text("Utilisateur inscrit");
                        $('#page_maincontent').html(data);
                    },
                    error: function (error) {
                        console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
                    }
                });
            },
            error: function (error) {
                console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
            }
        });
    }

    // Fonction pour connecter un utilisateur
    function connecter() {
    var pseudo = $("#pseudo").val();
    var pass = $("#pass").val();

    $.ajax({
        type: 'GET',
        url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=connecter&pseudo=' + pseudo + "&pass=" + pass,
        success: function (response) {
            if (response.trim() === "aucun utilisateur") {
                $("#bandeau").text("L'utilisateur est introuvable");
            } else {
                $.ajax({
                    type: 'GET',
                    url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=formulaire',
                    success: function (data) {
                        $("#bandeau").text("Veuillez chercher un voyage");
                        $('#page_maincontent').html(data);
                    },
                    error: function (error) {
                        console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
                    }
                });
            }
        },
        error: function (error) {
            console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
        }
    });
}


//Fonction pour deconnecter un utilisateur
function deconnexion() {
    $.ajax({
        type: 'GET',
        url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=deconnecter' ,
        success: function (data) {
            $.ajax({
                type: 'GET',
                url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=Acceuil',
                success: function (data) {
                    $("#bandeau").text("Bienvenue sur CeriCar");
                    $('#page_maincontent').html(data);
                },
                error: function (error) {
                    console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
                }
            });
        },
        error: function (error) {
            console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
        }
    });
}
// Fonction pour reserver un itineraire
function reserver(id) {

    $.ajax({
        type: 'GET',
        url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=reserver&idVoyage='+id,
        success: function (data) {
            if (data.includes("Erreur sql")) {
            $('#bandeau').text("Veuillez vous connecter");
        }
        else
        $('#bandeau').text("reservation effectuée avec success");

        },
        error: function (error) {
            console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
        }
    });
}
// Fonction pour reserver un voyage et se diriger vers formulaire directement
function proposerVoyage() {
    var depart = $("#depart").val();
    var arrivee = $("#arrivee").val();
    var heure = $("#heureDepart").val();
    var places = $("#nbPlaces").val();
    var tarif = $("#tarif").val();
    var contraintes = $("#contraintes").val();
    $.ajax({
        type: 'GET',
        url :'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=proposerVoyage&depart=' + depart + '&arrivee=' + arrivee + '&heureDepart=' + heure + '&nbPlaces=' + places + '&tarif=' + tarif + '&contraintes=' + contraintes,
        success: function (data) {
            $.ajax({
                success: function (data) {
                    $("#bandeau").text("Voyage Ajouté avec success");
                    $.ajax({
                        type: 'GET',
                        url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=formulaire',
                        success: function (data) {
                            $("#bandeau").text("Veuillez choisir un voyage");
                            $('#page_maincontent').html(data);
                        },
                        error: function (error) {
                            console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
                        }
                    });
                },
                error: function (error) {
                    console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
                }
            });
        },
        
    });
}
//// Fonction pour se diriger vers le profil  
function profil() {

    $.ajax({
        type: 'GET',
        url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=profil',
        success: function (data) {
            $('#bandeau').text("Voici Vos Informations");
            $('#page_maincontent').html(data);
        },
        error: function (error) {
            console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
        }
    });
}
//// Fonction pour retour vers l'acceuil 

function retour() {
    $.ajax({
        type: 'GET',
        url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=Acceuil',
        success: function (data) {
            $('#bandeau').text("Bienvenue sur CeriCar");
            $('#page_maincontent').html(data);
        },
        error: function (error) {
            console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
        }
    });
}
//// Fonction pour se deriger vers le formulaire 
function versProposerVoyage() {
    $.ajax({
        type: 'GET',
        url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=formulaireVoyage',
        success: function (data) {
            $('#bandeau').text("Proposez votre voyage");
            $('#page_maincontent').html(data);
        },
        error: function (error) {
            console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
        }
    });
}


function retourVersChercher() {
    $.ajax({
        type: 'GET',
        url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=formulaire',
        success: function (data) {
            $('#bandeau').text("Veuillez choisir un voyage");
            $('#page_maincontent').html(data);
        },
        error: function (error) {
            console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
        }
    });
}



function versChercher() {

    $.ajax({
        type: 'GET',
        url: 'https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/monApplicationajax.php?action=formulaire',
        success: function (data) {
            $('#bandeau').text("Veuillez choisir un voyage");
            $('#page_maincontent').html(data);
        },
        error: function (error) {
            console.error('Une erreur s\'est produite lors de la requête AJAX:', error);
        }
    });
}




    // Associer les événements aux fonctions
    $(document).on('click', '#inscriptionButton', function () {
        inscrire();
    });

    $(document).on('click', '#connexionButton', function () {
        connecter();
    });

    $(document).on('click', '#inscription', function () {
        versInscription();
    });

    $(document).on('click', '#connexion', function () {
        versConnexion();
    });

    $(document).on('click', '#chercherButton', function () {
        chercher();
    });
    $(document).on('click', '#deconnecterButton', function () {
        deconnexion();
    });
    
    $(document).on('click', '#reserverButton', function () {
       reserver($(this).attr('value'));
    });
    $(document).on('click', '.retourButton', function () {
        retour();
     });
     $(document).on('click', '#profilButton', function () {
        profil();
     });
     $(document).on('click', '#voyageButton', function () {
        proposerVoyage();
     });
     $(document).on('click', '#voyageFormulaireButton', function () {
        versProposerVoyage();
     });
     $(document).on('click', '#retourVersRechercher', function () {
        retourVersChercher();
    });
    $(document).on('click', '#VerschercherButton', function () {
        versChercher();
    });
});
