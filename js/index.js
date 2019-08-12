
$(document).ready(function() {
$("#datepicker").datepicker();
$("#datepicker1").datepicker();
$("#datepicker2").datepicker();
$("#datepicker3").datepicker();
});

  function openForm()
  {
    document.querySelector(".bg-modal").style.display = "flex";
  }
  function closeForm()
  {
    document.querySelector(".bg-modal").style.display = "none";
  }
   function openForm1()
  {
    document.querySelector(".bg-modal1").style.display = "flex";
  }
  function closeForm1()
  {
    document.querySelector(".bg-modal1").style.display = "none";
  }
  function reload()
  {
  	location.reload();
  }

