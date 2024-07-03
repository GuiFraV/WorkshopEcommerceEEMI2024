"use client";

import { useRef, useEffect } from "react";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export default function HorizontalScrollText() {
  const textRef = useRef(null);

  useEffect(() => {
    // Animation de défilement automatique
    const autoScroll = gsap.to(textRef.current, {
      xPercent: -100,
      repeat: -1,
      duration: 20,
      ease: "linear",
    });

    // Animation de défilement basée sur le scroll
    gsap.to(textRef.current, {
      xPercent: -200,
      ease: "none",
      scrollTrigger: {
        trigger: textRef.current,
        scrub: 1,
        start: "top bottom",
        end: "bottom top",
        onUpdate: (self) => {
          // Synchroniser l'animation automatique avec le défilement
          autoScroll.progress(self.progress);
        },
      },
    });

    return () => {
      autoScroll.kill();
    };
  }, []);

  return (
    <div className="horizontal-scroll-container">
      <h2 ref={textRef} className="horizontal-scroll-text">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec
        risus ac orci gravida finibus. In scelerisque arcu sit amet semper
        dictum. Quisque finibus sed magna vel rutrum. Integer sit.
      </h2>
    </div>
  );
}
