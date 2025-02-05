"use client";

import { useState } from "react";

export default function Form() {
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
    try {
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

      if (!response.ok) {
        throw new Error("Network response was not ok");
      }

      const data = await response.json();
      console.log("Success:", data);
      alert("Inscription réussie!");
    } catch (error) {
      console.error("Error:", error);
      alert("Erreur lors de l'inscription.");
    }
  };

  return (
    <form onSubmit={handleSubmit} className="form-container">
      <label htmlFor="nom">Nom :</label>
      <input
        type="text"
        id="nom"
        name="nom"
        value={formData.nom}
        onChange={handleChange}
        required
      />
      <br />
      <label htmlFor="prenom">Prénom :</label>
      <input
        type="text"
        id="prenom"
        name="prenom"
        value={formData.prenom}
        onChange={handleChange}
        required
      />
      <br />
      <label htmlFor="email">Email :</label>
      <input
        type="email"
        id="email"
        name="email"
        value={formData.email}
        onChange={handleChange}
        required
      />
      <br />
      <label htmlFor="consentementRGPD">Consentement RGPD :</label>
      <input
        type="checkbox"
        id="consentementRGPD"
        name="consentementRGPD"
        checked={formData.consentementRGPD}
        onChange={handleChange}
        required
      />
      <br />
      <button type="submit" className="neon-glow-button">
        Launch here
      </button>
    </form>
  );
}
