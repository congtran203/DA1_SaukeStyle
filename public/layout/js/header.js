function toggleSubMenu() {
  const submenu = document.querySelector(".submenu");
  submenu.style.display = submenu.style.display === "block" ? "none" : "block";
}

document.addEventListener("DOMContentLoaded", function () {
  const userMenu = document.querySelector(".user-menu");

  if (userMenu) {
    userMenu.addEventListener("click", function (e) {
      e.stopPropagation();
      this.classList.toggle("active");
    });

    // Đóng menu khi click ra ngoài
    document.addEventListener("click", function () {
      userMenu.classList.remove("active");
    });
  }
});