<?php
include "tools__new-tour--code.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/vnd.microsoft.icon" href="../img/favicon_m.ico">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../css/tools.css">
    <link rel="stylesheet" type="text/css" href="../css/tools__new-tour.css">
    <script src="../scripts/tools.js"></script>
    <script src="../scripts/tools__new-tour.js"></script>
    <style></style>
    <script>
    </script>
</head>
<body onload="resultMessage ('<?php echo $message_add; ?>');">





<!--          
      
#SECTION-HEADER 

-->  

<header>
    <nav>
        <a href="http://http://tolomuco.xyz/examples/tr-ag/">Travel Agency Home</a> |
        <a href="tools__tours.php">Tours</a> |
        <a href="#">Database</a>
    </nav>
</header>
<hr>





<!--          
      
#SECTION-START 

-->  

<form action="manager__new-tour_compatible.php" method="post">





<!--          
      
#SECTION-TOUR-INFO 

--> 

<fieldset class="wrapper">
    <legend>
        <a href="#tour" name="tour"><b>Информация о туре:</b></a>
    </legend>
    
    <input type="hidden" name="photos" value="">
    <input type="hidden" name="date-of-adding" 
    value="<?php echo date("d.m.Y"); ?>">

    
    <fieldset class="hint-box--tour">
        <legend>Подсказка:</legend>
        
        <div id="show-tour-hint" class="hint">
            Если снять галочку "показывать тур", то когда тур будет
            создан, он не будет показываться на главной странице сайта.
            Для того, что-бы тур начал показываться, нужно перейти 
            в справочник туров и установить галочку "показывать тур".
        </div>
        
        <div id="calendar-hint" class="hint">
            Установить дату можно либо выбрав её в календаре (кнопка
            "дд.мм.гггг"), либо внеся её непосредственно в поле 
            "Дата отправления:".<br>
            Изменить установленную в календаре дату можно непосредственно
            в поле "Дата отправления:". Допускаются символы: цифры, 
            русские буквы, латинские буквы, пробел, "." "," "/" "-".
        </div>
        
        <div id="choice-hint" class="hint">
            Установить "тип комнаты"/"питание"/"оператор" можно либо 
            выбрав нужное значение в дропбоксе (падающее меню), либо,
            если значение нестандартное, набрав его в текстовом поле.
            <br>Если и в текстовом поле и в дропбоксе установлено
            какое-то значение, то при создании тура будет использовано
            значение из тестового поля (правое поле). Допускаются символы: 
            цифры, русские буквы, латинские буквы, пробел, "." "," "/" "-".
        </div>
        
        <div id="tagline-hint" class="hint">
            Слоган, это надпись в "шапке" презентации тура (на главной
            странице), расположенная после страны и названия города.<br>
            Например: Турция! Анталья! <i>ВИП отель!</i>
            Максимальная длина текста 64 символа.
            Допускаются символы: цифры, русские буквы, латинские буквы, 
            пробел, "." "," "/" "-".
        </div>
        
        <div id="visa-hint" class="hint">
            При создании тура будет использовано значение самого нижнего 
            из заполненных полей. Максимальная длина текста 64 символа.
            Допускаются символы: цифры, русские буквы, латинские буквы, 
            пробел, "." "," "/" "-" "!".
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
    

    <div class="l-col1">
            ID тура<span class="required-field">*</span>:
        </div>
        <input class="l-col2" type="text" name="id" 
        value="<?php echo date("YmdHi"); ?>" required
        pattern="^[0-9]+$" maxlength="12"> 
        
        <label class="btn  btn-warning  l-col3">
            Показывать тур 
            <input type="checkbox" name="show" value="1" checked>
        </label>
        <img class="hint-img" src="../img/hint.png" height="15px" 
        onclick="togleHint('show-tour-hint');">
        
        <button class="btn-primary r-col1" type="button" 
        onclick="readHandbooks ();">
            Обновить справочники
        </button>
    </div>
    
    <div>
        <div class="l-col1">
            Страна<span class="required-field">*</span>:
        </div>
        <select class="l-col2" id="select-countries" name="country" 
        onchange="changeCitySelect(this)">
            <option value="empty" selected disabled>Загрузка...</option>
        </select>   
    </div>
    
    <div>
        <div class="l-col1">
            Город<span class="required-field">*</span>:
        </div>
        <select class="l-col2" id="select-cities" name="city">
            <option value="empty" selected disabled>Загрузка...</option>
        </select>   
    </div>
    
    <div>
        <div class="l-col1">
            Дата отправления<span class="required-field">*</span>:
        </div>
        
        <input class="l-col2" id="date-of-leaving" type="text" 
        name="date-of-leaving" value="<?php echo date("d.m.Y"); ?>"
        required pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/\-]+$" 
        maxlength="32"> 
        
        <input  class="btn-primary  l-col3  not-firefox" type="date" 
        name="calendar" onchange="setDate (this)">
        
        <img class="hint-img not-firefox" src="../img/hint.png" 
        height="15px" onclick="togleHint('calendar-hint');">
    </div>

    <div>
        <div class="l-col1">
            Трансфер из<span class="required-field">*</span>:
        </div>
        
        <input class="l-col2" type="text" name="place-of-leaving"
        required pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/\-]+$" 
        maxlength="32" value="Киева"> 
    </div>
    
    <div>
        <div class="l-col1">
            Продолжительность<span class="required-field">*</span>:
        </div>
        <input class="l-col2" type="text" name="duration" required 
        pattern="^[0-9]+$" maxlength="4">
        <i>дней</i> 
    </div>

    <div>
        <div class="l-col1">
            Цена<span class="required-field">*</span>:
        </div>
        <input class="l-col2" type="text" name="price" required
        pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/\-]+$" maxlength="24">
        <select id="select-currency" name="currency">
            <option value="empty" selected disabled>Загрузка...</option>
        </select>
    </div>
    
    <div>
        <div class="l-col1">
            Название отеля<span class="required-field">*</span>:
        </div>
        <input class="l-col2" type="text" name="hotel" required
        pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/\*\'\(\)\+&-]+$" 
        maxlength="64" oninput="hotelsToChoose(this)"> 
    </div>
    
    <div>
        <div class="l-col1">
            Класс отеля<span class="required-field">*</span>:
        </div>
        <input class="l-col2" type="text" name="hotel-level" required
        pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/\*\'\(\)\+&-]+$" 
        maxlength="64"> 
        &nbsp;&nbsp;&nbsp;id
        <input class="l-col2" type="text" name="hotel-id" value=""
        required>
        <button type="button" class="btn-primary new-hot-btn" 
        onclick="(chooseHotel('', '', ''))();">Новый отель</button>
    </div>

    <div>
        <div class="l-col1">
            Тип комнаты<span class="required-field">*</span>:
        </div>
        <select class="l-col2" id="select-room-type" 
        name="room-type">
            <option value="empty" selected disabled>Загрузка...</option>
        </select>   
        или 
        <input class="l-col2" type="text" name="add-room-type" 
        placeholder="напишите" pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/-]+$" 
        maxlength="32">
        <img class="hint-img" src="../img/hint.png" height="15px" 
        onclick="togleHint('choice-hint');">
    </div>
    
    <div>
        <div class="l-col1">
            Питание<span class="required-field">*</span>:
        </div>
        <select class="l-col2" id="select-accomodation" 
        name="accomodation">
            <option value="empty" selected disabled>Загрузка...</option>
        </select>   
        или 
        <input class="l-col2" type="text" name="add-accomodation" 
        placeholder="напишите" pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/-]+$" 
        maxlength="32"> 
        <img class="hint-img" src="../img/hint.png" height="15px" 
        onclick="togleHint('choice-hint');">
    </div>
    
    <div>
        <div class="l-col1">
            Тип тура<span class="required-field">*</span>:
        </div>
        <select class="l-col2" id="select-tour-type" name="tour-type">
            <option value="empty" selected disabled>Загрузка...</option>
        </select>  
    </div>
    
    <div>
        <div class="l-col1">
            Оператор<span class="required-field">*</span>:
        </div>
        <select class="l-col2" id="select-touroperator" 
        name="tour-operator" required>
            <option value="empty" selected disabled>Загрузка...</option>
        </select>   
        или 
        <input class="l-col2" type="text" name="add-tour-operator" 
        placeholder="напишите" pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/-]+$" 
        maxlength="32"> 
        <img class="hint-img" src="../img/hint.png" height="15px" 
        onclick="togleHint('choice-hint');">
    </div>
    
    <div>
        <div class="l-col1">
            Слоган:
        </div>
        <input class="l-col2" type="text" name="tagline"
        pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/\'-!]+$" maxlength="40"><i>!</i>
        <img class="hint-img" src="../img/hint.png" height="15px" 
        onclick="togleHint('tagline-hint');">
    </div>
    
    <fieldset>
        <legend>Виза (выберите один из вариантов):</legend>
        
        <ul>
            <li>
                <i>Отдельно оплачивается виза. Стоимость 
                <input type="text" name="visa-v1"
                pattern="^[0-9\.]+$"  maxlength="6"> 
                <select id="select-visa-currency" name="visa-currency">
                    <option value="empty" selected disabled>Загрузка...</option>
                </select>
                по прилёту!</i>
                <img class="hint-img" src="../img/hint.png" height="15px" 
                onclick="togleHint('visa-hint');">
            </li>
           
            <li>или</li>
            
            <li>
                <i>Отдельно оплачивается виза. 
                <input type="text" name="visa-v2"
                pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/-!]+$" maxlength="34">!</i>
                <img class="hint-img" src="../img/hint.png" height="15px" 
                onclick="togleHint('visa-hint');">
            </li>
            
            <li>или</li>
            
            <li>
                <input type="text" name="visa-v3" 
                pattern="^[0-9А-Яа-яЁёA-Za-z\s\,\.\/-!]+$" maxlength="64"><i>!</i>
                <img class="hint-img" src="../img/hint.png" height="15px" 
                onclick="togleHint('visa-hint');">
            </li> 
        </ul>
    </fieldset>
    
    <fieldset class="hotels-anchors">
        <legend>Найденные отели:</legend>
        
        <div id="hotels-anchors"></div>
    </fieldset>
<!--    
    <fieldset class="promo-text">
        <legend>Автоматическое краткое описание тура:</legend>
    </fieldset>
-->    
    <div class="change-promo-text">
        <div>Изменить краткое описание тура (не обязательно):</div>
        <textarea name="promo-text" maxlength="130"></textarea>
        <img class="hint-img" src="../img/hint.png" height="15px" 
        onclick="togleHint('promo-hint');">
    </div>

</fieldset>
<hr>





<!--          
      
#SECTION-HOTEL-INFO 

-->  

<fieldset class="wrapper">
    <legend>
        <a href="#hotel" name="hotel"><b>Информация об отеле:</b></a>
    </legend>
    
    <fieldset>
        <legend>Фото:</legend>
        
        <div class="galery">
            <div id="galery-photo"></div>
        </div>
        
        <div>
            <div class="l-col1">
                главное фото<span class="required-field">*</span>:
            </div><!-- kill witespace
         --><input class="l-col2  photo-address" type="text" 
            name="photo[]"  placeholder="http://..." required
            oninput="loadPhoto();"> 
        </div>
        <ul id="photo">
        </ul>
            
        <button class="btn-primary" type="button" 
        onclick="addPhoto();">
        Добавить фото</button>
    </fieldset>
    
    
    <fieldset class="hotel-info">
        <legend>Описание отеля:</legend>
       
        <div>
            <div class="l-col1">Сайт отеля:</div>
            <input class="site" type="text" 
            name="hotel-site" placeholder="http://..."> 
        </div>
        
        <div class="note">
            <div class="decor">
                <div onclick="insertTag('<b>', '</b>');notePreview();">
                    <b>B</b>
                </div>
                <div onclick="insertTag('<i>', '</i>');notePreview();">
                    <i>I</i>
                </div>
                <div onclick="insertTag('<u>', '</u>');notePreview();">
                    <u>U</u>
                </div>
                <div onclick="insertTag('<s>', '</s>');notePreview();">
                    <s>S</s>
                </div>
                <div onclick="insertTag('<ul>','</ul>');notePreview();">
                    список (ul)
                </div>
                <div onclick="insertTag('<li>','</li>');notePreview();">
                    элемент списка
                </div>
            </div>
            
            <textarea name="hotel-description" 
            oninput="notePreview();"></textarea>
            
            <div id="description-result"> </div>
        </div>

            
        <fieldset class="distances">
            <legend>Расстояния:</legend>
            
            <div>
                <div class="dist-col1">до аэропорта</div><!-- kill witespace
             --><input class="location" type="text" 
                name="location-aeroport">: 
                <input class="distance" type="text" 
                name="distance-aeroport"><!-- kill witespace
             --><select class="units" name="units-aeroport">
                    <option value="км">км</option>
                    <option value="м">м</option>
                    <option value="ч.">ч.</option>
                    <option value="мин.">мин.</option>
                </select>
            </div>
            <ul id="distances">
            </ul>
            
            <button class="btn-primary" type="button" 
            onclick="addPoint();">Добавить пункт</button>
        </fieldset>
        
        
        <fieldset class="building">
            <legend>Реконструкции:</legend>
            
            <div>
                <div class="l-col1">Год постройки:</div>
                <input class="l-col2" type="text" name="hotel-build">
            </div>
            
            <div>
                <div class="l-col1">Перестраивался в</div>
                <input class="l-col2" type="text" 
                name="hotel-rebuild"> году
            </div>
        </fieldset>
    </fieldset>
    
    
    <hr class="block-delimiter">
    
    
    <fieldset>
        <legend>В номерах:</legend>
        
        <div class="checkboxes">
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Центральное кондиционирование">
                        Центральное кондиционирование
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Кондиционер">
                        Кондиционер
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Вентилятор">
                        Вентилятор
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Отопление">
                        Отопление
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Телефон">
                        Телефон
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Спутниковое телевидение">
                        Спутниковое телевидение
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Кабельное телевидение">
                        Кабельное телевидение
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="LCD-телевизор">
                        LCD-телевизор
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Телевизор">
                        Телевизор
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="DVD-плеер">
                        DVD-плеер
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Скоростной интернет">
                        Скоростной интернет
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Интернет">
                        Интернет
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Wi-Fi">
                        Wi-Fi
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Проводной доступ в Интернет">
                        Проводной доступ в Интернет
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Мини-бар">
                        Мини-бар
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Полный мини-бар">
                        Полный мини-бар
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Бутылка бесплатной воды при заезде">
                        Бутылка бесплатной воды при заезде
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Мини-холодильник">
                        Мини-холодильник
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Холодильник">
                        Холодильник
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Электрический чайник и набор чая/кофе">
                        Электрический чайник и набор чая/кофе
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Набор для чая/кофе">
                        Набор для чая/кофе
                    </label>
                </li>
            </ul>
            
            <ul>                    
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Ванная">
                        Ванная
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Душ">
                        Душ
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Фен">
                        Фен
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Туалетные принадлежности">
                        Туалетные принадлежности
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Туалетно-косметические принадлежности">
                        Туалетно-косметические принадлежности
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Полотенца">
                        Полотенца
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Халаты, тапочки">
                        Халаты, тапочки
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Белоснежное бельё">
                        Белоснежное бельё
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Постельное белье премиум-класса">
                        Постельное белье премиум-класса
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Современная мебель">
                        Современная мебель
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Деревянная мебель">
                        Деревянная мебель
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Рабочий стол">
                        Рабочий стол
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Гостиный уголок">
                        Гостиный уголок
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Сейф">
                        Сейф
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Мини-сейф">
                        Мини-сейф
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Будильник">
                        Будильник
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Утюг и гладильная доска">
                        Утюг и гладильная доска
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Сушильный шкаф">
                        Сушильный шкаф
                    </label>
                </li>
            </ul>
                
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Ковровое покрытие/ламинат">
                        Ковровое покрытие/ламинат
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Ковровое покрытие">
                        Ковровое покрытие
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="На полу ламинат">
                        На полу ламинат
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Пол - паркет">
                        Пол - паркет
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Керамическое покрытие">
                        Керамическое покрытие
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Кафельный пол">
                        Кафельный пол
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Балкон">
                        Балкон
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Терасса">
                        Терасса
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Панорамные окна">
                        Панорамные окна
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Балкон, терраса или окно">
                        Балкон, терраса или окно
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Доставка еды и напитков в номер">
                        Доставка еды и напитков в номер
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Ежедневная уборка номера">
                        Ежедневная уборка номера
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Уборка номера">
                        Уборка номера
                    </label>
                </li>
               <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Обслуживание в номерах 10:30-23:00">
                        Обслуживание в номерах 10:30-23:00
                    </label>
                </li>
               <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Обслуживание номеров">
                        Обслуживание номеров
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Room service">
                        Room service
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Курение во всех номерах запрещено">
                        Курение во всех номерах запрещено
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Карточная система замков">
                        Карточная система замков
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="equipment[]"
                        value="Пожарная сигнализация">
                        Пожарная сигнализация
                    </label>
                </li>
            </ul>
        </div>
        
        <ul id="equipment">
        </ul>
        
        <button class="btn-primary " type="button" 
        onclick="addListItem('equipment', 'equipment');">
        Добавить пункт</button>
    </fieldset>

    
    <fieldset>
        <legend>Также доступны:</legend>
        
        <div class="checkboxes">
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="room-types[]"
                        value="Люкс для новобрачных">
                        Люкс для новобрачных
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="room-types[]"
                        value="Семейные номера">
                        Семейные номера
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="room-types[]"
                        value="Номера для некурящих">
                        Номера для некурящих
                    </label>
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="room-types[]"
                        value="Гипоаллергенный номер">
                        Гипоаллергенный номер
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="room-types[]"
                        value="Звукоизолированные номера">
                        Звукоизолированные номера
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="room-types[]"
                        value="Номера для людей и огрт. возм.">
                        Номера для гостей с огранич. физич. возможн.
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="room-types[]" 
                        value="Общий лаундж/гостиная с телевизором">
                        Общий лаундж/гостиная с телевизором
                    </label>
                </li>
            </ul>
        </div>

        <ul id="room-types">
        </ul>
        
        <button class="btn-primary" type="button" 
        onclick="addListItem('room-types', 'room-types');">
        Добавить пункт</button>
    </fieldset>
    
    
    <hr class="block-delimiter">

    
    <fieldset>
        <legend>Питание:</legend>
        
        <div class="checkboxes">
            <ul id="restaurants">
                <li>
                    Ресторанов - <input type="text" name="restaurants">
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="feeding-r[]"
                        value="Главный ресторан">
                        Главный ресторан
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="feeding-r[]"
                        value="Рестораны">
                        Рестораны
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="feeding-r[]"
                        value="Ресторан">
                        Ресторан
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="feeding-r[]"
                        value="Специальные диетические меню">
                        Специальные диетические меню
                    </label>
                </li>
            </ul>
            
            <ul id="bars">
                <li>
                    Баров - <input type="text" name="bars">
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="feeding-b[]"
                        value="Бар">
                        Бар
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="feeding-b[]"
                        value="Бары">
                        Бары
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="feeding-b[]"
                        value="Лобби-бар">
                        Лобби-бар
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="feeding-b[]"
                        value="Снек-бар">
                        Снек-бар
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="feeding-b[]"
                        value="Бар у бассейна">
                        Бар у бассейна
                    </label>
                </li>
            </ul>
        </div>
        
        <ul id="feeding">
        </ul>
        
        <button class="btn-primary" type="button" 
        onclick="addListItem('feeding', 'feeding');">
        Добавить пункт</button>
    </fieldset>
    
    
    <hr class="block-delimiter">

    
    <fieldset>
        <legend>Территория:</legend>
        
        <div class="checkboxes">
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]"
                        value="Сад">
                        Сад
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]"
                        value="Тропический сад">
                        Тропический сад
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]"
                        value="Зелёная зона">
                        Зелёная зона
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]"
                        value="Терасса">
                        Терасса
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]"
                        value="Терасса с шезлонгами">
                        Терасса с шезлонгами
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]"
                        value="Барбекю">
                        Барбекю
                    </label>
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]"
                        value="Частный пляж">
                        Частный пляж
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]"
                        value="Песчаный пляж">
                        Песчаный пляж
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]"
                        value="Пляж">
                        Пляж
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]"
                        value="Платформа">
                        Платформа
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]"
                        value="Понтон">
                        Понтон
                    </label>
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]" 
                        value="Пляжное оборудование (Шезлонги, Зонтики, Матрасы, Пляжные полотенца)">
                        Пляжное оборудование (Шезлонги, Зонтики, Матрасы, Пляжные полотенца)
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]" 
                        value="Зонтики и шезлонги можно взять напрокат 
                        бесплатно">
                        Зонтики и шезлонги можно взять напрокат 
                        бесплатно
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]" 
                        value="Автобус до пляжа">
                        Автобус до пляжа
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="territory[]" 
                        value="До пляжа ходит бесплатный трансфер">
                        До пляжа ходит бесплатный трансфер
                    </label>
                </li>
            </ul>
        </div>
        
        <ul id="territory">
        </ul>
        
        <button class="btn-primary" type="button" 
        onclick="addListItem('territory', 'territory');">
        Добавить пункт</button>
    </fieldset>


    <fieldset>
        <legend>Бассейн:</legend>
        
        <div class="checkboxes">
            <ul>
                <li>
                    <div class="l-col1">Открытых бассейнов</div>
                    <input class="l-col2" type="text" name="open-pools">
                </li>
                <li>
                    <div class="l-col1">Закрытых бассейнов</div>
                    <input class="l-col2" type="text" name="closed-pools">
                </li>
                <li>
                    <div class="l-col1">Детских бассейнов</div>
                    <input class="l-col2" type="text" name="kid-pools">
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="pool[]"
                        value="Бассейн">
                        Бассейн
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="pool[]"
                        value="Открытый бассейн">
                        Открытый бассейн
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="pool[]"
                        value="Открытый подогреваемый бассейн">
                        Открытый подогреваемый бассейн
                    </label>
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="pool[]"
                        value="Закрытый бассейн">
                        Закрытый бассейн
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="pool[]"
                        value="Водные горки">
                        Водные горки
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="pool[]"
                        value="Бассейн эксклюзивных номеров">
                        Бассейн эксклюзивных номеров
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="pool[]" 
                        value="Аквапарк">
                        Аквапарк
                    </label>
                </li>
            </ul>
        </div>

        <ul id="pools">
        </ul>
        
        <button class="btn-primary" type="button" 
        onclick="addListItem('pools', 'pool');">
        Добавить пункт</button>
    </fieldset>
    
    
    <hr class="block-delimiter">

    
    <fieldset>
        <legend>Для детей:</legend>
        
        <div class="checkboxes">
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="children[]" 
                        value="Детская анимация">
                        Детская анимация
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="children[]" 
                        value="Игровая комната">
                        Игровая комната
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="children[]"
                        value="Детские горки">
                        Детские горки
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="children[]" 
                        value="Детская игровая площадка">
                        Детская игровая площадка
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="children[]" 
                        value="Детский уголок">
                        Детский уголок
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="children[]" 
                        value="Детский мини клуб">
                        Детский мини клуб
                    </label>
                </li>
            </ul>

            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="children[]"
                        value="Детский бассейн">
                        Детский бассейн
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="children[]"
                        value="Детский бассейн с горками">
                        Детский бассейн с горками
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="children[]"
                        value="Детское отделение в бассейне для взрослых">
                        Детское отделение в бассейне для взрослых
                    </label>
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="children[]" 
                        value="Няня">
                        Няня
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="children[]" 
                        value="Услуги по уходу за детьми">
                        Услуги по уходу за детьми
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="children[]" 
                        value="Детские стулья в ресторане">
                        Детские стулья в ресторане
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="children[]" 
                        value="Детское меню в ресторане">
                        Детское меню в ресторане
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="children[]" 
                        value="Детские кроватки">
                        Детские кроватки
                    </label>
                </li>
            </ul>
        </div>
        
        <ul id="for-children">
        </ul>
        
        <button class="btn-primary" type="button" 
        onclick="addListItem('for-children', 'children');">
        Добавить пункт</button>
    </fieldset>


    <fieldset>
        <legend>Услуги отеля:</legend>

        <div class="checkboxes">
            <ul>
                <li>
                    <label>
                        Конференц-залов - 
                        <input type="text" name="conference-halls">
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Конференц-зал">
                        Конференц-зал
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Банкетный зал">
                        Банкетный зал
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Бизнес центр">
                        Бизнес центр
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Факс/Ксерокопирование">
                        Факс/Ксерокопирование
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="V.I.P. Услуги">
                        V.I.P. Услуги
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Обмен валюты">
                        Обмен валюты
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Банкомат на территории отеля">
                        Банкомат на территории отеля
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Интернет-кафе">
                        Интернет-кафе
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Интернет-уголок">
                        Интернет-уголок
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Wi-Fi">
                        Wi-Fi
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Wi-Fi в общественных зонах">
                        Wi-Fi в общественных зонах
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Трансфер (за дополнительную плату)">
                        Трансфер (за дополнительную плату)
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Трансфер от/до аэропорта">
                        Трансфер от/до аэропорта 
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Автостоянка">
                        Автостоянка
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Парковка">
                        Парковка
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Прокат автомобилей">
                        Прокат автомобилей
                    </label>
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Магазины на территории">
                        Магазины на территории
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Мини-маркет на территории">
                        Мини-маркет на территории
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Сувенирный магазин">
                        Сувенирный магазин
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Торговый автомат (напитки)">
                        Торговый автомат (напитки)
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Услуги по продаже билетов">
                        Услуги по продаже билетов
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Экскурсионное бюро">
                        Экскурсионное бюро
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Круглосуточная стойка регистрации">
                        Круглосуточная стойка регистрации
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Ускоренная регистрация заезда/отъезда">
                        Ускоренная регистрация заезда/отъезда
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Сейф">
                        Сейф
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Камера хранения">
                        Камера хранения
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Камера хранения багажа">
                        Камера хранения багажа
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Запирающиеся шкафчики">
                        Запирающиеся шкафчики
                    </label>
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Доктор">
                        Доктор
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Услуги консьержа">
                        Услуги консьержа
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Доставка прессы">
                        Доставка прессы
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Доставка продуктов">
                        Доставка продуктов
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Доставка еды и напитков в номер">
                        Доставка еды и напитков в номер
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Упакованные ланчи">
                        Упакованные ланчи
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Завтрак в номер">
                        Завтрак в номер
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Услуги по глажению одежды">
                        Услуги по глажению одежды
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Прачечная">
                        Прачечная
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Химчистка">
                        Химчистка
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Пресс для брюк">
                        Пресс для брюк
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Чистка обуви">
                        Чистка обуви
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Лифт">
                        Лифт
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Лифты">
                        Лифты
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Места для курения">
                        Места для курения
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="services[]" 
                        value="Удобства для гостей с огранич. физич. возможн.">
                        Удобства для гостей с огранич. физич. возможн.
                    </label>
                </li>
            </ul>
        </div>

        <ul id="services">
        </ul>
        
        <button class="btn-primary" type="button" 
        onclick="addListItem('services', 'services');">
        Добавить пункт</button>
    </fieldset>
    
    
    <hr class="block-delimiter">

    
    <fieldset>
        <legend>Красота и здоровье:</legend>
        
        <div class="checkboxes">
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="Гидромассажная ванна">
                        Гидромассажная ванна
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="Джакузи">
                        Джакузи
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="Сауна">
                        Сауна
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="Парная">
                        Парная
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="Турецкая баня">
                        Турецкая баня
                    </label>
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="Массаж">
                        Массаж
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="Массажный центр">
                        Массажный центр
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="Оздоровительный центр">
                        Оздоровительный центр
                    </label>
                </li>
                 <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="SPA-центр">
                        SPA-центр
                    </label>
                </li>
            </ul>
            
            <ul>
               <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="Парикмахерская">
                        Парикмахерская
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="Салон красоты">
                        Салон красоты
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="Парикмахерская/Салон красоты">
                        Парикмахерская/Салон красоты
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="health[]" 
                        value="Солярий">
                        Солярий
                    </label>
                </li>
            </ul>
        </div>

        <ul id="health">
        </ul>
        
        <button class="btn-primary" type="button" 
        onclick="addListItem('health', 'health');">
        Добавить пункт</button>
    </fieldset>
    
    
    <fieldset>
        <legend>Развлечения:</legend>
        
        <div class="checkboxes">
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="entertainment[]"
                        value="Анимация">
                        Анимация
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="entertainment[]"
                        value="Анимационный персонал">
                        Анимационный персонал
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="entertainment[]" 
                        value="Караоке">
                        Караоке
                    </label>
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="entertainment[]" 
                        value="Дневные развлекательные программы">
                        Дневные развлекательные программы
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="entertainment[]"
                        value="Вечерняя программа">
                        Вечерняя программа
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="entertainment[]"
                        value="Ночной клуб/Диджей">
                        Ночной клуб/Диджей
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="entertainment[]"
                        value="Дискотека">
                        Дискотека
                    </label>
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="entertainment[]"
                        value="Библиотека">
                        Библиотека
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="entertainment[]"
                        value="Кинотеатр">
                        Кинотеатр
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="entertainment[]"
                        value="Амфитеатр">
                        Амфитеатр
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="entertainment[]"
                        value="Пикник на завтрак при раннем отъезде">
                        Пикник на завтрак при раннем отъезде
                    </label>
                </li>
            </ul>
        </div>
        
        <ul id="entertainment">
        </ul>
        
        <button class="btn-primary" type="button" 
        onclick="addListItem('entertainment', 'entertainment');">
        Добавить пункт</button>
    </fieldset>
    
    
    <fieldset>
        <legend>Спорт:</legend>
        
        <div class="checkboxes">
            <ul>
                <li>
                    <label>
                        Теннисных кортов -
                        <input type="text" name="tennis">
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]" 
                        value="Фитнес-центр">
                        Фитнес-центр
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Тренажерный зал">
                        Тренажерный зал
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Верховая езда">
                        Верховая езда
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Велоспорт">
                        Велоспорт
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Прокат велосипедов">
                        Прокат велосипедов
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Пешеходные прогулки">
                        Пешеходные прогулки
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Поле для гольфа">
                        Поле для гольфа
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Мини-гольф">
                        Мини-гольф
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Мини-футбол">
                        Мини-футбол
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Баскетбольная площадка">
                        Баскетбольная площадка
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Сквош">
                        Сквош
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Теннисный корт">
                        Теннисный корт
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Корт для волейбола">
                        Корт для волейбола
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Волейбол">
                        Волейбол
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Боулинг">
                        Боулинг
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Бильярд">
                        Бильярд
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Настольный теннис">
                        Настольный теннис
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Дартс">
                        Дартс
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Спортинвенитарь">
                        Спортинвенитарь
                    </label>
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Водные виды спорта">
                        Водные виды спорта
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Оборудование для занятия водными видами спорта">
                        Оборудование для занятия водными видами спорта
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Школа подводного плавания">
                        Школа подводного плавания
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Дайвинг-центр">
                        Дайвинг-центр
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Прокат снаряжения для дайвинга">
                        Прокат снаряжения для дайвинга
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Дайвинг">
                        Дайвинг
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Ныряние с маской и трубкой">
                        Ныряние с маской и трубкой
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Водный мотоцикл">
                        Водный мотоцикл
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Каноэ">
                        Каноэ
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Катамаран">
                        Катамаран
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Водный велосипед">
                        Водный велосипед
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Серфинг">
                        Серфинг
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Парусные лодки">
                        Парусные лодки
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Виндсерфинг">
                        Виндсерфинг
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Парасейлинг">
                        Парасейлинг
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Бананасейлинг">
                        Бананасейлинг
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Водные лыжи">
                        Водные лыжи
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Рыбная ловля">
                        Рыбная ловля
                    </label>
                </li>
            </ul>
            
            <ul>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Бесплатный трансфер до горных спусков">
                        Бесплатный трансфер до горных спусков
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Бесплатный трансфер на лыжные спуски">
                        Бесплатный трансфер на лыжные спуски
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Бесплатное хранилище для лыж">
                        Бесплатное хранилище для лыж
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Камера хранения горнолыжного/сноуборд 
                        снаряжения">
                        Камера хранения горнолыжного/сноуборд снаряжения
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Катание на лыжах">
                        Катание на лыжах
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Лыжная школа">
                        Лыжная школа
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Лыжный инструктор">
                        Лыжный инструктор
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Прокат лыжного снаряжения">
                        Прокат лыжного снаряжения
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Продажа горнолыжного абонемента">
                        Продажа горнолыжного абонемента
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Доступ на лыжах к отелю">
                        Доступ на лыжах к отелю
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Катание на снегоходах">
                        Катание на снегоходах
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Экстремальное вождение на льду">
                        Экстремальное вождение на льду
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Катание на собачьих упряжках">
                        Катание на собачьих упряжках
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Скибайк">
                        Скибайк
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Подлёдное погружение">
                        Подлёдное погружение
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox" name="sport[]"
                        value="Альпинизм">
                        Альпинизм
                    </label>
                </li>
            </ul>
        </div>
        
        <ul id="sport">
        </ul>
        
        <button class="btn-primary" type="button" 
        onclick="addListItem('sport', 'sport');">
        Добавить пункт</button>
    </fieldset>
</fieldset>





<!--          
      
#SECTION-END-OF-FILE

-->  

        <button class="btn-success" type="button" onclick="submitNewTour();"
        >Создать тур</button>  
    </form>        
</body>
</html>
