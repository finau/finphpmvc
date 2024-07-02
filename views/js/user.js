
$(document).ready(function() {
   const dialogBox = document.getElementById("dialog");
   const closeBtn = document.querySelector(".close");

   closeBtn.addEventListener("click", () => {
      dialogBox.close();
   });
});

function showUserInfo(id) {

   const dialogBox = document.getElementById("dialog");
   const dialogContent = document.getElementById("dialog-content");

   $.getJSON('index.php?action=view&id=' + id, function(data) {
      let info = "<div>Username: " + data.user_name + "</div>" +
          "<div>Email: " + data.email + "</div>" +
          "<div>Password: " + data.password + "</div>" +
          "<div>Birth Date: " + data.birth_date + "</div>" +
          "<div>Phone number: " + data.phone_number + "</div>" +
          "<div>URL: " + data.url + "</div>";

       dialogContent.innerHTML = info;
       dialogBox.showModal();
   });
}