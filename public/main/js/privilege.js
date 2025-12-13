$("document").ready(function(){
    $("#btn_new_privilege").on("click", function(){
        $("#modal_new_privilege").modal("show");
    })
    $("#form_new_privilege").on("submit", function(e){
      e.preventDefault();
      $.ajax({
        url : url_privU,
        method:"post",
        data:$("#form_new_privilege").serialize()
      }).then((response) =>{
        // console.log(response.message);
        if(response.message == "inserted"){
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Privilèges bien ajoutés",
            showConfirmButton: false,
            timer: 1500
            });
            $('#form_new_privilege').trigger("reset");
            $('#modal_new_privilege').modal("toggle");
            $("#listPrivUser").html("");
        }else{
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Une erreur s'est produite!",
          });
        }
      }).catch((err) =>{
        // console.log(err);
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Une erreur s'est produite!",
        });
      })
    })

    $("#userPrivAddBtn").on("change", function(){
      let userId = $(this).val();
      // console.log("tesst");
      $.ajax({
        url: url_getPriv,
        method:"post",
        data:{userId:userId}
      }).then((response)=>{
        let html=` 
        <div class="col-12">
          <input type="checkbox" id="selectAll">
          <label>Selectionner tout</label>
        </div>`;
        $("#listPrivUser").html(html);
        let privsUser = response.privUser.map(privUser => privUser.idPriv.id);
        // console.log(privsUser);
          response.privileges.forEach(element => {
            let checked=``;
            if (privsUser.includes(element.id)){
              // console.log("tesst");
              checked = "checked"
            }
            html+=`
            <div class="col-6">
              <input type="checkbox" value=${element.id}" name="privid[]" ${checked}>
              <label> ${element.titre}</label>
            </div>
          `
          });
          $("#listPrivUser").html(html);
          $("#selectAll").on("change", function() {
            // console.log("test");
            $("input[name='privid[]']").prop('checked', this.checked);
          });
      }).catch((err)=>{
        // console.log(err);
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Une erreur s'est produite!",
        });
      })
    })
    $(".priv").on("click",function(){
      const id = $(this).data("id");
      let html= ``;
      $.ajax({
        url: url_privUser_infos,
        method:"post",
        data:{privId:id}
      }).then((response)=>{
        let users = response.privUsers.map(privUsers => privUsers.idUtilisateur);
        // console.log(users);
        users.forEach(element =>{
          html+=`
          <tr>
          <td> ${element.nom} </td>
          </tr>
          `
        });
        $("#table_privilege_utilisateur tbody").html(html);
      }).catch((err) =>{
         // console.log(err);
         Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Une erreur s'est produite!",
        });
      })
      $("#modal_privilege_infos").modal("show");
    })

    $("#table_privilege")
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
    .appendTo("#table_privilege_wrapper .col-md-6:eq(0)");

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