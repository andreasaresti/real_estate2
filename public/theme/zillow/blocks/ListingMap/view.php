<?php
$view = 'listings';
if (isset($_GET['view']) && $_GET['view'] == 'map') {
  $view = 'map';
}
$search_string = isset($_GET['search_term']) ? $_GET['search_term'] : '';
?>
<style id="server-styles">
  .hillcG {
    padding-top: 16px;
    display: flex;
    justify-content: center;
  }

  @media (max-width: 767px) {
    .hillcG {
      padding-top: 32px;
      display: block;
    }
  }

  @media (min-width: 1024px) {
    .dYKHqd {
      margin: 0px 64px;
      padding: 16px 0px;
    }
  }

  @media (min-width: 481px) {
    .dYKHqd {
      padding: 24px;
    }
  }

  .dYKHqd {
    position: relative;
    margin: 0px;
    padding: 8px;
    max-width: 1200px;
  }

  .fzcEtz {
    position: relative;
  }

  .csbCrt {
    -webkit-box-align: center;
    align-items: center;
    display: grid;
    grid-auto-flow: column;
    gap: 32px;
    -webkit-box-pack: justify;
    justify-content: space-between;
    padding-bottom: 8px;
  }

  .ePquwb {
    color: rgb(42, 42, 51);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 20px;
    line-height: 24px;
    margin: 0px;
  }

  .igsftj {
    padding-left: 0px;
    padding-bottom: 8px;
  }

  .UTDEG {
    color: rgb(89, 107, 130);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 14px;
    line-height: 24px;
    margin: 0px;
  }

  .epIOEX {
    display: grid;
    grid-auto-flow: column;
    column-gap: 16px;
    -webkit-box-align: start;
    align-items: start;
  }

  .duGlvB,
  .duGlvB:focus,
  .duGlvB:visited,
  .duGlvB:disabled {
    background-color: rgb(255, 255, 255);
    border-color: rgb(167, 166, 171);
    color: rgb(42, 42, 51);
  }

  .duGlvB {
    text-decoration: none;
    text-align: center;
    box-sizing: border-box;
    border: 1px solid;
    user-select: none;
    margin: 0px;
    appearance: none;
    transition-property: background-color, border-color, color;
    transition-duration: 0.2s;
    transition-timing-function: ease;
    pointer-events: none;
    outline: none;
    box-shadow: none;
    position: relative;
    color: rgb(42, 42, 51);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 14px;
    cursor: default;
    opacity: 0.4;
    line-height: 24px;
    height: 36px;
    width: 36px;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    padding: 16px;
    border-radius: 50%;
  }

  .gWORaQ {
    border: 0px;
    clip: rect(0px, 0px, 0px, 0px);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0px;
    position: absolute;
    width: 1px;
  }

  .duGlvB span>.Icon-c11n-8-86-1__sc-13llmml-0 {
    display: block;
    height: 16px;
    width: 16px;
  }

  svg:not(:root) {
    overflow: hidden;
  }

  .dorJJN {
    transform: rotate(90deg);
  }

  .drKbVK {
    display: inline-block;
    vertical-align: top;
    stroke: currentcolor;
    fill: currentcolor;
    height: 1em;
    width: 1em;
  }

  .drKbVK {
    display: inline-block;
    vertical-align: top;
    stroke: currentColor;
    fill: currentColor;
    height: 1em;
    width: 1em;
  }

  @media not all and (min-width: 1024px) {
    .dYKHqd .StyledIconButton-c11n-8-86-1__sc-1pb8vz8-0 {
      display: none;
    }
  }

  .hmUpGi,
  .hmUpGi:focus,
  .hmUpGi:visited,
  .hmUpGi:disabled {
    background-color: rgb(255, 255, 255);
    border-color: rgb(167, 166, 171);
    color: rgb(42, 42, 51);
  }

  .hmUpGi {
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    box-sizing: border-box;
    border: 1px solid;
    user-select: none;
    margin: 0px;
    appearance: none;
    transition-property: background-color, border-color, color;
    transition-duration: 0.2s;
    transition-timing-function: ease;
    pointer-events: auto;
    outline: none;
    box-shadow: none;
    position: relative;
    color: rgb(42, 42, 51);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 14px;
    line-height: 24px;
    height: 36px;
    width: 36px;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    padding: 16px;
    border-radius: 50%;
  }

  .gWORaQ {
    border: 0px;
    clip: rect(0px, 0px, 0px, 0px);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0px;
    position: absolute;
    width: 1px;
  }

  .hmUpGi span>.Icon-c11n-8-86-1__sc-13llmml-0 {
    display: block;
    height: 16px;
    width: 16px;
  }

  svg:not(:root) {
    overflow: hidden;
  }

  .hNirKi {
    transform: rotate(270deg);
  }

  .drKbVK {
    display: inline-block;
    vertical-align: top;
    stroke: currentcolor;
    fill: currentcolor;
    height: 1em;
    width: 1em;
  }

  .drKbVK {
    display: inline-block;
    vertical-align: top;
    stroke: currentColor;
    fill: currentColor;
    height: 1em;
    width: 1em;
  }

  .gzQgew {
    border: 0px;
    clip: rect(0px, 0px, 0px, 0px);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0px;
    position: absolute;
    width: 1px;
  }

  .ifquJH,
  .ifquJH:focus {
    color: rgb(13, 69, 153);
  }

  .ifquJH {
    cursor: pointer;
    font-family: inherit;
    font-size: inherit;
    font-weight: inherit;
    line-height: inherit;
    text-decoration: underline;
    outline: none;
    box-shadow: none;
  }

  .biRucK {
    color: rgb(13, 69, 153);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    margin: 0px;
  }

  .gzQgew {
    border: 0px;
    clip: rect(0px, 0px, 0px, 0px);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0px;
    position: absolute;
    width: 1px;
  }

  .ifquJH,
  .ifquJH:focus {
    color: rgb(13, 69, 153);
  }

  .ifquJH {
    cursor: pointer;
    font-family: inherit;
    font-size: inherit;
    font-weight: inherit;
    line-height: inherit;
    text-decoration: underline;
    outline: none;
    box-shadow: none;
  }

  .biRucK {
    color: rgb(13, 69, 153);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    margin: 0px;
  }

  .ezBqUT {
    display: flex;
    gap: 16px;
  }

  @media (min-width: 769px) {
    .fjalgP {
      scroll-snap-type: x mandatory;
      scroll-behavior: smooth;
    }
  }

  .fjalgP {
    list-style: none;
    margin: 0px;
    flex-wrap: nowrap;
    overflow-x: auto;
    scroll-snap-type: none;
    scroll-behavior: smooth;
    padding: 8px 8px 18px;
    scroll-padding: 0px 8px;
  }

  .ijLCEg {
    -webkit-box-flex: 0;
    flex: 0 0 345px;
    scroll-snap-align: start;
    position: relative;
    display: inline-block;
  }

  .bnlSnT {
    height: 100%;
    max-width: 386px;
    min-width: 286px;
  }

  .bnlSnT .StyledPropertyCardBody-c11n-8-86-1__sc-1p5uux3-0 {
    display: grid;
    grid-template-areas:
      "photo"
      "data"
      "flex";
    grid-template-rows: 149px 134px auto;
    height: 100%;
    padding: 0px;
    -webkit-tap-highlight-color: transparent;
  }

  .ffvFdw {
    border-radius: 4px;
  }

  @media (min-width: 481px) {
    .dVWlBO {
      border-radius: 4px;
    }
  }

  .dVWlBO {
    padding: 16px;
    background-color: rgb(255, 255, 255);
    cursor: pointer;
    outline: none;
    position: relative;
    transition-property: background-color, box-shadow;
    transition-duration: 0.2s;
    transition-timing-function: ease;
    border: 0px solid rgb(209, 209, 213);
    box-shadow: rgba(0, 0, 0, 0.3) 0px 2px 4px 0px;
  }

  .bnlSnT .StyledPropertyCardDataWrapper-c11n-8-86-1__sc-1omp4c3-0 {
    padding: 8px;
  }

  .daWIrq {
    place-content: start space-between;
    display: grid;
    grid-area: data / data / data / data;
    column-gap: 8px;
    grid-template-areas:
      "title title actions"
      "body1 body1 body1"
      "body2 body2 body2"
      "body3 mls-logo mls-logo"
      "additionalInfo additionalInfo additionalInfo";
    grid-template-columns: 1fr min-content;
    -webkit-box-pack: justify;
  }

  .zybOF {
    grid-area: title / title / title / title;
    color: rgb(42, 42, 51);
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 20px;
    line-height: 24px;
  }

  .bLsshH {
    grid-area: body1 / body1 / body1 / body1;
    color: rgb(42, 42, 51);
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 14px;
    line-height: 24px;
  }

  .dYKHqd li>article a:visited {
    color: rgb(10, 10, 20);
  }

  .zsg-link:visited,
  .zsg-link_primary:visited,
  a:visited {
    color: #7a48d6;
  }

  .bWMoAg {
    grid-area: body2 / body2 / body2 / body2;
    color: rgb(42, 42, 51);
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 14px;
    line-height: 24px;
  }

  .bWMoAg address {
    font-style: normal;
  }

  .cuZKL {
    grid-area: additionalInfo / additionalInfo / additionalInfo / additionalInfo;
    color: rgb(89, 107, 130);
    display: -webkit-box;
    -webkit-line-clamp: initial;
    -webkit-box-orient: vertical;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 10px;
    line-height: 16px;
  }

  .gUZfaS {
    grid-area: actions / actions / actions / actions;
    display: grid;
    grid-auto-flow: column;
    column-gap: 16px;
    -webkit-box-pack: end;
    justify-content: end;
  }

  .jBRDYV {
    display: grid;
    grid-area: photo / photo / photo / photo;
    grid-template-areas:
      "photo-top"
      "photo-center"
      "photo-bottom";
    grid-template-rows: auto 1fr auto;
    border-radius: 4px;
  }

  .gGpqXV {
    grid-area: photo-top / photo-top / photo-top / photo-top;
    height: 0px;
    margin-top: 8px;
    padding: 0px 8px;
    z-index: 1;
    display: grid;
    grid-auto-flow: column;
    gap: 16px;
    -webkit-box-pack: justify;
    justify-content: space-between;
  }

  .OPwBD {
    display: grid;
    grid-auto-flow: column;
    column-gap: 4px;
    -webkit-box-align: start;
    align-items: start;
  }

  .kMnzOu {
    display: grid;
    grid-auto-flow: column;
    column-gap: 16px;
    margin-top: -8px;
    margin-right: -8px;
  }

  .dsoFUX.dsoFUX.dsoFUX {
    background-color: transparent;
    border: 0px;
    padding: 8px 8px 16px 16px;
  }

  .YDAbE,
  .YDAbE:focus,
  .YDAbE:visited,
  .YDAbE:disabled {
    background-color: rgb(255, 255, 255);
    border-color: rgb(167, 166, 171);
    color: rgb(42, 42, 51);
    outline: 0px;
  }

  .YDAbE {
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    display: inline-flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    box-sizing: border-box;
    border: 1px solid;
    border-radius: 4px;
    user-select: none;
    padding: 15px 16px;
    margin: 0px;
    appearance: none;
    transition-property: background-color, border-color, color;
    transition-duration: 0.2s;
    transition-timing-function: ease;
    pointer-events: auto;
    outline: none;
    box-shadow: none;
    width: auto;
    position: relative;
    color: rgb(42, 42, 51);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px;
    height: auto;
  }

  .dsoFUX .StyledButtonIcon-c11n-8-86-1__sc-wpcbcc-1 {
    filter: drop-shadow(rgba(0, 0, 0, 0.3) 0px 2px 4px);
    height: 32px;
    margin-right: 0px;
    width: 32px;
  }

  .fGXTKq {
    margin-right: 8px;
  }

  .elHFdM {
    grid-area: 1 / 1 / -1 / -1;
  }

  .dYKHqd li>article a:visited {
    color: rgb(10, 10, 20);
  }

  .ifquJH:visited {
    color: rgb(91, 51, 173);
  }

  .zsg-link:visited,
  .zsg-link_primary:visited,
  a:visited {
    color: #7a48d6;
  }

  .ifquJH,
  .ifquJH:focus {
    color: rgb(13, 69, 153);
  }

  .ifquJH {
    cursor: pointer;
    font-family: inherit;
    font-size: inherit;
    font-weight: inherit;
    line-height: inherit;
    text-decoration: underline;
    outline: none;
    box-shadow: none;
  }

  .kPCjYF {
    grid-area: photo-bottom / photo-bottom / photo-bottom / photo-bottom;
    justify-self: flex-end;
    z-index: 1;
  }

  .bGxHGW {
    border-radius: 4px 4px 0px 0px;
    height: 100%;
    overflow: hidden;
    position: relative;
    z-index: 0;
    background-color: rgb(246, 246, 250);
  }

  .bGxHGW .Image-c11n-8-86-1__sc-1rtmhsc-0 {
    object-fit: cover;
    width: 100%;
    height: 0px;
    min-height: 100%;
  }

  .dsoFUX .StyledButtonIcon-c11n-8-86-1__sc-wpcbcc-1 .HeartIcon__fill {
    fill: rgba(0, 0, 0, 0.5);
  }

  .dsoFUX .StyledButtonIcon-c11n-8-86-1__sc-wpcbcc-1 .HeartIcon__outline {
    fill: rgb(255, 255, 255);
  }

  .bUuMXC {
    background-color: rgba(10, 10, 20, 0.6);
    border-radius: 999px;
    color: rgb(255, 255, 255);
    display: inline-block;
    padding: 2px 8px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 12px;
    line-height: 16px;
  }

  .ebUkxz:not(:last-child)::after,
  .ebUkxz span:not(:last-child)::after {
    content: " | ";
    color: rgb(167, 166, 171);
  }

  .fjalgP::-webkit-scrollbar {
    display: none;
  }

  .hmUpGi span>.Icon-c11n-8-86-1__sc-13llmml-0 {
    display: block;
    height: 16px;
    width: 16px;
  }

  svg:not(:root) {
    overflow: hidden;
  }

  .dorJJN {
    transform: rotate(90deg);
  }

  .drKbVK {
    display: inline-block;
    vertical-align: top;
    stroke: currentcolor;
    fill: currentcolor;
    height: 1em;
    width: 1em;
  }

  .drKbVK {
    display: inline-block;
    vertical-align: top;
    stroke: currentColor;
    fill: currentColor;
    height: 1em;
    width: 1em;
  }
</style>
<style data-styled="" data-styled-version="5.3.6">
  .jhZWWg {
    display: inline-block;
    vertical-align: top;
    stroke: currentColor;
    fill: currentColor;
    height: 1em;
    width: 1em;
  }

  /*!sc*/
  .dhKghj {
    display: inline-block;
    vertical-align: top;
    stroke: currentColor;
    fill: currentColor;
    height: 1em;
    width: 1em;
    height: 16px;
    width: 16px;
  }

  /*!sc*/
  .guRJEn {
    display: inline-block;
    vertical-align: top;
    stroke: currentColor;
    fill: currentColor;
    height: 1em;
    width: 1em;
    height: 32px;
    width: 32px;
  }

  /*!sc*/
  data-styled.g3[id="Icon-c11n-8-84-3__sc-13llmml-0"] {
    content: "jhZWWg,dhKghj,guRJEn,";
  }

  /*!sc*/
  .dMdpZN {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
  }

  /*!sc*/
  data-styled.g4[id="Flex-c11n-8-84-3__sc-n94bjd-0"] {
    content: "dMdpZN,";
  }

  /*!sc*/
  .hZKKuV {
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 14px;
    line-height: 24px;
    margin: 0;
  }

  /*!sc*/
  .hZKKuV>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 5px;
  }

  /*!sc*/
  .hZKKuV strong,
  .hZKKuV b {
    font-weight: 700;
  }

  /*!sc*/
  .hZKKuV em,
  .hZKKuV i {
    font-style: italic;
  }

  /*!sc*/
  .hrfydd {
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    margin: 0;
  }

  /*!sc*/
  .hrfydd>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 4px;
  }

  /*!sc*/
  .hrfydd strong,
  .hrfydd b {
    font-weight: 700;
  }

  /*!sc*/
  .hrfydd em,
  .hrfydd i {
    font-style: italic;
  }

  /*!sc*/
  .emeCAj {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 12px;
    line-height: 16px;
    margin: 0;
    margin-bottom: 16px;
  }

  /*!sc*/
  .emeCAj>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 2px;
  }

  /*!sc*/
  .emeCAj strong,
  .emeCAj b {
    font-weight: 700;
  }

  /*!sc*/
  .emeCAj em,
  .emeCAj i {
    font-style: italic;
  }

  /*!sc*/
  .fXAaOU {
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 12px;
    line-height: 16px;
    margin: 0;
    margin-bottom: 16px;
  }

  /*!sc*/
  .fXAaOU>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 2px;
  }

  /*!sc*/
  .fXAaOU strong,
  .fXAaOU b {
    font-weight: 700;
  }

  /*!sc*/
  .fXAaOU em,
  .fXAaOU i {
    font-style: italic;
  }

  /*!sc*/
  .khvZyS {
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 12px;
    line-height: 16px;
    margin: 0;
  }

  /*!sc*/
  .khvZyS>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 2px;
  }

  /*!sc*/
  .khvZyS strong,
  .khvZyS b {
    font-weight: 700;
  }

  /*!sc*/
  .khvZyS em,
  .khvZyS i {
    font-style: italic;
  }

  /*!sc*/
  .iFgVrh {
    color: #54545a;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 10px;
    line-height: 16px;
    margin: 0;
  }

  /*!sc*/
  .iFgVrh>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 3px;
  }

  /*!sc*/
  .iFgVrh strong,
  .iFgVrh b {
    font-weight: 700;
  }

  /*!sc*/
  .iFgVrh em,
  .iFgVrh i {
    font-style: italic;
  }

  /*!sc*/
  data-styled.g5[id="Text-c11n-8-84-3__sc-aiai24-0"] {
    content: "hZKKuV,hrfydd,emeCAj,fXAaOU,khvZyS,iFgVrh,";
  }

  /*!sc*/
  .kxrUt {
    cursor: pointer;
    font-family: inherit;
    font-size: inherit;
    font-weight: inherit;
    line-height: inherit;
    -webkit-text-decoration: underline;
    text-decoration: underline;
    outline: none;
    box-shadow: none;
  }

  /*!sc*/
  .kxrUt:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .kxrUt:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .kxrUt,
  .kxrUt:focus {
    color: #0d4599;
  }

  /*!sc*/
  .kxrUt:visited {
    color: #5b33ad;
  }

  /*!sc*/
  @media (hover: hover) and (pointer: fine) {
    .kxrUt:hover:not(:disabled) {
      color: #001751;
    }
  }

  /*!sc*/
  .kxrUt:active {
    color: #001751;
  }

  /*!sc*/
  data-styled.g8[id="Anchor-c11n-8-84-3__sc-hn4bge-0"] {
    content: "kxrUt,";
  }

  /*!sc*/
  .iZyVOm {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: auto;
    margin: 0;
    padding-left: 16px;
    padding-right: 16px;
    background-color: #f6f6fa;
    border: 1px solid;
    border-color: #d1d1d5;
    border-radius: 4px;
    box-sizing: border-box;
    caret-color: #006aff;
    cursor: text;
    outline: none;
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    padding-top: 9px;
    padding-bottom: 9px;
    line-height: 24px;
    height: auto;
    color: #54545a;
    width: auto;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  /*!sc*/
  .iZyVOm[disabled] {
    background-color: #f6f6fa;
    border-color: #d1d1d5;
    color: #2a2a33;
  }

  /*!sc*/
  .iZyVOm::-webkit-input-placeholder {
    color: #596b82;
  }

  /*!sc*/
  .iZyVOm::-moz-placeholder {
    color: #596b82;
  }

  /*!sc*/
  .iZyVOm:-ms-input-placeholder {
    color: #596b82;
  }

  /*!sc*/
  .iZyVOm::placeholder {
    color: #596b82;
  }

  /*!sc*/
  .iZyVOm:-webkit-autofill {
    box-shadow: 0 0 0 1000px #e0f2ff inset;
  }

  /*!sc*/
  .iZyVOm.edge-autofilled {
    background-color: #e0f2ff !important;
  }

  /*!sc*/
  .iZyVOm:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .iZyVOm:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .iZyVOm:focus:-webkit-autofill {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff,
      0 0 0 1000px #e0f2ff inset;
  }

  /*!sc*/
  .iZyVOm:active:not([disabled]),
  .iZyVOm:focus {
    background-color: #fff;
  }

  /*!sc*/
  .iZyVOm:hover:not([disabled]),
  .iZyVOm:active:not([disabled]),
  .iZyVOm:focus {
    border-color: #006aff;
  }

  /*!sc*/
  .iZyVOm[aria-invalid="true"] {
    caret-color: #a3000b;
  }

  /*!sc*/
  .iZyVOm[aria-invalid="true"],
  .iZyVOm[aria-invalid="true"][disabled],
  .iZyVOm[aria-invalid="true"]:hover,
  .iZyVOm[aria-invalid="true"]:active,
  .iZyVOm[aria-invalid="true"]:focus {
    border-color: #a3000b;
  }

  /*!sc*/
  .iZyVOm[disabled] {
    cursor: default;
    opacity: 0.4;
  }

  /*!sc*/
  .iZyVOm[readonly] {
    background-color: transparent;
    padding-left: 0;
    padding-right: 0;
  }

  /*!sc*/
  .iZyVOm[readonly],
  .iZyVOm[readonly]:hover,
  .iZyVOm[readonly]:active,
  .iZyVOm[readonly]:focus {
    border-color: transparent;
  }

  /*!sc*/
  .iZyVOm[disabled] {
    color: #54545a;
  }

  /*!sc*/
  data-styled.g9[id="StyledAdornment-c11n-8-84-3__sc-1kerx9v-0"] {
    content: "iZyVOm,";
  }

  /*!sc*/
  .cmFlZW {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-left: 0;
  }

  /*!sc*/
  data-styled.g11[id="AdornmentRight-c11n-8-84-3__sc-1kerx9v-2"] {
    content: "cmFlZW,";
  }

  /*!sc*/
  .jJHVHJ {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 100%;
    margin: 0;
    padding-left: 16px;
    padding-right: 16px;
    background-color: #f6f6fa;
    border: 1px solid;
    border-color: #d1d1d5;
    border-radius: 4px;
    box-sizing: border-box;
    caret-color: #006aff;
    cursor: text;
    outline: none;
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    padding-top: 9px;
    padding-bottom: 9px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .jJHVHJ[disabled] {
    background-color: #f6f6fa;
    border-color: #d1d1d5;
    color: #2a2a33;
  }

  /*!sc*/
  .jJHVHJ::-webkit-input-placeholder {
    color: #596b82;
  }

  /*!sc*/
  .jJHVHJ::-moz-placeholder {
    color: #596b82;
  }

  /*!sc*/
  .jJHVHJ:-ms-input-placeholder {
    color: #596b82;
  }

  /*!sc*/
  .jJHVHJ::placeholder {
    color: #596b82;
  }

  /*!sc*/
  .jJHVHJ:-webkit-autofill {
    box-shadow: 0 0 0 1000px #e0f2ff inset;
  }

  /*!sc*/
  .jJHVHJ.edge-autofilled {
    background-color: #e0f2ff !important;
  }

  /*!sc*/
  .jJHVHJ:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .jJHVHJ:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .jJHVHJ:focus:-webkit-autofill {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff,
      0 0 0 1000px #e0f2ff inset;
  }

  /*!sc*/
  .jJHVHJ:active:not([disabled]),
  .jJHVHJ:focus {
    background-color: #fff;
  }

  /*!sc*/
  .jJHVHJ:hover:not([disabled]),
  .jJHVHJ:active:not([disabled]),
  .jJHVHJ:focus {
    border-color: #006aff;
  }

  /*!sc*/
  .jJHVHJ[aria-invalid="true"] {
    caret-color: #a3000b;
  }

  /*!sc*/
  .jJHVHJ[aria-invalid="true"],
  .jJHVHJ[aria-invalid="true"][disabled],
  .jJHVHJ[aria-invalid="true"]:hover,
  .jJHVHJ[aria-invalid="true"]:active,
  .jJHVHJ[aria-invalid="true"]:focus {
    border-color: #a3000b;
  }

  /*!sc*/
  .jJHVHJ[disabled] {
    cursor: default;
    opacity: 0.4;
  }

  /*!sc*/
  .jJHVHJ[readonly] {
    background-color: transparent;
    padding-left: 0;
    padding-right: 0;
  }

  /*!sc*/
  .jJHVHJ[readonly],
  .jJHVHJ[readonly]:hover,
  .jJHVHJ[readonly]:active,
  .jJHVHJ[readonly]:focus {
    border-color: transparent;
  }

  /*!sc*/
  data-styled.g13[id="Input-c11n-8-84-3__sc-4ry0fw-0"] {
    content: "jJHVHJ,";
  }

  /*!sc*/
  .dbgRAU {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
  }

  /*!sc*/
  .dbgRAU>.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0 {
    -webkit-flex: 0 0 auto;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
  }

  /*!sc*/
  .dbgRAU>.AdornmentLeft-c11n-8-84-3__sc-1kerx9v-1 {
    -webkit-order: -1;
    -ms-flex-order: -1;
    order: -1;
  }

  /*!sc*/
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0 {
    min-width: 0;
  }

  /*!sc*/
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0:-webkit-autofill~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0 {
    box-shadow: 0 0 0 1000px #e0f2ff inset;
  }

  /*!sc*/
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0.edge-autofilled~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0 {
    background-color: #e0f2ff;
  }

  /*!sc*/
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0:active:not([disabled])~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0,
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0:focus~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0 {
    background-color: #fff;
  }

  /*!sc*/
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0:hover:not([disabled])~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0,
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0:active:not([disabled])~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0,
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0:focus~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0 {
    border-color: #006aff;
  }

  /*!sc*/
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0:focus {
    box-shadow: none;
  }

  /*!sc*/
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0:focus:-webkit-autofill {
    box-shadow: 0 0 0 1000px #e0f2ff inset;
  }

  /*!sc*/
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0[disabled]~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0 {
    cursor: default;
    opacity: 0.4;
  }

  /*!sc*/
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0[disabled]~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0,
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0[disabled]~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0:hover,
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0[disabled]~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0:active,
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0[disabled]~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0:focus {
    background-color: #f6f6fa;
    border-color: #d1d1d5;
  }

  /*!sc*/
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0[readonly]~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0,
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0[readonly]:hover~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0,
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0[readonly]:active~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0,
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0[readonly]:focus~.StyledAdornment-c11n-8-84-3__sc-1kerx9v-0 {
    background-color: transparent;
    border-color: transparent;
  }

  /*!sc*/
  .dbgRAU:focus-within {
    border-radius: 4px;
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  .dbgRAU>.Input-c11n-8-84-3__sc-4ry0fw-0 {
    padding-right: 0;
    border-right: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }

  /*!sc*/
  data-styled.g14[id="StyledAdornedInput-c11n-8-84-3__sc-1kgphdl-0"] {
    content: "dbgRAU,";
  }

  /*!sc*/
  .fXPeRZ {
    -webkit-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
  }

  /*!sc*/
  data-styled.g43[id="IconChevronLeft-c11n-8-84-3__sc-ddr5cu-0"] {
    content: "fXPeRZ,";
  }

  /*!sc*/
  .dUtfpm {
    -webkit-transform: rotate(270deg);
    -ms-transform: rotate(270deg);
    transform: rotate(270deg);
  }

  /*!sc*/
  data-styled.g47[id="IconChevronRight-c11n-8-84-3__sc-19mpgrq-0"] {
    content: "dUtfpm,";
  }

  /*!sc*/
  .bVdHxJ {
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 14px;
    line-height: 24px;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    outline: none;
    box-shadow: none;
    border: 0;
    background: none;
    padding: 0;
    text-align: initial;
    -webkit-appearance: none;
  }

  /*!sc*/
  .bVdHxJ>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 5px;
  }

  /*!sc*/
  .bVdHxJ,
  .bVdHxJ:active {
    color: #2a2a33;
    -webkit-text-decoration: none;
    text-decoration: none;
  }

  /*!sc*/
  @media (hover: hover) and (pointer: fine) {
    .bVdHxJ:hover:not(:disabled) {
      -webkit-text-decoration: underline;
      text-decoration: underline;
    }
  }

  /*!sc*/
  .bVdHxJ:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .bVdHxJ:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .bVdHxJ:not(:disabled) {
    cursor: pointer;
  }

  /*!sc*/
  .GpNxo {
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 14px;
    line-height: 24px;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    outline: none;
    box-shadow: none;
    border: 0;
    background: none;
    padding: 0;
    text-align: initial;
    -webkit-appearance: none;
  }

  /*!sc*/
  .GpNxo>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 5px;
  }

  /*!sc*/
  .GpNxo,
  .GpNxo:active {
    color: #0d4599;
    -webkit-text-decoration: none;
    text-decoration: none;
  }

  /*!sc*/
  @media (hover: hover) and (pointer: fine) {
    .GpNxo:hover:not(:disabled) {
      -webkit-text-decoration: underline;
      text-decoration: underline;
    }
  }

  /*!sc*/
  .GpNxo:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .GpNxo:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .GpNxo:not(:disabled) {
    cursor: pointer;
  }

  /*!sc*/
  data-styled.g70[id="StyledTextButton-c11n-8-84-3__sc-n1gfmh-0"] {
    content: "bVdHxJ,GpNxo,";
  }

  /*!sc*/
  .iorzBq {
    border: 0;
    -webkit-clip: rect(0 0 0 0);
    clip: rect(0 0 0 0);
    -webkit-clip-path: rect(0 0 0 0);
    clip-path: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }

  /*!sc*/
  data-styled.g77[id="VisuallyHidden-c11n-8-84-3__sc-t8tewe-0"] {
    content: "iorzBq,";
  }

  /*!sc*/
  .cRyIQp {
    cursor: pointer;
    -webkit-text-decoration: none;
    text-decoration: none;
    text-align: center;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    box-sizing: border-box;
    border: 1px solid;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding-left: 16px;
    padding-right: 16px;
    margin: 0;
    -webkit-appearance: none;
    -webkit-transition-property: background-color, border-color, color;
    transition-property: background-color, border-color, color;
    -webkit-transition-duration: 0.2s;
    transition-duration: 0.2s;
    -webkit-transition-timing-function: ease;
    transition-timing-function: ease;
    pointer-events: auto;
    outline: none;
    box-shadow: none;
    width: auto;
    position: relative;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 14px;
    line-height: 24px;
    padding-top: 5px;
    padding-bottom: 5px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .cRyIQp:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .cRyIQp:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .cRyIQp,
  .cRyIQp:focus,
  .cRyIQp:visited,
  .cRyIQp:disabled {
    background-color: #fff;
    border-color: #a7a6ab;
    color: #2a2a33;
  }

  /*!sc*/
  @media (hover: hover) and (pointer: fine) {
    .cRyIQp:hover:not(:disabled) {
      background-color: #f1f1f4;
      border-color: #a7a6ab;
      color: #2a2a33;
    }
  }

  /*!sc*/
  .cRyIQp[aria-pressed="true"][aria-pressed="true"] {
    background-color: #f2faff;
    border-color: #006aff;
    color: #2a2a33;
    border-width: 2px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 4px;
    padding-bottom: 4px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .cRyIQp:active:not(:disabled) {
    background-color: #d1d1d5;
    border-color: #54545a;
    color: #2a2a33;
  }

  /*!sc*/
  .cRyIQp:after {
    content: "";
    position: absolute;
    left: 0;
    height: 44px;
    min-width: 44px;
    width: 100%;
    top: 50%;
    margin-top: -22px;
  }

  /*!sc*/
  .cRyIQp>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 5px;
  }

  /*!sc*/
  .sbjHp {
    cursor: pointer;
    -webkit-text-decoration: none;
    text-decoration: none;
    text-align: center;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    box-sizing: border-box;
    border: 1px solid;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding-left: 16px;
    padding-right: 16px;
    margin: 0;
    -webkit-appearance: none;
    -webkit-transition-property: background-color, border-color, color;
    transition-property: background-color, border-color, color;
    -webkit-transition-duration: 0.2s;
    transition-duration: 0.2s;
    -webkit-transition-timing-function: ease;
    transition-timing-function: ease;
    pointer-events: auto;
    outline: none;
    box-shadow: none;
    width: auto;
    position: relative;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px;
    padding-top: 9px;
    padding-bottom: 9px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .sbjHp:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .sbjHp:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .sbjHp,
  .sbjHp:focus,
  .sbjHp:visited,
  .sbjHp:disabled {
    background-color: #fff;
    border-color: #006aff;
    color: #006aff;
  }

  /*!sc*/
  @media (hover: hover) and (pointer: fine) {
    .sbjHp:hover:not(:disabled) {
      background-color: #f2faff;
      border-color: #0d4599;
      color: #0d4599;
    }
  }

  /*!sc*/
  .sbjHp[aria-pressed="true"][aria-pressed="true"] {
    background-color: #001751;
    border-color: #001751;
    color: #fff;
    border-width: 2px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 8px;
    padding-bottom: 8px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .sbjHp:active:not(:disabled) {
    background-color: #e0f2ff;
    border-color: #001751;
    color: #001751;
  }

  /*!sc*/
  .sbjHp:after {
    content: "";
    position: absolute;
    left: 0;
    height: 44px;
    min-width: 44px;
    width: 100%;
    top: 50%;
    margin-top: -22px;
  }

  /*!sc*/
  .sbjHp>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 4px;
  }

  /*!sc*/
  .jftynW {
    cursor: pointer;
    -webkit-text-decoration: none;
    text-decoration: none;
    text-align: center;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    box-sizing: border-box;
    border: 1px solid;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding-left: 16px;
    padding-right: 16px;
    margin: 0;
    -webkit-appearance: none;
    -webkit-transition-property: background-color, border-color, color;
    transition-property: background-color, border-color, color;
    -webkit-transition-duration: 0.2s;
    transition-duration: 0.2s;
    -webkit-transition-timing-function: ease;
    transition-timing-function: ease;
    pointer-events: auto;
    outline: none;
    box-shadow: none;
    width: auto;
    position: relative;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px;
    padding-top: 9px;
    padding-bottom: 9px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .jftynW:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .jftynW:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .jftynW,
  .jftynW:focus,
  .jftynW:visited,
  .jftynW:disabled {
    background-color: #fff;
    border-color: #a7a6ab;
    color: #2a2a33;
  }

  /*!sc*/
  @media (hover: hover) and (pointer: fine) {
    .jftynW:hover:not(:disabled) {
      background-color: #f1f1f4;
      border-color: #a7a6ab;
      color: #2a2a33;
    }
  }

  /*!sc*/
  .jftynW[aria-pressed="true"][aria-pressed="true"] {
    background-color: #f2faff;
    border-color: #006aff;
    color: #2a2a33;
    border-width: 2px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 8px;
    padding-bottom: 8px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .jftynW:active:not(:disabled) {
    background-color: #d1d1d5;
    border-color: #54545a;
    color: #2a2a33;
  }

  /*!sc*/
  .jftynW:after {
    content: "";
    position: absolute;
    left: 0;
    height: 44px;
    min-width: 44px;
    width: 100%;
    top: 50%;
    margin-top: -22px;
  }

  /*!sc*/
  .jftynW>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 4px;
  }

  /*!sc*/
  .fDIxSu {
    cursor: pointer;
    -webkit-text-decoration: none;
    text-decoration: none;
    text-align: center;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    box-sizing: border-box;
    border: 1px solid;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding-left: 16px;
    padding-right: 16px;
    margin: 0;
    -webkit-appearance: none;
    -webkit-transition-property: background-color, border-color, color;
    transition-property: background-color, border-color, color;
    -webkit-transition-duration: 0.2s;
    transition-duration: 0.2s;
    -webkit-transition-timing-function: ease;
    transition-timing-function: ease;
    pointer-events: auto;
    outline: none;
    box-shadow: none;
    width: auto;
    position: relative;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px;
    padding-top: 15px;
    padding-bottom: 15px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .fDIxSu:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .fDIxSu:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .fDIxSu,
  .fDIxSu:focus,
  .fDIxSu:visited,
  .fDIxSu:disabled {
    background-color: #fff;
    border-color: #a7a6ab;
    color: #2a2a33;
  }

  /*!sc*/
  @media (hover: hover) and (pointer: fine) {
    .fDIxSu:hover:not(:disabled) {
      background-color: #f1f1f4;
      border-color: #a7a6ab;
      color: #2a2a33;
    }
  }

  /*!sc*/
  .fDIxSu[aria-pressed="true"][aria-pressed="true"] {
    background-color: #f2faff;
    border-color: #006aff;
    color: #2a2a33;
    border-width: 2px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 14px;
    padding-bottom: 14px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .fDIxSu:active:not(:disabled) {
    background-color: #d1d1d5;
    border-color: #54545a;
    color: #2a2a33;
  }

  /*!sc*/
  .fDIxSu:after {
    content: "";
    position: absolute;
    left: 0;
    height: 44px;
    min-width: 44px;
    width: 100%;
    top: 50%;
    margin-top: -22px;
  }

  /*!sc*/
  .fDIxSu>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 4px;
  }

  /*!sc*/
  .bGukyY {
    cursor: pointer;
    -webkit-text-decoration: none;
    text-decoration: none;
    text-align: center;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    box-sizing: border-box;
    border: 1px solid;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding-left: 16px;
    padding-right: 16px;
    margin: 0;
    -webkit-appearance: none;
    -webkit-transition-property: background-color, border-color, color;
    transition-property: background-color, border-color, color;
    -webkit-transition-duration: 0.2s;
    transition-duration: 0.2s;
    -webkit-transition-timing-function: ease;
    transition-timing-function: ease;
    pointer-events: none;
    outline: none;
    box-shadow: none;
    width: auto;
    position: relative;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px;
    cursor: default;
    opacity: 0.4;
    padding-top: 9px;
    padding-bottom: 9px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .bGukyY:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .bGukyY:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .bGukyY,
  .bGukyY:focus,
  .bGukyY:visited,
  .bGukyY:disabled {
    background-color: #fff;
    border-color: transparent;
    color: #2a2a33;
  }

  /*!sc*/
  @media (hover: hover) and (pointer: fine) {
    .bGukyY:hover:not(:disabled) {
      background-color: #f1f1f4;
      border-color: transparent;
      color: #2a2a33;
    }
  }

  /*!sc*/
  .bGukyY[aria-pressed="true"][aria-pressed="true"] {
    background-color: #f2faff;
    border-color: #006aff;
    color: #2a2a33;
    border-width: 2px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 8px;
    padding-bottom: 8px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .bGukyY:active:not(:disabled) {
    background-color: #d1d1d5;
    border-color: transparent;
    color: #2a2a33;
  }

  /*!sc*/
  .bGukyY:after {
    content: "";
    position: absolute;
    left: 0;
    height: 44px;
    min-width: 44px;
    width: 100%;
    top: 50%;
    margin-top: -22px;
  }

  /*!sc*/
  .bGukyY>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 4px;
  }

  /*!sc*/
  .dZFSon {
    cursor: pointer;
    -webkit-text-decoration: none;
    text-decoration: none;
    text-align: center;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    box-sizing: border-box;
    border: 1px solid;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding-left: 16px;
    padding-right: 16px;
    margin: 0;
    -webkit-appearance: none;
    -webkit-transition-property: background-color, border-color, color;
    transition-property: background-color, border-color, color;
    -webkit-transition-duration: 0.2s;
    transition-duration: 0.2s;
    -webkit-transition-timing-function: ease;
    transition-timing-function: ease;
    pointer-events: auto;
    outline: none;
    box-shadow: none;
    width: auto;
    position: relative;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px;
    padding-top: 9px;
    padding-bottom: 9px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .dZFSon:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .dZFSon:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .dZFSon,
  .dZFSon:focus,
  .dZFSon:visited,
  .dZFSon:disabled {
    background-color: #fff;
    border-color: transparent;
    color: #2a2a33;
  }

  /*!sc*/
  @media (hover: hover) and (pointer: fine) {
    .dZFSon:hover:not(:disabled) {
      background-color: #f1f1f4;
      border-color: transparent;
      color: #2a2a33;
    }
  }

  /*!sc*/
  .dZFSon[aria-pressed="true"][aria-pressed="true"] {
    background-color: #f2faff;
    border-color: #006aff;
    color: #2a2a33;
    border-width: 2px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 8px;
    padding-bottom: 8px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .dZFSon:active:not(:disabled) {
    background-color: #d1d1d5;
    border-color: transparent;
    color: #2a2a33;
  }

  /*!sc*/
  .dZFSon:after {
    content: "";
    position: absolute;
    left: 0;
    height: 44px;
    min-width: 44px;
    width: 100%;
    top: 50%;
    margin-top: -22px;
  }

  /*!sc*/
  .dZFSon>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 4px;
  }

  /*!sc*/
  data-styled.g83[id="StyledButton-c11n-8-84-3__sc-wpcbcc-0"] {
    content: "cRyIQp,sbjHp,jftynW,fDIxSu,bGukyY,dZFSon,";
  }

  /*!sc*/
  .rivHP {
    margin-left: 8px;
  }

  /*!sc*/
  .rivHP>.Icon-c11n-8-84-3__sc-13llmml-0 {
    display: block;
    height: 16px;
    width: 16px;
  }

  /*!sc*/
  .fZAMYU {
    margin-right: 8px;
  }

  /*!sc*/
  .fZAMYU>.Icon-c11n-8-84-3__sc-13llmml-0 {
    display: block;
    height: 24px;
    width: 24px;
  }

  /*!sc*/
  data-styled.g84[id="StyledButtonIcon-c11n-8-84-3__sc-wpcbcc-1"] {
    content: "rivHP,fZAMYU,";
  }

  /*!sc*/
  .fwdkPj {
    -webkit-animation: spin 0.5s linear infinite;
    animation: spin 0.5s linear infinite;
    color: #006aff;
  }

  /*!sc*/
  @-webkit-keyframes spin {
    0% {
      -webkit-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  /*!sc*/
  @keyframes spin {
    0% {
      -webkit-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  /*!sc*/
  data-styled.g85[id="StyledSpinner-c11n-8-84-3__sc-zhumcj-0"] {
    content: "fwdkPj,";
  }

  /*!sc*/
  .fgZjaL {
    cursor: pointer;
    -webkit-text-decoration: none;
    text-decoration: none;
    text-align: center;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    box-sizing: border-box;
    border: 1px solid;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding-left: 16px;
    padding-right: 16px;
    margin: 0;
    -webkit-appearance: none;
    -webkit-transition-property: background-color, border-color, color;
    transition-property: background-color, border-color, color;
    -webkit-transition-duration: 0.2s;
    transition-duration: 0.2s;
    -webkit-transition-timing-function: ease;
    transition-timing-function: ease;
    pointer-events: auto;
    outline: none;
    box-shadow: none;
    position: relative;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px;
    padding-top: 9px;
    padding-bottom: 9px;
    line-height: 24px;
    height: auto;
    height: 44px;
    width: 44px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 16px;
  }

  /*!sc*/
  .fgZjaL:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .fgZjaL:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .fgZjaL,
  .fgZjaL:focus,
  .fgZjaL:visited,
  .fgZjaL:disabled {
    background-color: transparent;
    border-color: #fff;
    color: #fff;
  }

  /*!sc*/
  @media (hover: hover) and (pointer: fine) {
    .fgZjaL:hover:not(:disabled) {
      background-color: #f1f1f4;
      border-color: #fff;
      color: #2a2a33;
    }
  }

  /*!sc*/
  .fgZjaL[aria-pressed="true"][aria-pressed="true"] {
    border-width: 2px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 8px;
    padding-bottom: 8px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .fgZjaL:active:not(:disabled) {
    background-color: #d1d1d5;
    border-color: #fff;
    color: #2a2a33;
  }

  /*!sc*/
  .fgZjaL:after {
    content: "";
    position: absolute;
    left: 0;
    height: 44px;
    min-width: 44px;
    width: 100%;
    top: 50%;
    margin-top: -22px;
  }

  /*!sc*/
  .fgZjaL>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 4px;
  }

  /*!sc*/
  .fgZjaL[aria-pressed="true"]:disabled {
    opacity: 1;
  }

  /*!sc*/
  .fgZjaL span>.Icon-c11n-8-84-3__sc-13llmml-0 {
    display: block;
    height: 24px;
    width: 24px;
  }

  /*!sc*/
  data-styled.g90[id="StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0"] {
    content: "fgZjaL,";
  }

  /*!sc*/
  .jZuLiI {
    padding: 16px;
    background-color: #fff;
    cursor: pointer;
    outline: none;
    position: relative;
    -webkit-transition-property: background-color, box-shadow;
    transition-property: background-color, box-shadow;
    -webkit-transition-duration: 0.2s;
    transition-duration: 0.2s;
    -webkit-transition-timing-function: ease;
    transition-timing-function: ease;
    border: 0 solid #d1d1d5;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.3);
  }

  /*!sc*/
  @media (min-width: 481px) {
    .jZuLiI {
      border-radius: 4px;
    }

    .jZuLiI:after {
      border-radius: 4px;
    }
  }

  /*!sc*/
  .jZuLiI:hover,
  .jZuLiI:active {
    background-color: #f2faff;
  }

  /*!sc*/
  .jZuLiI:after {
    border: 2px solid #006aff;
    content: "";
    display: none;
    pointer-events: none;
    position: absolute;
    speak: none;
    z-index: 1;
  }

  /*!sc*/
  .jZuLiI[aria-pressed="true"]:after {
    display: block;
  }

  /*!sc*/
  @media (prefers-reduced-motion: reduce) {
    .jZuLiI {
      -webkit-transition: none;
      transition: none;
    }
  }

  /*!sc*/
  .jZuLiI[aria-pressed="true"] {
    border-color: transparent;
  }

  /*!sc*/
  .jZuLiI:after {
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
  }

  /*!sc*/
  .jZuLiI:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);
  }

  /*!sc*/
  .jZuLiI:active:not(:has(:active)) {
    box-shadow: none;
  }

  /*!sc*/
  .jZuLiI:focus {
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.3), 0 0 0px 1px #fff,
      0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  .jZuLiI:focus:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 0 0px 1px #fff,
      0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  .jZuLiI:focus:active {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  .jZuLiI[aria-pressed="true"],
  .jZuLiI [aria-pressed="true"]:hover,
  .jZuLiI [aria-pressed="true"]:active {
    box-shadow: none;
  }

  /*!sc*/
  .jZuLiI[aria-pressed="true"]:focus,
  .jZuLiI [aria-pressed="true"]:focus:hover,
  .jZuLiI [aria-pressed="true"]:focus:active {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  data-styled.g92[id="StyledCard-c11n-8-84-3__sc-rmiu6p-0"] {
    content: "jZuLiI,";
  }

  /*!sc*/
  .eKUdID {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: auto;
    margin: 0;
    padding-left: 16px;
    padding-right: 16px;
    background-color: #f6f6fa;
    border: 1px solid;
    border-color: #d1d1d5;
    border-radius: 4px;
    box-sizing: border-box;
    caret-color: #006aff;
    cursor: text;
    outline: none;
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    padding-top: 9px;
    padding-bottom: 9px;
    line-height: 24px;
    height: auto;
    padding-right: 16px;
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding-top: 5px;
    padding-bottom: 5px;
    line-height: 24px;
    height: auto;
  }

  /*!sc*/
  .eKUdID[disabled] {
    background-color: #f6f6fa;
    border-color: #d1d1d5;
    color: #2a2a33;
  }

  /*!sc*/
  .eKUdID::-webkit-input-placeholder {
    color: #596b82;
  }

  /*!sc*/
  .eKUdID::-moz-placeholder {
    color: #596b82;
  }

  /*!sc*/
  .eKUdID:-ms-input-placeholder {
    color: #596b82;
  }

  /*!sc*/
  .eKUdID::placeholder {
    color: #596b82;
  }

  /*!sc*/
  .eKUdID:-webkit-autofill {
    box-shadow: 0 0 0 1000px #e0f2ff inset;
  }

  /*!sc*/
  .eKUdID.edge-autofilled {
    background-color: #e0f2ff !important;
  }

  /*!sc*/
  .eKUdID:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @supports not selector(:focus-visible) {
    .eKUdID:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  /*!sc*/
  .eKUdID:focus:-webkit-autofill {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff,
      0 0 0 1000px #e0f2ff inset;
  }

  /*!sc*/
  .eKUdID:active:not([disabled]),
  .eKUdID:focus {
    background-color: #fff;
  }

  /*!sc*/
  .eKUdID:hover:not([disabled]),
  .eKUdID:active:not([disabled]),
  .eKUdID:focus {
    border-color: #006aff;
  }

  /*!sc*/
  .eKUdID[aria-invalid="true"] {
    caret-color: #a3000b;
  }

  /*!sc*/
  .eKUdID[aria-invalid="true"],
  .eKUdID[aria-invalid="true"][disabled],
  .eKUdID[aria-invalid="true"]:hover,
  .eKUdID[aria-invalid="true"]:active,
  .eKUdID[aria-invalid="true"]:focus {
    border-color: #a3000b;
  }

  /*!sc*/
  .eKUdID[disabled] {
    cursor: default;
    opacity: 0.4;
  }

  /*!sc*/
  .eKUdID[readonly] {
    background-color: transparent;
    padding-left: 0;
    padding-right: 0;
  }

  /*!sc*/
  .eKUdID[readonly],
  .eKUdID[readonly]:hover,
  .eKUdID[readonly]:active,
  .eKUdID[readonly]:focus {
    border-color: transparent;
  }

  /*!sc*/
  .eKUdID:focus-within {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  .eKUdID:focus-within,
  .eKUdID:focus-within .Input-c11n-8-84-3__sc-4ry0fw-0,
  .eKUdID:active .Input-c11n-8-84-3__sc-4ry0fw-0 {
    background-color: #fff;
  }

  /*!sc*/
  .eKUdID.eKUdID {
    cursor: text;
  }

  /*!sc*/
  .eKUdID .Input-c11n-8-84-3__sc-4ry0fw-0 {
    border: 0;
    padding: 0;
    box-shadow: none;
    -webkit-flex: 1 0 25%;
    -ms-flex: 1 0 25%;
    flex: 1 0 25%;
    padding-top: 4px;
    padding-bottom: 4px;
    opacity: 1;
  }

  /*!sc*/
  .eKUdID>.StyledTagCloseButton-c11n-8-84-3__sc-11up5cg-0 {
    position: absolute;
    right: 16px;
    top: calc(50% - 8px);
  }

  /*!sc*/
  .eKUdID>.StyledTagCloseButton-c11n-8-84-3__sc-11up5cg-0 .Icon-c11n-8-84-3__sc-13llmml-0 {
    box-shadow: none;
  }

  /*!sc*/
  .eKUdID .StyledTag-c11n-8-84-3__sc-1945joc-0 {
    margin-right: 4px;
    margin-top: 2px;
    margin-bottom: 2px;
    cursor: default;
  }

  /*!sc*/
  .eKUdID .StyledTag-c11n-8-84-3__sc-1945joc-0:last-of-type {
    margin-right: 16px;
  }

  /*!sc*/
  .eKUdID .StyledTag-c11n-8-84-3__sc-1945joc-0+.ComboboxAdditional-c11n-8-84-3__sc-1xmrjr9-0 {
    margin-left: -12px;
    margin-right: 16px;
  }

  /*!sc*/
  .eKUdID .StyledListbox-c11n-8-84-3__sc-1vo0dzk-0 {
    border: 0;
  }

  /*!sc*/
  data-styled.g116[id="StyledComboboxInput-c11n-8-84-3__sc-vb87st-0"] {
    content: "eKUdID,";
  }

  /*!sc*/
  .hMWkrB {
    box-sizing: border-box;
    background-color: #fff;
    box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.3);
    outline: none;
    border-radius: 8px;
    position: relative;
    z-index: 100011;
    border-radius: 4px;
  }

  /*!sc*/
  .hMWkrB .DialogClose-c11n-8-84-3__sc-1t0puoj-0 {
    position: absolute;
    z-index: 100013;
  }

  /*!sc*/
  .hMWkrB .DialogLayout-c11n-8-84-3__sc-178ji0w-0 {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
  }

  /*!sc*/
  .hMWkrB .DialogHeader-c11n-8-84-3__sc-1nk3a2m-0 {
    -webkit-flex: 0 0 auto;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
  }

  /*!sc*/
  .hMWkrB .DialogBody-c11n-8-84-3__sc-dazfx6-0 {
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    padding: 12px 16px 0;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
  }

  /*!sc*/
  .hMWkrB .DialogBody-c11n-8-84-3__sc-dazfx6-0:after {
    content: "";
    display: block;
    height: 12px;
  }

  /*!sc*/
  .hMWkrB .DialogBody-c11n-8-84-3__sc-dazfx6-0>.StyledDropdownHeading-c11n-8-84-3__sc-dktrpd-0 {
    margin-left: -16px;
    margin-right: -16px;
  }

  /*!sc*/
  .hMWkrB .DialogBody-c11n-8-84-3__sc-dazfx6-0>.StyledDropdownHeading-c11n-8-84-3__sc-dktrpd-0:first-child {
    margin-top: -12px;
  }

  /*!sc*/
  .hMWkrB .DialogFooter-c11n-8-84-3__sc-1xigudn-0 {
    -webkit-flex: 0 0 auto;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    box-sizing: border-box;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: end;
    -webkit-justify-content: flex-end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    margin: 0;
    padding: 12px 16px;
  }

  /*!sc*/
  data-styled.g128[id="StyledDropdown-c11n-8-84-3__sc-lz45p2-0"] {
    content: "hMWkrB,";
  }

  /*!sc*/
  .ffAram {
    position: relative;
  }

  /*!sc*/
  .ffAram .StyledDropdown-c11n-8-84-3__sc-lz45p2-0 {
    width: 100%;
  }

  /*!sc*/
  .ffAram .StyledListbox-c11n-8-84-3__sc-1vo0dzk-0 {
    border: none;
  }

  /*!sc*/
  data-styled.g132[id="StyledCombobox-c11n-8-84-3__sc-rvbaft-0"] {
    content: "ffAram,";
  }

  /*!sc*/
  .bwbkLZ .StyledFormField-c11n-8-84-3__sc-24oslp-0:not(:last-child) {
    margin-bottom: 16px;
  }

  /*!sc*/
  .bwbkLZ .FormActions-c11n-8-84-3__sc-1h72c0a-0 {
    margin-top: 32px;
  }

  /*!sc*/
  data-styled.g152[id="Form-c11n-8-84-3__sc-iqxs9k-0"] {
    content: "bwbkLZ,";
  }

  /*!sc*/
  .iCyebE {
    margin: 0;
    padding-top: 8px;
    padding-bottom: 8px;
  }

  /*!sc*/
  data-styled.g163[id="ListItem-c11n-8-84-3__sc-10e22w8-0"] {
    content: "iCyebE,";
  }

  /*!sc*/
  .doa-doM {
    margin: 0;
    padding: 0;
    list-style: none;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
  }

  /*!sc*/
  .doa-doM>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 4px;
  }

  /*!sc*/
  data-styled.g164[id="List-c11n-8-84-3__sc-1smrmqp-0"] {
    content: "doa-doM,";
  }

  /*!sc*/
  .cTuauV {
    box-sizing: border-box;
    background-color: #fff;
    box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.3);
    outline: none;
    border-radius: 8px;
    position: relative;
    z-index: 100011;
    border-radius: 4px;
    min-width: 200px;
    max-width: 360px;
  }

  /*!sc*/
  .cTuauV .DialogClose-c11n-8-84-3__sc-1t0puoj-0 {
    position: absolute;
    z-index: 100013;
  }

  /*!sc*/
  .cTuauV .DialogLayout-c11n-8-84-3__sc-178ji0w-0 {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
  }

  /*!sc*/
  .cTuauV .DialogHeader-c11n-8-84-3__sc-1nk3a2m-0 {
    -webkit-flex: 0 0 auto;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
  }

  /*!sc*/
  .cTuauV .DialogBody-c11n-8-84-3__sc-dazfx6-0 {
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    padding: 12px 16px 0;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
  }

  /*!sc*/
  .cTuauV .DialogBody-c11n-8-84-3__sc-dazfx6-0:after {
    content: "";
    display: block;
    height: 12px;
  }

  /*!sc*/
  .cTuauV .DialogBody-c11n-8-84-3__sc-dazfx6-0>.StyledDropdownHeading-c11n-8-84-3__sc-dktrpd-0 {
    margin-left: -16px;
    margin-right: -16px;
  }

  /*!sc*/
  .cTuauV .DialogBody-c11n-8-84-3__sc-dazfx6-0>.StyledDropdownHeading-c11n-8-84-3__sc-dktrpd-0:first-child {
    margin-top: -12px;
  }

  /*!sc*/
  .cTuauV .DialogFooter-c11n-8-84-3__sc-1xigudn-0 {
    -webkit-flex: 0 0 auto;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    box-sizing: border-box;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: end;
    -webkit-justify-content: flex-end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    margin: 0;
    padding: 12px 16px;
  }

  /*!sc*/
  data-styled.g169[id="StyledMenu-c11n-8-84-3__sc-curt40-0"] {
    content: "cTuauV,";
  }

  /*!sc*/
  .gareYe {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100002;
    height: 100%;
    width: 100%;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    box-sizing: border-box;
    padding: 48px 16px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-animation: jBcSpD 0.3s ease-out;
    animation: jBcSpD 0.3s ease-out;
    padding: 48px 16px;
  }

  /*!sc*/
  .gareYe>.Mask-c11n-8-84-3__sc-1lyx31t-0 {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 1;
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
    z-index: 2;
    box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.3);
  }

  /*!sc*/
  @media (prefers-reduced-motion: reduce) {
    .gareYe {
      -webkit-animation: none;
      animation: none;
    }
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
    box-sizing: border-box;
    background-color: #fff;
    box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.3);
    outline: none;
    border-radius: 8px;
    position: relative;
    -webkit-animation: iGLmwX 0.3s ease-out;
    animation: iGLmwX 0.3s ease-out;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    height: auto;
    min-height: 0;
    width: 100%;
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogClose-c11n-8-84-3__sc-1t0puoj-0 {
    position: absolute;
    z-index: 100013;
  }

  /*!sc*/
  @media (prefers-reduced-motion: reduce) {
    .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
      -webkit-animation: none;
      animation: none;
    }
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogLayout-c11n-8-84-3__sc-178ji0w-0 {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    min-height: 100%;
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogHeader-c11n-8-84-3__sc-1nk3a2m-0 {
    border-bottom: 1px solid #d1d1d5;
    -webkit-flex: 0 0 auto;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    padding: 16px calc(16px + 32px);
    text-align: center;
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogHeader-c11n-8-84-3__sc-1nk3a2m-0 .Text-c11n-8-84-3__sc-aiai24-0 {
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 20px;
    line-height: 24px;
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogHeader-c11n-8-84-3__sc-1nk3a2m-0 .Text-c11n-8-84-3__sc-aiai24-0>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 2px;
  }

  /*!sc*/
  @media (max-width: 768px) {}

  /*!sc*/
  @media (min-width: 769px) {}

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogBody-c11n-8-84-3__sc-dazfx6-0 {
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    padding: 16px 16px 0;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    margin-top: 0;
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogBody-c11n-8-84-3__sc-dazfx6-0:after {
    content: "";
    display: block;
    height: 16px;
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogFooter-c11n-8-84-3__sc-1xigudn-0 {
    border-top: 1px solid #d1d1d5;
    -webkit-flex: 0 0 auto;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: end;
    -webkit-justify-content: flex-end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    padding: 16px;
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogClose-c11n-8-84-3__sc-1t0puoj-0 {
    top: 16px;
    right: 16px;
  }

  /*!sc*/
  .gareYe .Mask-c11n-8-84-3__sc-1lyx31t-0 {
    opacity: 1;
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
    max-height: 100%;
  }

  /*!sc*/
  _:-ms-fullscreen .StyledModalDialog-c11n-8-84-3__sc-ify1vj-0>.StyledDialog-c11n-8-84-3__sc-3phm7o-0,
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
    height: 100%;
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
    border-radius: 8px;
    min-height: 0;
  }

  /*!sc*/
  .gareYe .Mask-c11n-8-84-3__sc-1lyx31t-0 {
    opacity: 1;
  }

  /*!sc*/
  .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
    max-width: 360px;
  }

  /*!sc*/
  @media (max-width: 768px) {
    .gareYe {
      padding: 0;
    }

    .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
      border-radius: 0;
      min-height: 100%;
    }

    .gareYe .Mask-c11n-8-84-3__sc-1lyx31t-0 {
      opacity: 0;
    }

    .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
      max-width: 100%;
    }
  }

  /*!sc*/
  @media (min-width: 769px) {
    .gareYe {
      padding: 48px 16px;
    }

    .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
      border-radius: 8px;
      min-height: 0;
    }

    .gareYe .Mask-c11n-8-84-3__sc-1lyx31t-0 {
      opacity: 1;
    }

    .gareYe>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
      max-width: 360px;
    }
  }

  /*!sc*/
  data-styled.g176[id="StyledModalDialog-c11n-8-84-3__sc-ify1vj-0"] {
    content: "gareYe,";
  }

  /*!sc*/
  .wfluH {
    border-radius: 50%;
    height: 44px;
    width: 44px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 0;
  }

  /*!sc*/
  .wfluH,
  .wfluH:hover {
    -webkit-text-decoration: none;
    text-decoration: none;
  }

  /*!sc*/
  .wfluH[aria-pressed="true"]:disabled {
    opacity: 1;
  }

  /*!sc*/
  .wfluH .Icon-c11n-8-84-3__sc-13llmml-0 {
    margin: 0;
  }

  /*!sc*/
  data-styled.g182[id="PaginationButton-c11n-8-84-3__sc-si2hz6-0"] {
    content: "wfluH,";
  }

  /*!sc*/
  .jYkptH {
    margin: 0;
    padding: 0;
    list-style-type: none;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-flow: row;
    -ms-flex-flow: row;
    flex-flow: row;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
  }

  /*!sc*/
  data-styled.g183[id="PaginationList-c11n-8-84-3__sc-14rlw6v-0"] {
    content: "jYkptH,";
  }

  /*!sc*/
  .cA-Ddyj {
    display: block;
    margin: 0 2px;
  }

  /*!sc*/
  data-styled.g184[id="PaginationNumberItem-c11n-8-84-3__sc-bnmlxt-0"] {
    content: "cA-Ddyj,";
  }

  /*!sc*/
  .dxxKtQ>.Text-c11n-8-84-3__sc-aiai24-0 {
    text-align: center;
    display: inline-block;
  }

  /*!sc*/
  data-styled.g185[id="PaginationReadoutItem-c11n-8-84-3__sc-18an4gi-0"] {
    content: "dxxKtQ,";
  }

  /*!sc*/
  .jRUCrX {
    display: block;
    margin: 0 2px;
    margin: 0 8px;
  }

  /*!sc*/
  data-styled.g186[id="PaginationJumpItem-c11n-8-84-3__sc-18wdg2l-0"] {
    content: "jRUCrX,";
  }

  /*!sc*/
  .Mfmhy {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  /*!sc*/
  .Mfmhy .PaginationList-c11n-8-84-3__sc-14rlw6v-0 {
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
  }

  /*!sc*/
  .Mfmhy .PaginationNumberItem-c11n-8-84-3__sc-bnmlxt-0 {
    display: block;
  }

  /*!sc*/
  .Mfmhy .PaginationReadoutItem-c11n-8-84-3__sc-18an4gi-0 {
    display: none;
  }

  /*!sc*/
  data-styled.g187[id="StyledPagination-c11n-8-84-3__sc-2vwigm-0"] {
    content: "Mfmhy,";
  }

  /*!sc*/
  .gUGLkN {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100002;
    height: 100%;
    width: 100%;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    box-sizing: border-box;
    padding: 48px 16px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
    box-sizing: border-box;
    background-color: #fff;
    box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.3);
    outline: none;
    border-radius: 8px;
    position: relative;
    z-index: 100011;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    border-radius: 4px;
    width: 100%;
    max-width: 360px;
    max-height: 320px;
    -webkit-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogClose-c11n-8-84-3__sc-1t0puoj-0 {
    position: absolute;
    z-index: 100013;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogHeader-c11n-8-84-3__sc-1nk3a2m-0 {
    padding: 16px;
    padding-right: calc(16px + 32px);
    border-bottom: 1px solid #d1d1d5;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogHeader-c11n-8-84-3__sc-1nk3a2m-0 .Text-c11n-8-84-3__sc-aiai24-0 {
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogHeader-c11n-8-84-3__sc-1nk3a2m-0 .Text-c11n-8-84-3__sc-aiai24-0>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 4px;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogActions-c11n-8-84-3__sc-12igiol-0 {
    padding-top: 16px;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogBody-c11n-8-84-3__sc-dazfx6-0 {
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    padding: 16px 16px 0;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogBody-c11n-8-84-3__sc-dazfx6-0:after {
    content: "";
    display: block;
    height: 16px;
  }

  /*!sc*/
  _:-ms-fullscreen .StyledPopover-c11n-8-84-3__sc-gfe32q-0>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogBody-c11n-8-84-3__sc-dazfx6-0,
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogBody-c11n-8-84-3__sc-dazfx6-0 {
    -webkit-flex-basis: 150px;
    -ms-flex-preferred-size: 150px;
    flex-basis: 150px;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0:after {
    content: "";
    position: absolute;
    left: 16px;
    right: 16px;
    bottom: 0;
    height: 16px;
    background: linear-gradient(180deg,
        rgba(255, 255, 255, 0) 0%,
        #fff 100%);
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .DialogClose-c11n-8-84-3__sc-1t0puoj-0 {
    right: 16px;
    top: 16px;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 .PopoverArrow-c11n-8-84-3__sc-10mxq8o-0 {
    position: absolute;
    display: block;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0[data-popper-placement^="top"] .PopoverArrow-c11n-8-84-3__sc-10mxq8o-0 {
    bottom: -40px;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0[data-popper-placement^="right"] .PopoverArrow-c11n-8-84-3__sc-10mxq8o-0 {
    left: -40px;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0[data-popper-placement^="bottom"] .PopoverArrow-c11n-8-84-3__sc-10mxq8o-0 {
    top: -40px;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0[data-popper-placement^="left"] .PopoverArrow-c11n-8-84-3__sc-10mxq8o-0 {
    right: -40px;
  }

  /*!sc*/
  .gUGLkN>.Mask-c11n-8-84-3__sc-1lyx31t-0 {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 1;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
    z-index: 2;
    box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.3);
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
    -webkit-transform: none !important;
    -ms-transform: none !important;
    transform: none !important;
    position: relative !important;
  }

  /*!sc*/
  .gUGLkN>.StyledDialog-c11n-8-84-3__sc-3phm7o-0>.PopoverArrow-c11n-8-84-3__sc-10mxq8o-0 {
    display: none;
  }

  /*!sc*/
  data-styled.g190[id="StyledPopover-c11n-8-84-3__sc-gfe32q-0"] {
    content: "gUGLkN,";
  }

  /*!sc*/
  .ehTgwE {
    background-color: rgba(10, 10, 20, 0.6);
    border-radius: 999px;
    color: #fff;
    display: inline-block;
    padding: 2px 8px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 12px;
    line-height: 16px;
  }

  /*!sc*/
  .ehTgwE>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 2px;
  }

  /*!sc*/
  data-styled.g199[id="StyledPropertyCardBadge-c11n-8-84-3__sc-6gojrl-0"] {
    content: "ehTgwE,";
  }

  /*!sc*/
  .eclXWV {
    display: grid;
    grid-auto-flow: column;
    grid-column-gap: 4px;
    -webkit-align-items: start;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: start;
  }

  /*!sc*/
  data-styled.g200[id="StyledPropertyCardBadgeArea-c11n-8-84-3__sc-wncxdw-0"] {
    content: "eclXWV,";
  }

  /*!sc*/
  .gHYrNO {
    border-radius: 4px;
  }

  /*!sc*/
  data-styled.g201[id="StyledPropertyCardBody-c11n-8-84-3__sc-1p5uux3-0"] {
    content: "gHYrNO,";
  }

  /*!sc*/
  .jnnxAW {
    grid-area: body2;
    color: #2a2a33;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 14px;
    line-height: 24px;
  }

  /*!sc*/
  .jnnxAW address {
    font-style: normal;
  }

  /*!sc*/
  .jnnxAW>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 5px;
  }

  /*!sc*/
  .jretvB {
    grid-area: additionalInfo;
    color: #596b82;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 10px;
    line-height: 16px;
  }

  /*!sc*/
  .jretvB address {
    font-style: normal;
  }

  /*!sc*/
  .jretvB>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 3px;
  }

  /*!sc*/
  .fDSTNn {
    grid-area: title;
    color: #2a2a33;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 20px;
    line-height: 24px;
  }

  /*!sc*/
  .fDSTNn address {
    font-style: normal;
  }

  /*!sc*/
  .fDSTNn>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 2px;
  }

  /*!sc*/
  .dbDWjx {
    grid-area: body1;
    color: #2a2a33;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 14px;
    line-height: 24px;
  }

  /*!sc*/
  .dbDWjx address {
    font-style: normal;
  }

  /*!sc*/
  .dbDWjx>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 5px;
  }

  /*!sc*/
  data-styled.g202[id="StyledPropertyCardDataArea-c11n-8-84-3__sc-yipmu-0"] {
    content: "jnnxAW,jretvB,fDSTNn,dbDWjx,";
  }

  /*!sc*/
  .bKpguY {
    -webkit-align-content: start;
    -ms-flex-line-pack: start;
    align-content: start;
    display: grid;
    grid-area: data;
    grid-column-gap: 8px;
    grid-template-areas: "title title actions" "body1 body1 body1" "body2 body2 body2" "body3 mls-logo mls-logo" "additionalInfo additionalInfo additionalInfo";
    grid-template-columns: 1fr min-content;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
  }

  /*!sc*/
  data-styled.g203[id="StyledPropertyCardDataWrapper-c11n-8-84-3__sc-1omp4c3-0"] {
    content: "bKpguY,";
  }

  /*!sc*/
  .eYPFID {
    display: inline;
    list-style: none;
    margin: 0;
    padding: 0;
  }

  /*!sc*/
  .eYPFID li {
    display: inline;
  }

  /*!sc*/
  .eYPFID:not(:last-child):after,
  .eYPFID li:not(:last-child):after {
    content: " | ";
    color: #a7a6ab;
  }

  /*!sc*/
  data-styled.g206[id="StyledPropertyCardHomeDetailsList-c11n-8-84-3__sc-1xvdaej-0"] {
    content: "eYPFID,";
  }

  /*!sc*/
  .jdXSxA {
    display: grid;
    grid-area: mls-logo;
    justify-items: end;
    padding: 4px;
  }

  /*!sc*/
  .jdXSxA .Image-c11n-8-84-3__sc-1rtmhsc-0 {
    max-height: 23px;
    max-width: 100px;
  }

  /*!sc*/
  data-styled.g209[id="StyledPropertyCardMLSLogo-c11n-8-84-3__sc-1qtmyyt-0"] {
    content: "jdXSxA,";
  }

  /*!sc*/
  .dGCVxQ {
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0px;
    height: 100%;
    overflow: hidden;
    position: relative;
    z-index: 0;
    background-color: #f6f6fa;
  }

  /*!sc*/
  .dGCVxQ .Image-c11n-8-84-3__sc-1rtmhsc-0 {
    object-fit: cover;
    width: 100%;
    height: 0;
    min-height: 100%;
  }

  /*!sc*/
  .dGCVxQ .StyledPropertyCardPhotoFallback-c11n-8-84-3__sc-1dqhaip-0 {
    height: 70px;
    width: 70px;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate3d(-50%, -50%, 0);
    -ms-transform: translate3d(-50%, -50%, 0);
    transform: translate3d(-50%, -50%, 0);
  }

  /*!sc*/
  .dGCVxQ .StyledPropertyCardPhotoFallback-c11n-8-84-3__sc-1dqhaip-0 .Fallback__fill {
    fill: #dee3e6;
  }

  /*!sc*/
  data-styled.g211[id="StyledPropertyCardPhoto-c11n-8-84-3__sc-ormo34-0"] {
    content: "dGCVxQ,";
  }

  /*!sc*/
  .ipVPbe {
    grid-column: 1 / -1;
    grid-row: 1 / -1;
  }

  /*!sc*/
  data-styled.g212[id="StyledPropertyCardPhotoBody-c11n-8-84-3__sc-128t811-0"] {
    content: "ipVPbe,";
  }

  /*!sc*/
  .cxVwvQ {
    grid-area: photo-bottom;
    justify-self: flex-end;
    z-index: 1;
  }

  /*!sc*/
  data-styled.g213[id="StyledPropertyCardPhotoFooter-c11n-8-84-3__sc-bdiiml-0"] {
    content: "cxVwvQ,";
  }

  /*!sc*/
  .hanNNj {
    grid-area: photo-top;
    height: 0;
    margin-top: 8px;
    padding: 0 8px;
    z-index: 1;
    display: grid;
    grid-auto-flow: column;
    grid-gap: 16px;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
  }

  /*!sc*/
  data-styled.g214[id="StyledPropertyCardPhotoHeader-c11n-8-84-3__sc-10m3z6y-0"] {
    content: "hanNNj,";
  }

  /*!sc*/
  .ixPkIz {
    display: grid;
    grid-area: photo;
    grid-template-areas: "photo-top" "photo-center" "photo-bottom";
    grid-template-rows: auto 1fr auto;
    border-radius: 4px;
  }

  /*!sc*/
  data-styled.g215[id="StyledPropertyCardPhotoWrapper-c11n-8-84-3__sc-204bo4-0"] {
    content: "ixPkIz,";
  }

  /*!sc*/
  .eICrvR.eICrvR.eICrvR {
    background-color: transparent;
    border: 0;
    padding: 8px 8px 16px 16px;
  }

  /*!sc*/
  .eICrvR .StyledButtonIcon-c11n-8-84-3__sc-wpcbcc-1 {
    -webkit-filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    height: 32px;
    margin-right: 0;
    width: 32px;
  }

  /*!sc*/
  .eICrvR .StyledButtonIcon-c11n-8-84-3__sc-wpcbcc-1 .HeartIcon__outline {
    fill: #fff;
  }

  /*!sc*/
  .eICrvR .StyledButtonIcon-c11n-8-84-3__sc-wpcbcc-1 .HeartIcon__fill {
    fill: rgba(0, 0, 0, 0.5);
  }

  /*!sc*/
  .eICrvR:hover .HeartIcon__fill,
  .eICrvR:active .HeartIcon__fill,
  .eICrvR:focus .HeartIcon__fill {
    fill: rgba(0, 0, 0, 0.75);
  }

  /*!sc*/
  .eICrvR[aria-pressed="true"] .HeartIcon__fill,
  .eICrvR[aria-label="Unsave"] .HeartIcon__fill {
    fill: #fff;
  }

  /*!sc*/
  data-styled.g217[id="StyledPropertyCardSaveButton-c11n-8-84-3__sc-dquvr7-0"] {
    content: "eICrvR,";
  }

  /*!sc*/
  .kbUUtf {
    height: 100%;
    max-width: 386px;
    min-width: 286px;
  }

  /*!sc*/
  .kbUUtf .StyledPropertyCardBody-c11n-8-84-3__sc-1p5uux3-0 {
    display: grid;
    grid-template-areas: "photo" "data" "flex";
    grid-template-rows: 177px 1fr auto;
    height: 100%;
    padding: 0;
    -webkit-tap-highlight-color: transparent;
  }

  /*!sc*/
  .kbUUtf .StyledPropertyCardBody-c11n-8-84-3__sc-1p5uux3-0:hover,
  .kbUUtf .StyledPropertyCardBody-c11n-8-84-3__sc-1p5uux3-0:active {
    background-color: #fff;
  }

  /*!sc*/
  .kbUUtf .StyledPropertyCardBody-c11n-8-84-3__sc-1p5uux3-0+.Grid-c11n-8-84-3__sc-18zzowe-0>.StyledPropertyCardDataArea-c11n-8-84-3__sc-yipmu-0 {
    margin-top: 8px;
  }

  /*!sc*/
  .kbUUtf .StyledPropertyCardDataWrapper-c11n-8-84-3__sc-1omp4c3-0 {
    padding: 8px;
  }

  /*!sc*/
  .kbUUtf .StyledPropertyCardMLSFooter-c11n-8-84-3__sc-1ds3geg-0 {
    -webkit-box-pack: end;
    -webkit-justify-content: end;
    -ms-flex-pack: end;
    justify-content: end;
  }

  /*!sc*/
  .kbUUtf .StyledPropertyCardMLSFooter-c11n-8-84-3__sc-1ds3geg-0 .Text-c11n-8-84-3__sc-aiai24-0 {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 12px;
    line-height: 16px;
    font-weight: 700;
    text-align: right;
  }

  /*!sc*/
  .kbUUtf .StyledPropertyCardMLSFooter-c11n-8-84-3__sc-1ds3geg-0 .Text-c11n-8-84-3__sc-aiai24-0>.Icon-c11n-8-84-3__sc-13llmml-0 {
    margin-top: 2px;
  }

  /*!sc*/
  data-styled.g218[id="StyledPropertyCard-c11n-8-84-3__sc-jvwq6q-0"] {
    content: "kbUUtf,";
  }

  /*!sc*/
  .bNvRA-D {
    display: inline-block;
    width: 6px;
    height: 6px;
    background-color: #fff;
    border-radius: 50%;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.3);
    vertical-align: middle;
    -webkit-transition: all 150ms linear 0s;
    transition: all 150ms linear 0s;
    margin: 0 4px;
    opacity: 0.6;
    width: 8px;
    height: 8px;
    opacity: 1;
  }

  /*!sc*/
  .bNvRA-D:first-child {
    margin-left: 0;
  }

  /*!sc*/
  .bNvRA-D:last-child {
    margin-right: 0;
  }

  /*!sc*/
  @media (prefers-reduced-motion: reduce) {
    .bNvRA-D {
      -webkit-transition: none;
      transition: none;
    }
  }

  /*!sc*/
  .eNuVav {
    display: inline-block;
    width: 6px;
    height: 6px;
    background-color: #fff;
    border-radius: 50%;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.3);
    vertical-align: middle;
    -webkit-transition: all 150ms linear 0s;
    transition: all 150ms linear 0s;
    margin: 0 4px;
    opacity: 0.6;
  }

  /*!sc*/
  .eNuVav:first-child {
    margin-left: 0;
  }

  /*!sc*/
  .eNuVav:last-child {
    margin-right: 0;
  }

  /*!sc*/
  @media (prefers-reduced-motion: reduce) {
    .eNuVav {
      -webkit-transition: none;
      transition: none;
    }
  }

  /*!sc*/
  .hYJmuS {
    display: inline-block;
    width: 6px;
    height: 6px;
    background-color: #fff;
    border-radius: 50%;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.3);
    vertical-align: middle;
    -webkit-transition: all 150ms linear 0s;
    transition: all 150ms linear 0s;
    margin: 0 4px;
    opacity: 0.6;
    width: 4px;
    height: 4px;
  }

  /*!sc*/
  .hYJmuS:first-child {
    margin-left: 0;
  }

  /*!sc*/
  .hYJmuS:last-child {
    margin-right: 0;
  }

  /*!sc*/
  @media (prefers-reduced-motion: reduce) {
    .hYJmuS {
      -webkit-transition: none;
      transition: none;
    }
  }

  /*!sc*/
  data-styled.g220[id="StyledPhotoCarouselDot-c11n-8-84-3__sc-mtxjam-0"] {
    content: "bNvRA-D,eNuVav,hYJmuS,";
  }

  /*!sc*/
  .jxJXRc {
    position: absolute;
    left: 50%;
    -webkit-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    transform: translateX(-50%);
    z-index: 5;
    bottom: 6px;
    line-height: 8px;
  }

  /*!sc*/
  data-styled.g221[id="StyledPhotoCarouselDots-c11n-8-84-3__sc-18uj95r-0"] {
    content: "jxJXRc,";
  }

  /*!sc*/
  .fPJrFD {
    position: static;
    z-index: 1;
  }

  /*!sc*/
  .fPJrFD .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0 {
    position: absolute;
    border-color: transparent;
    height: 100%;
  }

  /*!sc*/
  .fPJrFD .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0:nth-child(1) {
    left: 0;
  }

  /*!sc*/
  .fPJrFD .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0:nth-child(1) .Icon-c11n-8-84-3__sc-13llmml-0 {
    -webkit-filter: drop-shadow(2px 0 2px rgba(0, 0, 0, 0.3));
    filter: drop-shadow(2px 0 2px rgba(0, 0, 0, 0.3));
  }

  /*!sc*/
  .fPJrFD .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0:nth-child(2) {
    right: 0;
  }

  /*!sc*/
  .fPJrFD .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0:nth-child(2) .Icon-c11n-8-84-3__sc-13llmml-0 {
    -webkit-filter: drop-shadow(-2px 0 2px rgba(0, 0, 0, 0.3));
    filter: drop-shadow(-2px 0 2px rgba(0, 0, 0, 0.3));
  }

  /*!sc*/
  .fPJrFD .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0:active,
  .fPJrFD .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0:hover {
    background-color: transparent;
    border-color: transparent;
    color: #fff;
  }

  /*!sc*/
  .fPJrFD .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0:focus {
    box-shadow: none;
  }

  /*!sc*/
  data-styled.g222[id="StyledPhotoCarouselNavControls-c11n-8-84-3__sc-1sqx2bf-0"] {
    content: "fPJrFD,";
  }

  /*!sc*/
  .fYJPSr {
    -webkit-transition: -webkit-transform 0.2s cubic-bezier(0.58, 0.92, 0.57, 0.92);
    -webkit-transition: transform 0.2s cubic-bezier(0.58, 0.92, 0.57, 0.92);
    transition: transform 0.2s cubic-bezier(0.58, 0.92, 0.57, 0.92);
    -webkit-transform: translateX(0%);
    -ms-transform: translateX(0%);
    transform: translateX(0%);
    z-index: 2;
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
  }

  /*!sc*/
  @media (prefers-reduced-motion: reduce) {
    .fYJPSr {
      -webkit-transition: none;
      transition: none;
    }
  }

  /*!sc*/
  .gMzzwl {
    -webkit-transition: -webkit-transform 0.2s cubic-bezier(0.58, 0.92, 0.57, 0.92);
    -webkit-transition: transform 0.2s cubic-bezier(0.58, 0.92, 0.57, 0.92);
    transition: transform 0.2s cubic-bezier(0.58, 0.92, 0.57, 0.92);
    -webkit-transform: translateX(100%);
    -ms-transform: translateX(100%);
    transform: translateX(100%);
    z-index: 1;
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
  }

  /*!sc*/
  @media (prefers-reduced-motion: reduce) {
    .gMzzwl {
      -webkit-transition: none;
      transition: none;
    }
  }

  /*!sc*/
  .YOCEM {
    -webkit-transition: -webkit-transform 0.2s cubic-bezier(0.58, 0.92, 0.57, 0.92);
    -webkit-transition: transform 0.2s cubic-bezier(0.58, 0.92, 0.57, 0.92);
    transition: transform 0.2s cubic-bezier(0.58, 0.92, 0.57, 0.92);
    -webkit-transform: translateX(-100%);
    -ms-transform: translateX(-100%);
    transform: translateX(-100%);
    z-index: 1;
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
  }

  /*!sc*/
  @media (prefers-reduced-motion: reduce) {
    .YOCEM {
      -webkit-transition: none;
      transition: none;
    }
  }

  /*!sc*/
  data-styled.g223[id="StyledPhotoCarouselSlide-c11n-8-84-3__sc-qmdvxp-0"] {
    content: "fYJPSr,gMzzwl,YOCEM,";
  }

  /*!sc*/
  .bEWkkx {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    position: relative;
    z-index: 0;
    height: 100%;
    -webkit-transition: -webkit-transform 0.2s cubic-bezier(0.58, 0.92, 0.57, 0.92);
    -webkit-transition: transform 0.2s cubic-bezier(0.58, 0.92, 0.57, 0.92);
    transition: transform 0.2s cubic-bezier(0.58, 0.92, 0.57, 0.92);
  }

  /*!sc*/
  @media (prefers-reduced-motion: reduce) {
    .bEWkkx {
      -webkit-transition: none;
      transition: none;
    }
  }

  /*!sc*/
  @media (hover: none) {
    .bEWkkx {
      -webkit-transform: translate3d(0, 0, 0);
      -ms-transform: translate3d(0, 0, 0);
      transform: translate3d(0, 0, 0);
    }
  }

  /*!sc*/
  data-styled.g224[id="StyledPhotoCarouselSwipeableContainer-c11n-8-84-3__sc-izm6eg-0"] {
    content: "bEWkkx,";
  }

  /*!sc*/
  .PNwKN {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    position: relative;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    height: 100%;
    border-radius: 4px 4px 0 0;
    overflow: hidden;
    -webkit-transform: translate3d(0, 0, 0);
  }

  /*!sc*/
  .PNwKN .StyledPhotoCarouselNavControls-c11n-8-84-3__sc-1sqx2bf-0 {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    opacity: 0;
    -webkit-transition-property: opacity;
    transition-property: opacity;
    -webkit-transition-duration: 0.2s;
    transition-duration: 0.2s;
    -webkit-transition-timing-function: ease;
    transition-timing-function: ease;
    z-index: -1;
  }

  /*!sc*/
  @media (hover: hover) and (pointer: fine) {
    .PNwKN:hover:not(:disabled) .StyledPhotoCarouselNavControls-c11n-8-84-3__sc-1sqx2bf-0 {
      opacity: 1;
      z-index: 1;
    }
  }

  /*!sc*/
  /* @media prefers-reduced-motion:reduce {
    .PNwKN .StyledPhotoCarouselNavControls-c11n-8-84-3__sc-1sqx2bf-0 {
      -webkit-transition: none;
      transition: none;
    }
  } */

  /*!sc*/
  .PNwKN>.Anchor-c11n-8-84-3__sc-hn4bge-0 {
    height: 100%;
  }

  /*!sc*/
  .PNwKN .StyledPhotoCarouselKeyboardInstructions-c11n-8-84-3__sc-1bwl9v2-0 {
    position: absolute;
    bottom: 30px;
    left: 50%;
    opacity: 0;
    -webkit-transition: all 0.4s;
    transition: all 0.4s;
    -webkit-transform: translate(-50%, 100%);
    -ms-transform: translate(-50%, 100%);
    transform: translate(-50%, 100%);
  }

  /*!sc*/
  @media (prefers-reduced-motion: reduce) {
    .PNwKN .StyledPhotoCarouselKeyboardInstructions-c11n-8-84-3__sc-1bwl9v2-0 {
      -webkit-transition: none;
      transition: none;
    }
  }

  /*!sc*/
  .PNwKN:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  .PNwKN:focus-visible .StyledPhotoCarouselKeyboardInstructions-c11n-8-84-3__sc-1bwl9v2-0 {
    opacity: 0;
    -webkit-transform: translate(-50%, 100%);
    -ms-transform: translate(-50%, 100%);
    transform: translate(-50%, 100%);
  }

  /*!sc*/
  data-styled.g225[id="StyledPhotoCarousel-c11n-8-84-3__sc-pomexy-0"] {
    content: "PNwKN,";
  }

  /*!sc*/
  .dlCZbs {
    padding: 16px;
  }

  /*!sc*/
  .YQsHy {
    margin-top: 24px;
    margin-bottom: 16px;
  }

  /*!sc*/
  data-styled.g229[id="Spacer-c11n-8-84-3__sc-17suqs2-0"] {
    content: "dlCZbs,YQsHy,";
  }

  /*!sc*/
  .bpnqED {
    position: fixed;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 200000;
    pointer-events: none;
  }

  /*!sc*/
  .bpnqED .Toast-sc-nim36i-0 {
    pointer-events: auto;
    margin: 16px;
    margin-top: 0;
  }

  /*!sc*/
  .bpnqED .AnimatedList-sc-sdziqv-1 {
    margin: 0;
    padding: 0;
    list-style: none;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
  }

  /*!sc*/
  .bpnqED .AnimatedList__Item-sc-sdziqv-0 {
    position: relative;
  }

  /*!sc*/
  .bCrxFC {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    z-index: 200000;
    pointer-events: none;
  }

  /*!sc*/
  .bCrxFC .Toast-sc-nim36i-0 {
    pointer-events: auto;
    margin: 16px;
    margin-bottom: 0;
  }

  /*!sc*/
  .bCrxFC .AnimatedList-sc-sdziqv-1 {
    margin: 0;
    padding: 0;
    list-style: none;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column-reverse;
    -ms-flex-direction: column-reverse;
    flex-direction: column-reverse;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
  }

  /*!sc*/
  .bCrxFC .AnimatedList__Item-sc-sdziqv-0 {
    position: relative;
  }

  /*!sc*/
  data-styled.g254[id="ToastProvider-c11n-8-84-3__sc-fszcvs-0"] {
    content: "bpnqED,bCrxFC,";
  }

  /*!sc*/
  fieldset {
    border: 0;
  }

  /*!sc*/
  select,
  select[disabled] {
    background-position: right -28px;
  }

  /*!sc*/
  ul {
    list-style: none;
    padding-left: 0;
  }

  /*!sc*/
  body,
  fieldset,
  h1,
  h2,
  h3,
  h4,
  h5,
  h6,
  p,
  ul {
    margin: 0;
  }

  /*!sc*/
  article,
  footer,
  header,
  nav,
  section {
    display: block;
  }

  /*!sc*/
  a {
    background: 0 0;
    color: #006aff;
    cursor: pointer;
    font-weight: 300;
    -webkit-text-decoration: none;
    text-decoration: none;
  }

  /*!sc*/
  a:visited {
    color: #7a48d6;
  }

  /*!sc*/
  a:focus,
  a:hover {
    color: #62aef7;
  }

  /*!sc*/
  a:active {
    color: #3390e9;
  }

  /*!sc*/
  a:active,
  a:hover {
    outline: 0;
  }

  /*!sc*/
  strong {
    font-weight: 700;
  }

  /*!sc*/
  svg:not(:root) {
    overflow: hidden;
  }

  /*!sc*/
  button,
  input,
  select {
    color: inherit;
    font: inherit;
    margin: 0;
  }

  /*!sc*/
  button,
  select {
    text-transform: none;
  }

  /*!sc*/
  button {
    -webkit-appearance: button;
    cursor: pointer;
    overflow: visible;
  }

  /*!sc*/
  button[disabled],
  input[disabled],
  select {
    -webkit-appearance: none;
  }

  /*!sc*/
  table {
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 0;
  }

  /*!sc*/
  html {
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: transparent;
    font-family: "Open Sans", Gotham, gotham, Tahoma, Geneva, sans-serif;
    font-size: 93.75%;
  }

  /*!sc*/
  *,
  :after,
  :before {
    box-sizing: border-box;
  }

  /*!sc*/
  body {
    color: #2a2a33;
    line-height: 1.5;
  }

  /*!sc*/
  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    color: inherit;
  }

  /*!sc*/
  h1 {
    font-size: 33px;
    font-weight: 600;
    line-height: 1.3;
  }

  /*!sc*/
  @media screen and (max-width: 480px) {
    h1 {
      font-size: 24px;
    }
  }

  /*!sc*/
  h2 {
    font-size: 28px;
    font-weight: 600;
    line-height: 1.3;
  }

  /*!sc*/
  h3 {
    font-size: 20px;
    font-weight: 600;
    line-height: 1.5;
  }

  /*!sc*/
  h4 {
    font-size: 13px;
    font-weight: 600;
    line-height: 1.5;
    text-transform: uppercase;
  }

  /*!sc*/
  @media screen and (max-width: 480px) {
    h2 {
      font-size: 20px;
    }

    h3 {
      font-size: 17px;
    }

    h4 {
      font-size: 13px;
    }
  }

  /*!sc*/
  h5 {
    font-size: 13px;
    font-weight: 700;
    line-height: 1.5;
  }

  /*!sc*/
  @media screen and (max-width: 480px) {
    h5 {
      font-size: 13px;
    }
  }

  /*!sc*/
  input {
    line-height: 1.5em;
  }

  /*!sc*/
  input,
  select {
    background-color: #fff;
    border: 1px solid #a7a6ab;
    box-shadow: inset 0 2px 2px #f9f9fb, 0 0 0 #62aef7;
    height: 30px;
    padding: 4px 6px 2px;
    width: 100%;
  }

  /*!sc*/
  @media screen and (min-width: 769px) {

    input:hover,
    select:hover {
      border-color: #006aff;
    }
  }

  /*!sc*/
  button::-moz-focus-inner,
  input::-moz-focus-inner {
    border: 0;
    padding: 0;
  }

  /*!sc*/
  select::-ms-expand {
    display: none;
  }

  /*!sc*/
  select:hover {
    background-position: right 12px;
  }

  /*!sc*/
  select:focus {
    background-position: right 12px;
  }

  /*!sc*/
  select:focus::-ms-value {
    background: 0 0;
    color: #2a2a33;
  }

  /*!sc*/
  .hide {
    display: none !important;
  }

  /*!sc*/
  data-styled.g288[id="sc-global-engLiy1"] {
    content: "sc-global-engLiy1,";
  }

  /*!sc*/
  .bEluak.with_streetView img {
    object-fit: fill;
  }

  /*!sc*/
  data-styled.g316[id="StyledPropertyCardPhoto-srp__sc-1gxvsd7-0"] {
    content: "bEluak,";
  }

  /*!sc*/
  .bdwyNr {
    max-width: 100%;
    max-height: 297px;
  }

  /*!sc*/
  .bdwyNr.map-narrow-card {
    bottom: 0;
    max-width: 100%;
    position: absolute;
    width: 100%;
    z-index: 10;
    padding: 0px 8px 8px 8px;
    height: auto;
  }

  /*!sc*/
  .bdwyNr a.carousel-photo {
    display: block;
    height: 100%;
  }

  /*!sc*/
  .bdwyNr .property-card-link:link,
  .bdwyNr .property-card-link:active,
  .bdwyNr .property-card-link:visited,
  .bdwyNr .property-card-link:hover {
    color: #2a2a33;
    -webkit-text-decoration: none;
    text-decoration: none;
  }

  /*!sc*/
  data-styled.g327[id="StyledPropertyCard-srp__sc-1o67r90-0"] {
    content: "bdwyNr,";
  }

  /*!sc*/
  .kwzEON {
    position: absolute;
    right: 0;
    top: 0;
  }

  /*!sc*/
  data-styled.g328[id="StyledSaveButton-srp__sc-18odgo2-0"] {
    content: "kwzEON,";
  }

  /*!sc*/
  .kSsByo {
    display: grid;
    grid-template-columns: auto;
  }

  /*!sc*/
  data-styled.g331[id="PropertyCardWrapper__StyledPriceGridContainer-srp__sc-16e8gqd-0"] {
    content: "kSsByo,";
  }

  /*!sc*/
  .iMKTKr {
    padding: 0;
  }

  /*!sc*/
  data-styled.g332[id="PropertyCardWrapper__StyledPriceLine-srp__sc-16e8gqd-1"] {
    content: "iMKTKr,";
  }

  /*!sc*/
  .bQttJG {
    position: absolute;
    top: calc(50% - 21px);
    right: 0;
    padding: 0;
    width: 42px;
    height: 42px;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
  }

  /*!sc*/
  .bQttJG button {
    width: 42px;
    height: 42px;
  }

  /*!sc*/
  .bQttJG button:after {
    margin-top: -21px;
    min-width: 42px;
    height: 42px;
  }

  /*!sc*/
  data-styled.g348[id="SearchBoxCombobox__StyledSearchBoxAdornment-sc-1qvxrzk-0"] {
    content: "bQttJG,";
  }

  /*!sc*/
  .hkmErZ {
    position: absolute;
    z-index: 2;
    top: 0;
    left: 0;
    right: 0;
    border: 1px solid;
    border-radius: 4px;
    border-color: #d1d1d5;
    background-color: #fff;
  }

  /*!sc*/
  .hkmErZ:active,
  .hkmErZ:hover,
  .hkmErZ:focus {
    border-color: #006aff;
  }

  /*!sc*/
  data-styled.g349[id="SearchBoxCombobox__StyledForm-sc-1qvxrzk-1"] {
    content: "hkmErZ,";
  }

  /*!sc*/
  .dudagf {
    background-color: #fff;
    border: none;
    border-radius: 4px;
  }

  /*!sc*/
  .dudagf:focus,
  .dudagf:focus-within {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  .dudagf label {
    border: none;
    background-color: #fff;
  }

  /*!sc*/
  .dudagf label:focus {
    box-shadow: none;
  }

  /*!sc*/
  @media screen and (max-width: 889px) {

    .dudagf.dudagf.dudagf [role="listbox"],
    .dudagf.dudagf.dudagf [role="dialog"] {
      width: 100vw !important;
    }
  }

  /*!sc*/
  .dudagf.dudagf.dudagf [role="listbox"],
  .dudagf.dudagf.dudagf [role="dialog"] {
    height: auto;
    max-height: 100vh;
    z-index: 100;
  }

  /*!sc*/
  data-styled.g350[id="SearchBoxCombobox__StyledCombobox-sc-1qvxrzk-2"] {
    content: "dudagf,";
  }

  /*!sc*/
  .gpmrrj {
    border: none;
    padding-left: 8px;
    width: 100%;
    box-shadow: none;
    background-color: #fff;
    -webkit-flex-wrap: nowrap;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    padding-right: 42px;
  }

  /*!sc*/
  .gpmrrj:focus,
  .gpmrrj:focus-within {
    box-shadow: none;
  }

  /*!sc*/
  .gpmrrj span[class*="StyledTag"] {
    position: relative;
    display: block;
    -webkit-flex: 0 auto;
    -ms-flex: 0 auto;
    flex: 0 auto;
    min-width: 60px;
    padding-right: 32px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  /*!sc*/
  .gpmrrj span[class*="StyledTag"]>button {
    position: absolute;
    top: calc(50% - 8px);
    right: 8px;
    height: 100%;
  }

  /*!sc*/
  .gpmrrj span[class*="StyledTag"]:last-of-type {
    margin-right: 8px;
  }

  /*!sc*/
  .gpmrrj input[role="combobox"] {
    background-color: #fff;
    text-overflow: ellipsis;
  }

  /*!sc*/
  .gpmrrj input[role="combobox"]:focus {
    box-shadow: none;
  }

  /*!sc*/
  .gpmrrj>button[class*="StyleTagCloseButton"] {
    display: none;
  }

  /*!sc*/
  .gpmrrj.gpmrrj.gpmrrj span[class*="StyledTag"]:nth-child(1):nth-last-child(4) {
    -webkit-flex-shrink: 0;
    -ms-flex-negative: 0;
    flex-shrink: 0;
    padding-right: 8px;
  }

  /*!sc*/
  .gpmrrj.gpmrrj.gpmrrj span[class*="StyledTag"]:nth-child(1):nth-last-child(4)>button {
    display: none;
  }

  /*!sc*/
  @media screen and (max-width: 428px) {
    .gpmrrj span[class*="StyledTag"]:nth-child(2)+input[role="combobox"] {
      display: none;
    }
  }

  /*!sc*/
  data-styled.g351[id="SearchBoxCombobox__StyledComboboxInput-sc-1qvxrzk-3"] {
    content: "gpmrrj,";
  }

  /*!sc*/
  .kwDWQY {
    border: none;
    font-size: 15px;
    -webkit-font-smoothing: auto;
    font-weight: 400;
    height: 32px;
    padding: 0 10px;
    -moz-osk-font-smoothing: auto;
  }

  /*!sc*/
  .kwDWQY:focus {
    z-index: 1;
  }

  /*!sc*/
  data-styled.g400[id="StyledActionBarButton-srp__sc-vzgwmm-0"] {
    content: "kwDWQY,";
  }

  /*!sc*/
  .jLwrOl {
    background: white;
    border: 1px solid #d1d1d5;
    border-radius: 2px;
    color: #006aff;
    display: block;
    font-size: 12px;
    font-weight: 600;
    height: 100%;
    outline: none;
    overflow: hidden;
    padding: 0 5px;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 100%;
  }

  /*!sc*/
  .jLwrOl button {
    background: none;
    border: none;
    outline: none;
    padding: 0;
  }

  /*!sc*/
  .jLwrOl:focus {
    border: solid 2px;
    border-color: #006aff;
  }

  /*!sc*/
  .jLwrOl.filter-button_active {
    border-color: #006aff;
  }

  /*!sc*/
  .jLwrOl.filter-button_open {
    background: #006aff;
    border-color: #006aff;
    color: white;
  }

  /*!sc*/
  .jLwrOl.save-search-button {
    background: #006aff;
    border: 1px solid #006aff;
    border-radius: 4px;
    color: white;
    height: 32px;
    outline: none;
    padding: 0 0.67em;
    width: auto;
    font-weight: 700;
    font-size: 14px;
    height: 37px;
  }

  /*!sc*/
  @media (min-width: 1007px) and (max-width: 1279px) {
    .jLwrOl.save-search-button {
      font-size: 12px;
      font-weight: 600;
    }
  }

  /*!sc*/
  .jLwrOl.save-search-button:focus {
    box-shadow: 0 0 8px #006aff;
  }

  /*!sc*/
  data-styled.g401[id="StyledFilterButton-srp__sc-vk62hb-0"] {
    content: "jLwrOl,";
  }

  /*!sc*/
  @supports (-webkit-overflow-scrolling: touch) {
    .hJaegF {
      -webkit-transform: translateZ(1px);
      -ms-transform: translateZ(1px);
      transform: translateZ(1px);
    }
  }

  /*!sc*/
  data-styled.g403[id="dialog__StyledModalDialog-srp__sc-fdndby-1"] {
    content: "hJaegF,";
  }

  /*!sc*/
  .eNikAj {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    height: 37px;
    margin-right: 5px;
    outline: none;
    overflow: visible;
  }

  /*!sc*/
  .eNikAj:focus {
    border-radius: 4px;
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  @media (min-width: 1280px) {
    .eNikAj {
      margin-right: 12px;
      overflow: visible;
      position: relative;
      width: auto;
    }
  }

  /*!sc*/
  .dFYgSS {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    height: 37px;
    margin-right: 5px;
    outline: none;
    overflow: visible;
  }

  /*!sc*/
  .dFYgSS:focus {
    border-radius: 4px;
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  /*!sc*/
  .dFYgSS>section {
    width: min(500px, 500px);
  }

  /*!sc*/
  @media (min-width: 1280px) {
    .dFYgSS {
      margin-right: 0px;
      overflow: visible;
      position: relative;
      width: auto;
    }

    .dFYgSS>section {
      left: auto !important;
      right: 0 !important;
      width: 500px;
    }
  }

  /*!sc*/
  data-styled.g404[id="dialog__StyledOuterDiv-srp__sc-fdndby-2"] {
    content: "eNikAj,dFYgSS,";
  }

  /*!sc*/
  .dFnhoJ {
    background-color: #f2faff;
    /* border: 1px solid #006aff; */
    max-width: 150px;
    min-width: 100px;
    min-height: 37px;
    overflow: hidden;
    padding: 0px 10px;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  /*!sc*/
  #price .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
    min-width: 132px;
  }

  /*!sc*/
  @media (min-width: 1007px) and (max-width: 1279px) {
    .dFnhoJ {
      font-size: 12px;
      font-weight: 600;
      padding: 0px 5px;
    }

    #listing-type .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 100px;
    }

    #price .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 110px;
    }

    #beds .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 116px;
    }

    #home-type .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 120px;
    }

    #more .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 100px;
    }
  }

  /*!sc*/
  @media (min-width: 1280px) {
    #listing-type .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 106px;
    }

    #price .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 145px;
    }

    #beds .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 150px;
    }

    #home-type .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 150px;
    }

    #more .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 110px;
    }
  }

  /*!sc*/
  .ibZIjf {
    max-width: 150px;
    min-width: 100px;
    min-height: 37px;
    overflow: hidden;
    padding: 0px 10px;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  /*!sc*/
  #price .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
    min-width: 132px;
  }

  /*!sc*/
  @media (min-width: 1007px) and (max-width: 1279px) {
    .ibZIjf {
      font-size: 12px;
      font-weight: 600;
      padding: 0px 5px;
    }

    #listing-type .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 100px;
    }

    #price .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 110px;
    }

    #beds .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 116px;
    }

    #home-type .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 120px;
    }

    #more .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 100px;
    }
  }

  /*!sc*/
  @media (min-width: 1280px) {
    #listing-type .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 106px;
    }

    #price .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 145px;
    }

    #beds .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 150px;
    }

    #home-type .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 150px;
    }

    #more .dialog__StyledDropdownButton-srp__sc-fdndby-3 {
      min-width: 110px;
    }
  }

  /*!sc*/
  data-styled.g405[id="dialog__StyledDropdownButton-srp__sc-fdndby-3"] {
    content: "dFnhoJ,ibZIjf,";
  }

  /*!sc*/
  .bYHboU {
    visibility: unset;
    width: 292px;
    z-index: 500;
  }

  /*!sc*/
  .bYHboU.bYHboU {
    position: absolute;
    -webkit-transform: translate(0px, 40px);
    -ms-transform: translate(0px, 40px);
    transform: translate(0px, 40px);
  }

  /*!sc*/
  .bYHboU.bYHboU>div,
  .bYHboU.bYHboU>div>div {
    padding: 0px;
    overflow-x: hidden;
  }

  /*!sc*/
  .bYHboU .more-filters {
    padding: 15px;
  }

  /*!sc*/
  .iTTHkH {
    visibility: unset;
    width: 372px;
    z-index: 500;
  }

  /*!sc*/
  .iTTHkH.iTTHkH {
    position: absolute;
    -webkit-transform: translate(0px, 40px);
    -ms-transform: translate(0px, 40px);
    transform: translate(0px, 40px);
  }

  /*!sc*/
  .iTTHkH.iTTHkH>div,
  .iTTHkH.iTTHkH>div>div {
    padding: 0px;
    overflow-x: hidden;
  }

  /*!sc*/
  .iTTHkH .more-filters {
    padding: 15px;
  }

  /*!sc*/
  .fiYdwx {
    visibility: unset;
    width: 415px;
    z-index: 500;
  }

  /*!sc*/
  .fiYdwx.fiYdwx {
    position: absolute;
    -webkit-transform: translate(0px, 40px);
    -ms-transform: translate(0px, 40px);
    transform: translate(0px, 40px);
  }

  /*!sc*/
  .fiYdwx.fiYdwx>div,
  .fiYdwx.fiYdwx>div>div {
    padding: 0px;
    overflow-x: hidden;
  }

  /*!sc*/
  .fiYdwx .more-filters {
    padding: 15px;
  }

  /*!sc*/
  .bCHfdx {
    visibility: unset;
    width: -webkit-fit-content;
    width: -moz-fit-content;
    width: fit-content;
    z-index: 500;
    min-width: 210px;
  }

  /*!sc*/
  .bCHfdx.bCHfdx {
    position: absolute;
    -webkit-transform: translate(0px, 40px);
    -ms-transform: translate(0px, 40px);
    transform: translate(0px, 40px);
  }

  /*!sc*/
  .bCHfdx.bCHfdx>div,
  .bCHfdx.bCHfdx>div>div {
    padding: 0px;
    overflow-x: hidden;
  }

  /*!sc*/
  .bCHfdx .more-filters {
    padding: 15px;
  }

  /*!sc*/
  .hnOkOI {
    visibility: unset;
    width: inherit;
    z-index: 500;
  }

  /*!sc*/
  .hnOkOI.hnOkOI {
    position: absolute;
    -webkit-transform: translate(0px, 40px);
    -ms-transform: translate(0px, 40px);
    transform: translate(0px, 40px);
  }

  /*!sc*/
  .hnOkOI.hnOkOI>div,
  .hnOkOI.hnOkOI>div>div {
    padding: 0px;
    overflow-x: hidden;
  }

  /*!sc*/
  .hnOkOI .more-filters {
    padding: 15px;
  }

  /*!sc*/
  data-styled.g406[id="dialog__StyledDropdown-srp__sc-fdndby-4"] {
    content: "bYHboU,iTTHkH,fiYdwx,bCHfdx,hnOkOI,";
  }

  /*!sc*/
  .fmPdDO>.StyledDialog-c11n-8-84-3__sc-3phm7o-0 {
    max-height: 100%;
    max-width: 600px;
  }

  /*!sc*/
  data-styled.g411[id="SaveSearchButton__StyledPopover-srp__sc-n2mqux-3"] {
    content: "fmPdDO,";
  }

  /*!sc*/
  .eZmzOE {
    min-width: 400px;
    z-index: 1;
  }

  /*!sc*/
  .eZmzOE.eZmzOE .save-search-dialog-body {
    padding: 0;
  }

  /*!sc*/
  .eZmzOE.eZmzOE .save-search-dialog-body .save-search-form {
    margin: 0 4px;
  }

  /*!sc*/
  .eZmzOE.eZmzOE .save-search-dialog-body .save-search-form div,
  .eZmzOE.eZmzOE .save-search-dialog-body .save-search-form fieldset {
    padding: 0px 5px;
  }

  /*!sc*/
  data-styled.g414[id="SaveSearchButton__StyledDropdown-srp__sc-n2mqux-6"] {
    content: "eZmzOE,";
  }

  /*!sc*/
  .fHqMqx {
    height: 1px;
    left: 50%;
    position: absolute;
    top: 50%;
    width: 1px;
  }

  /*!sc*/
  data-styled.g422[id="MapPlaceholder__PreloadedMapContainer-srp__sc-123yac7-0"] {
    content: "fHqMqx,";
  }

  /*!sc*/
  .dZnTZw {
    background-size: 1810px 1440px;
    background-repeat: no-repeat;
    position: absolute;
    width: 452.5px;
    height: 360px;
  }

  /*!sc*/
  data-styled.g423[id="MapPlaceholder__PreloadedMapTile-srp__sc-123yac7-1"] {
    content: "dZnTZw,";
  }

  /*!sc*/
  .cEeZCi.wrapped {
    margin-top: 15px;
  }

  /*!sc*/
  @media (max-width: 1279px) {
    .cEeZCi.wrapped {
      margin-left: auto;
      margin-top: 7px;
    }
  }

  /*!sc*/
  data-styled.g437[id="SortOptionsPopover__NarrowViewWrapping-srp__sc-y7fum9-0"] {
    content: "cEeZCi,";
  }

  /*!sc*/
  .fgdSIN {
    border-color: #d1d1d5;
    font-size: 14px;
    font-weight: 600;
    height: 23px;
    margin-left: 3px;
    outline: none;
    padding: 0 5px;
    border: none;
    background: none;
    font-weight: 700;
    font-size: 14px;
  }

  /*!sc*/
  .fgdSIN#sort-popover {
    background: none;
    border: none;
    color: #006aff;
  }

  /*!sc*/
  .fgdSIN#sort-popover:hover {
    color: #001751;
  }

  /*!sc*/
  data-styled.g438[id="SortOptionsPopover__StyledDropdownButton-srp__sc-y7fum9-1"] {
    content: "fgdSIN,";
  }

  /*!sc*/
  @media (max-width: 1279px) {
    .idxSRv.wrapped {
      -webkit-flex-direction: column;
      -ms-flex-direction: column;
      flex-direction: column;
    }
  }

  /*!sc*/
  data-styled.g440[id="ListHeader__NarrowViewWrapping-srp__sc-1rsgqpl-1"] {
    content: "idxSRv,";
  }

  /*!sc*/
  .fgiidE {
    display: grid;
    grid-gap: 8px;
    grid-template-columns: repeat(auto-fill, minmax(286px, 1fr));
    margin-bottom: 8px;
    padding: 0 10px;
  }

  /*!sc*/
  @media screen and (min-width: 640px) {
    .fgiidE {
      padding: 0 16px;
    }
  }

  /*!sc*/
  data-styled.g441[id="StyledSearchListWrapper-srp__sc-1ieen0c-0"] {
    content: "fgiidE,";
  }

  /*!sc*/
  .gTOWtl {
    min-height: 265px;
    position: relative;
    padding: 0px;
  }

  /*!sc*/
  .gTOWtl.is_tall {
    height: 297px;
  }

  /*!sc*/
  data-styled.g442[id="StyledListCardWrapper-srp__sc-wtsrtn-0"] {
    content: "gTOWtl,";
  }

  /*!sc*/
  .jecefN {
    margin: auto;
    height: 30px;
    margin-top: 18px;
  }

  /*!sc*/
  .jecefN:focus {
    box-shadow: none;
    outline-offset: 8px;
    outline: 2px solid #006aff;
  }

  /*!sc*/
  data-styled.g455[id="pfs__j60ma-0"] {
    content: "jecefN,";
  }

  /*!sc*/
  .dIfpOE {
    display: block;
    margin: auto;
  }

  /*!sc*/
  data-styled.g456[id="pfs__j60ma-1"] {
    content: "dIfpOE,";
  }

  /*!sc*/
  .fPZEBj {
    margin-top: 16px;
    text-align: center;
  }

  /*!sc*/
  @media (max-width: 480px) {
    .fPZEBj {
      text-align: left;
      margin-left: 24px;
    }
  }

  /*!sc*/
  data-styled.g468[id="pfs__sc-16y5ofh-0"] {
    content: "fPZEBj,";
  }

  /*!sc*/
  .kBGCcp {
    color: black;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
  }

  /*!sc*/
  .kBGCcp:focus {
    box-shadow: none;
    outline: auto;
  }

  /*!sc*/
  .kBGCcp:visited,
  .kBGCcp:hover {
    color: #0d4599;
  }

  /*!sc*/
  data-styled.g476[id="pfs__x86ldc-0"] {
    content: "kBGCcp,";
  }

  /*!sc*/
  .iZQZM {
    background: white;
    max-width: 1280px;
    margin: auto;
    display: block;
    box-sizing: border-box;
    font-family: "Open Sans", Gotham, gotham, Tahoma, Geneva, sans-serif;
  }

  /*!sc*/
  data-styled.g477[id="pfs__sc-16g5ked-0"] {
    content: "iZQZM,";
  }

  /*!sc*/
  #mobile-hdp .pfs__sc-16g5ked-0 {
    padding-bottom: 0;
  }

  /*!sc*/
  data-styled.g478[id="sc-global-gFrTFR1"] {
    content: "sc-global-gFrTFR1,";
  }

  /*!sc*/
  .giDSWJ {
    list-style: none;
    margin-inline-start: 0;
    margin-inline-end: 0;
    padding-inline-start: 0;
    padding-inline-end: 0;
    margin-block-start: 0;
    margin-block-end: 0;
    list-style: none;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    margin-bottom: 24px;
  }

  /*!sc*/
  .giDSWJ li {
    display: inline-block;
    vertical-align: middle;
  }

  /*!sc*/
  data-styled.g479[id="pfs__sc-5sfc2u-0"] {
    content: "giDSWJ,";
  }

  /*!sc*/
  .hreAJS {
    max-width: 100%;
    height: auto;
  }

  /*!sc*/
  data-styled.g480[id="pfs__kizoah-0"] {
    content: "hreAJS,";
  }

  /*!sc*/
  .hAtGYA {
    margin: auto;
    padding: 24px 0;
    color: #666;
    text-align: center;
  }

  /*!sc*/
  .hAtGYA li {
    margin-left: 8px;
    margin-right: 0px;
    font-style: italic;
  }

  /*!sc*/
  .hAtGYA li:last-child {
    margin-left: 8px;
  }

  /*!sc*/
  .hAtGYA li:first-child {
    display: block;
  }

  /*!sc*/
  @media (min-width: 481px) {
    .hAtGYA li:first-child {
      display: inline-block;
    }
  }

  /*!sc*/
  data-styled.g481[id="pfs__wsq7ni-0"] {
    content: "hAtGYA,";
  }

  /*!sc*/
  .eQDVAr {
    max-width: 720px;
    margin: auto;
    margin-bottom: 24px;
  }

  /*!sc*/
  @media (max-width: 480px) {
    .eQDVAr {
      margin: 0 24px 16px;
    }
  }

  /*!sc*/
  data-styled.g482[id="pfs__sc-1sj5qgb-0"] {
    content: "eQDVAr,";
  }

  /*!sc*/
  .fOehGK {
    list-style: none;
    margin-inline-start: 0;
    margin-inline-end: 0;
    padding-inline-start: 0;
    padding-inline-end: 0;
    margin-block-start: 0;
    margin-block-end: 0;
    list-style: none;
    font-size: 12px;
  }

  /*!sc*/
  .fOehGK li {
    display: inline-block;
    vertical-align: middle;
    margin-bottom: 24px;
  }

  /*!sc*/
  .fOehGK li>span {
    display: inline-block;
    vertical-align: middle;
    margin-left: 4px;
    margin-right: 4px;
  }

  /*!sc*/
  data-styled.g483[id="pfs__sc-1a1yrk2-0"] {
    content: "fOehGK,";
  }

  /*!sc*/
  .daFyfs {
    list-style: none;
    margin-inline-start: 0;
    margin-inline-end: 0;
    padding-inline-start: 0;
    padding-inline-end: 0;
    margin-block-start: 0;
    margin-block-end: 0;
    font-size: 13px;
    font-weight: 600;
    margin: 0;
    padding: 0;
    text-align: center;
    -webkit-columns: 2;
    columns: 2;
  }

  /*!sc*/
  .daFyfs a {
    text-transform: none;
    color: #2a2a37;
    display: block;
    -webkit-text-decoration-line: none;
    text-decoration-line: none;
    font-weight: normal;
  }

  /*!sc*/
  .daFyfs li {
    margin: 0 24px;
    display: block;
    text-align: left;
  }

  /*!sc*/
  data-styled.g484[id="pfs__sc-1kahb5i-0"] {
    content: "daFyfs,";
  }

  /*!sc*/
  .brand-links {
    padding-left: 0;
  }

  /*!sc*/
  @media (min-width: 481px) {
    body:not(.responsive-search-page) .pfs__sc-1kahb5i-0 {
      -webkit-columns: 1;
      columns: 1;
      line-height: 30px;
    }

    body:not(.responsive-search-page) .pfs__sc-1kahb5i-0 li {
      margin: 0 10px;
      display: inline-block;
      padding-top: 0;
      text-align: center;
    }

    body:not(.responsive-search-page) .pfs__sc-1kahb5i-0.brand-links {
      display: inline;
    }

    @media (min-width: 1024px) {
      body:not(.responsive-search-page) .pfs__sc-1kahb5i-0.brand-links {
        display: block;
      }
    }
  }

  /*!sc*/
  data-styled.g485[id="sc-global-kpEhCd1"] {
    content: "sc-global-kpEhCd1,";
  }

  /*!sc*/
  .hHaxCk {
    margin: auto;
    padding: 24px 0;
    height: auto;
    overflow: visible;
    border-top: 1px solid #d8d8d8;
    border-bottom: 1px solid #d8d8d8;
    position: relative;
    display: block;
    text-align: center;
  }

  /*!sc*/
  data-styled.g486[id="pfs__sc-1i1gn38-0"] {
    content: "hHaxCk,";
  }

  /*!sc*/
  .kGTZeg {
    display: block;
  }

  /*!sc*/
  .kGTZeg li {
    padding-top: 10px;
  }

  /*!sc*/
  data-styled.g487[id="pfs__cacbnh-0"] {
    content: "kGTZeg,";
  }

  /*!sc*/
  .KBJPo {
    color: #1877f2;
    line-height: 45px;
  }

  /*!sc*/
  .gPapVq {
    line-height: 45px;
  }

  /*!sc*/
  .kkRJUq {
    color: #006aff;
    line-height: 45px;
  }

  /*!sc*/
  .fwLOqn {
    color: #55acee;
    line-height: 45px;
  }

  /*!sc*/
  data-styled.g488[id="pfs__tgmoyx-0"] {
    content: "KBJPo,gPapVq,kkRJUq,fwLOqn,";
  }

  /*!sc*/
  .jlVbYk>span {
    margin: 0;
  }

  /*!sc*/
  .jlVbYk a {
    margin-right: 0;
    margin-left: 8px;
  }

  /*!sc*/
  data-styled.g489[id="pfs__sc-1l86zl0-0"] {
    content: "jlVbYk,";
  }

  /*!sc*/
  .jkCZYU {
    display: block;
    margin: 8px;
    font-size: 14px;
  }

  /*!sc*/
  data-styled.g518[id="pfs__chkjii-0"] {
    content: "jkCZYU,";
  }

  /*!sc*/
  .WzpHc {
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
  }

  /*!sc*/
  data-styled.g519[id="pfs__chkjii-1"] {
    content: "WzpHc,";
  }

  /*!sc*/
  .cxDByN {
    background-color: #f9f9fb;
  }

  /*!sc*/
  data-styled.g533[id="sc-ilnxw0-0"] {
    content: "cxDByN,";
  }

  /*!sc*/
  .fxihco {
    float: left;
    margin-right: 3px;
  }

  /*!sc*/
  data-styled.g556[id="ListResultContexts__DisclaimerImg-srp__sc-1dz754x-0"] {
    content: "fxihco,";
  }

  /*!sc*/
  .biyHfS {
    padding-bottom: 5px;
  }

  /*!sc*/
  data-styled.g557[id="ListResultContexts__DisclaimerList-srp__sc-1dz754x-1"] {
    content: "biyHfS,";
  }

  /*!sc*/
  .eNlsCZ {
    padding: 0 20px;
  }

  /*!sc*/
  data-styled.g558[id="ListResultContexts__DisclaimerContainer-srp__sc-1dz754x-2"] {
    content: "eNlsCZ,";
  }

  /*!sc*/
  .inuoQZ {
    border-radius: 4px;
    box-shadow: rgba(0, 0, 0, 0.3) 0px 2px 4px 0px;
    height: 100%;
    position: relative;
  }

  /*!sc*/
  data-styled.g559[id="DetectIFrameClick__StyledIFrameWrapper-srp__sc-wl0g55-0"] {
    content: "inuoQZ,";
  }

  /*!sc*/
  .faHraN {
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    height: 100%;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    position: absolute;
    top: 0;
    width: 100%;
  }

  /*!sc*/
  data-styled.g560[id="NavAdContainer__StyledLoadingText-srp__sc-1n5wog8-0"] {
    content: "faHraN,";
  }

  /*!sc*/
  .iYrEXc {
    padding-left: 20px;
    padding-right: 20px;
  }

  /*!sc*/
  @media screen and (max-width: 480px) {
    .iYrEXc {
      padding-left: 10px;
      padding-right: 10px;
    }
  }

  /*!sc*/
  data-styled.g561[id="StyledLayoutWidth-srp__sc-g2q2rk-0"] {
    content: "iYrEXc,";
  }

  /*!sc*/
  .hjpPBk #srp-search-box {
    width: 300px;
    height: 44px;
    position: relative;
  }

  /*!sc*/
  @media (max-width: 889px) {
    .hjpPBk {
      background: white;
      max-width: 100%;
      position: absolute;
      -webkit-transform: translateY(-55px);
      -ms-transform: translateY(-55px);
      transform: translateY(-55px);
      width: calc(100% - 160px);
      z-index: 1000;
    }

    .hjpPBk #srp-search-box {
      margin-right: auto;
      margin-left: 0px;
      width: auto;
    }

    .exposed-filters-pinned .SearchBoxContainer__StyledSearchBoxContainer-srp__sc-hff1n-0 #srp-search-box {
      display: none;
    }
  }

  /*!sc*/
  data-styled.g669[id="SearchBoxContainer__StyledSearchBoxContainer-srp__sc-hff1n-0"] {
    content: "hjpPBk,";
  }

  /*!sc*/
  .duceJr {
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    border-bottom: 1px solid #ccc;
    min-height: 55px;
  }

  /*!sc*/
  .embedded-detail-page .SearchPageHeaderContainer__StyledSearchPageHeaderContainer-srp__sc-h52t73-0 {
    display: none;
  }

  /*!sc*/
  @media screen and (min-width: 890px) {
    .duceJr {
      padding: 0px 12px;
    }
  }

  /*!sc*/
  .znav-masked .SearchPageHeaderContainer__StyledSearchPageHeaderContainer-srp__sc-h52t73-0 {
    display: none;
  }

  /*!sc*/
  .duceJr .header-right {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    margin-left: auto;
  }

  /*!sc*/
  .duceJr .zsg-popover-adjustable-content {
    max-height: calc(100vh - 135px);
    overflow-y: auto;
  }

  /*!sc*/
  data-styled.g670[id="SearchPageHeaderContainer__StyledSearchPageHeaderContainer-srp__sc-h52t73-0"] {
    content: "duceJr,";
  }

  /*!sc*/
  .iEDtBD {
    margin-top: 130px;
  }

  /*!sc*/
  data-styled.g671[id="SearchPageToastWrapper__StyledToastProvider-srp__sc-hctc6v-0"] {
    content: "iEDtBD,";
  }

  /*!sc*/
  body.shopper-platform-srp-lightbox-layout #details-page-container {
    height: 100vh;
    max-width: 1248px;
    width: calc(100vw - (72px * 2));
  }

  /*!sc*/
  @media (max-width: 1023px) {
    body.shopper-platform-srp-lightbox-layout #details-page-container {
      width: 100%;
    }
  }

  /*!sc*/
  data-styled.g672[id="sc-global-iOqhCE1"] {
    content: "sc-global-iOqhCE1,";
  }

  /*!sc*/
  @-webkit-keyframes jBcSpD {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  /*!sc*/
  @keyframes jBcSpD {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  /*!sc*/
  data-styled.g673[id="sc-keyframes-jBcSpD"] {
    content: "jBcSpD,";
  }

  /*!sc*/
  @-webkit-keyframes iGLmwX {
    from {
      -webkit-transform: scale(0);
      -ms-transform: scale(0);
      transform: scale(0);
    }

    to {
      -webkit-transform: scale(1);
      -ms-transform: scale(1);
      transform: scale(1);
    }
  }

  /*!sc*/
  @keyframes iGLmwX {
    from {
      -webkit-transform: scale(0);
      -ms-transform: scale(0);
      transform: scale(0);
    }

    to {
      -webkit-transform: scale(1);
      -ms-transform: scale(1);
      transform: scale(1);
    }
  }

  /*!sc*/
  data-styled.g674[id="sc-keyframes-iGLmwX"] {
    content: "iGLmwX,";
  }

  /*!sc*/
</style>
<style>
  .iotCst {
    box-sizing: border-box;
    background-color: rgb(255, 255, 255);
    box-shadow: rgba(0, 0, 0, 0.3) 0px 8px 12px 0px;
    outline: none;
    border-radius: 8px;
    position: relative;
  }

  .bYHboU.bYHboU>div,
  .bYHboU.bYHboU>div>div {
    padding: 0px;
    overflow-x: hidden;
  }

  .hMWkrB .DialogLayout-c11n-8-84-3__sc-178ji0w-0 {
    display: flex;
    flex-direction: column;
  }

  .bYHboU.bYHboU>div,
  .bYHboU.bYHboU>div>div {
    padding: 0px;
    overflow-x: hidden;
  }

  .hMWkrB .DialogBody-c11n-8-84-3__sc-dazfx6-0 {
    overflow-y: auto;
    padding: 12px 16px 0px;
    flex: 1 1 auto;
  }

  .fMUGxT {
    outline: none;
    box-shadow: none;
  }

  .iorzBq {
    border: 0px;
    clip: rect(0px, 0px, 0px, 0px);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0px;
    position: absolute;
    width: 1px;
  }

  .jGMQeQ {
    background: rgb(255, 255, 255);
    width: 100%;
  }

  .cYynOC {
    border: 0px;
    padding: 0px;
    margin: 0px;
  }

  .cYynOC>.StyledLabeledControl-c11n-8-84-3__sc-1hafskn-0 {
    margin-left: 8px;
  }

  .bYdEhW {
    -webkit-box-align: center;
    align-items: center;
    flex: 1 1 0%;
    height: 55px;
    -webkit-box-pack: start;
    justify-content: flex-start;
  }

  .ggunMQ {
    display: flex;
    -webkit-box-pack: justify;
    justify-content: space-between;
  }

  input.ggtjSK.ggtjSK:checked,
  input.ggtjSK.ggtjSK:hover:checked,
  input.ggtjSK.ggtjSK:active:checked,
  input.ggtjSK.ggtjSK:focus:checked {
    border-color: rgb(0, 106, 255);
    border-width: 5px;
  }

  .ggtjSK.ggtjSK:checked {
    border-color: rgb(0, 106, 255);
    border-width: 5px;
  }

  input.ggtjSK.ggtjSK,
  input.ggtjSK.ggtjSK:hover,
  input.ggtjSK.ggtjSK:active,
  input.ggtjSK.ggtjSK:focus {
    border: 2px solid rgb(167, 166, 171);
  }

  input.ggtjSK.ggtjSK {
    position: static;
    height: 20px;
    width: 20px;
  }

  input.Radio-c11n-8-84-3__sc-yicu80-0:checked,
  input.eYRhoL:hover:checked,
  input.eYRhoL:active:checked,
  input.eYRhoL:focus:checked {
    border-color: rgb(0, 106, 255);
    border-width: 5px;
  }

  .CategoryRadioButton__StyledLabelControl-srp__sc-jtaiy8-1 .CategoryRadioButton__StyledRadio-srp__sc-jtaiy8-3 {
    margin-left: 8px;
    margin-top: 0px;
  }

  .ggtjSK.ggtjSK {
    appearance: none;
    box-sizing: border-box;
    display: inline-block;
    height: 20px;
    width: 20px;
    background: rgb(255, 255, 255);
    border: 2px solid rgb(167, 166, 171);
    border-radius: 50%;
    cursor: pointer;
    margin: 0px;
    outline: none;
    box-shadow: none;
  }

  .CategoryRadioButton__StyledLabelControl-srp__sc-jtaiy8-1 .xpbkb.xpbkb {
    -webkit-box-align: center;
    align-items: center;
    display: flex;
    flex: 1 1 0%;
    height: 100%;
    padding-left: 16px;
    padding-top: 9px;
  }

  .ggunMQ>.StyledCheckbox-c11n-8-84-3__sc-xbn46a-0~.StyledLabel-c11n-8-84-3__sc-qq9hfi-0,
  .ggunMQ>.Radio-c11n-8-84-3__sc-yicu80-0~.StyledLabel-c11n-8-84-3__sc-qq9hfi-0,
  .ggunMQ>.StyledSwitchWrapper-c11n-8-84-3__sc-17oy7v3-1~.StyledLabel-c11n-8-84-3__sc-qq9hfi-0 {
    color: rgb(42, 42, 51);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
  }

  input.ggtjSK.ggtjSK+label {
    padding-left: 0px;
  }

  .jGMQeQ {
    background: rgb(255, 255, 255);
    width: 100%;
  }

  .cYynOC {
    border: 0px;
    padding: 0px;
    margin: 0px;
  }

  .cYynOC>.StyledLabeledControl-c11n-8-84-3__sc-1hafskn-0 {
    margin-left: 8px;
  }

  .bYdEhW {
    -webkit-box-align: center;
    align-items: center;
    flex: 1 1 0%;
    height: 55px;
    -webkit-box-pack: start;
    justify-content: flex-start;
  }

  .ggunMQ {
    display: flex;
    -webkit-box-pack: justify;
    justify-content: space-between;
  }

  input.ggtjSK.ggtjSK,
  input.ggtjSK.ggtjSK:hover,
  input.ggtjSK.ggtjSK:active,
  input.ggtjSK.ggtjSK:focus {
    border: 2px solid rgb(167, 166, 171);
  }

  input.ggtjSK.ggtjSK {
    position: static;
    height: 20px;
    width: 20px;
  }

  .CategoryRadioButton__StyledLabelControl-srp__sc-jtaiy8-1 .CategoryRadioButton__StyledRadio-srp__sc-jtaiy8-3 {
    margin-left: 8px;
    margin-top: 0px;
  }

  .ggtjSK.ggtjSK {
    appearance: none;
    box-sizing: border-box;
    display: inline-block;
    height: 20px;
    width: 20px;
    background: rgb(255, 255, 255);
    border: 2px solid rgb(167, 166, 171);
    border-radius: 50%;
    cursor: pointer;
    margin: 0px;
    outline: none;
    box-shadow: none;
  }

  .CategoryRadioButton__StyledLabelControl-srp__sc-jtaiy8-1 .xpbkb.xpbkb {
    -webkit-box-align: center;
    align-items: center;
    display: flex;
    flex: 1 1 0%;
    height: 100%;
    padding-left: 16px;
    padding-top: 9px;
  }

  .ggunMQ>.StyledCheckbox-c11n-8-84-3__sc-xbn46a-0~.StyledLabel-c11n-8-84-3__sc-qq9hfi-0,
  .ggunMQ>.Radio-c11n-8-84-3__sc-yicu80-0~.StyledLabel-c11n-8-84-3__sc-qq9hfi-0,
  .ggunMQ>.StyledSwitchWrapper-c11n-8-84-3__sc-17oy7v3-1~.StyledLabel-c11n-8-84-3__sc-qq9hfi-0 {
    color: rgb(42, 42, 51);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
  }

  .categoryRadioButton__StyledLabelControl-srp__sc-jtaiy8-1 .xpbkb.xpbkb>span {
    font-size: 18px;
  }

  .jGMQeQ {
    background: rgb(255, 255, 255);
    width: 100%;
  }

  .cYynOC {
    border: 0px;
    padding: 0px;
    margin: 0px;
  }

  .cYynOC>.StyledLabeledControl-c11n-8-84-3__sc-1hafskn-0 {
    margin-left: 8px;
  }

  .bYdEhW {
    -webkit-box-align: center;
    align-items: center;
    flex: 1 1 0%;
    height: 55px;
    -webkit-box-pack: start;
    justify-content: flex-start;
  }

  .ggunMQ {
    display: flex;
    -webkit-box-pack: justify;
    justify-content: space-between;
  }

  input.ggtjSK.ggtjSK,
  input.ggtjSK.ggtjSK:hover,
  input.ggtjSK.ggtjSK:active,
  input.ggtjSK.ggtjSK:focus {
    border: 2px solid rgb(167, 166, 171);
  }

  input.ggtjSK.ggtjSK {
    position: static;
    height: 20px;
    width: 20px;
  }

  .CategoryRadioButton__StyledLabelControl-srp__sc-jtaiy8-1 .CategoryRadioButton__StyledRadio-srp__sc-jtaiy8-3 {
    margin-left: 8px;
    margin-top: 0px;
  }

  .ggtjSK.ggtjSK {
    appearance: none;
    box-sizing: border-box;
    display: inline-block;
    height: 20px;
    width: 20px;
    background: rgb(255, 255, 255);
    border: 2px solid rgb(167, 166, 171);
    border-radius: 50%;
    cursor: pointer;
    margin: 0px;
    outline: none;
    box-shadow: none;
  }

  .ggunMQ>.StyledCheckbox-c11n-8-84-3__sc-xbn46a-0,
  .ggunMQ>.Radio-c11n-8-84-3__sc-yicu80-0 {
    margin-top: 12px;
  }

  .ggunMQ>.StyledCheckbox-c11n-8-84-3__sc-xbn46a-0,
  .ggunMQ>.Radio-c11n-8-84-3__sc-yicu80-0,
  .ggunMQ>.StyledSwitchWrapper-c11n-8-84-3__sc-17oy7v3-1 {
    flex-shrink: 0;
  }

  .CategoryRadioButton__StyledLabelControl-srp__sc-jtaiy8-1 .xpbkb.xpbkb {
    -webkit-box-align: center;
    align-items: center;
    display: flex;
    flex: 1 1 0%;
    height: 100%;
    padding-left: 16px;
    padding-top: 9px;
  }

  .ggunMQ>.StyledCheckbox-c11n-8-84-3__sc-xbn46a-0~.StyledLabel-c11n-8-84-3__sc-qq9hfi-0,
  .ggunMQ>.Radio-c11n-8-84-3__sc-yicu80-0~.StyledLabel-c11n-8-84-3__sc-qq9hfi-0,
  .ggunMQ>.StyledSwitchWrapper-c11n-8-84-3__sc-17oy7v3-1~.StyledLabel-c11n-8-84-3__sc-qq9hfi-0 {
    color: rgb(42, 42, 51);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
  }

  .CategoryRadioButton__StyledLabelControl-srp__sc-jtaiy8-1 .xpbkb.xpbkb>span {
    font-size: 18px;
  }

  .hMWkrB .DialogFooter-c11n-8-84-3__sc-1xigudn-0 {
    flex: 0 0 auto;
    -webkit-box-align: center;
    align-items: center;
    box-sizing: border-box;
    display: flex;
    -webkit-box-pack: end;
    justify-content: flex-end;
    margin: 0px;
    padding: 12px 16px;
  }

  .fhCxiM {
    display: flex;
    flex-direction: row;
    flex: 0 0 100%;
  }

  .vtgXG {
    display: flex;
    flex-direction: column;
    flex: 1 1 0%;
  }

  .fKAHIc {
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    display: inline-flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    box-sizing: border-box;
    border: 1px solid;
    border-radius: 4px;
    user-select: none;
    padding: 9px 16px;
    margin: 0px;
    appearance: none;
    transition-property: background-color, border-color, color;
    transition-duration: 0.2s;
    transition-timing-function: ease;
    pointer-events: auto;
    outline: none;
    box-shadow: none;
    width: 100%;
    position: relative;
    color: rgb(42, 42, 51);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px;
    height: auto;
  }

  .fKAHIc,
  .fKAHIc:focus,
  .fKAHIc:visited,
  .fKAHIc:disabled {
    background-color: rgb(0, 106, 255);
    border-color: rgb(0, 106, 255);
    color: rgb(255, 255, 255);
  }

  .fKAHIc::after {
    content: "";
    position: absolute;
    left: 0px;
    height: 44px;
    min-width: 44px;
    width: 100%;
    top: 50%;
    margin-top: -22px;
  }

  .kWEBZZ {
    margin: -10px 0px 0px;
  }

  .kWEBZZ fieldset {
    padding: 0px;
    margin-bottom: 5.5px;
  }

  .fxpnfk fieldset {
    padding: 0px;
    margin: 0px 0px 15px;
  }

  .gzmXwO {
    border: 0px;
    padding: 0px;
    margin: 0px;
  }

  .uzcQw:first-child {
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
  }

  .grIPLU {
    margin: 0px;
    padding: 12px 16px;
    text-transform: none;
  }

  .uzcQw {
    -webkit-font-smoothing: antialiased;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 14px;
    line-height: 24px;
    background-color: rgb(246, 246, 250);
    box-sizing: border-box;
    color: rgb(89, 107, 130);
    margin: 0px;
    padding: 12px 16px;
    text-transform: uppercase;
  }

  .ApffJ {
    display: flex;
    -webkit-box-align: center;
    align-items: center;
  }

  .gzmXwO>.StyledButtonGroup-c11n-8-84-3__sc-12tlbte-0 {
    margin-top: 8px;
  }

  .bWZuYU {
    padding: 12px 16px 0px;
  }

  .cyGSXy {
    display: flex;
    -webkit-box-align: stretch;
    align-items: stretch;
    flex-direction: row;
    position: relative;
    z-index: 1;
  }

  .cyGSXy .StyledButton-c11n-8-84-3__sc-wpcbcc-0[aria-pressed="true"],
  .cyGSXy .StyledLoadingButton-c11n-8-84-3__sc-1rron1i-0[aria-pressed="true"],
  .cyGSXy .StyledTextButton-c11n-8-84-3__sc-n1gfmh-0[aria-pressed="true"],
  .cyGSXy .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0[aria-pressed="true"] {
    z-index: 2;
  }

  .cyGSXy .StyledButton-c11n-8-84-3__sc-wpcbcc-0:first-child,
  .cyGSXy .StyledLoadingButton-c11n-8-84-3__sc-1rron1i-0:first-child,
  .cyGSXy .StyledTextButton-c11n-8-84-3__sc-n1gfmh-0:first-child,
  .cyGSXy .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0:first-child {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    border-top-right-radius: 0px;
  }

  .cyGSXy .StyledButton-c11n-8-84-3__sc-wpcbcc-0:first-child,
  .cyGSXy .StyledLoadingButton-c11n-8-84-3__sc-1rron1i-0:first-child,
  .cyGSXy .StyledTextButton-c11n-8-84-3__sc-n1gfmh-0:first-child,
  .cyGSXy .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0:first-child {
    margin-top: 0px;
    margin-left: 0px;
  }

  .cRyIQp[aria-pressed="true"][aria-pressed="true"] {
    background-color: rgb(242, 250, 255);
    border-color: rgb(0, 106, 255);
    color: rgb(42, 42, 51);
    border-width: 2px;
    padding: 4px 15px;
    line-height: 24px;
    height: auto;
  }

  .cyGSXy .StyledButton-c11n-8-84-3__sc-wpcbcc-0,
  .cyGSXy .StyledLoadingButton-c11n-8-84-3__sc-1rron1i-0,
  .cyGSXy .StyledTextButton-c11n-8-84-3__sc-n1gfmh-0,
  .cyGSXy .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0 {
    margin-top: 0px;
    margin-left: -1px;
    border-radius: 0px;
    position: relative;
    z-index: 1;
  }

  .cyGSXy .StyledButton-c11n-8-84-3__sc-wpcbcc-0,
  .cyGSXy .StyledLoadingButton-c11n-8-84-3__sc-1rron1i-0,
  .cyGSXy .StyledTextButton-c11n-8-84-3__sc-n1gfmh-0,
  .cyGSXy .StyledIconButton-c11n-8-84-3__sc-1pb8vz8-0 {
    margin-top: 0px;
    margin-left: 8px;
  }

  .AxTLf {
    flex: 1 1 0px;
  }

  .cRyIQp,
  .cRyIQp:focus,
  .cRyIQp:visited,
  .cRyIQp:disabled {
    background-color: rgb(255, 255, 255);
    border-color: rgb(167, 166, 171);
    color: rgb(42, 42, 51);
  }

  .cRyIQp {
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    display: inline-flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    box-sizing: border-box;
    border: 1px solid;
    border-radius: 4px;
    user-select: none;
    padding: 5px 16px;
    margin: 0px;
    appearance: none;
    transition-property: background-color, border-color, color;
    transition-duration: 0.2s;
    transition-timing-function: ease;
    pointer-events: auto;
    outline: none;
    box-shadow: none;
    width: auto;
    position: relative;
    color: rgb(42, 42, 51);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 14px;
    line-height: 24px;
    height: auto;
  }

  .jUDkXJ {
    display: flex;
    margin: 16px 16px 0px;
  }

  .bZPayE {
    flex: 1 1 45%;
  }

  @media (min-width: 481px) {
    .bZPayE {
      flex: 0 0 146px;
    }
  }

  .fxpnfk fieldset legend {
    line-height: 1.5;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 10px;
    margin-right: 4px;
    text-transform: capitalize;
    padding-bottom: 0px !important;
  }

  .gZUtUU {
    overflow: visible;
  }

  @media (min-width: 481px) {
    .gZUtUU {
      width: 146px;
    }
  }

  .gZUtUU input,
  .gZUtUU.gZUtUU>div,
  .gZUtUU.gZUtUU>div>div {
    cursor: pointer;
  }

  @media (min-width: 481px) {
    .gZUtUU>div {
      position: unset;
    }
  }

  .ffAram {
    position: relative;
  }

  .gZUtUU input,
  .gZUtUU.gZUtUU>div,
  .gZUtUU.gZUtUU>div>div {
    cursor: pointer;
  }

  .fqiNdw .Input-c11n-8-84-3__sc-4ry0fw-0 {
    border: 0px;
    padding: 4px 0px;
    box-shadow: none;
    flex: 1 0 25%;
    opacity: 1;
  }

  .gZUtUU input,
  .gZUtUU.gZUtUU>div,
  .gZUtUU.gZUtUU>div>div {
    cursor: pointer;
  }

  .jJHVHJ {
    appearance: none;
    width: 100%;
    margin: 0px;
    padding: 9px 16px;
    background-color: rgb(246, 246, 250);
    border: 1px solid rgb(209, 209, 213);
    border-radius: 4px;
    box-sizing: border-box;
    caret-color: rgb(0, 106, 255);
    cursor: text;
    outline: none;
    box-shadow: none;
    color: rgb(42, 42, 51);
    -webkit-font-smoothing: antialiased;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    height: auto;
  }

  .bZdiZI {
    color: rgb(42, 42, 51);
    flex: 1 1 10%;
    text-align: center;
    padding: 40px 20px 0px;
  }

  @media (min-width: 481px) {
    .bZdiZI {
      padding: 42px 11px 0px;
    }
  }

  .leaflet-polygon {
    fill: #229643;
    fill-opacity: 0.3;
    stroke: #229643;
  }

  .select2-results__option {
    padding-right: 20px;
    vertical-align: middle;
  }

  .select2-results__option:before {
    content: "";
    display: inline-block;
    position: relative;
    height: 20px;
    width: 20px;
    border: 2px solid #e9e9e9;
    border-radius: 4px;
    background-color: #fff;
    margin-right: 20px;
    vertical-align: middle;
  }

  .select2-results__option[aria-selected=true]:before {
    font-family: fontAwesome;
    content: "\f00c";
    color: #fff;
    background-color: #f77750;
    border: 0;
    display: inline-block;
    padding-left: 3px;
  }

  #bedroomNo {
    display: inline-block;
    vertical-align: top;
    overflow: hidden;
    padding-left: 5px;
    padding-right: 5px;
  }

  .bedroom-option {
    display: inline-block;
    margin-right: 5px;
    /* Additional styling for button appearance */
    padding: 5px 10px;
    border: 1px solid #ddd;
    background-color: #f8f8f8;
    cursor: pointer;
  }

  .bedroom-option.selected {
    background-color: #337ab7;
    color: white;
  }

  /* .navButton {
    display: inline-block;
    padding: 10px 20px;
    border: 1px solid black;
    text-decoration: none;
    color: black;
        font-size: 16px;
    background-color: white;
    border-radius: 5px;
  } */

  .btn {
    background: transparent !important;
  }

  .bootstrap-select {
    max-width: 200px;
  }

  .bootstrap-select .btn {
    background: white;
    margin-top: 0px;
    margin-left: 5px !important;
    margin-right: 5px;
    border: 1px solid;
    border-radius: 5px;
    border-color: black;
  }

  .bootstrap-select .dropdown-menu {
    margin: 15px 0 0;
  }

  select::-ms-expand {
    /* for IE 11 */
    display: none;
  }

  .navButton .arrow {
    display: inline-block;
    margin-left: 5px;
  }

  .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    /* width:220px; */
    width: 100% !important;
    /* height: 100%; */
  }

  .popover {
    max-width: 25%;
    /* Max Width of the popover (depending on the container!) */
  }

  .morePop {
    height: 500px;
    overflow-y: scroll;
    overflow-x: hidden;
  }

  .feature-item {
    display: flex;
    align-items: center;
    /* This aligns the checkbox and label vertically */
  }

  .feature-item .featurecheck {
    margin-right: 10px;
    /* Adjust as needed */
  }

  .moreRows {
    padding-top: 15px;
    padding-right: 25px;
  }

  .moreH3 {
    padding-bottom: 5px;

  }

  .form-control {
    height: 100% !important;
  }
</style>
<link rel="stylesheet" href="/theme/zillow/assets/css/jquery-ui.css?<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
  var marker_search = ''
</script>
<?php

use App\Helpers\Helper;

if (isset($_SESSION["user_id"])) {
  $user_id = $_SESSION["user_id"];
} else {
  $user_id = "";
}


$searched = '';
if (isset($_GET["s"]) && !isset($_GET['_r'])) {
  $searched = $_GET["s"];
}
// echo 'selDistricts: '.$selDistricts.'<br>';

$active_district_response = Helper::get_active_district();
$active_district_response = json_decode($active_district_response);

$active_municipality_response = Helper::get_active_municipality();
$active_municipality_response = json_decode($active_municipality_response);

$active_location_response = Helper::get_active_location();
$active_location_response = json_decode($active_location_response);

$active_features_response = Helper::get_active_features();
$active_features_response = json_decode($active_features_response);
$active_features = $active_features_response->data;

$active_listing_types_response = Helper::get_active_listing_types();
$active_listing_types_response = json_decode($active_listing_types_response);


$active_property_types_response = Helper::get_active_property_types();
$active_property_types_response = json_decode($active_property_types_response);

$active_marker_search = Helper::get_hashed_searched($searched);
if ($active_marker_search) {
?>
  <script>
    console.log("test")
    localStorage.setItem("freedraw-polys", '<?= ($active_marker_search->info) ?>');
    marker_search = "<?= $searched ?>";
  </script>
<?php
} elseif ($searched != '' || isset($_GET['_r'])) {
?>
  <script>
    localStorage.clear("freedraw-polys");
  </script>
<?php
}
?>


<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!-- Bootstrap-Select CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
</head>



<div class="inner-pages homepage-4 agents hp-6 full hd-white">
  <div data-zrr-key="static-search-page:search-app">
    <div class="row" style="margin-left:0.2%;">
      <div class="col-2" style="padding-left: 5px; padding-right:5px;">
        <select class="form-control select2" id="search-box-input" onkeypress="search_text();" multiple="multiple"></select>
      </div>
      <div class="col-1" style="padding-left: 5px; padding-right:5px;">
        <select class="selectpicker propertStatus" multiple data-live-search="true" data-size="5" multiple data-selected-text-format="count" multiple title="Property Status">
          <?php
          foreach ($active_property_types_response->data as $property_type) {
            echo '<option value="' . $property_type->id . '" class="propertStatus" id="propertStatus' . $property_type->id . '" >' . $property_type->displayname . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="col-1">
        <select class="selectpicker propertType" multiple data-live-search="true" multiple data-selected-text-format="count" multiple title="Property Type">
          <?php
          foreach ($active_listing_types_response->data as $listing_type) {
            echo '<option value="' . $listing_type->id . '">' . $listing_type->displayname . '</option>';
          }
          ?>
        </select>
      </div>

      <div class="col-2">
        <button data-toggle="popover" class="form-control" id="bedsAndBathButton" data-placement="bottom" data-html="true" title="Number of Bedrooms and Bathrooms">Beds & Bathrooms</button>
        <div id="popover-content-bedsAndBathButton" style="display:none;">
          <div class="">
            <fieldset class="filter_beds">
              <legend>Bedrooms</legend>
              <div aria-label="Beds Select" class="" role="group">
                <button aria-disabled="false" aria-pressed="true" value="0" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp">Any</button>
                <button aria-disabled="false" aria-pressed="false" value="1" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp">1+</button>
                <button aria-disabled="false" aria-pressed="false" value="2" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp">2+</button>
                <button aria-disabled="false" aria-pressed="false" value="3" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp">3+</button>
                <button aria-disabled="false" aria-pressed="false" value="4" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp">4+</button>
                <button aria-disabled="false" aria-pressed="false" value="5" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp">5+</button>
              </div>
              <div class="">
                <div class="">
                  <input id="exposed-filters-exact-beds-check" class="" type="checkbox">
                  <label for="exposed-filters-exact-beds" class="">Use exact match&nbsp;</label>
                </div>
              </div>
            </fieldset>
          </div>
          <div class="">
            <fieldset class="filter_baths">
              <legend>Bathrooms</legend>
              <div name="baths-options" aria-label="Baths Select" class="" role="group">
                <button aria-disabled="false" aria-pressed="true" value="0" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp">Any</button>
                <button aria-disabled="false" aria-pressed="false" value="1" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp">1+</button>
                <button aria-disabled="false" aria-pressed="false" value="1.5" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp">1.5+</button>
                <button aria-disabled="false" aria-pressed="false" value="2" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp">2+</button>
                <button aria-disabled="false" aria-pressed="false" value="3" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp">3+</button>
                <button aria-disabled="false" aria-pressed="false" value="4" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp">4+</button>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
      <div class="col-2">
        <button href="#" data-toggle="popover" class="form-control" id="priceButton" data-placement="bottom" title="Price Range">Price</button>
        <div id="popover-content-priceButton" style="display:none;">
          <form id="priceForm" autocomplete="off" style="width:300px;">
            <div class="row">
              <div class="col-5">
                <label for="minPrice">Min Price</label>
              </div>
              <div class="col-2">
                <p></p>
              </div>
              <div class="col-5">
                <label for="maxPrice">Max Price</label>
              </div>
            </div>
            <div class="row">
              <div class="col-5">
                <select id="minPrice" name="minPrice">
                  <option value="">Any</option>
                  <option value="50000">$50,000</option>
                  <option value="100000">$100,000</option>
                </select>
              </div>
              <div class="col-2 text-center pl-0 pr-0">
                <p>-</p>
              </div>
              <div class="col-5">
                <select id="maxPrice" name="maxPrice">
                  <option value="">Any</option>
                  <option value="200000">$200,000</option>
                  <option value="300000">$300,000</option>
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-1">
        <!-- <div class=" dropdown-filter" style="border: 1px solid;border-radius: 5px;border-color: black;width: 100px;height: 45px;margin-right: 25px;display: flex;justify-content: center;align-items: center;">
          <a>More</a>
        </div> -->
        <button data-toggle="popover" class="form-control" id="moreButton" data-placement="bottom" data-html="true" title="More">More</button>
        <div id="popover-content-moreButton" style="display:none;">
          <div class="morePop">
            <div class="row">
              <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 " id="location_mobilediv" style="width: 132px"></div>
              <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 " id="property_status_mobilediv" style="width: 175x"></div>
              <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 " id="property_type_mobilediv" style="width: 132px"></div>
            </div>
            <div class="row">
              <form id="squareFeetForm" class="col-12" style="padding-right: 25px;" autocomplete="off">
                <div class="row">
                  <div class="col-12">
                    <h3 for="minSquareFeet" class="moreH3 ">Square Feet</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-5">
                    <select id="minSquareFeet" name="minSquareFeet">
                      <option value="">0</option>
                      <option value="500">500</option>
                      <option value="750">750</option>
                    </select>
                  </div>
                  <div class="col-xx text-center pl-0 pr-0">
                    <p>-</p>
                  </div>
                  <div class="col-5">
                    <select id="maxSquareFeet" name="maxSquareFeet">
                      <option value="">0</option>
                      <option value="500">500</option>
                      <option value="750">750</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
            <div class="row">
              <form id="lotSizeForm" class="col-12 moreRows" autocomplete="off">
                <div class="row">
                  <div class="col-12">
                    <h3 for="minLotSize" class="moreH3">Lot Size</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-5">
                    <select id="minLotSize" name="minLotSize">
                      <option value="">0</option>
                      <option value="500">500</option>
                      <option value="750">750</option>
                    </select>
                  </div>
                  <div class="col-xx text-center pl-0 pr-0">
                    <p>-</p>
                  </div>
                  <div class="col-5">
                    <select id="maxLotSize" name="maxLotSize">
                      <option value="">0</option>
                      <option value="500">500</option>
                      <option value="750">750</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 moreRows" style="  padding-left: 0px !important;">
              <h3 class="moreH3">Other Features!</h6>
                <!-- Checkboxes -->
                <div class="checkboxes margin-bottom-10">
                  <?php
                  $halfPoint = ceil(count($active_features) / 2);
                  foreach ($active_features as $key => $feature) {
                    if ($key % $halfPoint == 0) {
                      if ($key != 0) {
                        echo '</div>';
                      }
                      echo '<div class="row">';
                    }

                    echo '<div class="col-md-6 feature-item">';
                    echo '<input id="fcheck-' . $feature->id . '" type="checkbox" class="featurecheck" value="' . $feature->id . '" name="features[]">';
                    echo '<label for="fcheck-' . $feature->id . '">' . $feature->displayname . '</label>';
                    echo '</div>';

                    if ($key % $halfPoint == $halfPoint - 1) {
                      echo '</div>';
                    }
                  }
                  if (count($active_features) % $halfPoint != 0) {
                    echo '</div>';
                  }
                  ?>
                </div>
            </div>
          </div>
        </div>
        <div class="col-1">
          <div class="search-page-action-bar">
            <div class="action-bar-left-content">
              <button onclick="searchNowListingMap()" class="form-control save-search-button" tabindex="0" role="button" type="button" rel="nofollow" aria-label="Save search" aria-expanded="false" aria-haspopup="dialog">
                Search Now
              </button>
            </div>
          </div>
        </div>
        <div class="col-1">
          <div class="action-bar-left-content">
            <button onclick="searchReset()" class="form-control save-search-button" tabindex="0" role="button" type="button" rel="nofollow" aria-label="Save search" aria-expanded="false" aria-haspopup="dialog">
              Reset Search
            </button>
          </div>
          <div class="action-bar-right-content">

            <a class="saved-homes-link saved-homes-visual-audit" tabindex="0" rel="nofollow" aria-label="Saved Homes" href="/myzillow/favorites"><strong></strong></a>
            <!-- //2 Saved Homes -->
          </div>
        </div>
      </div>

    </div>
    <section class="SearchPageHeaderContainer SearchPageHeaderContainer__StyledSearchPageHeaderContainer-srp__sc-h52t73-0 duceJr search-page-header wide has-floating-action-bar" aria-label="filters">
      <!-- <span id="clonedesktop" > -->
      <div id="location_desktopdiv" class="rld-single-select  searchBarDiv" style="width: 132px">
        <!-- <input type="hidden" id="selLocation" name="selLocation" value=""> -->
        <nav id="navigation" class="style-1" style="background: white; margin-top:0px;margin-left: 5px!important;margin-right: 5px;border: 1px solid;border-radius: 5px;border-color: black;">
          <ul>
            <li><a id="location_title">Location</a>
              <ul id="activelocation">
                <?php
                foreach ($active_district_response->data as $district) {
                  echo '<li class="parent locationLi">
                        <a style="display: flex;align-items: center;"><input type="checkbox" id="districts' . $district->id . '" class="district" name="district[]" value="' . $district->id . '" onchange="changeLocationsListingMap(\'districts\',\'' . $district->id . '\',\'' . $district->displayname . '\')">' . $district->displayname . ' </a>
                        <div class="wrapper" style="top: 0px; left: 208px;">
                            <ul style="transform:none;position:initial; visibility: visible;opacity: 100; overflow-x: hidden; overflow-y: auto; max-height: 500px;" id="subDistricts' . $district->id . '">';
                  foreach ($active_municipality_response->data as $municipality) {
                    if ($district->id == $municipality->district_id) {
                      echo '<li class="parent locationLi">
                            <a style="display: flex;align-items: center;"><input type="checkbox" id="municipalities' . $municipality->id . '" class="municipality" name="municipality[]" value="' . $municipality->id . '" onchange="changeLocationsListingMap(\'municipalities\',\'' . $municipality->id . '\',\'' . $municipality->displayname . '\')">' . $municipality->displayname . '</a>
                            <div class="wrapper">
                                <ul style="visibility: visible;opacity: 100;" id="subMunicipalities' . $municipality->id . '">';
                      foreach ($active_location_response->data as $location) {
                        if ($location->municipality_id == $municipality->id) {
                          echo '<li>
                                <a style="display: flex;align-items: center;">
                                <input type="checkbox" id="locations' . $location->id . '" class="location" name="location[]" value="' . $location->id . '" onchange="changeLocationsListingMap(\'locations', '' . $location->id . '', '' . $location->displayname . '\')">' . $location->displayname . '</a>
                            </li>';
                        }
                      }
                      echo '</ul>
                              </div>
                          </li>';
                    }
                  }
                  echo '</ul>
                          </div>
                      </li>';
                }
                ?>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
      
      <!-- </span> -->
      <!-- <div id="clonemobile">clone mobile</div> -->



    </section>
  </div>

  <section class="properties-right featured portfolio blog google-map-right mp-1" style="padding: 0px!important;">
    <div class="container-fluid">
      <div class="row" style="width: 100%;background-color: white;">
        <aside id="MapListingMap" class="col-lg-6 col-md-6 google-maps-left mt-0 MobileHiddenMap" style="height: 100%;display: block;">
          <div class="alert-box success" id="map_success" style="position: absolute;z-index: 9;width: 100%;margin-top: 80px;">Click on the map to select center and radius</div>
          <div class="row" style="padding: 25px 0px 0px 0px;position: absolute;z-index: 9;width: 50%;left: 50%;">
            <div class="col-xl-12 xsRow" style="display: flex;justify-content: flex-end;margin-right: 10px;">
              <a style="display: none;justify-content: center;align-items: center;margin-right:20px;" class="btn btn-map" id="redrawCircleListingMap" onclick="redrawCircleListingMap();">Re-draw</a>
              <!-- <a style="margin-top: 0px; display: flex;justify-content: center;align-items: center;" class="btn btn-map" id="showCircleListingMap" onclick="showCircleListingMap();">Draw</a> -->
              <button style="display: flex;justify-content: center;align-items: center;margin: 0px 5px 0px 5px;" type="button" class="btn btn-map" data-toggle="button" aria-pressed="false" id="freeDrawingMap" onclick="freeDrawingMap();">
                Free-Draw
              </button>
              <a style="margin-top: 0px; display: flex;justify-content: center;align-items: center;" class="btn btn-map" id="clearDrawingsMap" onclick="clearDrawingsMap();">Clear</a>
            </div>
          </div>
          <div id="map-leaflet"></div>
        </aside>
        <div id="ListingListingMapDiv" class="col-lg-6 col-md-12 google-maps-right ListingListingMapDiv">
          <section>
            <div class="pro-wrapper">
              <div class="detail-wrapper-body">
                <div class="listing-title-bar">
                  <div class="text-heading text-left">
                    <p class="font-weight-bold mb-0 mt-3" id="page_count"></p>
                  </div>
                </div>
              </div>
              <div class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center">
                <div class="input-group border rounded input-group-lg w-auto mr-4">
                  <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby" id="paginSize" onchange="loadActiveListingsListingMap([0,0],0,9)" name="paginSize">
                    <option selected value="20">20</option>
                    <option value="40">40</option>
                    <option value="60">60</option>
                    <option value="80">80</option>
                  </select>
                </div>
                <div class="input-group border rounded input-group-lg w-auto mr-4">
                  <label class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3" for="inputGroupSelect01"><i class="fas fa-align-left fs-16 pr-2"></i>Sortby:</label>
                  <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby" onchange="loadActiveListingsListingMap([0,0],0,9)" data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3" id="sortby" name="sortby">
                    <option value="1">Latest</option>
                    <option value="2">Price(low to high)</option>
                    <option value="3">Price(high to low)</option>
                  </select>
                </div>

              </div>
            </div>
          </section>
          <div class="ListMobile row" id="ListingListContent">

          </div>
          <nav aria-label="..." style="padding: 20px;display: flex;justify-content: center;">
            <ul class="pagination mt-0" id="pagin_content">
            </ul>
          </nav>
        </div>
        <div class="ViewListMap">
          <a onclick="replaceview();" style="padding: 10px 20px 10px 20px;background: #398a39;border-radius: 5px;cursor: pointer;color:white;" id="showMapListingListingMap">Show Map</a>
        </div>
      </div>
      <input type="hidden" id="page_index" value="1">
    </div>
  </section>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap-Select JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var selectedBedValue = 'Any';
    var selectedBathroomValue = 'Any';

    //Takes the id for a popover and loads it according to what is passed
    $("[data-toggle=popover]").each(function(i, obj) {
      $(this).popover({
        html: true,
        sanitize: false,
        content: function() {
          var id = $(this).attr('id');
          return $('#popover-content-' + id).html();
        }
      });
    });

    //Listens for when a button inside the filter_beds class is pressed and updates as needed
    $('body').on('click', '.filter_beds button', function() {
      selectedBedValue = $(this).text();
      updateSelectionText();
    });

    //Listens for when a button inside the filter_baths class is pressed and updates as needed
    $('body').on('click', '.filter_baths button', function() {
      selectedBathroomValue = $(this).text();
      updateSelectionText();
    });

    //Updates the text displayed at the top field of the bed and bath button
    function updateSelectionText() {
      var displayText = selectedBedValue + ' Beds - ' + selectedBathroomValue + ' Bathrooms';
      $('#bedsAndBathButton').text(displayText);
    }

    $('body').on('change', '#exposed-filters-exact-beds-check', function() {
      var useExactMatch = $(this).is(':checked');

      $('.filter_beds button').each(function() {
        var buttonText = $(this).text();

        if (useExactMatch) {
          buttonText = buttonText.replace('+', '');
        } else {
          var buttonValue = $(this).attr('value');
          if (buttonValue !== '0' && !buttonText.includes('+')) {
            buttonText += '+';
          }
        }

        $(this).text(buttonText);
      });
      var bedsButtonText = $('#bedsAndBathButton').text();
      if (useExactMatch) {
        selectedBedValue = selectedBedValue.replace('+', '');
      } else {
        if (!selectedBedValue.includes('+') && selectedBedValue !== 'Any') {
          selectedBedValue += '+';
        }
      }
      updateSelectionText();
    });

    $('body').on('change', '.popover #minPrice, .popover #maxPrice', function() {
      // Fetch the selected values from the dropdowns within the active popover
      var minPrice = $('.popover #minPrice').find(":selected").text();
      var maxPrice = $('.popover #maxPrice').find(":selected").text();

      console.log(minPrice);
      console.log(maxPrice);

      var priceText = 'Price: ';

      priceText += minPrice !== 'Any' ? 'Min ' + minPrice : 'Min Any';
      priceText += ' - ';
      priceText += maxPrice !== 'Any' ? 'Max ' + maxPrice : 'Max Any';

      $('#priceButton').text(priceText);
    });


    $('#search-box-input').select2({
      maximumSelectionLength: 10,
      size: '10',
      tokenSeparators: [',', ' '],
      placeholder: "District, Municipality, Location",
      minimumInputLength: 1,
      ajax: {
        url: "/api/getLocationSearch",
        type: 'POST',
        dataType: 'json',
        delay: 250,
        data: function(params) {
          var dataToSend = {
            data: params.term
          };
          console.log(dataToSend);
          return JSON.stringify(dataToSend);
        },

        processResults: function(data) {
          return {
            results: data.map(item => {
              return {
                id: item.id,
                text: item.name + ' (' + item.type + ')',
                type: item.type
              };
            })
          };
        },
        cache: true,
        contentType: "application/json",
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('AJAX error: ' + textStatus + ', ' + errorThrown);
        }
      }
    });


    // $('#searchButton').click(function() {
    //   var selectedData = $('#search-box-input').select2('data');
    //   var propertyStatus = $('#propertyStatusDropdown').val();

    //   var districtIds = [],
    //     municipalityIds = [],
    //     locationIds = [];

    //   selectedData.forEach(function(item) {
    //     switch (item.type) {
    //       case "District":
    //         districtIds.push(item.id);
    //         break;
    //       case "Municipality":
    //         municipalityIds.push(item.id);
    //         break;
    //       case "Location":
    //         locationIds.push(item.id);
    //         break;
    //     }
    //   });

    //   // Construct the URL
    //   var url = "/page/listings?";
    //   if (districtIds.length > 0) {
    //     url += "district=" + districtIds.join(',') + "&";
    //   }
    //   if (municipalityIds.length > 0) {
    //     url += "municipality=" + municipalityIds.join(',') + "&";
    //   }
    //   if (locationIds.length > 0) {
    //     url += "location=" + locationIds.join(',') + "&";
    //   }
    //   if (propertyStatus !== "") {
    //     url += "property_status=" + propertyStatus + "&";
    //   }

    //   // Remove the last '&' or '?' from the URL
    //   url = url.slice(0, -1);

    //   window.location.href = url;
    // });

  });
  // clearDrawingsMap();
  var view = '<?php echo $view; ?>';

  var map = null;

  var circle;
  var viewCircleFlag = 0;
  // area_size=0%20sq%20,1300%20sq%20&price_rang
  search_term = '<?php if (isset($_GET['search_term'])) echo $_GET['search_term'];
                  else echo ""; ?>';
  if (search_term > 0) {
    document.getElementById("search-box-input").value = search_term;
  }
  number_of_bathrooms = '<?php if (isset($_GET['bathrooms'])) echo $_GET['bathrooms'];
                          else echo ""; ?>';
  if (number_of_bathrooms > 0) {
    document.getElementById("selBathrooms").value = number_of_bathrooms;
  }
  number_of_bedrooms = '<?php if (isset($_GET['bedrooms'])) echo $_GET['bedrooms'];
                        else echo ""; ?>';
  if (number_of_bedrooms > 0) {
    document.getElementById("selBedrooms").value = number_of_bedrooms;
  }
  temp = '<?php if (isset($_GET['features'])) echo $_GET['features'];
          else echo ""; ?>';
  if (temp !== '') {
    features = temp.split(",");
    for (var j = 0; j < features.length; j++) {
      document.getElementById('fcheck-' + features[j]).checked = true;
    }
  }
  temp = '<?php if (isset($_GET['district'])) echo $_GET['district'];
          else echo ""; ?>';
  if (temp !== '') {
    districts = temp.split(",");
    for (var j = 0; j < districts.length; j++) {
      document.getElementById('districts' + districts[j]).checked = true;
    }
  }
  temp = '<?php if (isset($_GET['municipality'])) echo $_GET['municipality'];
          else echo ""; ?>';
  if (temp !== '') {
    municipalities = temp.split(",");
    for (var j = 0; j < municipalities.length; j++) {
      document.getElementById('municipalities' + municipalities[j]).checked = true;
    }
  }
  temp = '<?php if (isset($_GET['location'])) echo $_GET['location'];
          else echo ""; ?>';
  if (temp !== '') {

    locations = temp.split(",");
    for (var j = 0; j < locations.length; j++) {
      document.getElementById('locations' + locations[j]).checked = true;
    }
  }
  temp = '<?php if (isset($_GET['property_type'])) echo $_GET['property_type'];
          else echo ""; ?>';
  if (temp !== '') {

    listing_types = temp.split(",");
    for (var j = 0; j < listing_types.length; j++) {
      document.getElementById('propertTypes' + listing_types[j]).checked = true;
    }
  }
  temp = '<?php if (isset($_GET['property_status'])) echo $_GET['property_status'];
          else echo ""; ?>';
  if (temp !== '') {

    listing_status = temp.split(",");
    for (var j = 0; j < listing_status.length; j++) {
      document.getElementById('propertStatus' + listing_status[j]).checked = true;
    }
  }
  // }

  // map_init_circle([], [0,0], 0, 9);
  // localStorage.clear();
  //  localStorage.removeItem("freedraw-polys");


  loadActiveListingsListingMap([0, 0], 0, 9);

  function loadPageListingMap(index, maker_position0, maker_position1, set, zoom) {
    document.getElementById("page_index").value = index;
    $('html,body').scrollTop(0);
    loadActiveListingsListingGrid([maker_position0, maker_position1], set, zoom);
  }


  function loadActiveListingsListingGrid(maker_position, set, zoom, freedraw = false) {
    customer_id = '<?php echo $user_id; ?>';
    number_of_bathrooms = "";
    // if (document.getElementById("selBathrooms").value > 0) {
    //   number_of_bathrooms = document.getElementById("selBathrooms").value;
    // }
    number_of_bathrooms = 0;
    number_of_bedrooms = "";
    // if (document.getElementById("selBedrooms").value > 0) {
    //   number_of_bedrooms = document.getElementById("selBedrooms").value;
    // }
    number_of_bedrooms = 0;
    var tempFeatures = [];
    var features = document.getElementsByClassName('featurecheck');
    for (var j = 0; j < features.length; j++) {
      if (features[j].checked) {
        tempFeatures.push(features[j].value);
      }
    }
    var tempDistrictArr = [];
    var districts = document.getElementsByClassName('district');
    for (var j = 0; j < districts.length; j++) {
      if (districts[j].checked) {
        tempDistrictArr.push(districts[j].value);
      }
    }

    var tempMunicipalitiesArr = [];
    var municipalities = document.getElementsByClassName('municipality');
    for (var j = 0; j < municipalities.length; j++) {
      if (municipalities[j].checked) {
        tempMunicipalitiesArr.push(municipalities[j].value);
      }
    }
    var tempLocationArr = [];
    var locations = document.getElementsByClassName('location');
    for (var j = 0; j < locations.length; j++) {
      if (locations[j].checked) {
        tempLocationArr.push(locations[j].value);
      }
    }


    var tempPropertStatus = [];
    var propertyStatusSelect = document.querySelector('.selectpicker.propertStatus'); 
    if (propertyStatusSelect) {
      var options = propertyStatusSelect.options;
      for (var j = 0; j < options.length; j++) {
        if (options[j].selected) {
          tempPropertStatus.push(options[j].value);
        }
      }
    }


    var tempPropertTypes = [];
    var propertTypes = document.querySelector('.selectpicker.propertType');
    if (propertyStatusSelect) {
      var options = propertTypes.options;
      for (var j = 0; j < options.length; j++) {
        if (options[j].selected) {
          tempPropertTypes.push(options[j].value);
        }
      }
    }



    var price1 = 0;
    var size1 = 0;
    var price2 = 600000;
    var size2 = 1300;

    if ($('.first-slider-value').length > 0) {
      var price1 = document.getElementsByClassName("first-slider-value")[1].value;
      var size1 = document.getElementsByClassName("first-slider-value")[0].value;
      size1 = size1.substring(0, size1.length - 6);
      price1 = price1.substring(1);
      price1 = price1.replace(",", "");
    }
    if ($('.second-slider-value').length > 0) {
      var price2 = document.getElementsByClassName("second-slider-value")[1].value;
      var size2 = document.getElementsByClassName("second-slider-value")[0].value;
      size2 = size2.substring(0, size2.length - 6);
      price2 = price2.substring(1);
      price2 = price2.replace(",", "");
    }

    search_term = "";
    if (document.getElementById('search-box-input').value == "") {
      search_term = "";
    } else {
      search_term = document.getElementById('search-box-input').value;
    }
    orderbyName = "";
    orderbyType = "";
    switch (document.getElementById("sortby").value) {
      case "1":
        orderbyName = "updated_at";
        orderbyType = "desc";
        break;
      case "2":
        orderbyName = "price";
        orderbyType = "asc";
        break;
      case "3":
        orderbyName = "price";
        orderbyType = "desc";
        break;
    }
    console.log("marker_search" + marker_search);

    var newurl = '<?php echo env('APP_URL'); ?>/page/listings?search_term=' + search_term;
    newurl += '&s=' + marker_search;
    newurl += '&district=' + tempDistrictArr;
    newurl += '&municipality=' + tempMunicipalitiesArr;
    newurl += '&location=' + tempLocationArr;
    newurl += '&property_status=' + tempPropertStatus;
    newurl += '&property_type=' + tempPropertTypes;
    newurl += '&bedrooms=' + number_of_bedrooms;
    newurl += '&bathrooms=' + number_of_bathrooms;
    newurl += '&area_size=' + size1 + ',' + size2;
    newurl += '&price_range=' + price1 + ',' + price2;
    newurl += '&features=' + tempFeatures;
    newurl += '&draw_map=' + '';
    newurl += '&view=' + view;
    window.history.pushState({
      path: newurl
    }, '', newurl);
    var markers = localStorage.getItem("freedraw-polys");

    const sendData = {
      "number_of_bathrooms": number_of_bathrooms,
      "number_of_bedrooms": number_of_bedrooms,
      "listing_types": tempPropertTypes,
      "features": tempFeatures,
      "min_area_size": parseInt(size1),
      "max_area_size": parseInt(size2),
      "min_price": parseInt(price1),
      "max_price": parseInt(price2),
      "property_type_array": tempPropertStatus,
      "districts": tempDistrictArr,
      "municipalities": tempMunicipalitiesArr,
      "locations": tempLocationArr,
      "search_term": search_term,
      "customer_id": customer_id,
      "page": document.getElementById("page_index").value,
      "per_page": document.getElementById("paginSize").value,
      "orderbyName": orderbyName,
      "orderbyType": orderbyType,
      "radius": maker_position,
      "set": set,
      "retrieve_markers": 1
    };
    ps = localStorage.getItem("freedraw-polys")
    if (ps)
      sendData.markers = JSON.parse(ps)
    const url = "/api/activelistings";
    let xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/json');
    xhr.send(JSON.stringify(sendData));
    xhr.onload = function() {
      if (document.getElementById("page_index").value == 1) {
        markers = JSON.parse(xhr.response).listing_markers;
        var markersArray = [];
        for (i = 0; i < markers.length; i++) {
          if (markers[i].center[0] > 0) {
            markersArray.push(markers[i]);
          }
        }
        map_init_circle(markersArray, maker_position, set, zoom);
      }

      list = JSON.parse(xhr.response).items.data;
      const url = new URL(window.location.href);
      if (typeof JSON.parse(xhr.response).hash !== "undefined") {
        url.searchParams.set('s', JSON.parse(xhr.response).hash);

      } else {
        url.searchParams.delete('s');
      }
      window.history.replaceState(null, null, url);

      //list = list.data;
      totalrecords = JSON.parse(xhr.response).items.total;
      current_page = JSON.parse(xhr.response).items.current_page;
      per_page = JSON.parse(xhr.response).items.per_page;
      // alrt(total);
      // var valueArray = [];
      var temp = "";
      for (i = 0; i < list.length; i++) {
        listingStr = "";
        for (j = 0; j < list[i].listing_types.length; j++) {
          if (j == 0) {
            listingStr += list[i].listing_types[j];
          } else {
            listingStr += " , " + list[i].listing_types[j];
          }
        }
        if (list[i].property_type !== "") {
          if (listingStr == "") {
            listingStr += list[i].property_type;
          } else {
            listingStr += " , " + list[i].property_type;
          }
        }
        favorite = "";
        if (list[i].in_favoriteproperties == 1) {
          favorite = 'style="fill: red;"';
        }
        temp += `<div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale" style="padding:5px;">
                        <article  role="group" data-testid="Homes For You-card-0" class="StyledPropertyCard-c11n-8-86-1__sc-jvwq6q-0 bnlSnT">
                            <div  aria-label="4334 Union St APT 1E, Flushing, NY 11355" class="StyledCard-c11n-8-86-1__sc-rmiu6p-0 dVWlBO StyledPropertyCardBody-c11n-8-86-1__sc-1p5uux3-0 ffvFdw" tabindex="0">
                                <div class="StyledPropertyCardDataWrapper-c11n-8-86-1__sc-1omp4c3-0 daWIrq">
                                    <div class="StyledPropertyCardDataArea-c11n-8-86-1__sc-yipmu-0 zybOF">`;
        // console.log(list[i].price);
        if (parseInt(list[i].price) > 0) {

          temp += `€ ` + list[i].price;
        }
        temp += `  <span style="font-size: 17px;margin-left: 20px;">` + list[i].location_name + `</span></div>
                                    <div class="StyledPropertyCardDataArea-c11n-8-86-1__sc-yipmu-0 bLsshH">
                                        <span class="StyledPropertyCardHomeDetails-c11n-8-86-1__sc-1mlc4v9-0 ebUkxz">`;
        if (parseInt(list[i].number_of_bedrooms) > 0) {
          temp += `<span>
                                                <b>` + list[i].number_of_bedrooms + `</b> bds
                                            </span>`;
        }
        if (parseInt(list[i].number_of_bathrooms) > 0) {
          temp += `<span>
                                                <b>` + list[i].number_of_bathrooms + `</b> ba
                                            </span>`;
        }
        if (parseInt(list[i].area_size) > 0) {
          temp += `<span>
                                                <b>` + list[i].area_size + `</b> sqft
                                            </span>`;
        }
        temp += `</span>
                                        <span>` + listingStr + `</span>
                                    </div>
                                    <a onclick="showListigDetailModal(` + list[i].id + `);" tabindex="-1" class="StyledPropertyCardDataArea-c11n-8-86-1__sc-yipmu-0 bWMoAg" style="text-decoration: none;">
                                        <address>` + list[i].displayname + `</address>
                                    </a>
                                    <div class="StyledPropertyCardDataArea-c11n-8-86-1__sc-yipmu-0 cuZKL">LISTING BY: SABBIANCO PROPERTIES LTD</div>
                                    <div class="StyledPropertyCardActionArea-c11n-8-86-1__sc-l8gezt-0 gUZfaS"></div>
                                </div>
                                <div class="StyledPropertyCardPhotoWrapper-c11n-8-86-1__sc-204bo4-0 jBRDYV">
                                    <div class="StyledPropertyCardPhotoHeader-c11n-8-86-1__sc-10m3z6y-0 gGpqXV">
                                        <div class="StyledPropertyCardBadgeArea-c11n-8-86-1__sc-wncxdw-0 OPwBD"></div>
                                        <div class="StyledPropertyCardSaveArea-c11n-8-86-1__sc-15nlng8-0 kMnzOu">
                                            <button aria-disabled="false" onclick="addFavoritListingMap(` + list[i].id + `)" aria-pressed="false" aria-label="Save" data-testid="property-card-save" class="StyledButton-c11n-8-86-1__sc-wpcbcc-0 YDAbE StyledPropertyCardSaveButton-c11n-8-86-1__sc-dquvr7-0 dsoFUX">
                                                <span class="StyledButtonIcon-c11n-8-86-1__sc-wpcbcc-1 fGXTKq">
                                                    <svg viewBox="0 0 24 22">
                                                        <path id="faHeart` + list[i].id + `" ` + favorite + ` class="HeartIcon__fill" d="M17.3996 6.17511e-05C15.5119 0.00908657 13.7078 0.779206 12.3955 2.13608L11.9995 2.54408L11.6035 2.13608C10.2912 0.779206 8.48708 0.00908657 6.59946 6.17511e-05C5.15317 -0.00630912 3.7479 0.480456 2.61543 1.38007C1.08163 2.60976 0.137114 4.42893 0.0137749 6.39093C-0.109564 8.35294 0.5997 10.2761 1.96743 11.6882L2.51943 12.2522L11.3995 21.3482C11.5575 21.5095 11.7738 21.6004 11.9995 21.6004C12.2253 21.6004 12.4415 21.5095 12.5995 21.3482L21.4796 12.2522L22.0316 11.6882C23.3993 10.2761 24.1086 8.35294 23.9852 6.39093C23.8619 4.42893 22.9174 2.60976 21.3836 1.38007C20.2511 0.480456 18.8458 -0.00630912 17.3996 6.17511e-05Z"></path>
                                                        <path class="HeartIcon__outline" d="M12.3955 2.13608C13.7078 0.779206 15.5119 0.00908657 17.3996 6.17511e-05C18.8458 -0.00630912 20.2511 0.480456 21.3836 1.38007C22.9174 2.60976 23.8619 4.42893 23.9852 6.39093C24.1086 8.35294 23.3993 10.2761 22.0316 11.6882L21.4796 12.2522L12.5995 21.3482C12.4415 21.5095 12.2253 21.6004 11.9995 21.6004C11.7738 21.6004 11.5575 21.5095 11.3995 21.3482L2.51943 12.2522L1.96743 11.6882C0.5997 10.2761 -0.109564 8.35294 0.0137748 6.39093C0.137114 4.42893 1.08163 2.60976 2.61543 1.38007C3.7479 0.480456 5.15317 -0.00630912 6.59946 6.17511e-05C8.48708 0.00908657 10.2912 0.779206 11.6035 2.13608L11.9995 2.54408L12.3955 2.13608ZM19.8956 3.25208C19.1854 2.69122 18.3045 2.39053 17.3996 2.40008C16.1576 2.41525 14.9717 2.91978 14.0995 3.80409L13.7155 4.21209L12.4315 5.5321C12.1927 5.77011 11.8063 5.77011 11.5675 5.5321L10.2835 4.21209L9.8995 3.80409C9.0273 2.91978 7.84145 2.41525 6.59947 2.40008C5.69165 2.39734 4.81045 2.70661 4.10345 3.27608C3.09352 4.06928 2.47292 5.25804 2.39944 6.54011C2.31914 7.81608 2.78104 9.06669 3.67145 9.98414L4.22345 10.5601L11.9995 18.5162L19.8476 10.5601L20.3996 9.98414C21.2638 9.05458 21.6991 7.80545 21.5996 6.54011C21.5329 5.2495 20.9116 4.05071 19.8956 3.25208Z"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="StyledPropertyCardPhotoBody-c11n-8-86-1__sc-128t811-0 elHFdM">
                                        <a onclick="showListigDetailModal(` + list[i].id + `);" tabindex="-1" aria-hidden="false" class="Anchor-c11n-8-86-1__sc-hn4bge-0 ifquJH" style="display: block; height: 100%;">
                                            <div class="StyledPropertyCardPhoto-c11n-8-86-1__sc-ormo34-0 bGxHGW">
                                                <img src="` + list[i].image + `" alt="4334 Union St APT 1E, Flushing, NY 11355" aria-hidden="false" draggable="auto" class="Image-c11n-8-86-1__sc-1rtmhsc-0" data-xblocker="passed" style="visibility: visible;">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="StyledPropertyCardPhotoFooter-c11n-8-86-1__sc-bdiiml-0 kPCjYF"></div>
                                </div>
                            </div>
                        </article>
                    </div>`;
      }
      document.getElementById("ListingListContent").innerHTML = temp;
      document.getElementById("page_count").innerHTML = totalrecords + " Search results"
      if (list.length > 0) {
        document.getElementById("ListingListContent").style.height = "auto";
      } else {
        document.getElementById("ListingListContent").style.height = "500px";
      }

      sendData1 = {
        "total": totalrecords,
        "current_page": current_page,
        "per_page": per_page,
      }
      const url1 = "/api/getpagination";
      let xhr1 = new XMLHttpRequest();
      xhr1.open('POST', url1, true);
      xhr1.setRequestHeader('Content-type', 'application/json');
      xhr1.send(JSON.stringify(sendData1));
      xhr1.onload = function() {
        data1 = JSON.parse(xhr1.response);
        list1 = data1.links;
        temp1 = "";
        if (window.innerWidth > 650) {
          for (j = 0; j < list1.length; j++) {
            tempUrl = list1[j].url;
            if (tempUrl == null) {
              tempIndex = null;
            } else {
              tempIndex = tempUrl.substring(tempUrl.indexOf("?page=") + 6);
            }
            flag = "";
            if (list1[j].active) {
              flag = "active";
            }
            temp1 += `<li class="page-item ` + flag + `"><a class="page-link" onclick="loadPageListingMap(` + tempIndex + `,` + maker_position[0] + `,` + maker_position[1] + `,` + set + `,` + zoom + `)">` + list1[j].label + `</a></li>`;
          }
        } else {
          for (j = 0; j < list1.length; j++) {
            tempUrl = list1[j].url;
            if (tempUrl == null) {
              tempIndex = null;
            } else {
              tempIndex = tempUrl.substring(tempUrl.indexOf("?page=") + 6);
            }
            if (j == 0 || j == list1.length - 1) {
              temp1 += `<li class="page-item"><a class="page-link" onclick="loadPageListingMap(` + tempIndex + `,` + maker_position[0] + `,` + maker_position[1] + `,` + set + `,` + zoom + `)">` + list1[j].label + `</a></li>`;
            } else {
              if (list1[j].active) {
                flag = "active";
                temp1 += `<li class="page-item ` + flag + `"><a class="page-link" onclick="loadPageListingMap(` + tempIndex + `,` + maker_position[0] + `,` + maker_position[1] + `,` + set + `,` + zoom + `)">` + list1[j].label + `</a></li>`;
              }
            }
          }
        }
        document.getElementById("pagin_content").innerHTML = temp1;

      }
    }
  }

  function loadActiveListingsListingMap(maker_position, set, zoom) {
    document.getElementById("page_index").value = 1;
    loadActiveListingsListingGrid(maker_position, set, zoom);
  }

  function addFavoritListingMap(index) {

    customer_id = '<?php echo $user_id; ?>';
    if (customer_id !== "") {
      const url = "/api/add-remove-to-favorites";
      const sendData = {
        "customer_id": customer_id,
        "listing_id": index,
      };
      let xhr = new XMLHttpRequest();
      xhr.open('POST', url, true);
      xhr.setRequestHeader('Content-type', 'application/json');
      xhr.send(JSON.stringify(sendData));
      xhr.onload = function() {
        var paragraph = document.getElementById("faHeart" + index);
        if (paragraph.style.fill !== "red") {
          paragraph.style.fill = "red";
        } else {
          paragraph.style.fill = "currentColor";
        }
      }
    } else {
      loginIn();
    }
  }

  var freeDraw
  var markers

  function map_init_circle(valueArray, maker_position, set, zoom) {

    if ($('#map-leaflet').length) {
      if (window.innerWidth <= 768) {
        document.getElementById("MapListingMap").style.display = "block";
      }
      var container = L.DomUtil.get('map');

      if (container != null) {
        container._leaflet_id = null;
      }

      if (map !== undefined && map !== null) {
        map.removeLayer(freeDraw);
        map.remove(); // should remove the map from UI and clean the inner children of DOM element
      }
      if (set > 0) {
        map = L.map('map-leaflet', {
          drawControl: true,
          tap: true
        }).setView(maker_position, zoom);
      } else {
        map = L.map('map-leaflet', {
          tap: true
        }).setView([34.994003757575776, 33.15703828125001], zoom);
      }


      freeDraw = new FreeDraw({
        mode: FreeDraw.NONE
      });

      map.addLayer(freeDraw);

      //localStorage.clear("freedraw-polys")
      ps = localStorage.getItem("freedraw-polys")
      if (ps) {
        (JSON.parse(ps)).forEach(p => {
          freeDraw.create(p)
        })
      }

      freeDraw.on('markers', event => {
        localStorage.setItem("freedraw-polys", JSON.stringify(event.latLngs))

        var new_markers = []
        markerArray.forEach((m, i) => {

          if (event.latLngs.length == 0) {
            if (!map.hasLayer(m)) {
              map.addLayer(m)
            }
            new_markers.push(i)
          } else {
            if (isMarkerInsidePolygon(m, event.latLngs)) {
              if (!map.hasLayer(m)) {
                map.addLayer(m)

              }
              new_markers.push(i)
            } else {
              map.removeLayer(m)
            }
          }
        })
        markers = event.latLngs

        $("#freeDrawingMap").removeClass("active")
        freeDraw.mode(FreeDraw.NONE)
        loadActiveListingsListingGrid(maker_position, set, zoom);


      });

      function isMarkerInsidePolygon(marker, poly) {

        for (var p = 0; p < poly.length; p++) {
          var polyPoints = poly[p];

          var x = marker.getLatLng().lat,
            y = marker.getLatLng().lng;

          var inside = false;
          for (var i = 0, j = polyPoints.length - 1; i < polyPoints.length; j = i++) {

            var xi = polyPoints[i].lat,
              yi = polyPoints[i].lng;
            var xj = polyPoints[j].lat,
              yj = polyPoints[j].lng;

            var intersect = ((yi > y) != (yj > y)) &&
              (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
            if (intersect) inside = !inside;
          }

          if (inside) return inside;
        }
        return inside;
      };


      L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);

      circle = L.circle(maker_position, 1000 * set).addTo(map);
      circle.setStyle({
        color: 'green',
        opacity: 0.5
      });

      if (viewCircleFlag > 0) {
        var donut = L.donut(maker_position, {
          radius: 20000000000000,
          innerRadius: 1000 * set,
          innerRadiusAsPercent: false,
          color: '#000',
          weight: 2,
        }).addTo(map);
      }

      var markerArray = [];

      valueArray.forEach((value) => {
        var icon = L.divIcon({
          html: value.icon,
          iconSize: [50, 50],
          iconAnchor: [50, 50],
          popupAnchor: [-20, -42]
        });
        var marker = L.marker(value.center, {
          icon: icon
        });
        map.addLayer(marker);
        //markerArray.push(marker);
        markerArray[value.id] = marker;
        marker.bindPopup(
          '<div class="listing-window-image-wrapper">' +
          '<a onclick="showListigDetailModal(' + value.id + ');">' +
          '<div class="listing-window-image" style="background-image: url(' + value.image + ');"></div>' +
          '<div class="listing-window-content">' +
          '<div class="info">' +
          '<h2>' + value.title + '</h2>' +
          '<p>' + value.desc + '</p>' +
          '<h3>' + value.price + '</h3>' +
          '</div>' +
          '</div>' +
          '</a>' +
          '</div>'
        );
      })

      let marker = new L.marker(maker_position, {
        draggable: 'true'
      });

      marker.on('dragend', function(event) {
        temp = marker.getLatLng();
        marker.setLatLng(temp, {
          draggable: 'true'
        });
        circle.setLatLng(temp);
        document.getElementById("page_index").value = 1;
        loadActiveListingsListingMap([temp.lat, temp.lng], circle.getRadius() / 1000, map.getZoom());
      });

      map.addLayer(marker);

      map.on('mousedown', function(event) {
        if (viewCircleFlag == 1) {
          marker.setLatLng(event.latlng);
          circle.setLatLng(event.latlng);
          circle.setRadius(0);
          viewCircleFlag = 2;
          map.scrollWheelZoom.disable();
        } else if (viewCircleFlag == 2) {
          map.scrollWheelZoom.enable();
          temp = marker.getLatLng();
          distance = Math.sqrt(Math.pow(event.latlng.lat - temp.lat, 2) + Math.pow(event.latlng.lng - temp.lng, 2))
          circle.setRadius(distance * 1000 / 0.011);
          loadActiveListingsListingMap([temp.lat, temp.lng], distance / 0.011, map.getZoom());
          viewCircleFlag = 3;
          document.getElementById("redrawCircleListingMap").style.background = "rgb(255, 255, 255)";
          document.getElementById("redrawCircleListingMap").style.color = "rgb(0, 0, 0)";
        }
      });

      map.on('mousemove', event => {
        if (viewCircleFlag == 2) {
          temp = marker.getLatLng();
          distance = Math.sqrt(Math.pow(event.latlng.lat - temp.lat, 2) + Math.pow(event.latlng.lng - temp.lng, 2))
          circle.setRadius(distance * 1000 / 0.0115742);
        }
      });

      if (window.innerWidth <= 768) {
        if (document.getElementById("showMapListingListingMap").innerHTML == "Show Listings") {
          document.getElementById("MapListingMap").style.display = "block";
        } else {
          document.getElementById("MapListingMap").style.display = "none";
        }
      }

    }
  }

  function searchNowListingMap() {

    $(".explore__form-checkbox-list").removeClass("filter-block");
    //freeDraw.clear();
    viewCircleFlag = 0;
    //document.getElementById("redrawCircleListingMap").style.display = "none";
    //document.getElementById("showCircleListingMap").style.background = "rgb(255, 255, 255)";
    //document.getElementById("showCircleListingMap").style.color = "rgb(0, 0, 0)";
    //document.getElementById("showCircleListingMap").innerHTML = "Draw";
    //hiddenAdvancedDivListingMap();
    loadActiveListingsListingMap([0, 0], 0, 9);

  }
  // Define a click event handler
  $('.district').click(function() {
    localStorage.removeItem("freedraw-polys");
    freeDraw.clear();
    searchNowListingMap();
  });
  $('.municipality').click(function() {
    localStorage.removeItem("freedraw-polys");
    freeDraw.clear();
    searchNowListingMap();
  });
  $('.location').click(function() {
    localStorage.removeItem("freedraw-polys");
    freeDraw.clear();
    searchNowListingMap();
  });


  function clearDrawingsMap() {
    $('.district').prop('checked', false);
    $('.municipality').prop('checked', false);
    $('.location').prop('checked', false);
    localStorage.removeItem("freedraw-polys");
    freeDraw.clear();
  }

  function freeDrawingMap() {
    $('input:checkbox').each(function() {
      this.checked = false;
    });
    // document.getElementById("ListingListContent").innerHTML = "";
    // document.getElementById("page_count").innerHTML = " Search results"
    // document.getElementById("pagin_content").innerHTML = "";
    if ($("#freeDrawingMap").hasClass("active")) freeDraw.mode(FreeDraw.NONE)
    else freeDraw.mode(FreeDraw.ALL)
  }

  function showCircleListingMap() {
    if (viewCircleFlag > 0) {
      viewCircleFlag = 0;
      document.getElementById("redrawCircleListingMap").style.display = "none";
      document.getElementById("showCircleListingMap").style.background = "rgb(255, 255, 255)";
      document.getElementById("showCircleListingMap").style.color = "rgb(0, 0, 0)";
      document.getElementById("showCircleListingMap").innerHTML = "Draw";
      loadActiveListingsListingMap([0, 0], 0, 9);
    } else {
      viewCircleFlag = 1;
      $("#map_success").fadeIn(300).delay(5000).fadeOut(400);
      document.getElementById("showCircleListingMap").style.background = "rgb(34, 150, 67)";
      document.getElementById("showCircleListingMap").style.color = "rgb(255, 255, 255)";
      document.getElementById("showCircleListingMap").innerHTML = "Clear";
      document.getElementById("redrawCircleListingMap").style.display = "flex";
      document.getElementById("redrawCircleListingMap").style.background = "rgb(34, 150, 67)";
      document.getElementById("redrawCircleListingMap").style.color = "rgb(255, 255, 255)";
      map_init_circle([], [0, 0], 0, 9);
      document.getElementById("ListingListContent").innerHTML = "";
      document.getElementById("page_count").innerHTML = " Search results"
      document.getElementById("pagin_content").innerHTML = "";
      $('input:checkbox').each(function() {
        this.checked = false;
      });
    }
  }

  function redrawCircleListingMap() {
    $("#map_success").fadeIn(300).delay(3000).fadeOut(400);
    viewCircleFlag = 1;
    document.getElementById("redrawCircleListingMap").style.background = "rgb(34, 150, 67)";
    document.getElementById("redrawCircleListingMap").style.color = "rgb(255, 255, 255)";
  }


  function showHideMapListingListingMap() {
    document.getElementById("MapListingMap").style.height = "870px";
    if ($(window).width() > 1000) {
      document.getElementById("ListingListingMapDiv").style.display = "block";
      document.getElementById("showMapListingListingMap").style.display = "hide";
      document.getElementById("MapListingMap").style.display = "block";
    } else {
      document.getElementById("showMapListingListingMap").style.display = "show";
      if (view == 'map') {
        document.getElementById("ListingListingMapDiv").style.display = "none";
        document.getElementById("MapListingMap").style.display = "block";
        document.getElementById("showMapListingListingMap").innerHTML = "Show Listings";
      } else if (view == 'listings') {
        document.getElementById("MapListingMap").style.display = "none";
        document.getElementById("ListingListingMapDiv").style.display = "block";
        document.getElementById("showMapListingListingMap").innerHTML = "Show Map";
      }
    }
  }
  showHideMapListingListingMap();

  function replaceview() {
    if (view == 'map') {
      view = 'listings';
    } else if (view == 'listings') {
      view = 'map';
    }
    showHideMapListingListingMap();

    var href = new URL('<?php echo env('APP_URL'); ?>/page/listings' + location.search);
    href.searchParams.set('view', view);



    window.history.pushState({
      path: href.toString()
    }, '', href.toString());
  }

  function forSaleBtn() {
    if (document.getElementById("listing-type-dropdown").style.display == "block") {
      document.getElementById("listing-type-dropdown").style.display = "none";
    } else {
      document.getElementById("listing-type-dropdown").style.display = "block";
    }
  }

  function priceBtn() {
    if (document.getElementById("price-dropdown").style.display == "block") {
      document.getElementById("price-dropdown").style.display = "none";
    } else {
      document.getElementById("price-dropdown").style.display = "block";
    }
  }

  // function hiddenAdvancedDivListingMap() {
  //   document.getElementById('advancedSearch').className = "explore__form-checkbox-list full-filter";
  // }
  // $(window).resize(function() {
  //   window.location.reload();
  // });
  function searchReset() {
    $('#search-box-input').val('');

    $('.propertStatus').prop('checked', false);
    $('.propertTypes').prop('checked', false);
    $('.featurecheck').prop('checked', false);

    $('#selBedrooms').val('');
    $('#selBathrooms').val('');

    clearDrawingsMap();
  }

  function replace_divs() {
    if ($(window).width() > 1000) {
      if ($('#location_mobilediv').html() != '') {
        var $locationdiv = $('#location_mobilediv').clone();
        $('#location_desktopdiv').html($locationdiv);
        $('#location_mobilediv').html('');
        $("#location_mobilediv").css("display", "none");
        $("#location_desktopdiv").css("display", "block");
      }
      if ($('#property_status_mobilediv').html() != '') {
        var $locationdiv = $('#property_status_mobilediv').clone();
        $('#property_status_desktopdiv').html($locationdiv);
        $('#property_status_mobilediv').html('');
        $("#property_status_mobilediv").css("display", "none");
        $("#property_status_desktopdiv").css("display", "block");
      }
      if ($('#property_type_mobilediv').html() != '') {
        var $locationdiv = $('#property_type_mobilediv').clone();
        $('#property_type_desktopdiv').html($locationdiv);
        $('#property_type_mobilediv').html('');
        $("#property_type_mobilediv").css("display", "none");
        $("#property_type_desktopdiv").css("display", "block");
      }
    } else {
      if ($('#location_desktopdiv').html() != '') {
        var $locationdiv = $('#location_desktopdiv').clone();
        $('#location_mobilediv').html($locationdiv);
        $('#location_desktopdiv').html('');
        $("#location_mobilediv").css("display", "block");
        $("#location_desktopdiv").css("display", "none");
      }
      if ($('#property_status_desktopdiv').html() != '') {
        var $locationdiv = $('#property_status_desktopdiv').clone();
        $('#property_status_mobilediv').html($locationdiv);
        $('#property_status_desktopdiv').html('');
        $("#property_status_mobilediv").css("display", "block");
        $("#property_status_desktopdiv").css("display", "none");
      }
      if ($('#property_type_desktopdiv').html() != '') {
        var $locationdiv = $('#property_type_desktopdiv').clone();
        $('#property_type_mobilediv').html($locationdiv);
        $('#property_type_desktopdiv').html('');
        $("#property_type_mobilediv").css("display", "block");
        $("#property_type_desktopdiv").css("display", "none");
      }
    }
  }

  function iformat(icon, badge, ) {
    var originalOption = icon.element;
    var originalOptionBadge = $(originalOption).data('badge');

    return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
  }
  $(window).resize(function() {
    replace_divs()
  });
  replace_divs();
</script>