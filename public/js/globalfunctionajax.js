// public/js/global-functions.js

function handleFormSubmission(
    formId,
    urlFunc,
    method,
    successMessage,
    drawerId = null,
    table = null
) {
    $(formId).on("submit", function (e) {
        e.preventDefault();
        let url = typeof urlFunc === "function" ? urlFunc() : urlFunc;
        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function (response) {
                $(formId)[0].reset();
                if (table) {
                    table.ajax.reload();
                }
                if (drawerId) {
                    closeDrawer(drawerId);
                }
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: successMessage,
                    showConfirmButton: false,
                    timer: 2000,
                });
            },
            error: function (response) {
                let errors = response.responseJSON.errors;
                let errorMessages = "";

                for (let key in errors) {
                    errorMessages += errors[key][0] + "\n";
                }

                alert(errorMessages);
            },
        });
    });
}

function handleEditButtonClick(tableId, editFormId, editUrlBase, drawerId) {
    $(tableId).on("click", ".edit", function (event) {
        event.preventDefault();
        let id = $(this).attr("id");
        $.ajax({
            url: editUrlBase + id + "/edit",
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                $(editFormId).attr("action", editUrlBase + id);
                $(editFormId + " #name").val(res.name);
                $(editFormId + " #email").val(res.email);
                $(editFormId + " #password").val("");
                openDrawer(drawerId);
            },
        });
    });
}

function handleDeleteButtonClick(tableId, deleteUrlBase, table = null) {
    $(tableId).on("click", ".delete", function (event) {
        event.preventDefault();
        let id = $(this).attr("id");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrlBase + id,
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        table.ajax.reload();
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: response.responseJSON.message,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    },
                });
            }
        });
    });
}
