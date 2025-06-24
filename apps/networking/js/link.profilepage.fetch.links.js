if (document.querySelectorAll(".links__url").length == 0) {
  const editOpenElement = document.querySelector(".links__edit-open");
  const addElement = document.querySelector(".links__add");

  if (editOpenElement && addElement) {
    editOpenElement.classList.toggle('hide');
    addElement.classList.toggle('hide');
  } else {
    //console.error("No links found.");
  }
  let  linkListCount = 0;
} else {
  //let linkListCount = document.querySelectorAll(".links__url-edit")[document.querySelectorAll(".links__url-edit").length - 1].dataset.id;
  let  linkListCount = document.querySelectorAll(".links__url-edit").length;
}

/* -------------------------------- functions ------------------------------- */

/*-------------add / edit links ----------*/
$('.links__add').click(function() {
    openModal('#add__links');
});

$('.popup__add-links-close-btn').click(function() {
    closeModal('#add__links');
});

$('.popup__edit-links-close-btn').click(function() {
    closeModal('#edit__links');
});