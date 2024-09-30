import styled from "styled-components";
import React from "react";

const StyledImgCard = styled.section`
  display: flex;
  flex-direction: column;
  align-items: center;

  span {
    color: white;
    margin: 15% 0rem 15% 0rem;
  }

  img {
    padding: 0.5rem;
  }

  @media (max-width: 575.98px) {
    img {
      max-width: 270px;
    }
  }

  @media (min-width: 576px) {
    span {
      font-size: 2.3rem;
    }

    img {
      max-width: 250px;
    }
  }

  @media (min-width: 768px) {
    span {
      font-size: 1.5rem;
    }
    img {
      max-width: 300px;
    }
  }

  @media (min-width: 992px) {
    span {
      font-size: 2rem;
    }

    img {
      max-width: 350px;
    }
  }

  @media (min-width: 1200px) {
    span {
      font-size: 2.3rem;
    }

    img {
      max-width: 400px;
    }
  }

  @media (min-width: 1920px) {
    span {
      font-size: 2.6rem;
    }

    img {
      max-width: 450px;
    }
  }
`;

interface ImgCardProps {
  img: string;
  name: string;
}

const ImgCard: React.FC<ImgCardProps> = ({ img, name }) => (
  <StyledImgCard>
    <img src={img} alt={name} />
    <span>{name}</span>
  </StyledImgCard>
);

export default ImgCard;
