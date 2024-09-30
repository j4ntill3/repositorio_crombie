import Link from "next/link";
import styled from "styled-components";
import { PortadaStyled } from "../../shared/Header/components/Portada";
import { useRouter } from "next/router";

const HeaderStyles = styled.header`
  background: black;
  width: 100%;

  nav {
    padding-top: 1rem;
    padding-bottom: 1rem;
  }

  ul {
    display: flex;
    padding: 0px;
  }

  li {
    list-style: none;
    flex-grow: 1;
    text-align: center;
  }

  li a {
    text-decoration: none;
    padding: 0.25rem;
    color: white;
    transition: color 0.3s;
  }

  li a:hover {
    color: white;
  }

  li a:focus {
    outline: none;
  }

  li a:visited {
    color: white;
  }

  li a:hover {
    text-decoration: underline;
  }
`;

function Header() {
  const router = useRouter(); // Hook para obtener la ruta actual

  const getPortada = () => {
    switch (router.pathname) {
      case "/about-us":
        return "https://jackass-web-img.s3.us-east-2.amazonaws.com/portada-about-us.jpg";
      case "/media":
        return "https://jackass-web-img.s3.us-east-2.amazonaws.com/portada-media.jpg";
      case "/subscribe":
        return "https://jackass-web-img.s3.us-east-2.amazonaws.com/portada-subscribe.jpg";
      default:
        return "https://jackass-web-img.s3.us-east-2.amazonaws.com/portada.jpg";
    }
  };

  return (
    <HeaderStyles>
      <nav>
        <ul>
          <li>
            <Link href="/">Home</Link>
          </li>
          <li>
            <Link href="/about-us">About Us</Link>
          </li>
          <li>
            <Link href="/media">Media</Link>
          </li>
          <li>
            <Link href="/subscribe">Subscribe</Link>
          </li>
        </ul>
      </nav>
      <PortadaStyled src={getPortada()} alt="Portada" />
    </HeaderStyles>
  );
}

export default Header;
