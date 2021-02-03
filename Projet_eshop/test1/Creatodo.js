 //nombre de todos (permet d'avoir des id spécifiques pour le bouton supprimer de chaque todo)
 var nbtodo = 0;
 // var qui permettent le comptage des caractères restants dans les input titre/texte;
 var Caracrestant1 = parseInt(document.getElementById("15").id);
 var Caracrestant2 = parseInt(document.getElementById("100").id);

 //fonction qui applique l'image de background (idbg = source de <img>
 function changebgd(idbg) {
     document.body.setAttribute('style', "background-image : url(" + idbg + ")");
     document.body.setAttribute('class', 'w-100');
 }

 /*fonction qui applique la couleur du bouton cliqué sur le bouton visible à gauche d'AJOUTER
 permet de changer la couleur des Todos*/
 function colorbutton(couleur) {
     document.getElementById("dLabel").style.backgroundColor = couleur;
     return couleur;
 }

 // fonction focus sur l'input Titre
 function init() {
     document.getElementById("form1").text1.focus();
     // compte le nombre de todos
     document.getElementById("nbtd").setAttribute("value", document.getElementsByClassName("todo").length);
 }

 /* fonction de génération d'alertes (input trop longs, ou vide, ou existant, ou succès de création de todos)
- prend en paramètre le message à afficher et le type de l'alerte (alert-success/danger/warning de bootstrap)*/
 function creerAlert(message, type) {
     messagealert = document.createTextNode(message);
     DivAlert = document.createElement("div");
     DivAlert.setAttribute("class", type);
     DivAlert.setAttribute("role", "alert");
     DivAlert.setAttribute("id", "divalert");
     DivAlert.appendChild(messagealert);
     document.getElementById("affichagealerte").appendChild(DivAlert);
     // fait disparaitre l'alerte après 1.5s.
     window.setTimeout(function () {     			document.getElementById("affichagealerte").removeChild(document.getElementById("divalert"));
     		}, 1500);
 }

/*fonction de vérification longueur des titres et  description
la même fonction marche pour les 2 inputs textes*/
 function verifinput(idCR) {
     Inputtext = document.getElementById(idCR);
     Compteur = document.getElementById(idCR).nextElementSibling;

     // crée une DIV alerte si longueur de texte dépasse
     if (Inputtext.value.length > parseInt(Compteur.id)) {
         messagealert = "TROP LONG !!!";
         cla = "alert alert-danger alert-dismissible fade show shadow-lg";
		 // appel de la fonction d'alerte
         creerAlert(messagealert, cla);
     };
	 // coupe le texte qui dépasse
     Inputtext.value = Inputtext.value.substring(0, parseInt(Compteur.id));
     Compteur.value = parseInt(Compteur.id) - Inputtext.value.length;
 }

 // fonction qui supprime tous les Todos
 function supprimer() {
     // transformation du bouton pour confirmation
     document.getElementById("supp").setAttribute("value", "CONFIRMER SUPPRESSION");
     document.getElementById("supp").setAttribute("onclick", "ToutSupprimer();");
     // création d'un bouton annuler
     annuler = document.createElement("input");
     document.getElementById("divTS").appendChild(annuler);
     annuler.setAttribute("type", "button");
     annuler.setAttribute("class", "btn btn-warning p-1 mt-1");
     annuler.setAttribute('style', "color:#fff");
     annuler.setAttribute("value", "ANNULER");
     annuler.setAttribute("id", "annuler");
     annuler.setAttribute("onclick", "annulation();");
 }

 // fonction qui annule la demande de suppression totale
 function annulation() {
     // remet le bouton Tout supprimer à sa valeur d'origine
     document.getElementById("supp").setAttribute("value", "TOUT SUPPRIMER");
     document.getElementById("supp").setAttribute("onclick", "supprimer();");
   // supprime le bouton annuler
  document.getElementById("divTS").removeChild(document.getElementById("annuler"));
 }

 // fonction qui après confirmation supprime tous les Todos
 function ToutSupprimer() {
     // supprime la div origin
     DivASup = document.getElementById("div_origin");
     DivASup.parentNode.removeChild(DivASup);
     // et la recrée
     BDivOri = document.createElement("div");
     BDivOri.setAttribute('class', "row");
     BDivOri.setAttribute('id', 'div_origin');
     document.getElementById("div0").appendChild(BDivOri);
     // repasse bouton Tout supprimer à sa valeur d'origine et supprime le bouton annuler
     document.getElementById("supp").setAttribute("value", "TOUT SUPPRIMER");
     document.getElementById("supp").setAttribute("onclick", "supprimer();");
  document.getElementById("divTS").removeChild(document.getElementById("annuler"));
     // remise à zero du nombre de todos
     nbtodo = 0;
     init();
 }

 // fonction qui supprimer un todo spécifique
 function supprcetodo(idtodo) {
     DivASup = document.getElementById(idtodo).parentElement.parentElement.parentElement;
     DivASup.parentNode.removeChild(DivASup);
     init();
 }

 // fonction qui permet de modifier un todo (le titre et la descrition, pas la date, pas la couleur)
 function modtodo(idmod) {
     // replace les valeurs texte/description du todo dans les Input titre/texte accessibles pour l'utilisateur
     document.form.text1.value = document.getElementById(idmod).parentElement.childNodes[0].innerHTML;
     document.form.text2.value = document.getElementById(idmod).parentElement.childNodes[2].innerHTML;
     // var qui garde l'id du bouton modifier cliqué dans le todo
     IdBoutonModif = document.getElementById(idmod).getAttribute('id');
     document.form.text1.focus();
     // modification du bouton Ajouter en modifier
     document.getElementById('btnajouter').value = "MODIFIER";
     document.getElementById('btnajouter').setAttribute('class', 'btn btn-info p-1 mt-1');
	 document.getElementById('btnajouter').setAttribute('style', 'color:#fff');
     document.getElementById('btnajouter').setAttribute('onclick', 'confirmod(IdBoutonModif);');
     // vérifie que la modification du texte/description ne dépasse pas taille limite, par appel de la fonction verifinput
     verifinput(document.getElementById('text1').getAttribute('id'));
     verifinput(document.getElementById('text2').getAttribute('id'));
 }

 // fonction qui modifier après confirmation le todo
 function confirmod(IdBoutonModif) {
     /*  si tous les todos sont supprimés avant fin de modification, repart de 0, i.e. remodification du
      bouton modifier en ajouter*/
     if (document.getElementById(IdBoutonModif) == null) {
         document.getElementById('btnajouter').value = "AJOUTER";
         document.getElementById('btnajouter').setAttribute('class', 'btn btn-success p-1 mt-1');
         document.getElementById('btnajouter').setAttribute('onclick', 'ajouter();');
         document.form.text1.value = "";
         document.form.text2.value = "";
         document.form.text1.nextElementSibling.value = Caracrestant1
         document.form.text2.nextElementSibling.value = Caracrestant2;
         init();
     }
     // controle si le couple titre/description existe déjà
     // boucle sur les Div Todo existants
   for (var v = 0; v < document.getElementsByClassName("todo").length; v++) {
         if (document.form.text1.value == document.getElementsByClassName("todo")[v].children[0].children[0].innerHTML) {
             if (document.form.text2.value == document.getElementsByClassName("todo")[v].children[0].children[2].innerHTML) {
                 // DIV alert créée si Todo existe déjà
                 messagealert = "CE Todo EXISTE DÉJÀ !";
                 cla = "alert alert-danger alert-dismissible fade show shadow-lg";
				 // appel de la fonction d'alerte
                 creerAlert(messagealert, cla);
                 //  retour à 0
                 document.getElementById('btnajouter').value = "AJOUTER";
                 document.getElementById('btnajouter').setAttribute('class', 'btn btn-success my-1');
                 document.getElementById('btnajouter').setAttribute('onclick', 'ajouter();');
                 document.form.text1.value = "";
                 document.form.text2.value = "";
                 document.form.text1.nextElementSibling.value = Caracrestant1
                 document.form.text2.nextElementSibling.value = Caracrestant2;
                 exit(0);
             }
         }
     }

     /*vérifier qu'un titre et une description est bien présente après modification (idéalement devrait appeler ce bout de fonction qui se trouve pour le moment dans fonction AJOUTER, il faudra splitter la fonction ajouter)*/
     // création d'une DIV alert 
     if (document.form.text1.value == "" || document.form.text2.value == "") {
         messagealert = "RENTREZ UN TITRE ET UNE DESCRIPTION";
         cla = "alert alert-danger alert-dismissible fade show shadow-lg";
		 // appel de la fonction d'alerte
         creerAlert(messagealert, cla);
     } else {
         // modification acceptée, modification du bouton modifier en ajouter
         document.getElementById(IdBoutonModif).parentElement.childNodes[0].innerHTML = document.form.text1.value;
		 document.getElementById(IdBoutonModif).parentElement.childNodes[2].innerHTML = document.form.text2.value;
		
         document.getElementById('btnajouter').value = "AJOUTER";
         document.getElementById('btnajouter').setAttribute('class', 'btn btn-success my-1');
         document.getElementById('btnajouter').setAttribute('onclick', 'ajouter();');
         document.form.text1.value = "";
         document.form.text2.value = "";
         document.form.text1.nextElementSibling.value = Caracrestant1
         document.form.text2.nextElementSibling.value = Caracrestant2;
         messagealert = "LE Todo EST MODIFIÉ";
         cla = "alert alert-warning alert-dismissible fade show shadow-lg";
		 // appel de la fonction d'alerte
         creerAlert(messagealert, cla);
         init();
     }
 }

 /*fonction d'ajout d'un Todo, à splitter en plusieurs fonctions (génération de date, vérification longueur, vérification todo existe deja,  création Todo)*/
 function ajouter() {
     // génération de la date
     d = new Date();
     mois = d.getMonth() + 1;
     mois = (mois < 10 ? '0' : '') + mois;
     jour = d.getDate();
     jour = (jour < 10 ? '0' : '') + jour;
     heure = d.getHours();
     heure = (heure < 10 ? '0' : '') + heure;
     minute = d.getMinutes();
     minute = (minute < 10 ? '0' : '') + minute;
     ladate = jour + '/' + mois + '/' + d.getFullYear();
     hours = heure + ":" + minute;
     fullDate = ladate + ' ' + hours;

     // vérifier que les input titre et description ne sont pas vides
     if (document.form.text1.value == "" || document.form.text2.value == "") {
         // si vide déclenche un message alert
         messagealert = "RENTREZ UN TITRE ET UNE DESCRIPTION";
         cla = "alert alert-danger alert-dismissible fade show shadow-lg";
		 // appel de la fonction d'alerte
         creerAlert(messagealert, cla);
     } else {
         // controle si le couple titre/description existe déjà
         // boucle sur les Div Todo existants
         for (var v = 0; v < document.getElementsByClassName("todo").length; v++) {
         if (document.form.text1.value == document.getElementsByClassName("todo")[v].children[0].children[0].innerHTML) {
             if (document.form.text2.value == document.getElementsByClassName("todo")[v].children[0].children[2].innerHTML) {
                 // DIV alert créé si Todo existe déjà
                 messagealert = "CE Todo EXISTE DÉJÀ !";
                 cla = "alert alert-danger alert-dismissible fade show shadow-lg";
				 // appel de la fonction d'alerte
                 creerAlert(messagealert, cla);
                 //  retour à 0
                 document.getElementById('btnajouter').value = "AJOUTER";
                 document.getElementById('btnajouter').setAttribute('class', 'btn btn-success my-1');
                 document.getElementById('btnajouter').setAttribute('onclick', 'ajouter();');
                 document.form.text1.value = "";
                 document.form.text2.value = "";
                 document.form.text1.nextElementSibling.value = Caracrestant1
                 document.form.text2.nextElementSibling.value = Caracrestant2;
                 exit(0);
             }
         }
     }

         /*création d'un DIV (id=div1) qui contient la DIV TODO qui contient la DIV CARD qui contient les infos du todo (div h1/h6/textearea/bouton supprimer/bouton modifier)*/

         //création des 3 TExt Nodes titre/description/date
         contenutitre = document.createTextNode(document.form.text1.value);
         contenudate = document.createTextNode(fullDate);
         contenudescription = document.createTextNode(document.form.text2.value);
         // remise à 0 des input text description (à mettre dans init()?)
         document.form.text1.value = "";
         document.form.text2.value = "";
         document.form.text1.nextElementSibling.value = Caracrestant1
         document.form.text2.nextElementSibling.value = Caracrestant2;
         // creation des nodes         
         Bdiv1 = document.createElement("div");
         BTodo = document.createElement("div");
         BCardBody = document.createElement("div");
         titre = document.createElement("h1");
         infodate = document.createElement("h6");
         description = document.createElement("textarea");
         hr = document.createElement('hr');
         grpbutton = document.createElement('div');
         but = document.createElement("button");
         mod = document.createElement("button");
         i = document.createElement("i");
         imod = document.createElement("i");
         // ajout d 'attributs aux nodes
         titre.style.borderRadius = "25%"
         Bdiv1.setAttribute('class', "col-12 col-lg-4 col-md-6 p-3");
         Bdiv1.setAttribute('id', 'div1');
         BTodo.setAttribute('class', 'card shadow-lg todo');
         BTodo.style.borderRadius = "10% 10% 35% 10%";
         BCardBody.style.backgroundColor = document.getElementById("dLabel").style.backgroundColor;
         BCardBody.style.borderRadius = "10% 10% 35% 10%";
         BCardBody.setAttribute('class', 'card-body');
         titre.style.color = "#fff";
         titre.setAttribute('class', 'card-title text-center');
         description.setAttribute('class', 'card-text');
         description.setAttribute('class', 'w-100 mb-3');
         description.setAttribute('rows', 5);
         description.setAttribute('cols', 25);
         description.style.resize = "none";
         description.style.overflow = "auto";
         description.setAttribute('readonly', true);
         description.style.border = "none";
         but.setAttribute('type', 'submit');
         but.setAttribute('value', 'supp');
         // id du bouton avec numérotation (fct du nombre de todo)
         but.setAttribute('id', 'todon°' + nbtodo);
         but.setAttribute('onclick', "supprcetodo(this.id);");
         but.setAttribute('class', "btn mr-2");
         but.style.backgroundColor = "#F1807E";
         mod.style.backgroundColor = "#E5C576";
         mod.setAttribute('type', 'submit');
         mod.setAttribute('value', 'mod');
         mod.setAttribute('id', 'mod' + nbtodo);
         mod.setAttribute('onclick', "modtodo(this.id);");
         mod.setAttribute('class', "btn mx-2");
         i.setAttribute('class', 'bi bi-trash');
         imod.setAttribute('class', 'bi bi-pen');
         bckgdcolor = document.getElementById("dLabel").style.backgroundColor;
         if (bckgdcolor == "rgb(184, 244, 188)")
             titre.style.backgroundColor = "#95EE9B";
         if (bckgdcolor == "rgb(186, 242, 233)")
             titre.style.backgroundColor = "#98EBDE";
         if (bckgdcolor == "rgb(186, 215, 242)")
             titre.style.backgroundColor = "#98C3EB";
         if (bckgdcolor == "rgb(242, 186, 201)")
             titre.style.backgroundColor = "#EB98AE";
         if (bckgdcolor == "rgb(229, 197, 118)")
             titre.style.backgroundColor = "#DEB754";
         if (bckgdcolor == "rgb(148, 154, 132)")
             titre.style.backgroundColor = "#6B705C";
         if (bckgdcolor == "rgb(237, 242, 244)")
             titre.style.backgroundColor = "#C0D1D8";
         description.style.backgroundColor = bckgdcolor;
         // insertion des textNodes dans Nodes et des Nodes dans Nodes
         infodate.appendChild(contenudate);
         titre.appendChild(contenutitre);
         description.appendChild(contenudescription);
         but.appendChild(i);
         mod.appendChild(imod);
         BCardBody.appendChild(titre);
         BCardBody.appendChild(infodate);
         BCardBody.appendChild(description);
         BCardBody.appendChild(hr);
         BCardBody.appendChild(but);
         BCardBody.appendChild(mod);
         BTodo.appendChild(BCardBody);
         Bdiv1.appendChild(BTodo);
         // insertion de DIV Bdiv dans DIV div_origin existante
         document.getElementById("div_origin").appendChild(Bdiv1);
         // nombre de todo = +1 après insertion dans div_origin
         nbtodo++;
         // message d 'alerte qui signifie la création du Todo
         cla = "alert alert-success alert-dismissible fade show shadow-lg";
         messagealert = "LE TODO VIENT D’ÊTRE CRÉÉ !";
		 // appel de la fonction d'alerte
         creerAlert(messagealert, cla);
         init();
     }
 }