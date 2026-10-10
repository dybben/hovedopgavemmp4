<?php
/* Template Name: Arena X 404 */

?>
<!DOCTYPE html>
<html lang="da">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Siden blev ikke fundet – men det fedeste efterskoleår på Arena X venter!" />
<title>404 – Siden findes ikke | Arena X Efterskole</title>

<!-- Google Fonts: bold display + body -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style> 
/* =========================================================
   ARENA X 404 PAGE
   CLEAN STRUCTURED CSS
========================================================= */

/* =========================================================
   DESIGN TOKENS
========================================================= */

:root{
  --arena-x-bg:#1F2D23;
  --arena-x-text:#FFFDBA;
  --arena-x-accent:#ff6f42;

  --arena-x-font-display:"Poppins", sans-serif;
  --arena-x-font-body:"Poppins",sans-serif;

  --arena-x-radius-lg:20px;
  --arena-x-radius-md:14px;


  --arena-x-card-min:260px;
  --arena-x-card-max:340px;
}

/* =========================================================
   RESET
========================================================= */

*,
*::before,
*::after{
  margin:0;
  padding:0;
  box-sizing:border-box;
}

/* =========================================================
   BASE
========================================================= */

body{
  background:var(--arena-x-bg);
  color:var(--arena-x-text);
  font-family:var(--arena-x-font-body);
}


/* ========================= */
/* NAVBAR - Logo             */
/* ========================= */


.logo {
  font-family: var(--arena-x-font-display);
  font-size: 55px; color: var(--arena-x-accent);
  text-decoration:none; 
  display:inline-block; 
  margin:1.5rem 0px; margin-left:5rem;
}
.logo:hover  { transform: scale(1.25) rotate(-5deg); }

/* =========================================================
   HERO SECTION
========================================================= */

.arena-x-hero{
  display:flex;
  flex-direction:column;
  align-items:center;
  text-align:center;
  gap: 0.5rem;
}

/* =========================================================
   GLITCH TITLE
========================================================= */

.arena-x-title{
  font-family:var(--arena-x-font-display);
  font-size: 144px;
  line-height:1;
  color:var(--arena-x-text);
  animation:arena-x-glitch 5.0s infinite;
}

.arena-x-title::before,
.arena-x-title::after{
  content:"404";
  position:absolute;
  inset:0;
}

.arena-x-title::before{
  color:var(--arena-x-accent);

  clip-path:polygon(
    0 0,
    100% 0,
    100% 38%,
    0 38%
  );

  animation:
    arena-x-glitch-top 5.0s infinite;
}

.arena-x-title::after{
  color:var(--arena-x-bg);

  clip-path:polygon(
    0 62%,
    100% 62%,
    100% 100%,
    0 100%
  );

  animation:
    arena-x-glitch-bottom 5.0s infinite;
}

/* =========================================================
   TYPOGRAPHY
========================================================= */

.arena-x-h2{
  font-size:clamp(1.5rem,4vw,2.125rem);
  font-weight:700;
  line-height:1.5;
}

.arena-x-p{
  max-width:700px;

  font-size:clamp(1rem,2.4vw,1.325rem);
  line-height:1.5;

  color:rgba(255,253,186,.88);
}


/* =========================================================
   BUTTONS
========================================================= */

.arena-x-btn,
.arena-x-card-btn{

  text-decoration:none;
  font-weight:700;
  font-size:clamp(1rem,2.4vw,1.325rem);
  cursor:pointer;

}

/* Main CTA */

.arena-x-btn{
  margin-top:1rem;
  padding:16px 34px;

  border-radius:var(--arena-x-radius-md);

  background:var(--arena-x-text);
  color:var(--arena-x-bg);

  overflow:hidden;
}

.arena-x-btn::after{
  content:"";

  position:absolute;
  inset:0;

  background:var(--arena-x-accent);

  transform:scaleX(0);
  transform-origin:left;

  transition:transform var(--arena-x-transition);

  z-index:-1;
}

.arena-x-btn:hover,
.arena-x-btn:focus-visible{
  color: var(--arena-x-text);
  transform: translateY(-3px) scale(1.04);
  outline: 3px solid var(--arena-x-accent);
  outline-offset: 3px;
}

.arena-x-btn:hover::after,
.arena-x-btn:focus-visible::after{
  transform:scaleX(1);
}

/* Card CTA */

.arena-x-card-btn{
  margin-top:.5rem;
  padding:11px 22px;

  border-radius:10px;

  background:var(--arena-x-text);
  color:var(--arena-x-bg);

  font-size:.92rem;
  letter-spacing:.4px;

  align-self:flex-start;
}

.arena-x-card-btn:hover,
.arena-x-card-btn:focus-visible{
  background:var(--arena-x-accent);
  color:var(--arena-x-text);

  transform:translateY(-2px);
}

/* =========================================================
   DIVIDER
========================================================= */

.arena-x-divider{
  width:min(80%,700px);

  margin:
    2rem auto 0;

  border:none;
  border-top:
    5px solid var(--arena-x-accent);
}

/* =========================================================
   CARDS SECTION
========================================================= */

.arena-x-cards-section > header{
  text-align:center;

  margin:
    3rem 0 2.5rem;
}

.arena-x-cards-section > header h2{
  font-family:var(--arena-x-font-display);

  font-size:clamp(1.8rem,4vw,2.125rem);

  letter-spacing:4px;
  text-transform:uppercase;
}

/* =========================================================
   CARDS GRID
========================================================= */

.arena-x-cards{
  list-style:none;

  display:grid;

  grid-template-columns:
    repeat(
      auto-fit,
      minmax(
        min(100%, var(--arena-x-card-min)),
        var(--arena-x-card-max)
      )
    );

  justify-content:center;

  gap:2rem;
}

/* =========================================================
   CARD
========================================================= */

.arena-x-card{
  position:relative;

  overflow:hidden;

  min-height:340px;

  border-radius:
    var(--arena-x-radius-lg);

  cursor:pointer;

  transition:
    transform var(--arena-x-transition),
    box-shadow var(--arena-x-transition);
}

/* Hover */

@media (hover:hover){

  .arena-x-card:hover{
    transform:translateY(-10px);

    box-shadow:var(--arena-x-shadow);
  }

  .arena-x-card:hover .arena-x-card-bg img{
    transform:scale(1.08);

    filter:brightness(.35);
  }
}

/* Active */

.arena-x-card:active{
  transform:scale(.98);
}

/* Open State */

.arena-x-card.is-open{
  box-shadow:var(--arena-x-shadow-open);
}

.arena-x-card.is-open .arena-x-card-title{
  color:var(--arena-x-accent);
}

.arena-x-card.is-open .arena-x-card-content{
  grid-template-rows:1fr;
}

.arena-x-card.is-open .arena-x-tap-hint{
  opacity:0;
  max-height:0;
}

/* =========================================================
   CARD BACKGROUND
========================================================= */

.arena-x-card-bg{
  position:absolute;
  inset:0;
}

.arena-x-card-bg img{
  width:100%;
  height:100%;

  object-fit:cover;

  filter:brightness(.45);

  transition:
    transform .6s ease,
    filter .4s ease;
}

/* =========================================================
   CARD CONTENT
========================================================= */

.arena-x-card-inner{
  position:relative;
  z-index:1;

  display:flex;
  flex-direction:column;
  justify-content:flex-end;

  min-height:340px;
  height:100%;

  padding:1.5rem;

  gap:.75rem;
}

/* =========================================================
   CARD TITLE
========================================================= */

.arena-x-card-title{
  font-family:var(--arena-x-font-display);

  font-size:2.125rem;

  letter-spacing:4px;
  text-transform:uppercase;

  transition:
    color var(--arena-x-transition);
}

/* =========================================================
   TAP HINT
========================================================= */

.arena-x-tap-hint{
  font-size: 1.325rem;

  letter-spacing:.5px;

  opacity:1;

  transition:
    opacity var(--arena-x-transition),
    max-height var(--arena-x-transition);

  max-height:40px;
}

/* =========================================================
   EXPANDABLE CONTENT
========================================================= */

.arena-x-card-content{
  display:grid;

  grid-template-rows:0fr;

  overflow:hidden;

  transition:
    grid-template-rows
    var(--arena-x-transition);
}

.arena-x-card-content-inner{
  overflow:hidden;

  display:flex;
  flex-direction:column;

  gap:.75rem;
}

.arena-x-card-content-inner h4{
  font-size:1.25rem;
  font-weight:700;

  letter-spacing:1px;
}

.arena-x-card-content-inner p{
  font-size:.97rem;
  line-height:1.65;

  color:
    rgba(255,253,186,.92);
}

/* =========================================================
   CARD INDICATOR
========================================================= */

.arena-x-card::before{
  content:"";

  position:absolute;

  top:12px;
  right:12px;

  width:8px;
  height:8px;

  border-radius:50%;

  background:var(--arena-x-accent);

  animation:
    arena-x-pulse 2s infinite;

  z-index:2;
}

/* =========================================================
   MOBILE FIRST (≤640px allerede base)
========================================================= */

@media (max-width: 640px) {

  .arena-x-hero {
    padding-top: 2rem;
  }

  .arena-x-card {
    min-height: 240px;
  }
}

/* =========================================================
   SMALL MOBILE (iPhone 4 / 320px)
========================================================= */

@media (max-width: 360px) {

  .arena-x-title {
    font-size: 89px;
  }

  .logo {
    font-size: 28px;
    margin-left: 1rem;
  }

  .arena-x-btn {
    width: 100%;
  }

  .arena-x-hero {
    padding: 1.5rem 1rem;
  }
}

/* =========================================================
   TABLET
========================================================= */

@media (min-width: 640px) {

  .arena-x-hero {
    padding: 3rem 2rem;
  }
}

/* =========================================================
   DESKTOP
========================================================= */

@media (min-width: 1024px) {
  .arena-x-hero {
    max-width: 1100px;
    margin: 0 auto;
  }
}

/* =========================================================
   LARGE DESKTOP (1920px+)
========================================================= */

@media (min-width: 1440px) {

  .arena-x-hero {
    max-width: 1200px;
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

/* =========================================================
   ANIMATIONS
========================================================= */

@keyframes arena-x-glitch{

  0%,90%,100%{
    transform:translate(0);
  }

  92%{
    transform:
      translate(-3px,1px);
  }

  94%{
    transform:
      translate(3px,-1px);
  }

  96%{
    transform:
      translate(-2px,2px);
  }
}

@keyframes arena-x-glitch-top{

  0%,90%,100%{
    transform:translate(0);
    opacity:0;
  }

  92%{
    transform:
      translate(-5px,-2px);

    opacity:1;
  }

  94%{
    transform:
      translate(5px,2px);

    opacity:1;
  }

  96%{
    transform:translate(0);
    opacity:0;
  }
}

@keyframes arena-x-glitch-bottom{

  0%,90%,100%{
    transform:translate(0);
    opacity:0;
  }

  92%{
    transform:
      translate(5px,2px);

    opacity:1;
  }

  94%{
    transform:
      translate(-5px,-2px);

    opacity:1;
  }

  96%{
    transform:translate(0);
    opacity:0;
  }
}

@keyframes arena-x-pulse{

  0%{
    box-shadow:
      0 0 0 0
      rgba(255,111,66,.6);
  }

  70%{
    box-shadow:
      0 0 0 10px
      rgba(255,111,66,0);
  }

  100%{
    box-shadow:
      0 0 0 0
      rgba(255,111,66,0);
  }
}

/* =========================================================
   ACCESSIBILITY
========================================================= */

@media (prefers-reduced-motion:reduce){

  *,
  *::before,
  *::after{
    animation:none !important;
    transition:none !important;
    scroll-behavior:auto !important;
  }
}

/* =========================================================
   FOCUS STATES
========================================================= */

.arena-x-card:focus-visible,
.arena-x-btn:focus-visible,
.arena-x-card-btn:focus-visible{
  outline: 30px solid var(--arena-x-accent);
  outline-offset:4px;
}

</style>

</head>

<body>


<!-- ═══════════════════════════════════ -->
<!-- HEADER / NAVBAR                     -->
<!-- ═══════════════════════════════════ -->

<header>
  <div class="nav-container">

    <a href="/" class="logo">ARENA X</a>
  </div>
</header>

<!-- ═══════════════════════════════════ -->
<!-- HEADER / NAVBAR                     -->
<!-- ═══════════════════════════════════ -->

  <!-- ===== MAIN ===== -->
  <main class="arena-x-main" id="main-content">

    <!-- HERO SECTION -->
    <section class="arena-x-hero" aria-label="error-heading">

      <h1 class="arena-x-title" aria-label="Fejl 404 – siden findes ikke" tabindex="0" >404</h1>
      <h2 class="arena-x-h2" tabindex="0" >Ups... du er gået lidt forkert 😅</h2>

      <p class="arena-x-p" tabindex="0">Den side findes ikke... men hey – det gør <b>det fedeste efterskoleår!</b></p>
      <p class="arena-x-p" tabindex="0">På Arena X handler det ikke om at finde den rigtige side...</p>
      <p class="arena-x-p" tabindex="0">men om at finde <b>sig selv, venner og vilde oplevelser</b> 🔥</p>

      <a href="/" class="arena-x-btn">Start dit efterskoleår</a>

    </section>

    <hr class="arena-x-divider" />
  </main>

   <!-- ===== CARDS SECTION (outside main, still landmark) ===== -->
  <section class="arena-x-cards-section" aria-label="cards-heading">
    <header>
      <h2 id="cards-heading" tabindex="0">Hvad venter dig på Arena X?</h2>
    </header>

    <ul class="arena-x-cards" role="list">

      <!-- SPORT CARD -->
      <li>
        <article
          class="arena-x-card"
          tabindex="0"
          role="button"
          aria-expanded="false"
          aria-controls="sport-content"
          data-card="sport" >
        
          <figure class="arena-x-card-bg" aria-hidden="true">
            <img
              src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?w=700&q=80&auto=format&fit=crop"
              alt="Nogle piger der spiller sammen med hinanden og hygge sig sammen og har det sjovt sammen"
              loading="lazy"
              width="700"
              height="480"
                          />
          </figure>

          <section class="arena-x-card-inner" aria-label="Sport kort">
            <h3 class="arena-x-card-title"tabindex="0">Sport</h3>
            <p class="arena-x-tap-hint" aria-hidden="true" tabindex="0">Tryk for at læse mere ↓</p>

            <aside class="arena-x-card-content" id="sport-content" aria-hidden="true">
              <section class="arena-x-card-content-inner" tabindex="0">
                <h4>Pres grænser. Nå toppen.</h4>
                <p>Fra fodbold og basketball til crossfit og klatring – på Arena X finder du den sport, der tænder dig.</p>
                <p>Træn med passionerede trænere og hold, der støtter hinanden hele vejen.</p>
                <a href="https://hovedopgavemmp4.thedarkjutland.dk/sportengrene/" class="arena-x-card-btn" tabindex="0">Læs mere om sport på Arena X</a>
              </section>
            </aside>
          </section>
          
        </article>
      </li>

      <!-- FÆLLESSKAB CARD -->
      <li>
        <article
          class="arena-x-card"
          tabindex="0"
          role="button"
          aria-expanded="false"
          aria-controls="faellesskab-content"
          data-card="faellesskab"
        >
          <figure class="arena-x-card-bg" aria-hidden="true">
            <img
              src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=700&q=80&auto=format&fit=crop"
              alt="Stemmningsbillede af en gruppe unge mennesker der har det sjovt sammen og hygger sig sammen og griner sammen"
              loading="lazy"
              width="700"
              height="480"
            />
          </figure>

          <section class="arena-x-card-inner" aria-label="Fællesskab kort">
            <h3 class="arena-x-card-title " tabindex="0">Fællesskab</h3>
            <p class="arena-x-tap-hint" aria-hidden="true" tabindex="0">Tryk for at læse mere ↓</p>

            <aside class="arena-x-card-content" id="faellesskab-content" aria-hidden="true">
              <section class="arena-x-card-content-inner" tabindex="0">
                <h4>Venskaber der holder hele livet.</h4>
                <p>På Arena X møder du 70+ elever fra hele landet med én ting til fælles: lysten til at leve fuldt ud.</p>
                <p>Fester, lejrture, morgenmad i fællesrummet – hvert øjeblik bliver til minder.</p>
                <a href="https://hovedopgavemmp4.thedarkjutland.dk/faellesskab" class="arena-x-card-btn" tabindex="0">Oplev fællesskabet på Arena X</a>
              </section>
            </aside>
          </section>
        </article>
      </li>

      <!-- UDVIKLING CARD -->
      <li>
        <article
          class="arena-x-card"
          tabindex="0"
          role="button"
          aria-expanded="false"
          aria-controls="udvikling-content"
          data-card="udvikling"
        >
          <figure class="arena-x-card-bg" aria-hidden="true">
            <img
              src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=700&q=80&auto=format&fit=crop"
              alt="???"
              loading="lazy"
              width="700"
              height="480"
            />
          </figure>

          <section class="arena-x-card-inner" aria-label="Udvikling kort">
            <h3 class="arena-x-card-title" tabindex="0">Udvikling</h3>
            <p class="arena-x-tap-hint" aria-hidden="true" tabindex="0">Tryk for at læse mere ↓</p>

            <aside class="arena-x-card-content" id="udvikling-content" aria-hidden="true">
              <section class="arena-x-card-content-inner" tabindex="0">
                <h4>Bliv den bedste version af dig selv.</h4>
                <p>Et år på Arena X er mere end undervisning – det er personlig vækst, mod og selvtillid der varer livet ud.</p>
                <p>Workshops, mentorer og projekter der udfordrer og inspirerer dig.</p>
                <a href="https://hovedopgavemmp4.thedarkjutland.dk/udvikling" class="arena-x-card-btn" tabindex="0">Se din udvikling på Arena X</a>
              </section>
            </aside>
          </section>
        </article>
      </li>

    </ul>
  </section>

<!-- =====================================================
FOOTER
====================================================== -->
<div id="footer"></div>

<!-- =======================================================
JAVASCRIPT
======================================================= -->

<script src="/arena_x_navbar/arena_x_navbar.js"></script>
<script src="/arena_x_footer/arena_x_footer.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){

  const cards = document.querySelectorAll(".arena-x-card");

  cards.forEach(card => {

    card.addEventListener("click", function(e){

      // undgå klik på links lukker kort
      if(e.target.closest("a")) return;

      const isOpen = card.classList.contains("is-open");

      // luk alle først (accordion UX)
      cards.forEach(c => {
        c.classList.remove("is-open");
        c.setAttribute("aria-expanded","false");
      });

      // åbne hvis den ikke var åben
      if(!isOpen){
        card.classList.add("is-open");
        card.setAttribute("aria-expanded","true");
      }
    });

    // keyboard support (accessibility)
    card.addEventListener("keydown", function(e){
      if(e.key === "Enter" || e.key === " "){
        e.preventDefault();
        card.click();
      }
    });

  });

});
</script>



</body>
</html>


<?php ?>