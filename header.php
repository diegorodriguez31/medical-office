<head>
  <link rel="icon" href="Images/logo.ico" />
</head>
<header>
<div class="imgHeader">
  <a href=index.php>
    <img src = "Images/LogoFinal.png" width = 150px height=120px style="margin-left: auto;margin-right: auto;display: block;margin-top: -100px;">
  </a>
</div>
<ul>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Usagers</a>
    <div class="dropdown-content">
      <a href="ajoutPatient.php">Ajouter un patient</a>
      <a href="recherchePatient.php">Rechercher un patient</a>
    </div>
  </li>
    <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Médecins</a>
    <div class="dropdown-content">
      <a href="ajoutMedecin.php">Ajouter un médecin</a>
      <a href="rechercheMedecin.php">Rechercher un médecin</a>
    </div>
  </li>
    <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Consultations</a>
    <div class="dropdown-content">
      <a href="saisirRdv.php">Saisir un rendez-vous</a>
      <a href="consultation.php">Afficher les rendez-vous</a>
    </div>
  </li>
    <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Statistiques</a>
    <div class="dropdown-content">
      <a href="statistiques.php">Statistiques des patients</a>
      <a href="statistiquesMedecin.php">Statistiques des médecins</a>
    </div>
  </li>
  <li style="float:right"><a href="index.php?deconnexion=true" style="padding:0;"><img class=deco src = "Images/Logout.png" width=50px height=50px></a></li>
</ul>

</header>

<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: 7AC3EA;
  height: 60px;
  font-family: monospace;
  font-weight: bold;
}

.deco{
  padding:6px 12px;
}

.imgHeader{
   background-image: url('Images/BackHead.jpg');
   background-size:cover;
   background-repeat: no-repeat;
   padding-top:100px;
}

li {
  float: left;
}

li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 24px 16px;
  text-decoration: none;
  line-height: 12px;
  color:black;
  font-size: 1.3em;
}

li a:hover, .dropdown:hover .dropbtn {
  background-color: #4ddbff;
}

li.dropdown {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: grey;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f3f3f3;}

.dropdown:hover .dropdown-content {
  display: block;
}

header {
    position: absolute;
    top: 0px;
    left: 0px;
    right:0px;
}

.imgHeader a{
  width: 150px;
  height: 120px;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

</style>