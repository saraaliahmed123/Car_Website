
var all = document.querySelectorAll(".eventpricediscount");

for (vehicle of all)
{
    var price = vehicle.querySelector(".price"); 
    var discountedPrice = vehicle.querySelector(".discountedPrice");
    if (discountedPrice)
    {
        price.classList.add("pricecross");
    }

}

//Employee

var addModal = document.getElementById("addModal"); //done
var editModal = document.getElementById("editModal"); //done
var deleteModal = document.getElementById("deleteModal"); //done

var addBtn = document.getElementById("addBtn"); //done
var editBtn = document.getElementById("editBtn"); //done
var deleteBtn = document.getElementById("deleteBtn"); //done

var addSpan = document.getElementsByClassName("close")[0]; //done
var editSpan = document.getElementsByClassName("close")[1]; //done
var deleteSpan = document.getElementsByClassName("close")[2]; //done

addBtn.onclick = function() { //done
  addModal.style.display = "block"; //done
  editModal.style.display = "none"; //done
  deleteModal.style.display = "none"; //done
} //done

editBtn.onclick = function() { //done
  editModal.style.display = "block"; //done
  addModal.style.display = "none"; //done
  deleteModal.style.display = "none"; //done
} //done

deleteBtn.onclick = function() { //done
  deleteModal.style.display = "block"; //done
  addModal.style.display = "none"; //done
  editModal.style.display = "none"; //done
} //done

addSpan.onclick = function() { //done
  addModal.style.display = "none"; //done
} //done

editSpan.onclick = function() {  //done
  editModal.style.display = "none"; //done
} //done

deleteSpan.onclick = function() { //done
  deleteModal.style.display = "none"; //done
} //done