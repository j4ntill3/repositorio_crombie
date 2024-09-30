import styled from "styled-components";
import { Main } from "../../shared/Main";

const SectionStyle = styled.section`
  color: white;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center; /* Centrado horizontal */
  justify-content: center; /* Centrado vertical */
  height: 100vh; /* Altura de la ventana */
`;

const ContTextWarning = styled.div`
  width: 100%;
  background: black;
  color: white;
  display: flex;
  flex-direction: column;

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
      font-size: 2.3rem; /* Sin el selector de ID */
    }
  }
`;

const ContSpanWarning = styled.div`
  display: flex;
  justify-content: center;

  span {
    color: red;
    margin-bottom: 1.5rem;
  }

  @media (max-width: 575.98px) {
    span {
      font-size: 2rem;
    }
  }

  @media (min-width: 576px) {
    span {
      font-size: 2.5rem;
    }
  }

  @media (min-width: 768px) {
    span {
      font-size: 3rem;
    }
  }

  @media (min-width: 992px) {
    span {
      font-size: 3.5rem;
    }
  }

  @media (min-width: 1200px) {
    span {
      font-size: 4rem;
    }
  }

  @media (min-width: 1920px) {
    span {
      font-size: 5rem;
    }
  }
`;

const ContImgWarning = styled.div`
  width: 100%;
  display: flex;
  justify-content: center;
  margin-top: 1.5rem;

  img {
    width: 90%;
  }
`;

function Home() {
  return (
    <Main>
      <SectionStyle>
        <ContTextWarning>
          <ContSpanWarning>
            <span>
              <strong>WARNING</strong>
            </span>
          </ContSpanWarning>
          <p>
            The following show features stunts performed either by professionals
            or under the supervision of professionals. Accordingly, MTV and the
            producers must insist that no one attempt to recreate or re-enact
            any stunt or activity performed on this show.
          </p>
        </ContTextWarning>
        <ContImgWarning>
          <img
            src="https://jackass-web-img.s3.us-east-2.amazonaws.com/cast-jackass-3d.jpg"
            alt="Jackass Cast"
          />
        </ContImgWarning>
      </SectionStyle>
    </Main>
  );
}

export default Home;
