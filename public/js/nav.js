window.addEventListener("scroll", function () {
  const header = document.getElementById("mainHeader");
  const toggler = document.getElementById("humbergerToggler");
  const bars = toggler.querySelectorAll(".bar");

  if (window.scrollY > 0 || toggler.classList.contains("active-nav")) {
    header.classList.add("nav-scroll");
    bars.forEach((bar) => {
      if (!bar.classList.contains("bg-red-500")) {
        bar.classList.replace("bg-white", "bg-[#CC9B6D]");
      }
    });
  } else {
    header.classList.remove("nav-scroll");
    bars.forEach((bar) => {
      if (!bar.classList.contains("bg-red-500")) {
        bar.classList.replace("bg-[#CC9B6D]", "bg-white");
      }
    });
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const header = document.getElementById("mainHeader");
  const mobileMenu = document.getElementById("mobileMenu");
  const toggler = document.getElementById("humbergerToggler");
  const bars = toggler.querySelectorAll(".bar");

  if (!mobileMenu || !toggler) {
    console.error("Element(s) not found. Please check the IDs.");
    return;
  }

  toggler.addEventListener("click", () => {
    toggler.classList.toggle("active-nav");

    if (toggler.classList.contains("active-nav")) {
      mobileMenu.style.maxHeight = mobileMenu.scrollHeight + "px";
      header.classList.add("nav-scroll");
      bars.forEach((bar) => bar.classList.add("bg-red-500"));
    } else {
      mobileMenu.style.maxHeight = 0;
      bars.forEach((bar) => bar.classList.remove("bg-red-500"));

      // Only remove nav-scroll if the page is at the top and the menu is not active
      if (window.scrollY === 0) {
        header.classList.remove("nav-scroll");
        bars.forEach((bar) => bar.classList.replace("bg-[#CC9B6D]", "bg-white"));
      } else {
        bars.forEach((bar) => bar.classList.replace("bg-white", "bg-[#CC9B6D]"));
      }
    }
  });
});
