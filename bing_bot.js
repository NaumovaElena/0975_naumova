// ==UserScript==
// @name         Bing Bot Userscript
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  Bot for Bing
// @author       NaumovaElena
// @match       https://www.bing.com/*
// @icon         data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
// @grant        none
// ==/UserScript==

let links = document.links;
let search_icon = document.getElementById("search_icon");
let keywords = ["что можно крысам", "содержание крыс", "продолжительность жизни крыс"];
let keyword = keywords[getRandom(0, keywords.length)];

if (search_icon !== undefined && search_icon !== null) {
    document.getElementById("sb_form_q").value = keyword;
    search_icon.click();

} else {
    for (let i = 0; i < links.length; i++) {
        if (links[i].href.indexOf("ratmania.ru") !== -1) {
            let link = links[i];
            console.log("Нашел строку " + links[i]);
            link.click();
            break;
        }
    }
}
function getRandom(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
}


