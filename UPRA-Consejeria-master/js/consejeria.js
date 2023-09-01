function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  if (cityName == "Cohorte" || cityName == "Primer" || cityName == "Segundo" || cityName == "Tercero" || cityName == "Cuarto" ||  cityName == "HUMA" || cityName == "CISO" || cityName == "ElectDept") {
    document.getElementById("tabla-cohorte").style.display = "block";
  } else {
    document.getElementById("tabla-cohorte").style.display = "none";
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}