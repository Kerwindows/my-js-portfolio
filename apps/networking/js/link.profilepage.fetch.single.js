//profile module
//about module
//social module
/* ------------------------------ edit profile ------------------------------ */
const profileFirstName = document.querySelector(".profile__firstname");
const profileLastName = document.querySelector(".profile__lastname");
const profileTitle = document.querySelector(".profile__title");
const profileOrganization = document.querySelector(".profile__organization");
const profileCity = document.querySelector(".profile__city");
const profileIconsTitle = document.querySelector(".profile__about-me");

const profileForm = document.forms.ProfileForm;
const popupFirstName = profileForm.elements.firstname;
const popupLastName = profileForm.elements.lastname;
const popupImage = profileForm.elements.profile_img;
const popupTitle = profileForm.elements.title;
const popupOrganization = profileForm.elements.organization;
const popupIndustry = profileForm.elements.industrytype;
const profileSaveBtn = document.querySelector(".profile__save-btn");

/*-------------Edit Userinfo------------------*/
const userInfo = document.forms.UserInfo;
const popupUserInfoImage = userInfo.elements.userinfo_img;
const popupUserInfoContact = userInfo.elements.contact;
const popupUserInfoEmail = userInfo.elements.email;
const userInfoOutputImage = document.querySelector(".userinfo_output_image");
const userinfoSaveBtn = document.querySelector(".userinfo__save-btn");

const stickyTelephone = document.querySelector("#sticky__telephone");
const stickyEmail = document.querySelector("#sticky__email");
/* ------------------------------- edit about ------------------------------- */
const editAboutForm = document.forms.EditAbout;
const popupAbout = editAboutForm.elements.bio;
const profileAbout = document.querySelector(".about__me");
const aboutSaveBtn = document.querySelector(".about__save-btn");
const readMoreButton = document.getElementById("read-more");
const aboutTitle = document.querySelector(".about-title");
//const aboutTextarea = document.querySelector(".popup__form-textarea");
/* ------------------------------ edit socials ------------------------------ */
const socialForm = document.forms.SocialForm;
/*
const socialFacebook = document.querySelector(".social__facebook");
const socialTwitter = document.querySelector(".social__twitter");
const socialInstagram = document.querySelector(".social__instagram");
const socialLinkedin = document.querySelector(".social__linkedin");
const socialTikTok = document.querySelector(".social__tiktok");
const socialYouTube = document.querySelector(".social__youtube");
const socialWhatsapp = document.querySelector(".social__whatsapp");
const popupFacebook = document.querySelector(
  ".popup__form-input_type_facebook"
);
const popupTwitter = document.querySelector(".popup__form-input_type_twitter");
const popupInstagram = document.querySelector(
  ".popup__form-input_type_instagram"
);
const popupLinkedin = document.querySelector(
  ".popup__form-input_type_linkedin"
);
const popupTikTok = document.querySelector(".popup__form-input_type_tiktok");
const popupYouTube = document.querySelector(".popup__form-input_type_youtube");
const popupWhatsapp = document.querySelector(
  ".popup__form-input_type_whatsapp"
);*/
const submitSocialEdit = document.querySelector(".popup__edit-social-form");
const submitSocialEdit2 = document.querySelector(".popup__edit-social-form2");
const socialSaveButton = document.querySelector(".social__save-btn");
//const addSocialBtn = document.querySelector("#add-social-btn");
//const addSocialBtns = document.querySelector(".add-social-btns");


/* ------------------------------- image popups ------------------------------ */
const imageElement = document.querySelector(".popup__card-image-preview");
const profilePicture = document.querySelector(".profile__image-container");
const logo = document.querySelector(".profile-logo");
const profileOutputImage = document.querySelector(".profile_output_image");
/*----------------------------------links popup -----------------------------*/
const addLinkForm = document.forms.AddLinksForm;
const popupLinksAddPreviewImage = document.querySelector(
  ".links__output_image_add"
);
const popupLinksAddImage = document.querySelector("#image_add-input");
const popupLinksAddTitle = document.querySelector("#title_add-input");
const popupLinksAddUrl = document.querySelector("#url_add-input");
const linkAddSaveBtn = document.querySelector(".linkAdd__save-btn");

const editLinkForm = document.forms.EditLinkForm;
const popupLinksEditPreviewImage = document.querySelector(
  ".links__output_image_edit"
);
const popupLinksEditImage = document.querySelector("#image_edit-input");
const popupLinksEditTitle = document.querySelector("#title_edit-input");
const popupLinksEditUrl = document.querySelector("#url_edit-input");
const linkEditSaveBtn = document.querySelector(".linkEdit__save-btn");

const linksList = document.querySelector(".links__list");

/*----------------Add File Popup--------------------*/
const addFile = document.forms.AddFile;
const fileUpload = addFile.elements.fileupload;
let linkImageName = addFile.elements.filename; //file upload
const fileSaveBtn = document.querySelector(".file__save-btn");
const filesList = document.querySelector(".files__list");
const editFile = document.forms.EditFileForm;
const editFileSaveBtn = document.querySelector(".editfile__save-btn");
/*----------------------------------exchange contact-----------------------------------*/
const exchangeForm = document.forms.ExchangeForm;
const exchangeUsername = document.querySelector("#exchange_username_input");
const exchangeFirstname = document.querySelector("#exchange-firstname-input");
const exchangeLastname = document.querySelector("#exchange-lastname-input");
const exchangeEmail = document.querySelector("#exchange-email-input");
const exchangeMetAt = document.querySelector("#exchange-met_at-input");
const exchangeContact = document.querySelector("#exchange-contact-input");
const exchangeYes = document.querySelector(".exchange__linkwi-user_yes");
const exchangeNo = document.querySelector(".exchange__linkwi-user_no");
const exchangeSaveBtn = document.querySelector(".exchange__save-btn");
/* -------------------------------- basic functions ------------------------------- */
function openModal(popupElement) {
  $(popupElement).addClass("popup_opened");
}

function closeModal(popupElement) {
  $(popupElement).removeClass("popup_opened");
}

function showPreviewImage(imageSRC, alt) {
  openModal("#view__image");
  imageElement.src = imageSRC;
  imageElement.alt = alt;
}

/*--------------------------------------------------------------------------------*/
function editColourData(id, text) {
  $.ajax({
    url:`${base_url}/linkwi/includes/ajax/links/php/edit.colour.php`,
    method: "POST",
    data: {
      id: id,
      text: text,
    },
    dataType: "text",
    success: function (data) {
      if (data != "") {
        return false;
      }
    },
  });
}

/*----------------Profile edit--------------------*/
$(".profile__edit-btn").click(function () {
  popupFirstName.value = profileFirstName.textContent.trim();
  popupLastName.value = profileLastName.textContent.trim();
  popupTitle.value = profileTitle.textContent.trim();
  popupOrganization.value = profileOrganization.textContent.trim();
  popupIndustry.value = profileCity.textContent.trim();
  profileOutputImage.src = getComputedStyle(profilePicture)
    .backgroundImage.slice(4, -1)
    .replace(/"/g, "");

  popupImage.value = "";
  openModal("#edit__profile");
});
$(".popup__edit-close-btn").click(function () {
  hideInputError(profileForm, popupFirstName, profileSaveBtn);
  hideInputError(profileForm, popupLastName, profileSaveBtn);
  hideInputError(profileForm, popupTitle, profileSaveBtn);
  hideInputError(profileForm, popupOrganization, profileSaveBtn);
  hideInputError(profileForm, popupIndustry, profileSaveBtn);
  closeModal("#edit__profile");
});

/*----------------Bio edit--------------------*/
$(".about__edit-btn").click(function () {

   $.ajax({
    type: "POST",
    url: `${base_url}/linkwi/includes/ajax/links/php/select.bio.php`,
    data: {userid:userid},
    cache: false,
    success: function (data) {
    //console.log(data)
      $(".popup__form-textarea").html(data);
     // truncateText();
    },
  });
  openModal("#edit__about");
});

$(".popup__edit-about-close-btn").click(function () {
  hideInputError(editAboutForm, popupAbout, aboutSaveBtn);
  closeModal("#edit__about");
});

/*----------------Social edit--------------------*/

//social links
$(".social__edit-btn").click(function () {
openModal("#edit__social");
  //check to see if input has a url
  //even though php variable is blank JS sees the baseurl
  popupFacebook.value =
    socialFacebook.href == socialFacebook.baseURI ? "" : socialFacebook.href;
  popupTwitter.value =
    socialTwitter.href == socialTwitter.baseURI ? "" : socialTwitter.href;
  popupInstagram.value =
    socialInstagram.href == socialInstagram.baseURI ? "" : socialInstagram.href;
  popupLinkedin.value =
    socialLinkedin.href == socialLinkedin.baseURI ? "" : socialLinkedin.href;
  popupTikTok.value =
    socialTikTok.href == socialTikTok.baseURI ? "" : socialTikTok.href;
  popupYouTube.value =
    socialYouTube.href == socialYouTube.baseURI ? "" : socialYouTube.href;
  popupWhatsapp.value =
    socialWhatsapp.href == socialWhatsapp.baseURI ? "" : socialWhatsapp.href;
  
});
//social links
$(".social__edit-btn2").click(function () {
openModal("#edit__social2");
  $.ajax({
    url: `${base_url}/linkwi/includes/ajax/socials/php/edit.socials.php`,
    method: "POST",
    data: {
      userid: userid,chk:chk
    },
    dataType: "text",
    success: function (data) {
      $("#display-socials").html(data);

     /* document.querySelectorAll(".social__url").forEach(function (userItem) {
        userItem.style.color = colour;
      });*/
    },
  });   
});

$("#add-social-btn").click(function () {
  $(".add-social-btns").toggleClass('hide');
  $("#add-social-btn span").toggleClass('rotate-text');
  return false;
});


 function appendSocialInput(socialName, fontAwesomeIcon) {
 let lowerCaseName = socialName.toLowerCase();
    // Check if the social media container is already present
    if ($('#' + lowerCaseName + '-input').length > 0) {
      return false;
    }

    $('#display-socials').append(`
      <div class='popup__social'>
        <span class='popup__social-icon'><i class='${fontAwesomeIcon}'></i></span>
        <input id='${lowerCaseName}-input' class='popup__form-input popup__form-input_type_${lowerCaseName}' data-name='${socialName}' data-icon='${fontAwesomeIcon}'  name='${socialName}' type='url' placeholder='${socialName} url' value='https://${lowerCaseName}.com' />
      </div>
      <span class='input_error ${lowerCaseName}-input-error'></span>
    `);
    return false;
  }

  $('#add-facebook').click(function() {
    appendSocialInput('Facebook', 'fab fa-facebook');
    return false;
  });

  $('#add-instagram').click(function() {
    appendSocialInput('Instagram', 'fab fa-instagram');
    return false;
  });
  
  $('#add-twitter').click(function() {
    appendSocialInput('Twitter', 'fab fa-twitter');
    return false;
  });
  
  $('#add-linkedin').click(function() {
    appendSocialInput('LinkedIn', 'fab fa-linkedin');
    return false;
  });
  
  $('#add-telegram').click(function() {
    appendSocialInput('Telegram', 'fa fa-telegram');
    return false;
  });
  
   $('#add-tiktok').click(function() {
    appendSocialInput('TikTok', 'fab fa-tiktok');
    return false;
  });
  
  $('#add-youtube').click(function() {
    appendSocialInput('YouTube', 'fab fa-youtube');
    return false;
  });
  
  $('#add-whatsapp').click(function() {
    appendSocialInput('WhatsApp', 'fab fa-whatsapp');
    return false;
  });
  
  $('#add-snapchat').click(function() {
    appendSocialInput('Snapchat', 'fa fa-snapchat-ghost');
    return false;
  });
  
   $('#add-pinterest').click(function() {
    appendSocialInput('Pinterest', 'fa fa-pinterest');
    return false;
  });
  
  $('#add-twitch').click(function() {
    appendSocialInput('Twitch', 'fa fa-twitch');
    return false;
  });
  
   $('#add-discord').click(function() {
    appendSocialInput('Discord', 'fa-brands fa-discord');
    return false;
  });
  
$(document).on('click', '.delete-social', function() {
if(confirm('Delete this url?')){
    let urlId = $(this).data('id');
    let urlContainer = $(this).closest('.popup__social');
  
     $.ajax({
    type: "POST",
    url: `${base_url}/linkwi/includes/ajax/socials/php/delete.social.php`,
    data: {urlId:urlId},
    cache: false,
    success: function (data) {
    let res = JSON.parse(data);
    if(res.ponse === "success"){
     urlContainer.remove();
     fetch_social_data();
    }else{
    return false
    }
     
    },
  });
    return false;
    }
});

/*----------------------------------*/


$(".popup__edit-social-close-btn").click(function () {
  //closeModal("#edit__social");
  closeModal("#edit__social2");

 /* if (socialForm && popupFacebook && socialSaveButton) {
    hideInputError(socialForm, popupFacebook, socialSaveButton);
  }

  if (socialForm && popupInstagram && socialSaveButton) {
    hideInputError(socialForm, popupInstagram, socialSaveButton);
  }

  if (socialForm && popupTwitter && socialSaveButton) {
    hideInputError(socialForm, popupTwitter, socialSaveButton);
  }
  if (socialForm && popupLinkedin && socialSaveButton) {
    hideInputError(socialForm, popupLinkedin, socialSaveButton);
  }
if (socialForm && popupTikTok && socialSaveButton) {
    hideInputError(socialForm, popupTikTok, socialSaveButton);
  }
  if (socialForm && popupYouTube && socialSaveButton) {
    hideInputError(socialForm, popupYouTube, socialSaveButton);
  }
  if (socialForm && popupWhatsapp && socialSaveButton) {
    hideInputError(socialForm, popupWhatsapp, socialSaveButton);
  }*/
  //.....finish writeing the rest
});

/*----------------sticky footer edit-------------------*/
$(".sticky-footer__colour-icon").click(function () {
  openFooterModal("#edit__colour", "#colour", "colour_opened");
});

$(".colour__popup-close-btn").click(function () {
  closeFooterModal("#edit__colour", "#colour", "colour_opened");
});

$(".sticky-footer__userinfo-icon").click(function () {
  let co = stickyTelephone.attributes.onclick.textContent;
  let ph = co.substring(co.indexOf(":") + 1);
  co = ph.substring(0, ph.indexOf("'"));
  popupUserInfoContact.value = co;

  let em = stickyEmail.attributes.onclick.textContent;
  let ad = em.substring(em.indexOf(":") + 1);
  em = ad.substring(0, ad.indexOf("?"));

  popupUserInfoEmail.value = em;
  userInfoOutputImage.src = getComputedStyle(logo)
    .backgroundImage.slice(4, -1)
    .replace(/"/g, "");
  popupUserInfoImage.value = "";
  openFooterModal("#edit__userinfo", "#userinfo", "userinfo_opened");
});
$(".userinfo__popup-close-btn").click(function () {
  hideInputError(userInfo, popupUserInfoContact, userinfoSaveBtn);
  hideInputError(userInfo, popupUserInfoEmail, userinfoSaveBtn);
  hideInputError(userInfo, popupUserInfoImage, userinfoSaveBtn);
  closeFooterModal("#edit__userinfo", "#userinfo", "userinfo_opened");
});

function closeFooterModal(popupId, type, type_opened) {
  $(type).removeClass(type_opened);
  $(popupId).removeClass("popup_opened");
}

function openFooterModal(popupId, type, type_opened) {
  $(type).addClass(type_opened);
  $(popupId).addClass("popup_opened");
}
/*----------------Links edit-------------------*/
linksList.addEventListener("click", function (evt) {
  if (evt.target.classList.contains("links__url-edit")) {
    const id = evt.target.dataset.id;
    const parentDiv = evt.target.closest('.links');
    document.querySelector(".popup__form-input_type_link_id").value = id;
    document.querySelector(".links__output_image_edit").src =
      parentDiv.querySelector(".links__image").currentSrc;
    document.querySelector("#title_edit-input").value =
      parentDiv.querySelector(".links__text").innerText;
    document.querySelector("#url_edit-input").value =
      parentDiv.querySelector(".links__url").href;
    openModal("#edit__links");
  }
  if (evt.target.classList.contains("links__edit-btn")) {
    document.querySelector(".links__edit-open").classList.toggle("hide");
    document.querySelector(".links__edit-close").classList.toggle("hide");
    document.querySelector(".links__add").classList.toggle("hide");

    linksList.querySelectorAll(".links__delete").forEach(function (userItem) {
      userItem.classList.toggle("hide");
    });

    linksList.querySelectorAll(".links__url").forEach(function (userItem) {
      userItem.classList.toggle("hide");
    });

    linksList.querySelectorAll(".links__url-edit").forEach(function (userItem) {
      userItem.classList.toggle("hide");
    });
  }
  if (evt.target.classList.contains("links__delete")) {
    const id = evt.target.dataset.id;
    let imagePath = evt.target.previousElementSibling.currentSrc;
    imagePath = imagePath.substring(imagePath.lastIndexOf("/") + 1);
    deleteLink(id, imagePath);
  }
});

/*----------------Files edit-------------------*/
filesList.addEventListener("click", function (evt) {
  const urlEdit = evt.target.closest(".files__url-edit");
  const editBtn = evt.target.closest(".files__edit-btn");
  const deleteBtn = evt.target.closest(".files__delete");

  if (urlEdit) {
    const id = urlEdit.dataset.id;
    const fileTitleElement = filesList.querySelector(`[data-file-title][data-id="${id}"]`);

    document.querySelector(".popup__form-input_type_file_id").value = id;
    document.querySelector("#file-title_edit-input").value = fileTitleElement.innerText;

    openModal("#edit__file");
  } else if (editBtn) {
    document.querySelector(".files__edit-open").classList.toggle("hide");
    document.querySelector(".files__edit-close").classList.toggle("hide");
    document.querySelector(".files__add").classList.toggle("hide");

    filesList.querySelectorAll(".files__delete").forEach(function (userItem) {
      userItem.classList.toggle("hide");
    });

    filesList.querySelectorAll(".files__url").forEach(function (userItem) {
      userItem.classList.toggle("hide");
    });
  } else if (deleteBtn) {
    const id = deleteBtn.dataset.id;
    let href = deleteBtn.previousElementSibling.href;
    filePath = href.substring(href.lastIndexOf("/") + 1);
    deleteFile(id, filePath);
  }
});

/*------------------------------------------------*/
$(".popup__add-links-close-btn").click(function () {
  document.querySelector(".image_add-input-error").textContent = "";
  document.querySelector(".title_add-input-error").textContent = "";
  document.querySelector(".url_add-input-error").textContent = "";
  addLinkForm.reset();
  popupLinksAddPreviewImage.src = `${base_url}/linkwi/images/icons/link-icon.jpg`;
  addLinkForm.reset();
  closeModal("#add__links");
});

$(".popup__edit-links-close-btn").click(function () {
  hideInputError(editLinkForm, popupLinksEditImage, linkEditSaveBtn);
  hideInputError(editLinkForm, popupLinksEditTitle, linkEditSaveBtn);
  hideInputError(editLinkForm, popupLinksEditUrl, linkEditSaveBtn);
  //editLinkForm.reset();
  closeModal("#edit__links");
});

/*--------------------original place for submit functions-----------------*/

/*----------------popup overlay close--------------------*/
$(".popup__overlay").click(function () {
  closeFooterModal("#edit__colour", "#colour", "colour_opened");
  closeFooterModal("#edit__userinfo", "#userinfo", "userinfo_opened");
  closeFooterModal("#share__profile", "#share", "colour_opened");
  closeModal("#edit__profile");
  closeModal("#edit__about");
  closeModal("#edit__social");
  closeModal("#view__image");
  closeModal("#edit__links");
  closeModal("#exchange_contact");
  closeModal("#add__links");
  closeModal("#add__file");
  closeModal("#edit__file");
});
/*------------------ colur function -----------------*/

$(".colour__circle").click(function () {
  const colour = "#" + $(this).data("id");
  document.querySelector(".buttons__share_big").style.background = colour;

  document.querySelectorAll(".social-links a").forEach(function (userItem) {
    userItem.style.color = colour;
  });
  document.querySelectorAll(".files__url").forEach(function (userItem) {
    userItem.style.color = colour;
  });

  document.querySelectorAll(".files__url-edit").forEach(function (userItem) {
    userItem.style.color = colour;
  });

  document.querySelectorAll(".links__url").forEach(function (userItem) {
    userItem.style.color = colour;
  });

  document.querySelectorAll(".links__url-edit").forEach(function (userItem) {
    userItem.style.color = colour;
  });

  editColourData(userid, colour);

  closeFooterModal("#edit__colour", "#colour", "colour_opened");
});

/* ------------------------------- exchange contact -------------------------------*/
$(".buttons__share_orange").click(function (e) {
  e.preventDefault();
  openModal("#exchange_contact");
});
$(".popup__exchange-close-btn").click(function () {
  closeModal("#exchange_contact");
  exchangeYes.classList.remove("hide");
  exchangeNo.classList.add("hide");
  exchangeForm.reset();
});

exchangeForm.addEventListener("click", function (evt) {
  if (evt.target.classList.contains("exchange_yes")) {
    exchangeUsername.setAttribute("required", true);
    exchangeFirstname.removeAttribute("required");
    exchangeLastname.removeAttribute("required");
    exchangeEmail.removeAttribute("required");
    exchangeContact.removeAttribute("required");
    exchangeYes.classList.remove("hide");
    exchangeNo.classList.add("hide");
  }
  if (evt.target.classList.contains("exchange_no")) {
    exchangeUsername.removeAttribute("required");
    exchangeFirstname.setAttribute("required", true);
    exchangeLastname.setAttribute("required", true);
    exchangeEmail.setAttribute("required", true);
    exchangeContact.setAttribute("required", true);

    exchangeYes.classList.add("hide");
    exchangeNo.classList.remove("hide");
  }
});

/* --------------------------------- exchange contact submit -------------------------------- */

exchangeForm.addEventListener("submit", function (evt) {
  evt.preventDefault();

  exchangeSaveBtn.innerHTML =
    '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>';
  //exchangeSaveBtn.setAttribute("disabled", true);
  const form_data2 = new FormData(this);
  form_data2.append("userid", userid);

  $.ajax({
    type: "POST",
    url: `${base_url}/linkwi/includes/ajax/exchange-contact/php/exchange.insert.php`,
    data: form_data2,
    cache: false,
    processData: false,
    contentType: false,
    success: function (data) {
      let data_ex = JSON.parse(data);
      if (data_ex.error != "") {
        showInputError(
          exchangeForm,
          exchangeUsername,
          data_ex.error,
          exchangeSaveBtn
        );
        exchangeSaveBtn.textContent = "Save";
        exchangeSaveBtn.removeAttribute("disabled");
        return false;
      } else {
        closeModal("#exchange_contact");
        exchangeSaveBtn.textContent = "Save";
        exchangeSaveBtn.removeAttribute("disabled");
        exchangeYes.classList.remove("hide");
        exchangeNo.classList.add("hide");
        exchangeForm.reset();
      }
    },
  });
});

/* ------------------------------- validation functions ------------------------------- */

/*function fileError(input, error = "This file type is not allowed") {
    if (!input.value == "") {
        if (input.nextElementSibling.classList != "input_error") {
            let span = document.createElement("span");
            span.textContent = error;
            span.classList.add("input_error");
            input.after(span);
            input.style.marginBottom = 0;
            document.querySelector(".popup__save-btn").disabled = true;
            return false;
        }
    }
}*/

/*----------------Image popups--------------------*/
$(".profile__image-container").click(function () {
  const imageSRC = getComputedStyle(profilePicture)
    .backgroundImage.slice(4, -1)
    .replace(/"/g, "");
  showPreviewImage(imageSRC, "Profile picture");
});

$(".profile-logo").click(function () {
  const imageSRC = getComputedStyle(logo)
    .backgroundImage.slice(4, -1)
    .replace(/"/g, "");

  showPreviewImage(imageSRC, "Logo");
});

$(".popup__image-close-btn").click(function () {
  closeModal("#view__image");
  imageElement.src = `${base_url}/linkwi/images/icons/loading.png`;
  imageElement.alt = "";
});

//popup image preview
function popupImagePreview(event, popupImage, outputPreviewImage) {
  if (popupImage.value != "") {
    let reader = new FileReader();

    reader.onload = function () {
      var output = outputPreviewImage;
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
}
/*----------------Image verification--------------------*/
popupImage.addEventListener("change", () => {
  if (!popupImage.value == "") {
    let allowedTypes = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
    let file = popupImage.files[0];
    let fileType = file.type;
    let fileSize = file.size;

    if (!allowedTypes.includes(fileType)) {
      showInputError(
        profileForm,
        popupImage,
        "This file type is not allowed",
        profileSaveBtn
      );
      return false;
    }
    if (fileSize > 3000000) {
      showInputError(
        profileForm,
        popupImage,
        "Image too big. Max 3MB",
        profileSaveBtn
      );
      return false;
    }
  }
});
popupUserInfoImage.addEventListener("change", () => {
  if (!popupUserInfoImage.value == "") {
    let allowedTypes = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
    let file = popupUserInfoImage.files[0];
    let fileType = file.type;
    let fileSize = file.size;

    if (!allowedTypes.includes(fileType)) {
      showInputError(
        userinfo,
        popupUserInfoImage,
        "This file type is not allowed",
        userinfoSaveBtn
      );
      return false;
    }
    if (fileSize > 3000000) {
      showInputError(
        userinfo,
        popupUserInfoImage,
        "Image too big. Max 3MB",
        userinfoSaveBtn
      );
      return false;
    }
  }
});
/*------------------------------------form validation---------------------------------------*/
const validationConfig = {
  formSelector: ".popup-form",
  inputSelector: ".popup__form-input",
  inactiveButtonClass: "popup__save-btn-disabled",
  inputErrorClass: "input_error",
  errorClass: "input_error_active",
};

const setSubmitButtonState = (isFormValid, submitBtn) => {
  if (isFormValid) {
    submitBtn.removeAttribute("disabled");
    submitBtn.classList.remove(validationConfig.inactiveButtonClass);
  } else {
    submitBtn.setAttribute("disabled", true);
    submitBtn.classList.add(validationConfig.inactiveButtonClass);
  }
};
const showInputError = (formElement, inputElement, errorMessage, submitBtn) => {

  const errorElement = formElement.querySelector(`.${inputElement.id}-error`);
  inputElement.classList.add(validationConfig.inputErrorClass);
  errorElement.textContent = errorMessage;
  errorElement.classList.add(validationConfig.errorClass);
  setSubmitButtonState(false, submitBtn);
  
};

const hideInputError = (formElement, inputElement, submitBtn) => {
  const errorElement = formElement.querySelector(`.${inputElement.id}-error`);
  inputElement.classList.remove(validationConfig.inputErrorClass);
  errorElement.classList.remove(validationConfig.errorClass);
  errorElement.textContent = "";
  setSubmitButtonState(true, submitBtn); //TODO
};

const checkInputValidity = (formElement, inputElement, submitBtn) => {
  if (!inputElement.validity.valid) {
    showInputError(
      formElement,
      inputElement,
      inputElement.validationMessage,
      submitBtn
    );
  } else {
    hideInputError(formElement, inputElement, submitBtn);
  }
};

const setEventListeners = (formElement) => {
  const inputList = Array.from(
    formElement.querySelectorAll(validationConfig.inputSelector)
  );

  inputList.forEach((inputElement) => {
    const submitBtn = formElement.lastElementChild;
    
    // Removed the previous event listener on inputElement
    // inputElement.removeEventListener("input", handleInputEvent);

    // Add the event listener to the document and use event delegation
    document.addEventListener("input", function (event) {
      // Check if the event target matches the inputElement
      if (event.target === inputElement) {
        checkInputValidity(formElement, inputElement, submitBtn);
      }
    });
  });
};
/*----------------form select---------------*/
const enableValidation = (formClass) => {
  const formList = Array.from(
    document.querySelectorAll(validationConfig.formSelector)
  );
  formList.forEach((formElement) => {
    formElement.addEventListener("submit", function (evt) {
      evt.preventDefault();
    });

    setEventListeners(formElement);
  });
};

enableValidation();

/*--------------------social click stats---------------------*/
$(document).on("click", ".cookieclick", function () {
  var button = $(this).data("id");
  $.ajax({
    url: `${base_url}/linkwi/includes/ajax/onclicks/php/onclick.php`,
    method: "POST",
    data: {
      button: button,
      userid: userid,
    },
    dataType: "text",
    cache: false,
    success: function (data) {
      if (data != "") {
        return false;
      }
    },
  });
});

/*--------------------custom link click stats---------------------*/
$(document).on("click", ".linkcookieclick", function () {
  var button = $(this).data("id");
  $.ajax({
    url: `${base_url}/linkwi/includes/ajax/onclicks/php/links-onclick.php`,
    method: "POST",
    data: {
      button: button,
      userid: userid,
    },
    dataType: "text",
    cache: false,
    success: function (data) {
      if (data != "") {
        return false;
      }
    },
  });
});

/*-------------------------display links-------------------------*/
function refreshLinkData() {
  let colour = document.querySelector(".buttons__share_orange").style
    .background;
  $.ajax({
    url: `${base_url}/linkwi/includes/ajax/links/php/refresh.links.php`,
    cache: false,
    method: "POST",
    data: {
      userid: userid,chk:chk
    },
    dataType: "text",
    success: function (data) {
      $("#linkData").html(data);
      document.querySelectorAll(".links__url").forEach(function (userItem) {
        userItem.style.color = colour;
      });
      document
        .querySelectorAll(".links__url-edit")
        .forEach(function (userItem) {
          userItem.style.color = colour;
        });
    },
  });
}
refreshLinkData();
/*-------------------------file uploads-------------------------*/
function fetch_file_data() {
  let colour = document.querySelector(".buttons__share_orange").style
    .background;

  $.ajax({
    url: `${base_url}/linkwi/includes/ajax/file-uploads/php/file.display.php`,
    method: "POST",
    data: {
      userid: userid,chk:chk
    },
    dataType: "text",
    success: function (data) {
      $("#display_file_uploads").html(data);

      document.querySelectorAll(".files__url").forEach(function (userItem) {
        userItem.style.color = colour;
      });
    },
  });
}
fetch_file_data();
/*-------------------------social links-------------------------*/
function fetch_social_data() {
  $.ajax({
    url: `${base_url}/linkwi/includes/ajax/socials/php/display.socials.php`,
    method: "POST",
    data: {
      userid: userid,chk:chk
    },
    dataType: "text",
    success: function (data) {
      $("#display_socials").html(data);
    },
  });
}
fetch_social_data();

/*-------------------- cropper ---------------------------------*/

let cropper, reader, file;

/*----------------logo cropper js -----------------*/

let bs_modal = $("#modal");
let image = document.getElementById("image");

$("body").on("change", ".image", function (e) {
  let files = e.target.files;
  let done = function (url) {
    image.src = url;
    bs_modal.modal("show");
  };
  if (files && files.length > 0) {
    file = files[0];
    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function (e) {
        done(reader.result);
      };
      reader.readAsDataURL(file);
    }
  }
});
bs_modal
  .on("shown.bs.modal", function () {
    cropper = new Cropper(image, {
      aspectRatio: 1,
      viewMode: 1,
      movable: true,
      scalable: true,
      zoomable: true,
      preview: ".preview",
    });
  })
  .on("hidden.bs.modal", function () {
    cropper.destroy();
    cropper = null;
  });
$("#crop").click(function () {
  canvas = cropper.getCroppedCanvas({
    width: 320,
    height: 320,
  });
  canvas.toBlob(function (blob) {
    url = URL.createObjectURL(blob);
    let reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = function () {
      userInfoOutputImage.src = reader.result;
      bs_modal.modal("hide");
    };
  });
});

$(".logo__cropper-close-btn").click(function () {
  bs_modal.modal("hide");
});

/*----------------cropper js profile image-----------------*/

let bs_modal_profile = $("#modal-profile");
let image_profile = document.getElementById("image-profile");

$("body").on("change", ".image-profile", function (e) {
  let files = e.target.files;
  let done = function (url) {
    image_profile.src = url;
    bs_modal_profile.modal("show");
  };
  if (files && files.length > 0) {
    file = files[0];
    if (URL) {
      done(URL.createObjectURL(file));
    } else if (FileReader) {
      reader = new FileReader();
      reader.onload = function (e) {
        done(reader.result);
      };
      reader.readAsDataURL(file);
    }
  }
});
bs_modal_profile
  .on("shown.bs.modal", function () {
    cropper = new Cropper(image_profile, {
      aspectRatio: 1,
      viewMode: 1,
      preview: ".preview",
    });
  })
  .on("hidden.bs.modal", function () {
    cropper.destroy();
    cropper = null;
  });
$("#crop-profile").click(function () {
  canvas = cropper.getCroppedCanvas({
    width: 500,
    height: 500,
  });
  canvas.toBlob(function (blob) {
    url = URL.createObjectURL(blob);
    let reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = function () {
      profileOutputImage.src = reader.result;
      bs_modal_profile.modal("hide");
    };
  });
});

$(".profile__cropper-close-btn").click(function () {
  bs_modal_profile.modal("hide");
});

/*-----------read more About---------*/

let fullText, truncatedText;

function truncateText() {
  fullText = profileAbout.textContent.trim();
  if (fullText.length <= 200) {  
    readMoreButton.style.display = 'none';
  } else {
    truncatedText = fullText.slice(0, 200) + '...';
    profileAbout.textContent = truncatedText;
  }
  if(fullText.length === 0){
  aboutTitle.style.display = 'none';
  }
}

truncateText(); // Call this function after the page loads

readMoreButton.addEventListener("click", () => {
  if (profileAbout.textContent === fullText) {
    profileAbout.textContent = truncatedText;
    readMoreButton.textContent = "Read more";
  } else {
    profileAbout.textContent = fullText;
    readMoreButton.textContent = "Show Less";
  }
});