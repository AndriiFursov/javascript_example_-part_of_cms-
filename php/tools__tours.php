<?php
include "tools__tours--code.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/vnd.microsoft.icon" href="../img/favicon_m.ico">
    <link rel="stylesheet" type="text/css" href="../css/manager.css">
    <link rel="stylesheet" type="text/css" href="../css/manager__tours.css">
    <script src="../scripts/manager.js"></script>
    <script src="../scripts/manager__tours.js"></script>
</head>
<body>





    <header>
        <nav>
            <a href="http://travelingua.com.ua/">travelingua.com.ua</a> |
            <a href="manager__new-tour_compatible.php">Добавить новый тур</a> |
<!--            <a href="manager__hotels.php">Справочник отелей</a> |-->
            <a href="manager__handbooks.php">База данных</a>
        </nav>
    </header>
    <hr>





    <form action="manager__tours.php" method="post" 
    onsubmit="return confirm('Вы действительно хотите внести изменения в таблицу?')">
        <fieldset class="wrapper">
            <legend>
                <a href="#top" name="top">
                    <b>Подробная информация о туре:</b>
                </a>
            </legend>

            <input id="changed-tour" type="hidden" name="changed-tour" value="">

            <p>
<?php
echo $message_change_tour;
echo $message_change_file;
?>
            </p>
            
            <button id="tourinfo-btn" class="btn-primary top-in-block" type="button" 
            onclick="toggleBlockVisibilityBtn('tourinfo-btn', 'tourinfo-block');">
                Развернуть
            </button>
            
            
            <div id="tourinfo-block">
                <fieldset class="hint-box--selectedTour">
                    <legend>Подсказка:</legend>
                    
                    <div id="show-tour-hint" class="hint">
                        Если снять галочку "показывать тур", то тур не будет 
                        показываться на главной странице сайта.
                    </div>
                    
                    <div id="calendar-hint" class="hint">
                        Установить дату можно либо выбрав её в календаре (кнопка
                        "дд.мм.гггг"), либо внеся её непосредственно в поле 
                        "Дата отправления:".<br>
                        Изменить установленную в календаре дату можно непосредственно
                        в поле "Дата отправления:".
                    </div>
<!--                    
                    <div id="price-hint" class="hint">
                        Для изменения <b>валюты</b>, в которой указана цена тура, 
                        необходимо также заполнить поле со стоимостью тура 
                        (обязательно!).<br>
                        Если стоимость тура не меняется, а изменить нужно только 
                        валюту, просто введите ту же сумму, которая указана в поле 
                        "Цена:".
                    </div>
-->                    
                    <div id="choice-hint" class="hint">
                        Установить "тип комнаты"/"питание"/"оператор" можно либо 
                        выбрав нужное значение в дропбоксе (падающее меню), либо,
                        если значение нестандартное, набрав его в текстовом поле.
                        <br>Если и в текстовом поле и в дропбоксе установлено
                        какое-то значение, то при создании тура будет использовано
                        значение из тестового поля (правое поле).
                    </div>
                    
                    <div id="tagline-hint" class="hint">
                        Слоган, это надпись в "шапке" презентации тура (на главной
                        странице), расположенная после страны и названия города.<br>
                        Например: Турция! Анталья! <i>ВИП отель!</i>
                        Максимальная длина текста 64 символа.
                    </div>
                    
                    <div id="promo-hint" class="hint">
                        Это поле содержит краткую информацию о туре, которая будет
                        показана в презентации тура на главной странице (под 
                        фотографией) и в шапке подробного описания тура.
                        Поле имеет смысл заполнять только для нестандартных туров,
                        для стандартных туров краткое описание собирается 
                        автоматически. Максимальная длина текста 130 символов.
                    </div>
                </fieldset>


                <div>
                    <div class="l-col1">Ссылка на тур:</div>
                    <a id="tour-link" href="#">
                        тур не выбран
                    </a>
                </div>
                
                <div>
                    <button class="btn-primary r-col1" type="button" 
                    onclick="readHandbooks ();">
                        Обновить справочники
                    </button>
                    
                    <div class="l-col1">ID тура:</div>
                    <input id="tour-id" class="l-col2" type="text" value="" disabled> 
                    
                    <label class="btn  btn-warning  l-col3">
                        Показывать тур <input id="tour-show" type="checkbox" 
                        name="show" value="1">
                    </label>
                    <img class="hint-img" src="../img/hint.png" height="15px" 
                    onclick="togleHint('show-tour-hint');">
                    
                    <br>
                    
                    <div class="l-col1">изменить:</div>
                    <input class="l-col2" type="text" name="id" pattern="^[0-9]+$" 
                    maxlength="12"> 
                </div>
                
                
                <div>
                    <div class="l-col1">Город:</div>
                    <input id="tour-city" class="l-col2" type="text" disabled> 
                    
                    <br>
                    
                    <div class="l-col1">Выберите страну:</div>
                    <select class="l-col2" id="select-countries" name="country" 
                    onchange="changeCitySelect(this)">
                        <option value="empty" selected disabled>Загрузка...</option>
                    </select><br>
                    <div class="l-col1">изменить:</div>
                    <select class="l-col2" id="select-cities" name="city">
                        <option value="empty" selected disabled>Загрузка...</option>
                    </select>   
                </div>
                
                
                <div>
                    <div class="l-col1">Дата отправления:</div>
                    <input id="tour-date-of-leaving" class="l-col2" type="text" disabled> 
                    
                    <br>
                    
                    <div class="l-col1">изменить:</div>
                    <input class="l-col2" id="date-of-leaving" type="text" 
                    name="date_of_leaving" pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/-]+$" 
                    maxlength="32"> 
                    <input  class="btn-primary  l-col3  notFirefox" type="date" 
                    name="calendar" onchange="setDate (this)">
                    <img class="hint-img notFirefox" src="../img/hint.png" height="15px" 
                    onclick="togleHint('calendar-hint');">
                </div>
                
                
                <div>
                    <div class="l-col1">Продолжительность:</div>
                    <input id="tour-duration" class="l-col2" type="text" disabled> 
                    <i>дней</i> 
                    
                    <br>
                    
                    <div class="l-col1">изменить:</div>
                    <input class="l-col2" type="text" name="duration" 
                    pattern="^[0-9]+$" maxlength="4">
                    <i>дней</i> 
                </div>
                
                
                <div>
                    <div class="l-col1">Цена:</div>
                    <input id="tour-price" class="l-col2" type="text" disabled> 
                    
                    <br>
                    
                    <div class="l-col1">изменить:</div>
                    <input class="l-col2" type="text" name="price" 
                    pattern="^[0-9]+$" maxlength="6"> 
                    <select id="select-currency" name="currency">
                        <option value="empty" selected disabled>Загрузка...</option>
                    </select>
                </div>
                
                
                <div>
                    <div class="l-col1">Отель:</div>
                    <input id="tour-hotel" class="l-col2" type="text" disabled> 
                    
                    <br>
                    
                    <div class="l-col1">изменить:</div>
                    <input class="l-col2" type="text" name="hotel"
                    pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/\*\'\(\)\+&-]+$" maxlength="64"> 
                </div>
                
                
                <div>
                    <div class="l-col1">Тип комнаты:</div>
                    <input id="tour-room-type" class="l-col2" type="text" disabled> 
                    
                    <br>
                    
                    <div class="l-col1">изменить:</div>
                    <select class="l-col2" id="select-room-type" name="room-type">
                        <option value="empty" selected disabled>Загрузка...</option>
                    </select>   
                    или 
                    <input class="l-col2" type="text" name="add-room-type" 
                    placeholder="напишите" pattern="^[0-9А-Яа-яЁёA-Za-z\s\.\/-]+$" 
                    maxlength="32">
                    <img class="hint-img" src="../img/hint.png" height="15px" 
                    onclick="togleHint('choice-hint');">
                </div>
                
                
                <div>
                    <div class="l-col1">Питание:</div>
                    <input id="tour-accomodation" class="l-col2" type="text" disabled> 
                    
                    <br>
                    
                    <div class="l-col1">изменить:</div>
                    <select class="l-col2" id="select-accomodation" name="accomodation">
                        <option value="empty" selected disabled>Загрузка...</option>
                    </select>   
                    или 
                    <input class="l-col2" type="text" name="add-accomodation" 
                    placeholder="напишите" pattern="^[0-9А-Яа-яЁёA-Za-z\s\.\/-]+$" 
                    maxlength="32"> 
                    <img class="hint-img" src="../img/hint.png" height="15px" 
                    onclick="togleHint('choice-hint');">
                </div>
                
                
                <div>
                    <div class="l-col1">Тип тура:</div>
                    <input id="tour-type" class="l-col2" type="text" disabled> 
                    
                    <br>
                    
                    <div class="l-col1">изменить:</div>
                    <select class="l-col2" id="select-tour-type" name="tour_type">
                        <option value="empty" selected disabled>Загрузка...</option>
                    </select>  
                </div>
                
                
                <div>
                    <div class="l-col1">Оператор:</div>
                    <input id="tour-operator" class="l-col2" type="text" disabled> 
                    
                    <br>
                    
                    <div class="l-col1">изменить:</div>
                    <select class="l-col2" id="select-touroperator" name="tour-operator">
                        <option value="empty" selected disabled>Загрузка...</option>
                    </select>   
                    или 
                    <input class="l-col2" type="text" name="add-tour-operator" 
                    placeholder="напишите" pattern="^[0-9А-Яа-яЁёA-Za-z\s\.\/-]+$" 
                    maxlength="32">
                    <img class="hint-img" src="../img/hint.png" height="15px" 
                    onclick="togleHint('choice-hint');">
                </div>
                
                
                <div>
                    <div class="l-col1">Слоган:</div>
                    <input id="tour-tagline" class="l-col2" type="text" disabled> 
                    
                    <br>
                    
                    <div class="l-col1">изменить:</div>
                    <input class="l-col2" type="text" name="tagline" 
                    pattern="^[0-9А-Яа-яЁёA-Za-z\s\.\/-!]+$" maxlength="40"> 
                    <img class="hint-img" src="../img/hint.png" height="15px" 
                    onclick="togleHint('tagline-hint');">
                </div>
                
                
                <fieldset>
                    <legend>Виза:</legend>
                    
                    <input id="tour-visa" type="text" disabled
                    pattern="^[0-9А-Яа-яЁёA-Za-z\s\.\/-]+$" maxlength="64"><i>!</i>
                    
                    <br>
                    
                    изменить: 
                    <input type="text" name="visa"><i>!</i>
                </fieldset>
            
                <div class="promo-text">
                    <div>Краткое описание тура:</div>
                    <textarea id="tour-promo-text" disabled></textarea>
                    
                    <br>
                    
                    <div>Изменить:</div>
                    <textarea name="promo-text" maxlength="130"></textarea>
                    <img class="hint-img" src="../img/hint.png" height="15px" 
                    onclick="togleHint('promo-hint');">
                </div>
            
                <div><button class="btn-success" type="submit">Применить</button></div>
            </div>
        </fieldset>
    </form>
    
    
    <hr>
    
        
    <form action="manager__tours.php" method="post" 
    onsubmit="return confirm('Вы действительно хотите внести изменения в таблицу?')">
        <fieldset id="countries__change" class="wrapper">
            <legend>
                <a href="#table" name="table">
                    <b>Список туров:</b>
                </a>
            </legend>


            <input type="hidden" name="flag" value="1">

            
            <p>
<?php
echo $message_change_tours;
?>
            </p>


            <button class="btn-success  change-tours" 
            type="submit">Применить</button>

            
            <div class="table-wrapper">
                <table class="tours-table" onclick="tableSort(event);">
                    <col class="col-number">
                    <col class="col-id">
                    <col class="col-country">
                    <col class="col-city">
                    <col class="col-price">
                    <col class="col-date">
                    <col class="col-type">
                    <col class="col-button">
                    <col class="col-show">
                    <col class="col-dell">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="sort" data-sort="ID" 
                            title="нажать, для сортировки">ID</th>
                            <th class="sort" data-sort="Country" 
                            title="нажать, для сортировки">Страна</th>
                            <th class="sort" data-sort="City" 
                            title="нажать, для сортировки">Город</th>
                            <th>Цена</th>
                            <th>Дата отправления</th>
                            <th class="sort" data-sort="Type"
                            title="нажать, для сортировки">Тип тура</th>
                            <th></th>
                            <th class="sort" data-sort="Show"
                            title="нажать, для сортировки">Показывать</th>
                            <th>Удалить</th>
                        </tr>
                    </thead>
                    <tbody id="tours-table"></tbody>
                </table>
            </div>
            <ul  class="pager" onselectstart="return false">
                <li onclick="tablePaging('l');">
                    <
                </li>
                <li class="pagination">
                    <span id="list-counter"></span>
                </li>
                <li onclick="tablePaging('r');">
                    >
                </li>
            </ul>
            
        </fieldset>
    </form>
</body>
</html>