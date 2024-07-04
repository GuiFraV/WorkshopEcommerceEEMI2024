import React from "react";
import HorizontalScrollText from "./HorizontalScrollText";
import CountdownTimer from "./CountdownTimer";
import Form from "./Form";

const Navigation = () => {
  return (
    <div>
      <nav>
        <div className="logo">
          <img src="images/nasa.webp" width="35px" />
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

        <Form />
      </section>
    </div>
  );
};

export default Navigation;
