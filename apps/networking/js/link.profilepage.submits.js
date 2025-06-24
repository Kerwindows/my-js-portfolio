/* --------------------------------- profile edit submit -------------------------------- */

profileForm.addEventListener('submit', function (evt) {
  evt.preventDefault();
  profileSaveBtn.innerHTML =
    '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>';
  profileFirstName.textContent =
    popupFirstName.value.charAt(0).toUpperCase() +
    popupFirstName.value.slice(1);
  profileLastName.textContent =
    popupLastName.value.charAt(0).toUpperCase() + popupLastName.value.slice(1);
  profileTitle.textContent = popupTitle.value;
  profileOrganization.textContent = popupOrganization.value;
  profileCity.textContent = popupIndustry.value;
  const form_data = new FormData(this);
  form_data.append('userid', userid);
  form_data.append('image', profileOutputImage.src);
  console.log(userid);
  //let oldImage = getComputedStyle(profilePicture).backgroundImage.slice(4, -1).replace(/"/g, "");
  //oldImage = oldImage.substring(oldImage.lastIndexOf("/") + 1);
  //form_data.append("oldImage", oldImage);
  $.ajax({
    type: 'POST',
    url: `${base_url}/linkwi/includes/ajax/links/php/save.profile.php`,
    data: form_data,
    cache: false,
    processData: false, // FormData should not be processed
    contentType: false, // FormData has its own content type
    success: function (data) {
        console.log(data);
        let data_profile = JSON.parse(data);
        if (data_profile.error != '') {
          showInputError(
            profileForm,
            popupImage,
            'Error uploading image',
            profileSaveBtn
          );
          profileSaveBtn.textContent = 'Save';
          return false;
        } else {
          if (data_profile.newImage != '') {
            const imageContainer = document.querySelector('.profile__image-container');
            const imageUrl = `${base_url}/linkwi/images/profile-images/` + data_profile.newImage;
            imageContainer.style.backgroundImage = 'url(' + imageUrl + ')';
          }
          closeModal('#edit__profile');
          profileSaveBtn.textContent = 'Save';
          profileForm.reset();
        }
      },
  });
});

/* --------------------------------- user edit (logo) submit -------------------------------- */

userInfo.addEventListener('submit', function (evt) {
  evt.preventDefault();
  userinfoSaveBtn.innerHTML =
    '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>';
  stickyTelephone.attributes.onclick.textContent = `window.open('trl:${popupUserInfoContact.value}','_blank')`;
  stickyEmail.attributes.onclick.textContent = `window.open('mailto:${popupUserInfoEmail.value}?subject=LinkWi email contact&body=Hi ${profileFirstName.textContent}, I am writing this email ...','_blank')`;
  const form_data = new FormData(this);
  form_data.append('userid', userid);
  form_data.append('image', userInfoOutputImage.src);

  $.ajax({
    type: 'POST',
    url: `${base_url}/linkwi/includes/ajax/logo-upload/php/update.php`,
    data: form_data,
    cache: false,
    processData: false,
    contentType: false,
    success: function (data) {
      let data_profile = JSON.parse(data);
      if (data_profile.error != '') {
        showInputError(
          userInfo,
          popupUserInfoImage,
          'Error uploading image',
          userinfoSaveBtn,
        );
        userinfoSaveBtn.textContent = 'Save';
        return false;
      } else {
        if (data_profile.newImage != '') {
          const addCSS = (css) =>
            (document.head.appendChild(
              document.createElement('style'),
            ).innerHTML = css);
          addCSS(
            '.profile-logo{ background-image: url(' + base_url + '/linkwi/images/profile-logos/' +
              data_profile.newImage +
              '); }',
          );
        }
        userinfoSaveBtn.textContent = 'Save';
        closeFooterModal('#edit__userinfo', '#userinfo', 'userinfo_opened');
        userInfo.reset();
      }
    },
  });
});
/* ------------------------------- edit bio submit ------------------------------- */

editAboutForm.addEventListener('submit', function (evt) {
  evt.preventDefault();
  profileAbout.textContent = popupAbout.value;
  const form_data = new FormData(this);
  form_data.append('userid', userid);
  $.ajax({
    type: 'POST',
    url: `${base_url}/linkwi/includes/ajax/links/php/edit.user.php`,
    data: form_data,
    cache: false,
    processData: false,
    contentType: false,
    success: function (data) {
      var data = JSON.parse(data);
      if (data.error != '') {
        return false;
      } else {
        truncateText();
        //formatAboutText(); //from fetch.sinlge
        readMoreButton.textContent = 'Read more';
      }
    },
  });
  closeModal('#edit__about');
  editAboutForm.reset();
});
/* ------------------------------- add file submit ------------------------------- */

addFile.addEventListener('submit', function (evt) {
  evt.preventDefault();
  const form_data = new FormData(this);
  form_data.append('rle', rle);
  let linkFilesCount = document.querySelectorAll('.links__url-edit').length;
  form_data.append('linkFilesCount', linkFilesCount);
  form_data.append('userid', userid);
  $.ajax({
    type: 'POST',
    url: `${base_url}/linkwi/includes/ajax/file-uploads/php/file.insert.php`,
    data: form_data,
    cache: false,
    processData: false,
    contentType: false,
    success: function (data) {
      var data = JSON.parse(data);
      if (data.error != '') {
        showInputError(addFile, fileUpload, data.error, fileSaveBtn);
        return false;
      } else {
        fetch_file_data();
        closeModal('#add__file');
        addFile.reset();
      }
    },
  });
});
/* ------------------------------- edit file submit ------------------------------- */

editFile.addEventListener('submit', function (evt) {
  evt.preventDefault();
  const form_data = new FormData(this);
  $.ajax({
    type: 'POST',
    url: `${base_url}/linkwi/includes/ajax/file-uploads/php/file.edit.php`,
    data: form_data,
    cache: false,
    processData: false,
    contentType: false,
    success: function (data) {
      var data = JSON.parse(data);
      if (data.error != '') {
        showInputError(editFile, fileUpload, data.error, editFileSaveBtn);
        return false;
      } else {
        fetch_file_data();
        closeModal('#edit__file');
        editFile.reset();
      }
    },
  });
});
/*-----------------delete uploaded file--------------------*/

function deleteFile(id, filePath) {
  if (confirm('Are you sure you want to delete this file?')) {
    $.ajax({
      url: `${base_url}/linkwi/includes/ajax/file-uploads/php/file.delete.php`,
      method: 'POST',
      data: {
        id: id,
        filePath: filePath,
      },
      dataType: 'text',
      success: function (data) {
        let dataFile = JSON.parse(data);
        if (dataFile.error != '') {
          return false;
        } else {
          // Remove the parent 'file-container' element from the DOM
          document
            .querySelector(`.files__delete[data-id="${id}"]`)
            .closest('.file-container')
            .remove();
        }
      },
    });
  }
}

/* ------------------------------- social submit ------------------------------- */
/*
  function submitSocialForm(evt) {
    evt.preventDefault();
  
    socialFacebook.href = popupFacebook.value;
    popupFacebook.value == ""
      ? socialFacebook.classList.add("hide")
      : socialFacebook.classList.remove("hide");
  
    socialTwitter.href = popupTwitter.value;
    popupTwitter.value == ""
      ? socialTwitter.classList.add("hide")
      : socialTwitter.classList.remove("hide");
  
    socialInstagram.href = popupInstagram.value;
    popupInstagram.value == ""
      ? socialInstagram.classList.add("hide")
      : socialInstagram.classList.remove("hide");
  
    socialLinkedin.href = popupLinkedin.value;
    popupLinkedin.value == ""
      ? socialLinkedin.classList.add("hide")
      : socialLinkedin.classList.remove("hide");
  
    socialTikTok.href = popupTikTok.value;
    popupTikTok.value == ""
      ? socialTikTok.classList.add("hide")
      : socialTikTok.classList.remove("hide");
  
    socialYouTube.href = popupYouTube.value;
    popupYouTube.value == ""
      ? socialYouTube.classList.add("hide")
      : socialYouTube.classList.remove("hide");
  
    socialWhatsapp.href = popupWhatsapp.value;
    popupWhatsapp.value == ""
      ? socialWhatsapp.classList.add("hide")
      : socialWhatsapp.classList.remove("hide");
  
    const form_data = new FormData(this);
    form_data.append("userid", userid);
    // process the form
    $.ajax({
      type: "POST",
      url: `${base_url}/linkwi/includes/ajax/links/php/edit.socials.php`,
      data: form_data,
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        if (data != "") {
          return false;
        }
      },
    });
    closeModal("#edit__social");
  }*/
/* ------------------------------- social submit 2 ------------------------------- */

function submitSocialForm2(evt) {
  evt.preventDefault();

  var form = $('.popup__edit-social-form2')[0];
  setEventListeners(form);

  const form_data = new FormData(this);
  $('input', form).each(function (i, item) {
    // Get the data attribute values and input name
    var dataId = $(this).data('id');
    var dataName = $(this).data('name');
    var dataIcon = $(this).data('icon');
    var inputName = $(this).attr('name');
    var thisSocial = document.querySelector(`#${inputName}-input`);
    if ($(this).val() === '') {
      showInputError(
        submitSocialEdit2,
        thisSocial,
        'Url cannot be blank',
        socialSaveButton,
      );
      return false;
    }

    // Append the data attribute values to the FormData object
    form_data.append(inputName + '-id', dataId);
    form_data.append(inputName + '-name', dataName);
    form_data.append(inputName + '-icon', dataIcon);
    form_data.append('userid', userid);
  });
  // process the form
  $.ajax({
    type: 'POST',
    url: `${base_url}/linkwi/includes/ajax/socials/php/submit.socials.php`,
    data: form_data,
    cache: false,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data != '') {
        return false;
      } else {
        fetch_social_data();
        closeModal('#edit__social2');
      }
    },
  });
}
/* ------------------------------- add link submit ------------------------------- */
function submitAddLinkForm(evt) {
  evt.preventDefault();
  const form_data = new FormData(this);
  form_data.append('userid', userid);
  form_data.append('rle', rle);
  let linkListCount = document.querySelectorAll('.links__url-edit').length;
  form_data.append('linkListCount', linkListCount);

  $.ajax({
    type: 'POST',
    url: `${base_url}/linkwi/includes/ajax/links/php/add.links.php`,
    data: form_data,
    cache: false,
    processData: false,
    contentType: false,
    success: function (data) {
      var data = JSON.parse(data);
      if (data.error != '') {
        if (data.image_error != '') {
          document.querySelector('.image_add-input-error').textContent =
            data.image_error;
        }
        if (data.title_error != '') {
          document.querySelector('.title_add-input-error').textContent =
            data.title_error;
        }
        if (data.url_error != '') {
          document.querySelector('.url_add-input-error').textContent =
            data.url_error;
        }
        if (data.links_error != '') {
          document.querySelector('.image_add-input-error').textContent =
            data.links_error;
        }
        return false;
      } else {
        addLinkForm.reset();
        popupLinksAddPreviewImage.src = `${base_url}/linkwi/images/icons/link-icon.jpg`;
        refreshLinkData();
        closeModal('#add__links');
      }
    },
  });
}
//submitSocialEdit.addEventListener("submit", submitSocialForm); // old disabled
SocialForm.addEventListener('submit', submitSocialForm2);
document
  .querySelector('.popup__add-links-form')
  .addEventListener('submit', submitAddLinkForm);

/* ------------------------------- edit links submit ------------------------------- */
/*editLinkForm.addEventListener("input", function (evt) {
      const isValid = document.querySelector(".popup__form-input_type_link_title").value.length > 0 && document.querySelector(".popup__form-input_type_link_url").value.length > 0;
      setSubmitButtonState(isValid, linkEditSaveBtn);
  });*/

editLinkForm.addEventListener('submit', function (evt) {
  evt.preventDefault();

  if (linkImageName) {
    newLinkImageName = linkImageName;
  } else {
    newLinkImageName = '';
  }

  document.querySelector(
    '#link' + document.querySelector('.popup__form-input_type_link_id').value,
  ).href = document.querySelector('.popup__form-input_type_link_url').value;
  document.querySelector(
    '#title' + document.querySelector('.popup__form-input_type_link_id').value,
  ).innerText = document.querySelector(
    '.popup__form-input_type_link_title',
  ).value;
  let form_data = new FormData(this);
  form_data.append('newLinkImageName', newLinkImageName);
  $.ajax({
    type: 'POST',
    url: `${base_url}/linkwi/includes/ajax/links/php/edit.links.php`,
    data: form_data,
    cache: false,
    processData: false,
    contentType: false,
    success: function (data) {
      var data = JSON.parse(data);
      if (data.error != '') {
        if (data.image_error != '') {
          document.querySelector('.image_edit-input-error').textContent =
            data.image_error;
        }
        if (data.title_error != '') {
          document.querySelector('.title_edit-input-error').textContent =
            data.title_error;
        }
        if (data.url_error != '') {
          document.querySelector('.url_edit-input-error').textContent =
            data.url_error;
        }
        return false;
      } else {
        linkImageName = '';
        if (data.newImage != '') {
          document.querySelector(
            '#image' +
              document.querySelector('.popup__form-input_type_link_id').value,
          ).src = `${base_url}/linkwi/images/profile-links/` + data.newImage;
        }
        closeModal('#edit__links');
      }
    },
  });
});
/* ------------------------------- delete links and images ------------------------------- */
function deleteLink(id, imagePath) {
  if (confirm('Are you sure?')) {
    $.ajax({
      url: `${base_url}/linkwi/includes/ajax/links/php/delete.link.php`,
      method: 'POST',
      data: {
        id: id,
        imagePath: imagePath,
      },
      dataType: 'text',
      cache: false,
      success: function (data) {
        if (data != '') {
          return false;
        } else {
          // Remove the parent 'links-container' element from the DOM
          document
            .querySelector(`.links__delete[data-id="${id}"]`)
            .closest('.link-container')
            .remove();
        }
      },
    });
  }
}

/* document.getElementById('image_add-input').addEventListener('change', function() {
              linkImageName = this.files[0].name;
          });*/

$(document).on('change', '#image_edit-input', function () {
  let inputImgElement = $(this)[0]; // Access the DOM element
  if (inputImgElement.files && inputImgElement.files[0]) {
    linkImageName = inputImgElement.files[0].name;
  } else {
    console.log('No file selected');
  }
});
/*----------------- sort links order ----------------------------*/

$(document).ready(function () {
  // Make the link containers sortable
  $('#linkData').sortable({
    items: '.link-container',
    handle: '.handle',
    cursor: 'move',
    placeholder: 'sortable-placeholder',
    forcePlaceholderSize: true,
    opacity: 0.7,
    containment: '#linkData',
    // delay: 800, // Add a 2-second delay
    update: function (event, ui) {
      // Get the new order as an array of ids
      const newOrder = $(this).sortable('toArray', { attribute: 'data-id' });

      // Send the new order to the server
      $.ajax({
        url: `${base_url}/linkwi/includes/ajax/links/php/update.links.order.php`,
        type: 'POST',
        data: {
          order: newOrder,
        },
        success: function (response) {
          console.log('Order updated successfully:', response);
        },
        error: function (error) {
          console.error('Error updating order:', error);
        },
      });
    },
  });
});