const dropdown = document.getElementById("gender");
const slider = document.querySelector(".slider");
const sliderContainer = document.getElementById("toggleForm");

// 初期の値
let isMale = dropdown.value === "男";

// 更新用関数
function updateSlider() {
  slider.style.left = isMale ? "0" : "50px";
  dropdown.value = isMale ? "男" : "女"; // 性別値変更
}

sliderContainer.addEventListener("click", () => {
  isMale = !isMale; 
  updateSlider();
});

updateSlider();