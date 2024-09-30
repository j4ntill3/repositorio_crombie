import styled from "styled-components";

export const SectionInfo = styled.section`
  color: white;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;

  p {
    text-align: center;
  }

  @media (max-width: 575.98px) {
    p {
      font-size: 1.3rem;
    }
  }

  @media (min-width: 576px) {
    p {
      font-size: 1.5rem;
    }
  }

  @media (min-width: 768px) {
    p {
      font-size: 1.7rem;
    }
  }

  @media (min-width: 992px) {
    p {
      font-size: 1.9rem;
    }
  }

  @media (min-width: 1200px) {
    p {
      font-size: 2.1rem;
    }
  }

  @media (min-width: 1920px) {
    p {
      font-size: 2.3rem;
    }
  }
`;
