"use client";

import Navigation from "./navigation";
import "./globals.css";
import LottieScrollTrigger from "./LottieScrollTrigger";

export default function InscriptionPage() {
  return (
    <div>
      <Navigation />
      <LottieScrollTrigger
        trigger=".animation"
        target=".animation"
        path="./AASTRO.json"
        start="top center"
        end="bottom center"
        scrub={2}
      />
      <div className="end-lottie"></div>
    </div>
  );
}
