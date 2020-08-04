const inputs = document.querySelectorAll(".input");


function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

$(document).ready(function(){
  $('#li1').click(function() {
    $('#registerForm').addClass("Active")
    $('#registerForm1').removeClass("Active")
    $('#li1').addClass("menu-active")
    $('#li2').removeClass("menu-active")
  });
  $('#li2').click(function() {
    $('#registerForm1').addClass("Active")
    $('#registerForm').removeClass("Active")
    $('#li2').addClass("menu-active")
    $('#li1').removeClass("menu-active")
  });


  $('#parteDiaDia').click(function() {
    console.log("pau1");

    $('#looksDiaDia').addClass("Acc1")
    $('#theRealLook2').removeClass("Acc1")
    $('#looksFesta').removeClass("Acc1")
    $('#looksFormal').removeClass("Acc1")
    $('#looksDesporto').removeClass("Acc1")
  });
  $('#parteFesta').click(function() {
    console.log("pau2");
    $('#looksFesta').addClass("Acc1")
    $('#theRealLook2').removeClass("Acc1")
    $('#looksDiaDia').removeClass("Acc1")
    $('#looksFormal').removeClass("Acc1")
    $('#looksDesporto').removeClass("Acc1")
  });
  $('#parteFormal').click(function() {
    console.log("pau3");
    $('#looksFormal').addClass("Acc1")
    $('#theRealLook2').removeClass("Acc1")
    $('#looksDiaDia').removeClass("Acc1")
    $('#looksFesta').removeClass("Acc1")
    $('#looksDesporto').removeClass("Acc1")
  });
  $('#parteDesporto').click(function() {
    console.log("pau4");
    $('#looksDesporto').addClass("Acc1")
    $('#theRealLook2').removeClass("Acc1")
    $('#looksDiaDia').removeClass("Acc1")
    $('#looksFesta').removeClass("Acc1")
    $('#looksFormal').removeClass("Acc1")
  });
  $('.parteVoltarI').click(function() {
    $('#theRealLook2').addClass("Acc1")
    $('#looksDiaDia').removeClass("Acc1")
    $('#looksFesta').removeClass("Acc1")
    $('#looksFormal').removeClass("Acc1")
    $('#looksDesporto').removeClass("Acc1")
  });

  $("#click1").click(function(){
      $('#div01').css("display", "block");
      $('#div02').css("display", "none");
      $('#div03').css("display", "none");
      $('#div04').css("display", "none");
      $('#div05').css("display", "none");
      $('#div06').css("display", "none");
      $('#div07').css("display", "none");
      $('#div08').css("display", "none");
      $('#div09').css("display", "none");
      $('#div010').css("display", "none");
      $('#div011').css("display", "none");
      $('#div012').css("display", "none");
      $('#div025').css("display", "none");
      $('#div1').addClass("active");
      $('#div2').removeClass("active");
      $('#div3').removeClass("active");
      $('#div4').removeClass("active");
      $('#div5').removeClass("active");
      $('#div6').removeClass("active");
      $('#div7').removeClass("active");
      $('#div8').removeClass("active");
      $('#div9').removeClass("active");
      $('#div10').removeClass("active");
      $('#div11').removeClass("active");
      $('#div12').removeClass("active");
      $('#div12').removeClass("active");
      $('#div25').removeClass("active");
  });

  $("#click2").click(function(){
      $('#div02').css("display", "block");
      $('#div01').css("display", "none");
      $('#div03').css("display", "none");
      $('#div04').css("display", "none");
      $('#div05').css("display", "none");
      $('#div06').css("display", "none");
      $('#div07').css("display", "none");
      $('#div08').css("display", "none");
      $('#div09').css("display", "none");
      $('#div010').css("display", "none");
      $('#div011').css("display", "none");
      $('#div012').css("display", "none");
      $('#div025').css("display", "none");
      $('#div2').addClass("active");
      $('#div1').removeClass("active");
      $('#div3').removeClass("active");
      $('#div4').removeClass("active");
      $('#div5').removeClass("active");
      $('#div6').removeClass("active");
      $('#div7').removeClass("active");
      $('#div8').removeClass("active");
      $('#div9').removeClass("active");
      $('#div10').removeClass("active");
      $('#div11').removeClass("active");
      $('#div12').removeClass("active");
      $('#div25').removeClass("active");

  });

  $("#click3").click(function(){
      $('#div03').css("display", "block");
      $('#div02').css("display", "none");
      $('#div01').css("display", "none");
      $('#div04').css("display", "none");
      $('#div05').css("display", "none");
      $('#div06').css("display", "none");
      $('#div07').css("display", "none");
      $('#div08').css("display", "none");
      $('#div09').css("display", "none");
      $('#div010').css("display", "none");
      $('#div011').css("display", "none");
      $('#div012').css("display", "none");
      $('#div025').css("display", "none");
      $('#div3').addClass("active");
      $('#div2').removeClass("active");
      $('#div1').removeClass("active");
      $('#div4').removeClass("active");
      $('#div5').removeClass("active");
      $('#div6').removeClass("active");
      $('#div7').removeClass("active");
      $('#div8').removeClass("active");
      $('#div9').removeClass("active");
      $('#div10').removeClass("active");
      $('#div11').removeClass("active");
      $('#div12').removeClass("active");
      $('#div25').removeClass("active");

  });
    $("#click4").click(function(){
      $('#div04').css("display", "block");
      $('#div02').css("display", "none");
      $('#div03').css("display", "none");
      $('#div01').css("display", "none");
      $('#div05').css("display", "none");
      $('#div06').css("display", "none");
      $('#div07').css("display", "none");
      $('#div08').css("display", "none");
      $('#div09').css("display", "none");
      $('#div010').css("display", "none");
      $('#div011').css("display", "none");
      $('#div012').css("display", "none");
      $('#div025').css("display", "none");
      $('#div4').addClass("active");
      $('#div2').removeClass("active");
      $('#div3').removeClass("active");
      $('#div1').removeClass("active");
      $('#div5').removeClass("active");
      $('#div6').removeClass("active");
      $('#div7').removeClass("active");
      $('#div8').removeClass("active");
      $('#div9').removeClass("active");
      $('#div10').removeClass("active");
      $('#div11').removeClass("active");
      $('#div12').removeClass("active");
      $('#div25').removeClass("active");

    });
    $("#click5").click(function(){
      $('#div05').css("display", "block");
      $('#div02').css("display", "none");
      $('#div03').css("display", "none");
      $('#div04').css("display", "none");
      $('#div01').css("display", "none");
      $('#div06').css("display", "none");
      $('#div07').css("display", "none");
      $('#div08').css("display", "none");
      $('#div09').css("display", "none");
      $('#div010').css("display", "none");
      $('#div011').css("display", "none");
      $('#div012').css("display", "none");
      $('#div025').css("display", "none");
      $('#div5').addClass("active");
      $('#div2').removeClass("active");
      $('#div3').removeClass("active");
      $('#div4').removeClass("active");
      $('#div1').removeClass("active");
      $('#div6').removeClass("active");
      $('#div7').removeClass("active");
      $('#div8').removeClass("active");
      $('#div9').removeClass("active");
      $('#div10').removeClass("active");
      $('#div11').removeClass("active");
      $('#div12').removeClass("active");
      $('#div25').removeClass("active");

    });
    $("#click6").click(function(){
      $('#div06').css("display", "block");
      $('#div02').css("display", "none");
      $('#div03').css("display", "none");
      $('#div04').css("display", "none");
      $('#div05').css("display", "none");
      $('#div01').css("display", "none");
      $('#div07').css("display", "none");
      $('#div08').css("display", "none");
      $('#div09').css("display", "none");
      $('#div010').css("display", "none");
      $('#div011').css("display", "none");
      $('#div012').css("display", "none");
      $('#div025').css("display", "none");
      $('#div6').addClass("active");
      $('#div2').removeClass("active");
      $('#div3').removeClass("active");
      $('#div4').removeClass("active");
      $('#div5').removeClass("active");
      $('#div1').removeClass("active");
      $('#div7').removeClass("active");
      $('#div8').removeClass("active");
      $('#div9').removeClass("active");
      $('#div10').removeClass("active");
      $('#div11').removeClass("active");
      $('#div12').removeClass("active");
      $('#div25').removeClass("active");

    });

    $("#click7").click(function(){
      $('#div07').css("display", "block");
      $('#div02').css("display", "none");
      $('#div03').css("display", "none");
      $('#div04').css("display", "none");
      $('#div05').css("display", "none");
      $('#div06').css("display", "none");
      $('#div01').css("display", "none");
      $('#div08').css("display", "none");
      $('#div09').css("display", "none");
      $('#div010').css("display", "none");
      $('#div011').css("display", "none");
      $('#div012').css("display", "none");
      $('#div025').css("display", "none");
      $('#div7').addClass("active");
      $('#div2').removeClass("active");
      $('#div3').removeClass("active");
      $('#div4').removeClass("active");
      $('#div5').removeClass("active");
      $('#div6').removeClass("active");
      $('#div1').removeClass("active");
      $('#div8').removeClass("active");
      $('#div9').removeClass("active");
      $('#div10').removeClass("active");
      $('#div11').removeClass("active");
      $('#div12').removeClass("active");
      $('#div25').removeClass("active");

    });
    $("#click8").click(function(){
      $('#div08').css("display", "block");
      $('#div02').css("display", "none");
      $('#div03').css("display", "none");
      $('#div04').css("display", "none");
      $('#div05').css("display", "none");
      $('#div06').css("display", "none");
      $('#div07').css("display", "none");
      $('#div01').css("display", "none");
      $('#div09').css("display", "none");
      $('#div010').css("display", "none");
      $('#div011').css("display", "none");
      $('#div012').css("display", "none");
      $('#div025').css("display", "none");
      $('#div8').addClass("active");
      $('#div2').removeClass("active");
      $('#div3').removeClass("active");
      $('#div4').removeClass("active");
      $('#div5').removeClass("active");
      $('#div6').removeClass("active");
      $('#div7').removeClass("active");
      $('#div1').removeClass("active");
      $('#div9').removeClass("active");
      $('#div10').removeClass("active");
      $('#div11').removeClass("active");
      $('#div12').removeClass("active");
      $('#div25').removeClass("active");

    });
    $("#click9").click(function(){
      $('#div09').css("display", "block");
      $('#div02').css("display", "none");
      $('#div03').css("display", "none");
      $('#div04').css("display", "none");
      $('#div05').css("display", "none");
      $('#div06').css("display", "none");
      $('#div07').css("display", "none");
      $('#div08').css("display", "none");
      $('#div01').css("display", "none");
      $('#div010').css("display", "none");
      $('#div011').css("display", "none");
      $('#div012').css("display", "none");
      $('#div025').css("display", "none");
      $('#div9').addClass("active");
      $('#div2').removeClass("active");
      $('#div3').removeClass("active");
      $('#div4').removeClass("active");
      $('#div5').removeClass("active");
      $('#div6').removeClass("active");
      $('#div7').removeClass("active");
      $('#div8').removeClass("active");
      $('#div1').removeClass("active");
      $('#div10').removeClass("active");
      $('#div11').removeClass("active");
      $('#div12').removeClass("active");
      $('#div25').removeClass("active");

    });
    $("#click10").click(function(){
      $('#div010').css("display", "block");
      $('#div02').css("display", "none");
      $('#div03').css("display", "none");
      $('#div04').css("display", "none");
      $('#div05').css("display", "none");
      $('#div06').css("display", "none");
      $('#div07').css("display", "none");
      $('#div08').css("display", "none");
      $('#div09').css("display", "none");
      $('#div01').css("display", "none");
      $('#div011').css("display", "none");
      $('#div012').css("display", "none");
      $('#div025').css("display", "none");
      $('#div10').addClass("active");
      $('#div2').removeClass("active");
      $('#div3').removeClass("active");
      $('#div4').removeClass("active");
      $('#div5').removeClass("active");
      $('#div6').removeClass("active");
      $('#div7').removeClass("active");
      $('#div8').removeClass("active");
      $('#div9').removeClass("active");
      $('#div1').removeClass("active");
      $('#div11').removeClass("active");
      $('#div12').removeClass("active");
      $('#div25').removeClass("active");

    });

    $("#click11").click(function(){
      $('#div011').css("display", "block");
      $('#div02').css("display", "none");
      $('#div03').css("display", "none");
      $('#div04').css("display", "none");
      $('#div05').css("display", "none");
      $('#div06').css("display", "none");
      $('#div07').css("display", "none");
      $('#div08').css("display", "none");
      $('#div09').css("display", "none");
      $('#div010').css("display", "none");
      $('#div01').css("display", "none");
      $('#div012').css("display", "none");
      $('#div025').css("display", "none");
      $('#div11').addClass("active");
      $('#div2').removeClass("active");
      $('#div3').removeClass("active");
      $('#div4').removeClass("active");
      $('#div5').removeClass("active");
      $('#div6').removeClass("active");
      $('#div7').removeClass("active");
      $('#div8').removeClass("active");
      $('#div9').removeClass("active");
      $('#div10').removeClass("active");
      $('#div1').removeClass("active");
      $('#div12').removeClass("active");º
      $('#div25').removeClass("active");

    });
    $("#click12").click(function(){
      $('#div012').css("display", "block");
      $('#div02').css("display", "none");
      $('#div03').css("display", "none");
      $('#div04').css("display", "none");
      $('#div05').css("display", "none");
      $('#div06').css("display", "none");
      $('#div07').css("display", "none");
      $('#div08').css("display", "none");
      $('#div09').css("display", "none");
      $('#div010').css("display", "none");
      $('#div011').css("display", "none");
      $('#div01').css("display", "none");
      $('#div025').css("display", "none");
      $('#div12').addClass("active");
      $('#div2').removeClass("active");
      $('#div3').removeClass("active");
      $('#div4').removeClass("active");
      $('#div5').removeClass("active");
      $('#div6').removeClass("active");
      $('#div7').removeClass("active");
      $('#div8').removeClass("active");
      $('#div9').removeClass("active");
      $('#div10').removeClass("active");
      $('#div11').removeClass("active");
      $('#div1').removeClass("active");
      $('#div25').removeClass("active");

    });

    $("#click25").click(function(){
      $('#div025').css("display", "block");
      $('#div02').css("display", "none");
      $('#div03').css("display", "none");
      $('#div04').css("display", "none");
      $('#div05').css("display", "none");
      $('#div06').css("display", "none");
      $('#div07').css("display", "none");
      $('#div08').css("display", "none");
      $('#div09').css("display", "none");
      $('#div010').css("display", "none");
      $('#div011').css("display", "none");
      $('#div01').css("display", "none");
      $('#div012').css("display", "none");
      $('#div25').addClass("active");
      $('#div2').removeClass("active");
      $('#div3').removeClass("active");
      $('#div4').removeClass("active");
      $('#div5').removeClass("active");
      $('#div6').removeClass("active");
      $('#div7').removeClass("active");
      $('#div8').removeClass("active");
      $('#div9').removeClass("active");
      $('#div10').removeClass("active");
      $('#div11').removeClass("active");
      $('#div1').removeClass("active");
      $('#div12').removeClass("active");

    });
    $("#click13").click(function(){
      $('#div013').css("display", "block");
      $('#div014').css("display", "none");
      $('#div015').css("display", "none");
      $('#div016').css("display", "none");
      $('#div017').css("display", "none");
      $('#div018').css("display", "none");
      $('#div019').css("display", "none");
      $('#div020').css("display", "none");
      $('#div021').css("display", "none");
      $('#div022').css("display", "none");
      $('#div023').css("display", "none");
      $('#div024').css("display", "none");
      $('#div026').css("display", "none");
      $('#div13').addClass("active");
      $('#div14').removeClass("active");
      $('#div15').removeClass("active");
      $('#div16').removeClass("active");
      $('#div17').removeClass("active");
      $('#div18').removeClass("active");
      $('#div19').removeClass("active");
      $('#div20').removeClass("active");
      $('#div21').removeClass("active");
      $('#div22').removeClass("active");
      $('#div23').removeClass("active");
      $('#div24').removeClass("active");
      $('#div26').removeClass("active");
    });

    $("#click14").click(function(){
      $('#div014').css("display", "block");
      $('#div013').css("display", "none");
      $('#div015').css("display", "none");
      $('#div016').css("display", "none");
      $('#div017').css("display", "none");
      $('#div018').css("display", "none");
      $('#div019').css("display", "none");
      $('#div020').css("display", "none");
      $('#div021').css("display", "none");
      $('#div022').css("display", "none");
      $('#div023').css("display", "none");
      $('#div024').css("display", "none");
      $('#div026').css("display", "none");
      $('#div14').addClass("active");
      $('#div13').removeClass("active");
      $('#div15').removeClass("active");
      $('#div16').removeClass("active");
      $('#div17').removeClass("active");
      $('#div18').removeClass("active");
      $('#div19').removeClass("active");
      $('#div20').removeClass("active");
      $('#div21').removeClass("active");
      $('#div22').removeClass("active");
      $('#div23').removeClass("active");
      $('#div24').removeClass("active");
      $('#div26').removeClass("active");
  });

  $("#click15").click(function(){
    $('#div015').css("display", "block");
    $('#div014').css("display", "none");
    $('#div013').css("display", "none");
    $('#div016').css("display", "none");
    $('#div017').css("display", "none");
    $('#div018').css("display", "none");
    $('#div019').css("display", "none");
    $('#div020').css("display", "none");
    $('#div021').css("display", "none");
    $('#div022').css("display", "none");
    $('#div023').css("display", "none");
    $('#div024').css("display", "none");
    $('#div026').css("display", "none");
    $('#div15').addClass("active");
    $('#div14').removeClass("active");
    $('#div13').removeClass("active");
    $('#div16').removeClass("active");
    $('#div17').removeClass("active");
    $('#div18').removeClass("active");
    $('#div19').removeClass("active");
    $('#div20').removeClass("active");
    $('#div21').removeClass("active");
    $('#div22').removeClass("active");
    $('#div23').removeClass("active");
    $('#div24').removeClass("active");
    $('#div26').removeClass("active");
});

$("#click16").click(function(){
  $('#div016').css("display", "block");
  $('#div014').css("display", "none");
  $('#div015').css("display", "none");
  $('#div013').css("display", "none");
  $('#div017').css("display", "none");
  $('#div018').css("display", "none");
  $('#div019').css("display", "none");
  $('#div020').css("display", "none");
  $('#div021').css("display", "none");
  $('#div022').css("display", "none");
  $('#div023').css("display", "none");
  $('#div024').css("display", "none");
  $('#div026').css("display", "none");
  $('#div16').addClass("active");
  $('#div14').removeClass("active");
  $('#div15').removeClass("active");
  $('#div13').removeClass("active");
  $('#div17').removeClass("active");
  $('#div18').removeClass("active");
  $('#div19').removeClass("active");
  $('#div20').removeClass("active");
  $('#div21').removeClass("active");
  $('#div22').removeClass("active");
  $('#div23').removeClass("active");
  $('#div24').removeClass("active");
  $('#div26').removeClass("active");
});
$("#click17").click(function(){
  $('#div017').css("display", "block");
  $('#div014').css("display", "none");
  $('#div015').css("display", "none");
  $('#div016').css("display", "none");
  $('#div013').css("display", "none");
  $('#div018').css("display", "none");
  $('#div019').css("display", "none");
  $('#div020').css("display", "none");
  $('#div021').css("display", "none");
  $('#div022').css("display", "none");
  $('#div023').css("display", "none");
  $('#div024').css("display", "none");
  $('#div026').css("display", "none");
  $('#div17').addClass("active");
  $('#div14').removeClass("active");
  $('#div15').removeClass("active");
  $('#div16').removeClass("active");
  $('#div13').removeClass("active");
  $('#div18').removeClass("active");
  $('#div19').removeClass("active");
  $('#div20').removeClass("active");
  $('#div21').removeClass("active");
  $('#div22').removeClass("active");
  $('#div23').removeClass("active");
  $('#div24').removeClass("active");
  $('#div26').removeClass("active");
});
$("#click18").click(function(){
  $('#div018').css("display", "block");
  $('#div014').css("display", "none");
  $('#div015').css("display", "none");
  $('#div016').css("display", "none");
  $('#div017').css("display", "none");
  $('#div013').css("display", "none");
  $('#div019').css("display", "none");
  $('#div020').css("display", "none");
  $('#div021').css("display", "none");
  $('#div022').css("display", "none");
  $('#div023').css("display", "none");
  $('#div024').css("display", "none");
  $('#div026').css("display", "none");
  $('#div18').addClass("active");
  $('#div14').removeClass("active");
  $('#div15').removeClass("active");
  $('#div16').removeClass("active");
  $('#div17').removeClass("active");
  $('#div13').removeClass("active");
  $('#div19').removeClass("active");
  $('#div20').removeClass("active");
  $('#div21').removeClass("active");
  $('#div22').removeClass("active");
  $('#div23').removeClass("active");
  $('#div24').removeClass("active");
  $('#div26').removeClass("active");
});
$("#click19").click(function(){
  $('#div019').css("display", "block");
  $('#div014').css("display", "none");
  $('#div015').css("display", "none");
  $('#div016').css("display", "none");
  $('#div017').css("display", "none");
  $('#div018').css("display", "none");
  $('#div013').css("display", "none");
  $('#div020').css("display", "none");
  $('#div021').css("display", "none");
  $('#div022').css("display", "none");
  $('#div023').css("display", "none");
  $('#div024').css("display", "none");
  $('#div026').css("display", "none");
  $('#div19').addClass("active");
  $('#div14').removeClass("active");
  $('#div15').removeClass("active");
  $('#div16').removeClass("active");
  $('#div17').removeClass("active");
  $('#div18').removeClass("active");
  $('#div13').removeClass("active");
  $('#div20').removeClass("active");
  $('#div21').removeClass("active");
  $('#div22').removeClass("active");
  $('#div23').removeClass("active");
  $('#div24').removeClass("active");
  $('#div26').removeClass("active");
});
$("#click20").click(function(){
  $('#div020').css("display", "block");
  $('#div014').css("display", "none");
  $('#div015').css("display", "none");
  $('#div016').css("display", "none");
  $('#div017').css("display", "none");
  $('#div018').css("display", "none");
  $('#div019').css("display", "none");
  $('#div013').css("display", "none");
  $('#div021').css("display", "none");
  $('#div022').css("display", "none");
  $('#div023').css("display", "none");
  $('#div024').css("display", "none");
  $('#div026').css("display", "none");
  $('#div20').addClass("active");
  $('#div14').removeClass("active");
  $('#div15').removeClass("active");
  $('#div16').removeClass("active");
  $('#div17').removeClass("active");
  $('#div18').removeClass("active");
  $('#div19').removeClass("active");
  $('#div13').removeClass("active");
  $('#div21').removeClass("active");
  $('#div22').removeClass("active");
  $('#div23').removeClass("active");
  $('#div24').removeClass("active");
  $('#div26').removeClass("active");
});
$("#click21").click(function(){
  $('#div021').css("display", "block");
  $('#div014').css("display", "none");
  $('#div015').css("display", "none");
  $('#div016').css("display", "none");
  $('#div017').css("display", "none");
  $('#div018').css("display", "none");
  $('#div019').css("display", "none");
  $('#div020').css("display", "none");
  $('#div013').css("display", "none");
  $('#div022').css("display", "none");
  $('#div023').css("display", "none");
  $('#div024').css("display", "none");
  $('#div026').css("display", "none");
  $('#div21').addClass("active");
  $('#div14').removeClass("active");
  $('#div15').removeClass("active");
  $('#div16').removeClass("active");
  $('#div17').removeClass("active");
  $('#div18').removeClass("active");
  $('#div19').removeClass("active");
  $('#div20').removeClass("active");
  $('#div13').removeClass("active");
  $('#div22').removeClass("active");
  $('#div23').removeClass("active");
  $('#div24').removeClass("active");
  $('#div26').removeClass("active");
});
$("#click22").click(function(){
  $('#div022').css("display", "block");
  $('#div014').css("display", "none");
  $('#div015').css("display", "none");
  $('#div016').css("display", "none");
  $('#div017').css("display", "none");
  $('#div018').css("display", "none");
  $('#div019').css("display", "none");
  $('#div020').css("display", "none");
  $('#div021').css("display", "none");
  $('#div013').css("display", "none");
  $('#div023').css("display", "none");
  $('#div024').css("display", "none");
  $('#div026').css("display", "none");
  $('#div22').addClass("active");
  $('#div14').removeClass("active");
  $('#div15').removeClass("active");
  $('#div16').removeClass("active");
  $('#div17').removeClass("active");
  $('#div18').removeClass("active");
  $('#div19').removeClass("active");
  $('#div20').removeClass("active");
  $('#div21').removeClass("active");
  $('#div13').removeClass("active");
  $('#div23').removeClass("active");
  $('#div24').removeClass("active");
  $('#div26').removeClass("active");
});
$("#click23").click(function(){
  $('#div023').css("display", "block");
  $('#div014').css("display", "none");
  $('#div015').css("display", "none");
  $('#div016').css("display", "none");
  $('#div017').css("display", "none");
  $('#div018').css("display", "none");
  $('#div019').css("display", "none");
  $('#div020').css("display", "none");
  $('#div021').css("display", "none");
  $('#div022').css("display", "none");
  $('#div013').css("display", "none");
  $('#div024').css("display", "none");
  $('#div026').css("display", "none");
  $('#div23').addClass("active");
  $('#div14').removeClass("active");
  $('#div15').removeClass("active");
  $('#div16').removeClass("active");
  $('#div17').removeClass("active");
  $('#div18').removeClass("active");
  $('#div19').removeClass("active");
  $('#div20').removeClass("active");
  $('#div21').removeClass("active");
  $('#div22').removeClass("active");
  $('#div13').removeClass("active");
  $('#div24').removeClass("active");
  $('#div26').removeClass("active");
});
$("#click24").click(function(){
  $('#div024').css("display", "block");
  $('#div014').css("display", "none");
  $('#div015').css("display", "none");
  $('#div016').css("display", "none");
  $('#div017').css("display", "none");
  $('#div018').css("display", "none");
  $('#div019').css("display", "none");
  $('#div020').css("display", "none");
  $('#div021').css("display", "none");
  $('#div022').css("display", "none");
  $('#div023').css("display", "none");
  $('#div013').css("display", "none");
  $('#div026').css("display", "none");
  $('#div24').addClass("active");
  $('#div14').removeClass("active");
  $('#div15').removeClass("active");
  $('#div16').removeClass("active");
  $('#div17').removeClass("active");
  $('#div18').removeClass("active");
  $('#div19').removeClass("active");
  $('#div20').removeClass("active");
  $('#div21').removeClass("active");
  $('#div22').removeClass("active");
  $('#div23').removeClass("active");
  $('#div13').removeClass("active");
  $('#div26').removeClass("active");
});

$("#click26").click(function(){
  $('#div026').css("display", "block");
  $('#div014').css("display", "none");
  $('#div015').css("display", "none");
  $('#div016').css("display", "none");
  $('#div017').css("display", "none");
  $('#div018').css("display", "none");
  $('#div019').css("display", "none");
  $('#div020').css("display", "none");
  $('#div021').css("display", "none");
  $('#div022').css("display", "none");
  $('#div023').css("display", "none");
  $('#div013').css("display", "none");
  $('#div024').css("display", "none");
  $('#div26').addClass("active");
  $('#div14').removeClass("active");
  $('#div15').removeClass("active");
  $('#div16').removeClass("active");
  $('#div17').removeClass("active");
  $('#div18').removeClass("active");
  $('#div19').removeClass("active");
  $('#div20').removeClass("active");
  $('#div21').removeClass("active");
  $('#div22').removeClass("active");
  $('#div23').removeClass("active");
  $('#div13').removeClass("active");
  $('#div24').removeClass("active");
});


    sessionStorage.setItem('valueLook', 0);
    $('#npecas').on('change', function() {
      if ( $('#npecas').val() == '3pecas'){
        var valueLook = 3;
        sessionStorage.setItem('valueLook', valueLook);
        $("#div3images").css("display","block");
        $("#div4images").css("display","none");
        $("#div5images").css("display","none");
        $("#div6images").css("display","none");
        var valueLook = window.sessionStorage.getItem("valueLook");
        $.ajax({
           url: 'mycloset.php',
           data: {valueLook: valueLook},
           type: 'POST'
        });
      }
      else if ( $('#npecas').val() == '4pecas'){
        var valueLook = 4;
        sessionStorage.setItem('valueLook', valueLook);
        $("#div3images").css("display","none");
        $("#div4images").css("display","block");
        $("#div5images").css("display","none");
        $("#div6images").css("display","none");
        var valueLook = window.sessionStorage.getItem("valueLook");
        $.ajax({
           url: 'mycloset.php',
           data: {valueLook: valueLook},
           type: 'POST'
        });
      }
      else if ( $('#npecas').val() == '5pecas')
      {
        var valueLook = 5;
        sessionStorage.setItem('valueLook', valueLook);
        $("#div3images").css("display","none");
        $("#div4images").css("display","none");
        $("#div5images").css("display","block");
        $("#div6images").css("display","none");
        var valueLook = window.sessionStorage.getItem("valueLook");
        $.ajax({
           url: 'mycloset.php',
           data: {valueLook: valueLook},
           type: 'POST'
        });
      }
      else
      {
        var valueLook = 6;
        sessionStorage.setItem('valueLook', valueLook);
        $("#div3images").css("display","none");
        $("#div4images").css("display","none");
        $("#div5images").css("display","none");
        $("#div6images").css("display","block");
        var valueLook = window.sessionStorage.getItem("valueLook");
        $.ajax({
           url: 'mycloset.php',
           data: {valueLook: valueLook},
           type: 'POST'
        });
      }
    });




    $("#option0").click(function(){
      $('#option00').css("display", "block");
      $('#option01').css("display", "none");
      $('#option02').css("display", "none");
      $('#option03').css("display", "none");
      $('#option04').css("display", "none");
      $('#option05').css("display", "none");
      $('#option06').css("display", "none");
      $('#option07').css("display", "none");
      $('#option08').css("display", "none");
      $('#option09').css("display", "none");
      $('#option010').css("display", "none");
      $('#option011').css("display", "none");
      $('#option012').css("display", "none");
      $('#option0').addClass("act");
      $('#option1').removeClass("act");
      $('#option2').removeClass("act");
      $('#option3').removeClass("act");
      $('#option4').removeClass("act");
      $('#option5').removeClass("act");
      $('#option6').removeClass("act");
      $('#option7').removeClass("act");
      $('#option8').removeClass("act");
      $('#option9').removeClass("act");
      $('#option10').removeClass("act");
      $('#option11').removeClass("act");
      $('#option12').removeClass("act");
    });

    $("#option1").click(function(){
      $('#option01').css("display", "block");
      $('#option00').css("display", "none");
      $('#option02').css("display", "none");
      $('#option03').css("display", "none");
      $('#option04').css("display", "none");
      $('#option05').css("display", "none");
      $('#option06').css("display", "none");
      $('#option07').css("display", "none");
      $('#option08').css("display", "none");
      $('#option09').css("display", "none");
      $('#option010').css("display", "none");
      $('#option011').css("display", "none");
      $('#option012').css("display", "none");
      $('#option1').addClass("act");
      $('#option0').removeClass("act");
      $('#option2').removeClass("act");
      $('#option3').removeClass("act");
      $('#option4').removeClass("act");
      $('#option5').removeClass("act");
      $('#option6').removeClass("act");
      $('#option7').removeClass("act");
      $('#option8').removeClass("act");
      $('#option9').removeClass("act");
      $('#option10').removeClass("act");
      $('#option11').removeClass("act");
      $('#option12').removeClass("act");
    });

    $("#option2").click(function(){
      $('#option02').css("display", "block");
      $('#option01').css("display", "none");
      $('#option00').css("display", "none");
      $('#option03').css("display", "none");
      $('#option04').css("display", "none");
      $('#option05').css("display", "none");
      $('#option06').css("display", "none");
      $('#option07').css("display", "none");
      $('#option08').css("display", "none");
      $('#option09').css("display", "none");
      $('#option010').css("display", "none");
      $('#option011').css("display", "none");
      $('#option012').css("display", "none");
      $('#option2').addClass("act");
      $('#option1').removeClass("act");
      $('#option0').removeClass("act");
      $('#option3').removeClass("act");
      $('#option4').removeClass("act");
      $('#option5').removeClass("act");
      $('#option6').removeClass("act");
      $('#option7').removeClass("act");
      $('#option8').removeClass("act");
      $('#option9').removeClass("act");
      $('#option10').removeClass("act");
      $('#option11').removeClass("act");
      $('#option12').removeClass("act");
    });

    $("#option3").click(function(){
      $('#option03').css("display", "block");
      $('#option01').css("display", "none");
      $('#option02').css("display", "none");
      $('#option00').css("display", "none");
      $('#option04').css("display", "none");
      $('#option05').css("display", "none");
      $('#option06').css("display", "none");
      $('#option07').css("display", "none");
      $('#option08').css("display", "none");
      $('#option09').css("display", "none");
      $('#option010').css("display", "none");
      $('#option011').css("display", "none");
      $('#option012').css("display", "none");
      $('#option3').addClass("act");
      $('#option1').removeClass("act");
      $('#option2').removeClass("act");
      $('#option0').removeClass("act");
      $('#option4').removeClass("act");
      $('#option5').removeClass("act");
      $('#option6').removeClass("act");
      $('#option7').removeClass("act");
      $('#option8').removeClass("act");
      $('#option9').removeClass("act");
      $('#option10').removeClass("act");
      $('#option11').removeClass("act");
      $('#option12').removeClass("act");
    });

    $("#option4").click(function(){
      $('#option04').css("display", "block");
      $('#option01').css("display", "none");
      $('#option02').css("display", "none");
      $('#option03').css("display", "none");
      $('#option00').css("display", "none");
      $('#option05').css("display", "none");
      $('#option06').css("display", "none");
      $('#option07').css("display", "none");
      $('#option08').css("display", "none");
      $('#option09').css("display", "none");
      $('#option010').css("display", "none");
      $('#option011').css("display", "none");
      $('#option012').css("display", "none");
      $('#option4').addClass("act");
      $('#option1').removeClass("act");
      $('#option2').removeClass("act");
      $('#option3').removeClass("act");
      $('#option0').removeClass("act");
      $('#option5').removeClass("act");
      $('#option6').removeClass("act");
      $('#option7').removeClass("act");
      $('#option8').removeClass("act");
      $('#option9').removeClass("act");
      $('#option10').removeClass("act");
      $('#option11').removeClass("act");
      $('#option12').removeClass("act");
    });

    $("#option5").click(function(){
      $('#option05').css("display", "block");
      $('#option01').css("display", "none");
      $('#option02').css("display", "none");
      $('#option03').css("display", "none");
      $('#option04').css("display", "none");
      $('#option00').css("display", "none");
      $('#option06').css("display", "none");
      $('#option07').css("display", "none");
      $('#option08').css("display", "none");
      $('#option09').css("display", "none");
      $('#option010').css("display", "none");
      $('#option011').css("display", "none");
      $('#option012').css("display", "none");
      $('#option5').addClass("act");
      $('#option1').removeClass("act");
      $('#option2').removeClass("act");
      $('#option3').removeClass("act");
      $('#option4').removeClass("act");
      $('#option0').removeClass("act");
      $('#option6').removeClass("act");
      $('#option7').removeClass("act");
      $('#option8').removeClass("act");
      $('#option9').removeClass("act");
      $('#option10').removeClass("act");
      $('#option11').removeClass("act");
      $('#option12').removeClass("act");
    });

    $("#option6").click(function(){
      $('#option06').css("display", "block");
      $('#option01').css("display", "none");
      $('#option02').css("display", "none");
      $('#option03').css("display", "none");
      $('#option04').css("display", "none");
      $('#option05').css("display", "none");
      $('#option00').css("display", "none");
      $('#option07').css("display", "none");
      $('#option08').css("display", "none");
      $('#option09').css("display", "none");
      $('#option010').css("display", "none");
      $('#option011').css("display", "none");
      $('#option012').css("display", "none");
      $('#option6').addClass("act");
      $('#option1').removeClass("act");
      $('#option2').removeClass("act");
      $('#option3').removeClass("act");
      $('#option4').removeClass("act");
      $('#option5').removeClass("act");
      $('#option0').removeClass("act");
      $('#option7').removeClass("act");
      $('#option8').removeClass("act");
      $('#option9').removeClass("act");
      $('#option10').removeClass("act");
      $('#option11').removeClass("act");
      $('#option12').removeClass("act");
    });

    $("#option7").click(function(){
      $('#option07').css("display", "block");
      $('#option01').css("display", "none");
      $('#option02').css("display", "none");
      $('#option03').css("display", "none");
      $('#option04').css("display", "none");
      $('#option05').css("display", "none");
      $('#option06').css("display", "none");
      $('#option00').css("display", "none");
      $('#option08').css("display", "none");
      $('#option09').css("display", "none");
      $('#option010').css("display", "none");
      $('#option011').css("display", "none");
      $('#option012').css("display", "none");
      $('#option7').addClass("act");
      $('#option1').removeClass("act");
      $('#option2').removeClass("act");
      $('#option3').removeClass("act");
      $('#option4').removeClass("act");
      $('#option5').removeClass("act");
      $('#option6').removeClass("act");
      $('#option0').removeClass("act");
      $('#option8').removeClass("act");
      $('#option9').removeClass("act");
      $('#option10').removeClass("act");
      $('#option11').removeClass("act");
      $('#option12').removeClass("act");
    });

    $("#option8").click(function(){
      $('#option08').css("display", "block");
      $('#option01').css("display", "none");
      $('#option02').css("display", "none");
      $('#option03').css("display", "none");
      $('#option04').css("display", "none");
      $('#option05').css("display", "none");
      $('#option06').css("display", "none");
      $('#option07').css("display", "none");
      $('#option00').css("display", "none");
      $('#option09').css("display", "none");
      $('#option010').css("display", "none");
      $('#option011').css("display", "none");
      $('#option012').css("display", "none");
      $('#option8').addClass("act");
      $('#option1').removeClass("act");
      $('#option2').removeClass("act");
      $('#option3').removeClass("act");
      $('#option4').removeClass("act");
      $('#option5').removeClass("act");
      $('#option6').removeClass("act");
      $('#option7').removeClass("act");
      $('#option0').removeClass("act");
      $('#option9').removeClass("act");
      $('#option10').removeClass("act");
      $('#option11').removeClass("act");
      $('#option12').removeClass("act");
    });

    $("#option9").click(function(){
      $('#option09').css("display", "block");
      $('#option01').css("display", "none");
      $('#option02').css("display", "none");
      $('#option03').css("display", "none");
      $('#option04').css("display", "none");
      $('#option05').css("display", "none");
      $('#option06').css("display", "none");
      $('#option07').css("display", "none");
      $('#option08').css("display", "none");
      $('#option00').css("display", "none");
      $('#option010').css("display", "none");
      $('#option011').css("display", "none");
      $('#option012').css("display", "none");
      $('#option9').addClass("act");
      $('#option1').removeClass("act");
      $('#option2').removeClass("act");
      $('#option3').removeClass("act");
      $('#option4').removeClass("act");
      $('#option5').removeClass("act");
      $('#option6').removeClass("act");
      $('#option7').removeClass("act");
      $('#option8').removeClass("act");
      $('#option0').removeClass("act");
      $('#option10').removeClass("act");
      $('#option11').removeClass("act");
      $('#option12').removeClass("act");
    });

    $("#option10").click(function(){
      $('#option010').css("display", "block");
      $('#option01').css("display", "none");
      $('#option02').css("display", "none");
      $('#option03').css("display", "none");
      $('#option04').css("display", "none");
      $('#option05').css("display", "none");
      $('#option06').css("display", "none");
      $('#option07').css("display", "none");
      $('#option08').css("display", "none");
      $('#option09').css("display", "none");
      $('#option00').css("display", "none");
      $('#option011').css("display", "none");
      $('#option012').css("display", "none");
      $('#option10').addClass("act");
      $('#option1').removeClass("act");
      $('#option2').removeClass("act");
      $('#option3').removeClass("act");
      $('#option4').removeClass("act");
      $('#option5').removeClass("act");
      $('#option6').removeClass("act");
      $('#option7').removeClass("act");
      $('#option8').removeClass("act");
      $('#option9').removeClass("act");
      $('#option0').removeClass("act");
      $('#option11').removeClass("act");
      $('#option12').removeClass("act");
    });

    $("#option11").click(function(){
      $('#option011').css("display", "block");
      $('#option01').css("display", "none");
      $('#option02').css("display", "none");
      $('#option03').css("display", "none");
      $('#option04').css("display", "none");
      $('#option05').css("display", "none");
      $('#option06').css("display", "none");
      $('#option07').css("display", "none");
      $('#option08').css("display", "none");
      $('#option09').css("display", "none");
      $('#option010').css("display", "none");
      $('#option00').css("display", "none");
      $('#option012').css("display", "none");
      $('#option11').addClass("act");
      $('#option1').removeClass("act");
      $('#option2').removeClass("act");
      $('#option3').removeClass("act");
      $('#option4').removeClass("act");
      $('#option5').removeClass("act");
      $('#option6').removeClass("act");
      $('#option7').removeClass("act");
      $('#option8').removeClass("act");
      $('#option9').removeClass("act");
      $('#option10').removeClass("act");
      $('#option0').removeClass("act");
      $('#option12').removeClass("act");
    });

    $("#option12").click(function(){
      $('#option012').css("display", "block");
      $('#option01').css("display", "none");
      $('#option02').css("display", "none");
      $('#option03').css("display", "none");
      $('#option04').css("display", "none");
      $('#option05').css("display", "none");
      $('#option06').css("display", "none");
      $('#option07').css("display", "none");
      $('#option08').css("display", "none");
      $('#option09').css("display", "none");
      $('#option010').css("display", "none");
      $('#option011').css("display", "none");
      $('#option00').css("display", "none");
      $('#option12').addClass("act");
      $('#option1').removeClass("act");
      $('#option2').removeClass("act");
      $('#option3').removeClass("act");
      $('#option4').removeClass("act");
      $('#option5').removeClass("act");
      $('#option6').removeClass("act");
      $('#option7').removeClass("act");
      $('#option8').removeClass("act");
      $('#option9').removeClass("act");
      $('#option10').removeClass("act");
      $('#option11').removeClass("act");
      $('#option0').removeClass("act");
    });







    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".dropdown-menu li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    $("#myInput1").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".dropdown-menu li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    $("#myInput2").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".dropdown-menu li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    $('#insideA').click(function() {
      $('#insideA').addClass("Acc");
      $('#insideB').removeClass("Acc");
      $('#theRealLook1').addClass("Acc1");
      $('#theRealLook2').removeClass("Acc1");
    });
    $('#insideB').click(function() {
      $('#insideB').addClass("Acc");
      $('#insideA').removeClass("Acc");
      $('#theRealLook2').addClass("Acc1");
      $('#theRealLook1').removeClass("Acc1");
      $('#looksDiaDia').removeClass("Acc1");
      $('#looksFesta').removeClass("Acc1");
      $('#looksFormal').removeClass("Acc1");
      $('#looksDesporto').removeClass("Acc1");
    });

    $('#paymentMethod').on('change', function() {
      if ( $('#paymentMethod').val() == 'paypal'){
        $("#paymentPaypal").css("display","inline-block");
        $("#paymentCard").css("display","none");
      }
      else{
        $("#paymentPaypal").css("display","none");
        $("#paymentCard").css("display","inline-block");
      }
    });

    $(".pag").click(function(){
      if ($(this).attr("id") == 'visaI'){
        $('#visaD').css('display','inline-block');
        $('#masterD').css('display','none');
        $('#americanD').css('display','none');
        $('#paypalD').css('display','none');
        $('#multiD').css('display','none');
        $('#visa').css('background-color','#eeeeee');
        $('#mastercard').css('background-color','');
        $('#americanexpress').css('background-color','');
        $('#paypal').css('background-color','');
        $('#multibanco').css('background-color','');
        $('#submitCartoes').css('display','inline-block');
        $('#submitMB').css('display','none');
        $('#submitPaypal').css('display','none');
        $('#metodoVisa').prop("disabled", false);
        $('#numberVisa').prop("disabled", false);
        $('#titularVisa').prop("disabled", false);
        $('#monthVisa').prop("disabled", false);
        $('#yearVisa').prop("disabled", false);
        $('#cvcVisa').prop("disabled", false);
        $('#metodoMaster').prop("disabled", true);
        $('#numberMaster').prop("disabled", true);
        $('#titularMaster').prop("disabled", true);
        $('#monthMaster').prop("disabled", true);
        $('#yearMaster').prop("disabled", true);
        $('#cvcMaster').prop("disabled", true);
        $('#metodoAmerican').prop("disabled", true);
        $('#numberAmerican').prop("disabled", true);
        $('#titularAmerican').prop("disabled", true);
        $('#monthAmerican').prop("disabled", true);
        $('#yearAmerican').prop("disabled", true);
        $('#cvcAmerican').prop("disabled", true);
        $('#metodoPaypal').prop("disabled", true);
        $('#metodoMb').prop("disabled", true);
        $('#entidadeMb').prop("disabled", true);
        $('#referenciaMb').prop("disabled", true);
      }
      else if ($(this).attr("id") == 'mastercardI'){
        $('#visaD').css('display','none');
        $('#masterD').css('display','inline-block');
        $('#americanD').css('display','none');
        $('#paypalD').css('display','none');
        $('#multiD').css('display','none');
        $('#visa').css('background-color','');
        $('#mastercard').css('background-color','#eeeeee');
        $('#americanexpress').css('background-color','');
        $('#paypal').css('background-color','');
        $('#multibanco').css('background-color','');
        $('#submitCartoes').css('display','inline-block');
        $('#submitMB').css('display','none');
        $('#submitPaypal').css('display','none');
        $('#metodoVisa').prop("disabled", true);
        $('#numberVisa').prop("disabled", true);
        $('#titularVisa').prop("disabled", true);
        $('#monthVisa').prop("disabled", true);
        $('#yearVisa').prop("disabled", true);
        $('#cvcVisa').prop("disabled", true);
        $('#metodoMaster').prop("disabled", false);
        $('#numberMaster').prop("disabled", false);
        $('#titularMaster').prop("disabled", false);
        $('#monthMaster').prop("disabled", false);
        $('#yearMaster').prop("disabled", false);
        $('#cvcMaster').prop("disabled", false);
        $('#metodoAmerican').prop("disabled", true);
        $('#numberAmerican').prop("disabled", true);
        $('#titularAmerican').prop("disabled", true);
        $('#monthAmerican').prop("disabled", true);
        $('#yearAmerican').prop("disabled", true);
        $('#cvcAmerican').prop("disabled", true);
        $('#metodoPaypal').prop("disabled", true);
        $('#metodoMb').prop("disabled", true);
        $('#entidadeMb').prop("disabled", true);
        $('#referenciaMb').prop("disabled", true);
      }
      else if ($(this).attr("id") == 'americanexpressI'){
        $('#visaD').css('display','none');
        $('#masterD').css('display','none');
        $('#americanD').css('display','inline-block');
        $('#paypalD').css('display','none');
        $('#multiD').css('display','none');
        $('#visa').css('background-color','');
        $('#mastercard').css('background-color','');
        $('#americanexpress').css('background-color','#eeeeee');
        $('#paypal').css('background-color','');
        $('#multibanco').css('background-color','');
        $('#submitCartoes').css('display','inline-block');
        $('#submitMB').css('display','none');
        $('#submitPaypal').css('display','none');
        $('#metodoVisa').prop("disabled", true);
        $('#numberVisa').prop("disabled", true);
        $('#titularVisa').prop("disabled", true);
        $('#monthVisa').prop("disabled", true);
        $('#yearVisa').prop("disabled", true);
        $('#cvcVisa').prop("disabled", true);
        $('#metodoMaster').prop("disabled", true);
        $('#numberMaster').prop("disabled", true);
        $('#titularMaster').prop("disabled", true);
        $('#monthMaster').prop("disabled", true);
        $('#yearMaster').prop("disabled", true);
        $('#cvcMaster').prop("disabled", true);
        $('#metodoAmerican').prop("disabled", false);
        $('#numberAmerican').prop("disabled", false);
        $('#titularAmerican').prop("disabled", false);
        $('#monthAmerican').prop("disabled", false);
        $('#yearAmerican').prop("disabled", false);
        $('#cvcAmerican').prop("disabled", false);
        $('#metodoPaypal').prop("disabled", true);
        $('#metodoMb').prop("disabled", true);
        $('#entidadeMb').prop("disabled", true);
        $('#referenciaMb').prop("disabled", true);
      }
      else if ($(this).attr("id") == 'paypalI'){
        $('#visaD').css('display','none');
        $('#masterD').css('display','none');
        $('#americanD').css('display','none');
        $('#paypalD').css('display','inline-block');
        $('#multiD').css('display','none');
        $('#visa').css('background-color','');
        $('#mastercard').css('background-color','');
        $('#americanexpress').css('background-color','');
        $('#paypal').css('background-color','#eeeeee');
        $('#multibanco').css('background-color','');
        $('#submitPaypal').css('display','inline-block');
        $('#submitMB').css('display','none');
        $('#submitCartoes').css('display','none');
        $('#metodoVisa').prop("disabled", true);
        $('#numberVisa').prop("disabled", true);
        $('#titularVisa').prop("disabled", true);
        $('#monthVisa').prop("disabled", true);
        $('#yearVisa').prop("disabled", true);
        $('#cvcVisa').prop("disabled", true);
        $('#metodoMaster').prop("disabled", true);
        $('#numberMaster').prop("disabled", true);
        $('#titularMaster').prop("disabled", true);
        $('#monthMaster').prop("disabled", true);
        $('#yearMaster').prop("disabled", true);
        $('#cvcMaster').prop("disabled", true);
        $('#metodoAmerican').prop("disabled", true);
        $('#numberAmerican').prop("disabled", true);
        $('#titularAmerican').prop("disabled", true);
        $('#monthAmerican').prop("disabled", true);
        $('#yearAmerican').prop("disabled", true);
        $('#cvcAmerican').prop("disabled", true);
        $('#metodoPaypal').prop("disabled", false);
        $('#metodoMb').prop("disabled", true);
        $('#entidadeMb').prop("disabled", true);
        $('#referenciaMb').prop("disabled", true);
      }
      else{
        $('#visaD').css('display','none');
        $('#masterD').css('display','none');
        $('#americanD').css('display','none');
        $('#paypalD').css('display','none');
        $('#multiD').css('display','inline-block');
        $('#visa').css('background-color','');
        $('#mastercard').css('background-color','');
        $('#americanexpress').css('background-color','');
        $('#paypal').css('background-color','');
        $('#multibanco').css('background-color','#eeeeee');
        $('#submitMB').css('display','inline-block');
        $('#submitPaypal').css('display','none');
        $('#submitCartoes').css('display','none');
        $('#metodoVisa').prop("disabled", true);
        $('#numberVisa').prop("disabled", true);
        $('#titularVisa').prop("disabled", true);
        $('#monthVisa').prop("disabled", true);
        $('#yearVisa').prop("disabled", true);
        $('#cvcVisa').prop("disabled", true);
        $('#metodoMaster').prop("disabled", true);
        $('#numberMaster').prop("disabled", true);
        $('#titularMaster').prop("disabled", true);
        $('#monthMaster').prop("disabled", true);
        $('#yearMaster').prop("disabled", true);
        $('#cvcMaster').prop("disabled", true);
        $('#metodoAmerican').prop("disabled", true);
        $('#numberAmerican').prop("disabled", true);
        $('#titularAmerican').prop("disabled", true);
        $('#monthAmerican').prop("disabled", true);
        $('#yearAmerican').prop("disabled", true);
        $('#cvcAmerican').prop("disabled", true);
        $('#metodoPaypal').prop("disabled", true);
        $('#metodoMb').prop("disabled", false);
        $('#entidadeMb').prop("disabled", false);
        $('#referenciaMb').prop("disabled", false);
      }
    });
  });



  // Porfolio filter
  $("#portfolio-flters li").click(function() {
    $("#portfolio-flters li").removeClass('filter-active');
    $(this).addClass('filter-active');

    var selectedFilter = $(this).data("filter");
    $("#portfolio-wrapper").fadeTo(100, 0);

    $(".portfolio-item").fadeOut().css('transform', 'scale(0)');

    setTimeout(function() {
      $(selectedFilter).fadeIn(100).css('transform', 'scale(1)');
      $("#portfolio-wrapper").fadeTo(300, 1);
    }, 300);
  });


  // Mobile Navigation
  if ($('#nav-menu-container').length) {
    var $mobile_nav = $('#nav-menu-container').clone().prop({
      id: 'mobile-nav'
    });
    $mobile_nav.find('> ul').attr({
      'class': '',
      'id': ''
    });
    $('body').append($mobile_nav);
    $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>');
    $('body').append('<div id="mobile-body-overly"></div>');
    $('#mobile-nav').find('.menu-has-children').prepend('<i class="fa fa-chevron-down"></i>');

    $(document).on('click', '.menu-has-children i', function(e) {
      $(this).next().toggleClass('menu-item-active');
      $(this).nextAll('ul').eq(0).slideToggle();
      $(this).toggleClass("fa-chevron-up fa-chevron-down");
    });

    $(document).on('click', '#mobile-nav-toggle', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
      $('#mobile-body-overly').toggle();
    });

    $(document).click(function(e) {
      var container = $("#mobile-nav, #mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
          $('#mobile-body-overly').fadeOut();
        }
      }
    });
  } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
    $("#mobile-nav, #mobile-nav-toggle").hide();
  }
