document.addEventListener("DOMContentLoaded", function () {
    // Get the current page file name from the URL
    const currentPage = window.location.pathname.split("/").pop();
  
    // Select all sidebar items (assuming sidebar-item contains the link)
    const sidebarItems = document.querySelectorAll(".sidebar-item");
  
    // Loop through each sidebar item
    sidebarItems.forEach(item => {
      const link = item.querySelector("a"); // Get the link inside each sidebar item
      const linkHref = link ? link.getAttribute("href") : "";
  
      // Only add 'active' if the linkHref is not '#' and matches the current page
      if (linkHref !== "#" && linkHref === currentPage) {
        item.classList.add("active");
      }
    });
  });
  