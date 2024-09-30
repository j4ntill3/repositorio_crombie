import styled from "styled-components";

const FooterStyles = styled.footer`
  background: black;
  color: white;
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  width: 100%;

  span {
    text-align: center;
  }

  @media (max-width: 575.98px) {
    min-height: 4.5rem;
    font-size: 1rem;
  }

  @media (min-width: 576px) {
    min-height: 5.5rem;
    font-size: 1.1rem;
  }

  @media (min-width: 768px) {
    min-height: 6.5rem;
    font-size: 1.2rem;
  }

  @media (min-width: 992px) {
    min-height: 7.5rem;
    font-size: 1.3rem;
  }

  @media (min-width: 1200px) {
    min-height: 8.5rem;
    font-size: 1.4rem;
  }

  @media (min-width: 1920px) {
    min-height: 9.5rem;
    font-size: 1.5rem;
  }
`;

function Footer() {
  return (
    <FooterStyles>
      <span>
        2024 <strong>Jackass</strong>
        <br /> No rights reserved
      </span>
    </FooterStyles>
  );
}

export default Footer;
