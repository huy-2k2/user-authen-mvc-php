let is_submiting = false;
document.querySelector(".form").onsubmit = function (e) {
  if (is_submiting == true) {
    e.preventDefault();
  }
  is_submiting = true;
  e.target.querySelector("*[type='submit']").style.opacity = "0.5";
};
