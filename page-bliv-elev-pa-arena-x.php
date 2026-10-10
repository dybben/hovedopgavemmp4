<?php

/*
|--------------------------------------------------------------------------
| SERVER VALIDATION
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    function validName($name) {

        $name = trim($name);

        /*
        |--------------------------------------------------------------------------
        | 1. BASIC FORMAT
        |--------------------------------------------------------------------------
        */

        if (!preg_match("/^(?=.{2,50}$)[A-Za-zÆØÅæøå]+(?:[ '\-][A-Za-zÆØÅæøå]+)*$/u", $name)) {
            return false;
        }

        $lower = mb_strtolower($name);

        /*
        |--------------------------------------------------------------------------
        | 2. AFVIS "AA", "AAAA"
        |--------------------------------------------------------------------------
        */

        if (preg_match('/^(.)\1+$/u', $lower)) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | 3. AFVIS "jggg", "qqqq"
        |--------------------------------------------------------------------------
        */

        if (preg_match('/(.)\1{2,}/u', $lower)) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | 4. SKAL HAVE VOKAL
        |--------------------------------------------------------------------------
        */

        if (!preg_match('/[aeiouyæøå]/iu', $name)) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | 5. AFVIS TAL
        |--------------------------------------------------------------------------
        */

        if (preg_match('/[0-9]/', $name)) {
            return false;
        }

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATION CHECK
    |--------------------------------------------------------------------------
    */

    if (!validName($data["elev_navn"] ?? "")) {
        echo json_encode(["success" => false, "message" => "Ugyldigt elevnavn"]);
        exit;
    }

    if (!validName($data["forælder_navn"] ?? "")) {
        echo json_encode(["success" => false, "message" => "Ugyldigt forældrenavn"]);
        exit;
    }

    if (!filter_var($data["forælder_email"] ?? "", FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Ugyldig email"]);
        exit;
    }

    echo json_encode(["success" => true]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Bliv elev på Arena X </title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


<style>
/* ========================= */
/* 🎨 DESIGN SYSTEM          */
/* ========================= */
:root {
  --arena-x-bg: #1F2D23;
  --arena-x-text: #FFFDBA;
  --arena-x-accent: #ff6f42;
  --arena-x-dropdown-bg: #FFFDBA;
  --arena-x-radius: 20px;
  --arena-x-font-display: "Poppins", sans-serif;
  --arena-x-font-body: "Poppins", sans-serif;
}

/* RESET */
*, *::before, *::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* ========================= */
/* BASE                      */
/* ========================= */
body {
  margin: 0;
  font-family: var(--arena-x-font-body);
  background: var(--arena-x-bg);
  color: var(--arena-x-text);
}

/* =========================================================
   TYPOGRAPHY
========================================================= */

h1,
.hero h1 {
  font-size: clamp(var(--h1-min), 6vw, var(--h1-max));
  line-height: 1.05;
}

.hero p {
  font-size: clamp(1rem, 2.5vw, 1.3rem);
}

/* =========================================================
   NAVBAR
========================================================= */

header {
  padding: 15px 20px;
}

.nav-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo {
  font-size: 34px;
  color: var(--arena-x-accent);
  text-decoration: none;
  transition: transform var(--transition);
}

.logo:hover {
  transform: scale(1.1) rotate(-5deg);
}

nav ul {
  list-style: none;
  display: flex;
  gap: 25px;
}

nav a {
  color: var(--arena-x-text);
  text-decoration: none;
  position: relative;
  font-size: 1.1rem;
}

/* underline effect */
nav a::after {
  content: "";
  position: absolute;
  bottom: -4px;
  left: 0;
  height: 2px;
  width: 0;
  background: var(--arena-x-accent);
  transition: 0.3s;
}

nav a:hover::after {
  width: 100%;
}

/* ========================= */
/* NAVBAR                    */
/* ========================= */
header {
  padding:15px 20px;
  background: var(--arena-x-bg);
  animation: fadeDown 0.4s ease-out;
}

.nav-container { display:flex; justify-content:space-between; align-items:center; }

.logo {
  font-family: var(--arena-x-font-display);
  font-size:34px; color: var(--arena-x-accent);
  text-decoration:none;
  transition:transform 0.25s ease, color 0.25s ease;
  display:inline-block; margin:20px; margin-left:2rem;
}
.logo:hover  { transform: scale(1.10) rotate(-5deg); }
.logo:active { transform: scale(0.98); }

nav ul { list-style:none; display:flex; gap:25px; align-items:center; }

nav a {
  color: var(--arena-x-text); text-decoration:none;
  font-size:21px; position:relative;
}
nav a::after {
  content:""; position:absolute; left:0; bottom:-4px;
  width:0%; height:2px;
  background: var(--arena-x-accent); transition:0.3s;
}
nav a:hover { color: var(--arena-x-accent); }
nav a:hover::after { width:100%; }

li.dropdown { position:relative; }
li a.active {
  background: var(--arena-x-accent); color: var(--arena-x-text);
  padding:8px 12px; border-radius:5px; text-decoration:none;
}

.dropdown-menu {
  position:absolute; top:100%; left:0; min-width:15rem;
  background: var(--arena-x-dropdown-bg); border-radius:10px;
  display:none; flex-direction:column; padding:8px 0; z-index:999;
}
.dropdown-menu a { color: var(--arena-x-bg); text-decoration:none; font-size:21px; }
.dropdown-menu a:hover { color: var(--arena-x-accent); }
.dropdown:hover > .dropdown-menu { display:flex; }

.sub-dropdown { position:relative; }
.sub-dropdown > .dropdown-menu {
  position:absolute; top:0; left:100%; margin-left:5px; display:none;
}
.sub-dropdown:hover > .dropdown-menu { display:flex; }

.menu-toggle { display:none; flex-direction:column; cursor:pointer; gap:5px; }
.menu-toggle span { width:28px; height:3px; background: var(--arena-x-text); }

a:focus-visible { outline:2px solid var(--arena-x-accent); outline-offset:4px; border-radius:4px; }

@keyframes fadeDown {
  from { opacity:0; transform:translateY(-100px); }
  to   { opacity:1; transform:translateY(0); }
}

@media (max-width: 1080px) {
  .menu-toggle { display:flex; }
  nav ul {
    position:absolute; top:70px; right:20px;
    flex-direction:column; background: var(--arena-x-dropdown-bg);
    width:260px; padding:15px; border-radius: var(--arena-x-radius);
    display:none; gap:10px;
  }
  nav ul.active { display:flex; }
  nav a { color: var(--arena-x-bg); }
  .dropdown-menu {
    position:relative; display:none;
    box-shadow:none; background:transparent; padding-left:15px;
  }
  .dropdown.open > .dropdown-menu { display:flex; }
  .sub-dropdown > .dropdown-menu { display:none; padding-left:15px; }
  .sub-dropdown.open > .dropdown-menu { display:flex; }
}

/* =========================================================
   HERO
========================================================= */

.hero {
  text-align: center;
  padding: 3rem 1rem;
}

/* =========================================================
   FORM (UX OPTIMERET)
========================================================= */


/* ========================= */
/* FORM WRAPPER             */
/* ========================= */
form {
  width: 100%;
  max-width: 700px;
  margin: 40px auto;
  background: #F7F6F5;
  color: var(--arena-x-bg);
  padding: 30px;
  border-radius: 18px;
  transform: translateY(-20px);
  transition: 0.3s;
}

/* LABELS + INPUTS */
label {
  display: block;
  margin-top: 15px;
  font-weight: 700;
}

input,
select {
  width: 100%;
  padding: 12px;
  border-radius: 10px;
  border: 2px solid #000;
  margin-top: 5px;
  margin-bottom: 1.5rem;
  font-size: 1rem;
  outline: none;
  transition: 0.2s;
  background: #fff;
  font-family: var(--arena-x-font-body);
}

input:focus,
select:focus {
  border-color: var(--arena-x-accent);
  transform: scale(1.02);
}


/* =========================================================
   BUTTON
========================================================= */

button {
  width: 100%;
  padding: 15px;
  border: none;
  border-radius: 12px;
  font-size: 1.2rem;

  background: var(--arena-x-bg);
  color: var(--arena-x-text);

  cursor: pointer;
  transition: var(--transition);
  min-height: 48px;
}

button:hover {
  background: var(--arena-x-text);
  color: var(--arena-x-bg);
  transform: translateY(-3px);
}

button:active {
  transform: scale(0.98);
}

/* =========================================================
   MINI GALLERY
========================================================= */

.mini-gallery {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
}

.mini-gallery img {
  width: 100%;
  height: 120px;
  object-fit: cover;
  border-radius: 8px;
}

/* =========================================================
   SPORT CHIPS
========================================================= */

.sport-chips {
  display: grid;
  grid-template-columns: 1fr;
  gap: 1rem;
}

.sport-chips label {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  border-radius: 20px;
  background: #f1f5f9;
  border: 2px solid #000;
  cursor: pointer;
  transition: 0.2s;
}

.sport-chips label:hover {
  transform: translateY(-2px);
}

.sport-chips input {
  display: none;
}

.sport-chips label:has(input:checked) {
  background: #16a34a;
  color: white;
}

/* =========================================================
   FIELDSETS ANIMATION
========================================================= */

fieldset {
  border: none;
  opacity: 0;
  margin-top: 30px;
  transform: translateX(20px);
  animation: slideIn 2.0s forwards;
}

@keyframes slideIn {
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.field-error {
  color: var(--arena-x-bg);
  margin-top: 20px;
  font-size: 1.125rem;
  line-height: 1.125;

}

/* Fade-in effekt */
@keyframes fadeInError {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Let shake for at fange opmærksomhed */
@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-3px); }
    50% { transform: translateX(3px); }
    75% { transform: translateX(-2px); }
    100% { transform: translateX(0); }
}

/* Hvis du vil kunne skjule/vis den dynamisk */
.field-error.is-hidden {
    display: none;
}
/* =========================================================
   HR
========================================================= */
hr {
  border: none;
  height: 2px;
  background-color: var(--arena-x-bg);
  margin: 24px 0;
}

/* =========================================================
   POPUP
========================================================= */

.popup,
#success {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.8);
  display: none;
  align-items: center;
  justify-content: center;
}

.popup.show,
#success.show {
  display: flex;
}

.popup-content {
  background: white;
  color: black;
  padding: 2rem;
  border-radius: 15px;
}

/* =========================================================
   MOBILE FIRST BREAKPOINTS
========================================================= */

/* 📱 SMALL MOBILE (iPhone 4 / 320px) */
@media (max-width: 360px) {

  .logo {
    font-size: 28px;
  }

  nav ul {
    flex-direction: column;
    gap: 10px;
  }

  button {
    font-size: 1rem;
  }
}

/* 📱 TABLET */
@media (min-width: 640px) {

  .sport-chips {
    grid-template-columns: repeat(2, 1fr);
  }

  .mini-gallery {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* 💻 DESKTOP */
@media (min-width: 1024px) {

  form {
    padding: 3rem;
  }

  .hero {
    max-width: 900px;
    margin: 0 auto;
  }
}

/* 🖥️ LARGE DESKTOP (1920px) */
@media (min-width: 1440px) {
  form {
    max-width: 800px;
  }
}

/* =========================================================
   ACCESSIBILITY
========================================================= */

@media (prefers-reduced-motion: reduce) {
  * {
    animation: none !important;
    transition: none !important;
  }
}
</style>
</head>

<body>


<!-- ═══════════════════════════════════ -->
<!-- HEADER / NAVBAR                     -->
<!-- ═══════════════════════════════════ -->
<header>
  <div class="nav-container">

    <a href="arena_x_index.html" class="logo">ARENA X</a>

    <div class="menu-toggle" onclick="toggleMenu()">
      <span></span><span></span><span></span>
    </div>

    <nav>
      <ul id="menu">

        <li class="dropdown">
          <a href="https://hovedopgavemmp4.thedarkjutland.dk/sportengrene/" onclick="toggleDropdown(event)">Sportengrene</a>
          <ul class="dropdown-menu">
            <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/sportengrene/boksning/">Boksning</a></li>
            <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/sportengrene/brydning/">Brydning</a></li>
            <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/sportengrene/fodbold/">Fodbold</a></li>
            <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/sportengrene/handbold//">Håndbold</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="https://hovedopgavemmp4.thedarkjutland.dk/skills-paa-arenax/" onclick="toggleDropdown(event)">Skills på ArenaX</a>
          <ul class="dropdown-menu">
            <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/skills-paa-arenax/det-faglige/">Det faglige</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="https://hovedopgavemmp4.thedarkjutland.dk/efterskolelivet/" onclick="toggleDropdown(event)">Efterskolelivet</a>
          <ul class="dropdown-menu">
            <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/efterskolelivet/rejser/">Rejser</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="https://hovedopgavemmp4.thedarkjutland.dk/om-Efterskolen/" onclick="toggleDropdown(event)">Om Efterskolen</a>
          <ul class="dropdown-menu">
            <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/om-Efterskolen/hvad-er-arena-x/">Hvad er Arena X</a></li>
            <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/om-Efterskolen/hvorfor-vaelge-os/">Hvorfor vælge os</a></li>
            <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/om-Efterskolen/vores-historie/">Vores historie</a></li>
            <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/om-Efterskolen/personale/">Personale</a></li>
            <li class="dropdown sub-dropdown">
              
            <a href="https://hovedopgavemmp4.thedarkjutland.dk/om-Efterskolen/bestyrelsen/" onclick="toggleSubDropdown(event)">Bestyrelsen</a>
            <ul class="dropdown-menu sub-menu">
              <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/om-Efterskolen/bestyrelsen/vedtaegter/">Vedtægter</a></li>
            </ul>

            </li>
            <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/om-Efterskolen/vaerdier-paa-arena-x/">Værdier på Arena X</a></li>
            <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/om-Efterskolen/faciliteter/">Faciliteter</a></li>
          </ul>
        </li> 
        <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/bliv-elev-pa-arena-x/" class="active">Bliv elev på Arena X</a></li>
        <li><a href="https://hovedopgavemmp4.thedarkjutland.dk/kontakt-os/">Kontakt os</a></li>
      </ul>
    </nav>
  </div>
</header>

<script>
function toggleMenu() {
  document.getElementById("menu").classList.toggle("active");
}
function toggleDropdown(e) {
  if (window.innerWidth <= 768) {
    e.preventDefault();
    e.target.parentElement.classList.toggle("open");
  }
}
function toggleSubDropdown(e) {
  if (window.innerWidth <= 768) {
    e.preventDefault();
    e.target.parentElement.classList.toggle("open");
  }
}
</script>


<form id="form">

<h2>Bliv elev på Arena X</h2>

<!-- Fremgangslinje -->
    <div class="bar"><div class="bar-fill" id="bar"></div></div>

    <!-- Galleri -->
    <div class="mini-gallery">
      <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b" alt="Sport">
      <img src="https://images.unsplash.com/photo-1526232761682-d26e03ac148e" alt="Sport">
      <img src="https://images.unsplash.com/photo-1521412644187-c49fa049e84d" alt="Sport">
    </div>


    <!-- ── TRIN 1: ELEV ── -->
    <fieldset>
      <h3>👤 Elev</h3>

      <label for="elev_navn">Elev navn</label>
      <input id="elev_navn" placeholder="Alberte S."  pattern="^(?=.{2,50}$)[A-Za-zÆØÅæøå]+(?:[ '\-][A-Za-zÆØÅæøå]+)*$" autocomplete="name">
      <span class="field-error" id="err-elev" >Indtast venligst elevens navn.</span>

      <hr>

      <label  tabindex="0" >Vælg sportsgren(e)</label>
      <div class="sport-chips">
        <label><input type="checkbox" value="Badminton" tabindex="0">      <span>🏸 Badminton</span></label>
        <label><input type="checkbox" value="Boksning" tabindex="0">       <span>🥊 Boksning</span></label>
        <label><input type="checkbox" value="Brydning" tabindex="0">       <span>🤼 Brydning</span></label>
        <label><input type="checkbox" value="Cykling" tabindex="0">        <span>🚴 Cykling</span></label>
        <label><input type="checkbox" value="Fodbold" tabindex="0">        <span>⚽ Fodbold</span></label>
        <label><input type="checkbox" value="Floorball" tabindex="0">      <span>🏑 Floorball</span></label>
        <label><input type="checkbox" value="Håndbold" tabindex="0">       <span>🤾 Håndbold</span></label>
        <label><input type="checkbox" value="Ishockey" tabindex="0">       <span>🏒 Ishockey</span></label>
        <label><input type="checkbox" value="Kunstskøjteløb" tabindex="0"> <span>⛸ Kunstskøjteløb</span></label>
        <label><input type="checkbox" value="Løb" tabindex="0">            <span>🏃 Løb</span></label>
        <label><input type="checkbox" value="Padel" tabindex="0">          <span>🎾 Padel</span></label>
        <label><input type="checkbox" value="Skydning" tabindex="0">       <span>🎯 Skydning</span></label>
        <label><input type="checkbox" value="Svømning" tabindex="0">       <span>🏊 Svømning</span></label>
      </div>
      <br>
      <span class="field-error" id="err-sport">Vælg mindst én sportsgren.</span>

      <hr>

      <label for="aar">Skoleår</label>
      <select id="aar">
        <option value="">Vælg skoleår</option>
        <option tabindex="0">2026 / 2027</option>
        <option tabindex="0">2027 / 2028</option>
        <option tabindex="0">2028 / 2029</option>
        <option tabindex="0">2029 / 2030</option>
        <option tabindex="0">2030 / 2031</option>
        <option tabindex="0">2031 / 2032</option>
        <option tabindex="0">2032 / 2033</option>
        <option tabindex="0">2033 / 2034</option>
      </select>
      <span class="field-error" id="err-aar">Vælg venligst et skoleår.</span>
    </fieldset>

    <hr>


    <!-- ── TRIN 2: FORÆLDRE ── -->
    <fieldset id="parents" class="parent">
      <h3>👨‍👩‍👧 Forældre / værge</h3>

      <label for="forælder_navn">Navn på forældre/værge</label>
      <input id="forælder_navn" placeholder="Navn på forældre/værge" autocomplete="name" pattern="[A-Za-zÆØÅæøå\s'\-]{2,50}">
      <span class="field-error" id="err-fnavn">Indtast venligst forældrenes navn.</span>

      <label for="forælder_email">Email</label>
      <input id="forælder_email" type="email" placeholder="email@eksempel.dk" autocomplete="email">
      <span class="field-error" id="err-email">Indtast venligst en gyldig email-adresse.</span>

      <label for="forælder_telefon">Telefon</label>
      <input id="forælder_telefon" type="tel" placeholder="Telefonnummer" autocomplete="tel">
      <span class="field-error" id="err-tlf">Indtast venligst et telefonnummer.</span>

      <label for="postnummer">Postnummer og by</label>
      <input id="postnummer" placeholder="2000 Frederiksberg" autocomplete="postal-code">
    </fieldset>


    <button id="btn" type="submit">Tilmeld dig som elev på Arena X</button>

</form>

<!-- POPUP -->
<div id="popup" class="popup">
  <div class="popup-content">
    <h2>🎉 Tak for din tilmelding! 🎉 </h2>
    <p>Vi har modtaget din ansøgning til Arena X.</p>
    <p>Du modtager snart et velkomstbrev på mail 📩</p>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    /* =========================
       ELEMENTER
    ========================= */
    const form = document.getElementById("form");
    const btn = document.getElementById("btn");
    const bar = document.getElementById("bar");
    const parents = document.getElementById("parents");

    const popup = document.getElementById("popup");
    const success = document.getElementById("success");

    const elev = document.getElementById("elev_navn");
    const aar = document.getElementById("aar");

    const parentNavn = document.getElementById("forælder_navn");
    const parentEmail = document.getElementById("forælder_email");
    const parentTelefon = document.getElementById("forælder_telefon");

    const inputs = document.querySelectorAll("input, select");


    /* =========================
       VALIDATION
    ========================= */
    function validName(name) {
        name = name.trim();

        const regex = /^(?=.{2,50}$)[A-Za-zÆØÅæøå]+(?:[ '\-][A-Za-zÆØÅæøå]+)*$/u;
        if (!regex.test(name)) return false;

        const lower = name.toLowerCase();

        if (/^(.)\1+$/u.test(lower)) return false;      // AA / AAAA
        if (/(.)\1{2,}/u.test(lower)) return false;      // jggg / qqqq
        if (!/[aeiouyæøå]/iu.test(name)) return false;   // must contain vowel
        if (/[0-9]/.test(name)) return false;           // no numbers

        return true;
    }


    /* =========================
       SPORTS
    ========================= */
    function getSports() {
        return Array.from(document.querySelectorAll(".sport-chips input:checked"))
            .map(el => el.value);
    }


    /* =========================
       FORM CHECK / PROGRESS
    ========================= */
    function checkForm() {

        const sports = getSports();

        const elevOK = elev.value.trim() && sports.length > 0 && aar.value;

        if (elevOK) {
            parents.classList.add("active");
            bar.style.width = "50%";
        } else {
            parents.classList.remove("active");
            btn.classList.remove("active");
            return;
        }

        const parentOK =
            parentNavn.value.trim() &&
            parentEmail.value.trim() &&
            parentTelefon.value.trim();

        if (parentOK) {
            bar.style.width = "100%";
            btn.classList.add("active");
        } else {
            btn.classList.remove("active");
        }
    }

    inputs.forEach(i => i.addEventListener("input", checkForm));
    document.querySelectorAll(".sport-chips input")
        .forEach(i => i.addEventListener("change", checkForm));


    /* =========================
       RIPPLE EFFEKT
    ========================= */
    btn.addEventListener("click", (e) => {
        const circle = document.createElement("span");
        circle.classList.add("ripple");

        const rect = btn.getBoundingClientRect();
        circle.style.left = (e.clientX - rect.left) + "px";
        circle.style.top = (e.clientY - rect.top) + "px";

        btn.appendChild(circle);
        setTimeout(() => circle.remove(), 600);
    });


    /* =========================
       SUBMIT (ONE CLEAN FLOW)
    ========================= */
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        /* FRONT VALIDATION */
        if (!validName(elev.value)) {
            alert("❌ Ugyldigt elevnavn");
            return;
        }

        if (!validName(parentNavn.value)) {
            alert("❌ Ugyldigt forældrenavn");
            return;
        }

        if (!btn.classList.contains("active")) {
            form.classList.add("shake");
            setTimeout(() => form.classList.remove("shake"), 300);
            return;
        }

        const data = {
            elev_navn: elev.value,
            sport: getSports(),
            aar: aar.value,
            forælder_navn: parentNavn.value,
            forælder_email: parentEmail.value,
            forælder_telefon: parentTelefon.value
        };

        const res = await fetch("", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data)
        });

        const json = await res.json();

        if (json.success) {

            if (popup) popup.classList.add("show");
            if (success) success.style.display = "flex";

            form.reset();
            bar.style.width = "0%";
            btn.classList.remove("active");
            parents.classList.remove("active");

        } else {
            alert(json.message || "Der skete en fejl");
        }
    });

    document.getElementById("closePopupBtn").addEventListener("click", () => {
    popup.classList.remove("show");
  });

});
</script>

</body> 
</html>

<?php
/**

 * get_footer();
 
 **/

?>