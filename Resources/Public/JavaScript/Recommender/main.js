$(document).ready(function () {
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(
        popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl)
    )

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(
        tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl)
    )

    var keywordsList;
    var keywords;
    var keywordsElement = document.getElementById("list-keywords");
    if (keywordsElement) {
        keywordsList = keywordsElement.querySelectorAll("li");
        keywords = $("#list-keywords :input");
    }

    var retainsAuthorCopyright = false;
    var publicationTimeMax = false;
    var apcMax = false;
    var language = false;
    var subject = false;
    var checkedKeywords = [];

    if ($("#suggest-language").length) {
        language = $("#suggest-language").val();
        $("#filter-languages").val(language);
        filter();
    }

    $("#button-list").trigger('click');

    $("#button-list").click(function () {
        changeResultView('#result-table', '#result-list');
    });

    $("#button-table").click(function () {
        changeResultView('#result-list', '#result-table');
    });

    $("#button-clear").click(function (e) {
        e.preventDefault();
        $('#results').hide();
        $('#input-title').val('');
        $('#input-abstract').val('');
        $('#input-references').val('');
    });

    $("#btn-fetch").click(function () {
        $.get(
            "https://service.tib.eu/bison/api/fetchdoi",
            {
                doi: $("#input-doi").val(),
                format: "json"
            }
        )
            .done(function (json) {
                $("#input-title").val(json.title);
                $("#input-abstract").val(json.abstract);
                $("#input-references").val(json.references);
                $("#modal-doi .btn-close").click();
            })
            .fail(function () {
                $("#validation-doi-feedback").show();
            })
    });

    $("#checkbox-author-rights").bind('change', function () {
        if ($(this).is(':checked')) {
            retainsAuthorCopyright = true;
        }
        else {
            retainsAuthorCopyright = false;
        }
        filter();
    });

    $(".form-check-input").bind('change', function () {
        if ($(this).is(':checked') && $(this).id != '#checkbox-author-rights') {
            checkedKeywords.push($(this).val());
        }
        else {
            var index = array.indexOf($(this).val());
            if (index !== -1) {
                array.splice(index, 1);
            }
        }
        filter();
    });

    $(document).on('input change', '#input-publication-time-max', function () {
        publicationTimeMax = $(this).val();
        let labelParts = $("#label-publication-time-max").text().split(' ');
        $("#label-publication-time-max").empty();
        $("#label-publication-time-max").append(
            '<b>'.concat(
                labelParts[0], ' ', labelParts[1], ' ', labelParts[2], '</b> ', publicationTimeMax, ' ', labelParts[4]
            )
        );
        filter();
    });

    $(document).on('input change', '#input-apc-max', function () {
        apcMax = $(this).val();
        let labelParts = $("#label-apc-max").text().split(' ');
        $("#label-apc-max").empty();
        $("#label-apc-max").append(
            '<b>'.concat(
                labelParts[0], ' ', labelParts[1], ' ', labelParts[2], ' ', labelParts[3], '</b> ', apcMax, ' ', labelParts[5]
            )
        );
        filter();
    });

    $(document).on('input change', '#filter-keywords', function () {
        if ($(this).val() !== '') {
            for (let i = 0; i < keywords.length; i++) {
                if (keywords[i].value.indexOf($(this).val()) >= 0) {
                    keywordsList[i].style.display = "list-item";
                } else {
                    keywordsList[i].style.display = "none";
                }
            }
        }
    });

    $("#filter-languages").change(function () {
        if ($(this).val() === '') {
            language = false;
        } else {
            language = $(this).val();
        }
        filter();
    });

    $("#filter-subjects").change(function () {
        if ($(this).val() === '') {
            subject = false;
        } else {
            subject = $(this).val();
        }
        filter();
    });

    $("#sort-select").change(function () {
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

    $("#reset-filters").click(function () {
        resetFilters();
    });

    function changeResultView(hide, show) {
        $(hide).hide();
        $(show).show();
    }

    function filter() {
        let listRows, tableRows;
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
        let listRows, tableRows;
        listRows = getListRows();
        tableRows = getTableRows();

        for (let i = 0; i < listRows.length; i++) {
            listRows[i].style.display = "list-item";
        }

        for (let i = 1; i < tableRows.length; i++) {
            tableRows[i].style.display = "table-row";
        }

        $("#filter-languages").val('');
        $("#filter-subjects").val('');
        language = false
        subject = false
    }

    function matchFilters(row) {
        return matchRetainsAuthorCopyright(row)
            && matchPublicationTime(row)
            && matchApc(row)
            && matchKeywords(row)
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
            return (parseInt(row.getAttribute('data-publication-time'), 10) || 0) <= parseInt(publicationTimeMax, 10);
        }
        return true;
    }

    function matchApc(row) {
        if (apcMax) {
            return (parseFloat(row.getAttribute('data-apc')) || 0) <= parseFloat(apcMax);
        }
        return true;
    }

    function matchKeywords(row) {
        if (checkedKeywords.length > 0) {
            for (let i = 0; i < checkedKeywords.length; i++) {
                if (row.getAttribute('data-keywords').includes(checkedKeywords[i])) {
                    return true;
                }
            }
            return false;
        }

        return true;
    }

    function matchLanguage(row) {
        if (language) {
            return row.getAttribute('data-languages').includes(language);
        }
        return true;
    }

    function matchSubject(row) {
        let dataSubject = row.getAttribute('data-subjects');
        if (subject && subject.length !== 1) {
            return dataSubject.includes(subject);
        } else if (subject && subject.length === 1) {
            let subjects = dataSubject.split(";");
            for (let i = 0; i < subjects.length; i++) {
                if (subjects[i].substring(0, 1).includes(subject)) {
                    return true;
                }
            }
            return false;
        }
        return true;
    }

    function sortList(data) {
        let rows, c, rowA, rowB, listSort;
        let sorting = true;
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
                } else if (data === 'data-apc' || data === 'data-publication-time') {
                    if ((parseInt(rowA, 10) || 0) > (parseInt(rowB, 10) || 0)) {
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
        let rows, c, rowA, rowB, tableSort;
        let sorting = true;
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
                } else if (data === 'data-apc' || data === 'data-publication-time') {
                    if ((parseInt(rowA, 10) || 0) > (parseInt(rowB, 10) || 0)) {
                        tableSort = true;
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
