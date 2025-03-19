document.addEventListener('DOMContentLoaded', function() {
    const roleFilter = document.getElementById('roleFilter');
    const tableRows = document.querySelectorAll('tbody tr');

    roleFilter.addEventListener('change', function() {
        const selectedRole = this.value;
        tableRows.forEach(row => {
            const roleCell = row.querySelector('td:nth-child(7)').textContent.trim();
            if (selectedRole === 'all' || roleCell === selectedRole) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});