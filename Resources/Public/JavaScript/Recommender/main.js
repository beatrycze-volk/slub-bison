$(document).ready(function() {
    $('#btnlist').trigger('click');

    $('#btnlist').click(function() {
        changeResultView('#result-table', '#result-list');
    });
    
    $('#btntable').click(function() {
        changeResultView('#result-list', '#result-table');
    });

    $('#sort-select').change(function () { 
        if ($(this).val() === 'score'){
            sortList('score');
            sortTable(1, 'th');
        }
        if ($(this).val() === 'title'){
            sortList('title');
            sortTable(0, 'th');
        }
        if ($(this).val() === 'publisher'){
            sortList('publisher');
            sortTable(1, 'td');
        }
        if ($(this).val() === 'apc'){
            sortTable(2, 'td');
        }
        if ($(this).val() === 'publication_time'){
            sortTable(7, 'td');
        }
    });

    function changeResultView(hide, show) {
        $(hide).hide();
        $(show).show();
    }

    function sortList(sort) {
        var list, rows, sorting, c, rowA, rowB, listSort;
        list = document.getElementById("result-list");
        sorting = true;
        while (sorting) {
            sorting = false;
            rows = list.querySelectorAll("li");
            console.log(rows);
            for (c = 0; c < (rows.length - 1); c++) {
                listSort = false;
                rowA = rows[c].getElementsByTagName('div')[2];
                rowB = rows[c + 1].getElementsByTagName('div')[2];
                if (sort == 'score') {
                    rowAContent = rowA.children[0].getElementsByTagName('a')[0].getElementsByTagName('div')[0];
                    rowBContent = rowB.children[0].getElementsByTagName('a')[0].getElementsByTagName('div')[0];
                } else {
                    rowAContent = rowA.children[1];
                    rowBContent = rowB.children[1];
                    if(sort == 'title') {
                        rowAContent = rowAContent.getElementsByTagName('h5')[0].getElementsByTagName('a')[0];
                        rowBContent = rowBContent.getElementsByTagName('h5')[0].getElementsByTagName('a')[0];
                    } else if (sort == 'publisher') {
                        rowAContent = rowAContent.getElementsByTagName('p')[0];
                        rowBContent = rowBContent.getElementsByTagName('p')[0];
                    }
                }
                if (rowAContent.innerHTML.toLowerCase() > rowBContent.innerHTML.toLowerCase()) {
                    listSort = true;
                    console.log(rowAContent.innerHTML);
                    console.log(rowBContent.innerHTML);
                    break;
                }
            }
            if (listSort) {
                rows[c].parentNode.insertBefore(rows[c + 1], rows[c]);
                sorting = true;
            }
        }
    }

    function sortTable(column, tag) {
        var table, rows, sorting, c, rowA, rowB, tableSort;
        table = document.getElementById("result-table");
        sorting = true;
        while (sorting) {
            sorting = false;
            rows = table.rows;
            for (c = 1; c < (rows.length - 1); c++) {
                tableSort = false;
                rowA = rows[c].getElementsByTagName(tag)[column];
                rowB = rows[c + 1].getElementsByTagName(tag)[column];
                if (tag == 'th') {
                    rowAContent = rowA.getElementsByTagName('a')[0];
                    rowBContent = rowB.getElementsByTagName('a')[0];
                    if (rowAContent.innerHTML.toLowerCase() > rowBContent.innerHTML.toLowerCase()) {
                        tableSort = true;
                        console.log(rowAContent.innerHTML);
                        console.log(rowBContent.innerHTML);
                        break;
                    }
                } else {
                    if (rowA.innerHTML.toLowerCase() > rowB.innerHTML.toLowerCase()) {
                        tableSort = true;
                    break;
                    }
                }
            }
            if (tableSort) {
                rows[c].parentNode.insertBefore(rows[c + 1], rows[c]);
                sorting = true;
            }
        }
    }
});
