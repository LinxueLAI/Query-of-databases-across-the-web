<html>
    <head>
        <meta charset="utf8"> 
        <title>Projet DB</title>
        <script src="functions.js"></script>
    </head>

    <body>
        <h1>Projet : Base de données</h1>
        <div class="management" id="db_management">
            <h2>Gestion de la Base de données</h2>
            <label for="db_creation">Création :</label>
            <button id="db_creation" onclick = createDB()>Créer la base de donnée</button>
            <br>
            <label for="db_destruction">Destruction :</label>
            <button id="db_destruction" onclick = deleteDB()>Détruire la base de donnée</button>
        </div>

        <!-- Use js to print it if a db exist or has been created -->
        <div class="management" id="table_management">
            <h2>Gestion des Tables</h2>
            <label for="table_selection">Sélectionnez une table :</label>
            <select onclick=print_modif_management() id="table_selection">
                <option value="Service">Service</option>
                <option value="Salle">Salle</option>
                <option value="Infirmier">Infirmier</option>
                <option value="Patient">Patient</option>
                <option value="Medecin">Medecin</option>
                <option value="Hospitalisation">Hospitalisation</option>
                <option value="Acte">Acte</option>
            </select>

            <br>

            <input type="radio" name="type_modif" value="insert" onclick=print_modif_management() checked> Insertion<br>
            <input type="radio" name="type_modif" value="update" onclick=print_modif_management()> Modification<br>
            <input type="radio" name="type_modif" value="delete" onclick=print_modif_management()> Supression <br> <br>
          
          
            <button type="button" onclick="javascript:window.location.href='./results.php';">Show the result of questions</button>  <br>

            <!-- <button id="import" onclick = auto_import()>Import CSV Automatique</button> -->

            <!-- depend on table selected -->
            <div class="modification" id="table_modification">
            </div>

        </div>
    
        <script>
            doesDBExist();
        </script>
    </body>
</html>