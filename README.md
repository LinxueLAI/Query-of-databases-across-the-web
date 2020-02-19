# Project：databases and dynamic web
Descriptions:
  This Project is about developing a website that allows you to create a database, to query it and also to modify its content.
  This site will be made up of several dynamic pages of which we describe the expected operation below. The main page includes also the buttons for adding 
  The interaction with the database is done using PHP.The index.php file if for activating our program. All data files (csv) will be found and read by the program using a relative path to this directory. All other pages necessary for the project will also be found in this directory.
  For launching and testing the programme, you need to download all the files to the directory "www" of WAMP (or other similar plateform).
  Test steps:
  1.Cliking the button to create or destruct a database;
  2.Adding .csv documents to load our datas: you need to firstly load "Infirmier.csv" "Patient.csv" "Medecin.csv" , then load "Service.csv" "Salle.csv", lasty load "Hospitalisation.csv" and "Acte.csv". The order is important because of the restrictions between different files. (We can also add informations by taping the datas directly in the page than click the button "Ajouter".)
  Relations:
  — Service(NumService, Nom, Batiment, #NumMed)  primary keys: NumService
  — Salle(NumSalle, #NumServ, Nblits, #NumInf)   primary keys: NumSalle, NumServ
  — Inﬁrmier(NumInf, Nom, Adresse, Telephone)    primary keys: NumInf
  — Patient(NumPat, Nom, Prenom, Mutuelle)       primary keys: NumPat
  — Medecin(NumMed, nom, Specialite)            primary keys: NumMed
  — Hospitalisation(#NumPat, DateEntree, #NumSalle,#NumService,DateSortie) primary keys: NumPat, DateEntree, NumSalle
  — Acte(#NumMed, #NumPat, DateActe, #NumService, Description)             primary keys: NumMed, NumPat, DateActe
  3.After adding data, we can modify and delete the datas by the optional buttons.(At the same time we can see all the datas that we have added.)
  4.Clicking "Show the result of questions" to see the answers of several questions by doing query of database.(the query commands are showed in the file "results.php")
  
  Some Attentions：
- The Acte.csv file can be used to import any table.
- Entries 36 and 37 for the Act table are not correct (NumMed 17 and 18 do not exist).
- Questions Q6 and Q7 have no results unless we change NumMed of entries 36 and 37 respectively by 7 and 8.
- When importing, from a CSV file, the Act table an error appears (It's a counter incremented once too much because we arrive at the end of the file but this did not significant impact).
