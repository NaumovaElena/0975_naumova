// ==UserScript==
// @name         Google Bot !
// @namespace    http://tampermonkey.net/
// @version      0.2
// @description  Bot for Google
// @author       NaumovaElena
// @match       https://www.google.com/*
// @match       https://www.napli.ru/*
// @icon         data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
// @grant        none
// ==/UserScript==

let links = document.links;
let btnK = document.getElementsByName("btnK")[0];
let keywords = ["10 самых популярных шрифтов от Google", "Отключение редакций и ревизий в WordPress", "Вывод произвольных типов записей и полей в WordPress", "Установка и настройка Git"];
let keyword = keywords[getRandom(0, keywords.length)];
let googleInput = document.getElementsByName("q")[0];


if (btnK !== undefined) {
    let i = 0;
    let timerId = setInterval (() => {
        googleInput.value +=keyword[i];
        i++;
        if(i == keyword.length) {
            clearInterval(timerId);
            btnK.click();
        }
    }, 100);
    /*document.getElementsByName("q")[0].value = "10 самых популярных шрифтов от Google";*/
    //googleInput.value = keyword;

} else if (location.hostname == "napli.ru") {
    //console.log("Мы на целевом сайте");
    setTimeout(() => {
    let index = getRandom(0, links.length);
    if (getRandom(0, 101) > 70) {
    location.href = "https://www.google.com/";
    }
   else if (links[index].href.indexOf("napli.ru") !== -1) links[index].click();
    }, getRandom(3000, 5000));
} else {
    //в этой ветке мы, когда не на главной странице, а на поисковой выдаче ищем сайт
    //ставим флаг nextGooglePage
    let nextGooglePage = true;
    for (let i = 0; i < links.length; i++) {
        if (links[i].href.indexOf("napli.ru") !== -1) {
            let link = links[i];
            //если нашли нужную ссылку, то флаг переключаем, т.к. на след.страницу нам не надо
            nextGooglePage = false;
            console.log("Нашел строку " + links[i]);
            setTimeout(() => {
                link.click();
            }, getRandom(2000, 3000));

            break;
        }
    }
    //если дошел до 3 страницы и не нашел ссылку целевого сайта (целевой сайт - на 4 стр), то возвращается на главную с новым запросом
    if (document.querySelector(".YyVfkd").innerText =="3") {
        nextGooglePage = false;
        location.href = "https://www.google.com/";
    }
    // если нужную ссылкуна первой странице выдачи не нашли
    if (nextGooglePage = true) {
        setTimeout(() => {
            pnnext.click();
        }, getRandom(2000, 4000));
    }
}

function getRandom(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
}
