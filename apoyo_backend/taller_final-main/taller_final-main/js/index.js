document.addEventListener('DOMContentLoaded', function() {
  const carousel = document.querySelector('.carousel');
  const cardsContainer = carousel.querySelector('.cards-container');
  const prevButton = document.querySelector('.prev-button');
  const nextButton = document.querySelector('.next-button');

  if (carousel && cardsContainer && prevButton && nextButton) {
    const cardWidth = carousel.querySelector('.card').offsetWidth;
    let position = 0;

    prevButton.addEventListener('click', function() {
      position += cardWidth;
      position = Math.min(position, 0);
      cardsContainer.style.transform = `translateX(${position}px)`;
    });

    nextButton.addEventListener('click', function() {
      position -= cardWidth;
      const containerWidth = carousel.offsetWidth;
      const cardsWidth = cardWidth * cardsContainer.childElementCount;
      position = Math.max(position, -1 * (cardsWidth - containerWidth));
      cardsContainer.style.transform = `translateX(${position}px)`;
    });
  }
});
