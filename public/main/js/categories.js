$('document').ready(function()
{
    console.log("ready");
    $('#btn_new_categ').on('click', ()=>{
        console.log("test");
        $('#modal_new_categ').modal("show")
    })
    // new category
    $('#form_new_categ').on('submit', function(event){
        event.preventDefault()
        //  console.log( $('#form_new_categ').serialize());

         $(".error_text").text("");
         let check = true;
         if ($("#newNom").val() == "") {
           check = false;
           $("#newNom").nextAll(".error_text").text("nom vide");
         }

         if (check) {
        $.ajax({
            url: url, 
            method: "post",
            data: $('#form_new_categ').serialize()
        }).then((response) => {
            console.log(response);
            if (response.message=="inserted"){
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "categorie bien insere",
                    showConfirmButton: false,
                    timer: 1500
                    });
                $('#form_new_categ').trigger("reset")
            }else if(response.message == "priv_error"){
                window.location.href = categorie;
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
    $('.btn_delete_categ').on('click', function(){
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
            html: "Vous ne pourrez pas revenir en arrière ! <br>si la catégorie contient des articles, ils seront placés dans la catégorie par défaut",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Oui, supprimez-le ",
            cancelButtonText: "Non, annulez !",
            reverseButtons: true,
            
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url, 
                    method: "DELETE",
                }).then((response) => {
                    // console.log(response);
                    if (response.message=="deleted"){
                        let artic = "<br>";
                        if(response.countArticle == 1){
                            artic = response.countArticle+" article placé dans la catégorie par défaut"
                        }else if(response.countArticle > 1){
                            artic = response.countArticle+" articles placés dans la catégorie par défaut"
                        }
                    swalWithBootstrapButtons.fire({
                        title: "Supprimé !",
                        html: "Categorie bien supprime."+artic,
                        icon: "success"
                    });
                    row.parents("tr").remove()
                }else if(response.message == "priv_error"){
                    window.location.href = categorie;
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

    })
    $('.btn_update_categ').on("click", function(){
        const id = $(this).data("id");
        $('#categ_id').val(id);
        $.ajax({
            url:url_info,
            method:"post",
            data:$('#form_update_categ').serialize()
        }).then((response)=>{
            $('#nom').val(response.categorie.nomCategorie);
            $('#modal_update_categ').modal("show");
        }).catch((err)=>{
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Une erreur s'est produite!",
              });
        })
    })

    $('#form_update_categ').on("submit", function(event){
        event.preventDefault();

        $(".error_text").text("");
        let check = true;
        if ($("#nom").val() == "") {
          check = false;
          $("#nom").nextAll(".error_text").text("nom vide");
        }

        if (check) {
        $.ajax({
            url:url_update,
            method:"post",
            data:$('#form_update_categ').serialize()
        }).then((response)=>{
            if(response.message=="updated"){
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "categorie bien modife",
                    showConfirmButton: false,
                    timer: 1500
                    });
                $('#modal_update_categ').modal("toggle");
            }else if(response.message == "priv_error"){
                window.location.href = categorie;
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

        $("#table_category").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
          "paging": true,
          columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        }).buttons().container().appendTo('#table_category_wrapper .col-md-6:eq(0)');
        // $('#example2').DataTable({
        //   "paging": true,
        //   "lengthChange": false,
        //   "searching": false,
        //   "ordering": true,
        //   "info": true,
        //   "autoWidth": false,
        //   "responsive": true,
        // });
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

