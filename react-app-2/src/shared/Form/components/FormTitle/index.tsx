import styled from "styled-components";

const FormTitleStyles = styled.div`
  display: flex;
  justify-content: center;

  span {
    color: white;
    margin: 1.5rem 0rem 1.5rem 0rem;
  }

  @media (max-width: 575.98px) {
    span {
      font-size: 2rem;
    }
  }

  @media (min-width: 576px) {
    font-size: 2.5rem;
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
      font-size: 4.5rem;
    }
  }
`;

function FormTitle() {
  return (
    <FormTitleStyles>
      <span>
        <strong>Subscribe</strong>
      </span>
    </FormTitleStyles>
  );
}

export default FormTitle;
