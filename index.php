<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste</title>
    <link rel="stylesheet" href="index.css" />
</head>

<body>
    <nav class="nav" style="background-color: black">
        <div class="logo" style="display: flex; justify-content: center">
            <img src="./image/onee.png" alt="" class="lg" />
        </div>
    </nav>

    <div style="display: flex;">
        <div class="side-bar" style="max-width: 13rem;background-color: aqua;">

            <div style="display: flex; align-items: center; margin-right: 10px">
                <div style="display: flex; align-items: center; margin: 10px">
                    <img src="./image/home.png" alt="" class="nm" />
                </div>
                <a href="./index.php">Home</a>
            </div>

            <div style="display: flex; align-items: center; margin-right: 10px">
                <div style="display: flex; align-items: center; margin: 10px">
                    <img src="./image/formulaire.png" alt="" class="nm" />
                </div>
                <a href="./Nmission.php">Nouvelle Mission</a>
            </div>
        </div>

        <div style="display: flex;
    flex-direction: column;
    margin-left: 16%;
    margin-top: 30px;">

            <form method="post" action="">
                <div>
                    <div style="display: flex; justify-content: center;align-items: center;">
                        <div style="display: flex;">
                            <div>
                                <label for="start_date">Date de début:</label>
                                <input type="date" id="start_date" name="start_date" />
                            </div>

                            <div style="margin-left: 10px;">
                                <label for="end_date">Date de fin:</label>
                                <input type="date" id="end_date" name="end_date" />
                            </div>
                        </div>

                        <div style="margin-left: 10px;">
                            <label for="destination">Destination:</label>
                            <input type="text" id="destination" name="destination" />
                        </div>
                    </div>

                    <div style="margin-left: 10px;display: flex;
                    justify-content: center;">
                        <input type="submit" value="Filtrer" name="submit_filter" style="padding: 4px;" />

                    </div>
                </div>
            </form>

            <section class="home-section" style="margin-top: 20px;">
                <table>
                    <tr id="items">
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Matricule</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php
                    // Inclure la page de connexion
                    include_once "connexion.php";
        
                    // Vérifier si le formulaire de filtrage a été soumis
                    if (isset($_POST['submit_filter'])) {
                        $start_date = $_POST['start_date'];
                        $end_date = $_POST['end_date'];
                        $destination = $_POST['destination'];
        
                        // Construire la requête SQL en fonction des valeurs soumises
                        $query = "SELECT * FROM N_mission WHERE 1=1";
                        if (!empty($start_date)) {
                            $query .= " AND date >= '$start_date'"; } if
                (!empty($end_date)) { $query .= " AND date <= '$end_date'"; } if
                (!empty($destination)) { $query .= " AND destination LIKE
                '%$destination%'"; } 
                // Exécuter la requête et afficher les résultats
                $req = mysqli_query($con, $query); } else { 
                    // Requête par défaut pourafficher tous les éléments 
                    $req = mysqli_query($con, "SELECT * FROM
                N_mission"); } if (mysqli_num_rows($req) == 0) { 
                    // S'il n'existe pasd'élément dans la base de données, afficher ce message : 
                    echo "Il n'y a pas encore de mission."; } else { 
                    // Sinon, affichons la liste de tous les éléments 
                while ($row = mysqli_fetch_assoc($req)) { ?>
                    <tr>
                        <td>
                            <?= $row['nom'] ?>
                        </td>
                        <td>
                            <?= $row['prenom'] ?>
                        </td>
                        <td>
                            <?= $row['matricule'] ?>
                        </td>
                        <td>
                            <?= $row['destination'] ?>
                        </td>
                        <td>
                            <?= $row['date'] ?>
                        </td>

                        <td><a href="supprimer.php?id=<?=$row['id']?>"><img src="image/trash.png" style="height: 25px;"></a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
                <input type="submit" value="Extraire" onclick="exportToExcel()" style="padding: 4px;" />
            </section>
            

        </div>

    </div>


    <script>
    function exportToExcel() {
        var table = document.querySelector("table");
        var html = table.outerHTML;

        // Créer un élément de lien temporaire
        var downloadLink = document.createElement("a");
        document.body.appendChild(downloadLink);

        // Spécifier les attributs du lien de téléchargement
        downloadLink.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
        downloadLink.download = "tableau_missions.xls";
        downloadLink.target = "_blank";

        // Simuler le clic sur le lien de téléchargement
        downloadLink.click();

        // Supprimer le lien de téléchargement temporaire
        document.body.removeChild(downloadLink);
    }
</script>


</body>

</html>