document.querySelectorAll(".link").forEach(link => {
  link.addEventListener("click", function (e) {
    e.preventDefault();

    const loginForm = document.querySelector(".form1");
    const registerForm = document.querySelector(".form2");

    // toggle visibility
    loginForm.classList.toggle("active");
    registerForm.classList.toggle("form22");
  });
});
