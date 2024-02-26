function starComents(id) {
    execComen(id)
}

function execComen(id, pageNumber) {
    var filters = document.getElementsByClassName('checkboxComents');
    var filtersArray = Array.from(filters);

    filtersArray.forEach(filter => {
        filter.addEventListener('change', function() {
            execComen(id);
        });
    });

    var checkedValues = [];
    filtersArray.forEach(filter => {
        if (filter.checked) {
            checkedValues.push(filter.value);
        }
    });

    coment(id, checkedValues, pageNumber);
}

function coment(id, checkbox, pageNumber) {
    console.log(id);

    var jsonData = {
        filter: checkbox,
        page: pageNumber,
        id: id
    };

    var jsonString = JSON.stringify(jsonData);

    var xhr = new XMLHttpRequest();
    var url = './inc/comentarios_content.php';

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/json');

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var comentariosDiv = document.getElementById('comentarios_display');
            comentariosDiv.innerHTML = xhr.responseText;
        }
    };

    xhr.send(jsonString);
}

function changePage(pageNumber) {
    execComen(pageNumber);
}