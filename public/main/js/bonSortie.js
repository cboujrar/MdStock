$("document").ready(function () {

  $("#btn_new_bon_sortie").on("click", function () {
    $("#modal_new_bon_sortie").modal("show");
  });

  $("#form_new_bon_sortie").on("submit", function (e) {
    e.preventDefault();


    $(".error_text").text("");
    let check = true;
    if ($("#observationBs").val() == "") {
      check = false;
      $("#observationBs").nextAll(".error_text").text("observation vide");
    }

    if (check) {
    $.ajax({
      url: url,
      method: "post",
      data: $("#form_new_bon_sortie").serialize(),
    }).then((response) => {
      if (response.message == "inserted"){
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Bon de Sortie bien insere",
          showConfirmButton: false,
          timer: 1500
          })
        }else if(response.message == "priv_error"){
          window.location.href = bonSortie;
      }else{
          Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Une erreur s'est produite!",
            });
      }
      $("#form_new_bon_sortie").trigger("reset");
    }).catch((err)=>{
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Une erreur s'est produite!",
      });
    })
  }
  });


  $(".list_bon_sortie").on("click", function () {
    const id = $(this).data("id");
    $("#bon_sortD_id").val(id);
    chargerDetailBs(id);
    // console.log("test");
    $("#modal_new_bon_sortiedetail").modal("show");
  });

  function chargerDetailBs(id) {
    // console.log("charger detail")
    let url = url_list_detail.replace("pid", id);
    // console.log(url)
    // console.log(id)
    $.ajax({
      url: url,
      method: "post",
    }).then((response) => {
      let html = "";
      // $("#table_list_detail tbody").html(html);
    if(response.message == "priv_error"){
      window.location.href = bonSortie;
  }else{
      response.detail.forEach((d) => {
        html+=`
                <tr> 
                  <td> ${d.quantite}</td>
                  <td> ${d.article.nom}</td>
                  <td> 

                    <button data-id="${d.id}" class="btn btn-danger btn_delete_detail" > <span><i class="fas fa-trash"></i> </span></button>
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

  $("#form_new_bonSortDetails").on("submit", function (event) {
    event.preventDefault();

    $(".error_text").text("");
    let check = true;
    if ($("#quantiteDbs").val() == "") {
      check = false;
      $("#quantiteDbs").nextAll(".error_text").text("quantite vide");
    }

    if (check) {
    $.ajax({
      url: url_detail,
      method: "post",
      data: $("#form_new_bonSortDetails").serialize(),
    }).then((response) => {
      if (response.message == "inserted") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Detail bien insere",
          showConfirmButton: false,
          timer: 1500
          })
        chargerDetailBs($('#bon_sortD_id').val())
        $("#form_new_bonSortDetails").trigger("reset");
      }
      else if (response.message== "erreur")
      {
        Swal.fire({
          text: "Article est deja existe dans la listes des details",
          icon: "error"
        });
        $("#form_new_bonSortDetails").trigger("reset");
      }else if (response.message== "quantite"){
        Swal.fire({
          text: "Il ya pas assez de quantite de ce article en stock",
          icon: "error"
        });
      }else if(response.message == "priv_error"){
        window.location.href = bonSortie;
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
  });

  $('.btn_delete_bon_sortie').on("click", function(){
    const id = $(this).data("id");
    console.log(id);
    let url = url_delete_bonS.replace("pid", id);
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
                text: "Bon sortie bien supprime.",
                icon: "success"
            });
                row.parents("tr").remove()
              }else if(response.message == "priv_error"){
                window.location.href = bonSortie;
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
  $('.btn_facture').on("click", function(){
    const id = $(this).data("id");
    let url = facture_url.replace("pid", id);
    $.ajax({
      url:url,
      method:"post"
    }).then((response)=>{
      let html = "";
      $("#table_facture tbody").html(html);
    if(response.message == "priv_error"){
      window.location.href = bonSortie;
  }else{
      if(response.details != null){
        response.details.forEach((detail) =>{
        html+=`
                <tr> 
                  <td> ${detail.article.nom}</td>
                  <td> ${detail.article.prix} DH</td>
                  <td> ${detail.quantite}</td>
                  <td> <b>${(detail.article.prix * detail.quantite)} DH</b></td>
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

  $('body').delegate('.btn_delete_detail',"click", function(){
    const id = $(this).data("id");
    let url = url_delete_detail_bonS.replace("pid", id);
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
                text: "Details bien supprime.",
                icon: "success"
            });
                row.parents("tr").remove()
              }else if(response.message == "priv_error"){
                window.location.href = bonSortie;
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

  $('.btn_update_bon_sort').on("click", function(){
    const id = $(this).data("id");
    // console.log(id);
    $('#bon_sort_id').val(id);
    $.ajax({
        url:url_info,
        method:"post",
        data:$('#form_update_bon_sortie').serialize()
    }).then((response)=>{
        $('#observation').val(response.bonSort.observation);
        $('#eMethodeP').val(response.bonSort.Facture.modePaiment.id);
        $('#modal_update_bon_sortie').modal("show");
    }).catch((err)=>{
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Une erreur s'est produite!",
      });
    })
})

$('#form_update_bon_sortie').on("submit", function(event){
    event.preventDefault();

    $(".error_text").text("");
    let check = true;
    if ($("#observation").val() == "") {
      check = false;
      $("#observation").nextAll(".error_text").text("observation vide");
    }

    if (check) {
    $.ajax({
        url:url_update,
        method:"post",
        data:$('#form_update_bon_sortie').serialize()
    }).then((response)=>{
        if(response.message=="updated"){
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Bon sortie bien modife",
            showConfirmButton: false,
            timer: 1500
            });
            $('#modal_update_bon_sortie').modal("toggle");
          }else if(response.message == "priv_error"){
            window.location.href = bonSortie;
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

  
  $("#table_bon_sortie")
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
    .appendTo("#table_bon_sortie_wrapper .col-md-6:eq(0)");


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

});
