<?php
function getPartsFromfullName($fullName) {
    $arr_keys = ['surname', 'name', 'patronymic'];
    $namePats = explode(' ', $fullName);
    return array_combine($arr_keys, $namePats);
}

function getfullNameFromPart($surname, $name, $patronymic) {
    $fullName = $surname . ' ' . $name . ' ' . $patronymic;
    return $fullName;
}

function getShortName($fullName) {
    $nameParts = getPartsFromfullName($fullName);
    return $nameParts['name'] . ' ' . mb_strtoupper(mb_substr($nameParts ['surname'], 0, 1)) . '.';
}


function getGenderFromName($fullName) {
    $gender = 0;
    $nameParts = getPartsFromfullName($fullName);

    if (mb_substr($nameParts['surname'], -2, 2) === 'ва') {
        --$gender;
    }

    if (mb_substr($nameParts['surname'], -1, 1) === 'в') {
        ++$gender;
    }

    if (mb_substr($nameParts['name'], -1, 1) === 'а') {
        --$gender;
    }

    if (mb_substr($nameParts['name'], -1, 1) === 'й' || (mb_substr($nameParts['surname'], -1, 1) === 'н')) {
        ++$gender;
    }

    if (mb_substr($nameParts['surname'], -3, 3) === 'вна') {
        --$gender;
    }

    if (mb_substr($nameParts['surname'], -2, 2) === 'ич') {
        ++$gender;
    }

    return $gender <=> 0; // 1 - male, -1 female, 0 - not recognized
}

function getGenderDescription($persons_array) {
    $personsCount = count($persons_array);

    $maleCount = count(array_filter($persons_array, function($person) {
       return getGenderFromName($person['fullName']) == 1;
    }));

    $femaleCount = count(array_filter($persons_array, function($person) {
        return getGenderFromName($person['fullName']) == -1;
    }));

    $notRecognizedCount = count(array_filter($persons_array, function($person) {
        return getGenderFromName($person['fullName']) == 0;
    }));
    $maleCount = round($maleCount / $personsCount *100, 1);
    $femaleCount = round($femaleCount / $personsCount *100, 1);
    $notRecognizedCount = round($notRecognizedCount / $personsCount *100, 1);
    $information = <<< INFO
    Гендерный состав аудитории:<br>
    ---------------------------<br>
    Мужчины &minus; $maleCount%<br>
    Женщины &minus; $femaleCount%<br>
    Не удалось определить &minus; $notRecognizedCount%<br>
INFO;
    return $information;
}

function getPerfectPartner($surname, $name, $patronymic, $persons_array) {
    $surname = mb_convert_case($surname, MB_CASE_TITLE, "UTF-8");
    $name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
    $patronymic = mb_convert_case($patronymic, MB_CASE_TITLE, "UTF-8");
    $enteredFullName = getfullNameFromPart($surname, $name, $patronymic);
    $gender1 =  getGenderFromName($enteredFullName);
    do {
        $randomNumber = mt_rand(0, count($persons_array) - 1);
        $selectedFullName = $persons_array[$randomNumber]['fullName'];
        $gender2 = getGenderFromName($selectedFullName);
        $check = abs($gender1 - $gender2);
    } while ($check != 2);
    $idealFor = round(mt_rand(5000, 10000)/100, 2);
    return getShortName($enteredFullName) . ' + ' . mb_convert_case(getShortName($selectedFullName), MB_CASE_TITLE, "UTF-8") . " = <br>&#9825; Идеально на $idealFor% &#9825;";
}

function getPersonWhoseGenderIsRecognized($persons_array) {
    do {
        $randomNumber = mt_rand(0, count($persons_array) - 1);
        $person = $persons_array[$randomNumber];
        $gender = abs(getGenderFromName($person['fullName']));
    } while ($gender !== 1);
    return $person;
}