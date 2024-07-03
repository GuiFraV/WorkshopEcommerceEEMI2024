"use client";

import { useEffect, useRef } from "react";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import lottie from "lottie-web";

gsap.registerPlugin(ScrollTrigger);

function LottieScrollTrigger({ trigger, target, path, start, end, scrub }) {
  const animationRef = useRef(null);

  useEffect(() => {
    const playhead = { frame: 0 };
    const targetElement = document.querySelector(target);
    const triggerElement = document.querySelector(trigger);

    const animation = lottie.loadAnimation({
      container: targetElement,
      renderer: "svg",
      loop: false,
      autoplay: false,
      path: path,
      rendererSettings: {
        preserveAspectRatio: "xMidYMid slice",
      },
    });

    animation.addEventListener("DOMLoaded", () => {
      gsap.to(playhead, {
        frame: animation.totalFrames - 1,
        ease: "none",
        onUpdate: () => animation.goToAndStop(playhead.frame, true),
        scrollTrigger: {
          trigger: triggerElement,
          start: start,
          end: end,
          scrub: scrub,
        },
      });
    });

    return () => {
      animation.destroy();
    };
  }, [trigger, target, path, start, end, scrub]);

  return <div ref={animationRef} className="animation"></div>;
}

export default LottieScrollTrigger;
