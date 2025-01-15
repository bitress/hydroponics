document.addEventListener("DOMContentLoaded", function () {
    // Get the current page file name from the URL
    const currentPage = window.location.pathname.split("/").pop();
  
    // Select all sidebar items
    const sidebarItems = document.querySelectorAll(".sidebar-item");
  
    // Loop through each sidebar item
    sidebarItems.forEach(item => {
      const link = item.querySelector("a"); // Get the main link
      const linkHref = link ? link.getAttribute("href") : "";
  
      // Check if this item is active
      if (linkHref !== "#" && linkHref === currentPage) {
        item.classList.add("active");
      }
  
      // Check if it has a submenu
      const submenuItems = item.querySelectorAll(".submenu-item");
      submenuItems.forEach(submenuItem => {
        const submenuLink = submenuItem.querySelector("a");
        const submenuHref = submenuLink ? submenuLink.getAttribute("href") : "";
  
        // If the submenu link matches the current page, mark both the submenu item and parent as active
        if (submenuHref === currentPage) {
          submenuItem.classList.add("active");
          item.classList.add("active", "has-active-submenu"); // Add an additional class if needed
        }
      });
    });
  });
  