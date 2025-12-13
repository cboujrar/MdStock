$("document").ready(function(){
    $("#profil_update").on("submit", function(e){
        e.preventDefault();

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
        if ($("#password").val() == "") {
            check = false;
            $("#password").nextAll(".error_text").text("password vide");
        }
        if ($("#Npassword").val() == "") {
            check = false;
            $("#Npassword").nextAll(".error_text").text("password vide");
        }

        if (check) {
        $.ajax({
            url: update_profil,
            method:"post",
            data:$("#profil_update").serialize()
        }).then((response)=>{
             if(response.message=="error"){
                Swal.fire({
                    text: "Mot de passe incorrect",
                    icon: "error"
                  });
            }
            else if(response.message=="updated"){
                Swal.fire({
                position: "center",
                icon: "success",
                title: "vous avez bien modifiez votre informations",
                showConfirmButton: false,
                timer: 1500
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
    }
    })
})