function initializeTableFilter(inputId, tableBodyId) {
    document.getElementById(inputId).addEventListener('keyup', function() {
        let input = document.getElementById(inputId);
        let filter = input.value.toLowerCase();
        let tableBody = document.getElementById(tableBodyId);
        let rows = tableBody.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }

            rows[i].style.display = match ? '' : 'none';
        }
    });
}
