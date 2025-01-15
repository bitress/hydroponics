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
  

  $(document).ready(function() {
    $('.relay-toggle').change(function() {
        var relayId = $(this).data('relay-id');
        var status = $(this).is(':checked') ? 1 : 0;
        $(this).prop('disabled', true);

        $.ajax({
            url: 'ajax.php', 
            type: 'POST',
            data: {
              action: 'toggleRelay',
                relay_id: relayId,
                status: status
            },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    console.log('Relay updated successfully.');
                } else {
                    alert('Error: ' + response.message);
                    $(this).prop('checked', !status);
                }
            }.bind(this),
            error: function(xhr, status, error) {
                alert('AJAX Error: ' + error);
                $(this).prop('checked', !status);
            }.bind(this),
            complete: function() {
                $(this).prop('disabled', false);
            }.bind(this)
        });
    });
});