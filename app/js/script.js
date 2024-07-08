async function callFileEndTask (params) {
    try {
        const reponse = await fetch("file.php?" + params);
        const dataResponse = await reponse.json();
        if (!dataResponse.isOk) {
            console.error(dataResponse.errorMessage);
            return;
        }
        document.querySelector("[data-endTask-id='" + dataResponse.id + "']").remove();

    } catch (error) {
        console.error("Unable to load todolist datas from the server"  + error);
    }
}


document.querySelectorAll("[data-end-id]").forEach(function(task) {
    task.addEventListener("click", function(e) {

        callFileEndTask('action=end&id=' + task.dataset.endId + '&myToken=' + document.getElementById('myToken').value);
    });
});


async function callFileDeleteTask (params) {
    try {
        const reponse = await fetch("file.php?" + params);
        const dataResponse = await reponse.json();
        if (!dataResponse.isOk) {
            console.error(dataResponse.errorMessage);
            return;
        }
        document.querySelector("[data-endTask-id='" + dataResponse.id + "']").remove();

    } catch (error) {
        console.error("Unable to load todolist datas from the server"  + error);
    }
}


document.querySelectorAll("[data-delete-id]").forEach(function(task) {
    task.addEventListener("click", function(e) {

        callFileDeleteTask('action=delete&id=' + task.dataset.deleteId + '&myToken=' + document.getElementById('myToken').value);
    });
});