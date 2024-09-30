import React from "react";
import styled from "styled-components";

interface FormInputsProps {
  name: string;
  setName: React.Dispatch<React.SetStateAction<string>>;
  email: string;
  setEmail: React.Dispatch<React.SetStateAction<string>>;
}

const FormInputStyles = styled.div`
  input,
  textarea {
    width: 100%;
  }

  label {
    color: white;
  }

  #mensaje {
    width: 100%;
  }

  @media (max-width: 575.98px) {
    input {
      font-size: 1rem;
    }

    label {
      font-size: 1rem;
    }

    #mensaje {
      height: 4rem;
    }
  }

  @media (min-width: 576px) {
    input {
      font-size: 1.2rem;
    }

    label {
      font-size: 1.2rem;
    }

    #mensaje {
      height: 6rem;
    }
  }

  @media (min-width: 768px) {
    input {
      font-size: 1.4rem;
    }

    label {
      font-size: 1.4rem;
    }

    #mensaje {
      height: 8rem;
    }
  }

  @media (min-width: 992px) {
    input {
      font-size: 1.6rem;
    }

    label {
      font-size: 1.7rem;
    }

    #mensaje {
      height: 10rem;
    }
  }

  @media (min-width: 1200px) {
    input {
      font-size: 1.8rem;
    }

    label {
      font-size: 1.9rem;
    }

    #mensaje {
      height: 12rem;
    }
  }

  @media (min-width: 1920px) {
    input {
      font-size: 2rem;
    }

    label {
      font-size: 2.1rem;
    }

    #mensaje {
      height: 14rem;
    }
  }
`;

interface FormInputsProps {
  name: string;
  setName: React.Dispatch<React.SetStateAction<string>>;
  email: string;
  setEmail: React.Dispatch<React.SetStateAction<string>>;
  mensaje: string;
  setMensaje: React.Dispatch<React.SetStateAction<string>>;
}

function FormInputs({
  name,
  setName,
  email,
  setEmail,
  mensaje,
  setMensaje,
}: FormInputsProps) {
  return (
    <FormInputStyles>
      <label htmlFor="nombre">Full Name:</label>
      <br />
      <input
        type="text"
        id="nombre"
        name="nombre"
        value={name}
        onChange={(e) => setName(e.target.value)}
        required
      />
      <br />
      <br />

      <label htmlFor="email">Email:</label>
      <br />
      <input
        type="email"
        id="email"
        name="email"
        value={email}
        onChange={(e) => setEmail(e.target.value)}
        required
      />
      <br />
      <br />

      <label htmlFor="mensaje">Message:</label>
      <br />
      <textarea
        id="mensaje"
        name="mensaje"
        value={mensaje}
        onChange={(e) => setMensaje(e.target.value)}
        required
      ></textarea>
      <br />
      <br />
    </FormInputStyles>
  );
}

export default FormInputs;
