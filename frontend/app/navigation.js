import React from "react";
import Section from "./section";
import HorizontalScrollText from "./HorizontalScrollText";

const navigation = () => {
  return (
    <div>
      <nav>
        <div class="logo">
          <a>Nike X NASA</a>
        </div>
        <div class="links">
          <a href="#">Home</a>
          <a href="#">Work</a>
          <a href="#">Expertise</a>
          <a href="#">Agency</a>
          <a href="#">Jobs</a>
          <a href="#">Contact</a>
        </div>
      </nav>

      <section class="lottie-container">
        <div class="animation"></div>
      </section>
      <h2>
        <HorizontalScrollText />
      </h2>

      <section class="gradient"></section>

      <section class="website-content">
        <div class="end-lottie"></div>
        <h1>blabla super projet nasa x nike</h1>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec
          viverra ante. Quisque condimentum non tellus non consequat. Vivamus
          turpis odio, facilisis nec metus a, commodo mollis sem. Pellentesque
          sed.
        </p>

        <Section />
      </section>
    </div>
  );
};

export default navigation;
