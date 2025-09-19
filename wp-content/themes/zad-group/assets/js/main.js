window.addEventListener("scroll", function () {
  const header = document.querySelector(".headerSection");
  if (window.scrollY > 50) {
    // Change 50 to the amount of scroll before the background color changes
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
});

if (typeof Swiper !== "undefined" && document.querySelector(".mySwiper")) {
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: "auto",

    spaceBetween: 30,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    keyboard: true,
  });
}

window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  const button = document.getElementById("scrollToTopBtn");
  if (
    document.body.scrollTop > 100 ||
    document.documentElement.scrollTop > 100
  ) {
    button.style.display = "block";
  } else {
    button.style.display = "none";
  }
  console.log("scrollddd");
}

// Scroll to the top when the button is clicked
function scrollToTop() {
  window.scrollTo({ top: 0, behavior: "smooth" });
}

// gallery script
//  JavaScript to Handle Dynamic Modal Content
document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("galleryModal");

  if (!modal) {
    console.log("model is null");
  } else {
    const modalTitle = modal.querySelector(".modal-title");
    const carouselImages = document.getElementById("carouselImages");
    document.querySelectorAll(".gallaryimagebox").forEach(function (item) {
      item.addEventListener("click", function () {
        const title = this.getAttribute("data-title");
        const images = JSON.parse(this.getAttribute("data-images"));

        modalTitle.textContent = title;

        carouselImages.innerHTML = "";
        images.forEach((image, index) => {
          const activeClass = index === 0 ? " active" : "";
          carouselImages.innerHTML += `
                  <div class="carousel-item${activeClass}">
                      <img src="${image}" class="d-block w-100" alt="${title}" />
                  </div>
              `;
        });
      });
    });
  }
});
// function playVideo() {
//   const video = document.getElementById("myVideo");
//   const playButton = document.getElementById("plybtn");
//   playButton.style.display = "none"; // Hide the play button
//   video.style.display = "block"; // Show the video element

//   video.play(); // Play the video
// }
// Get references to the video and button elements
// var video = document.getElementById("myVideo");
// const playButton = document.getElementById("plybtn");
// var video2 = document.getElementById("myVideo2");
// const playButton2 = document.getElementById("plybtn2");
// if (!video || !video2) {
//   console.error("Video element not found");
//   return;
// }
// // Function to play the video and hide the button
// function playVideo() {
//   video.play();
// }
// function playVideo2() {
//   video2.play();
// }

// // Event listener for when the video starts playing
// video.addEventListener("play", function () {
//   playButton.style.display = "none"; // Hide play button when video starts playing
//   video.style.display = "block";
// });

// // Event listener for when the video is paused
// video.addEventListener("pause", function () {
//   playButton.style.display = "block"; // Show play button when video is paused
// });

// video2.addEventListener("play", function () {
//   playButton2.style.display = "none"; // Hide play button when video starts playing
//   video2.style.display = "block";
// });
var video = document.getElementById("myVideo");
const playButton = document.getElementById("plybtn");
var video2 = document.getElementById("myVideo2");
const playButton2 = document.getElementById("plybtn2");

// Check if video elements exist
if (!video || !video2) {
  console.log("Video element not found");
} else {
  // Function to play the first video and hide the button
  function playVideo() {
    video.play();
  }

  // Function to play the second video and hide the button
  function playVideo2() {
    video2.play();
  }

  // Event listener for when the first video starts playing
  video.addEventListener("play", function () {
    playButton.style.display = "none"; // Hide play button when video starts playing
    video.style.display = "block";
  });

  // Event listener for when the first video is paused
  video.addEventListener("pause", function () {
    playButton.style.display = "block"; // Show play button when video is paused
  });

  // Event listener for when the second video starts playing
  video2.addEventListener("play", function () {
    playButton2.style.display = "none"; // Hide play button when video starts playing
    video2.style.display = "block";
  });
}

var swiper = new Swiper(".franchisPic", {
  slidesPerView: 1,
  spaceBetween: 10,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    "@0.00": {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    "@0.75": {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    "@1.00": {
      slidesPerView: 3,
      spaceBetween: 40,
    },
    "@1.50": {
      slidesPerView: 4,
      spaceBetween: 50,
    },
  },
});
