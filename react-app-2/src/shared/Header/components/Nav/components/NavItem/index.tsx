import Link from "next/link";
import styled from "styled-components";

const NavItemStyles = styled.li`
  list-style: none;
  flex-grow: 1;
  text-align: center;

  a {
    text-decoration: none;
    padding: 0.25rem;
    color: white;
    transition: color 0.3s;
  }

  a:hover {
    color: white;
    text-decoration: underline;
  }

  a:visited {
    color: white;
  }

  a:focus {
    outline: none;
  }
`;

interface NavItemProps {
  to: string;
  children: React.ReactNode;
}

function NavItem({ to, children }: NavItemProps) {
  return (
    <NavItemStyles>
      <Link href={to}>{children}</Link>
    </NavItemStyles>
  );
}

export default NavItem;
