document.addEventListener('DOMContentLoaded', () => {
  const track = document.querySelector('.featured-carousel-track');
  const slides = Array.from(track.children);
  const dotsContainer = document.querySelector('.carousel-dots');
  const slideWidth = slides[0].getBoundingClientRect().width; // Get width based on first slide

  let currentIndex = 0;
  let autoScrollInterval;
  const scrollIntervalTime = 3000; // Time between slides in milliseconds (3 seconds)

  // Arrange slides next to each other (redundant with CSS flex, but good practice)
  // slides.forEach((slide, index) => {
  //     slide.style.left = slideWidth * index + 'px';
  // });

  // --- Create Pagination Dots ---
  function createDots() {
      dotsContainer.innerHTML = ''; // Clear existing dots if any
      slides.forEach((_, index) => {
          const dot = document.createElement('button');
          dot.classList.add('dot');
          if (index === 0) {
              dot.classList.add('active'); // Set first dot active initially
          }
          dot.addEventListener('click', () => {
              goToSlide(index);
              // Reset interval after manual click
              clearInterval(autoScrollInterval);
              startAutoScroll();
          });
          dotsContainer.appendChild(dot);
      });
  }

  // --- Update Active Dot ---
  function updateDots() {
      const dots = Array.from(dotsContainer.children);
      dots.forEach((dot, index) => {
          if (index === currentIndex) {
              dot.classList.add('active');
          } else {
              dot.classList.remove('active');
          }
      });
  }

  // --- Move to a specific slide ---
  function goToSlide(targetIndex) {
      // Check if track exists before trying to transform it
      if (track) {
           track.style.transform = 'translateX(-' + slideWidth * targetIndex + 'px)';
           currentIndex = targetIndex;
           updateDots();
      } else {
          console.error("Carousel track not found!");
      }
  }

  // --- Move to the next slide ---
  function nextSlide() {
      let nextIndex = currentIndex + 1;
      if (nextIndex >= slides.length) {
          nextIndex = 0; // Loop back to the first slide
      }
      goToSlide(nextIndex);
  }

  // --- Start Automatic Scrolling ---
  function startAutoScroll() {
      // Clear any existing interval before starting a new one
      clearInterval(autoScrollInterval);
      autoScrollInterval = setInterval(nextSlide, scrollIntervalTime);
  }

  // --- Initialize Carousel ---
  if (track && slides.length > 0 && dotsContainer) {
      // Get accurate width after layout calculation
      // Need a slight delay or resize observer for perfect accuracy, but this often works
      const initialWidth = slides[0].getBoundingClientRect().width;
      if (initialWidth > 0) {
          // Recalculate slideWidth based on actual rendered width
          // This helps if the CSS takes time to apply or dimensions change
          // Note: A ResizeObserver would be more robust for dynamic width changes
         // slideWidth = initialWidth; // Uncomment if needed, but CSS % width usually handles this

          createDots();
          startAutoScroll();

          // Optional: Pause on hover
          const container = document.querySelector('.featured-carousel-container');
          if (container) {
              container.addEventListener('mouseenter', () => clearInterval(autoScrollInterval));
              container.addEventListener('mouseleave', startAutoScroll);
          }

      } else {
           console.warn("Featured carousel slides have zero width initially. Check CSS or timing.");
           // Fallback or retry logic could go here
      }


  } else {
      console.log("Featured carousel elements not found or no slides present.");
  }

   // Recalculate width on window resize (optional, CSS % width should handle most cases)
   window.addEventListener('resize', () => {
       if (slides.length > 0) {
          //  slideWidth = slides[0].getBoundingClientRect().width; // Recalculate width
          //  goToSlide(currentIndex); // Re-apply transform with new width
          // Debounce this in a real application to avoid performance issues
       }
   });

}); // End DOMContentLoaded