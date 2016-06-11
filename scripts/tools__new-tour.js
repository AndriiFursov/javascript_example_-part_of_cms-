/*------------------------------------*\
    #SECTION-MANAGER-ADD
    Scripts for tools__new-tour.php
\*------------------------------------*/
/* 
 * Functions:
 *
 * addPoint () - Function to add point to list with distances to specified point 
 * 
 * addListItem (listId, newListName) - Function to add the text field to the 
 * options list for adding new information
 *
 * addPhoto () - Add point to list with photos (use in hotel details)
 *
 * loadPhoto () - Function to load/delete photo preview
 *
 * resultMessage (messageText) - Function to call a message with result of an 
 * adding operation
 * 
 * notePreview () - Function to show final view of the text which user put to 
 * texarea
 * 
 * insertTag (tagStart, tagEnd) - Function to insert tags near the selected text 
 * in texarea
 *
 * hotelsToChoose (inputField) - Function to send data from "hotel name" 
 * field to the server and to convert server response to a list of existed 
 * hotels 
 *
 * chooseHotel (hotelId) - Function to set hotel as active for current tour 
 * (to fill in all filds in the tour description) 
 *
 * submitNewTour () - Function to confirm a readines of a new tour to be added 
 * to the base and to submit form if all checks are successful
 *
 * waitingPopup () - Function to show/hide popup "waiting..."
 * 
*/

function addPoint () {
 /*
 * Add point to list with distances to specified point
 * (use in hotel details)
*/
   
    var distances = document.getElementById("distances"),
        menueItem = document.createElement("li"),
        txt       = document.createTextNode(": "),
        div       = document.createElement("div"),
        loc       = document.createElement("input"),
        dist      = document.createElement("input"),
        unit      = document.createElement("select");
    
    distances.appendChild(menueItem);
    menueItem.appendChild(div);
    menueItem.appendChild(loc);
    menueItem.appendChild(txt);
    menueItem.appendChild(dist);
    menueItem.appendChild(unit);

    div.setAttribute("class", "dist-col1");
    div.innerHTML = "до";
    loc.setAttribute("type", "text");
    loc.setAttribute("class", "location");
    loc.setAttribute("name", "location[]");
    dist.setAttribute("type", "text");
    dist.setAttribute("class", "distance");
    dist.setAttribute("name", "distance[]");
    unit.setAttribute("class", "units");
    unit.setAttribute("name", "units[]");
    unit.innerHTML = 
        "<option value=\"км\">км</option>" +
        "<option value=\"м\">м</option>" +
        "<option value=\"ч.\">ч.</option>" +
        "<option value=\"мин.\">мин.</option>";
            
    loc.focus();
}

function addListItem (listId, newItemName) {
/*
 * Function to add the text field to the options list for
 * adding new information
 *
*/
    
    var parentElement = document.getElementById(listId),
        menueItem = document.createElement("li");
        
        
    parentElement.appendChild(menueItem);
    menueItem.innerHTML = "<input type=\"text\" name=\"" + newItemName + "[]\" " +
    "class=\"new-list-item\">";
    menueItem.getElementsByTagName("*")[0].focus();
}

function addPhoto () {
 /*
 * Add point to list with photos
 * (use in hotel details)
*/
   
    var listOfPhotos = document.getElementById("photo"),
        menueItem = document.createElement("li"),
        div = document.createElement("div"),
        input = document.createElement("input");
    
    listOfPhotos.appendChild(menueItem);
    menueItem.appendChild(div);
    menueItem.appendChild(input);
    
    div.setAttribute("class", "l-col1");
    div.innerHTML = "добавить фото: ";
    input.setAttribute("type", "text");
    input.setAttribute("class", "l-col2  photo-address");
    input.setAttribute("name", "photo[]");
    input.setAttribute("oninput", "loadPhoto();");
    input.focus();
}

function loadPhoto () {
/*
 * Function to load/delete photo preview
 *
*/
    
    var imgContainer = document.getElementById("galery-photo"),
        allImages = document.getElementsByName("photo[]"),
        carouselItem = [];
        
    var i;

    
    imgContainer.innerHTML = "";
    for (i = 0; i < allImages.length; i++) {
        if (allImages[i].value) {
            carouselItem[i] = document.createElement("img");
            carouselItem[i].src = allImages[i].value;
            carouselItem[i].height= "100";
            imgContainer.appendChild(carouselItem[i]);
        }
    }
}


function resultMessage (messageText) {
/*
 * Function to call a message with result of an adding operation
 *
*/

    if (messageText) alert (messageText);
}


function notePreview () {
/*
 * Function to show final view of the text which user put to texarea
 *
*/

    var resultField = document.getElementById('description-result'),
        sourceText = document.getElementsByName('hotel-description')[0].value;
        
        
    sourceText = sourceText.replace(/\n/g, '<br>');
    sourceText = sourceText.replace(/\s\s/g, '&nbsp;&nbsp;');
    sourceText = sourceText.replace(/ul><br>/g, 'ul>');
    sourceText = sourceText.replace(/<\/li><br>/g, '</li>');
    resultField.innerHTML = sourceText;
}

function insertTag (tagStart, tagEnd) {
/*
 * Function to insert tags near the selected text in texarea
 *
*/

    var area = document.getElementsByName('hotel-description')[0],
        sStart = area.selectionStart, 
        sEnd = area.selectionEnd,
        tagLength = tagStart.length;


    if (document.getSelection) {
        area.value = area.value.substring(0,sStart) + tagStart +
        area.value.substring(sStart, sEnd) + tagEnd +
        area.value.substring(sEnd,area.value.length);
        
        area.focus();
        area.setSelectionRange(sStart + tagLength, sEnd + tagLength);
    }
}


function hotelsToChoose (inputField) {
/*
 * Function to send data from "hotel name" field to the server 
 * and to convert server response to a list of existed hotels 
 *
*/

    var xhttp = new XMLHttpRequest(),
        outputField = document.getElementById('hotels-anchors');
    var parameters;
    
    
    parameters = "?data=" + encodeURIComponent(inputField.value);
    
    xhttp.onreadystatechange = function() {
        var answerArray, hotel, outputInfo;
        
        
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            
            answerArray = JSON.parse(xhttp.responseText);

            outputField.innerHTML = "";
            if (answerArray !== null) {
                for (i = 0; i < answerArray.length; i++) {
                    hotel = document.createElement('div');
                    outputInfo = answerArray[i][1];
                    
                    hotel.innerHTML = outputInfo.h_name + " " +
                                      outputInfo.h_class;
                    hotel.onclick = chooseHotel(outputInfo.h_code, 
                                                outputInfo.h_name,
                                                outputInfo.h_class);
                    
                    outputField.appendChild(hotel);
                }
            }
        }
    };
    xhttp.open("GET", "handler--hotels-to-choose.php" + parameters, true); 
    xhttp.send();
}

function chooseHotel (chousenId, chousenName, chousenLevel) {
/*
 * Function to set hotel as active for current tour (to fill in all filds in 
 * the tour description) 
 * 1 To clean all old values
 *
*/

    return function () {
        var xhttp = new XMLHttpRequest(),
            hotelName  = document.getElementsByName('hotel')[0],
            hotelLevel = document.getElementsByName('hotel-level')[0],
            hohelId = document.getElementsByName('hotel-id')[0];
            
            
        hotelName.value = chousenName;
        hotelLevel.value = chousenLevel;
        hohelId.value = chousenId;
        
        
        xhttp.onreadystatechange = function() {
            var i, answerArray, tmpArr, menueItem;
            
            function setStaticFields (arr, i, str1, str2, field, begin, num) {
                if (str1 && str1.indexOf(str2) > -1) {
                    field.value = str1.substr(begin, str1.length - num);
                    delete answerArray[arr][i];
                } 
            }
            
            function addFields (block, elem, arr) {
                var parentElement = document.getElementById(block);
                var menueItem, tmpArr;
                
                parentElement.innerHTML = "";
                tmpArr = answerArray[arr];
                for (i = 0; i < tmpArr.length; i++) {
                    menueItem = document.createElement("li");
                    if (tmpArr[i]) {
                        parentElement.appendChild(menueItem);
                        menueItem.innerHTML = "<input type=\"text\" name=\"" + 
                        elem + "[]\" " + "class=\"new-list-item\" value=\"" + 
                        tmpArr[i] + "\">";
                    }
                }
            }

            
            
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                answerArray = JSON.parse(xhttp.responseText); //an object

                // images
                var listOfPhotos = document.getElementById("photo"), 
                    hotelImages = document.getElementsByName("photo[]")[0],
                    evnt = new Event("input");
                listOfPhotos.innerHTML = ""; /* [1] */
                tmpArr = answerArray.h_photos;
                if (tmpArr[0] !== undefined) {
                    hotelImages.value = "../tour-img/" + tmpArr[0];
                } else {
                    hotelImages.value = "";
                }
                for (i = 1; i < tmpArr.length; i++) {
                    menueItem = document.createElement("li");
                    div = document.createElement("div");
                    input = document.createElement("input");
                    
                    listOfPhotos.appendChild(menueItem);
                    menueItem.appendChild(div);
                    menueItem.appendChild(input);
                    
                    div.setAttribute("class", "l-col1");
                    div.innerHTML = "добавить фото: ";
                    input.setAttribute("type", "text");
                    input.setAttribute("class", "l-col2  photo-address");
                    input.setAttribute("name", "photo[]");
                    input.setAttribute("oninput", "loadPhoto();");
                    input.value = "../tour-img/" + tmpArr[i];
                }
                hotelImages.dispatchEvent(evnt);

                // site
                var hotelSite = document.getElementsByName('hotel-site')[0];                
                hotelSite.value = answerArray.h_site;
                
                // description
                var hotelDescr = document.getElementsByName('hotel-description')[0];
                hotelDescr.value = answerArray.h_description;
                
                // all checkboxes
                var checkboxes = 
                    document.querySelectorAll('input[type="checkbox"]');
                for (i = 0; i < checkboxes.length; i++) {
                    if ((checkboxes[i].name !== "show")&&
                        (checkboxes[i].name !== "standard-tour")&&
                        (checkboxes[i].name !== "free-tour")) {
                        checkboxes[i].checked = false; /* [1] */
                    }
                    for(var key in answerArray) {
                        var j = answerArray[key].indexOf(checkboxes[i].value);
                        
                        if (j > -1) {
                            checkboxes[i].checked = true;
                            delete answerArray[key][j];
                        } 
                    }   
                }
                
                // build
                var hotelBuild = document.getElementsByName('hotel-build')[0],
                    hotelRebuild = document.getElementsByName('hotel-rebuild')[0];
                tmpArr = answerArray.h_build;
                if (tmpArr[0]&&tmpArr[0] !== "") {
                    hotelBuild.value = tmpArr[0].substr(15, tmpArr[0].length - 16);
                } else {
                    hotelBuild.value = "";
                }
                if (tmpArr[1]&&tmpArr[1] !== "") {
                    hotelRebuild.value = tmpArr[1].substr(17, tmpArr[1].length - 23);
                } else {
                    hotelRebuild.value = "";
                }
                
                // distances
                var distances = document.getElementById('distances');
                var aeroLoc, aeroDist, aeroUnits, div, loc, dist, unit, txt,
                    tmpArr1;
                distances.innerHTML = ""; /* [1] */
                aeroLoc = document.getElementsByName('location-aeroport')[0];
                aeroDist = document.getElementsByName('distance-aeroport')[0];
                aeroUnits = document.getElementsByName('units-aeroport')[0];                
                tmpArr = answerArray.h_distances;
                aeroUnits.value = "км";
                aeroDist.value = "";
                aeroLoc.value = "";
                for (i = 0; i < tmpArr.length; i++) {
                    if (tmpArr[i] && tmpArr[i].indexOf("До аэропорта") > -1) {
                        tmpArr1 = tmpArr[i].split(' ');
                        aeroUnits.value = tmpArr1[tmpArr1.length - 1];
                        aeroDist.value = tmpArr1[tmpArr1.length - 2];
                        aeroLoc.value = tmpArr[i].substr(13, tmpArr[i].length -
                                        (aeroDist.value.length +
                                        aeroUnits.value.length + 15));
                    } else if (tmpArr[i]) {
                        txt = document.createTextNode(": ");
                        div = document.createElement("div");
                        loc = document.createElement("input");
                        dist = document.createElement("input");
                        unit = document.createElement("select");
                        menueItem = document.createElement("li");
                        distances.appendChild(menueItem);
                        menueItem.appendChild(div);
                        menueItem.appendChild(loc);
                        menueItem.appendChild(txt);
                        menueItem.appendChild(dist);
                        menueItem.appendChild(unit);
                        tmpArr1 = tmpArr[i].split(' ');
                        div.setAttribute("class", "dist-col1");
                        div.innerHTML = "до ";
                        loc.setAttribute("type", "text");
                        loc.setAttribute("class", "location");
                        loc.setAttribute("name", "location[]");
                        dist.setAttribute("type", "text");
                        dist.setAttribute("class", "distance");
                        dist.setAttribute("name", "distance[]");
                        unit.setAttribute("class", "units");
                        unit.setAttribute("name", "units[]");
                        unit.innerHTML = 
                                "<option value=\"км\">км</option>" +
                                "<option value=\"м\">м</option>" +
                                "<option value=\"ч.\">ч.</option>" +
                                "<option value=\"мин.\">мин.</option>";
                        dist.value = tmpArr1[tmpArr1.length - 2];
                        unit.value = tmpArr1[tmpArr1.length - 1];
                        loc.value = tmpArr[i].substr(3, tmpArr[i].length -
                                    (dist.value.length +
                                    unit.value.length + 5));
                    } 
                }

                // in rooms
                addFields ('equipment', 'equipment', 'h_in_rooms');

                // types of rooms
                addFields ('room-types', 'room-types', 'h_numbers');

                // feeding
                var restaurants = document.getElementsByName('restaurants')[0],
                    bars = document.getElementsByName('bars')[0];
                    restaurants.value = "";
                    bars.value = "";
                tmpArr = answerArray.h_food;
                for (i = 0; i < tmpArr.length; i++) {
                    setStaticFields ("h_food", i, tmpArr[i], 
                                     "Ресторанов:", restaurants, 12, 12);
                    setStaticFields ("h_food", i, tmpArr[i], "Баров:", 
                                     bars, 7, 7);
                }
                addFields ('feeding', 'feeding', 'h_food');

                // territory
                addFields ('territory', 'territory', 'h_territory');
                
                // pools
                var openPools = document.getElementsByName('open-pools')[0],
                    closedPools = document.getElementsByName('closed-pools')[0],
                    kidPools = document.getElementsByName('kid-pools')[0];
                    openPools.value = "";
                    closedPools.value = "";
                    kidPools.value = "";
                tmpArr = answerArray.h_pools;
                for (i = 0; i < tmpArr.length; i++) {
                    setStaticFields ("h_pools", i, tmpArr[i], 
                                     "Открытых бассейнов", openPools, 19, 19);
                    setStaticFields ("h_pools", i, tmpArr[i], 
                                     "Закрытых бассейнов", closedPools, 
                                     19, 19);
                    setStaticFields ("h_pools", i, tmpArr[i], 
                                     "Детских бассейнов", kidPools, 18, 18);
                }
                addFields ('pools', 'pool', 'h_pools');

                // equipment for children
                addFields ('for-children', 'children', 'h_for_children');
                
                // hotel services
                var conferenceHalls = document.getElementsByName('conference-halls')[0];
                tmpArr = answerArray.h_services;
                conferenceHalls.value = "";
                for (i = 0; i < tmpArr.length; i++) {
                    setStaticFields ("h_services", i, tmpArr[i], 
                                     "Конференц-залов", conferenceHalls, 
                                     18, 18);
                }
                addFields ('services', 'services', 'h_services');
                
                // health & beauty
                addFields ('health', 'health', 'h_health');

                // entertainments
                addFields ('entertainment', 'entertainment', 'h_fun');

                // sport
                var tennis = document.getElementsByName('tennis')[0];
                tmpArr = answerArray.h_sport;
                tennis.value = "";
                for (i = 0; i < tmpArr.length; i++) {
                    setStaticFields ("h_sport", i, tmpArr[i], 
                                     "Теннисных кортов", tennis, 19, 19);
                }
                addFields ('sport', 'sport', 'h_sport');
            }
        };
        xhttp.open("GET", "handler--hotel-information.php?hotel-id=" + 
                   chousenId, true); 
        xhttp.send();
    }
}


function submitNewTour () {
/*
 * Function to confirm a readines of a new tour to be added to the base and 
 * to submit form if all checks are successful
 * 1 - Stop all activities while data are handling
 * 
 */

    var xhttp = new XMLHttpRequest(),
        tourIdVal    = document.forms[0].elements.id.value,
        img          = document.forms[0].elements['photo[]'],
        imgAmount    = document.forms[0].elements.photos, 
        hotelId      = document.forms[0].elements['hotel-id'],
        hotelIdVal   = document.forms[0].elements['hotel-id'].value, 
        photosArray  = [];
        
    var i, parameters, resultAction;
    
        
    // show modal window "waiting..."
    waitingPopup();

    // check tour id and hotel id
    if (hotelIdVal === "") {
        parameters = "tour-id=" + tourIdVal + "&hotel-id=" + tourIdVal; 
    } else {
        parameters = "tour-id=" + tourIdVal + "&hotel-id=" + hotelIdVal;
    }

    xhttp.onreadystatechange = function() {
        var answerObj;
        
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            answerObj = JSON.parse(xhttp.responseText);
            if (answerObj[0] === "Error") {
                alert ("Ошибка! Тур с таким Id существует!");
                resultAction = false;
            } else {
                hotelId.value = answerObj[1];
                resultAction = true;
            }
        }
    };
    xhttp.open("GET", "handler--check-ids.php?" + parameters, false); /* [1] */
    xhttp.send();
    
    
    if (resultAction == true) {
        // copying images
        if (img.length) {
            for (i = 0; i < img.length; i++) {
                photosArray[i] = encodeURIComponent(img[i].value);
            }
        } else {
            photosArray[0] = img.value;
        }
        
        parameters = parameters + "&photo=" + JSON.stringify(photosArray);
        
        xhttp.onreadystatechange = function() {
            var answerObj;
            
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                //kill modal window "waiting..."
                document.getElementById('glassy-cover').remove();
                answerObj = JSON.parse(xhttp.responseText);
                if (answerObj.type === "success") {
                    imgAmount.value = answerObj.arraySize;
                    alert ("Копирование изображений прошло успешно!");
        // submiting the form            
                    document.forms[0].submit();
                } else {
                    alert ("Ошибка! " + answerObj.message);
                }
            }
        };
        xhttp.open("POST", "handler--photos.php", true); /* [1] */
        xhttp.setRequestHeader("Content-type", 
        "application/x-www-form-urlencoded");
        xhttp.send(parameters);
    }
}


function waitingPopup () {
/*
 * Function to show/hide popup "waiting..."
 * 
*/

    var cover = document.createElement("div"),
        popup  = document.createElement("div");
        
        
        cover.setAttribute("class", "glassy-cover");
        cover.setAttribute("id", "glassy-cover");
        popup.setAttribute("class", "waiting-popup");
        popup.innerHTML = "Подождите, идёт обработка данных " +
                          "<span id='ticker'></span>";
                          
        cover.appendChild(popup);
        document.getElementsByTagName("body")[0].appendChild(cover);
}
