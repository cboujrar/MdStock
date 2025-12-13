$("document").ready(function(){

    $('.btn_facture').on("click", function(){
        const id = $(this).data("id");
        let url = url_facture.replace("pid", id);
        $.ajax({
          url:url,
          method:"post"
        }).then((response)=>{
          console.log(response)
          let html = "";
          $("#table_facture_detail tbody").html(html);
        if(response.message == "priv_error"){
          window.location.href = facture;
      }else if(response.facture != null){
            response.details.forEach((detail) =>{
            html+=`
                    <tr> 
                      <td> ${detail.article.nom}</td>
                      <td> ${detail.article.prix}</td>
                      <td> ${detail.quantite}</td>
                      <td> <b> ${(detail.article.prix * detail.quantite)} DH </b></td>
                  </tr>
                    `;
            });
            html+=`
            <tr class="nostriped"> 
            <td  colspan="3">Total HT</td>
            <td> <b>${response.facture.totale} DH </b></td>
          </tr>
          <tr class="nostriped"> 
            <td colspan="3">TVA</td>
            <td><b>20%</b></td>
          </tr>
            <tr class="nostriped"> 
            <td colspan="3">Total TTC</td>
            <td><b>${(response.facture.totale * 0.20) + response.facture.totale} DH</b></td>
          </tr>`;
      
            /*html+=`
            <tr class="nostriped"> 
            <td  colspan="3">Total HT</td>
            <td>${response.facture.totale}</td>
          </tr>
          <tr class="nostriped"> 
            <td colspan="3">TVA</td>
            <td>20%</td>
          </tr>
            <tr class="nostriped"> 
            <td colspan="3">Total TTC</td>
            <td>${(response.facture.totale * 0.20) + response.facture.totale}</td>
          </tr>`*/
          }
          $("#table_facture_detail tbody").html(html);
          $('#modal_facture').modal("show");
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
    console.log(sheets.length)
    for (var i = 0; i < sheets.length; i++) {
        var rules = sheets[i].cssRules;
        if (rules) {
            for (var j = 0; j < rules.length; j++) {
              //console.log(rules[j])

                styles += rules[j].cssText + '\n';
            }
        }
    }
    return styles;
  }
/*
function getStyles2(element) {
    var styles = '';
    var sheets = document.styleSheets;

    // Iterate through all stylesheets
    for (var i = 0; i < sheets.length; i++) {
        var rules;
        try {
            rules = sheets[i].cssRules || sheets[i].rules; // For cross-browser compatibility
        } catch (e) {
            console.error('Access to stylesheet %o is restricted due to cross-origin rules', sheets[i]);
            continue;
        }

        // Iterate through all CSS rules
        if (rules) {
            for (var j = 0; j < rules.length; j++) {
                var rule = rules[j];
                if (rule.style && element.matches(rule.selectorText)) {
                    styles += rule.cssText + '\n';
                }
            }
        }
    }
    return styles;
}
  */
  $('body').delegate('#btn_imprimer',"click", function(){
    let mydiv = document.getElementById("imprimer_facture")
    /*var httpLinks = document.querySelectorAll('link[href^="http"]');
    // Loop through the selected elements
        console.log(httpLinks); // Output the href attribute value
    httpLinks.forEach(function(link) {
     let s = getStyles().replace("http","")
      console.log(link); // Output the href attribute value
      link.remove()
        console.log(link); // Output the href attribute value
    });
    //return 0;
    //console.log(getStyles2(mydiv))
    //console.log(getStyles())
    */
    var printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Facture</title></head><body>');
    printWindow.document.write('<style>' + getStyles() + '</style>');
    printWindow.document.write('<div>'+mydiv.innerHTML+'</div>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
    setTimeout(function(){

    printWindow.close();
    },10)
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
});