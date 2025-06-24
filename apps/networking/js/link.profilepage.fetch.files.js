if (document.querySelectorAll(".files__url").length == 0) {
  const editOpenElement = document.querySelector(".files__edit-open");
  const addElement = document.querySelector(".files__add");

  if (editOpenElement && addElement) {
    editOpenElement.classList.toggle('hide');
    addElement.classList.toggle('hide');
  } else {
    //console.error("No files found.");
  }
  let  filesListCount = 0;
} else {
  //let filesListCount = document.querySelectorAll(".files__url-edit")[document.querySelectorAll(".files__url-edit").length - 1].dataset.id;
  let  filesListCount = document.querySelectorAll(".files__url-edit").length;
  
}

/* -------------------------------- functions ------------------------------- */

/*-----------add/ edit files ------*/

$('.files__add').click(function() {    
    openModal('#add__file');
});

$('.popup__edit-file-close-btn').click(function() {
    closeModal('#edit__file');
});
$('.popup__add-file-close-btn').click(function() {
    closeModal('#add__file');
});