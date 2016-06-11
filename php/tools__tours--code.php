<?php
/*------------------------------------*\
    #SECTION-TOUR-FULL-INFO
    AND-ALL-TOURS-SHORT-INFO
    Backend for manager__tours.php
\*------------------------------------*/
include "../../passw.php";
include "../kit/connection.php";
$sql = "";





// geting a posted data
$flag             = $_POST["flag"];
$changed_tour     = $_POST["changed-tour"];
$id               = $_POST["id"];
$show             = $_POST["show"];
$country          = $_POST["country"];
$city             = $_POST["city"];
$date_of_leaving  = $_POST["date_of_leaving"];
$duration         = $_POST["duration"];
$price            = $_POST["price"];
$currency         = $_POST["currency"];
$hotel            = $_POST["hotel"];
$room_type        = $_POST["room-type"];
$add_room_type    = $_POST["addRoomType"];
$accomodation     = $_POST["accomodation"];
$add_accomodation = $_POST["addAccomodation"];
$tour_type        = $_POST["tour_type"];
$touroperator     = $_POST["tour-operator"];
$add_touroperator = $_POST["addTourOperator"];
$tagline          = $_POST["tagline"];
$visa             = $_POST["visa"];
$promo_handmade   = $_POST["promo-text"];

$date_of_adding   = date("d.m.Y");


// handling promo-text
if ($promo_handmade) {
    $promo_handmade = preg_replace('/\r\n/', ' ', $promo_handmade);
}

// change variables for adding to the base
if (!$show) {$show = 0;}
if ($add_room_type) {$room_type = $add_room_type;}
if ($add_accomodation) {$accomodation = $add_accomodation;}
if ($add_touroperator) {$touroperator = $add_touroperator;}





// change tour
if ($changed_tour) {
    $sql = "UPDATE tours SET ";
    if ($id) {
        $sql .= "id='" . $id . "', ";
//        $rename_flag = 1;
    }
    if ($city) {
        $sql .= "city='" . $city . "', ";
    }
    if ($price) {
        $sql .= "price='" . $price . "', ";
    }
    if ($hotel) {
        $sql .= "hotel='" . $hotel . "', ";
    }
    if ($date_of_leaving) {
        $sql .= "date_of_leaving='" . $date_of_leaving . "', ";
    }
    if ($duration) {
        $sql .= "duration='" . $duration . "', ";
    }
    if ($room_type) {
        $sql .= "tour_room='" . $room_type . "', ";
    }
    if ($accomodation) {
        $sql .= "tour_accomodation='" . $accomodation . "', ";
    }
    if ($touroperator) {
        $sql .= "tour_operator='" . $touroperator . "', ";
    }
    if ($visa) {
        $sql .= "tour_visa='" . $visa . "', ";
    }
    if ($date_of_adding) {
        $sql .= "date_of_adding='" . $date_of_adding . "', ";
    }
    if ($tour_type) {
        $sql .= "tour_type='" . $tour_type . "', ";
    }
    if ($tagline) {
        $sql .= "tagline='" . $tagline . "', ";
    }
    if ($promo_handmade) {
        $sql .= "promo_text='" . $promo_handmade . "', ";
    }
    $sql .= "view='" . $show . "', ";
    $sql .= "currency='" . $currency . "' ";
    $sql .= "WHERE id='" . $changed_tour . "'";
    
    if ($conn->query($sql) === TRUE) {
        if ($id) {
            if (rename('../tours/' . $changed_tour . '.php', '../tours/' . 
                  $id . '.php')) {
                $message_change_file = "<br>ID тура успешно изменён!";
            }
        }
        $message_change_tour = "Данные изменены успешно!";
    } else {
        $message_change_tour = "Ошибка изменения данных: " . $conn->error;
    }
}


// delete/change showing tours
if ($flag === "1") {
    $sql = "SELECT id FROM tours";
    $result = $conn->query($sql);
    $flag_del = 0;
    $dell_array = array(); 
    
    if ($result->num_rows > 0) {
        $sql_del = "DELETE FROM tours WHERE id IN ('";
        $sql_show = "UPDATE tours SET view='1' WHERE id IN ('";
        $sql_hide = "UPDATE tours SET view='0' WHERE id IN ('";
    
        while($row = $result->fetch_assoc()) {
            if ($_POST[$row["id"]."_show"]) {
                $sql_show .= $row["id"]."', '";
            } else {
                $sql_hide .= $row["id"]."', '";
            }
            
            if ($_POST[$row["id"]."_del"]) {
                $sql_del .= $row["id"]."', '";
                $flag_del = 1;

                $dell_array[] = $row["id"];
            }
        }
        
        $sql_show = substr($sql_show, 0, -3);
        $sql_show .= ")";
        $sql_hide = substr($sql_hide, 0, -3);
        $sql_hide .= ")";

        // show turs
        if ($conn->query($sql_show) === TRUE) {
//            $message_show_tours = "Изменения внесены успешно " .
//                                  "(показ туров)!" . "<br>"; 
        } else {
            $message_show_tours = "Изменения не внесены (показ туров)! " .
                                  "Ошибка : " . $conn->error . "<br>";
        }

        // hide tours
        if ($conn->query($sql_hide) === TRUE) {
//            $message_show_tours = "Изменения внесены успешно " .
//                                  "(показ туров)!" . "<br>"; 
        } else {
            $message_show_tours = "Изменения не внесены (показ туров)! " .
                                  "Ошибка : " . $conn->error . "<br>";
        }
        
        // dell tours
        if ($flag_del === 1) {
            $sql_del = substr($sql_del, 0, -3);
            $sql_del .= ")";
            if ($conn->query($sql_del) === TRUE) {
                foreach($dell_array as $element){
                    if (unlink("../tours/" . $element . ".php")){
                        $message_dell_tours = "Выбранные туры удалены успешно!";
                    } else {
                        $message_dell_tours = "Туры удалены успешно из БД. " .
                                              "При попытке удаления файлов " .
                                              "туров произошла ошибка! ";
                    }
                }
            } else {
                $message_dell_tours = "При удалении туров произошла ошибка: " . 
                                      $conn->error;
            }
        }
    
    $message_change_tours = $message_show_tours . 
                            $message_dell_tours;  
        
    } else {
        $message_change_tours = "ОШИБКА! Попытка изменения пустой таблицы!";
    }
}





$conn->close();
?>