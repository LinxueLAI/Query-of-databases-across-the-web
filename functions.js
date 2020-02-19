function ajaxRequest() {
  try {
    var request = new XMLHttpRequest();
  } catch (e1) {
    try {
      request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e2) {
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e3) {
        request = false;
      }
    }
  }
  return request;
}

function setHiddenById(Id) {
  document.getElementById(Id).style.visibility = "hidden";
}

function setHiddenByClass(Class) {
  let elements = document.getElementsByClassName(Class);
  for (let i = 0; i < elements.length; i++) {
    elements[i].style.visibility = "hidden";
  }
}

function setVisibleById(id) {
  document.getElementById(id).style.visibility = "visible";
}

function setVisibleByClass(Class) {
  let elements = document.getElementsByClassName(Class);
  for (let i = 0; i < elements.length; i++) {
    elements[i].style.visibility = "visible";
  }
}

function createDB() {
  console.log("createDB called");

  request = new ajaxRequest();

  request.onreadystatechange = function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let res = this.response;
        console.log("ajax resquest accepted");
        console.log(res);
        if (res.err > 0) {
          alert(res.msg);
        } else {
          setVisibleById("table_management");
          setHiddenByClass("modification");
        }
        console.log("end");
      } else alert("ajax error :" + this.statusText);
    }
  };

  request.open("GET", "DB_Management/createDB.php", true);
  request.responseType = "json";
  request.send();
}

function deleteDB() {
  console.log("deleteDB called");

  request = new ajaxRequest();

  request.onreadystatechange = function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let res = this.response;
        console.log("ajax resquest accepted");
        console.log(res);
        if (res.err > 0) {
          alert(res.msg);
        } else {
          setHiddenById("table_management");
          setHiddenByClass("modification");
          document.getElementById("import").disabled = false;
        }
        console.log("end");
      } else alert("ajax error :" + this.statusText);
    }
  };

  request.open("GET", "DB_Management/deleteDB.php", true);
  request.responseType = "json";
  request.send();
}

function doesDBExist() {
  console.log("doesDBExit called");

  request = new ajaxRequest();

  request.onreadystatechange = function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let res = this.response;
        console.log("ajax resquest accepted");
        console.log(res);
        if (res.exist == 1) {
          setVisibleById("table_management");
          setHiddenByClass("modification");
        } else {
          setHiddenById("table_management");
        }
        console.log("end");
      } else alert("ajax error :" + this.statusText);
    }
  };

  request.open("GET", "DB_Management/doesDBExist.php", true);
  request.responseType = "json";
  request.send();
}

function print_modif_management() {
  console.log("print_modif_management called");

  let table;
  let tables = document.getElementById("table_selection");
  for (let i = 0; i < tables.length; i++) {
    if (tables[i].selected) {
      table = tables[i].value;
    }
  }
  let mode;
  let modes = document.getElementsByName("type_modif");
  for (let i = 0; i < modes.length; i++) {
    if (modes[i].checked) {
      mode = modes[i].value;
    }
  }
  console.log(table);
  console.log(mode);

  request = new ajaxRequest();

  request.onreadystatechange = function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let res = this.response;
        console.log("ajax resquest accepted");
        console.log(res);
        if (res.err > 0) {
          alert(res.msg);
        } else {
          setVisibleById("table_modification");
          document.getElementById("table_modification").innerHTML = res.text;
        }
      } else alert("ajax error :" + this.statusText);
    }
  };

  params = "table=" + table + "&mode=" + mode;
  request.open("GET", "print_modif_management.php?" + params, true);
  request.responseType = "json";
  request.send();
}

function getParams(table, ind) {
  var params = "";
  if (table == "Service") {
    params += "param0=" + document.getElementsByName("NumService")[ind].value;
    params += "&param1=" + document.getElementsByName("Nom")[ind].value;
    params += "&param2=" + document.getElementsByName("Batiment")[ind].value;
    params += "&param3=" + document.getElementsByName("NumMed")[ind].value;
    params += "&length=4";
    return params;
  } else if (table == "Salle") {
    params += "param0=" + document.getElementsByName("NumSalle")[ind].value;
    params += "&param1=" + document.getElementsByName("NumServ")[ind].value;
    params += "&param2=" + document.getElementsByName("Nblits")[ind].value;
    params += "&param3=" + document.getElementsByName("NumInf")[ind].value;
    params += "&length=4";
    return params;
  } else if (table == "Infirmier") {
    params += "param0=" + document.getElementsByName("NumInf")[ind].value;
    params += "&param1=" + document.getElementsByName("Nom")[ind].value;
    params += "&param2=" + document.getElementsByName("Adresse")[ind].value;
    params += "&param3=" + document.getElementsByName("Telephone")[ind].value;
    params += "&length=4";
    return params;
  } else if (table == "Patient") {
    params += "param0=" + document.getElementsByName("NumPat")[ind].value;
    params += "&param1=" + document.getElementsByName("Nom")[ind].value;
    params += "&param2=" + document.getElementsByName("Prenom")[ind].value;
    params += "&param3=" + document.getElementsByName("Mutuelle")[ind].value;
    params += "&length=4";
    return params;
  } else if (table == "Medecin") {
    params += "param0=" + document.getElementsByName("NumMed")[ind].value;
    params += "&param1=" + document.getElementsByName("nom")[ind].value;
    params += "&param2=" + document.getElementsByName("Specialite")[ind].value;
    params += "&length=3";
    return params;
  } else if (table == "Hospitalisation") {
    params += "param0=" + document.getElementsByName("NumPat")[ind].value;
    params += "&param1=" + document.getElementsByName("DateEntree")[ind].value;
    params += "&param2=" + document.getElementsByName("NumSalle")[ind].value;
    params += "&param3=" + document.getElementsByName("NumService")[ind].value;
    params += "&param4=" + document.getElementsByName("DateSortie")[ind].value;
    params += "&length=5";
    return params;
  } else if (table == "Acte") {
    params += "param0=" + document.getElementsByName("NumMed")[ind].value;
    params += "&param1=" + document.getElementsByName("NumPat")[ind].value;
    params += "&param2=" + document.getElementsByName("DateActe")[ind].value;
    params += "&param3=" + document.getElementsByName("NumService")[ind].value;
    params += "&param4=" + document.getElementsByName("Description")[ind].value;
    params += "&length=5";
    return params;
  }
}

function addData() {
  console.log("addData called");

  let table;
  let tables = document.getElementById("table_selection");
  for (let i = 0; i < tables.length; i++) {
    if (tables[i].selected) {
      table = tables[i].value;
    }
  }

  request = new ajaxRequest();

  request.onreadystatechange = function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let res = this.response;
        console.log("ajax resquest accepted");
        console.log(res);
        if (res.err > 0) {
          alert(res.msg);
        } else {
          print_modif_management();
          document.getElementById("msg").innerHTML = res.msg;
        }
      } else alert("ajax error :" + this.statusText);
    }
  };

  params = getParams(table) + "&table=" + table;
  console.log(params);

  request.open("GET", "Table_Management/addData.php?" + params, true);
  request.responseType = "json";
  request.send();
}

function addDataFromCSV(table) {
  console.log("addDataFromCSV called");
  let el = document.getElementById("file");
  let file;
  console.log(el);
  if (el != null && el.files.length == 1) {
    file = el.files[0].name;
  } else {
    if (document.getElementById("import").disabled) {
      file = table + ".csv";
    } else {
      alert("no file given");
      return 0;
    }
  }

  console.log(file);

  request = new ajaxRequest();

  request.onreadystatechange = function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let res = this.response;
        console.log("ajax resquest accepted");
        console.log(res);
        if (res.err > 0) {
          alert(res.msg);
        } else {
          //print_modif_management();
          //document.getElementById("msg").innerHTML = res.msg;
        }
      } else alert("ajax error :" + this.statusText);
    }
  };

  params = "file=" + file + "&table=" + table;
  console.log(params);

  request.open("GET", "Table_Management/addDataFromCSV.php?" + params, true);
  request.responseType = "json";
  request.send();
}

function auto_import() {
  document.getElementById("import").disabled = true;
  addDataFromCSV("Medecin");
  setTimeout(addDataFromCSV("Infirmier"), 2000);
  setTimeout(addDataFromCSV("Patient"), 2000);
  setTimeout(addDataFromCSV("Service"), 2000);
  setTimeout(addDataFromCSV("Salle"), 2000);
  setTimeout(addDataFromCSV("Hospitalisation"), 2000);
  setTimeout(addDataFromCSV("Acte"), 2000);
}

function getKeyAndName(PrimaryKey, PrimaryKeyName) {
  if (typeof PrimaryKey == "object") {
    console.log("hey");
    params = "";
    const len = PrimaryKey.length;
    params += "&lengthId=" + len;
    for (i = 0; i < len; i++) {
      params += `&id${i}=` + PrimaryKey[i] + `&name${i}=` + PrimaryKeyName[i];
    }
    return params;
  } else {
    return "&lengthId=1" + "&id0=" + PrimaryKey + "&name0=" + PrimaryKeyName;
  }
}

function updateData(PrimaryKey, PrimaryKeyName, ind) {
  console.log("updateData called :" + PrimaryKey);

  let table;
  let tables = document.getElementById("table_selection");
  for (let i = 0; i < tables.length; i++) {
    if (tables[i].selected) {
      table = tables[i].value;
    }
  }

  request = new ajaxRequest();

  request.onreadystatechange = function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let res = this.response;
        console.log("ajax resquest accepted");
        console.log(res);
        if (res.err > 0) {
          alert(res.msg);
        } else {
          print_modif_management();
          document.getElementById("msg").innerHTML = res.msg;
        }
      } else alert("ajax error :" + this.statusText);
    }
  };

  params =
    getParams(table, ind) +
    "&table=" +
    table +
    getKeyAndName(PrimaryKey, PrimaryKeyName);
  console.log(params);

  request.open("GET", "Table_Management/updateData.php?" + params, true);
  request.responseType = "json";
  request.send();
}

function deleteData(PrimaryKey, PrimaryKeyName) {
  console.log("deleteData called :" + PrimaryKey);
  let table;
  let tables = document.getElementById("table_selection");
  for (let i = 0; i < tables.length; i++) {
    if (tables[i].selected) {
      table = tables[i].value;
    }
  }

  request = new ajaxRequest();

  request.onreadystatechange = function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let res = this.response;
        console.log("ajax resquest accepted");
        console.log(res);
        if (res.err > 0) {
          alert(res.msg);
        } else {
          print_modif_management();
          document.getElementById("msg").innerHTML = res.msg;
        }
      } else alert("ajax error :" + this.statusText);
    }
  };

  params = "table=" + table + getKeyAndName(PrimaryKey, PrimaryKeyName);
  console.log(params);

  request.open("GET", "Table_Management/deleteData.php?" + params, true);
  request.responseType = "json";
  request.send();
}

function returnToIndex() {
  location.replace("index.php");
}

function Q1() {
  console.log("Q1 called");

  let date = document.getElementsByName("dateQ1")[0].value;
  console.log(date);

  request = new ajaxRequest();

  request.onreadystatechange = function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let res = this.response;
        console.log("ajax resquest accepted");
        console.log(res);
        if (res.err > 0) {
          alert(res.msg);
        } else {
          document.getElementById("Q1").innerHTML = res.text;
        }
      } else alert("ajax error :" + this.statusText);
    }
  };

  params = "date=" + date;
  console.log(params);

  request.open("GET", "Results/Q1.php?" + params, true);
  request.responseType = "json";
  request.send();
}
