$('document').ready(function(){

    $("#btn_new_bon_commande").on("click", function(){
        $("#modal_new_bon_Commande").modal("show");
    });

    $("#form_new_bon_commande").on("submit", function (e) {
        e.preventDefault();
        // console.log($("#form_new_bon_commande").serialize());


    $(".error_text").text("");
    let check = true;
    if ($("#newObservation").val() == "") {
      check = false;
      $("#newObservation").nextAll(".error_text").text("observation vide");
    }
    if ($("#newDateCommande").val() == "") {
      check = false;
      $("#newDateCommande").nextAll(".error_text").text("date de commande vide");
    }
    if ($("#newDateLivraison").val() == "") {
      check = false;
      $("#newDateLivraison").nextAll(".error_text").text("date de livraison vide");
    } 
    if ($("#newStatus").val() == "--") {
      check = false;
      $("#newStatus").nextAll(".error_text").text("status vide");
    } 
    if ($("#fournisseur").val() == "--") {
      check = false;
      $("#fournisseur").nextAll(".error_text").text("fournisseur vide");
    } 

    if (check) {
        $.ajax({
          url: url,
          method: "post",
          data: $("#form_new_bon_commande").serialize(),
        }).then((response) => {
          if (response.message == "inserted") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Bon de commande bien insere",
              showConfirmButton: false,
              timer: 1500
              })
            }else if(response.message == "priv_error"){
              window.location.href = bonCommande;
          }else{
              Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Une erreur s'est produite!",
                });
          }
            $("#form_new_bon_commande").trigger("reset");
        }).catch((err)=>{
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Une erreur s'est produite!",
          });
        })
      }
      });

    $('.btn_delete_bon_commande').on("click", function(){
        const id = $(this).data("id");
        let url = url_delete_bonC.replace("pid", id);
        let row = $(this)
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
                url:url,
                method:"DELETE",
            }).then((response) =>{
              if (response.message=="deleted"){
                swalWithBootstrapButtons.fire({
                    title: "Supprimé !",
                    text: "Bon commande bien supprime.",
                    icon: "success"
                });
                    row.parents("tr").remove()
                  }else if(response.message == "priv_error"){
                    window.location.href = bonCommande;
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

      $('.btn_update_bon_commande').on("click", function(){
        const id = $(this).data("id");
        $('#bon_commande_id').val(id);
        $.ajax({
            url:url_info,
            method:"post",
            data:$('#form_update_bon_commande').serialize()
        }).then((response)=>{
            $('#observation').val(response.bonCommande.observation);
            $('#dateC').val(response.bonCommande.DateCommande.split('T')[0]);
            $('#datel').val(response.bonCommande.dateLivraison.split('T')[0]);
            var selectedstatus = response.bonCommande.codeStatus.libelle;
            let html=``;
            if(response.bonCommande.codeStatus.libelle == "valide"){
                  
                  html += `<span class="badge badge-success">valide</span>`;
            }else{
                html+=`<select class="form-control" name="status" id="estatus">`
              response.codeStatus.forEach((s) => {
                html += `
                  <option value="${s.id}">${s.libelle}</option>
                `;
              });
              html+=`</select>`
            }
            $("#add_status").html(html);

            var selectedFour = response.bonCommande.idFournisseur.nomFournisseur;
            $("#efournisseur").val(response.bonCommande.idFournisseur.id)
            // $("#efournisseur option").each(function(){
            //     if ($(this).text() == selectedFour) {
            //         $(this).prop('selected', true);
            //     }
            // });
            $('#modal_update_bon_commande').modal("show");
        }).catch((err)=>{
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Une erreur s'est produite!",
          });
        })
    });

    $('#form_update_bon_commande').on("submit", function(event){
        event.preventDefault();

        $(".error_text").text("");
        let check = true;
        if ($("#observation").val() == "") {
          check = false;
          $("#observation").nextAll(".error_text").text("observation vide");
        }
        if ($("#dateC").val() == "") {
          check = false;
          $("#dateC").nextAll(".error_text").text("date de commande vide");
        }
        if ($("#datel").val() == "") {
          check = false;
          $("#datel").nextAll(".error_text").text("date de livraison vide");
        } 
        // if ($("#newStatus").val() == "--") {
        //   check = false;
        //   $("#newStatus").nextAll(".error_text").text("status vide");
        // } 
        // if ($("#fournisseur").val() == "--") {
        //   check = false;
        //   $("#fournisseur").nextAll(".error_text").text("fournisseur vide");
        // } 
    
        if (check) {
        $.ajax({
            url:url_update,
            method:"post",
            data:$('#form_update_bon_commande').serialize()
        }).then((response)=>{
            if(response.message=="updated"){
              Swal.fire({
                position: "center",
                icon: "success",
                title: "Bon commande bien modife",
                showConfirmButton: false,
                timer: 1500
                })
              }else if(response.message == "priv_error"){
                window.location.href = bonCommande;
            }else{
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Une erreur s'est produite!",
                  });
            }
              $('#modal_update_bon_commande').modal("toggle");
        }).catch((err)=>{
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Une erreur s'est produite!",
          });
        })
      }
    })
    
      function chargerDetailBs(id) {
        let url = url_list_detail.replace("pid", id);
        $.ajax({
          url: url,
          method: "post",
        }).then((response) => {
          let html = "";
        if(response.message == "priv_error"){
          window.location.href = bonCommande;
      }else{
          response.detail.forEach((d) => {
            html+=`
                    <tr> 
                      <td> ${d.quantite}</td>
                      <td> ${d.prix}</td>
                      <td> ${d.article.nom}</td>
                      <td> 
                         <button data-id="" class="btn btn-primary"> <span><i class="fas fa-pencil-alt"></i> </span></button>
                        <button data-id="${d.id}" class="btn btn-danger btn_delete_detailC" > <span><i class="fas fa-trash"></i> </span></button>
                      </td>
                    
                  </tr>
                    `;
          });
          $("#table_list_detail tbody").html(html);
        }
        }).catch((err)=>{
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Une erreur s'est produite!",
          });
        })
      }

    $(".btn_addDetailsBonCommande").on("click", function () {
        const id = $(this).data("id");
        $("#bon_commandeD_id").val(id);
        // console.log(id);
        chargerDetailBs(id);
        $("#modal_new_bon_commandedetail").modal("show");
      });

      $("#form_new_bonCommanDetails").on("submit", function (event) {
        event.preventDefault();

        $(".error_text").text("");
        let check = true;
        if ($("#quantiteD").val() == "") {
          check = false;
          $("#quantiteD").nextAll(".error_text").text("quantite vide");
        }
        if ($("#prixD").val() == "") {
          check = false;
          $("#prixD").nextAll(".error_text").text("prix vide");
        }
        // if ($("#article").val() == "") {
        //   check = false;
        //   $("#article").nextAll(".error_text").text("date de livraison vide");
        // }  
    
        if (check) {
        $.ajax({
          url: url_detail,
          method: "post",
          data: $("#form_new_bonCommanDetails").serialize(),
        }).then((response) => {
          if (response.message == "inserted") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Detail bien insere",
              showConfirmButton: false,
              timer: 1500
              })
            chargerDetailBs($('#bon_commandeD_id').val())
            $("#form_new_bonCommanDetails").trigger("reset");
          } else if (response.message== "erreur")
          {
            Swal.fire({
              text: "Article est deja existe dans la listes des details vou pouvez juste le modifier",
              icon: "error"
            });
            $("#form_new_bonSortDetails").trigger("reset");
          }else if(response.message == "priv_error"){
            window.location.href = bonCommande;
        }else{
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Une erreur s'est produite!",
              });
        }
        }).catch(((err)=>{
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Une erreur s'est produite!",
          });
        }))
      }
      });

      $('body').delegate('.btn_delete_detailC',"click", function(){
        const id = $(this).data("id");
        let url = url_delete_detail_bonC.replace("pid", id);
        let row = $(this)

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
                url:url,
                method:"DELETE",
            }).then((response) =>{
              if (response.message=="deleted"){
                swalWithBootstrapButtons.fire({
                    title: "Supprimé !",
                    text: "Detail bien supprime.",
                    icon: "success"
                });
                row.parents("tr").remove()
              }else if(response.message == "priv_error"){
                window.location.href = bonCommande;
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

      $('.btn_factureC').on("click", function(){
        const id = $(this).data("id");
        let url = facture_url.replace("pid", id);
        $.ajax({
          url:url,
          method:"post"
        }).then((response)=>{
          let html = "";
          $("#table_facture tbody").html(html);
         if(response.message == "priv_error"){
          window.location.href = bonCommande;
      }else{
          if(response.details != null){
            response.details.forEach((detail) =>{
              html+=`
              <tr> 
                <td> ${detail.article.nom}</td>
                <td> ${detail.prix} DH</td>
                <td> ${detail.quantite}</td>
                <td> <b>${(detail.prix * detail.quantite)} DH</b></td>
                <td> </td>
            </tr>
              `;
      });
            html+=`
            <tr class="nostriped"> 
            <td  colspan="3">Total HT</td>
            <td><b>${response.facture.totale} DH</b></td>
          </tr>
          <tr class="nostriped"> 
            <td colspan="3">TVA</td>
            <td><b>20%</b></td>
          </tr>
            <tr class="nostriped"> 
            <td colspan="3">Total TTC</td>
            <td><b>${(response.facture.totale * 0.20) + response.facture.totale} DH</b></td>
          </tr>`
          }
          $("#table_facture tbody").html(html);
          $('#modal_facture').modal("show");
        }
        }).catch((err)=>{
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Une erreur s'est produite!",
          });
        })
      })

      
  function getStyles() {
    var styles = '';
    var sheets = document.styleSheets;
    // return console.log(sheets)
    for (var i = 1; i < sheets.length; i++) {
        var rules = sheets[i].cssRules;
        if (rules) {
            for (var j = 0; j < rules.length; j++) {
                styles += rules[j].cssText + '\n';
            }
        }
    }
    return styles;
  }

  
  $('#btn_imprimer').on("click", function(){
    var printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Facture</title></head><body>');
    printWindow.document.write('<style>' + getStyles() + '</style>');
    printWindow.document.write('<div>' + $('#imprimer_facture').html() + '</div>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
    printWindow.close();
  })


    $("#table_bon_commande")
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
    .appendTo("#table_bon_commande_wrapper .col-md-6:eq(0)");

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