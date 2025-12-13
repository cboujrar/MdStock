$('document').ready(function(){

    $('#btn_new_utilisateur').on("click", function(){
        $('#modal_new_utilisateur').modal("show");
    })
    $('#form_new_utilisateur').on("submit", function(e){
        e.preventDefault();

        $(".error_text").text("");
        let check = true;
        if ($("#newNom").val() == "") {
            check = false;
            $("#newNom").nextAll(".error_text").text("nom vide");
        }
        if ($("#newRole").val() == "") {
            check = false;
            $("#newRole").nextAll(".error_text").text("role vide");
        }
        if ($("#newEmail").val() == "") {
            check = false;
            $("#newEmail").nextAll(".error_text").text("email vide");
        }

        if (check) {
        $.ajax({
            url : new_utilisateur,
            method:"post",
            data:$('#form_new_utilisateur').serialize()
        }).then((response)=>{
            if(response.message=="email error"){
                Swal.fire({
                    text: "L'email doit etre unique",
                    icon: "error"
                  });
            }
            else if(response.message=="inserted"){
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "utilisateur bien ajoute",
                    showConfirmButton: false,
                    timer: 1500
                    });
                $('#form_new_utilisateur').trigger("reset");
            }else if(response.message == "priv_error"){
                window.location.href = utilisateure;
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

    $('.btn_update_utilisateur').on("click", function(){
        const id = $(this).data("id");
        // console.log(id);
        $('#eutilisateur_id').val(id);
        $.ajax({
            url:url_info,
            method:"post",
            data:$('#form_update_Utilisateur').serialize()
        }).then((response)=>{
            $('#nom').val(response.utilisateur.nom);
            $('#email').val(response.utilisateur.email);
            $('#modal_update_utilisateur').modal("show");
        }).catch((err)=>{
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Une erreur s'est produite!",
              });
        })
    })
    
    $('#form_update_Utilisateur').on("submit", function(event){
        const id = $(this).data("id");
        $("#utilisateur_id").val(id);   
        event.preventDefault();

        $(".error_text").text("");
        let check = true;
        if ($("#nom").val() == "") {
            check = false;
            $("#nom").nextAll(".error_text").text("nom vide");
        }
        if ($("#email").val() == "") {
            check = false;
            $("#email").nextAll(".error_text").text("email vide");
        }

        if (check) {
        $.ajax({
            url:url_update,
            method:"post",
            data:$('#form_update_Utilisateur').serialize()
        }).then((response)=>{
            if(response.message=="updated"){
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Utilisateur bien modife",
                    showConfirmButton: false,
                    timer: 1500
                    });
                $('#modal_update_utilisateur').modal("toggle");
            }else if(response.message == "priv_error"){
                window.location.href = utilisateure;
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

    $('.btn_delete_utilisateur').on('click', function(){
        const id = $(this).data("id");
        let url = url_delete.replace("pid", id);
        let row = $(this);
    
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
                    if (response.message == "deleted") {
                        swalWithBootstrapButtons.fire({
                            title: "Supprimé !",
                            text: "Utilisateur bien supprimé.",
                            icon: "success"
                        });
                        row.parents("tr").remove();
                    }else if(response.message == "priv_error"){
                        window.location.href = utilisateure;
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Une erreur s'est produite!",
                          });
                    }
                }).catch((err) => {
                    swalWithBootstrapButtons.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Une erreur s'est produite!"
                    });
                });
            } 
        });
    });
    // 


    $("#login_form").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            url:login_url,
            method:"post",
            data:$("#login_form").serialize()
        }).then((response)=>{
            if(response.message=="erreur"){
                Swal.fire({
                    text: "vous devez remplir les champes",
                    icon: "error"
                  });
            }
            else if(response.message=="email incorrect"){
                Swal.fire({
                    text: "Email incorrect",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                  });
            }
            else if(response.message=="password incorrect"){
                Swal.fire({
                    text: "Mot de passe incorrect",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                  });
            }
            else if(response.message=="done")
                window.location.href = url;
            else if(response.message=="done!"){
                Swal.fire({
                    text: "changer le mot de passe",
                    icon: "question",
                    showConfirmButton: false,
                    showConfirmButton: true,
                    timer: 3000
                  });
                window.location.href = url;
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
    })

    $("#reset_password").on("click", function(){
        $.ajax({
            url:reset_password,
            method:"post",
            data:{userId:$("#eutilisateur_id").val()}
        }).then((response)=>{
             if(response.message=="done"){
                    Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "mot de passe bien modifie <br> nouveau mot de passe: <br>"+response.password,
                                    confirmButtonText: `     <i class="fas fa-copy"></i> Copier   `,
                                    showConfirmButton: true,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            navigator.clipboard.writeText(response.password)
                                            Swal.fire({
                                                position: "center",
                                                icon: "success",
                                                title: "bien copie",
                                                showConfirmButton: false,
                                                timer:3000
                                            })
                                        }
                                    })
                $("#modal_reset_password").modal("toggle");
            }else if(response.message == "erreur"){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "probleme dans serveur email.",
                  });
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
        // $("#modal_update_utilisateur").modal("toggle");
        // $("#modal_reset_password").modal("show");
    })


    $("#table_utilisateur")
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
    .appendTo("#table_utilisateur_wrapper .col-md-6:eq(0)");

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