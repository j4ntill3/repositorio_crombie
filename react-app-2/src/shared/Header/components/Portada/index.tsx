import styled from "styled-components";

export const PortadaStyled = styled.img`
  width: 100%;
`;

interface PortadaProps {
  src: string;
}

function Portada({ src }: PortadaProps) {
  return <PortadaStyled src={src} />;
}

export default Portada;
