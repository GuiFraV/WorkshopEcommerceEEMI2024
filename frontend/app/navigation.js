// frontend/app/navigation.js

import React from "react";
import Section from "./section";
import HorizontalScrollText from "./HorizontalScrollText";
import CountdownTimer from "./CountdownTimer";

const Navigation = () => {
  return (
    <div>
      <nav>
        <div className="logo">
          <a>Nike X NASA</a>
        </div>
        <div className="links">
          <a href="#">Home</a>
          <a href="#">Contact</a>
        </div>
      </nav>

      <section className="lottie-container">
        <div className="animation"></div>
      </section>
      <h2>
        <HorizontalScrollText />
      </h2>

      <section className="gradient"></section>

      <section className="website-content">
        <div className="end-lottie"></div>
        <h1>Nike et la NASA : Des Chaussures Inspirées par l'Espace</h1>

        <CountdownTimer />
        <button class="neon-glow-button">Lauch here</button>
      </section>
    </div>
  );
};

export default Navigation;
