var terrainDefenses = [0, 0, 1, 3, 4, -1, 1, 0, -2, 2, 2, 2];

var unitA = document.getElementById("unitA");
var healthA = document.getElementById("healthA");
var terrainA = document.getElementById("terrainA");
var critA = document.getElementById("critA");
var unitD = document.getElementById("unitD");
var healthD = document.getElementById("healthD");
var terrainD = document.getElementById("terrainD");
var critD = document.getElementById("critD");
var spaces = document.getElementById("spaces");
var weather = document.getElementById("weather");
var buttonSwap = document.getElementById("button-swap");

function setCheckboxReadonly(checkbox, readonly) {
    if (readonly) {
        checkbox.onclick = function() { checkbox.checked = !checkbox.checked; };
        checkbox.classList.add("grey");
        checkbox.parentElement.classList.add("grey");
    } else {
        checkbox.onclick = null;
        checkbox.classList.remove("grey");
        checkbox.parentElement.classList.remove("grey");
    }
}

function checkCrit(unitA, healthA, terrainA, critA, terrainD) {
    setCheckboxReadonly(critA, true);
    switch (unitA.value) {
    case "4":
        critA.checked = terrainDefenses[terrainA.value] >= 3;
        break;
    case "6":
        critA.checked = healthA.value <= 40;
        break;
    case "9":
        if (spaces.value == 0) {
            setCheckboxReadonly(critA, false);
            break;
        }
        critA.checked = spaces.value == 2;
        break;
    case "10":
        if (spaces.value == 0) {
            setCheckboxReadonly(critA, false);
            break;
        }
        critA.checked = spaces.value == 5 || (spaces.value == 6 && weather.value == 2);
        break;
    case "14":
        critA.checked = terrainA.value == "4";
        break;
    case "16":
        critA.checked = terrainD.value == "0";
        break;
    case "18":
        critA.checked = terrainA.value == "7";
        break;
    case "19":
        critA.checked = terrainA.value == "9";
        break;
    case "20":
        critA.checked = terrainA.value == "5";
        break;
    case "21":
        critA.checked = ["6", "7", "8", "9"].includes(terrainA.value);
        break;
    case "22":
        critA.checked = false;
        break;
    default:
        setCheckboxReadonly(critA, false);
    }
}

function checkCritA() {
    checkCrit(unitA, healthA, terrainA, critA, terrainD);
}

function checkCritD() {
    checkCrit(unitD, healthD, terrainD, critD, terrainA);
}

function swap() {
    var tempUnit = unitA.value;
    var tempHealth = healthA.value;
    var tempTerrain = terrainA.value;
    var tempCrit = critA.checked;
    unitA.value = unitD.value;
    healthA.value = healthD.value;
    terrainA.value = terrainD.value;
    critA.checked = critD.checked;
    unitD.value = tempUnit;
    healthD.value = tempHealth;
    terrainD.value = tempTerrain;
    critD.checked = tempCrit;
    checkCritA();
    checkCritD();
}

unitA.onchange = function() { checkCritA(); };
healthA.onchange = function() { checkCritA(); };
terrainA.onchange = function() { checkCritA(); checkCritD(); };
unitD.onchange = function() { checkCritD(); };
healthD.onchange = function() { checkCritD(); };
terrainD.onchange = function() { checkCritA(); checkCritD(); };
spaces.onchange = function() { checkCritA(); checkCritD(); };
weather.onchange = function() { checkCritA(); checkCritD(); };
buttonSwap.onclick = function(e) { e.preventDefault(); swap(); };

checkCritA();
checkCritD();