(() => {
  const button = document.querySelector(".menu-toggle");
  const nav = document.querySelector("#primary-nav");
  if (button && nav) {
    const close = () => {
      button.setAttribute("aria-expanded", "false");
      button.setAttribute("aria-label", "Abrir menu");
      nav.classList.remove("is-open");
    };
    button.addEventListener("click", () => {
      const open = button.getAttribute("aria-expanded") !== "true";
      button.setAttribute("aria-expanded", String(open));
      button.setAttribute("aria-label", open ? "Fechar menu" : "Abrir menu");
      nav.classList.toggle("is-open", open);
    });
    nav
      .querySelectorAll("a")
      .forEach((link) => link.addEventListener("click", close));
    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") {
        close();
        button.focus();
      }
    });
    document.addEventListener("click", (event) => {
      if (!nav.contains(event.target) && !button.contains(event.target))
        close();
    });
  }
  const form = document.querySelector("[data-contact-form]");
  if (form)
    form.addEventListener("submit", (event) => {
      if (!form.checkValidity()) {
        event.preventDefault();
        form.reportValidity();
        return;
      }
      const submit = form.querySelector('button[type="submit"]');
      submit.disabled = true;
      submit.textContent = "Enviando…";
    });
})();
