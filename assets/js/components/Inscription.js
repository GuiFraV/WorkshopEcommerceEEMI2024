import React, { useState } from "react";

export default function InscriptionPage() {
  const [formData, setFormData] = useState({
    nom: "",
    prenom: "",
    email: "",
    consentementRGPD: false,
  });

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData({
      ...formData,
      [name]: type === "checkbox" ? checked : value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    const response = await fetch(
      `${process.env.NEXT_PUBLIC_API_URL}/api/participants`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify(formData),
      }
    );
    const data = await response.json();
    console.log("Success:", data);
    alert("Inscription réussie!");
  };

  return (
    <form onSubmit={handleSubmit}>
      <label htmlFor="nom">Nom:</label>
      <input
        type="text"
        id="nom"
        name="nom"
        value={formData.nom}
        onChange={handleChange}
        required
      />
      <br />
      <label htmlFor="prenom">Prénom:</label>
      <input
        type="text"
        id="prenom"
        name="prenom"
        value={formData.prenom}
        onChange={handleChange}
        required
      />
      <br />
      <label htmlFor="email">Email:</label>
      <input
        type="email"
        id="email"
        name="email"
        value={formData.email}
        onChange={handleChange}
        required
      />
      <br />
      <label htmlFor="consentementRGPD">Consentement RGPD:</label>
      <input
        type="checkbox"
        id="consentementRGPD"
        name="consentementRGPD"
        checked={formData.consentementRGPD}
        onChange={handleChange}
        required
      />
      <br />
      <button type="submit">S'inscrire</button>
    </form>
  );
}
