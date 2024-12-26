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
