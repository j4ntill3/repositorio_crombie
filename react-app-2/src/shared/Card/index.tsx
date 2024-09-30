import styled from "styled-components";
import ImgCard from "../../shared/Card/components/ImgCard";

export const CardStyles = styled.section`
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-evenly;
`;

interface ImgCardProps {
  img: string;
  name: string;
}

const Card: React.FC<ImgCardProps> = ({ img, name }) => (
  <CardStyles>
    <ImgCard img={img} name={name} />
  </CardStyles>
);

export default Card;
