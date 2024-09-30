import styled from "styled-components";

const FormInputStyles = styled.div`
  @media (max-width: 575.98px) {
    button {
      width: 3rem;
      height: 2rem;
    }
  }

  @media (min-width: 576px) {
    button {
      width: 5rem;
      height: 2.5rem;
    }
  }

  @media (min-width: 768px) {
    button {
      width: 6rem;
    }
  }
  @media (min-width: 992px) {
    button {
      width: 7rem;
    }
  }

  @media (min-width: 1200px) {
    button {
      width: 8rem;
    }
  }

  @media (min-width: 1920px) {
    button {
      width: 9rem;
    }
  }

  #div-button {
    text-align: end;
  }

  #div-button {
    text-align: end;
  }

  #div-button {
    text-align: end;
    font-size: 0.8rem;
  }
`;

function FormButton() {
  return (
    <FormInputStyles>
      <div id="div-button">
        <button id="contact-button" type="submit">
          Send
        </button>
      </div>
      <br />
      <div id="div-button-span">
        <span>(Don't expect us to answer you.)</span>
      </div>
      <br />
    </FormInputStyles>
  );
}

export default FormButton;
