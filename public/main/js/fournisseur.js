$('document').ready(function()
{
    $('#btn_new_fournisseur').on('click', ()=>{
        $('#modal_new_fournisseur').modal("show")
    })
    // new category
    $('#form_new_fournisseur').on('submit', function(event){
        event.preventDefault()
        
        $(".error_text").text("");
        let check = true;
        if ($("#newNom").val() == "") {
            check = false;
            $("#newNom").nextAll(".error_text").text("nom vide");
        }
        if ($("#newAdress").val() == "") {
            check = false;
            $("#newAdress").nextAll(".error_text").text("adresse vide");
        }
        if ($("#newTelephone").val() == "") {
            check = false;
            $("#newTelephone").nextAll(".error_text").text("telephone vide");
        }
        if ($("#newEmail").val() == "") {
            check = false;
            $("#newEmail").nextAll(".error_text").text("email vide");
        }

        if (check) {
        $.ajax({
            url: url, 
            method: "post",
            data: $('#form_new_fournisseur').serialize()
        }).then((response) => {
            if (response.message=="inserted"){
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "fournisseur bien insere",
                    showConfirmButton: false,
                    timer: 1500
                    });
                $('#form_new_fournisseur').trigger("reset")
            }else if(response.message == "priv_error"){
                window.location.href = fournisseur;
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
    $('.btn_delete_fournisseur').on('click', function(){
        const id = $(this).data("id")
        console.log(id);
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
                        
                    if (response.message=="deleted"){
                        swalWithBootstrapButtons.fire({
                            title: "Supprimé !",
                            text: "fournisseur bien supprime.",
                            icon: "success"
                        });
                    row.parents("tr").remove()
                }else if(response.message == "priv_error"){
                    window.location.href = fournisseur;
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
        });
            }
    });
});

    $('.btn_update_fournisseur').on("click", function(){
        const id = $(this).data("id");
        // console.log(id);
        $('#fournisseur_id').val(id);
        $.ajax({
            url:url_info,
            method:"post",
            data:$('#form_update_fournisseur').serialize()
        }).then((response)=>{
            $('#nom').val(response.fournisseur.nomFournisseur);
            $('#adresse').val(response.fournisseur.adresse);
            $('#telephone').val(response.fournisseur.telephone);
            $('#email').val(response.fournisseur.email);
            $('#modal_update_fournisseur').modal("show");
        
        }).catch((err)=>{
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Une erreur s'est produite!",
              });
        })
    })

    $('#form_update_fournisseur').on("submit", function(event){
        event.preventDefault();

        $(".error_text").text("");
        let check = true;
        if ($("#nom").val() == "") {
            check = false;
            $("#nom").nextAll(".error_text").text("nom vide");
        }
        if ($("#adresse").val() == "") {
            check = false;
            $("#adresse").nextAll(".error_text").text("adresse vide");
        }
        if ($("#telephone").val() == "") {
            check = false;
            $("#telephone").nextAll(".error_text").text("telephone vide");
        }
        if ($("#email").val() == "") {
            check = false;
            $("#email").nextAll(".error_text").text("email vide");
        }

        if (check) {
        $.ajax({
            url:url_update,
            method:"post",
            data:$('#form_update_fournisseur').serialize()
        }).then((response)=>{
            if(response.message=="updated"){
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Fournisseur bien modife",
                    showConfirmButton: false,
                    timer: 1500
                    });
                $('#modal_update_fournisseur').modal("toggle");
            }else if(response.message == "priv_error"){
                window.location.href = fournisseur;
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
              });;
        })
    }
    })

        $("#table_fournisseur").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
          "paging": true,
          columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        }).buttons().container().appendTo('#table_fournisseur_wrapper .col-md-6:eq(0)');
        
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

