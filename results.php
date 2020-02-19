<html>
    <head>
        <meta charset="utf8"> 
        <title>Résultat des questions</title>
        <script src="functions.js"></script>
    </head>
    <body>
    <h1>Questions et Résultats:</h1>
    <h2>Q1-Q15:</h2>
    <?php 
        require_once 'functions.php';
    ?>
        <h3>Q1:Quels sont les patients entrés à une date que l’on saisit?</h3>

        <input type="date" name="dateQ1" value="2018-04-02">
        <button onclick=Q1()>Changer la date</button>
        <div id="Q1"> </div>

        <h3>Q2:Quels sont les cancérologues qui sont chefs de service?</h3>
            <?php
                    $sql = "SELECT m.nom FROM medecin AS m JOIN service AS s ON s.NumMed=m.NumMed WHERE m.Specialite = 'Cancerologue'";
                    printQueryTable($sql, "Nom");
            ?>
            
        <h3>Q3:Quel est le nombre de lits dans chaque service? </h3>
            <?php
                    $sql = "SELECT b.NumServ,sum(b.Nblits)
                    FROM service AS a join salle AS b ON a.NumService = b.NumServ
                    GROUP BY b.NumServ";
                    printQueryTable($sql,"NumServ, SUM(Nblits)");
            ?>
        
        <h3>Q4:Quel est le nombre de lits libres dans chaque salle du service de cardiologie au 04/07/2018?</h3>
            <?php
                $sql1 = "SELECT NumSalle, SUM(Nblits) AS tot FROM service AS a 
                JOIN salle AS b ON a.NumService = b.NumServ
                WHERE a.Nom = 'Cardiologie'
                GROUP BY NumSalle";
                $sql2 = "SELECT D.NumSalle, 
                (CASE WHEN D.NumSalle 
                    IN(SELECT NumSalle FROM hospitalisation 
                        WHERE NumService = '1' AND (DateEntree<'2018-07-04' AND DateSortie>'2018-07-04'))
                    THEN (SELECT COUNT(NumPat) 
                        FROM hospitalisation AS h1 
                        WHERE NumService = '1' AND h1.NumSalle = D.NumSalle AND (DateEntree<'2018-07-04' AND DateSortie>'2018-07-04')) 
                    ELSE 0
                     END) AS ocp
                FROM hospitalisation AS h, (SELECT NumSalle FROM salle WHERE NumServ = '1') AS D 
                WHERE NumService = '1' AND (DateEntree<'2018-07-04' AND DateSortie>'2018-07-04') 
                GROUP BY D.NumSalle";

                $sql = "SELECT  B.NumSalle, tot-ocp
                FROM ((".$sql1.") as A JOIN (".$sql2.") as B ON A.NumSalle = B.NumSalle)";

                printQueryTable($sql, "NumSalle, SUM(Nblits)");

            ?>

        <h3>Q5:Quels sont les patients qui n’ont jamais été traités par un cardiologue? </h3>
            <?php
                $sql = "SELECT Nom,Prenom FROM patient WHERE NumPat NOT IN(
                SELECT a.NumPat 
                FROM medecin AS m JOIN acte AS a ON m.NumMed=a.NumMed
                WHERE m.Specialite = 'Cardiologue')";
                printQueryTable($sql, "Nom, Prenom");
            ?>
        
        <h3>Q6:Quels sont les patients qui ont subi au moins un acte dans tous les services?  </h3>
            <?php
                $sql = "SELECT p.Nom,p.Prenom FROM patient AS p JOIN acte AS a ON p.NumPat=a.NumPat
                GROUP BY p.Nom, p.Prenom
                HAVING COUNT(DISTINCT(a.NumService)) = (SELECT COUNT(DISTINCT(NumService)) FROM service)";
                printQueryTable($sql, "Nom, Prenom");
            ?>
        
        <h3>Q7:Quels sont les médecins, leur spécialité et le nom du patient, qui ont traités un patient qui a subit un acte dans tous les services de l’hopital? On triera le résultat par médecin. </h3>
            <?php
                $sql = "SELECT m.nom, m.Specialite, p.Nom FROM acte AS a 
                JOIN medecin AS m 
                    ON a.NumMed = m.NumMed
                JOIN patient AS p
                    ON a.NumPat = p.NumPat
                WHERE a.NumPat IN (SELECT NumPat FROM acte
                GROUP BY NumPat
                HAVING COUNT(DISTINCT(NumService)) = (SELECT COUNT(DISTINCT(NumService)) FROM service))
                ORDER BY m.nom";
                printQueryTable($sql, "NomMed, Specialite, NomPat");
            ?>

        <h3>Q8:Quel sont les patients qui sont toujours restés plus de deux semaines lors de leurs hospitalisations?  </h3>
            <?php
                $sql = "SELECT Nom,Prenom
                FROM patient 
                WHERE NumPat in(
                    SELECT NumPat 
                    FROM hospitalisation 
                    WHERE DateSortie-DateEntree>14)";
                printQueryTable($sql, "Nom, Prenom");
            ?>

        <h3>Q9:Quels sont les patients qui ont toujours été traités sans être hospitalisés? </h3>
            <?php
                $sql = "SELECT Nom,Prenom FROM patient WHERE NumPat NOT IN(
                    SELECT DISTINCT(NumPat)
                    FROM hospitalisation) AND NumPat IN(
                    SELECT DISTINCT(NumPat)
                    FROM acte)";
                printQueryTable($sql, "Nom, Prenom");
            ?>
        
        <h3>Q10:Quels sont les services qui n’ont traités que des patients non hospitalisés?  </h3>
            <?php
                $sql = "SELECT Nom FROM service WHERE NumService NOT IN( 
                SELECT NumService FROM hospitalisation
                GROUP BY NumService) AND NumService IN(
                SELECT NumService FROM acte
                GROUP BY NumService)" ;
                printQueryTable($sql, "Nom");
            ?>
        
        <h3>Q11:Quels sont les patients et le service, des patients qui n’ont eu un acte que dans un seul service?  </h3>
            <?php
                $sql = "SELECT p.Nom,s.Nom FROM acte AS a 
                JOIN patient AS p ON a.NumPat=p.NumPat
                JOIN service AS s ON s.NumService=a.NumService
                GROUP BY a.NumPat
                HAVING COUNT(a.NumService)=1";
                printQueryTable($sql, "NomPat, NomService");
            ?>
        
        <h3>Q12:Quelles sont les services dont la majorité des patients ont été hospitalisés au moins 2 jours? </h3>
            <?php
                $sql = "SELECT DISTINCT(s.Nom) FROM service AS s 
                JOIN hospitalisation AS h ON h.NumService = s.NumService 
                WHERE h.NumService NOT IN(
                    SELECT NumService
                    FROM hospitalisation
                    WHERE `DateSortie`-`DateEntree`<2)";
                printQueryTable($sql, "Nom");
            ?>
        
        <h3>Q13:Quels sont les patients hospitalisés plus de trois jours qui ne sont pAS à la mutelle MUT. </h3>
            <?php
                    $sql = "SELECT p.Nom,p.Prenom FROM hospitalisation AS h 
                    JOIN patient AS p ON h.NumPat = p.NumPat
                    WHERE h.DateSortie-h.DateEntree>3 AND h.NumPat NOT IN(
                        SELECT NumPat
                        FROM patient
                    WHERE Mutuelle = 'MUT')                    
                    ";
                printQueryTable($sql, "Nom, Prenom");
            ?>
        
        <h3>Q14:Quel est le nombre moyen de patients (différents) par médecin (patient ayant subit un acte par le médecin)? </h3>
            <?php
                $sql = "SELECT AVG(cnt.c) FROM(SELECT COUNT(DISTINCT(NumPat)) c FROM acte GROUP BY NumMed)cnt";
                printQueryTable($sql, "AVG")
            ?>

        <h3>Q15:Quelle est la moyenne des actes par jour pour l’ensemble des médecins? </h3>
            <?php
                    $sql = "SELECT avg(cnt.c) FROM (SELECT COUNT(*) c FROM acte GROUP BY DateActe) cnt";
                    printQueryTable($sql, "AVG");
            ?>
    <h2>Questions en plus:</h2>
        <h3>Q16:Certaines infirmiers ont la même adresse, quelle elle est celle avec le plus de infirmiers? </h3>
            <?php
                    $sql = "SELECT DISTINCT(a.Adresse)
                    FROM infirmier a JOIN (SELECT Adresse,count(*) AS nb
                        FROM infirmier i
                        GROUP BY i.Adresse)b ON a.Adresse=b.Adresse
                    WHERE b.nb=(
                        SELECT MAX(b.nb)
                    FROM infirmier a JOIN (SELECT Adresse,count(*) AS nb
                        FROM infirmier i
                        GROUP BY i.Adresse)b ON a.Adresse=b.Adresse
                        )";
                    printQueryTable($sql, "Adresse");
            ?>
        <h3>Q17:Quelle est le nombre moyen de salle par service? </h3>
            <?php
                    $sql = "SELECT AVG(T.nb) FROM(SELECT SUM(Nblits) AS nb FROM salle GROUP BY NumServ)T";
                    printQueryTable($sql, "AVG");
            ?>
        <h3>Q18:Le patient qui est sorti de l’hôpital le plus récemment et son nombre d’actes avec hospitalisation?</h3>
            <?php
                    $sql = "SELECT Nom, Prenom, COUNT(*)
                    FROM acte AS a JOIN patient AS p ON a.NumPat = p.NumPat
                    WHERE a.NumPat =(
                        SELECT NumPat FROM hospitalisation WHERE DateSortie=(
                            SELECT MAX(DateSortie) FROM hospitalisation
                            )
                        )";
                    printQueryTable($sql, "Nom, Prenom, nb_acte");
            ?>
        <h3>Q19:Quel est le nom de l'anesthésiste qui a fait le plus de actes?</h3>
            <?php
                    $sql = "SELECT Nom FROM medecin m JOIN(
                        SELECT MAX(T.nb),NumMed 
                        FROM(
                            SELECT *,COUNT(*) nb 
                            FROM acte 
                            WHERE NumMed IN(
                                SELECT NumMed
                                FROM medecin
                                WHERE Specialite='Anesthesiste'
                                )
                            GROUP BY NumMed
                            )T
                        )n ON m.NumMed = n.NumMed";
                    printQueryTable($sql, "Nom");
            ?>
            
    <script> 
        Q1();
    </script>
    </body>


</html>

