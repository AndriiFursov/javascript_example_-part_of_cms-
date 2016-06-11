/*------------------------------------*\
    #SECTION-MANAGER
    Scripts for tools__*.php
\*------------------------------------*/
/* 
 * Functions:
 *
 * changeCitySelect (selected) - Togle visibility of cities in corresponding
 * <select> depend on selected country
 * 
 * setDate (selectedDate) - Function to set selected date to the "leaving date"
 * field
 *
 * togleHint (target) - Togle visibility of hints texts
 *
 * toggleBlockVisibilityBtn (buttonID, blockID, action) - Function to toggle 
 * visibility of specified block and to change button legend
 *
 * readHandbooks () - Function to update "select" handbooks with AJAX 
 * 
 * browsersAdaptation () - Function to hide some elements in diferent browsers
 *
*/

function changeCitySelect (selected) {
/*
 * Togle visibility of cities in corresponding <select> depend on selected 
 * country
*/
    var selectedCities = document.getElementsByClassName(selected.value + "_city"),
        allCities = document.querySelectorAll("select[name=\"city\"] option");
    
    
    for (var i = 0; i < allCities.length; i++) allCities[i].style.display = "none";

    for (var i = 0; i < selectedCities.length; i++) {
        selectedCities[i].style.display = "block";
    }
}


function setDate (selectedDate) {
/*
 * Function to set selected date to the "leaving date" field
 *
*/

    var dateArray = selectedDate.value.split('-');
    
    
    document.getElementById("date-of-leaving").value = dateArray[2] + 
    "." + dateArray[1] + "." + dateArray[0];
}


function togleHint (target) {
/*
 * Togle visibility of hints texts
*/

    var showHint = document.getElementById(target),
        hints = document.getElementsByClassName('hint');
        
        
    for (i = 0; i < hints.length; i++) {
        hints[i].style.display = "none";
    }
    
    showHint.style.display = "block"
}


function toggleBlockVisibilityBtn (buttonID, blockID, action) {
/*
 * Function to toggle visibility of specified block and 
 * to change button legend
 *
*/

    var buttonToTogle = document.getElementById(buttonID),
        listToTogle = document.getElementById(blockID);
        
        
    if (listToTogle.style.display !== "block" || action === "open") {
        buttonToTogle.innerHTML = "Свернуть";
        listToTogle.style.display = "block";
    } else {
        buttonToTogle.innerHTML = "Развернуть";
        listToTogle.style.display = "none";
    }
    
}


function readHandbooks () {
/*
 * Function to update "select" handbooks with AJAX  
 * 1 - use synchronous requests bacause it help
 *     to prevent use "selects" before they will
 *     be updated
*/

    var xhttp = new XMLHttpRequest(),
        newListCountries = '<option value="empty" selected disabled></option>',
        newListCities = '<option class="empty_city" value="empty" selected disabled></option>' +
                        '<option class="empty_city" value="empty" disabled>' +
                        'Сначала выберите страну!</option>',
        newListCurrency = '',
        newListRoomType = '<option value="empty" selected  disabled>выберите</option>',
        newListAccomodation = '<option value="empty" selected disabled>выберите</option>',
        newListTourTypes = '<option value="empty" selected disabled></option>',
        newListTouroperators = '<option value="empty" selected disabled>выберите</option>';
        
    
    xhttp.open("GET", "handler--manager-handbooks.php?handbook=countries", false); /* [1] */
    xhttp.send();
    newListCountries += xhttp.responseText;
    document.getElementById("select-countries").innerHTML = newListCountries;

    
    xhttp.open("GET", "handler--manager-handbooks.php?handbook=cities", false); 
    xhttp.send();
    newListCities += xhttp.responseText;
    document.getElementById("select-cities").innerHTML = newListCities;

    
    xhttp.open("GET", "handler--manager-handbooks.php?handbook=currency", false); 
    xhttp.send();
    newListCurrency += xhttp.responseText;
    document.getElementById("select-currency").innerHTML = newListCurrency;
    visaCurrency = document.getElementById("select-visa-currency");
    visaCurrency ? visaCurrency.innerHTML = newListCurrency : "";
   

    xhttp.open("GET", "handler--manager-handbooks.php?handbook=room", false); 
    xhttp.send();
    newListRoomType += xhttp.responseText;
    document.getElementById("select-room-type").innerHTML = newListRoomType;


    xhttp.open("GET", "handler--manager-handbooks.php?handbook=accomodation", false); 
    xhttp.send();
    newListAccomodation += xhttp.responseText;
    document.getElementById("select-accomodation").innerHTML = newListAccomodation;


    xhttp.open("GET", "handler--manager-handbooks.php?handbook=tour_type", false); 
    xhttp.send();
    newListTourTypes += xhttp.responseText;
    document.getElementById("select-tour-type").innerHTML = newListTourTypes;

    
    xhttp.open("GET", "handler--manager-handbooks.php?handbook=touroperator", false); 
    xhttp.send();
    newListTouroperators += xhttp.responseText;
    document.getElementById("select-touroperator").innerHTML = newListTouroperators;
}


function browsersAdaptation () {
/*
 * Function to hide some elements in diferent browsers 
 * 
*/

    var elementsToHide = document.getElementsByClassName("not-firefox");


    if (navigator.userAgent.indexOf("Firefox/") > -1) {
        for (i = 0; i < elementsToHide.length; i++) {
            elementsToHide[i].style.display = "none";
        }
    }
}


document.addEventListener("DOMContentLoaded", browsersAdaptation);
document.addEventListener("DOMContentLoaded", readHandbooks);