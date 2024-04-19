<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>

<style>
/* normalize.css v4.0.0 | MIT License | github.com/necolas/normalize.css */
/**
 * 1. Change the default font family in all browsers (opinionated).
 * 2. Prevent adjustments of font size after orientation changes in IE and iOS.
 */
html {
  font-family: sans-serif;
  /* 1 */
  -ms-text-size-adjust: 100%;
  /* 2 */
  -webkit-text-size-adjust: 100%;
  /* 2 */
}

/**
 * Remove the margin in all browsers (opinionated).
 */
body {
  margin: 0;
}

/* HTML5 display definitions
   ========================================================================== */
/**
 * Add the correct display in IE 9-.
 * 1. Add the correct display in Edge, IE, and Firefox.
 * 2. Add the correct display in IE.
 */
article,
aside,
details,
figcaption,
figure,
footer,
header,
main,
menu,
nav,
section,
summary {
  /* 1 */
  display: block;
}

/**
 * Add the correct display in IE 9-.
 */
audio,
canvas,
progress,
video {
  display: inline-block;
}

/**
 * Add the correct display in iOS 4-7.
 */
audio:not([controls]) {
  display: none;
  height: 0;
}

/**
 * Add the correct vertical alignment in Chrome, Firefox, and Opera.
 */
progress {
  vertical-align: baseline;
}

/**
 * Add the correct display in IE 10-.
 * 1. Add the correct display in IE.
 */
template,
[hidden] {
  display: none;
}

/* Links
   ========================================================================== */
/**
 * Remove the gray background on active links in IE 10.
 */
a {
  background-color: transparent;
}

/**
 * Remove the outline on focused links when they are also active or hovered
 * in all browsers (opinionated).
 */
a:active,
a:hover {
  outline-width: 0;
}

/* Text-level semantics
   ========================================================================== */
/**
 * 1. Remove the bottom border in Firefox 39-.
 * 2. Add the correct text decoration in Chrome, Edge, IE, Opera, and Safari.
 */
abbr[title] {
  border-bottom: none;
  /* 1 */
  text-decoration: underline;
  /* 2 */
  text-decoration: underline dotted;
  /* 2 */
}

/**
 * Prevent the duplicate application of `bolder` by the next rule in Safari 6.
 */
b,
strong {
  font-weight: inherit;
}

/**
 * Add the correct font weight in Chrome, Edge, and Safari.
 */
b,
strong {
  font-weight: bolder;
}

/**
 * Add the correct font style in Android 4.3-.
 */
dfn {
  font-style: italic;
}

/**
 * Correct the font size and margin on `h1` elements within `section` and
 * `article` contexts in Chrome, Firefox, and Safari.
 */
h1 {
  font-size: 2em;
  margin: 0.67em 0;
}

/**
 * Add the correct background and color in IE 9-.
 */
mark {
  background-color: #ff0;
  color: #000;
}

/**
 * Add the correct font size in all browsers.
 */
small {
  font-size: 80%;
}

/**
 * Prevent `sub` and `sup` elements from affecting the line height in
 * all browsers.
 */
sub,
sup {
  font-size: 75%;
  line-height: 0;
  position: relative;
  vertical-align: baseline;
}

sub {
  bottom: -0.25em;
}

sup {
  top: -0.5em;
}

/* Embedded content
   ========================================================================== */
/**
 * Remove the border on images inside links in IE 10-.
 */
img {
  border-style: none;
}

/**
 * Hide the overflow in IE.
 */
svg:not(:root) {
  overflow: hidden;
}

/* Grouping content
   ========================================================================== */
/**
 * 1. Correct the inheritance and scaling of font size in all browsers.
 * 2. Correct the odd `em` font sizing in all browsers.
 */
code,
kbd,
pre,
samp {
  font-family: monospace, monospace;
  /* 1 */
  font-size: 1em;
  /* 2 */
}

/**
 * Add the correct margin in IE 8.
 */
figure {
  margin: 1em 40px;
}

/**
 * 1. Add the correct box sizing in Firefox.
 * 2. Show the overflow in Edge and IE.
 */
hr {
  box-sizing: content-box;
  /* 1 */
  height: 0;
  /* 1 */
  overflow: visible;
  /* 2 */
}

/* Forms
   ========================================================================== */
/**
 * Change font properties to `inherit` in all browsers (opinionated).
 */
button,
input,
select,
textarea {
  font: inherit;
}

/**
 * Restore the font weight unset by the previous rule.
 */
optgroup {
  font-weight: bold;
}

/**
 * Show the overflow in IE.
 * 1. Show the overflow in Edge.
 * 2. Show the overflow in Edge, Firefox, and IE.
 */
button,
input,
select {
  /* 2 */
  overflow: visible;
}

/**
 * Remove the margin in Safari.
 * 1. Remove the margin in Firefox and Safari.
 */
button,
input,
select,
textarea {
  /* 1 */
  margin: 0;
}

/**
 * Remove the inheritence of text transform in Edge, Firefox, and IE.
 * 1. Remove the inheritence of text transform in Firefox.
 */
button,
select {
  /* 1 */
  text-transform: none;
}

/**
 * Change the cursor in all browsers (opinionated).
 */
button,
[type=button],
[type=reset],
[type=submit] {
  cursor: pointer;
}

/**
 * Restore the default cursor to disabled elements unset by the previous rule.
 */
[disabled] {
  cursor: default;
}

/**
 * 1. Prevent a WebKit bug where (2) destroys native `audio` and `video`
 *    controls in Android 4.
 * 2. Correct the inability to style clickable types in iOS.
 */
button,
html [type=button],
[type=reset],
[type=submit] {
  -webkit-appearance: button;
  /* 2 */
}

/**
 * Remove the inner border and padding in Firefox.
 */
button::-moz-focus-inner,
input::-moz-focus-inner {
  border: 0;
  padding: 0;
}

/**
 * Restore the focus styles unset by the previous rule.
 */
button:-moz-focusring,
input:-moz-focusring {
  outline: 1px dotted ButtonText;
}

/**
 * Change the border, margin, and padding in all browsers (opinionated).
 */
fieldset {
  border: 1px solid #c0c0c0;
  margin: 0 2px;
  padding: 0.35em 0.625em 0.75em;
}

/**
 * 1. Correct the text wrapping in Edge and IE.
 * 2. Correct the color inheritance from `fieldset` elements in IE.
 * 3. Remove the padding so developers are not caught out when they zero out
 *    `fieldset` elements in all browsers.
 */
legend {
  box-sizing: border-box;
  /* 1 */
  color: inherit;
  /* 2 */
  display: table;
  /* 1 */
  max-width: 100%;
  /* 1 */
  padding: 0;
  /* 3 */
  white-space: normal;
  /* 1 */
}

/**
 * Remove the default vertical scrollbar in IE.
 */
textarea {
  overflow: auto;
}

/**
 * 1. Add the correct box sizing in IE 10-.
 * 2. Remove the padding in IE 10-.
 */
[type=checkbox],
[type=radio] {
  box-sizing: border-box;
  /* 1 */
  padding: 0;
  /* 2 */
}

/**
 * Correct the cursor style of increment and decrement buttons in Chrome.
 */
[type=number]::-webkit-inner-spin-button,
[type=number]::-webkit-outer-spin-button {
  height: auto;
}

/**
 * Correct the odd appearance of search inputs in Chrome and Safari.
 */
[type=search] {
  -webkit-appearance: textfield;
}

/**
 * Remove the inner padding and cancel buttons in Chrome on OS X and
 * Safari on OS X.
 */
[type=search]::-webkit-search-cancel-button,
[type=search]::-webkit-search-decoration {
  -webkit-appearance: none;
}

/* BASE */
*, *:before, *:after {
  box-sizing: border-box;
}

::-moz-selection {
  background-color: #000000;
  color: #ffffff;
  text-shadow: none;
}

::selection {
  background-color: #000000;
  color: #ffffff;
  text-shadow: none;
}

::-webkit-selection {
  background-color: #000000;
  color: #ffffff;
  text-shadow: none;
}

img::-moz-selection {
  background: transparent;
}

img::selection {
  background: transparent;
}

/* Basic Typography */
h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
  font-family: inherit;
  color: inherit;
  line-height: 1.25;
  margin: 0 0 15px 0;
  padding: 0;
  font-weight: normal;
}

h1, .h1 {
  font-size: 1.6em;
}

h2, .h2 {
  font-size: 1.1em;
}

h3, .h3 {
  font-size: 2.6em;
}

h4, .h4 {
  font-size: 2.35em;
}

h5, .h5 {
  font-size: 1.85em;
}

h6, .h6 {
  font-size: 1em;
}

small, .small {
  font-size: 0.7em;
}

a.link {
  text-decoration: none;
}

a.link:hover {
  text-decoration: underline;
}

p {
  margin: 0 0 15px 0;
}

hr {
  border-bottom: 1px solid #333333;
  border-left: none;
  border-right: none;
  border-top: none;
  margin: 1.5em 0;
  clear: both;
}

ul.list-inline, ol.list-inline {
  list-style: none;
  margin: 0;
  padding: 0;
}

ul.list-inline li, ol.list-inline li {
  display: inline-block;
}

em {
  font-style: italic;
}

strong {
  font-weight: bold;
}

abbr[title] {
  border-bottom: 1px dotted;
}

abbr, acronym {
  cursor: help;
}

tt, code {
  font-family: "Consolas", "Monaco", "Bitstream Vera Sans Mono", "Courier", monospace;
  font-size: 0.75em;
}

pre {
  font-family: "Consolas", "Monaco", "Bitstream Vera Sans Mono", "Courier", monospace;
  -moz-tab-size: 2;
  tab-size: 2;
  margin-bottom: 12px;
  white-space: nowrap;
  border: 1px solid #E1E1E1;
  border-radius: 4px;
}

pre > code {
  display: block;
  padding: 1rem 1.5rem;
  white-space: pre;
}

/* Media elements */
img, picture, video, audio, embed, object, input, iframe {
  margin: 0;
}

picture, video, audio, embed, object, input, iframe {
  max-width: 100%;
}

img {
  display: inline-block;
  vertical-align: middle;
  border: 0;
  -ms-interpolation-mode: bicubic;
}

img[src*=".svg"] {
  width: 100% \9 ;
}

a:hover img {
  border: none;
  background: none;
}

x::-ms-reveal, img[src*=".svg"] {
  width: 100%;
}

a img {
  border: none;
}

/* Button Module */
button, .button {
  cursor: pointer;
  text-decoration: none;
  background-color: transparent;
  padding: 0;
  border: 0;
  -ms-touch-action: manipulation;
  touch-action: manipulation;
  white-space: nowrap;
}

.button {
  display: inline-block;
  text-align: center;
  vertical-align: middle;
}

button {
  background-image: none;
}

button:focus, button:active {
  outline: none;
  box-shadow: none;
  border: none;
}

button.button-disabled, button[disabled] {
  cursor: not-allowed;
  opacity: 0.65;
}

/* Header module */
/* Form Module */
fieldset {
  border: 0;
  margin: 0;
  padding: 0;
}

textarea, select {
  padding: 6px 10px;
  box-shadow: none;
}

textarea, input {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}

textarea {
  resize: none;
  height: auto;
  min-height: 50px;
}

.table {
  width: 100%;
  margin-bottom: 15px;
}

.table th, .table td {
  border-bottom: 0.1rem solid #e1e1e1;
  padding: 10px 20px;
  text-align: left;
}

.table th:first-child, .table td:first-child {
  padding-left: 0;
}

.table th:last-child, .table td:last-child {
  padding-right: 0;
}

/* General layout */
section {
  width: 100%;
  display: block;
  position: relative;
}

section:before, section:after {
  content: " ";
  display: table;
}

section:after {
  clear: both;
}

.inner-container {
  width: 100%;
}

.inner-container:before, .inner-container:after {
  content: " ";
  display: table;
}

.inner-container:after {
  clear: both;
}

.text-center {
  text-align: center;
}

.text-left {
  text-align: left;
}

.text-right {
  text-align: right;
}

.text-uppercase {
  text-transform: uppercase;
}

.full-width {
  width: 100%;
}

.spacing {
  padding: 15px 0;
}

/* PRINT STYLES */
@media print {
  *, *:before, *:after, *:first-letter, *:first-line {
    background: transparent !important;
    color: #000 !important;
    box-shadow: none !important;
    text-shadow: none !important;
  }

  a, a:visited {
    text-decoration: underline;
  }

  a[href]:after {
    content: " (" attr(href) ")";
  }

  abbr[title]:after {
    content: " (" attr(title) ")";
  }

  a[href^="#"]:after,
a[href^="javascript:"]:after {
    content: "";
  }

  pre, blockquote {
    border: 1px solid #999;
    page-break-inside: avoid;
  }

  img {
    max-width: 100% !important;
    page-break-inside: avoid;
  }

  p, h2, h3 {
    orphans: 3;
    widows: 3;
  }

  h2, h3 {
    page-break-after: avoid;
  }
}
html, body {
  margin: 0;
  font-family: "Karla", sans-serif;
}

.slideshow {
  overflow: hidden;
  position: relative;
  z-index: 3;
}
.slideshow.screen-height {
  width: 100%;
  height: 100vh;
}
.slideshow .slideshow-inner {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.slideshow .slides {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
}

.slide {
  display: none;
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  transition: opacity 0.3s ease;
  will-change: transform, opacity, width, right, left;
}
.slide.is-active {
  display: block;
}
.slide.is-loaded {
  filter: progid:DXImageTransform.Microsoft.Alpha(enabled=false);
  opacity: 1;
}
.slide .image-container {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-position: center;
  z-index: 1;
  background-size: cover;
  image-rendering: optimizeQuality;
  will-change: left, right;
}
.slide .image-container:before {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  content: "";
  background: rgba(54, 47, 22, 0.5);
}
.slide .image-container:after {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 266px;
  content: "";
  transform: scale(-1);
  background-image: linear-gradient(#0e0e0e 0%, rgba(14, 14, 14, 0.738) 19%, rgba(14, 14, 14, 0.541) 34%, rgba(14, 14, 14, 0.382) 47%, rgba(14, 14, 14, 0.278) 56.5%, rgba(14, 14, 14, 0.194) 65%, rgba(14, 14, 14, 0.126) 73%, rgba(14, 14, 14, 0.075) 80.2%, rgba(0, 0, 0, 0.042) 86.1%, rgba(14, 14, 14, 0.021) 91%, rgba(14, 14, 14, 0.008) 95.2%, rgba(14, 14, 14, 0.002) 98.2%, rgba(14, 14, 14, 0) 100%);
}
.slide .image {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 105%;
  min-height: 105%;
  width: auto;
  height: auto;
  z-index: -100;
  transform: translateX(-50%) translateY(-50%);
  transition: 2s filter linear;
}
.slide .image.is-blur {
  filter: url(#blur);
  filter: blur(5px);
  filter: progid:DXImageTransform.Microsoft.Blur(PixelRadius="5");
}
.slide .image.is-loading {
  display: block;
  width: 100%;
  height: 100%;
}
.slide__slide-content {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 2;
  color: white;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  will-change: width, left, right;
}
.slide__slide-content h2 {
  display: inline-block;
  color: #fed208;
  font-family: "Oswald", sans-serif;
  font-size: 6.1vw;
  line-height: 1;
  text-transform: uppercase;
  margin-bottom: 0;
  margin-top: 0;
  overflow: hidden;
  position: relative;
  padding: 0 5%;
  mix-blend-mode: lighten;
  will-change: transform, opacity;
}
.slide__slide-content h2 a {
  display: block;
  color: #fed208;
}

.counter {
  position: absolute;
  bottom: 30%;
  left: 50%;
  transform: translateX(-50%);
  z-index: 2;
  color: white;
}
.counter__nbr {
  display: inline-block;
  vertical-align: middle;
  padding: 0 10px;
  font-size: 13px;
  font-size: 13px;
  font-weight: 400;
  line-height: 3.2307692308;
  color: white;
}
.counter__nbr.counter__nbr--yellow {
  color: #fed208;
}

.view-events, .skip-intro {
  z-index: 2;
  position: absolute;
  bottom: 120px;
  left: 50%;
  transform: translateX(-50%);
  color: white;
  font-size: 19px;
  line-height: 1.3846153846;
  text-transform: uppercase;
  backface-visibility: hidden;
  opacity: 1;
  visibility: visible;
  letter-spacing: 0.2rem;
  will-change: opacity, visibility;
}
.view-events.is-hidden, .skip-intro.is-hidden {
  opacity: 0;
  visibility: hidden;
}
.view-events span, .skip-intro span {
  position: relative;
  display: block;
  overflow: hidden;
  padding: 0 10px;
}
.view-events span:before, .skip-intro span:before {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: rgba(239, 239, 239, 0.2);
  right: 0;
  transform: translateX(-101%);
  top: 0;
  transition: all 0.5s cubic-bezier(0.645, 0.045, 0.355, 1);
  will-change: transform;
}
.view-events__line, .skip-intro__line {
  position: absolute;
  left: 50%;
  content: "";
  top: calc(100% + 10px);
  width: 1px;
  height: 30px;
  will-change: transform;
  overflow: hidden;
}
.view-events__line i, .skip-intro__line i {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transform: translateY(-101%);
  background-color: #fed208;
}
.view-events:hover span:before, .skip-intro:hover span:before {
  transform: translateX(0);
}

.arrows .arrow {
  margin: -33px 0 0;
  position: absolute;
  top: 50%;
  cursor: pointer;
  z-index: 3;
  width: 55px;
  height: 55px;
  border: 1px solid #fed208;
  border-radius: 50%;
}
.arrows .arrow:before {
  position: absolute;
  top: -7px;
  left: -7px;
  width: 67px;
  height: 67px;
  border: 1px dashed white;
  opacity: 0.3;
  content: "";
  border-radius: 50%;
}
.arrows .arrow__line {
  fill: none;
  stroke: white;
  stroke-width: 2;
  stroke-miterlimit: 10;
  transition: all 0.5s cubic-bezier(0.645, 0.045, 0.355, 1);
  position: absolute;
  will-change: transform, opacity, visibility;
}
.arrows .arrow .svg {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  width: 15px;
  height: 13px;
  fill: white;
}
.arrows .arrow .svg:before {
  position: absolute;
  height: 1px;
}
.arrows .arrow .svg svg {
  position: absolute;
  left: 0;
  top: 0;
  display: inline-block;
  width: 100%;
  height: 100%;
  vertical-align: top;
  transition: all 0.5s cubic-bezier(0.645, 0.045, 0.355, 1);
  overflow: visible;
  will-change: transform;
}
.arrows .arrow .svg svg .arrow__line {
  opacity: 0;
  visibility: hidden;
}
.arrows .prev {
  left: 30px;
}
.arrows .prev svg {
  transform: translateX(2px);
}
.arrows .prev svg .arrow__line {
  transform: translateX(-50px);
}
.arrows .prev:hover .svg svg {
  transform: translateX(-2px);
}
.arrows .prev:hover .svg svg .arrow__line {
  opacity: 1;
  visibility: visible;
  transform: translateX(0);
}
.arrows .next {
  right: 30px;
}
.arrows .next svg {
  transform: translateX(-2px);
}
.arrows .next svg .arrow__line {
  transform: translateX(50px);
}
.arrows .next:hover .svg svg {
  transform: translateX(2px);
}
.arrows .next:hover .svg svg .arrow__line {
  opacity: 1;
  visibility: visible;
  transform: translateX(0);
}

@keyframes rotate {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}
.pages {
  position: absolute;
  top: 35px;
  left: 0;
  width: 100%;
  cursor: default;
  z-index: 2;
  text-align: center;
}
.pages ul {
  padding: 0;
  margin: 0;
}
.pages .page {
  display: inline-block;
  position: relative;
  cursor: pointer;
  padding: 0 10px;
}
.pages .page__link {
  position: relative;
  display: block;
  color: white;
  font-size: 12px;
  line-height: 1.5;
  padding: 5px 10px;
  overflow: hidden;
  transition: all 0.5s cubic-bezier(0.645, 0.045, 0.355, 1);
  will-change: color;
  transform: translateZ(0);
  text-decoration: none;
}
.pages .page__link i {
  position: absolute;
  width: 100%;
  height: 18px;
  background-color: rgba(239, 239, 239, 0.2);
  right: 0;
  transform: translateX(-100%);
  top: 5px;
  will-change: transform;
}
.pages .page + .page {
  margin-left: -2px;
}
</style>

<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
	<title>::: MTQ Ke-41 Kab.Tanah Datar :::</title>
</head>
<body>
<div class="cities slideshow screen-height" data-js="city-slider" data-transition="">

    <div class="slideshow-inner"> 

      <div class="cities__slider slides"> 
        <div class="cities__slide slide is-active">
            <div class="slide__slide-content">
                <span></span>  
                <h2>
                    <a href="#Philadelphia">Pemenrintah Kabupaten Tanah Datar</a>
                </h2>
            </div>
            <div class="image-container">
                <img
                    src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs="
                    data-src="https://i.imgpile.com/n55WEx.jpg"
                    alt="bracelets-bijoux-createur" 
                    class="image queue-loading as-background"/>
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                <filter id="blur">
                  <feGaussianBlur stdDeviation="3" />
                </filter>
              </svg>
            </div>
        </div>
        
        <div class="cities__slide slide">
            <div class="slide__slide-content">
                <span></span>
                <h2>
                    <a href="#Philadelphia">Kantor Kementerian Agama Kabupaten Tanah Datar</a>
                </h2>
            </div>
            <div class="image-container">
                <img
                    src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs="
                    data-src="https://i.imgpile.com/n55WEx.jpg"
                    alt="bracelets-bijoux-createur"
                    class="image queue-loading as-background"/>
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg"> 
                <filter id="blur">
                  <feGaussianBlur stdDeviation="3" />
                </filter>
              </svg>
            </div>
        </div>
        
        <div class="cities__slide slide">
            <div class="slide__slide-content">
                <span></span>
                <h2>
                    <a href="#Philadelphia">MTQ Ke-41 Kab. Tanah Datar di Kec.Tanjung Emas 20-24 Juli 2022</a>
                </h2>
            </div>
            <div class="image-container">
                <img
                    src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs="
                    data-src="https://i.imgpile.com/n55WEx.jpg"
                    alt="bracelets-bijoux-createur"
                    class="image queue-loading as-background"/>
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                <filter id="blur">
                  <feGaussianBlur stdDeviation="3" />
                </filter>
              </svg>
            </div>
        </div>
      </div>

      <nav class="pages">
        <ul>
          <li class="page is-active">
            <a href="#" class="page__link">
              <i data-js="page-loader"></i>
              PESERTA
            </a>
          </li>
          <li class="page">
            <a href="#" class="page__link">
              <i data-js="page-loader"></i>
              KATEGORI
            </a>
          </li>
          <li class="page"> 
            <a href="#" class="page__link">
              <i data-js="page-loader"></i>
              LOKASI
            </a>
          </li>
        </ul>
      </nav>
      
      <div class="arrows">
        <div class="arrow prev" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
          <span class="svg svg-arrow-left">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 26" enable-background="new 0 0 30 26"><path d="M13 26c-.3 0-.5-.1-.7-.3l-12-12c-.4-.4-.4-1 0-1.4l12-12c.4-.4 1-.4 1.4 0s.4 1 0 1.4l-11.3 11.3 11.3 11.3c.4.4.4 1 0 1.4-.2.2-.4.3-.7.3z"/><path class="arrow__line" d="M29.9 13.1h-28.4"/></svg>
          </span>
        </div>
        <div class="arrow next" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
          <span class="svg svg-arrow-right">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 26" enable-background="new 0 0 30 26"><path d="M16.9 0c.3 0 .5.1.7.3l12 12c.4.4.4 1 0 1.4l-12 12c-.4.4-1 .4-1.4 0-.4-.4-.4-1 0-1.4l11.3-11.3-11.3-11.3c-.4-.4-.4-1 0-1.4.2-.2.5-.3.7-.3z"/><path class="arrow__line" d="M0 12.9h28.5"/></svg>
          </span>
        </div>
      </div>
    </div>
</div>
</body>
</html>

<script>
// EXTEND jQuery
$.js = function (el) {
    return $('[data-js=' + el + ']')
};
 
/**
*
* @param d
* @returns {string}
* @private
*/
function _pad(d) {
  return (d < 10) ? '0' + d.toString() : d.toString();
}

var _img;
function isImageOk(img) {
    _img = img.data('img');
    if (typeof _img === 'undefined') { 
        var _img = new Image();
        _img.src = img.attr('src');
        img.data('img', _img);
    }
    if (!_img.complete) {
        return false;
    }
    if (typeof _img.naturalWidth !== "undefined" && _img.naturalWidth === 0) {
        return false;
    }
    return true;
}
var imagesToLoad = null;

(function ($) {  
    $.fn.queueLoading = function () {
        var maxLoading = 2;
        var images = $(this);
        if (imagesToLoad === null || imagesToLoad.length === 0) {
            imagesToLoad = images;
        } else {
            imagesToLoad = imagesToLoad.add(images); 
        }
        var imagesLoading = null;

        function checkImages() {
            imagesLoading = imagesToLoad.filter('.is-loading');
            imagesLoading.each(function () {
                var image = $(this);
                if (isImageOk(image)) {
                    image.addClass('is-loaded').removeClass('is-loading');
                    image.trigger('loaded');
                }
            });
            imagesToLoad = images.not('.is-loaded');
            loadNextImages();
        }

        function loadNextImages() {
            imagesLoading = imagesToLoad.filter('.is-loading');
            var nextImages = imagesToLoad.slice(0, maxLoading - imagesLoading.length);
            nextImages.each(function () {
                var image = $(this);
                if (image.hasClass('is-loading')) return;
                image.attr('src', image.attr('data-src'));
                image.addClass('is-loading');
            });
            if (imagesToLoad.length != 0) setTimeout(checkImages, 25);
        }

        checkImages();
    };
}(jQuery));

var  
    slideshow,
    slideshowDuration = 4000,
    loaderAnim = true; 

/**
  * cities slider - prev/next
*/
function sliderArrows() {
  $('.slideshow .arrows .arrow').on('click', function () {
    TweenMax.to($('.page.is-active i.is-animating'), 1, { x: '101%' });
    slideshowNext($(this).closest('.slideshow'), $(this).hasClass('prev'), false);
    loaderAnim = false;
  });

  $('.slideshow').each(function(){
    var $this = $(this);
    var mc = new Hammer(this);
    mc.on("swipe", function(ev) {
      if(ev.direction === 4) {
        slideshowNext($(ev.target).closest('.slideshow'), true, false); 
      } else if(ev.direction === 2) {
        slideshowNext($(ev.target).closest('.slideshow'), false, false);
      } else {
        return false; 
      }
    });
  });
}

/**
 * cities slider - pages/nav
*/
function sliderPages() {
  $('.slideshow .pages .page').on('click', function () {
    TweenMax.to($('.page.is-active i.is-animating'), 1, { x: '101%' });
    slideshowSwitch($(this).closest('.slideshow'), $(this).index(), true);
    loaderAnim = true;
  });

  $('.slideshow .pages').on('check', function () {
    var pages = $(this).find('.page'),
        index = slideshow.find('.slides .is-active').index();
    pages.removeClass('is-active');
    pages.eq(index).addClass('is-active');
    sliderNavloader();
  });
}

/**
  * home slider
*/
function homeSlider() {

  /**
   * first call loader on slider navigation
  */
  sliderNavloader();

  /**
   * preload slider images
  */
  $('img.queue-loading').queueLoading();

  $('[data-js="city-slider"]').each(function () {
    slideshow = $(this);
    var images = slideshow.find('.image').not('.is-loaded');
    images.on('loaded', function () {
      var image = $(this);
      var slide = image.closest('.slide');
      slide.addClass('is-loaded');
    });
    images.queueLoading();
    var timeout = setTimeout(function () {
      slideshowNext(slideshow, false, true);
      loaderAnim = true;
    }, slideshowDuration);
    slideshow.data('timeout', timeout);
  });
}

/**
*
* @param slideshow
* @param index
* @param auto
*/
function slideshowSwitch(slideshow, index, auto) {
  if (slideshow.data('wait')) {
    return;
  }
  var slides = slideshow.find('.slide'),
      pages = slideshow.find('.pages'),
      activeSlide = slides.filter('.is-active'),
      activeSlideImage = activeSlide.find('.image-container'),
      newSlide = slides.eq(index),
      newSlideImage = newSlide.find('.image-container'),
      newSlideContent = newSlide.find('.slide__slide-content'),
      newSlideElements = newSlide.find('.slide__slide-content > *'),
      timeout = slideshow.data('timeout'),
      transition = slideshow.attr('data-transition');

  if (newSlide.is(activeSlide)) {
    return;
  }
  newSlide.addClass('is-new');
  clearTimeout(timeout);
  slideshow.data('wait', true);

  if (transition === 'fade') {
    newSlide.css({ display: 'block', zIndex: 2 });
    newSlideImage.css({ opacity: 0 });
    TweenMax.to(newSlideImage, 1, {
      alpha: 1, onComplete: function () {
        newSlide.addClass('is-active').removeClass('is-new');
        activeSlide.removeClass('is-active');
        newSlide.css({display: '', zIndex: ''});
        newSlideImage.css({opacity: ''});
        slideshow.find('.pages').trigger('check');
        slideshow.data('wait', false);
        if (auto) {
          timeout = setTimeout(function () {
            slideshowNext(slideshow, false, true);
          }, slideshowDuration);
          slideshow.data('timeout', timeout);
        }
      }
    });
  } else if(transition === 'transform') {

    // TODO

  } else {
    if (newSlide.index() > activeSlide.index()) {
      var newSlideRight = 0,
          newSlideLeft = 'auto',
          newSlideImageRight = -slideshow.width() / 8,
          newSlideImageLeft = 'auto',
          newSlideImageToRight = 0,
          newSlideImageToLeft = 'auto',
          newSlideContentLeft = 'auto',
          newSlideContentRight = 0,
          activeSlideImageLeft = -slideshow.width() / 4;
    } else {
      var newSlideRight = '',
          newSlideLeft = 0,
          newSlideImageRight = 'auto',
          newSlideImageLeft = -slideshow.width() / 8,
          newSlideImageToRight = '',
          newSlideImageToLeft = 0,
          newSlideContentLeft = 0,
          newSlideContentRight = 'auto',
          activeSlideImageLeft = slideshow.width() / 4;
    }

    newSlide.css({display: 'block', width: 0, right: newSlideRight, left: newSlideLeft, zIndex: 2});
    newSlideImage.css({width: slideshow.width(), right: newSlideImageRight, left: newSlideImageLeft});
    newSlideContent.css({width: slideshow.width(), left: newSlideContentLeft, right: newSlideContentRight});
    activeSlideImage.css({ left: 0 });

    TweenMax.set(newSlideElements, { y: 20, force3D: true });
    TweenMax.to(activeSlideImage, 1, { left: activeSlideImageLeft, ease: Expo.easeInOut });
    TweenMax.to(newSlide, 1, { width: slideshow.width(), ease: Expo.easeInOut });
    TweenMax.to(newSlideImage, 1, {
      right: newSlideImageToRight,
      left: newSlideImageToLeft,
      ease: Expo.easeInOut
    });

    TweenMax.staggerFromTo(newSlideElements, 0.8, {alpha: 0, y: 60}, {
      alpha: 1,
      y: 0,
      ease: Expo.easeOut,
      force3D: true,
      delay: 0.6
    }, 0.1, function () {
      newSlide.addClass('is-active').removeClass('is-new');
      activeSlide.removeClass('is-active');
      newSlide.css({ display: '', width: '', left: '', zIndex: '' });
      newSlideImage.css({ width: '', right: '', left: '' });
      newSlideContent.css({ width: '', left: '' });
      newSlideElements.css({ opacity: '', transform: '' });
      activeSlideImage.css({ left: '' });
      slideshow.find('.pages').trigger('check');
      slideshow.data('wait', false);
      if (auto) {
        timeout = setTimeout(function () {
          slideshowNext(slideshow, false, true);
        }, slideshowDuration);
        slideshow.data('timeout', timeout);
      }
    });
  }

  /**
   * update counter
  */
  $.js('counter-from').html(_pad(newSlide.index() + 1));
}

/**
*
* @param slideshow
* @param previous
* @param auto
*/
function slideshowNext(slideshow, previous, auto) {
  var slides = slideshow.find('.slide'),
      activeSlide = slides.filter('.is-active'),
      newSlide = null;
  if (previous) {
    newSlide = activeSlide.prev('.slide');
    if (newSlide.length === 0) {
      newSlide = slides.last();
    }
  } else {
    newSlide = activeSlide.next('.slide');
    if (newSlide.length === 0) {
      newSlide = slides.filter('.slide').first();
    }
  }

  slideshowSwitch(slideshow, newSlide.index(), auto);
}

/**
* loader on slider nav
*/
function sliderNavloader() {
  if($('.page.is-active').length > 0) {
    var $self = $('.page.is-active i');
    $self.addClass('is-animating');

    TweenMax.fromTo($self, 4, { x: '-100%' }, { x: '0%', onComplete: function() {
      if(loaderAnim === true) {
        TweenMax.to($self, 1, { x: '101%', onComplete: function() {
          // TweenMax.to($self, 0, { x: '-101%' });
          $self.removeClass('is-animating');
        } });
      }
    }});
  }
}

sliderArrows(); 
sliderPages();  
homeSlider();
</script>