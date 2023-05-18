// SIDEBAR TOGGLE

var sidebarOpen = false;
var sidebar = document.getElementById("sidebar");

function openSidebar() {
  if(!sidebarOpen) {
    sidebar.classList.add("sidebar-responsive");
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if(sidebarOpen) {
    sidebar.classList.remove("sidebar-responsive");
    sidebarOpen = false;
  }
}



//DELETE
    function confirmDelete(levelId, levelName) {
    if (confirm("Are you sure you want to delete " + levelName + "?")) {
        var form = document.getElementById('deleteLevelForm' + levelId);
        form.submit();
        }
    }


    const studentsTableBody = document.getElementById('studentsTableBody');
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', () => {
        const searchQuery = searchInput.value.trim().toLowerCase();
        const rows = studentsTableBody.getElementsByTagName('tr');

        for (let row of rows) {
            const name = row.getElementsByTagName('td')[2].textContent.toLowerCase();

            if (name.includes(searchQuery)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });


    function printContent() {
        var printContents = document.querySelector('.big-card').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
