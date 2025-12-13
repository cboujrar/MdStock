$("document").ready(function () {
  $("#btn_new_article").on("click", function () {
    $("#modal_new_article").modal("show");
  });
  $("#form_new_article").on("submit", function (event) {
    console.log("test");
    console.log(event.currentTarget);

    event.preventDefault();

    $(".error_text").text("");
    let check = true;
    if ($("#newNom").val() == "") {
      check = false;
      $("#newNom").nextAll(".error_text").text("nom vide");
    }
    if ($("#newDescription").val() == "") {
      check = false;
      $("#newDescription").nextAll(".error_text").text("description vide");
    }
    if ($("#newPrix").val() == "") {
      check = false;
      $("#newPrix").nextAll(".error_text").text("prix vide");
    } 
    if ($("#newMinquantite").val() == "") {
      check = false;
      $("#newMinquantite").nextAll(".error_text").text("min quantite vide");
    } 
    if ($("#newQuantite").val() == "") {
      check = false;
      $("#newQuantite").nextAll(".error_text").text("quantite vide");
    }  
    if ($("#newCategorie").val() == "") {
      check = false;
      $("#newCategorie").nextAll(".error_text").text("categorie vide");
    }
    if ($("#newDepot").val() == "") {
      check = false;
      $("#newDepot").nextAll(".error_text").text("depot vide");
    }
    if (check) {
      $.ajax({
        url: url,
        method: "post",
        // data:$('#form_new_article').serialize()
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
      })
        .then((response) => {
          console.log(response);
          if (response.message == "inserted") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "article bien insere",
              showConfirmButton: false,
              timer: 1500,
            });
            $("#form_new_article").trigger("reset");
          } else if (response.message == "priv_error") {
            window.location.href = article;
          } else {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Une erreur s'est produite!",
            });
          }
        })
        .catch((err) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Une erreur s'est produite!",
          });
        });
    }
  });
  $(".btn_delete_article").on("click", function () {
    const id = $(this).data("id");
    let url = url_delete.replace("pid", id);
    let row = $(this);

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger",
      },
      buttonsStyling: false,
    });

    swalWithBootstrapButtons
      .fire({
        title: "Êtes-vous sûr(e) ?",
        text: "Vous ne pourrez pas revenir en arrière !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui, supprimez-le ",
        cancelButtonText: "Non, annulez !",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: url,
            method: "DELETE",
          })
            .then((response) => {
              if (response.message == "deleted") {
                swalWithBootstrapButtons.fire({
                  title: "Supprimé !",
                  text: "Article bien supprime.",
                  icon: "success",
                });
                row.parents("tr").remove();
              } else if (response.message == "priv_error") {
                window.location.href = article;
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Une erreur s'est produite!",
                });
              }
            })
            .catch((err) => {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Une erreur s'est produite!",
              });
            });
        }
      });
  });
  $(".btn_update_article").on("click", function () {
    const id = $(this).data("id");
    $("#article_id").val(id);
    var formData = new FormData();
    formData.append("id_article", id);
    $.ajax({
      url: url_info,
      method: "post",
      data: formData,
      processData: false,
      contentType: false,
    })
      .then((response) => {
          $("#nom").val(response.article.nom);
          $("#description").val(response.article.description);
          $("#prix").val(response.article.prix);
          $("#quantite").val(response.article.quantite);
          $("#minquantite").val(response.article.minquantite);
          // console.log(response.article.idDepot);
          // $('#ecategorie').val(response.article.idCategorie.id);
          // $('#edepot').val(response.article.idDepot.id);
          var selectedCateg = response.article.idCategorie.nomCategorie;
          $("#ecategorie option").each(function () {
            if ($(this).text() == selectedCateg) {
              $(this).prop("selected", true);
            }
          });
          var selectedDepot = response.article.idDepot.adresse;
          $("#edepot option").each(function () {
            if ($(this).text() == selectedDepot) {
              $(this).prop("selected", true);
            }
          });
          $("#modal_update_article").modal("show");
        
      })
      .catch((err) => {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Une erreur s'est produite!",
        });
      });
  });

  $("#add_file").on("click", function () {
    document.getElementById("image_add").click();
  });
  $("#e_add_file").on("click", function () {
    document.getElementById("image").click();
  });
  $("#form_update_article").on("submit", function (event) {
    event.preventDefault();

    $(".error_text").text("");
    let check = true;
    if ($("#nom").val() == "") {
      check = false;
      $("#nom").nextAll(".error_text").text("nom vide");
    }
    if ($("#description").val() == "") {
      check = false;
      $("#description").nextAll(".error_text").text("description vide");
    }
    if ($("#prix").val() == "") {
      check = false;
      $("#prix").nextAll(".error_text").text("prix vide");
    } 
    if ($("#minquantite").val() == "") {
      check = false;
      $("#minquantite").nextAll(".error_text").text("min quantite vide");
    } 
    if ($("#quantite").val() == "") {
      check = false;
      $("#quantite").nextAll(".error_text").text("quantite vide");
    } 
    if ($("#ecategorie").val() == "") {
      check = false;
      $("#ecategorie").nextAll(".error_text").text("categorie vide");
    }
    if ($("#edepot").val() == "") {
      check = false;
      $("#edepot").nextAll(".error_text").text("depot vide");
    }
    if (check) {
    $.ajax({
      url: url_update,
      method: "post",
      data: new FormData(this),
      processData: false,
      contentType: false,
    })
      .then((response) => {
        if (response.message == "updated") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Article bien modife",
            showConfirmButton: false,
            timer: 1500,
          });
          $("#modal_update_article").modal("toggle");
        } else if (response.message == "priv_error") {
          window.location.href = article;
        } else {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Une erreur s'est produite!",
          });
        }
      })
      .catch((err) => {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Une erreur s'est produite!",
        });
      });
    }
  });

  $("#table_article")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
      paging: true,
      columnDefs: [
        {
          targets: "datatable-nosort",
          orderable: false,
        },
      ],
    })
    .buttons()
    .container()
    .appendTo("#table_article_wrapper .col-md-6:eq(0)");

  $(document).ajaxSend(function () {
    $(".my-loader").show();
    // fadeIn(250);
  });
  $(document).ajaxComplete(function () {
    // $(".my-loader").Show()
    $(".my-loader").fadeOut(250);
  });
  $(".my-loader")
    .bind("ajaxStart", function () {
      $(this).show();
    })
    .bind("ajaxStop", function () {
      $(this).hide();
    });
});
