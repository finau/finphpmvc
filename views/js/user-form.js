
$(document).ready(function() {

   /** Validate User Form **/
   const form = document.querySelector('form');

   form.addEventListener('submit', function(event){

      const userName = form.elements["user_name"];
      const password = form.elements["password"];
      const email = form.elements["email"];
      const birthDate = form.elements["birth_date"];
      const phoneNumber = form.elements["phone_number"];
      const url = form.elements["url"];

      if (!isValidUsername(userName.value)) {
         alert("Username must be letters only");
         event.preventDefault();
         return;
      }

      if (!isValidEmail(email.value)) {
         alert("Please enter valid email address");
         event.preventDefault();
         return;
      }

      if (!isPasswordValid(password.value)) {
         alert("Please enter valid password");
         event.preventDefault();
         return;
      }

      if (!isValidPhone(phoneNumber.value)) {
         alert("Please enter valid phone number");
         event.preventDefault();
         return;
      }

      if (!isValidUrl(url.value)) {
         alert("Please enter valid URL");
         event.preventDefault();
         return;
      }

      if (!isValidDob(birthDate.value)) {
         alert("Please enter valid Birth Date");
         event.preventDefault();
         return;
      }

      form.submit();
   });
});

function isValidDob(dob) {
   return /^(((20[012]\d|19\d\d)|(1\d|2[0123]))[-/]((0[0-9])|(1[012]))[-/]((0[1-9])|([12][0-9])|(3[01])))$/.test(dob);
}

function isValidUrl(url) {
   // check different url format
   return /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/.test(url);
}

function isValidPhone(phonenumber) {
   // number only, at least 10 characters
   return /^([0-9]).{9}$/.test(phonenumber);
}

function isPasswordValid(password) {
   //8 characters minimum, at least 1 lowercase, 1 uppercase and 1 special sign.
   return /^(?=.*[a-z])(?=.*[#$@!%&*?])(?=.*[A-Z]).{8,}$/.test(password);
}

function isValidUsername(username) {
   //letters only
   return /^[A-z]+$/.test(username);
}

function isValidEmail(email) {
   //valid email format
   return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}