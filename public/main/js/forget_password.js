$("document").ready(function(){
    $("#forget_password").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            url:url,
            method:"post",
            data:$("#forget_password").serialize()
        }).then((response)=>{
            if(response.message == "email error"){
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Email incorrect",
                      });
                }else if(response.message == "error"){
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Vous avez pas le droit",
                      });
                }else if(response.message == "done"){
                    // $.ajax({
                    //     url:url_email,
                    //     method:"get",
                    //     data:{password:response.password, email:response.email}
                    // }).then((res)=>{
                    //     if(res.message =="done"){
                    //         Swal.fire({
                    //             position: "center",
                    //             icon: "success",
                    //             title: "Votre nouveau mot de passe a été envoyé à votre adresse email. Veuillez vérifier votre boîte de réception (et votre dossier de courriers indésirables) pour retrouver votre nouveau mot de passe. Si vous ne recevez pas l'email dans quelques minutes, veuillez réessayer ou contacter notre support pour assistance.",
                    //             showConfirmButton: true,
                    //             })
                    //     }
                    // })
                    Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "votre lien de recuperation de mot de passe a ete envoyer a votre email",
                                    showConfirmButton: true,
                                    })
                }else if(response.message== "probleme_email"){
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
                // console.log("tessssst");
        }).catch((err)=>{
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: err,
              });
            // console.log(err);
        })
    })
    $("#form_changer_password").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            url:url_changer,
            method:"post",
            data:$("#form_changer_password").serialize()
        }).then((response)=>{
            if(response.message == "done")
                window.location.href = login;
            else if(response.message == "email_incorrect"){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Email incorrect",
                  });
            }else if(response.message == "code_invalid"){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Vous pouvez pas utiliser se lien pour une deuxième fois.",
                  });
            }else if(response.message == "password_incorrect"){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Le mot de passe et le mot de passe de confirmation ne correspondent pas",
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
                text: err,
              });
            // console.log(err);
        })
    })
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