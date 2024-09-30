import React, { useState } from "react";
import FormTitle from "../../shared/Form/components/FormTitle";
import FormInputs from "../../shared/Form/components/FormInputs";
import FormButton from "../../shared/Form/components/FormButton";

const Form = () => {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [mensaje, setMensaje] = useState("");

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    try {
      const response = await fetch("/api/subscribe", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ nombre: name, email, mensaje }),
      });

      const data = await response.json();
      console.log(data);

      if (response.ok) {
        alert("Te has suscrito con éxito!");
        setName("");
        setEmail("");
        setMensaje("");
      } else {
        alert("Error al suscribirse. Inténtalo de nuevo.");
      }
    } catch (error) {
      console.error("Error al enviar los datos:", error);
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <FormTitle />
      <FormInputs
        name={name}
        setName={setName}
        email={email}
        setEmail={setEmail}
        mensaje={mensaje}
        setMensaje={setMensaje}
      />
      <FormButton />
    </form>
  );
};

export default Form;
