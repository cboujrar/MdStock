$('document').ready(function(){
    $('#btn_new_depot').on("click", function(){
        $('#modal_new_depot').modal("show")
    })
    $('#form_new_depot').on('submit', function(event){
        event.preventDefault()

        $(".error_text").text("");
        let check = true;
        if ($("#newAdress").val() == "") {
          check = false;
          $("#newAdress").nextAll(".error_text").text("adresse vide");
        }
        if ($("#newCapacite").val() == "") {
            check = false;
            $("#newCapacite").nextAll(".error_text").text("capacite vide");
          }
        if (check) {
        $.ajax({
            url: url,
            methode:"post",
            data: $('#form_new_depot').serialize() 
        }).then((response) =>{
            if(response.message=="inserted"){
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Depot bien insere",
                    showConfirmButton: false,
                    timer: 1500
                    });
                $('#form_new_depot').trigger("reset")
            }else if(response.message == "priv_error"){
                window.location.href = depot;
            }else{
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Une erreur s'est produite!",
                  });
            }
        }).catch((err)=> {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Une erreur s'est produite!",
              });
        })
    }
    })
    $('.btn_delete_depot').on('click', function(){
        const id = $(this).data("id")
        let url = url_delete.replace("pid", id)
        let row =  $(this)
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-success",
              cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
    
        swalWithBootstrapButtons.fire({
            title: "Êtes-vous sûr(e) ?",
            text: "Vous ne pourrez pas revenir en arrière !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Oui, supprimez-le ",
            cancelButtonText: "Non, annulez !",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url, 
                    method: "DELETE",
                }).then((response) => {
                    if (response.message == "hasArticles"){
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Impossible de supprimer un depot qui contient des articles.",
                        });
                    }else if (response.message=="deleted"){
                        swalWithBootstrapButtons.fire({
                            title: "Supprimé !",
                            text: "Depot bien supprime.",
                            icon: "success"
                        });
                        row.parents("tr").remove();
                    }else if(response.message == "priv_error"){
                        window.location.href = depot;
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Une erreur s'est produite!",
                          });
                    }
                }).catch((err)=>{
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Une erreur s'est produite!",
                    });
                })
            }
        })

    })

    $('.btn_update_depot').on("click", function(){
        const id = $(this).data("id");
        // console.log(id);
        $('#depot_id').val(id);
        $.ajax({
            url:url_info,
            method:"post",
            data:$('#form_update_depot').serialize()
        }).then((response)=>{
            $('#adresse').val(response.depot.adresse);
            $('#capacite').val(response.depot.capacite);
            $('#modal_update_depot').modal("show");
        }).catch((err)=>{
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Une erreur s'est produite!",
              });
        })
    })

    $('#form_update_depot').on("submit", function(event){
        event.preventDefault();

        $(".error_text").text("");
        let check = true;
        if ($("#adresse").val() == "") {
          check = false;
          $("#adresse").nextAll(".error_text").text("adresse vide");
        }
        if ($("#capacite").val() == "") {
            check = false;
            $("#capacite").nextAll(".error_text").text("capacite vide");
          }
        if (check) {
        $.ajax({
            url:url_update,
            method:"post",
            data:$('#form_update_depot').serialize()
        }).then((response)=>{
            if(response.message=="updated"){
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Depot bien modife",
                    showConfirmButton: false,
                    timer: 1500
                    });
                $('#modal_update_depot').modal("toggle");
            }else if(response.message == "priv_error"){
                window.location.href = depot;
            }else{
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Une erreur s'est produite!",
                  });
            }
        }).catch((err)=>{
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Une erreur s'est produite!",
              });
        })
    }
    })
    $("#table_depot").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "paging": true,
        columnDefs: [{
          targets: "datatable-nosort",
          orderable: false,
      }],
      }).buttons().container().appendTo('#table_depot_wrapper .col-md-6:eq(0)');
    
      $(document).ajaxSend(function(){
        $(".my-loader").show()
        // fadeIn(250);
    });
    $(document).ajaxComplete(function(){
      // $(".my-loader").Show()
        $(".my-loader").fadeOut(250);
    });
    $(".my-loader").bind("ajaxStart", function(){
      $(this).show();
  }).bind("ajaxStop", function(){
      $(this).hide();
  });
})