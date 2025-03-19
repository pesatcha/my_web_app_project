document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.querySelector('#searchResult tbody');
    const tableRows = tableBody.querySelectorAll('tr');
    const noDataMessage = document.createElement('tr');
    noDataMessage.innerHTML = '<td colspan="7" class="text-center">ไม่พบข้อมูล</td>';
    noDataMessage.style.display = 'none';
    tableBody.appendChild(noDataMessage);

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.toLowerCase();
        let hasVisibleRow = false;

        tableRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');

            if (rowText.includes(searchTerm)) {
                row.style.display = '';
                hasVisibleRow = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Show or hide the "no data" message
        noDataMessage.style.display = hasVisibleRow ? 'none' : '';
    });
});
