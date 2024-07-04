import { useState, useEffect } from "react";

const CountdownTimer = () => {
  // Fixer la date cible une fois au chargement du composant
  const targetDate = new Date().getTime() + 2 * 24 * 60 * 60 * 1000; // 2 jours à partir de maintenant

  const calculateTimeLeft = () => {
    const now = new Date().getTime();
    const difference = targetDate - now;

    let timeLeft = {};

    if (difference > 0) {
      timeLeft = {
        days: Math.floor(difference / (1000 * 60 * 60 * 24)),
        hours: Math.floor((difference / (1000 * 60 * 60)) % 24),
        minutes: Math.floor((difference / 1000 / 60) % 60),
        seconds: Math.floor((difference / 1000) % 60),
      };
    } else {
      timeLeft = {
        days: 0,
        hours: 0,
        minutes: 0,
        seconds: 0,
      };
    }
    return timeLeft;
  };

  const [timeLeft, setTimeLeft] = useState(calculateTimeLeft());

  useEffect(() => {
    const timer = setInterval(() => {
      setTimeLeft(calculateTimeLeft());
    }, 1000);

    return () => clearInterval(timer);
  }, []);

  return (
    <div>
      <div class="timer">
        {timeLeft.days !== undefined ? (
          <>
            <span>{timeLeft.days}d </span>
            <span>{timeLeft.hours}h </span>
            <span>{timeLeft.minutes}m </span>
            <span>{timeLeft.seconds}s</span>
          </>
        ) : (
          <span>Time's up!</span>
        )}
      </div>
    </div>
  );
};

export default CountdownTimer;
