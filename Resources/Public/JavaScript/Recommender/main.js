$(document).ready(function() {
    var retainsAuthorCopyright = false;
    var publicationTimeMax = false;
    var apcMax = false;
    var language = false;
    var subject = false;

    $('#btnlist').trigger('click');

    $('#btnlist').click(function() {
        changeResultView('#result-table', '#result-list');
    });
    
    $('#btntable').click(function() {
        changeResultView('#result-list', '#result-table');
    });
    $('#flexCheckDefault').bind('change', function () {
        if ($(this).is(':checked')) {
            retainsAuthorCopyright = true;
        }
        else {
            retainsAuthorCopyright = false;
        }
        filter();
    });

    $(document).on('input change', '#publication_time_max', function() {
        publicationTimeMax = $(this).val();
        var labelParts = $("#publication_time_max_label").text().split(' ');
        $("#publication_time_max_label").empty();
        $("#publication_time_max_label").append(
            '<b>'.concat(
                labelParts[0], ' ', labelParts[1], ' ', labelParts[2], '</b> ', publicationTimeMax, ' ', labelParts[4]
            )
        );
        filter();
    });

    $(document).on('input change', '#apcs_max', function() {
        apcMax = $(this).val();
        var labelParts = $("#apcs_max_label").text().split(' ');
        $("#apcs_max_label").empty();
        $("#apcs_max_label").append(
            '<b>'.concat(
                labelParts[0], ' ', labelParts[1], ' ', labelParts[2], ' ', labelParts[3], '</b> ', apcMax, ' ', labelParts[5]
            )
        );
        filter();
    });

    $('#filter-languages').change(function () { 
        if ($(this).val() === '') {
            language = false;
        } else {
            language = $(this).val();
        }
        filter();
    });

    $('#filter-subjects').change(function () { 
        if ($(this).val() === '') {
            subject = false;
        } else {
            subject = $(this).val();
        }
        filter();
    });

    $('#sort-select').change(function () { 
        if ($(this).val() === 'score') {
            sortList('data-score');
            sortTable('data-score');
        }
        if ($(this).val() === 'title') {
            sortList('data-title');
            sortTable('data-title');
        }
        if ($(this).val() === 'publisher') {
            sortList('data-publisher');
            sortTable('data-publisher');
        }
        if ($(this).val() === 'apcs') {
            sortList('data-apc');
            sortTable('data-apc');
        }
        if ($(this).val() === 'publication_time') {
            sortList('data-publication-time');
            sortTable('data-publication-time');
        }
    });

    $('#reset-filters').click(function() {
        resetFilters();
    });

    function changeResultView(hide, show) {
        $(hide).hide();
        $(show).show();
    }

    function filter() {
        //TODO check current state of all variables
        var listRows, tableRows;
        listRows = getListRows();
        tableRows = getTableRows();

        for (let i = 0; i < listRows.length; i++) {
            if (matchFilters(listRows[i])) {
                listRows[i].style.display = "list-item";
            } else {
                listRows[i].style.display = "none";              
            }
        }

        for (let i = 1; i < tableRows.length; i++) {
            if (matchFilters(tableRows[i])) {
                tableRows[i].style.display = "table-row";
            } else {
                tableRows[i].style.display = "none";
            }
        }

    }

    function resetFilters() {
        var listRows, tableRows;
        listRows = getListRows();
        tableRows = getTableRows();

        for (let i = 0; i < listRows.length; i++) {
            listRows[i].style.display = "list-item";
        }

        for (let i = 1; i < tableRows.length; i++) {
            tableRows[i].style.display = "table-row";
        }
    }

    function matchFilters(row) {
        return matchRetainsAuthorCopyright(row)
            && matchPublicationTime(row)
            && matchApc(row)
            && matchKeyword(row)
            && matchLanguage(row)
            && matchSubject(row);
    }

    function matchRetainsAuthorCopyright(row) {
        if (retainsAuthorCopyright) {
            return row.getAttribute('data-copyright');
        }
        return true;
    }

    function matchPublicationTime(row) {
        if (publicationTimeMax) {
            return (parseInt(row.getAttribute('data-publication-time')) || 0) < publicationTimeMax;
        }
        return true;
    }

    function matchApc(row) {
        if (apcMax) {
            return (parseInt(row.getAttribute('data-apc')) || 0) < apcMax;
        }
        return true;
    }

    function matchKeyword(row) {
        var match = true;

        return match;
    }

    function matchLanguage(row) {
        if (language) {
            console.log(row);
            console.log(row.getAttribute('data-languages'));
            console.log(language);
            return row.getAttribute('data-languages').includes(language);
        }
        return true;
    }

    function matchSubject(row) {
        if (subject) {
            return row.getAttribute('data-subjects').includes(subject);
        }
        return true;
    }

    function sortList(data) {
        var rows, sorting, c, rowA, rowB, listSort;
        sorting = true;
        while (sorting) {
            sorting = false;
            rows = getListRows();
            for (c = 0; c < (rows.length - 1); c++) {
                listSort = false;
                rowA = rows[c].getAttribute(data);
                rowB = rows[c + 1].getAttribute(data);
                if (data === 'data-score') {
                    if (parseFloat(rowA) < parseFloat(rowB)) {
                        listSort = true;
                        break;
                    }
                } else if(data === 'data-apc' || data === 'data-publication-time') {
                    if ((parseInt(rowA) || 0) > (parseInt(rowB) || 0)) {
                        listSort = true;
                        break;
                    }
                } else {
                    if (rowA > rowB) {
                        listSort = true;
                        break;
                    }
                }
            }
            if (listSort) {
                rows[c].parentNode.insertBefore(rows[c + 1], rows[c]);
                sorting = true;
            }
        }
    }

    function sortTable(data) {
        var rows, sorting, c, rowA, rowB, tableSort;
        sorting = true;
        while (sorting) {
            sorting = false;
            rows = getTableRows();
            for (c = 1; c < (rows.length - 1); c++) {
                tableSort = false;
                rowA = rows[c].getAttribute(data);
                rowB = rows[c + 1].getAttribute(data);
                if (data === 'data-score') {
                    if (parseFloat(rowA) < parseFloat(rowB)) {
                        tableSort = true;
                        break;
                    }
                } else if(data === 'data-apc' || data === 'data-publication-time') {
                    console.log(data);
                    console.log(rowA);
                    console.log(rowB);
                    if ((parseInt(rowA) || 0) > (parseInt(rowB) || 0)) {
                        tableSort = true;
                        console.log(tableSort);
                        break;
                    }
                } else {
                    if (rowA > rowB) {
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

    function getListRows() {
        return document.getElementById("result-list").querySelectorAll("li");
    }

    function getTableRows() {
        return document.getElementById("result-table").rows;
    }
});
