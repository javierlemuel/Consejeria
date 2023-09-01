<?php
include_once 'dbconnect.php';
$date = $_GET["date"];
$today = new DateTime();

 
if( $date < $today->format('Y-m-d')) {
  echo '<div class="no-spot-available">*Select a valid date.</div>';
  exit();
}

$query = "SELECT HOUR(appt_date) as hora, MINUTE(appt_date) as minutos FROM appointment WHERE DATE(appt_date) = '$date';";
$result = mysqli_query($conn,$query);
$resultCheck = mysqli_num_rows($result);



$spotsTaken = array("10:00" => FALSE, "10:30" => FALSE, "11:00" => FALSE);


	if($resultCheck > 0){
  while($row = mysqli_fetch_assoc($result)) {
    $hora = $row['hora'];
    $minutos = $row['minutos'];

    if($row['hora'] > 12){
      $hora = $hora % 12;
    }
    if($minutos === '0'){
      $minutos .= '0';
    }

    $hora = $hora . ':' .$minutos;
    

    if($hora === "10:00"){
        $spotsTaken["10:00"] = TRUE;
    } elseif($hora === "10:30"){
        $spotsTaken["10:30"] = TRUE;
    } elseif($hora === "11:00"){
      $spotsTaken["11:00"] = TRUE;
    } else {

    } 
     
    
  }
 

  if($spotsTaken["10:00"] AND $spotsTaken["10:30"] AND $spotsTaken["11:00"]){
    echo '<div class="no-spot-available">*All spots are taken</div>';
    exit();
  }

  
    if(!$spotsTaken["10:00"]){
          echo '<div class="spot-available" onclick=getHourOfMeeting(this.textContent)>10:00am - 10:30am</div>';
    } 
    if(!$spotsTaken["10:30"]){
          echo '<div class="spot-available" onclick=getHourOfMeeting(this.textContent)>10:30am - 11:00am</div>';
    } 
    if(!$spotsTaken["11:00"]) {
          echo '<div class="spot-available" onclick=getHourOfMeeting(this.textContent)>11:00am - 11:30am</div>';
    }
   


  } else {
    echo '<div class="spot-available" onclick=getHourOfMeeting(this.textContent)>10:00am - 10:30am</div>';
    echo '<div class="spot-available" onclick=getHourOfMeeting(this.textContent)>10:30am - 11:00am</div>';
    echo '<div class="spot-available" onclick=getHourOfMeeting(this.textContent)>11:00am - 11:30am</div>';
  }

  




  mysqli_close($conn);