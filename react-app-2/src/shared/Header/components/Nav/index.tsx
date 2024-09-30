import styled from "styled-components";
import NavItem from "./components/NavItem";

const NavStyles = styled.nav`
  padding-top: 1rem;
  padding-bottom: 1rem;

  ul {
    display: flex;
  }
`;

function Nav() {
  return (
    <NavStyles>
      <ul>
        <NavItem to="/">Home</NavItem>
        <NavItem to="/about-us">About Us</NavItem>
        <NavItem to="/media">Media</NavItem>
        <NavItem to="/subscribe">Subscribe</NavItem>
      </ul>
    </NavStyles>
  );
}

export default Nav;
