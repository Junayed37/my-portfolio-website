// contact form AJAX submission
const contactForm = document.getElementById("contactForm");
const formStatus  = document.getElementById("form-status");

if (contactForm) {
  contactForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const submitBtn = contactForm.querySelector("button[type='submit']");
    submitBtn.disabled = true;
    submitBtn.textContent = "Sending...";
    formStatus.style.color = "";
    formStatus.textContent = "";

    const formData = new FormData(contactForm);

    fetch(BASE_URL + "/index.php?action=contact", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status === "success") {
          formStatus.style.color = "#00abf0";
          formStatus.textContent = data.message;
          contactForm.reset();
        } else {
          formStatus.style.color = "#ff4d4d";
          formStatus.textContent = data.message;
        }
      })
      .catch(() => {
        formStatus.style.color = "#ff4d4d";
        formStatus.textContent = "Something went wrong. Please try again.";
      })
      .finally(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = "Submit";
      });
  });
}

// toggle icon navbar
let menuIcon = document.querySelector("#menu-icon");
let navbar = document.querySelector(".navbar");

menuIcon.onclick = () => {
  menuIcon.classList.toggle('bx-x');
  navbar.classList.toggle('active');
};

// scroll sections
let sections = document.querySelectorAll("section");
let navlinks = document.querySelectorAll("header nav a");

window.onscroll = () => {
  sections.forEach((sec) => {
    let top = window.scrollY;
    let offset = sec.offsetTop - 100;
    let height = sec.offsetHeight;
    let id = sec.getAttribute("id");

    if (top >= offset && top < offset + height) {
      navlinks.forEach((links) => {
        links.classList.remove("active");
        document
          .querySelector("header nav a[href*=" + id + "]")
          .classList.add("active");
      });
      sec.classList.add('show-animate');
    } else {
      sec.classList.remove('show-animate');
    }
  });

  let header = document.querySelector("header");
  header.classList.toggle("sticky", window.scrollY > 100);

  menuIcon.classList.remove('bx-x');
  navbar.classList.remove('active');

  let footer = document.querySelector('footer');
  footer.classList.toggle('show-animate', this.innerHeight + this.scrollY >= document.scrollingElement.scrollHeight);
};
