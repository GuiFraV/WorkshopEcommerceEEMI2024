// frontend/app/navigation.js

import React from "react";
import Section from "./section";
import HorizontalScrollText from "./HorizontalScrollText";
import Form from "./Form";

const Navigation = () => {
  return (
    <div>
      <nav>
        <div className="logo">
          <a>Nike X NASA</a>
        </div>
        <div className="links">
          <a href="#">Home</a>
          <a href="#">Work</a>
          <a href="#">Expertise</a>
          <a href="#">Agency</a>
          <a href="#">Jobs</a>
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
        <h1>blabla super projet nasa x nike</h1>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec
          viverra ante. Quisque condimentum non tellus non consequat. Vivamus
          turpis odio, facilisis nec metus a, commodo mollis sem. Pellentesque
          sed.
        </p>

        <div className="form-section">
          <Section />
          <Form />
        </div>
      </section>
    </div>
  );
};

export default Navigation;
