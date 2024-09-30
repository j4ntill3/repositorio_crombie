import { createGlobalStyle } from "styled-components";

const FontStyles = createGlobalStyle`
  @font-face {
    font-family: 'JackassFont';
    src: url('/fonts/Helvetica.ttf') format('truetype'),
         url('/fonts/Helvetica.otf') format('opentype'),
         url('/fonts/Helvetica.woff') format('woff'),
         url('/fonts/Helvetica.woff2') format('woff2');
    font-weight: normal;
    font-style: normal;
  }
`;

export default FontStyles;
